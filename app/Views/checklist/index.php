<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">daftar peralatan</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row ">
        <div class="col-md-4 ">
            <div class="d-grid gap-2 d-md-block ">
                <button class="btn btn-success mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Checklist Peralatan Boiler
                </button>

                <div class="collapse" id="collapseExample">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["boiler"] as $row) : ?>
                            <li class="list-group-item text-capitalize"><a class="text-decoration-none" href="checklist/<?= $row; ?>"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-warning mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    Checklist Peralatan Turbin
                </button>

                <div class="collapse" id="collapseExample2">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["turbin"] as $row) : ?>
                            <li class="list-group-item text-capitalize"><a class="text-decoration-none" href="checklist/<?= $row; ?>"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                    Checklist Peralatan Alba
                </button>

                <div class="collapse" id="collapseExample3">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["alba"] as $row) : ?>
                            <li class="list-group-item text-capitalize"><a class="text-decoration-none" href="checklist/<?= $row; ?>"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- akhir row 1 -->

    <!-- row 2 -->

    <div class="row ">
        <div class="col-md-4 ">
            <div class="d-grid gap-2 d-md-block ">
                <button class="btn btn-danger mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                    Checklist Shutdown
                </button>
                <div class="collapse" id="collapseExample4">
                    <ul class="list-group text-start">
                        <li class="list-group-item"><a class="text-decoration-none" href="checklistShutdown.php">Checklist Shutdown</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 ">
            <div class="d-grid gap-3 d-md-block">
                <button class="btn btn-info mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
                    Checklist Peralatan WTP
                </button>
                <div class="collapse" id="collapseExample5">
                    <ul class="list-group text-start">
                        <li class="list-group-item"><a class="text-decoration-none" href="">belum ada data</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>