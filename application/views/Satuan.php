<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Satuan</h3>
          <?php if ($this->session->userdata('roll') == '4') { ?>
            <button class="btn btn-primary ms-auto " onclick="showModalTambah();"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Data</button>
          <?php } ?>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="myTable" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Tambah -->
<div class="modal modal-blur fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Satuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>Satuan/simpanSatuan" method="POST">
          <div class="mb-3">
            <label class="form-label">Nama Satuan Barang</label>
            <input type="text" class="form-control" name="satuan" placeholder="Input Nama Satuan arang" required>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Tambah -->
<div class="modal modal-blur fade" id="modalEdit">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Satuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>Satuan/simpanEditSatuan" method="POST">
          <div class="mb-3">
            <label class="form-label">Nama Satuan Barang</label>
            <input type="text" class="form-control" name="editSatuan" id="editSatuan" placeholder="Input Nama Satuan arang" required>
            <input type="hidden" name="idEdit" id="idEdit">
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->

<script>
  $(document).ready(function() {

    let prive = '<?= $this->session->userdata('roll'); ?>';

    showModalTambah = function () {
      $('#modalTambah').modal('show');
    }


    editFunction = function (id) {

      ajaxUntukSemua(base_url()+'Satuan/getById', {id}, function(data) {

        $('#editSatuan').val(data.data.nama_satuan);
        $('#idEdit').val(data.data.id);
        $('#modalEdit').modal('show');

      }, 
      function(error) {
        console.log('Kesalahan:', error);
        t_error('Sistem Error, Pesan : '+error)
      });


    }

    deleteFunction = function (id) {
      Swal.fire({
        title: 'Konfirmasi Hapus Data',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          ajaxUntukSemua(base_url()+'Satuan/deleteData', {id}, function(data) {
            location.reload();
          }, 
          function(error) {
            console.log('Kesalahan:', error);
            t_error('Sistem Error, Pesan : '+error)
          });
        }
      });
    }


    var dataTable = $('#myTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('Satuan/get_data'); ?>",
        "type": "POST"
      },
      "columns": [
      { 
        "data": null, 
        "name": "nomor",
        "width" : "1%",
        "class" : "text-center",
        "render": function (data, type, row, meta) {
          return meta.row + 1;
        },
        "orderable": false,
      },
      {
        "data": "nama_satuan", 
        "name": "Nama Satuan",
        "width" : "50%",
        "class" : "text-center"
      },
      {
        "data": null,
        "width" : "8%",
        "class" : "text-center",
        "orderable": false,
        "render": function (data, type, row) {

          if (prive == '4') {

            var actions = '<button class="btn btn-icon btn-sm btn-warning" onclick="editFunction(' + row.id + ')"><i class="fa-solid fa-pen-to-square"></i></button>';
            actions += '<button class="btn btn-icon btn-sm btn-danger m-1" onclick="deleteFunction(' + row.id + ')"><i class="fa-solid fa-trash"></i></button>';
            return actions;

          }else{
            return '';
          }
        }
      }
      ]
    });

    $('#btnSearch').click(function() {
      var searchValue = $('#search').val();
      dataTable.search(searchValue).draw();
    });
  });
</script>