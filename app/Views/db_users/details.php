<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">user details</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_users">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col mb-3">
            <form action="/db_users/edit" method="post" enctype="multipart/form-data">
                <div class="card">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <div class="card-header" style="background-color:#b7d5ac;">
                        <div>
                            <img class="logo img-thumbnail rounded-circle" src="<?= base_url('img-profile/' . $user['picture']); ?>">
                        </div>
                        <div>
                            <label for="picture">
                                <i class="fas fa-camera fs-3 text-secondary"></i>
                            </label>
                            <input class="d-none" type="file" name="picture" id="picture" onchange="previewImg()">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input id="inputUsername" name="username" type="text" class="form-control" value="<?= $user['username']; ?>" disabled>
                            <span id="btnUsername" class="btn btn-secondary" type="button"><i id="iconUsername" class="fas fa-lock"></i></span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputFullname" name="fullname" type="text" class="form-control" value="<?= $user['fullname']; ?>" disabled>
                            <span id="btnFullname" class="btn btn-secondary" type="button"><i id="iconFullname" class="fas fa-lock"></i></span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputBidang" name="bidang" type="text" class="form-control" value="<?= $user['bidang']; ?>" disabled>
                            <span id="btnBidang" class="btn btn-secondary" type="button"><i id="iconBidang" class="fas fa-lock"></i></span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputEmail" name="email" type="text" class="form-control" value="<?= $user['email']; ?>" disabled>
                            <span id="btnEmail" class="btn btn-secondary" type="button"><i id="iconEmail" class="fas fa-lock"></i></span>
                        </div>
                        <div class="input-group mb-3">
                            <input id="inputActive" name="active" type="text" class="form-control" value="<?= $user['active']; ?>" disabled>
                            <span id="btnActive" class="btn btn-secondary" type="button"><i id="iconActive" class="fas fa-lock"></i></span>
                        </div>

                        <label class="btn btn-sm btn-secondary">Signature</label><a href="<?= base_url('img-ttd/' . $user['signature']); ?>" class="ms-2 text-danger" target="_blank"><?= ($user['signature'] != "") ? "The user already have a signature" : "The user don't have a signature"; ?></a>
                        <br>
                        <div id="sig"></div>
                        <textarea id="signature64" name="signed" style="display: none"></textarea>

                        <div class="mt-2">
                            <button id="edit" class="btn btn-danger " type="button">edit</button>
                            <button disabled id="clear" class="btn btn-warning" type="button">clear</button>
                            <button disabled id="reset" class="btn btn-primary" type="reset">reset</button>
                            <button disabled id="save" class="btn btn-success" type="submit">save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('/js/db_userDetail.js'); ?>"></script>

<?= $this->endSection(); ?>