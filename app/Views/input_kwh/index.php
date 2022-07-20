<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">input kwh</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
            <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form action="input_kwh/save" method="post">
        <div class="row">
            <div>
                <p style="width: 60px;" class="mb-2 fw-bold text-light text-uppercase px-2 rounded bg_orange0">time</p>
            </div>
            <div class="col-md-6 mb-2">
                <?= old(''); ?>
                <div>
                    <input type="datetime-local" class="form-control rounded <?= ($validation->hasError('waktu')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="waktu" value="<?= old('waktu'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('waktu'); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <p class="fst-italic border border-2 border-dark rounded p-1 text_orange bg-light fw-bold">masukkan data kwh pukul 10:00 setiap hari</p>
            </div>
            <div>
                <p style="width: 90px;" class="mb-2 fw-bold text-light text-uppercase px-2 rounded bg_orange0">kwh KIT</p>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('kit1')) ? 'is-invalid' : ''; ?>" type="number" min="1000" max="10000" name="kit1" placeholder="#1" id="" value="<?= old('kit1') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('kit1'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('kit2')) ? 'is-invalid' : ''; ?>" type="number" min="1000" max="10000" name="kit2" placeholder="#2" id="" value="<?= old('kit2') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('kit2'); ?>
                </div>
            </div>
            <div>
                <p style="width: 90px;" class="mb-2 fw-bold text-light text-uppercase px-2 rounded bg_orange0">kwh PS</p>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('ps1')) ? 'is-invalid' : ''; ?>" type="number" min="1000" max="10000" name="ps1" placeholder="#1" id="" value="<?= old('ps1') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('ps1'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('ps2')) ? 'is-invalid' : ''; ?>" type="number" min="1000" max="10000" name="ps2" placeholder="#2" id="" value="<?= old('ps2') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('ps2'); ?>
                </div>
            </div>
            <div>
                <p style="width: 90px;" class="mb-2 fw-bold text-light text-uppercase px-2 rounded bg_orange0">kwh ET</p>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('et1')) ? 'is-invalid' : ''; ?>" type="number" name="et1" min="1000" max="10000" placeholder="#1" id="" value="<?= old('et1') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('et1'); ?>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <input class="form-control rounded <?= ($validation->hasError('et2')) ? 'is-invalid' : ''; ?>" type="number" name="et2" min="1000" max="10000" placeholder="#2" id="" value="<?= old('et2') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('et2'); ?>
                </div>
            </div>
        </div>
        <div class="position-relative">
            <div class="position-absolute end-0">
                <button class="d-inline-block bg_hijau0 text-light fst-italic btn btn-sm" type="submit">save</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>