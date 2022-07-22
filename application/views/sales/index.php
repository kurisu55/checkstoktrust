<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <form class="form-group" action="<?= base_url('sales/') ?>" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Plat Mobil" name="keyword" style="width: 200px;" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
                            <button type="submit" class="btn btn-success btn-md ml-3 mb-3">Cari</button>
                        </div>
                    </div>
            </form>
            <div class="col-5 align-self-end">
                <?= $this->session->flashdata('pesan'); ?>
            </div>
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
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($list_PO)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan.
                        </div>
                    <?php endif; ?>
                    <?php $i = 1; ?>
                    <?php foreach ($list_PO as $l_po) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td id="rowBlok"><?= $l_po['tgl_po']; ?></td>
                            <td id="rowBlok"><?= $l_po['brand']; ?></td>
                            <td id="rowBlok"><?= $l_po['tipe_mobil']; ?></td>
                            <td id="rowBlok"><?= $l_po['plat_mobil']; ?></td>
                            <td id="rowBlok"><?= $l_po['tahun']; ?></td>
                            <td id="rowBlok"><?= $l_po['warna']; ?></td>
                            <td id="rowBlok"><?= $l_po['appraiser']; ?></td>
                            <td>
                                <form action="<?= base_url('sales/booking/') . $l_po['id']; ?>" method="POST" onsubmit="if(!confirm('Ingin melakukan booking dengan tipe mobil <?= $l_po['tipe_mobil']; ?> dan plat mobil <?= $l_po['plat_mobil']; ?>?')){return false;}">
                                    <button type="submit" class="badge badge-warning" style="border: none;" data-toogle="toggle" title="Tombol Booking">Booking</button>
                                </form>
                                <form action="<?= base_url('sales/cancelBooking/') . $l_po['id']; ?>" method="POST" onsubmit="if(!confirm('Ingin melakukan pembatalan booking dengan tipe mobil <?= $l_po['tipe_mobil']; ?> dan plat mobil <?= $l_po['plat_mobil']; ?>?')){return false;}">
                                    <button type="submit" class="badge badge-danger" style="border: none;" data-toogle="toggle" title="Cancel">Cancel</button>
                                </form>
                                <form action="<?= base_url('sales/sold/'); ?><?= $l_po['id']; ?>" method="POST" onsubmit="if(!confirm('Stok yang Anda booking dinyatakan terjual?')){return false;}">
                                    <button style="border: none;" class="badge badge-success" data-toogle="toggle" title="Tombol Terjual">Terjual</button>
                                </form>
                            </td>
                            <td><?php
                                if ($deal['is_booking'] = 1) {
                                    echo '<script></script>';
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- /.container-fluid -->
    <!-- Letakkan Cotent di bawah sini -->

</div>
<!-- End of Main Content -->