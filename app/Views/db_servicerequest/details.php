<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">service request <?= $servicerequest['ket']; ?></span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_servicerequest">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <form action="/db_servicerequest/edit" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $servicerequest['id']; ?>">
                <label class="fw-bold">Nomor SR</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="nomorSr" value="<?= $servicerequest['nomorSr']; ?>">
                </div>

                <label class="fw-bold">Tanggal</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= $servicerequest['tanggal']; ?></span>
                    <input type="datetime-local" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="tanggal">
                </div>

                <div class="text-center mb-3">
                    <label><b>Unit</b></label><br>
                    <input class="form-check-input" type="radio" name="unit" id="1" value="#1" <?= $servicerequest['unit'] == "#1" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="1">#1</label>

                    <input class="form-check-input" type="radio" name="unit" id="2" value="#2" <?= $servicerequest['unit'] == "#2" ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="2">#2</label>
                </div>

                <div class="text-center mb-3">
                    <label><b>Area</b></label><br>
                    <input class="form-check-input" type="radio" name="area" id="turbin" value="turbin" <?= $servicerequest['area'] == "turbin" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="turbin">Turbin</label>

                    <input class="form-check-input" type="radio" name="area" id="boiler" value="boiler" <?= $servicerequest['area'] == "boiler" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="boiler">Boiler</label>

                    <input class="form-check-input" type="radio" name="area" id="wtp" value="wtp" <?= $servicerequest['area'] == "wtp" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="wtp">WTP</label>

                    <input class="form-check-input" type="radio" name="area" id="electrical" value="electrical" <?= $servicerequest['area'] == "electrical" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="electrical">Electrical</label>
                </div>

                <label class="fw-bold">Nama Peralatan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="namaPeralatan" value="<?= $servicerequest['namaPeralatan']; ?>">
                </div>

                <label class="fw-bold">Nomor KKS</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded " aria-label="Username" aria-describedby="basic-addon1" name="kks" value="<?= $servicerequest['kks']; ?>">
                </div>

                <label class="fw-bold">Uraian Gangguan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="uraianGangguan1" value="<?= $servicerequest['uraianGangguan1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="uraianGangguan2" value="<?= $servicerequest['uraianGangguan2']; ?>">
                </div><br>

                <label class="fw-bold">Deviasi / Normal Operasi</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="normalOperasi1" value="<?= $servicerequest['normalOperasi1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="normalOperasi2" value="<?= $servicerequest['normalOperasi2']; ?>">
                </div><br>

                <label class="fw-bold">Gejala</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="gejala1" value="<?= $servicerequest['gejala1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="gejala2" value="<?= $servicerequest['gejala2']; ?>">
                </div><br>

                <div class="text-center mb-3">
                    <label><b>Prioritas</b></label><br>
                    <input class="form-check-input" type="radio" name="prioritas" id="emergency" value="emergency" <?= $servicerequest['prioritas'] == "emergency" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="emergency">1</label>

                    <input class="form-check-input" type="radio" name="prioritas" id="urgent" value="urgent" <?= $servicerequest['prioritas'] == "urgent" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="urgent">2</label>

                    <input class="form-check-input" type="radio" name="prioritas" id="normal" value="normal" <?= $servicerequest['prioritas'] == "normal" ? 'checked' : ''; ?>>
                    <label class="form-check-label  me-3" for="normal">3</label><br>
                    <i style="color: red; font-size: 10px;">1 = Emergency (hari yang sama), 2 = Urgent (1 s/d 2 minggu), 3 = Normal (2 s/d 4 minggu)</i>
                </div>

                <label class="fw-bold">Akibat Kerusakan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="akibatKerusakan1" value="<?= $servicerequest['akibatKerusakan1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="akibatKerusakan2" value="<?= $servicerequest['akibatKerusakan2']; ?>">
                </div><br>

                <label class="fw-bold">Kemungkinan Dampak</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="kemungkinanDampak1" value="<?= $servicerequest['kemungkinanDampak1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="kemungkinanDampak2" value="<?= $servicerequest['kemungkinanDampak2']; ?>">
                </div><br>

                <label class="fw-bold">Tindakan Sementara</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" placeholder="1." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara1" value="<?= $servicerequest['tindakanSementara1']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="2." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara2" value="<?= $servicerequest['tindakanSementara2']; ?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="3." aria-label="Username" aria-describedby="basic-addon1" name="tindakanSementara3" value="<?= $servicerequest['tindakanSementara3']; ?>">
                </div>

                <label class="fw-bold"><?= $evidence ?></label><a class="text-decoration-none" href="<?= base_url('img-sr/' . $servicerequest['evidence1']); ?>" target="_blank"> <?= $servicerequest['evidence1']; ?></a>
                <input class="form-control mb-1 <?= ($validation->hasError('evidence1')) ? 'is-invalid' : ''; ?>" type="file" name="evidence1">
                <div class="invalid-feedback mb-2">
                    <?= $validation->getError('evidence1'); ?>
                </div>

                <?php if ($servicerequest['ket'] == "flm") : ?>
                    <label class="fw-bold">Setelah FLM</label><a class="text-decoration-none" href="<?= base_url('img-sr/' . $servicerequest['evidence2']); ?>" target="_blank"> <?= $servicerequest['evidence2']; ?></a>
                    <input class="form-control mb-1 <?= ($validation->hasError('evidence2')) ? 'is-invalid' : ''; ?>" type="file" name="evidence2">
                    <div class="invalid-feedback mb-2">
                        <?= $validation->getError('evidence2'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($servicerequest['ket'] == "cm") : ?>
                    <input class="form-control d-none" type="file" name="evidence2" value="">
                <?php endif; ?>
                <div class="position-relative mt-2">
                    <div class="position-absolute top-0 start-0">
                        <button style="pointer-events:<?= $servicerequest["approved"] == 'y' ? 'none' : ''; ?>;" class="btn <?= $servicerequest["approved"] == 'y' ? 'btn-secondary' : 'btn-primary'; ?> btn-sm" type="<?= $servicerequest["approved"] == 'y' ? 'button' : 'submit'; ?>" name="save">Save Changes</button>
                    </div>
                </div>
            </form>
            <form style="margin-left: 105px;" action="/db_servicerequest/<?= $servicerequest["id"]; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="approve" value="y">
                <button style="pointer-events:<?= $servicerequest["approved"] == 'y' ? 'none' : ''; ?>;" class="ms-1 btn btn-sm <?= $servicerequest["approved"] == 'y' ? 'btn-success' : 'btn-danger'; ?>" type="<?= $servicerequest["approved"] == 'y' ? 'button' : 'submit'; ?>"><?= $servicerequest["approved"] == 'y' ? 'approved' : 'approve'; ?></i></button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>