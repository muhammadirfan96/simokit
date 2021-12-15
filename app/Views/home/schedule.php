<div class="container">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">schedule</span></p>
        </div>
    </div>
</div>
<div class="container">
    <p class=" text-danger fw-bold"><?= date('d-m-Y') ?></p>
    <div class="row">
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    5S boiler
                </div>
                <div class="card-body">
                    <?php foreach ($limasBoiler as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    5S turbin
                </div>
                <div class="card-body">
                    <?php foreach ($limasTurbin as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    5S alba
                </div>
                <div class="card-body">
                    <?php foreach ($limasAlba as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <?= $r; ?><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    Unit 1
                </div>
                <div class="card-body">
                    <?php foreach ($jadwalCoUnit1 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    Unit 2
                </div>
                <div class="card-body">
                    <?php foreach ($jadwalCoUnit2 as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md mb-3">
            <div class="card">
                <div class="card-header" style="background-color:#b7d5ac;">
                    Common
                </div>
                <div class="card-body">
                    <?php foreach ($jadwalCoCommon as $row) : ?>
                        <?= $row; ?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>