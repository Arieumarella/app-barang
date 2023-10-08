<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Export BAST</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 15px;
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
      margin-top: 7px;
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
      width: 60%;
      margin-left: 8%;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .noborder-table td, .noborder-table th {
      border:  none;
      padding: 5px;
      font-size: 15px;
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

    p {
      line-height: 1.5;
      text-align: justify;
      font-size: 15px;
      margin-top: 4px;
      margin-right: 4px;
      margin-bottom: 3px;
      margin-left: 3px;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="<?= base_url(); ?>assets/img/kop header.jpg" class="imgLogo" alt="Logo">
    </div>
    <div class="judul">
      <h1 style=" font-weight: normal; font-size: 13px;">BERITA ACARA SERAH TERIMA BARANG</h1>
      <h1 style=" font-weight: normal; font-size: 13px;">NOMOR:  <?= $dataMaster->noSurat; ?></h1>
    </div>
  </header>
  <main>
    <p>Pada hari ini Jumat tanggal 29 bulan September tahun 2023 bertempat di Yogyakarta yang
      bertanda tangan di bawah ini
    </p>
    <!-- Tabel Baru -->
    <table class="noborder-table">
      <tbody>
        <tr>
          <td style="width:1%; text-align:center;">1.</td>
          <td style="width:30%;">Nama</td>
          <td style="width:8%;">:</td>
          <td><?= $dataMaster->pihak1; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>Jabatan</td>
          <td>:</td>
          <td><?= $dataMaster->jabatan1; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>NIP</td>
          <td>:</td>
          <td><?= $dataMaster->nip1; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>Alamat</td>
          <td>:</td>
          <td><?= $dataMaster->alamat1; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td colspan="3" style="text-align:left;">Yang selanjutnya disebut sebagai PIHAK PERTAMA</td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;">2.</td>
          <td>Nama</td>
          <td>:</td>
          <td><?= $dataMaster->pihak2; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>Jabatan</td>
          <td>:</td>
          <td><?= $dataMaster->jabatan2; ?></td>
        </tr> 
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>NIP</td>
          <td>:</td>
          <td><?= $dataMaster->nip2; ?></td>
        </tr> 
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td>Alamat</td>
          <td>:</td>
          <td><?= $dataMaster->alamat2; ?></td>
        </tr>
        <tr>
          <td style="width:1%; text-align:center;"></td>
          <td colspan="3" style="text-align:left;">Yang selanjutnya disebut sebagai PIHAK KEDUA</td>
        </tr>
      </table>
      <!-- End Tabel Baru -->
      <br>
      <p>PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA telah menerima dan memeriksa
        penyerahan dari PIHAK PERTAMA barang-barang persediaan dengan perincian sebagaimana
        terlampir pada Berita Acara ini.
      </p>
      <br>
      <p>Dengan ditandatanganinya Berita Acara ini, maka segala tanggung jawab terhadap
        penyimpananan, pengamanan, dan penatausahaan barang-barang persediaan tersebut
      berada pada PIHAK KEDUA</p>
      <br>
      <p>Demikianlah Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>


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