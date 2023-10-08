<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Export BAST</title>
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

    .noborder-table2 {
      float: right;
      border-collapse: separate;
      border-spacing: 0;
      width: 45%;
      margin-left: 0%;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .noborder-table2 td, .noborder-table2 th {
      border: none;
      padding: 0px;
      font-size: 12px;
    }


    /* CSS untuk memusatkan tabel utama */
    .center-table2 {
      margin: 0 auto;
    }

    /* CSS untuk kolom tanda tangan */
    .tanda-tangan {
      float: right;
      margin-top: 35px;
      width: 30%;
      font-size: 15px;
      margin-right: 50px;
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
      font-size: 15px;
    }

    /* CSS untuk kolom tanda KIRI */
    .tanda-tangan-kiri {
      float: left;
      margin-top: 35px;
      width: 30%;
      font-size: 15px;
      margin-left: 90px;
    }

    .tanda-tangan-kiri table {
      border: 0; /* Menghapus border pada tabel tanda tangan */
      padding: 0; /* Menghapus padding */
      margin: 0; /* Menghapus margin */
      text-align: center;
      width: 90%;
    }

    .tanda-tangan-kiri td, .tanda-tangan-kiri th {
      border:  none;
    }

    .tanda-tangan-kiri td {
      font-size: 15px;
    }
  </style>
</head>
<body>
  <main>
    <!-- Tabel Baru -->
    <table class="noborder-table2">
      <tbody>
        <tr>
          <td colspan="3">Lampiran Berita Acara Serah Terima Barang Persediaan</td>
        </tr>
        <tr>
          <td style="width:25%;">Nomor</td>
          <td style="width:5%;">:</td>
          <td ><?= $dataMaster->noSurat; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td><?= $dataMaster->tgl_pengajuan; ?></td>
        </tr>
      </tbody>
    </table>
    <!-- End Tabel Baru -->
    <br><br><br><br><br>
    <!-- Tabel Utama (di tengah halaman) -->
    <table class="center-table2">
      <thead>
        <tr>
          <th>No</th>
          <th>URAIAN</th>
          <th>KONDISI <br> BARANG</th>
          <th>HARGA <br> PROLEHAN</th>
          <th>JUMLAH <br> UNIT</th>
          <th>KETERANGAN</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach ($dataBody as $key => $value) { ?>
        <tr>
          <td style="text-align:center;"><?= $no; ?>.</td>
          <td><?= $value->nama_barang; ?></td>
          <td style="text-align:center;"><?= $value->kondisi_barang; ?></td>
          <td><?= number_format($value->total_harga,0,',','.'); ?></td>
          <td><?= $value->jml_barang; ?></td>
          <td>-</td>
        </tr>
        <?php $no++; } ?>
      </tbody>
      <!-- End Tabel Utama -->
    </table>
    <!-- Tabel Tanda Tangan -->
    <div class="tanda-tangan-kiri">
      <table>
        <tr>
          <td style="font-size: 14px;">PIHAK PERTAMA <br><br><br><br><br></td>
        </tr>
        <tr>
          <td style="font-size: 14px;"><?= $dataMaster->pihak1; ?></td>
        </tr>
      </table>
    </div>
    <!-- End Tabel Tanda Tangan -->

    <!-- Tabel Tanda Tangan -->
    <div class="tanda-tangan">
      <table>
        <tr>
          <td style="font-size: 14px;">PIHAK KEDUA <br><br><br><br><br></td></td>
        </tr>
        <tr>
          <td style="font-size: 14px;"><?= $dataMaster->pihak2; ?></td>
        </tr>
      </table>
    </div>
    <!-- End Tabel Tanda Tangan -->
  </main>
</body>
</html>