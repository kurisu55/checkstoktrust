<body style="background-color: grey;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrasi</h1>
                        </div>
                        <form class="user" action="<?= base_url('auth/registration/') ?>" method="post">
                            <div class="form-group">
                                <label for="role_id" id="role_id">Divisi Pekerjaan : </label>
                                <select name="role_id" id="role_id" style="height: 30px;width: 70px;" class="btn-outline-dark" required value="<?= set_value('role_id') ?>">
                                    <option value="">Pilih</option>
                                    <option value="2" <?= set_select('role_id', '2'); ?>>TNT</option>
                                    <option value="3" <?= set_select('role_id', '3'); ?>>Sales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="no_pegawai" name="no_pegawai" placeholder="No. Pegawai" value="<?= set_value('no_pegawai') ?>">
                                <?= form_error('no_pegawai', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="no_telp" name="no_telp" placeholder="No. Telepon" value="<?= set_value('no_telp') ?>">
                                <?= form_error('no_telp', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
                                <?= form_error('password', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                            </div>
                            <button type="submit" href="" class="btn btn-primary btn-user btn-block">
                                Registrasi Akun
                            </button>
                        </form>
                        <div class="mt-3 text-center">
                            <a class="small" href="<?= base_url('auth') ?>">Login bila memiliki akun!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>