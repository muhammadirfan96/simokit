<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">input schedule c/o</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="btn-group mb-3" role="group" aria-label="Basic mixed styles example">
                <button id="unit1" type="button" class="btn btn-danger">unit 1</button>
                <button id="unit2" type="button" class="btn btn-warning">unit 2</button>
                <button id="common" type="button" class="btn btn-success">common</button>
            </div>

            <div id="tabel">
                <?= $this->include('input_co/table'); ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('/js/inputco.js'); ?>"></script>

<?= $this->endSection(); ?>