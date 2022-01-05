<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">daftar sop ik</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid text-center text-capitalize">
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_ungu0">SOP & IK Peralatan Boiler</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_ungu1">
                    <button class="btn btn-outline-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-eye text-dark"></i> See Details</button>
                </div>
                <div class="collapse" id="collapseExample">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["boiler"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1Ri6UnOa206v_HF7LhovdIGanya3yzqHj?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_kuning0">SOP & IK Peralatan Turbin</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_kuning1">
                    <button class="btn btn-outline-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2"><i class="fas fa-eye text-dark"></i> See Details</button>
                </div>
                <div class="collapse" id="collapseExample2">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["turbin"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1i9XLQx_WecqSBz26Hzx54nb_VqSMzHmq?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_biru0">SOP & IK Peralatan Alba</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_biru1">
                    <button class="btn btn-outline-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3"><i class="fas fa-eye text-dark"></i> See Details</button>
                </div>
                <div class="collapse" id="collapseExample3">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["alba"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1P5ZZjGXmFCFO8bmHGAMwHe0xDdfan2FH?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_merah0">SOP & IK Start Up</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_merah1">
                    <button class="btn btn-outline-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4"><i class="fas fa-eye text-dark"></i> See Details</button>
                </div>
                <div class="collapse" id="collapseExample4">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["startUp"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1sKkrZu4jjiIwVa7oluaVYGKN47IgJDIy?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold text-uppercase bg_hijau0">SOP & IK Shut Down</div>
                <div class="card-footer rounded-bottom d-flex align-items-center justify-content-between bg_hijau1">
                    <button class="btn btn-outline-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5"><i class="fas fa-eye text-dark"></i> See Details</button>
                </div>
                <div class="collapse" id="collapseExample5">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["shutDown"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/18IBMwXVj5vIsY-C38LgdcKJmUsN1xO0s?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>