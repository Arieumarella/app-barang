<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Referensi Nama Barang</h3>
          <?php if ($this->session->userdata('roll') == '4') { ?>
            <button class="btn btn-primary ms-auto " onclick="showModalTambah();"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Data</button>
          <?php } ?>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="tabelKategori" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Satuan Barang</th>
                <th>Jumlah Stok Barang</th>
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
        <h5 class="modal-title">Tambah Data Jenis barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>KategoriBarang/simpanBarang" method="POST">
          <div class="mb-3">
            <label class="form-label">Nama Kategori Barang</label>
            <input type="text" class="form-control" name="namaKategoriBarang" placeholder="Input Nama Kategori Batrang" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Satuan Barang</label>
            <select class="form-select" name="satuan" id="satuan" required>
              <option value="" selected disabled>--- Pilih Satuan ---</option>
              <?php foreach ($dataSatuan as $key => $value) { ?>
                <option value="<?= $value->id; ?>"><?= $value->nama_satuan; ?></option>
              <?php } ?>
            </select>
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
        <h5 class="modal-title">Edit Data Jenis Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>KategoriBarang/simpanEditSatuan" method="POST">
          <div class="mb-3">
            <label class="form-label">Nama Jenis Barang</label>
            <input type="text" class="form-control" name="namaKategoriBarangEdit" id="namaKategoriBarangEdit" placeholder="Input Nama Kategori Batrang" required>
            <input type="hidden" name="idEdit" id="idEdit">
          </div>
          <div class="mb-3">
            <label class="form-label">Satuan Barang</label>
            <select class="form-select" name="satuanEdit" id="satuanEdit" required>
              <option value="" selected disabled>--- Pilih Satuan ---</option>
              <?php foreach ($dataSatuan as $key => $value) { ?>
                <option value="<?= $value->id; ?>"><?= $value->nama_satuan; ?></option>
              <?php } ?>
            </select>
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

      ajaxUntukSemua(base_url()+'KategoriBarang/getById', {id}, function(data) {

        $('#namaKategoriBarangEdit').val(data.data.nama_barang);
        $('#idEdit').val(data.data.id);
        $("#satuanEdit").val(data.data.id_satuan);
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
          ajaxUntukSemua(base_url()+'KategoriBarang/deleteData', {id}, function(data) {
            location.reload();
          }, 
          function(error) {
            console.log('Kesalahan:', error);
            t_error('Sistem Error, Pesan : '+error)
          });
        }
      });
    }


    var dataTable = $('#tabelKategori').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('KategoriBarang/get_data'); ?>",
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
        "data": "nama_barang", 
        "name": "nama barang",
        "width" : "30%",
        "class" : "text-center"
      },
      {
        "data": "nama_satuan", 
        "name": "satuan barang",
        "width" : "30%",
        "class" : "text-center"
      },
      {
        "data": "jml_stock", 
        "name": "Jumlah Stok Barang",
        "width" : "30%",
        "class" : "text-center",
        "orderable": false,
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