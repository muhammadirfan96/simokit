<div class="container-fluid">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">schedule</span></p>
        </div>
        <div class="col justify-content-end d-flex">
            <p class=" text-danger fw-bold my-3"><?= date('d-m-Y') ?></p>
        </div>
    </div>
</div>
<div class="container-fluid text-uppercase">
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_ungu1">kegiatan 5s Boiler</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($limasBoiler as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_kuning1">kegiatan 5s Turbin</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($limasTurbin as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_biru1">kegiatan 5s Alba</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($limasAlba as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_merah1">kegiatan rutin #1</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoUnit1 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_birulaut1">kegiatan rutin #2</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoUnit2 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-2">
                <div class="card-header rounded-top fw-bold bg_orange1">kegiatan rutin common</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoCommon as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>