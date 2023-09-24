<div class="page-body">
  <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-12">
        <div class="row row-cards">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="bg-primary text-white avatar">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                   </span>
                 </div>
                 <div class="col">
                  <div class="text-muted">
                    <?= $jns_barang->jml_barang; ?> Jenis Barang
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="avatar text-white bg-red">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                  </span>
                </div>
                <div class="col">
                  <div class="text-muted">
                    <?= $blm_review->jml_permohonan; ?> Permintaan Barang Belum Review
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-twitter text-white avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                  </span>
                </div>
                <div class="col">
                  <div class="text-muted">
                    <?= $terreview->jml; ?> Permintaan Barang direview
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="avatar text-white bg-green"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                 </span>
               </div>
               <div class="col">
                <div class="text-muted">
                 Rp. <?= number_format($sisaSaldo->saldo,0,',','.'); ?> Saldo
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="col-12">
  <div class="card">
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable table-bordered text-center">
        <thead>
          <tr>
            <th class="w-1">No.</th>
            <th>Nama Pemohon</th>
            <th>Tanggal Pengajuan</th>
            <th>Status Riview</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($datatable as $key => $val) { ?>
            <tr>
              <td><?= $no; ?>.</td>
              <td>
                <?= $val->username_pemohon; ?>
              </td>
              <td>
                <?= $val->tgl_pengajuan; ?>
              </td>
              <td>
                <?php if ($val->status_review == 0) { ?>
                  <span class="badge bg-danger me-1"></span> Belum direview
                <?php }else{ ?>
                  <span class="badge bg-success me-1"></span> Terreview
                <?php } ?>
              </td>
            </tr>
            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>