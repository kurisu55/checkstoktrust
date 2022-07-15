<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <div class="card text-white bg-info mb-3">
                <div class="card-header bg-info text-center">TNT</div>
                <div class="card-body">
                    <h5 class="card-title">NRP : <?= $user['no_pegawai']; ?></h5>
                    <p class="card-text">Nama : <?= $user['name']; ?></p>
                    <p class="card-text">Region : <?= $user['region']; ?></p>
                    <p class="card-text">No. Telp : <?= $user['no_telp']; ?></p>
                    <hr class="bg-secondary">
                    <p class="card-text"><small>Akun dibuat pada <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
            <div class="alert alert-warning mt-1">
                <strong>Perhatian!</strong>
                <p>Bila ada kesalahan data atau ingin melakukan perubahan data silahkan hubungi admin!</p>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <!-- Letakkan Cotent di bawah sini -->

</div>
<!-- End of Main Content -->