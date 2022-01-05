<div class="container-fluid">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">schedule</span></p>
        </div>
    </div>
</div>
<div class="container-fluid text-uppercase">
    <p class=" text-danger fw-bold"><?= date('d-m-Y') ?></p>
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_ungu0">kegiatan 5s Boiler</div>
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
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_kuning0">kegiatan 5s Turbin</div>
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
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_biru0">kegiatan 5s Alba</div>
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
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_merah0">kegiatan rutin #1</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoUnit1 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_hijau0">kegiatan rutin #2</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoUnit2 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white mb-4">
                <div class="card-header rounded-top fw-bold bg_orange0">kegiatan rutin common</div>
                <div class="card-footer rounded-bottom d-flex text-lowercase align-items-center justify-content-between text-dark">
                    <?php foreach ($jadwalCoCommon as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>