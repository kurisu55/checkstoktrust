<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <!--Brand Logo-->
                    <img src="<?= base_url('assets/') ?>images/logo.png" alt="Logo Toyota Trust" class="img-fluid">
                </div>

                <!--Form-->
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h1 class="text-center">Log in</h1>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <!--Form action-->
                            <form action="<?= base_url('auth') ?>" method="post">
                                <div class="form-group first">
                                    <label for="no_pegawai">No Pegawai</label>
                                    <input type="text" class="form-control" id="no_pegawai" name="no_pegawai" value="<?= set_value('no_pegawai') ?>">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <?= form_error('no_pegawai', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                                <?= form_error('password', '<div class="small alert-danger form-text text-muted">', '</div>'); ?>
                                <input type="submit" value="Log In" class="btn btn-block btn-primary mt-2">
                                <div class="d-flex mb-5 align-items-center">
                                    <span class="mr-auto"><a href="<?= base_url('auth/forgot_password') ?>" class="forgot-pass">Lupa Password</a></span>
                                    <span class="ml-auto" data-toggle="tooltip" title="Daftar"><a href="<?= base_url('Auth/') ?>registration" class="forgot-pass">Tidak punya akun?</a></span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>