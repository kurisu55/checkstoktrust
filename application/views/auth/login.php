<body class="">
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-lg">
                <img src="<?= base_url('assets/images/') ?>logo.png" alt="" width="500px">
            </div>
            <div class="justify-content-center col-lg-5 col-md-8 col-sm">
                <div class="col-lg">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Log in</h1>
                    </div>
                    <form class="user" action="<?= base_url('auth'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="no_pegawai" placeholder="Masukkan NRP" value="<?= set_value('no_pegawai'); ?>">
                            <?= form_error('no_pegawai', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                            <?= form_error('password', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('auth/registration/') ?>">Buat akun!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>