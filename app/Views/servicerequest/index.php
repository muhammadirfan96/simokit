<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">service request <?= $jenisSr; ?></span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesanSR')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesanSR'); ?>
                </div>
            <?php endif; ?>
            <form action="/servicerequest/simpan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="jenisSr" value="<?= $jenisSr; ?>">
                <label class="fw-bold">Nomor SR</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('nomorSr')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="nomorSr" value="<?= old('nomorSr'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nomorSr'); ?>
                    </div>
                </div>

                <label class="fw-bold">Tanggal</label>
                <div class="input-group mb-3">
                    <input type="datetime-local" class="form-control rounded <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="tanggal" value="<?= old('tanggal'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>

                <div class="text-center mb-3">
                    <label><b>Unit</b></label><br>
                    <input class="form-check-input <?= ($validation->hasError('unit')) ? 'is-invalid' : ''; ?>" type="radio" name="unit" id="1" value="#1" <?= old('unit') == "#1" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="1">#1</label>

                    <input class="form-check-input <?= ($validation->hasError('unit')) ? 'is-invalid' : ''; ?>" type="radio" name="unit" id="2" value="#2" <?= old('unit') == "#2" ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="2">#2</label>
                </div>

                <div class="text-center mb-3">
                    <label><b>Area</b></label><br>
                    <input class="form-check-input <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>" type="radio" name="area" id="turbin" value="turbin" <?= old('area') == "turbin" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="turbin">Turbin</label>

                    <input class="form-check-input <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>" type="radio" name="area" id="boiler" value="boiler" <?= old('area') == "boiler" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="boiler">Boiler</label>

                    <input class="form-check-input <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>" type="radio" name="area" id="wtp" value="wtp" <?= old('area') == "wtp" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="wtp">WTP</label>

                    <input class="form-check-input <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>" type="radio" name="area" id="electrical" value="electrical" <?= old('area') == "electrical" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="electrical">Electrical</label>
                </div>

                <label class="fw-bold">Nama Peralatan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('namaPeralatan')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="namaPeralatan" value="<?= old('namaPeralatan'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('namaPeralatan'); ?>
                    </div>
                </div>

                <label class="fw-bold">Nomor KKS</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('kks')) ? 'is-invalid' : ''; ?>" aria-label="Username" aria-describedby="basic-addon1" name="kks" value="<?= old('kks'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kks'); ?>
                    </div>
                </div>

                <label class="fw-bold">Uraian Gangguan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('uraianGangguan1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="uraianGangguan1" value="<?= old('uraianGangguan1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('uraianGangguan1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="uraianGangguan2" value="<?= old('uraianGangguan2'); ?>">
                </div><br>

                <label class="fw-bold">Deviasi / Normal Operasi</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('normalOperasi1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="normalOperasi1" value="<?= old('normalOperasi1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('normalOperasi1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="normalOperasi2" value="<?= old('normalOperasi2'); ?>">
                </div><br>

                <label class="fw-bold">Gejala</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('gejala1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="gejala1" value="<?= old('gejala1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('gejala1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="gejala2" value="<?= old('gejala2'); ?>">
                </div><br>

                <div class="text-center mb-3">
                    <label><b>Prioritas</b></label><br>
                    <input class="form-check-input <?= ($validation->hasError('prioritas')) ? 'is-invalid' : ''; ?>" type="radio" name="prioritas" id="emergency" value="emergency" <?= old('prioritas') == "emergency" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="emergency">1</label>

                    <input class="form-check-input <?= ($validation->hasError('prioritas')) ? 'is-invalid' : ''; ?>" type="radio" name="prioritas" id="urgent" value="urgent" <?= old('prioritas') == "urgent" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="urgent">2</label>

                    <input class="form-check-input <?= ($validation->hasError('prioritas')) ? 'is-invalid' : ''; ?>" type="radio" name="prioritas" id="normal" value="normal" <?= old('prioritas') == "normal" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="normal">3</label><br>
                    <i style="color: red; font-size: 10px;">1 = Emergency (hari yang sama), 2 = Urgent (1 s/d 2 minggu), 3 = Normal (2 s/d 4 minggu)</i>
                </div>

                <label class="fw-bold">Akibat Kerusakan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('akibatKerusakan1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="akibatKerusakan1" value="<?= old('akibatKerusakan1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('akibatKerusakan1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="akibatKerusakan2" value="<?= old('akibatKerusakan2'); ?>">
                </div><br>

                <label class="fw-bold">Kemungkinan Dampak</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('kemungkinanDampak1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="kemungkinanDampak1" value="<?= old('kemungkinanDampak1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kemungkinanDampak1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="kemungkinanDampak2" value="<?= old('kemungkinanDampak2'); ?>">
                </div><br>

                <label class="fw-bold">Tindakan Sementara</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded <?= ($validation->hasError('tindakanSementara1')) ? 'is-invalid' : ''; ?>" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara1" value="<?= old('tindakanSementara1'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tindakanSementara1'); ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara2" value="<?= old('tindakanSementara2'); ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="3." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara3" value="<?= old('tindakanSementara3'); ?>">
                </div>

                <label class="fw-bold"><?= $evidence ?></label>
                <input class="form-control mb-3 <?= ($validation->hasError('evidence1')) ? 'is-invalid' : ''; ?>" type="file" name="evidence1">
                <div class="invalid-feedback">
                    <?= $validation->getError('evidence1'); ?>
                </div>

                <?php if ($jenisSr == "flm") : ?>
                    <label class="fw-bold">Setelah FLM</label>
                    <input class="form-control mb-3 <?= ($validation->hasError('evidence2')) ? 'is-invalid' : ''; ?>" type="file" name="evidence2">
                    <div class="invalid-feedback">
                        <?= $validation->getError('evidence2'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($jenisSr == "cm") : ?>
                    <input class="form-control d-none" type="file" name="evidence2" value="">
                <?php endif; ?>
                <?php if (in_groups('admin') || in_groups('operator shift a') || in_groups('operator shift b') || in_groups('operator shift c') || in_groups('operator shift d')) : ?>
                    <div class="position-relative">
                        <div class="position-absolute top-0 end-0">
                            <button class="btn btn-success btn-sm" type="submit" name="save">Save</button>
                        </div>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>