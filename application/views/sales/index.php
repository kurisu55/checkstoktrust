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
                        <th scope="col">Kode PO</th>
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
                    <?php if (empty($deal)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan.
                        </div>
                    <?php endif; ?>
                    <?php $i = 1; ?>
                    <?php foreach ($deal as $d) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td id="rowBlok"><?= $d['kode_po']; ?></td>
                            <td id="rowBlok"><?= $d['tgl_po']; ?></td>
                            <td id="rowBlok"><?= $d['brand']; ?></td>
                            <td id="rowBlok"><?= $d['tipe_mobil']; ?></td>
                            <td id="rowBlok"><?= $d['plat_mobil']; ?></td>
                            <td id="rowBlok"><?= $d['tahun']; ?></td>
                            <td id="rowBlok"><?= $d['warna']; ?></td>
                            <td id="rowBlok"><?= $d['appraiser']; ?></td>
                            <td id="status">
                                <a href="<?= base_url('sales/booking/') . $d['id']; ?>" class="badge badge-warning" onclick="if(!confirm('Ingin melakukan booking dengan tipe mobil <?= $d['tipe_mobil']; ?> dan plat mobil <?= $d['plat_mobil']; ?>?')){return false;}">Booking</a>
                                <a href="<?= base_url('sales/cancelBooking/') . $d['id']; ?>" class="badge badge-danger" onsubmit="if(!confirm('Ingin melakukan pembatalan booking dengan tipe mobil <?= $d['tipe_mobil']; ?> dan plat mobil <?= $d['plat_mobil']; ?>?')){return false;}">Cancel</a>
                                <a href="<?= base_url('sales/sold/'); ?><?= $d['id']; ?>" class="badge badge-success" onsubmit="if(!confirm('Stok yang Anda booking dinyatakan terjual?')){return false;}">Terjual</a>
                            </td>
                            <td>
                                <?php
                                if (!empty($d['sales'])) {
                                    echo "<span class='bg-warning'>Sudah dibooking oleh sales<span class='text-white'>" . $d['sales'] . "</span></span>";
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