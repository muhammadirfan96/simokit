<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header bg_hijau1 border_bottom">
                                <h3 class="text-center my-4"><?= lang('Auth.forgotPassword') ?></h3>
                            </div>
                            <div class="card-body">
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <div class="small mb-3 text-muted">
                                    <?= lang('Auth.enterEmailForInstructions') ?>
                                </div>
                                <form action="<?= route_to('forgot') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-floating mb-3">
                                        <!-- <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" /> -->

                                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">

                                        <!-- <label for="inputEmail">Email address</label> -->

                                        <label for="email"><?= lang('Auth.emailAddress') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small text-decoration-none" href="/login">Return to login</a>
                                        <button type="submit" class="btn btn-sm bg_orange0 text-light fst-italic btn-block"><?= lang('Auth.sendInstructions') ?></button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a class="text-decoration-none" href="/register">Need an account? Sign up!</a></div>
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