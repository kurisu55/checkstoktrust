<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-lg">
        <a href="javascript:void(0);" class="btn btn-success mb-4" data-toggle="modal" data-target="#tambahData">Tambah Data</a>
        <div class="float-right">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
        <table class="table table-hover" id="list_UpdatePO">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal PO</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Tipe Mobil</th>
                    <th scope="col">Plat Mobil</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Appraiser</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($list_PO as $l_po) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $l_po['tgl_po']; ?></td>
                        <td><?= $l_po['brand']; ?></td>
                        <td><?= $l_po['tipe_mobil']; ?></td>
                        <td><?= $l_po['plat_mobil']; ?></td>
                        <td><?= $l_po['tahun']; ?></td>
                        <td><?= $l_po['warna']; ?></td>
                        <td><?= $l_po['appraiser']; ?></td>
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

<!-- Modal Tambah Data -->
<!-- Modal -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModal">Tambah Data PO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/') ?>" method="post" onsubmit="if(!confirm('Semua'))">
                    <div class="form-group row">
                        <label for="tgl_po" class="col-sm-3 col-form-label">Tanggal PO</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_po" id="tgl_po" class="form-control" value="<?= set_value('tgl_po'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-sm-3 col-form-label">Brand</label>
                        <div class="col-sm-9">
                            <input type="text" name="brand" id="brand" class="form-control" value="<?= set_value('brand'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipe_mobil" class="col-sm-3 col-form-label">Tipe Mobil</label>
                        <div class="col-sm-9">
                            <input type="text" name="tipe_mobil" id="tipe_mobil" class="form-control" value="<?= set_value('tipe_mobil'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="plat_mobil" class="col-sm-3 col-form-label">Plat Mobil</label>
                        <div class="col-sm-9">
                            <input type="text" name="plat_mobil" id="plat_mobil" class="form-control" value="<?= set_value('plat_mobil'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                            <input type="text" name="tahun" id="tahun" class="form-control" value="<?= set_value('tahun'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="warna" class="col-sm-3 col-form-label">Warna</label>
                        <div class="col-sm-9">
                            <input type="text" name="warna" id="warna" class="form-control" value="<?= set_value('warna'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="appraiser" class="col-sm-3 col-form-label">Appraiser</label>
                        <div class="col-sm-9">
                            <input type="text" name="appraiser" id="appraiser" class="form-control" value="<?= set_value('appraiser'); ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Input harus diisi')" oninput="setCustomValidity('')">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="tambah">Tambah</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>