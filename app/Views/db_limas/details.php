<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">kegiatan 5s</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_limas">
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
            <form action="/db_limas/edit" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $limas['id']; ?>">
                <label class="fw-bold"><b>Nama Peralatan</b></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="namaPeralatan" value="<?= $limas['namaPeralatan']; ?>">
                </div>

                <label class="fw-bold"><b>Waktu</b></label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?= $limas['tanggal']; ?></span>
                    <input type="datetime-local" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="tanggal">
                </div>

                <label class="fw-bold"><b>Area</b></label><br>
                <div class="input-group mb-3">
                    <input type="text" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="area" value="<?= $limas['area']; ?>">
                </div>

                <label class="fw-bold">Keterangan:</label>
                <div class="border rounded px-3 py-3 mb-3" style="font-size: 10px;">
                    <p>1 = Belum memulai kegiatan 5S, tidak ada usaha sama sekali</p>
                    <p>2 = Sudah memulai kegiatan 5S, tetapi ada banyak perbaikan major <i>(perbaikan perlu beberapa hari)</i></p>
                    <p>3 = Cukup baik, hanya perlu beberapa improvement minor <i>(bisa langsung saat itu memperbaiki kondisi)</i></p>
                    <p>4 = sudah baik, hanya perlu sedikit improvement</p>
                    <p>5 = Sudah sangat baik, terus pertahankan kondisi seperti ini</p>
                </div>

                <?php $i = 1; ?>
                <?php foreach ($pertanyaan as $row) : ?>

                    <div class="mb-3 border py-3 rounded text-center">
                        <label><?= $row["pertanyaan"]; ?></label><br>
                        <input class="form-check-input mx-2" type="radio" name="nilai<?= $i; ?>" value="1" <?= $nilaiLimas['nilai' . $i] == "1" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2" type="radio" name="nilai<?= $i; ?>" value="2" <?= $nilaiLimas['nilai' . $i] == "2" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2" type="radio" name="nilai<?= $i; ?>" value="3" <?= $nilaiLimas['nilai' . $i] == "3" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2" type="radio" name="nilai<?= $i; ?>" value="4" <?= $nilaiLimas['nilai' . $i] == "4" ? 'checked' : ''; ?>>
                        <input class="form-check-input mx-2" type="radio" name="nilai<?= $i; ?>" value="5" <?= $nilaiLimas['nilai' . $i] == "5" ? 'checked' : ''; ?>>
                    </div>

                    <br>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <label class="fw-bold"><b>Saran</b></label><br>
                <div class="input-group mb-3">
                    <textarea type="text" class="form-control rounded" aria-label="Username" aria-describedby="basic-addon1" name="saran"><?= $limas['saran']; ?></textarea>
                </div>

                <label class="fw-bold">Sebelum 5S</label><a class="text-decoration-none" href="<?= base_url('img-5s/' . $limas['fotoSebelum']); ?>" target="_blank"> <?= $limas['fotoSebelum']; ?></a>
                <input class="form-control rounded mb-1 <?= ($validation->hasError('fotoSebelum')) ? 'is-invalid' : ''; ?>" type="file" name="fotoSebelum">
                <div class="invalid-feedback mb-2">
                    <?= $validation->getError('fotoSebelum'); ?>
                </div>

                <label class="fw-bold">Setelah 5S</label><a class="text-decoration-none" href="<?= base_url('img-5s/' . $limas['fotoSetelah']); ?>" target="_blank"> <?= $limas['fotoSetelah']; ?></a>
                <input class="form-control rounded mb-1 <?= ($validation->hasError('fotoSetelah')) ? 'is-invalid' : ''; ?>" type="file" name="fotoSetelah">
                <div class="invalid-feedback mb-2">
                    <?= $validation->getError('fotoSetelah'); ?>
                </div>

                <div class="position-relative mt-2">
                    <div class="position-absolute top-0 start-0">
                        <button style="pointer-events:<?= $limas["approved"] == 'y' ? 'none' : ''; ?>;" class="btn <?= $limas["approved"] == 'y' ? 'btn-secondary' : 'btn-primary'; ?> btn-sm" type="<?= $limas["approved"] == 'y' ? 'button' : 'submit'; ?>" name="save">Save Changes</button>
                    </div>
                </div>
            </form>
            <form style="margin-left: 105px;" action="/db_limas/<?= $limas["id"]; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="approve" value="y">
                <button style="pointer-events:<?= $limas["approved"] == 'y' ? 'none' : ''; ?>;" class="ms-1 btn btn-sm <?= $limas["approved"] == 'y' ? 'btn-success' : 'btn-danger'; ?>" type="<?= $limas["approved"] == 'y' ? 'button' : 'submit'; ?>"><?= $limas["approved"] == 'y' ? 'approved' : 'approve'; ?></i></button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>