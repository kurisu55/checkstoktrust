<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <form action="<?= base_url('admin/mobil_masuk') ?>" method="post">
                <div class="row mb-2">
                    <input type="text" name="tgl_awal" class="form-control col-2 ml-2" placeholder="Tanggal Awal" onfocus="(this.type='date')" value="<?= set_value('tgl_awal'); ?>">
                    <input type="text" name="tgl_akhir" class="form-control col-2 ml-2" placeholder="Tanggal Akhir" onfocus="(this.type='date')" value="<?= set_value('tgl_akhir'); ?>">
                    <button type="submit" class="btn btn-info ml-2"><i class="fas fa-filter mr-1"></i>Filter</button>
            </form>
            <a href="<?= base_url('admin/refresh') ?>" class="btn btn-success ml-2"><i class="fas fa-refresh mr-1"></i>Refresh</a>
        </div>
        <a href="<?= base_url('admin/pdf_mobilMasuk') ?>" class="btn btn-danger mb-3" target="_blank"><i class="fas fa-file-pdf mr-1"></i>View PDF</a>
        <table class="table table-hover">
            <thead>
                <tr class="bg-success text-white" style="overflow-x: scroll;">
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
                    <tr>
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
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->