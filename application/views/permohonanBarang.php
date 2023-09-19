<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Permohonan Barang</h3>
          <?php if ($this->session->userdata('roll') == '5') { ?>
            <button class="btn btn-primary ms-auto " onclick="showModalTambah();"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Data</button>
          <?php } ?>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="tabelPermohonan" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Review</th>
                <th>Surat Permohonan</th>
                <th>BAST</th>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Permohonan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>PermohonanBarang/simpanPermintaan" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="mb-3 col-12">
              <div class="form-label">Surat Permohonan Barang</div>
              <input type="file" class="form-control" name="permohonanBarang" required>
            </div>
            <hr class="mt-3" >
            <div id="contentFormPermohonan">
              <div class="mb-3 col-12" style="margin-top: -20px;">
                <label class="form-label">Jenis Barang</label>
                <select class="form-select" name="jns_barang[]" id="jns_barang" required>
                  <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
                  <?php foreach ($dataJnsBarang as $key => $value) { ?>
                    <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3 col-12">
                <label class="form-label">Jumlah Barang</label>
                <input type="text" class="form-control" name="jml_barang[]" id="jml_barang" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
              </div>
            </div>
            <div class="mb-3 text-end">
              <button type="button" class="btn btn-dark" onclick="tambahRow();">+</button>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
                Cancel
              </a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Tambah -->
<div class="modal modal-blur fade" id="modalAksi">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Approval Pengajuan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>PermohonanBarang/simpanApproval" method="POST">
          <input type="hidden" name="idEditX" id="idEditX">
          <div class="mb-3">
            <label class="form-label">Ubah Status</label>
            <select class="form-select" name="dataStatus" id="dataStatus" required>
              <option value="" selected disabled>--- Pilih Satuan ---</option>
              <?php foreach ($dataStatus as $key => $value) { ?>
                <option value="<?= $value->id; ?>"><?= $value->nama_status; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" name="jml_barangApprove" id="jml_barangApprove" placeholder="Input Jumlah Barang" oninput="setTotHarga(); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required max="5">
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" data-bs-toggle="autosize" name="catatan" placeholder="Input Catatan" style="height: 150px;" required></textarea>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary" >Simpan</button>
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


    tambahRow = function () {

      let html = ` <div class="mb-3 col-12">
      <label class="form-label">Jenis Barang</label>
      <select class="form-select" name="jns_barang[]" required>
      <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
      <?php foreach ($dataJnsBarang as $key => $value) { ?>
        <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
      <?php } ?>
      </select>
      </div>
      <div class="mb-3 col-12">
      <label class="form-label">Jumlah Barang</label>
      <input type="text" class="form-control" name="jml_barang[]" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
      </div> 
      </div>`;

      $("#contentFormPermohonan").append(html);
    }

    showModalUploadBast = function (id) {
      alert(id);
    }


    showModalTambah = function () {
      $('#modalTambah').modal('show');
    }


    showModalSubagTu = function (id, jml_max) {

      $('#idEditX').val(id);
      $("#jml_barangApprove").attr("max", jml_max);

      $('#modalAksi').modal('show');
    }


    setTotHarga = function () {
      let jml_barang = $('#jml_barang').val(),
      hargaSatuan = $('#hrg_satuan').val();

      if (jml_barang != '' && hargaSatuan != '') {
        $('#tot_harga').val(jml_barang*hargaSatuan);
      }

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

    deleteFunction = function (id, sts) {

      if (sts != 'Panding') {
        Swal.fire({
          icon: 'error',
          title: 'Gagal Menghapus Data',
          text: `Data Gagal dihapus dikarenakan status Approval adalah ${sts}`,
          confirmButtonText: 'Tutup'
        });
        return;
      }

      Swal.fire({
        title: 'Konfirmasi Hapus Data',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          ajaxUntukSemua(base_url()+'PermohonanBarang/deleteData', {id}, function(data) {

            if (data.code != 200) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal Menghapus Data',
                text: data.msg,
                confirmButtonText: 'Tutup'
              });
              return;
            }

            location.reload();
          }, 
          function(error) {
            console.log('Kesalahan:', error);
            t_error('Sistem Error, Pesan : '+error)
          });
        }
      });
    }


    var dataTable = $('#tabelPermohonan').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('PermohonanBarang/get_data'); ?>",
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
        "data": null, 
        "name": "nama pemohon",
        "width" : "15%",
        "class" : "text-center",
        "render": function (data, type, row, meta) {
          return `<a href="<?= base_url(); ?>/PermohonanBarang/deleteData/${row.id}">${row.username_pemohon}</a>`;
        }
      },
      {
        "data": "tgl_pengajuan", 
        "name": "Tanggal Pengajuan",
        "width" : "10%",
        "class" : "text-center"
      },
      {
        "data": null, 
        "name": "STATUS REVIEW",
        "width" : "10%",
        "class" : "text-center",
        "render": function (data, type, row) {
          let status  = row.status_review,
          cetak = '';

          if(status == '0'){
            cetak = `<span class="badge rounded-pill bg-warning" style="color: black;"><b>Belum Di Review</b></span>`;
          }else if(status == '1'){
            cetak = `<span class="badge rounded-pill bg-success"><b>Telah Di Review</b></span>`;
          }
          return cetak;
        }
      },
      {
        "data": null, 
        "name": "SURAT PERMOHONAN",
        "width" : "10%",
        "class" : "text-center",
        "render": function(data, type, full, meta) {
          return jumlah_barang = (data.path_permohonanBarang != null) ? `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.path_permohonanBarang+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`:``;
        },
        "orderable": false,
      },
      {
        "data": null, 
        "name": "BAST",
        "width" : "10%",
        "class" : "text-center",
        "render": function(data, type, full, meta) {
          return bast = (data.path_bast != null) ? `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.path_bast+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`:``;
        },
        "orderable": false,
      },
      {
        "data": null,
        "width" : "8%",
        "class" : "text-center",
        "orderable": false,
        "render": function (data, type, row) {
          let actions = '';
          if (prive == '5') {
            actions = '<button class="btn btn-icon btn-sm btn-danger m-1" onclick="deleteFunction(' + row.id + ', `'+row.nama_status+'`)"><i class="fa-solid fa-trash"></i></button>';
          }else if (prive == '3'){
            actions = '<button class="btn btn-icon btn-primary m-1" onclick="showModalSubagTu(' + row.id + ', '+ row.jml_barang +')"><i class="fa-solid fa-file-pen"></i></button>';
          }else if (prive == '4'){
            actions = `<button class="btn btn-icon btn-primary m-1" onclick="showModalUploadBast(${row.id})"><i class="fa-solid fa-upload"></i></button>`;
          }
          return actions;
        },
        "orderable": false,
      }
      ]
    });

    $('#btnSearch').click(function() {
      var searchValue = $('#search').val();
      dataTable.search(searchValue).draw();
    });



    let dataTanggal = new Litepicker({
      element: document.getElementById('tanggalX'),
      buttonText: {
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
      },
      format: "MM/DD/YYYY"
    });


  });
</script>