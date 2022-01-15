<?php if ($notice) : ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">notice</span></p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($notice as $n) : ?>
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header bg_hijau1">
                            <p class="mb-0 fw-bold"><?= $n['maked_by']; ?></p>
                            <p class="text-muted mb-0" style="font-size:12px;">posted at : <?= $n['start_time']; ?></p>
                            <?php if ($n['updated_by']) : ?>
                                <p class="text-muted mb-0" style="font-size:12px;">updated by : <?= $n['updated_by']; ?> at <?= $n['updated_at']; ?></p>
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $n['content']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>