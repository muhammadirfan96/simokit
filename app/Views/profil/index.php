<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">user profile</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col mb-3">
            <form action="/profil/edit" method="post">
                <div class="card">
                    <input type="hidden" name="id" value="<?= user()->id; ?>">
                    <div class="card-header d-inline" style="background-color:#b7d5ac;">
                        <div><img class="logo img-thumbnail rounded-circle" src="<?= base_url('img-dev/default.png'); ?>" alt=""></div>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input id="inputUsername" name="username" type="text" class="form-control" value="<?= user()->username; ?>" disabled>
                            <button id="btnUsername" class="btn btn-secondary" type="button"><i class="fas fa-pen"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputFullname" name="fullname" type="text" class="form-control" value="<?= user()->fullname; ?>" disabled>
                            <button id="btnFullname" class="btn btn-secondary" type="button"><i class="fas fa-pen"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputBidang" name="bidang" type="text" class="form-control" value="<?= user()->bidang; ?>" disabled>
                            <button id="btnBidang" class="btn btn-secondary" type="button"><i class="fas fa-pen"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputEmail" name="email" type="text" class="form-control" value="<?= user()->email; ?>" disabled>
                            <button id="btnEmail" class="btn btn-secondary" type="button"><i class="fas fa-pen"></i></button>
                        </div>
                        <div id="saveandreset">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('/js/profil.js'); ?>"></script>
<?= $this->endSection(); ?>