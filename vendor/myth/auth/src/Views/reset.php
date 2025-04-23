<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>

            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">

                        <div class="card mt-5">
                            <h2 class="card-header bg_hijau1 border_bottom"><?= lang('Auth.resetYourPassword') ?></h2>
                            <div class="card-body">

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <p><?= lang('Auth.enterCodeEmailPassword') ?></p>

                                <form action="<?= route_to('reset-password') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                                        <label for="token"><?= lang('Auth.token') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.token') ?>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                        <label for="email"><?= lang('Auth.email') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>
                                    </div>

                                    <!-- <br> -->

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.newPassword') ?>">
                                        <label for="password"><?= lang('Auth.newPassword') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?= lang('Auth.newPasswordRepeat') ?>">
                                        <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.pass_confirm') ?>
                                        </div>
                                    </div>

                                    <br>

                                    <button type="submit" class="btn btn-sm bg_orange0 text-light fst-italic btn-block"><?= lang('Auth.resetPassword') ?></button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Simokit 2021</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?= $this->endSection(); ?>