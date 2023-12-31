<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Barang Masuk</h3>
          <?php if ($this->session->userdata('roll') == '4') { ?>
            <button class="btn btn-primary ms-auto " onclick="showModalTambah();"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Data</button>
          <?php } ?>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="tPengajuanBarang" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Faktur</th>
                <th>Tanggal Faktur</th>
                <th>Jumlah Transaksi</th>
                <th>Dokumen Faktur</th>
                <th>Dokumen SPM</th>
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
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Data Barang Masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>StockBarang/simpanInputBarang" method="POST" enctype="multipart/form-data">
          <div class="row">

           <div class="mb-3 col-6">
            <label class="form-label">Nomor Faktur</label>
            <input type="text" class="form-control" name="noFaktur" placeholder="Input Nomor Faktur" required>
          </div>
          <div class="mb-3 col-6">
            <label class="form-label">Tanggal Faktur</label>
            <input type="text" class="form-control" name="tglFaktur" placeholder="Tanggal Faktur" id="tanggalX" required>
            <span class="input-icon-addon mb-5" style="margin-right: 10px;">
            </div>

            <div class="col-6">
              <div class="mb-3 col-12">
                <div class="form-label">Dokumen Faktur</div>
                <input type="file" class="form-control" name="faktur" accept=".pdf" required>
              </div>
              <div class="mb-3 col-12">
                <div class="form-label">Dokumen SPM</div>
                <input type="file" class="form-control" name="SPM" accept=".pdf" required>
              </div>
            </div>

            <hr>

            <div id="dataContent">
              <div class="row">
                <div class="mb-3 col-6">
                  <label class="form-label">Jenis Barang</label>
                  <select class="form-select" name="jns_barang[]" id="jns_barang" required>
                    <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
                    <?php foreach ($dataJnsBarang as $key => $value) { ?>
                      <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3 col-6">
                  <label class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" name="namaKategoriBarang[]" placeholder="Input Nama Barang" required>
                </div>
                <div class="mb-3 col-6">
                  <label class="form-label">Kondisi Barang</label>
                  <select class="form-select" name="kon_barang[]" id="kon_barang" required>
                    <option value="" selected disabled>--- Pilih Kondisi Barang ---</option>
                    <?php foreach ($datakondisi as $key => $value) { ?>
                      <option value="<?= $value->id; ?>"><?= $value->kondisi_barang; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3 col-6">
                  <label class="form-label">Jumlah Barang</label>
                  <input type="text" class="form-control" name="jml_barang[]" id="jml_barang" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
                <div class="mb-3 col-6">
                  <label class="form-label">Harga Satuan</label>
                  <input type="text" class="form-control" name="hrg_satuan[]" id="hrg_satuan" placeholder="Input Harga Satuan" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                </div>
              </div>
            </div>

            <div class="text-end col-12 mb-3" style="margin-left:-20px;">
              <button type="button" class="btn btn-dark" onclick="addNuwRow()">+</button>
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


<!-- Modal edit -->
<div class="modal modal-blur fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>StockBarang/simpanEditFaktur" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="idEdit" id="idEdit">
          <div class="row">
            <div class="mb-3 col-6">
              <label class="form-label">Nomor Faktur</label>
              <input type="text" class="form-control" name="noFakturEdit" id="noFakturEdit" placeholder="Input Nomor Faktur" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Tanggal Faktur</label>
              <input type="text" class="form-control" name="tglFakturEdit"  id="tglFakturEdit" placeholder="Tanggal Faktur" required>
              <span class="input-icon-addon mb-5" style="margin-right: 10px;">
              </div>
              <div class="col-12">
                <div class="mb-3 col-12">
                  <div class="form-label">Dokumen Faktur</div>
                  <input type="file" class="form-control" name="fakturEdit" accept=".pdf" required>
                </div>
                <div class="mb-3 col-12">
                  <div class="form-label">Dokumen SPM</div>
                  <input type="file" class="form-control" name="SPMEdit" accept=".pdf" required>
                </div>
              </div>
              <p style="color: red;">*Untuk edit barang silakan masuk pada detail barang.</p>
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
  <!-- End Modal edit -->


  <script>
    $(document).ready(function() {

      let prive = '<?= $this->session->userdata('roll'); ?>';

      editData = function (id) {

       ajaxUntukSemua(base_url()+'StockBarang/getDataById', {id}, function(data) {

        console.log(data)

        let inputDate = data.tgl_faktur;
        parts = inputDate.split('-'), 
        year = parts[0],
        month = parts[1],
        day = parts[2],
        formattedDate = month + '/' + day + '/' + year;

        $('#idEdit').val(id);
        $('#noFakturEdit').val(data.no_faktur);
        $('#tglFakturEdit').val(formattedDate);
        tglFakturEdit.setDate(formattedDate);
        $('#modalEdit').modal('show');


      }, 
      function(error) {
        console.log('Kesalahan:', error);
        t_error('Sistem Error, Pesan : '+error)
      });


     }


     addNuwRow = function () {
      let html = `<div class="row">
      <div class="mb-3 col-6">
      <label class="form-label">Jenis Barang</label>
      <select class="form-select" name="jns_barang[]" id="jns_barang" required>
      <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
      <?php foreach ($dataJnsBarang as $key => $value) { ?>
        <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
      <?php } ?>
      </select>
      </div>
      <div class="mb-3 col-6">
      <label class="form-label">Nama Barang</label>
      <input type="text" class="form-control" name="namaKategoriBarang[]" placeholder="Input Nama Barang" required>
      </div>
      <div class="mb-3 col-6">
      <label class="form-label">Kondisi Barang</label>
      <select class="form-select" name="kon_barang[]" id="kon_barang" required>
      <option value="" selected disabled>--- Pilih Kondisi Barang ---</option>
      <?php foreach ($datakondisi as $key => $value) { ?>
        <option value="<?= $value->id; ?>"><?= $value->kondisi_barang; ?></option>
      <?php } ?>
      </select>
      </div>
      <div class="mb-3 col-6">
      <label class="form-label">Jumlah Barang</label>
      <input type="text" class="form-control" name="jml_barang[]" id="jml_barang" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
      </div>
      <div class="mb-3 col-6">
      <label class="form-label">Harga Satuan</label>
      <input type="text" class="form-control" name="hrg_satuan[]" id="hrg_satuan" placeholder="Input Harga Satuan" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
      </div>
      </div>`;

      $('#dataContent').append(html);
    }

    showModalTambah = function () {
      $('#modalTambah').modal('show');
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
          ajaxUntukSemua(base_url()+'StockBarang/deleteData', {id}, function(data) {

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


    var dataTable = $('#tPengajuanBarang').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?php echo base_url('StockBarang/get_data'); ?>",
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
        "name": "Nomor Faktur",
        "width" : "40%",
        "class" : "text-start",
        "render": function(data, type, full, meta) {

          return `<a href="<?= base_url(); ?>StockBarang/detail/${data.id}">${data.no_faktur}</a>`;
        }
      },
      {
        "data": "tgl_faktur", 
        "name": "Tanggal Faktur",
        "width" : "20%",
        "class" : "text-center"
      },
      {
        "data": null, 
        "name": "Jumlah Transaksi",
        "width" : "20%",
        "class" : "text-end",
        "orderable": false,
        "render": function(data, type, full, meta) {

          return formatAngka(data.total_hargaX);
        }
      },
      {
        "data": null, 
        "name": "Dokumen Faktur",
        "width" : "30%",
        "class" : "text-center",
        "render": function(data, type, full, meta) {

          if (data.dok_faktur != null) {
            return jumlah_barang = `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.dok_faktur+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`;
          }

        },
        "orderable": false,
      },
      {
        "data": null, 
        "name": "Dokumen SPM",
        "width" : "30%",
        "class" : "text-center",
        "render": function(data, type, full, meta) {
          if (data.dok_spm != null) {
            return jumlah_barang = `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.dok_spm+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`;
          }
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
          actions = (prive == '4') ? '<button class="btn btn-icon btn-sm btn-warning m-1" onclick="editData(' + row.id + ')"><i class="fa-solid fa-pen-to-square"></i></button><button class="btn btn-icon btn-sm btn-danger m-1" onclick="deleteFunction(' + row.id + ')"><i class="fa-solid fa-trash"></i></button>' : '';
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


    function formatAngka(angka) {
      return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    let dataTanggal = new Litepicker({
      element: document.getElementById('tanggalX'),
      buttonText: {
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
      },
      format: "MM/DD/YYYY"
    }),

    tglFakturEdit = new Litepicker({
      element: document.getElementById('tglFakturEdit'),
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