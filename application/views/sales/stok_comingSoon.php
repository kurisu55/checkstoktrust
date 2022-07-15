<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-lg">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal PO</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Tipe Mobil</th>
                    <th scope="col">Plat Mobil</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Appraiser</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($list_PO)) : ?>
                    <div class="alert alert-danger" role="alert">
                        PO Belum tersedia.
                    </div>
                <?php endif; ?>
                <?php $i = 1; ?>
                <?php foreach ($list_PO as $l_po) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $l_po['tgl_po']; ?></td>
                        <td><?= $l_po['brand']; ?></td>
                        <td><?= $l_po['tipe_mobil']; ?></td>
                        <td><?= $l_po['plat_mobil']; ?></td>
                        <td><?= $l_po['tahun']; ?></td>
                        <td><?= $l_po['warna']; ?></td>
                        <td><?= $l_po['appraiser']; ?></td>
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