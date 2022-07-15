<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <div class="card text-white bg-info mb-3">
                <div class="card-header bg-info text-center">Admin</div>
                <div class="card-body">
                    <h5 class="card-title">NRP : <?= $user['no_pegawai']; ?></h5>
                    <p class="card-text">Nama : <?= $user['name']; ?></p>
                </div>
            </div>
            <div class="alert alert-success mt-1">
                <strong>Selamat datang.</strong>
                <p>Lakukan pekerjaan dengan kondisi prima! &#128515</p>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <!-- Letakkan Cotent di bawah sini -->

</div>
<!-- End of Main Content -->