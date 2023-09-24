<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LAPORAN BARANG PERSEDIAAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Menempatkan elemen ke atas halaman */
            width: 105%;
            margin-left: -12px;
        }

        .table-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        table.info-table {
            width: 45%; /* Lebar tabel informasi */
            font-weight: bold;
            padding-top: 5px;
            font-size: 12px;
            border-collapse: collapse;
        }

        table.info-table td {
            border: none;
            padding: 2px;
            text-align: left;
        }

        table.info-table .label {
            text-align: left;
            padding-right: 2px; /* Jarak antara teks label dan tanda ":" */
        }

        table.info-table .separator {
            padding: 0; /* Hapus padding pada separator */
        }

        table.info-table .value {
            text-align: left;
        }

        table.data-table {
            width: 105%;
            margin-left: -12px;
            border-collapse: collapse;
            margin: 0 auto;
            margin-top: 20px; /* Jarak dari atas tabel data */
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .smallTable {
            float: left;
            width: 15%;
            margin-right: 0px;
        }

        .smallTable th,
        .smallTable td {
            border: 0px solid black;
            padding: 1px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            border-collapse: collapse;
        }

        .tableContentKecil {
            border-collapse: collapse;
            width: 25%;
        }

        .tableContentKecil2 {
            border-collapse: collapse;
            width: 30%;
        }


        .smallTableRight {
            float: left;
            width: 25%;
            margin-left: 0px;
        }

        .smallTableRight th,
        .smallTableRight td {
            border: 0px solid black;
            padding: 1px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            border-collapse: collapse;
        }

        .tableContentTengah {
            border-collapse: collapse;
            width: 70%;
        }

        .smallTable3 {
            float: right;
            width: 25%;
            margin-left: 0px;
            margin-top: -15px;
        }

        .smallTable3 th,
        .smallTable3 td {
            border: 0px solid black;
            padding: 1px;
            text-align: left;
            font-size: 11px;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="judul">
        LAPORAN BARANG PERSEDIAAN<br>
        UNTUK PERIODE YANG BERAKHIR <?= $maksHari; ?> <?= $Bulan; ?> <?= $tahun; ?>
    </div>

    <br>
    <div class="container">
        <!-- Tabel kecil 1 -->
        <table class="smallTable tableContentKecil">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>UAPB</td>
                <td>:</td>
                <td>033</td>
            </tr>
            <tr>
                <td>UAKPB</td>
                <td>:</td>
                <td>505101</td>
            </tr>
        </table>
        <!-- End Tabel kecil 1 -->

        <!-- Tabel kecil 2 -->
        <table class="smallTableRight tableContentTengah">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</td>
            </tr>
            <tr>
                <td>DIREKTORAT JENDRAL CIPTA KARYA</td>
            </tr>
        </table>
        <!-- End Tabel kecil 2 -->

        <!-- Tabel kecil 3 -->
        <table class="smallTable3 tableContentKecil2">
            <tr>
                <td>Tgl data</td>
                <td>: <?= $hari; ?>/<?= $bulanAngka; ?>/<?= $tahun; ?> <?= $jamMenit; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= $hari; ?>/<?= $bulanAngka; ?>/<?= $tahun; ?> <?= $jamMenit; ?></td>
            </tr>
            <tr>
                <td>Halaman</td>
                <td>: 1</td>
            </tr>
            <tr>
                <td>Kode Lap</td>
                <td>: lap_bmn_sedia_satker</td>
            </tr>
        </table>
        <!-- End Tabel kecil 3 -->

    </div>
    <br><br>
    <!-- Tabel Utama -->
    <table class="data-table" style="margin-left: -2%;">
        <thead style=" font-size: 14px;">
            <tr>
                <th style="width: 15%;">Kode</th>
                <th style="width:60%;">Uraian</th>
                <th style="width: 25%;">Jumlah</th>
            </tr>
        </thead>
        <tbody style=" font-size: 12px;">
            <tr>
                <td><b>117111</b></td>
                <td style="text-align: left;" colspan="2"><b>Barang Konsumsi</b></td>
            </tr>
            <?php $tot=0; foreach ($datatable as $key => $val) { ?>
                <tr>
                    <td><?= $val->id_kategori_barang.$val->id_satuan.$val->id_kondisi_barang; ?></td>
                    <td style="text-align: left;"><?= $val->nama_barang; ?></td>
                    <td style="text-align: right;"><?= number_format($val->total_harga,0,',','.'); ?></td>
                </tr>

                <?php 

                $tot += $val->total_harga; 

                ?>
            <?php } ?>
            <tr>
                <td style="text-align: center;" colspan="2"><b>Jumlah Barang Konsumsi</b></td>
                <td><b><?= number_format($tot,0,',','.'); ?></b></td>
            </tr>
            <tr style="font-size: 14px;">
                <td style="text-align: center;" colspan="2"><b>TOTAL</b></td>
                <td><b><?= number_format($tot,0,',','.'); ?></b></td>
            </tr>
        </tbody>
    </table>
    <!-- End Tabel Utama -->
    <div style="margin-top: 5px; margin-bottom: 10px; margin-left: -13px;">Keterangan :</div>
    <div style="margin-bottom: 10px; margin-left: -13px;">1. Persediaan senilai Rp.                        0 dalam kondisi rusak.</div>
    <div style="margin-bottom: 10px; margin-left: -13px;">2. Persediaan senilai Rp.                        0 dalam kondisi usang.</div>
</body>
</html>
