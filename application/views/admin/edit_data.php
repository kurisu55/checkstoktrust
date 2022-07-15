<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <form action="<?= base_url('admin/hasil_update/') ?><?= $daftar_user['no_pegawai']; ?>" method="POST" class="col-lg-4">
                <input type="hidden" name="no_pegawai" value="<?= $daftar_user['no_pegawai']; ?>">
                <div class="form-group">
                    <label for="name">Nama Pegawai</label>
                    <input type="text" class="form-control" name="name" value="<?= $daftar_user['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama_role">Jabatan : </label>
                    <select class="form-control" name="nama_role">
                        <?php foreach ($jabatan as $j) : ?>
                            <?php if ($j == $daftar_user['nama_role']) : ?>
                                <option value="<?= $j; ?>" selected> <?= $j; ?></option>
                            <?php else : ?>
                                <option><?= $j; ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="region">Region : </label>
                    <select class="form-control" name="region">
                        <?php foreach ($region as $r) : ?>
                            <?php if ($r == $daftar_user['region']) : ?>
                                <option value="<?= $r; ?>" selected> <?= $r; ?></option>
                            <?php else : ?>
                                <option><?= $r; ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" class="form-control" name="no_telp" value="<?= $daftar_user['no_telp']; ?>">
                </div>
                <button type="submit" name="edit_data" data-no_pegawai="<?= $daftar_user['no_pegawai']; ?>" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->