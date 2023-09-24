<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template Landscape</title>
    <style>
        @page {
            size: landscape;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Menghapus margin default */
            padding: 0; /* Menghapus padding default */
            margin-left: 0px; /* Margin kiri */
            margin-right: 0px; /* Margin kanan */
        }
        .center {
            text-align: center;
            text-transform: uppercase;
            font-size: 18px;
        }
        .center2 {
            text-align: center;
            text-transform: uppercase;
            font-size: 12px;
            margin-top: -5px;
        }
        table {
            width: 105%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: -25px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }


        .tulisanBiasa {
            font-size: 10px;
            margin-top: 5px;
            margin-left: -25px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Menempatkan elemen ke atas halaman */
            width: 105%;
            margin-left: 0px;
        }

        .smallTable {
            float: left;
            width: 15%;
            margin-right: 20px;
        }

        .smallTable th,
        .smallTable td {
            border: 0px solid black;
            padding: 1px;
            text-align: left;
            font-size: 10px;
/*            font-weight: bold;*/
border-collapse: collapse;
}


.smallTable9 {
    float: left;
    width: 15%;
    margin-right: 20px;
}

.smallTable9 th,
.smallTable9 td {
    border: 0px solid black;
    padding: 1px;
    text-align: left;
    font-size: 10px;
/*            font-weight: bold;*/
border-collapse: collapse;
}

.tableContentKecil {
    border-collapse: collapse;
    width: 35%;
}

.tableContentKecil9 {
    border-collapse: collapse;
    width: 20%;
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
    font-size: 10px;
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
    margin-top: 5px;
}

.smallTable3 th,
.smallTable3 td {
    border: 0px solid black;
    padding: 1px;
    text-align: left;
    font-size: 10px;
    border-collapse: collapse;
}

.tableContentKecil2 {
    border-collapse: collapse;
    width: 30%;
}

</style>
</head>
<body>
    <div class="tulisanBiasa">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</div>
    <div class="tulisanBiasa">SEKRETARIAT JENDERAL</div>
    <div class="tulisanBiasa">SATKER KONSOLIDASI KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</div>
    <br>
    <h1 class="center">buku persediaan</h1>
    <h1 class="center2"> PERIODE 01-<?= $bulanAngka; ?>-<?= $tahun; ?> S/D <?= $maksHari; ?>-<?= $bulanAngka; ?>-<?= $tahun; ?></h1>

    <div class="container">

        <!-- Tabel kecil 1 -->
        <table class="smallTable tableContentKecil">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>NAMA UAKPB</td>
                <td>:</td>
                <td>PUSAT FASILITASI INFRASTRUKTUR DAERAH</td>
            </tr>
            <tr>
                <td>KODE UAKPB</td>
                <td>:</td>
                <td>033.01.0199.631088</td>
            </tr>
        </table>
        <!-- End Tabel kecil 1 -->
        <br><br><br>


        <!-- Tabel kecil 1 -->
        <table class="smallTable9 tableContentKecil9">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>METODE PENCATATAN</td>
                <td>:</td>
                <td>PERPETUAL</td>
            </tr>
            <tr>
                <td>METODE PENILAIAN</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
        <!-- End Tabel kecil 1 -->

        <!-- Tabel kecil 3 -->
        <table class="smallTable3 tableContentKecil2">
            <tr>
                <td>KODE BARANG</td>
                <td>: <?= $dataBarang->id_barang_custom; ?></td>
            </tr>
            <tr>
                <td>NAMA BARANG</td>
                <td>: <?= ucwords($dataBarang->nama_barang); ?></td>
            </tr>
            <tr>
                <td>SATUAN</td>
                <td>: <?= ucwords($dataBarang->nama_satuan); ?></td>
            </tr>
        </table>
        <!-- End Tabel kecil 3 -->

    </div>
    <br><br>
    <table>
        <thead>
            <tr style="font-size: 10px; font-weight: normal;">
                <th rowspan="2" style="width:2%;">No</th>
                <th rowspan="2" style="width:8%;">Tanggal</th>
                <th rowspan="2" style="width:15%;">Keterangan</th>
                <th colspan="3" style="width: 15%;">Masuk</th>
                <th colspan="3" style="width: 15%;">Keluar</th>
                <th colspan="3" style="width: 15%;">Saldo Persediaan</th>
            </tr>
            <tr style="font-size: 10px; font-weight: normal;">
                <th>Unit</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody style="font-size:11px; text-align: right;">
            <tr>
                <td style="text-align:center;">1.</td>
                <td style="text-align:center;"></td>
                <td style="text-align:left;">Saldo Awal <?= $awalTanggal; ?>-<?= $Bulan; ?>-<?= $tahun; ?></td>
                <td>0</td>
                <td></td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td>0</td>
                <td><?= $dataTabelAwal->jml_stok_barang; ?></td>
                <td></td>
                <td><?= number_format($dataTabelAwal->total_saldo_awal,0,',','.'); ?></td>
            </tr>

            <?php 
            $unit_persediaan= $dataTabelAwal->jml_stok_barang;
            $total_saldo_akhir= $dataTabelAwal->total_saldo_awal;
            $totBarangMasuk=0;
            $totBarangKeluar=0;
            ?>

            <?php $no=2; foreach ($datatable as $key => $val) { ?>
                <?php 

                if ($val->jns_barang == 'Barang Masuk') {
                    $unit_persediaan += $val->jml_barang_masuk;
                    $total_saldo_akhir += $val->total_harga_barang;
                }else{
                    $unit_persediaan -= $val->jml_barang_keluar;
                    $total_saldo_akhir -= $val->total_harga_barang_keluar;  
                }

                $totBarangMasuk+= (float)$val->jml_barang_masuk;
                $totBarangKeluar += (float)$val->jml_barang_keluar;

                ?>

                <tr>
                    <td style="text-align:center;"><?= $no; ?>.</td>
                    <td style="text-align:center;"><?= $val->tanggal; ?></td>
                    <td style="text-align:left;"><?= $val->jns_barang ?> <?= $val->tanggal; ?></td>
                    <td><?= $val->jml_barang_masuk; ?></td>
                    <td><?= number_format(($val->harga_satuan_barang_masuk == null) ? 0:$val->harga_satuan_barang_masuk,0,',','.'); ?></td>
                    <td><?= number_format(($val->total_harga_barang== null) ? 0 :$val->total_harga_barang,0,',','.'); ?></td>
                    <td><?= $val->jml_barang_keluar; ?></td>
                    <td><?= number_format(($val->harga_satuan_barang_keluar == null ) ? 0:$val->harga_satuan_barang_keluar,0,',','.'); ?></td>
                    <td><?= number_format(($val->total_harga_barang_keluar == null) ? 0:$val->total_harga_barang_keluar,0,',','.'); ?></td>

                    <td><?= $unit_persediaan; ?></td>
                    <td></td>
                    <td><?= number_format(($total_saldo_akhir == null ) ? 0: $total_saldo_akhir,0,',','.'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot style="font-size:11px;">
            <tr>
                <td colspan="3" style="text-align: right;">Jumlah</td>
                <td colspan="3" style="text-align: center;"><?= $totBarangMasuk; ?></td>
                <td colspan="3" style="text-align: center;"><?= $totBarangKeluar;  ?></td>
                <td style="text-align: right;"><?= $unit_persediaan;  ?></td>
                <td style="text-align: right;">0</td>
                <td style="text-align: right;"><?= number_format(($total_saldo_akhir == null ) ? 0: $total_saldo_akhir,0,',','.'); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>