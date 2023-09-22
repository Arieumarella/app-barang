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
    <h1 class="center2"> PERIODE 01-08-2023 S/D 31-08-2023</h1>

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
                <td>: 1.01.03.01.001.000003</td>
            </tr>
            <tr>
                <td>NAMA BARANG</td>
                <td>: Spidol Snowan White Board</td>
            </tr>
            <tr>
                <td>SATUAN</td>
                <td>: Lusin</td>
            </tr>
        </table>
        <!-- End Tabel kecil 3 -->

    </div>
    <br><br>
    <table>
        <thead>
            <tr style="font-size: 10px; font-weight: normal;">
                <th rowspan="2" style="width:2%;">No</th>
                <th rowspan="2" style="width:5%;">Tanggal</th>
                <th rowspan="2" style="width:10%;">Keterangan</th>
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
        <tbody style="font-size:11px;">
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
                <td>Data 5</td>
                <td>Data 6</td>
                <td>Data 7</td>
                <td>Data 8</td>
                <td>Data 9</td>
                <td>Data 10</td>
                <td>Data 11</td>
                <td>Data 12</td>
            </tr>
        </tbody>
        <tfoot style="font-size:11px;">
            <tr>
                <td colspan="3" style="text-align: right;">Jumlah</td>
                <td colspan="3" style="text-align: center;">0</td>
                <td colspan="3" style="text-align: center;">0</td>
                <td style="text-align: right;">0</td>
                <td style="text-align: right;">0</td>
                <td style="text-align: right;">0</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>