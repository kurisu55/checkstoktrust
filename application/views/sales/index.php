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
                        <th scope="col" class="text-center">Status</th>
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
                            <td><?= $d['kode_po']; ?></td>
                            <td><?= $d['tgl_po']; ?></td>
                            <td><?= $d['brand']; ?></td>
                            <td><?= $d['tipe_mobil']; ?></td>
                            <td><?= $d['plat_mobil']; ?></td>
                            <td><?= $d['tahun']; ?></td>
                            <td><?= $d['warna']; ?></td>
                            <td><?= $d['appraiser']; ?></td>
                            <td>
                                <form action="<?= base_url('sales/booking/') . $d['id']; ?>" onsubmit="if(!confirm('Ingin melakukan booking dengan tipe mobil <?= $d['tipe_mobil']; ?> dan plat mobil <?= $d['plat_mobil']; ?>?')){return false;}">
                                    <button type="submit" id="booking" class="badge badge-warning" data-toggle="toggle" title="Booking" style="border: none;">Booking</button>
                                </form>
                                <form action="<?= base_url('sales/cancelBooking/') . $d['id']; ?>" onsubmit="if(!confirm('Ingin melakukan pembatalan booking dengan tipe mobil <?= $d['tipe_mobil']; ?> dan plat mobil <?= $d['plat_mobil']; ?>?')){return false;}">
                                    <button type="submit" id="cancel" class="badge badge-danger" data-toggle="toggle" title="Cancel" style="border: none;">Cancel</button>
                                </form>
                                <form action="<?= base_url('sales/sold/') . $d['id']; ?>" onsubmit="if(!confirm('Stok yang Anda booking dinyatakan terjual?')){return false;}">
                                    <button type="submit" id="terjual" class="badge badge-success" data-toggle="toggle" title="Terjual" style="border: none;">Terjual</button>
                                </form>
                            </td>
                            <?php
                            if ($d['is_sold'] == 1 && $d['is_booking'] == 1) {
                                echo "<td class='bg-success'><span class='text-white'>Stok sudah terjual</span>";
                            } elseif ($d['is_booking'] == 1) {
                                echo "<td class='bg-warning'><span class='text-white'>Sudah dibooking sales <u>" . $d['sales'] . "</u></span>";
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