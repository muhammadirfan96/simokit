<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">checklist <?= $checklist['namaPeralatan']; ?></span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_checklist">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
            <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
            <form action="/db_checklist/edit" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="namaPeralatan" value="<?= $checklist['namaPeralatan']; ?>">
                <input type="hidden" name="jumlahPertanyaan" value="<?= count($pertanyaan); ?>">
                <input type="hidden" name="id" value="<?= $checklist['id']; ?>">

                <label class="fw-bold"><b>Nama Pelaksana</b></label>
                <div class="input-group mb-3">

                    <div class="dropdown">
                        <button class="btn bg_orange0 dropdown-toggle px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih nama pelaksana
                        </button>
                        <ul class="dropdown-menu overflow-auto" aria-labelledby="dropdownMenuButton1">
                            <?php foreach ($users as $user) : ?>
                                <li>
                                    <input class="form-check-input ms-2" type="checkbox" id="<?= $user['username']; ?>" name="<?= $user['username']; ?>" value="<?= $user['username']; ?>" <?= str_contains($checklist['diinput_oleh'], $user['username']) ? 'checked' : ''; ?>>
                                    <label class="form-check-label me-2" for="<?= $user['username']; ?>">
                                        <?= $user['fullname']; ?>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>

                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $row) : ?>
                    <p><?= $row["pertanyaan"]; ?></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pertanyaan<?= $i; ?>" value="ya" id="pertanyaan<?= $i; ?>" <?= $jawaban['jawaban' . $i] == "ya" ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pertanyaan<?= $i; ?>">Ya</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pertanyaan<?= $i; ?>" value="tidak" id="pertanyaan<?= $i; ?>a" <?= $jawaban['jawaban' . $i] == "tidak" ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pertanyaan<?= $i; ?>a">Tidak</label>
                    </div>

                    <div class="form-grup mb-3">
                        <textarea name="komen<?= $i; ?>" class="form-control" id="floatingTextarea"><?= $komen['komen' . $i]; ?></textarea>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <b>CATATAN</b>
                <textarea name="catatan" class="form-control mb-3" id="floatingTextarea"><?= $checklist['catatan']; ?></textarea>
                <div class="position-relative">
                    <div class="position-absolute top-0 start-0">
                        <button style="pointer-events:<?= $checklist["approved"] == 'y' ? 'none' : ''; ?>;" class="btn <?= $checklist["approved"] == 'y' ? 'btn-secondary' : 'btn-primary'; ?> btn-sm" type="<?= $checklist["approved"] == 'y' ? 'button' : 'submit'; ?>" name="save">Save Changes</button>
                    </div>
                </div>
            </form>
            <form style="margin-left: 105px;" action="/db_checklist/<?= $checklist["id"]; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="approve" value="y">
                <button style="pointer-events:<?= $checklist["approved"] == 'y' ? 'none' : ''; ?>;" class="ms-1 btn btn-sm <?= $checklist["approved"] == 'y' ? 'btn-success' : 'btn-danger'; ?>" type="<?= $checklist["approved"] == 'y' ? 'button' : 'submit'; ?>"><?= $checklist["approved"] == 'y' ? 'approved' : 'approve'; ?></i></button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>