<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Detail Permohonan barang <br><button class="btn btn-sm btn-primary"><?= $dataMaster->username_pemohon; ?> - <?= $dataMaster->tgl_pengajuan; ?></button></h3><br>
          <h3 class="card-title"></h3>
          <a href="<?= base_url(); ?>PermohonanBarang" class="btn btn-secondary ms-auto "><i class="fa-solid fa-arrow-rotate-left" style="margin-right: 5px;"></i> Kembali</a>
        </div>
        <div class="card-body border-bottom py-3">
          <?= $this->session->flashdata('psn'); ?>

          <?php if ($this->session->userdata('roll') != '3' ) { ?>

            <table id="tPengajuanBarang" class="table table-bordered">
              <thead class="text-center">
                <tr>
                  <th>No</th>
                  <th>Jenis Barang</th>
                  <th>Jumlah Barang <br> Diminta</th>
                  <th>Status <br> Approval</th>
                  <th>Jumlah Baraang <br> Approve</th>
                  <th>Catatan <br> Kasubagg TU</th>
                  <th style="width:5%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($dataRekap as $key => $val) { ?>
                  <tr>
                    <td class="text-center" style="width: 1%;"><?= $no; ?></td>
                    <td class="text-start" style="width: 10%;"><?= $val->nama_barang; ?></td>
                    <td class="text-end" style="width: 10%;"><?= $val->jml_barang; ?></td>
                    <td class="text-center" style="width: 10%;">
                      <?php if ($val->sts_approval == '0') { ?>
                        <span class="badge rounded-pill bg-warning" style="color: black;"><b>Panding</b></span>
                      <?php }elseif ($val->sts_approval == '1') { ?>
                        <span class="badge rounded-pill bg-success" style="color: black;"><b>Approve</b></span>
                      <?php }else{ ?>
                        <span class="badge rounded-pill bg-danger" style="color: black;"><b>Reject</b></span>
                      <?php } ?> 
                    </td>
                    <td class="text-end" style="width: 10%;"><?= $val->jml_barang_approve; ?></td>
                    <td class="text-end" style="width: 15%;"><?= $val->catatan; ?></td>
                    <td class="text-center">
                      <?php 

                      $disabled = ($val->sts_approval != '0') ? 'disabled':'';

                      ?>
                      <button class="btn btn-warning btn-icon" onclick="editData('<?= $val->id; ?>', '<?= $val->id_jns_barang; ?>', '<?= $val->jml_barang; ?>');" <?= $disabled; ?>><i class="fa-solid fa-file-pen"></i></button>
                      <button class="btn btn-danger btn-icon" onclick="deleteData('<?= $val->id; ?>', '<?= $val->id_jns_barang; ?>');" <?= $disabled; ?>><i class="fa-solid fa-trash"></i></button>

                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>

            <?php }else{ ?>


              <table id="tPengajuanBarang" class="table table-bordered">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Jenis Barang</th>
                    <th>Jumlah Barang <br> Diminta</th>
                    <th>Jumlah Stock Barang <br> Saat Ini</th>
                    <th>Status <br> Approval</th>
                    <th>Jumlah Baraang <br> Approve</th>
                    <th>Catatan <br> Kasubagg TU</th>
                  </tr>
                </thead>
                <tbody>
                  <form action="<?= base_url(); ?>PermohonanBarang/simpanApprove" method="POST" id="formSubmit">
                    <input type="hidden" name="idMaster" value="<?= $idMaster; ?>">
                    <?php $no=1; foreach ($dataRekap as $key => $val) { ?>
                      <input type="hidden" name="idDetail[]" value="<?= $val->id; ?>">
                      <tr>
                        <td class="text-center" style="width: 1%;"><?= $no; ?></td>
                        <td class="text-start" style="width: 10%;"><?= $val->nama_barang; ?></td>
                        <td class="text-end" style="width: 10%;"><?= $val->jml_barang; ?></td>
                        <td class="text-end" style="width: 10%;"><?= $val->stock_barangX; ?></td>
                        <td class="text-center" style="width: 10%;">

                          <select class="form-select form-select text-center" name="sts_aprroval[]" required>
                            <option value="0" <?= $val->sts_approval == '0' ? 'selected':''; ?>><b>Panding</b></option>
                            <option value="1" <?= $val->sts_approval == '1' ? 'selected':''; ?>><b>Approve</b></option>
                            <option value="2" <?= $val->sts_approval == '2' ? 'selected':''; ?>><b>Reject</b></option>
                          </select>

                        </td>
                        <td class="text-end" style="width: 10%;">
                          <input type="number" class="form-control " name="jml_barang[]" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= $val->jml_barang_approve; ?>" max="<?= $val->jml_barang; ?>" required>
                          <input type="hidden" name="id_jns_barang[]" value="<?= $val->id_jns_barang; ?>">
                        </td>
                        <td class="text-end" style="width: 15%;">
                          <textarea class="form-control" name="catatan[]"  style="width: 100%; box-sizing: border-box;" required><?= $val->catatan; ?></textarea>
                        </td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>

                  <div class=" text-end mt-4 mb-2">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                  </div>

                </form> 
              <?php } ?>
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
            <form action="<?= base_url(); ?>PermohonanBarang/simpanPermintaanEdit" method="POST">
              <input type="hidden" name="idEdit" id="idEdit">
              <input type="hidden" name="idDetail" value="<?= $idMaster; ?>">
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
                    <label class="form-label">Jumlah Stock Barang Yang Ada</label>
                    <input type="text" class="form-control" id="stock_barang" placeholder="Pilih Jenis Barang Terlebih Dahulu" disabled>
                  </div>
                  <div class="mb-3 col-12">
                    <label class="form-label">Jumlah Barang</label>
                    <input type="text" class="form-control" name="jml_barang" id="jml_barang" placeholder="Input Jumlah Barang" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
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


        editData = function (id, id_jns_barang, jml_barang) {    
          $('#idEdit').val(id);
          $('#jns_barang').val(id_jns_barang);
          $('#jml_barang').val(jml_barang);

          ajaxUntukSemua(base_url()+'PermohonanBarang/getSockBarangById', {id:id_jns_barang}, function(data) {

           $('#stock_barang').val(data.jml_stock);

         }, 
         function(error) {
          console.log('Kesalahan:', error);
          t_error('Sistem Error, Pesan : '+error)
        });


          $('#modalEdit').modal('show');
        }


        $("#jns_barang").change(function() {
          let val = $(this).val();
          
          ajaxUntukSemua(base_url()+'PermohonanBarang/getSockBarangById', {id:val}, function(data) {

           $('#stock_barang').val(data.jml_stock);

         }, 
         function(error) {
          console.log('Kesalahan:', error);
          t_error('Sistem Error, Pesan : '+error)
        });



        });


        deleteData = function (id, id_jns_barang) {

          Swal.fire({
            title: 'Konfirmasi Hapus Data',
            text: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              ajaxUntukSemua(base_url()+'PermohonanBarang/deleteDataDetail', {id}, function(data) {

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


        $('#formSubmit').submit(async function (event) {
          event.preventDefault();

          let id_jns_barang = $('input[name="id_jns_barang[]"]').map(function () {
            return $(this).val();
          }).get(),

          jml_barang = $('input[name="jml_barang[]"]').map(function () {
            return $(this).val();
          }).get(),

          sts_aprroval = $('select[name="sts_aprroval[]"]').map(function () {
            return $(this).val();
          }).get(),

          kondisi = 0;

          for (var i = 0; i < id_jns_barang.length; i++) {
            let id_jns_barangX = id_jns_barang[i],
            jml_barangX = jml_barang[i],
            sts_aprrovalX = sts_aprroval[i];

            if (sts_aprrovalX == '1') {
              try {
                const data = await $.ajax({
                  url: '<?= base_url(); ?>PermohonanBarang/getDataStockBarang',
                  type: 'POST',
                  dataType: 'JSON',
                  data: { id_jns_barangX }
                });

                if (parseInt(jml_barangX) > parseInt(data.jml_stock)) {
                  kondisi = 1;
                }
              } catch (error) {
                console.error(error);
                t_error('Ada yang error dengan Pesan: ' + error);
              }
            }
          }

          if (kondisi == 1) {
            t_error('Ada barang yang Approve melebihi jumlah Stock Barang!');
            return false;
          } else {
            $('#formSubmit').unbind('submit').submit();
          }
        });




      });
    </script>