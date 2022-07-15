<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <form class="form-group" action="<?= base_url('admin/data_profile') ?>" method="post">
                <label for="no_pegawai">No. Pegawai</label>
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Nomor pegawai" name="keyword" style="width: 200px;" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
                            <button type="submit" class="btn btn-success btn-md ml-3">Cari</button>
                        </div>
                    </div>
            </form>
            <div class="col-4 align-items-end">
                <?= $this->session->flashdata('pesan'); ?>
            </div>
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Pegawai</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Region</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftar_user)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan.
                        </div>
                    <?php endif; ?>
                    <?php $i = 1; ?>
                    <?php foreach ($daftar_user as $d_user) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $d_user['no_pegawai']; ?></td>
                            <td><?= $d_user['name']; ?></td>
                            <td><?= $d_user['nama_role']; ?></td>
                            <td><?= $d_user['region']; ?></td>
                            <td><?= $d_user['no_telp']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit_data/'); ?><?= $d_user['no_pegawai']; ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url('admin/delete_user/'); ?><?= $d_user['no_pegawai']; ?>" class="badge badge-danger" onclick="return confirm('Ingin menghapus user atas nama <?= $d_user['name']; ?> dengan NRP <?= $d_user['no_pegawai']; ?>?')">Delete</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->