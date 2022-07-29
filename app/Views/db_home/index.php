<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">list of databases</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid text-center">
    <div class="row">
        <?php foreach ($data as $row) : ?>
            <div class="col-xl-3 col-md-6 mb-3">
                <a href="/<?= $row[0]; ?>" class="text-decoration-none rounded shadow d-block">
                    <div class="p-2 bg_hijau1 rounded-top border_bottom2 text-start">
                        <i class="fas <?= $row[1]; ?> fs-2 text-success"></i>
                        <p class="fw-bolder text-uppercase fs-5 d-inline-block mb-0 text-success text-right">database</p>
                    </div>
                    <div class="rounded-bottom text-dark fw-bolder text-uppercase py-2">
                        <?= $row[2]; ?>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
        <div class="col-xl-3 col-md-6 mb-3">
            <a href="<?= base_url('/temp'); ?>" class="text-decoration-none rounded shadow d-block">
                <div class="p-2 bg_hijau1 rounded-top border_bottom2 text-start position-relative">
                    <i class="fas fa-database fs-2 text-success"></i>
                    <p class="fw-bolder text-uppercase fs-5 d-inline-block mb-0 text-success text-right">database</p>
                    <div class="position-absolute end-0 top-0 fst-italic text-dark size12">
                        <div>u=renop</div>
                        <div>p=operasi#1</div>
                    </div>
                </div>
                <div class="rounded-bottom text-dark fw-bolder text-uppercase py-2">
                    tahun 2021
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>