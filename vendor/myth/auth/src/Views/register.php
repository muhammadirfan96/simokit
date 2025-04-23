<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header bg_hijau1 border_bottom">
                                <h3 class="text-center my-4"><?= lang('Auth.register') ?></h3>
                            </div>
                            <div class="card-body">
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form action="<?= route_to('register') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" id="fullname" type="text" placeholder="Nama Pegawai" value="<?= old('fullname') ?>" name="fullname" />
                                                <label for="fullname">Nama Pegawai</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" type="text" placeholder="Username (NIP)" value="<?= old('username') ?>" name="username" />
                                                <label for="username">Username (NIP)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" type="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" name="email" />
                                                <label for="email"><?= lang('Auth.email') ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">

                                                <select class="form-select <?php if (session('errors.bidang')) : ?>is-invalid<?php endif ?>" id="inputGroupSelect01" name="bidang">
                                                    <option disabled selected>Bidang</option>
                                                    <?php foreach ($group as $item) : ?>
                                                        <option class="text-capitalize" <?= old('bidang') == $item['name'] ? 'selected' : ''; ?> value="<?= $item['name']; ?>"><?= $item['name']; ?></option>
                                                    <?php endforeach ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" type="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" name="password" />
                                                <label for="password"><?= lang('Auth.password') ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="pass_confirm" type="password" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" name="pass_confirm" />
                                                <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-sm bg_orange0 fst-italic text-light btn-block"><?= lang('Auth.register') ?></button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><?= lang('Auth.alreadyRegistered') ?> <a class="text-decoration-none" href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a></div>
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