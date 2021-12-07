<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database checklist peralatan</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_home">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col-md-6 mb-3">
            <form action="" method="post">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" autofocus="" placeholder="masukkan keyword pencarian..." value="">
                    <button class="btn btn-success" name="search" value="search" type="submit">search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 justify-content-end d-md-flex">
            <?= $pager->links('checklist', 'default_full'); ?>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div id="container" class="tabel">
                <?= $this->include('db_checklist/table'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>