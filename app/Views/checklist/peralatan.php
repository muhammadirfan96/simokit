<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">checklist <?= $title; ?></span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/checklist">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
            <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
            <form action="/checklist/simpan" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="namaPeralatan" value="<?= $title; ?>">
                <input type="hidden" name="jumlahPertanyaan" value="<?= count($pertanyaan); ?>">

                <label class="fw-bold"><b>Nama Pelaksana (selain anda)</b></label>
                <div class="input-group mb-3">

                    <div class="dropdown">
                        <button class="btn bg_orange0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih nama teman anda
                        </button>
                        <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdownMenuButton1">
                            <?php foreach ($users as $user) : ?>
                                <li>
                                    <input class="form-check-input ms-2" type="checkbox" id="<?= $user['username']; ?>" name="<?= $user['username']; ?>" value="<?= $user['username']; ?>" <?= old($user['username']) == $user['username'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label me-2" for="<?= $user['username']; ?>">
                                        <?= $user['fullname']; ?>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>

                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $row) : ?>
                    <p><?= $row["pertanyaan"]; ?></p>
                    <div class="form-check">
                        <input class="form-check-input <?= ($validation->hasError('pertanyaan' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="pertanyaan<?= $i; ?>" value="ya" id="pertanyaan<?= $i; ?>" <?= old('pertanyaan' . $i) == "ya" ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pertanyaan<?= $i; ?>">Ya</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input <?= ($validation->hasError('pertanyaan' . $i)) ? 'is-invalid' : ''; ?>" type="radio" name="pertanyaan<?= $i; ?>" value="tidak" id="pertanyaan<?= $i; ?>a" <?= old('pertanyaan' . $i) == "tidak" ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pertanyaan<?= $i; ?>a">Tidak</label>
                    </div>

                    <div class="form-grup mb-3">
                        <textarea name="komen<?= $i; ?>" class="form-control" id="floatingTextarea"><?= old('komen' . $i); ?></textarea>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <b>CATATAN</b>
                <textarea name="catatan" class="form-control mb-3" id="floatingTextarea"><?= old('catatan'); ?></textarea>

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