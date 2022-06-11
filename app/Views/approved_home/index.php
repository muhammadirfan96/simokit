<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">approved</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<?php
$data = [
    ['approved_servicerequest', 'fa-pen', 'service request'],
    ['approved_limas', 'fa-pen', 'kegiatan 5s'],
    ['approved_checklist', 'fa-tasks', 'checklist sop']
];
?>

<div class="container-fluid text-center">
    <div class="row justify-content-center">
        <?php foreach ($data as $row) : ?>
            <div class="col-xl-3 col-md-6">
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
    </div>
</div>

<?= $this->endSection(); ?>