<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">kpi monitoring</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <?php foreach ($users as $user) : ?>
            <div class="col-md-2 rounded shadow mb-3 mx-2 p-0">
                <a class="text-decoration-none" href="/kpi_monitoring/details/<?= $user['id']; ?>">
                    <div class="p-2 bg_hijau1 rounded-top">
                        <img class="rounded-circle" width="50px" height="50px" src="<?= base_url('img-profile/' . $user['picture']); ?>" alt="">
                    </div>
                    <div class="rounded-bottom pt-2">
                        <p class="text-dark text-center"><?= $user['fullname']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?= $this->endSection(); ?>