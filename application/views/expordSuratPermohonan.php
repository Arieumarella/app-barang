<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Export Surat Permohonan Barang</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
    }

    .logo {
      text-align: center;
      margin: 0 auto;
      margin-top: -40px;
    }

    .imgLogo {
      width: 112%;
      height: 11%;
    }

    .judul {
      text-align: center;
      margin-top: 5px;
      font-size: 10px;
    }

    .alamat {
      text-align: center;
      margin-top: 20px;
    }

    .pemohon {
      text-align: center;
      margin-top: 20px;
    }

    .keterangan {
      text-align: center;
      margin-top: 20px;
    }

    table {
      width: 95%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 9px;
    }

    .noborder-table {
      border-collapse: separate;
      border-spacing: 0;
      width: 50%;
      margin-left: 3%;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .noborder-table td, .noborder-table th {
      border:  none;
      padding: 5px;
      font-size: 14px;
    }


    /* CSS untuk memusatkan tabel utama */
    .center-table {
      margin: 0 auto;
    }

    /* CSS untuk kolom tanda tangan */
    .tanda-tangan {
      float: right;
      margin-top: 35px;
      width: 30%;
      font-size: 14px;
      margin-right: 30px;
    }

    .tanda-tangan table {
      border: 0; /* Menghapus border pada tabel tanda tangan */
      padding: 0; /* Menghapus padding */
      margin: 0; /* Menghapus margin */
      text-align: center;
      width: 90%;
    }

    .tanda-tangan td, .tanda-tangan th {
      border:  none;
    }

    .tanda-tangan td {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="<?= base_url(); ?>assets/img/kop header.jpg" class="imgLogo" alt="Logo">
    </div>
    <div class="judul">
      <h1>BON PERMINTAAN BARANG</h1>
    </div>
  </header>
  <main>
    <!-- Tabel Baru -->
    <table class="noborder-table">
      <tbody>
        <tr>
          <td>Nama Pemohon</td>
          <td>:</td>
          <td><?= $dataMaster->nmPemohon; ?></td>
        </tr>
        <tr>
          <td>NIP</td>
          <td>:</td>
          <td><?= $dataMaster->nip; ?></td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td><?= $dataMaster->jbt; ?></td>
        </tr>
        <tr>
          <td>Subbagian/PPK</td>
          <td>:</td>
          <td><?= $dataMaster->ppk; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td><?= $dataMaster->tgl_pengajuan; ?></td>
        </tr>
      </tbody>
    </table>
    <!-- End Tabel Baru -->
    <br>
    <!-- Tabel Utama (di tengah halaman) -->
    <table class="center-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Volume</th>
          <th>Satuan</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach ($dataBody as $key => $value) { ?>
          <tr>
            <td style="text-align:center;"><?= $no; ?>.</td>
            <td><?= $value->nama_barang; ?></td>
            <td style="text-align:center;"><?= $value->jml_barang; ?></td>
            <td><?= $value->nama_satuan; ?></td>
            <td>-</td>
          </tr>
          <?php $no++; } ?>
        </tbody>
        <!-- End Tabel Utama -->
      </table>
      <!-- Tabel Tanda Tangan -->
      <div class="tanda-tangan">
        <table>
          <tr>
            <td style="font-size: 14px;">Pemohon <br><br><br><br><br></td>
          </tr>
          <tr>
            <td style="font-size: 14px;"><?= $dataMaster->nmPemohon; ?></td>
          </tr>
        </table>
      </div>
      <!-- End Tabel Tanda Tangan -->
    </main>
  </body>
  </html>