<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2"><?= $namaPeralatan; ?></span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<?php

// Header content type 
// header('Content-type: application/pdf');

// header('Content-Disposition: inline; filename="' . $namaPeralatan . '"');

// header('Content-Transfer-Encoding: binary');

// header('Accept-Ranges: bytes');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <embed src="<?= base_url('list-sopik/' . $bagian . '/' . $namaPeralatan); ?>" type="application/pdf" style="width: 100%;height: 100vh;">
        </div>
    </div>
</div>

<?= $this->endSection(); ?>