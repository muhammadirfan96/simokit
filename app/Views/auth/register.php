<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header bg-warning border-bottom border-3 border-danger">
                                <h3 class="text-center font-weight-light my-4"><?= lang('Auth.register') ?></h3>
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
                                                    <option <?= old('bidang') == 'operasi shift a' ? 'selected' : ''; ?> value="operasi shift a">Operasi shift A</option>
                                                    <option <?= old('bidang') == 'operasi shift b' ? 'selected' : ''; ?> value="operasi shift b">Operasi shift B</option>
                                                    <option <?= old('bidang') == 'operasi shift c' ? 'selected' : ''; ?> value="operasi shift c">Operasi shift C</option>
                                                    <option <?= old('bidang') == 'operasi shift d' ? 'selected' : ''; ?> value="operasi shift d">Operasi shift D</option>
                                                    <option disabled <?= old('bidang') == 'supervisor operasi shift a' ? 'selected' : ''; ?> value="supervisor operasi shift a">Supervisor operasi shift a</option>
                                                    <option disabled <?= old('bidang') == 'supervisor operasi shift b' ? 'selected' : ''; ?> value="supervisor operasi shift b">Supervisor operasi shift b</option>
                                                    <option disabled <?= old('bidang') == 'supervisor operasi shift c' ? 'selected' : ''; ?> value="supervisor operasi shift c">Supervisor operasi shift c</option>
                                                    <option disabled <?= old('bidang') == 'supervisor operasi shift d' ? 'selected' : ''; ?> value="supervisor operasi shift d">Supervisor operasi shift d</option>
                                                    <option disabled <?= old('bidang') == 'manager bagian operasi' ? 'selected' : ''; ?> value="manager bagian operasi">Manager Bagian Operasi</option>
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
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><?= lang('Auth.alreadyRegistered') ?> <a href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a></div>
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
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?= $this->endSection(); ?>