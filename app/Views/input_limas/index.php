<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">input schedule 5s</span></p>
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
    <div class="row">
        <div class="col">
            <div class="btn-group mb-3" role="group" aria-label="Basic mixed styles example">
                <button id="boiler" type="button" class="btn btn-danger">boiler</button>
                <button id="turbin" type="button" class="btn btn-warning">turbin</button>
                <button id="alba" type="button" class="btn btn-success">alba</button>
            </div>

            <div id="tabel">
                <?= $this->include('input_limas/table'); ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('/js/inputlimas.js'); ?>"></script>

<?= $this->endSection(); ?>