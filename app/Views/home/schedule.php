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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6 ">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan 5s Boiler</p>
                </div>
                <div class="p-2">
                    <?php foreach ($limasBoiler as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <p class="text-dark text-center mb-0"><?= $r; ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

        <div class="col-xl-4 col-md-6">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan 5s Turbin</p>
                </div>
                <div class="p-2">
                    <?php foreach ($limasTurbin as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <p class="text-dark text-center mb-0"><?= $r; ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-md-6">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan 5s Alba</p>
                </div>
                <div class="p-2">
                    <?php foreach ($limasAlba as $row) : ?>
                        <?php foreach ($row as $r) : ?>
                            <p class="text-dark text-center mb-0"><?= $r; ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-md-6">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan rutin #1</p>
                </div>
                <div class="p-2">
                    <?php foreach ($jadwalCoUnit1 as $row) : ?>
                        <p class="text-dark text-center mb-0"><?= $row; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-md-6">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan rutin #2</p>
                </div>
                <div class="p-2">
                    <?php foreach ($jadwalCoUnit2 as $row) : ?>
                        <p class="text-dark text-center mb-0"><?= $row; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

        <div class="col-xl-4 col-md-6">
            <div class="shadow mb-3 rounded" style="min-height: 160px;">

                <div class="p-2 bg_hijau1 rounded-top border_bottom2">
                    <i class="fas fa-book text-success fs-3"></i>
                    <p class="d-inline text-uppercase fw-bolder fs-5 text-success">kegiatan rutin common</p>
                </div>
                <div class="p-2">
                    <?php foreach ($jadwalCoCommon as $row) : ?>
                        <p class="text-dark text-center mb-0"><?= $row; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>
</div>