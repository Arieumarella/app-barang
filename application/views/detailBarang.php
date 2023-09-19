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
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($datakondisi as $key => $val) { ?>
                <tr>
                  <td class="text-center" style="width: 1%;"><?= $no; ?></td>
                  <td class="text-start" style="width: 10%;"><?= $val->jns_barang; ?></td>
                  <td class="text-start" style="width: 10%;"><?= $val->nama_barang; ?></td>
                  <td class="text-end" style="width: 10%;"><?= $val->jml_barang; ?></td>
                  <td class="text-end" style="width: 10%;"><?= $val->harga_satuan; ?></td>
                  <td class="text-end" style="width: 10%;"><?= $val->harga_satuan*$val->jml_barang; ?></td>
                </tr>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script>
    $(document).ready(function() {

      let prive = '<?= $this->session->userdata('roll'); ?>';


    });
  </script>