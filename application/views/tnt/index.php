<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-lg">
        <div class="float-right">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
        <table class="table table-hover" id="list_UpdatePO">
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>
                            <form action="<?= base_url('Tnt/confirm_PO/') . $l_po['id']; ?>" method="post" onsubmit="if(!confirm('Ingin mengirim PO ke Sales dengan tipe mobil <?= $l_po['tipe_mobil']; ?> dan plat mobil <?= $l_po['plat_mobil']; ?>?')){return false;}">
                                <?php if ($l_po['is_confirm'] == 0) {
                                    echo  "<button type='submit' class='badge badge-success' style='border: none;'>Deal</button>";
                                } else {
                                    echo  "<button type='submit' class='badge badge-success invisible' style='border: none;'>Deal</button>"
                                        . "<i class='fas fa-regular fa-check-to-slot fa-2x text-success'></i>";
                                }
                                ?>
                            </form>
                            <form action="<?= base_url('tnt/delete_po/'); ?><?= $l_po['id']; ?>" method="POST" onsubmit="if(!confirm('Ingin menghapus PO dengan tipe mobil <?= $l_po['tipe_mobil']; ?> dan plat mobil <?= $l_po['plat_mobil']; ?>?')){return false;}">
                                <?php if ($l_po['is_confirm'] == 0) {
                                    echo "<button class='badge badge-danger' style='border: none;'>Batal</button>";
                                }
                                ?>
                            </form>
                        </td>
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