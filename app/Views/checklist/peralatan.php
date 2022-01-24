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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <form action="/checklist/simpan" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="namaPeralatan" value="<?= $title; ?>">
                <input type="hidden" name="jumlahPertanyaan" value="<?= count($pertanyaan); ?>">
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

                <?php if (in_groups('admin') || in_groups('operasi shift a') || in_groups('operasi shift b') || in_groups('operasi shift c') || in_groups('operasi shift d')) : ?>
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