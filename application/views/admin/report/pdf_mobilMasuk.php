<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 16px;
        }

        img {
            width: 200px;
            height: 100px;
        }

        footer {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030;
        }

        .kolom {
            background-color: #2596be;
            color: #ffffff;
            text-align: center;
        }

        .baris {
            text-align: center;
        }

        table,
        tr,
        td,
        th {
            padding: 10px;
        }

        .alamat {
            float: right;
            margin-top: 20px;

        }

        p {
            line-height: 50%;
        }
    </style>
</head>

<body>
    <img src="<?= base_url('assets/images/') ?>Toyota-Trust-1-1024x460.png" alt="Logo Trust Toyota">
    <div class="alamat">
        <p>Jl. Raya Kalimalang No.88</p>
        <p>RT.1/RW.7</p>
        <p>Duren Sawit, Jakarta Timur</p>
    </div>
    <hr>
    <h2 style="text-align: center;">Laporan Mobil Masuk</h2>
    <table border="1" cellspacing="0">
        <thead>
            <tr class="kolom">
                <th scope="col">#</th>
                <th scope="col">Tanggal Mobil Masuk</th>
                <th scope="col">Tanggal PO</th>
                <th scope="col">Brand</th>
                <th scope="col">Tipe Mobil</th>
                <th scope="col">Plat Mobil</th>
                <th scope="col">Tahun</th>
                <th scope="col">Warna</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($list_mobilMasuk as $rows) : ?>
                <tr class="baris">
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $rows['date_confirm'] ?></td>
                    <td><?= $rows['tgl_po']; ?></td>
                    <td><?= $rows['brand']; ?></td>
                    <td><?= $rows['tipe_mobil']; ?></td>
                    <td><?= $rows['plat_mobil']; ?></td>
                    <td><?= $rows['tahun']; ?></td>
                    <td><?= $rows['warna']; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>



    <!-- <footer>
        <sup><strong>*</strong></sup>PDF ini dicetak pada waktu
        <?php /*date_default_timezone_set('Asia/Jakarta');
        date('l');
        if (date('l') == 'Sunday') {
            echo 'Minggu, ';
        } elseif (date('l') == 'Monday') {
            echo 'Senin, ';
        } elseif (date('l') == 'Tuesday') {
            echo 'Selasa, ';
        } elseif (date('l') == 'Wednesday') {
            echo 'Rabu, ';
        } elseif (date('l') == 'Thursday') {
            echo 'Kamis, ';
        } elseif (date('l') == 'Friday') {
            echo 'Jumat, ';
        } elseif (date('l') == 'Saturday') {
            echo 'Sabtu, ';
        }
        echo date('h:i:s A');

        */ ?>
    </footer> -->
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</body>

</html>