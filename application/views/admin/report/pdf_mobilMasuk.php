<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style type="text/css">
        body {
            text-align: center;

        }

        table,
        tr,
        td,
        th {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Mobil Masuk</h2>
    <table class="table table-hover" border="1" cellspacing="0">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">#</th>
                <th scope="col">Kode PO</th>
                <th scope="col">Waktu Deal</th>
                <th scope="col">Brand</th>
                <th scope="col">Plat Mobil</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($list_mobilMasuk as $rows) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $rows['kode_po']; ?></td>
                    <td><?= date('d F Y', $rows['date_confirm']); ?></td>
                    <td><?= $rows['brand']; ?></td>
                    <td><?= $rows['plat_mobil']; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</body>

</html>