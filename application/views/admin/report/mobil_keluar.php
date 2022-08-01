<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    <a href="#" class="btn btn-danger mb-2" target="_blank"><i class="fas fa-print mr-2"></i>Cetak PDF</a>
    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-success text-white">
                        <th scope="col">#</th>
                        <th scope="col">Kode PO</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Plat Mobil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($list_mobilKeluar as $rows) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <p><?= $rows['kode_po']; ?></p>
                            </td>
                            <td><?= $rows['brand']; ?></td>
                            <td><?= $rows['plat_mobil']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->