<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Detail barang <br><button class="btn btn-sm btn-primary"><?= $dataFaktur->no_faktur; ?></button></h3><br>
          <h3 class="card-title"></h3>
          <a href="<?= base_url(); ?>StockBarang" class="btn btn-secondary ms-auto "><i class="fa-solid fa-arrow-rotate-left" style="margin-right: 5px;"></i> Kembali</a>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>
          <table id="tPengajuanBarang" class="table table-bordered">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Kategori Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Total Harga</th>
                <?php if ($this->session->userdata('roll') == '4') { ?>
                 <th>Aksi</th>
               <?php } ?>
             </tr>
           </thead>
           <tbody>
            <?php $no=1; foreach ($datakondisi as $key => $val) { ?>
              <tr>
                <td class="text-center" style="width: 1%;"><?= $no; ?></td>
                <td class="text-start" style="width: 10%;"><?= $val->jns_barang; ?></td>
                <td class="text-start" style="width: 10%;"><?= $val->nama_barang; ?></td>
                <td class="text-end" style="width: 10%;"><?= $val->jml_barang; ?></td>
                <td class="text-end" style="width: 10%;"><?= number_format($val->harga_satuan,0,',','.'); ?></td>
                <td class="text-end" style="width: 10%;"><?= number_format($val->harga_satuan*$val->jml_barang,0,',','.'); ?></td>
                <?php if ($this->session->userdata('roll') == '4') { ?>
                 <td class="text-center" style="width: 5%;">
                  <button class="btn btn-warning btn-icon" onclick="editData('<?= $val->id_faktur; ?>', '<?= $val->id_kategori_barang; ?>', '<?= $idContent; ?>');"><i class="fa-solid fa-file-pen"></i></button>
                  <button class="btn btn-danger btn-icon" onclick="deleteData('<?= $val->id_faktur; ?>','<?= $val->id_kategori_barang; ?>')"><i class="fa-solid fa-trash"></i></button>
                </td>
              <?php } ?>
            </tr>
            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Modal edit -->
<div class="modal modal-blur fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Permohonan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>StockBarang/simpanEditData" method="POST">
          <input type="hidden" name="idFaktur" id="idFaktur">
          <input type="hidden" name="idBarang" id="idBarang">
          <input type="hidden" name="idContent" value="<?= $idContent; ?>">
          <div class="row">
            <div id="contentFormPermohonan">
              <div class="mb-3 col-12" style="margin-top: -20px;">
                <label class="form-label">Jenis Barang</label>
                <select class="form-select" name="jns_barang" id="jns_barang" data-index="1" required>
                  <option value="" selected disabled>--- Pilih Jenis Barang ---</option>
                  <?php foreach ($listBarang as $key => $value) { ?>
                    <option value="<?= $value->id; ?>"><?= $value->nama_barang; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3 col-12">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Input Jumlah Barang" required>
              </div>
              <div class="mb-3 col-12">
                <label class="form-label">Jumlah Barang</label>
                <input type="text" class="form-control" name="jml_barang" id="jml_barang" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
              </div>
              <div class="mb-3 col-12">
                <label class="form-label">Harga Satuan</label>
                <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
              </div>
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
<!-- End Modal edit -->


<script>
  $(document).ready(function() {

    let prive = '<?= $this->session->userdata('roll'); ?>';


    editData = function (id_faktur, id_barang, id_content) {

      ajaxUntukSemua(base_url()+'StockBarang/getBarangDigunakan', {id_faktur, id_barang}, function(data) {

       if (data.code == 200) {

        ajaxUntukSemua(base_url()+'StockBarang/getStockBarangByFakturIdBarang', {id_faktur, id_barang}, function(data2) {          

          $('#jns_barang').val(data2.id_kategori_barang);
          $('#nama_barang').val(data2.nama_barang);
          $('#jml_barang').val(data2.jml_stok);
          $('#harga_satuan').val(data2.harga_satuan);
          $('#idFaktur').val(id_faktur);
          $('#idBarang').val(id_barang);

          $('#modalEdit').modal('show')          


        }, 
        function(error) {
          console.log('Kesalahan:', error);
          t_error('Sistem Error, Pesan : '+error)
        });

      }else{

        Swal.fire({
          icon: 'error',
          title: 'Gagal barang telah digunakan.!',
          text: data.msg,
          confirmButtonText: 'Tutup'
        });

      }



    }, 
    function(error) {
      console.log('Kesalahan:', error);
      t_error('Sistem Error, Pesan : '+error)
    });
    }



    deleteData = function (id_faktur, id_barang) {

      ajaxUntukSemua(base_url()+'StockBarang/getBarangDigunakan', {id_faktur, id_barang}, function(data) {

       if (data.code == 200) {

         Swal.fire({
          title: 'Konfirmasi Hapus Data',
          text: 'Apakah Anda yakin ingin menghapus data ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            ajaxUntukSemua(base_url()+'StockBarang/deleteDetailBarang', {id_faktur, id_barang}, function(data) {

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


      }else{

        Swal.fire({
          icon: 'error',
          title: 'Gagal barang telah digunakan.!',
          text: data.msg,
          confirmButtonText: 'Tutup'
        });

      }

    }, 
    function(error) {
      console.log('Kesalahan:', error);
      t_error('Sistem Error, Pesan : '+error)
    });



    }


  });
</script>