<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">kegiatan 5s</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <form action="/limas/simpan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <label class="fw-bold"><b>Nama Peralatan</b></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('namaPeralatan')) ? 'is-invalid' : 'was-validated'; ?>" aria-label="Username" aria-describedby="basic-addon1" name="namaPeralatan" value="<?= old('namaPeralatan'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('namaPeralatan'); ?>
                    </div>
                </div>

                <label class="fw-bold"><b>Waktu</b></label><br>
                <div class="input-group mb-3">
                    <input type="datetime-local" class="form-control rounded <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="tanggal" value="<?= old('tanggal'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>

                <label class="fw-bold"><b>Area</b></label><br>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="area" value="<?= old('area'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('area'); ?>
                    </div>
                </div>

                <label class="fw-bold">Keterangan:</label>
                <div class="border rounded px-3 py-3 mb-3" style="font-size: 10px;">
                    <p>1 = Belum memulai kegiatan 5S, tidak ada usaha sama sekali</p>
                    <p>2 = Sudah memulai kegiatan 5S, tetapi ada banyak perbaikan major <i>(perbaikan perlu beberapa hari)</i></p>
                    <p>3 = Cukup baik, hanya perlu beberapa improvement minor <i>(bisa langsung saat itu memperbaiki kondisi)</i></p>
                    <p>4 = sudah baik, hanya perlu sedikit improvement</p>
                    <p>5 = Sudah sangat baik, terus pertahankan kondisi seperti ini</p>
                </div>

                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $row) : ?>

                    <div class="mb-3 border py-3 rounded text-center">
                        <label><?= $row["pertanyaan"]; ?></label><br>
                        <input class="form-check-input mx-2 <?= ($validation->hasError('nilai' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="nilai<?= $i; ?>" value="1" <?= old('nilai' . $i) == "1" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2 <?= ($validation->hasError('nilai' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="nilai<?= $i; ?>" value="2" <?= old('nilai' . $i) == "2" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2 <?= ($validation->hasError('nilai' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="nilai<?= $i; ?>" value="3" <?= old('nilai' . $i) == "3" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2 <?= ($validation->hasError('nilai' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="nilai<?= $i; ?>" value="4" <?= old('nilai' . $i) == "4" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2 <?= ($validation->hasError('nilai' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="nilai<?= $i; ?>" value="5" <?= old('nilai' . $i) == "5" ? 'checked' : ''; ?>>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nilai' . $i); ?>
                        </div>
                    </div>

                    <br>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <label class="fw-bold"><b>Saran</b></label><br>
                <div class="input-group mb-3">
                    <textarea type="text" class="form-control rounded <?= ($validation->hasError('saran')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="saran"><?= old('saran'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('saran'); ?>
                    </div>
                </div>

                <label class="fw-bold">Sebelum 5S</label>
                <input class="form-control rounded mb-3 <?= ($validation->hasError('fotoSebelum')) ? 'is-invalid' : ''; ?>" type="file" name="fotoSebelum">
                <div class="invalid-feedback">
                    <?= $validation->getError('fotoSebelum'); ?>
                </div>

                <label class="fw-bold">Setelah 5S</label>
                <input class="form-control rounded mb-3 <?= ($validation->hasError('fotoSetelah')) ? 'is-invalid' : ''; ?>" type="file" name="fotoSetelah">
                <div class="invalid-feedback">
                    <?= $validation->getError('fotoSetelah'); ?>
                </div>
                <?php if (in_groups('admin') || in_groups('operator shift a') || in_groups('operator shift b') || in_groups('operator shift c') || in_groups('operator shift d')) : ?>
                    <div class="position-relative">
                        <div class="position-absolute top-0 end-0">
                            <button class="btn btn-success btn-sm" type="submit" name="save">Save</button>
                        </div>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>