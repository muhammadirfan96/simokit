<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Service Request</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="/db_servicerequest"><i class="fas fa-eye"></i> See Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Kegiatan 5s</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="/db_limas"><i class="fas fa-eye"></i> See Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Checklist Peralatan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="/db_checklist"><i class="fas fa-eye"></i> See Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>