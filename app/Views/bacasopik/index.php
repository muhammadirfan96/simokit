<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">daftar sop ik</span></p>
        </div>
    </div>
</div>

<div class="container text-center text-capitalize">
    <div class="row">
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block ">
                <button class="btn btn-success mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    SOP & IK Peralatan Boiler
                </button>

                <div class="collapse" id="collapseExample">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["boiler"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1Ri6UnOa206v_HF7LhovdIGanya3yzqHj?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-warning mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    SOP & IK Peralatan Turbin
                </button>

                <div class="collapse" id="collapseExample2">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["turbin"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1i9XLQx_WecqSBz26Hzx54nb_VqSMzHmq?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                    SOP & IK Peralatan Alba
                </button>

                <div class="collapse" id="collapseExample3">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["alba"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1P5ZZjGXmFCFO8bmHGAMwHe0xDdfan2FH?usp=sharing" target="_blank"><?= $row; ?></a></li>
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
                    SOP & IK Start Up
                </button>
                <div class="collapse" id="collapseExample4">
                    <ul class="list-group text-start">
                        <?php foreach ($peralatan["startUp"] as $row) : ?>
                            <li class="list-group-item"><a class="text-decoration-none" href="https://drive.google.com/drive/folders/1sKkrZu4jjiIwVa7oluaVYGKN47IgJDIy?usp=sharing" target="_blank"><?= $row; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 ">
            <div class="d-grid gap-3 d-md-block">
                <button class="btn btn-info mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
                    SOP & IK Shut Down
                </button>
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