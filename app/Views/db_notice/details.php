<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">make notice</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_notice">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
    <form action="/db_notice/edit" method="post">
        <input type="hidden" name="id" value="<?= $notice['id']; ?>">
        <input type="hidden" name="maked_by" value="<?= $notice['maked_by']; ?>">
        <div class="row">
            <div class="col-md-6">
                <label class="fw-bold"><b>start time</b></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= $notice['start_time']; ?></span>
                    <input type="datetime-local" class="form-control" name="start_time">
                </div>
            </div>
            <div class="col-md-6">
                <label class="fw-bold"><b>end time</b></label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= $notice['end_time']; ?></span>
                    <input type="datetime-local" class="form-control" name="end_time">
                </div>
            </div>
            <div class="col-md-6">
                <label class="fw-bold"><b>content</b></label>
                <div class="input-group mb-3">
                    <textarea class="form-control" name="content"><?= $notice['content']; ?></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="dropdown">
                                <button class="btn bg_orange0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    notify to
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift a')) : ?>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="shiftA" name="shiftA" value="operator shift a " checked>
                                            <label class="form-check-label" for="shiftA">
                                                operator shift a
                                            </label>
                                        </li>
                                    <?php endif ?>

                                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift b')) : ?>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="shiftB" name="shiftB" value="operator shift b " checked>
                                            <label class="form-check-label" for="shiftB">
                                                operator shift b
                                            </label>
                                        </li>
                                    <?php endif ?>

                                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift c')) : ?>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="shiftC" name="shiftC" value="operator shift c " checked>
                                            <label class="form-check-label" for="shiftC">
                                                operator shift c
                                            </label>
                                        </li>
                                    <?php endif ?>

                                    <?php if (in_groups('admin') || in_groups('supervisor operasi shift d')) : ?>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="shiftD" name="shiftD" value="operator shift d " checked>
                                            <label class="form-check-label" for="shiftD">
                                                operator shift d
                                            </label>
                                        </li>
                                    <?php endif ?>

                                    <?php if (in_groups('admin')) : ?>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="SpvShiftA" name="SpvShiftA" value="supervisor operasi shift a " checked>
                                            <label class="form-check-label" for="SpvShiftA">
                                                sp. operasi shift a
                                            </label>
                                        </li>

                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="SpvShiftB" name="SpvShiftB" value="supervisor operasi shift b " checked>
                                            <label class="form-check-label" for="SpvShiftB">
                                                sp. operasi shift b
                                            </label>
                                        </li>

                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="SpvShiftC" name="SpvShiftC" value="supervisor operasi shift c " checked>
                                            <label class="form-check-label" for="SpvShiftC">
                                                sp. operasi shift c
                                            </label>
                                        </li>

                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="SpvShiftD" name="SpvShiftD" value="supervisor operasi shift d " checked>
                                            <label class="form-check-label" for="SpvShiftD">
                                                sp. operasi shift d
                                            </label>
                                        </li>
                                        <li>
                                            <input class="form-check-input ms-2" type="checkbox" id="manOP" name="manOP" value="manager bagian operasi " checked>
                                            <label class="form-check-label" for="manOP">
                                                man. operasi
                                            </label>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                        <div class="position-relative">
                            <div class="position-absolute top-0 end-0">
                                <button class="btn btn-success" type="submit">post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>