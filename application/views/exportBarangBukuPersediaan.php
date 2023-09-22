<div class="page-body">
  <div class="container-xl">
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom py-3">

          <h1 class="card-title text-center mt-3" style="font-size: 20px;"><b>EXPORT DATA</b></h1>
          <h1 class="card-title text-center" style="margin-top:-10px; font-size: 20px;"><b>LAPORAN DATA BUKU PERSEDIAAN</b></h1>

          <?= $this->session->flashdata('psn'); ?>
          <form action="<?= base_url(); ?>BukuPersediaan/exportPersediaan" method="POST" style="margin-top:50px;">
            <div class="form-group mb-3 row">
              <label class="form-label col-3 col-form-label">Pilih Bulan :</label>
              <div class="col-2">
                <select class="form-select" name="tgl" required>
                  <option value="" selected disabled>-- Pilih Bulan --</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
            </div>
            <div class="form-footer col-5 text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>