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



    <script>
      $(document).ready(function() {

        let prive = '<?= $this->session->userdata('roll'); ?>';


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