<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
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

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_ungu0">service request</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_ungu1">
                    <a class="btn btn-outline-light text-dark" href="/db_servicerequest"><i class="fas fa-eye"></i> See Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_kuning0">Kegiatan 5s</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_kuning1">
                    <a class="btn btn-outline-light text-dark" href="/db_limas"><i class="fas fa-eye"></i> See Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_merah0">Checklist Peralatan</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_merah1">
                    <a class="btn btn-outline-light text-dark" href="/db_checklist"><i class="fas fa-eye"></i> See Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_hijau0">User List</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_hijau1">
                    <a class="btn btn-outline-light text-dark" href="/db_users"><i class="fas fa-eye"></i> See Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>