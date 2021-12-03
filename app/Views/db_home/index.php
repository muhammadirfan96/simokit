<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database</span></p>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row ">
        <div class="col-md-4 ">
            <div class="d-grid gap-2 d-md-block ">
                <a class="btn btn-success mb-2 " href="/Db_servicerequest" role="button">service request</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <a class="btn btn-danger mb-2" href="dbadmin.php" role="button">kegiatan 5s</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <a class="btn btn-info mb-2" href="dbusers.php" role="button">checklist peralatan</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>