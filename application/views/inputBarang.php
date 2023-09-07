<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Barang Masuk</h3>
          <button class="btn btn-primary ms-auto " onclick="showModalTambah();"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Data</button>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="tPengajuanBarang" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah Barang Masuk</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Dokumen Faktur</th>
                <th>Dokumen SPM</th>
                <th>Dokumen SP2D</th>
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
              <label class="form-label">Jenis Barang</label>
              <select class="form-select" name="jns_barang" id="jns_barang" required>
                <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
                <?php foreach ($dataJnsBarang as $key => $value) { ?>
                  <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Nama Barang</label>
              <input type="text" class="form-control" name="namaKategoriBarang" placeholder="Input Nama Barang" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Kondisi Barang</label>
              <select class="form-select" name="kon_barang" id="kon_barang" required>
                <option value="" selected disabled>--- Pilih Kondisi Barang ---</option>
                <?php foreach ($datakondisi as $key => $value) { ?>
                  <option value="<?= $value->id; ?>"><?= $value->kondisi_barang; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Jumlah Barang</label>
              <input type="text" class="form-control" name="jml_barang" id="jml_barang" placeholder="Input Jumlah Barang" oninput="setTotHarga(); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Harga Satuan</label>
              <input type="text" class="form-control" name="hrg_satuan" id="hrg_satuan" placeholder="Input Harga Satuan" oninput="setTotHarga(); this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Total Harga</label>
              <input type="text" class="form-control" name="tot_harga" id="tot_harga"  disabled>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Nomor Bukti</label>
              <input type="text" class="form-control" name="noBukti" placeholder="Input Nomor Bukti" required>
            </div>
            <div class="mb-3 col-6">
              <label class="form-label">Tanggal Bukti</label>
              <input type="text" class="form-control" name="tglMasuk" placeholder="Tanggal Bukti Barang Masuk" id="tanggalX" required>
              <span class="input-icon-addon mb-5" style="margin-right: 10px;">
              </div>
              <div class="col-6">
                <div class="mb-3 col-12">
                  <div class="form-label">Dokumen Faktur</div>
                  <input type="file" class="form-control" name="faktur" required>
                </div>
                <div class="mb-3 col-12">
                  <div class="form-label">Dokumen SPM</div>
                  <input type="file" class="form-control" name="SPM" required>
                </div>
                <div class="mb-3 col-12">
                  <div class="form-label">Dokumen SP2D</div>
                  <input type="file" class="form-control" name="SP2D" required>
                </div>
              </div>
              <div class="mb-3 col-12">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" data-bs-toggle="autosize" name="catatan" placeholder="Input Catatan" style="height: 150px;" required></textarea>
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
                <?php foreach ($datakondisi as $key => $value) { ?>
                  <option value="<?= $value->id; ?>"></option>
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
          "data": "nama_barang", 
          "name": "nama barang",
          "width" : "30%",
          "class" : "text-center"
        },
        {
          "data": "jns_barang", 
          "name": "Jenis Barang",
          "width" : "30%",
          "class" : "text-center"
        },
        {
          "data": "stok_barang_masuk", 
          "name": "jumlah barang masuk",
          "width" : "30%",
          "class" : "text-center"
        },
        {
          "data": "harga_satuan", 
          "name": "harga satuan",
          "width" : "30%",
          "class" : "text-center"
        },
        {
          "data": null, 
          "name": "total harga",
          "width" : "30%",
          "class" : "text-center",
          "render": function(data, type, full, meta) {
            let jumlah_barang = data.stok_barang_masuk,
            harga_satuan = data.harga_satuan,
            total_harga = jumlah_barang * harga_satuan;
            return total_harga;
          },
          "orderable": false,
        },
        {
          "data": null, 
          "name": "Dokumen Faktur",
          "width" : "30%",
          "class" : "text-center",
          "render": function(data, type, full, meta) {
            return jumlah_barang = `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.path_faktur+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`;
          },
          "orderable": false,
        },
        {
          "data": null, 
          "name": "Dokumen SPM",
          "width" : "30%",
          "class" : "text-center",
          "render": function(data, type, full, meta) {
            return jumlah_barang = `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.path_spm+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`;
          },
          "orderable": false,
        },
        {
          "data": null, 
          "name": "Dokumen SP2D",
          "width" : "30%",
          "class" : "text-center",
          "render": function(data, type, full, meta) {
            return jumlah_barang = `<button class="btn btn-danger btn-icon" onclick="showPdf('`+data.path_sp2d+`')"><i class="fa-solid fa-file-pdf fa-lg"></i></button>`;
          },
          "orderable": false,
        },        
        {
          "data": null,
          "width" : "8%",
          "class" : "text-center",
          "orderable": false,
          "render": function (data, type, row) {
            var actions = '';
            actions += '<button class="btn btn-icon btn-sm btn-danger m-1" onclick="deleteFunction(' + row.id + ')"><i class="fa-solid fa-trash"></i></button>';
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