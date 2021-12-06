<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database service request</span></p>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col-md-6 mb-3">
            <form action="" method="post">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" autofocus="" placeholder="masukkan keyword pencarian..." id="keyword" value="">
                    <button class="btn btn-success" name="search" value="search" type="submit">search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 justify-content-end d-md-flex">
            <?= $pager->links('srcm', 'default_full'); ?>
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
                <?= $this->include('db_servicerequest/table'); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            $('#container').load('/db_servicerequest/table/' + $('#keyword').val());
        });
    });
</script>
<?= $this->endSection(); ?>