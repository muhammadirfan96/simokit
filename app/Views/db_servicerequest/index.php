<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database service request</span></p>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <input type="text" name="keyword" size="40" autofocus="" placeholder="masukkan keyword pencarian..." autocomplete="off" id="keyword">
                <!-- <button type="submit" name="cari" id="tombol-cari">cari</button> -->
            </form>
            <i style="font-size: 12px; color: red;">* Pencarian berdasarkan kolom diinput oleh, tanggal, nomor SR atau area</i>
            <br><br>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary show" type="button">tampilkan</button>
                <button class="btn btn-success hide" type="button">sembunyikan</button>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div id="container" class="tabel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-success text-center text-capitalize align-middle">
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">aksi</th>
                                <th scope="col">ket</th>
                                <th scope="col">diinput oleh</th>
                                <th scope="col">nomor sr</th>
                                <th scope="col">tanggal</th>
                                <th scope="col">unit</th>
                                <th scope="col">area</th>
                                <th scope="col">nama peralatan</th>
                                <th scope="col">KKS</th>
                                <th scope="col">uraian gangguan 1</th>
                                <th scope="col">uraian gangguan 2</th>
                                <th scope="col">normal operasi 1</th>
                                <th scope="col">normal operasi 2</th>
                                <th scope="col">gejala 1</th>
                                <th scope="col">gejala 2</th>
                                <th scope="col">prioritas</th>
                                <th scope="col">akibat kerusakan 1</th>
                                <th scope="col">akibat kerusakan 2</th>
                                <th scope="col">kemungkinan dampak 1</th>
                                <th scope="col">kemungkinan dampak 2</th>
                                <th scope="col">tindakan sementara 1</th>
                                <th scope="col">tindakan sementara 2</th>
                                <th scope="col">tindakan sementara 3</th>
                                <th scope="col">evidence 1</th>
                                <th scope="col">evidence 2</th>
                            </tr>
                        </thead>

                        <?php $i = 1; ?>
                        <?php foreach ($servicerequest as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <a class="btn btn-sm btn-danger mb-2" href="/db_servicerequest/<?= $row["id"]; ?>" role="button" target="_blank">print</a>

                                    <form action="/db_servicerequest/<?= $row["id"]; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-secondary" type="submit" onclick="return confirm('delete?')">delete</button>
                                    </form>
                                </td>
                                <td><?= $row["ket"]; ?></td>
                                <td><?= $row["diinput_oleh"]; ?></td>
                                <td><?= $row["nomorSr"] ?></td>
                                <td><?= $row["tanggal"] ?></td>
                                <td><?= $row["unit"]; ?></td>
                                <td><?= $row["area"]; ?></td>
                                <td><?= $row["namaPeralatan"]; ?></td>
                                <td><?= $row["kks"]; ?></td>
                                <td><?= $row["uraianGangguan1"]; ?></td>
                                <td><?= $row["uraianGangguan2"]; ?></td>
                                <td><?= $row["normalOperasi1"]; ?></td>
                                <td><?= $row["normalOperasi2"]; ?></td>
                                <td><?= $row["gejala1"]; ?></td>
                                <td><?= $row["gejala2"]; ?></td>
                                <td><?= $row["prioritas"]; ?></td>
                                <td><?= $row["akibatKerusakan1"]; ?></td>
                                <td><?= $row["akibatKerusakan2"]; ?></td>
                                <td><?= $row["kemungkinanDampak1"]; ?></td>
                                <td><?= $row["kemungkinanDampak2"]; ?></td>
                                <td><?= $row["tindakanSementara1"]; ?></td>
                                <td><?= $row["tindakanSementara2"]; ?></td>
                                <td><?= $row["tindakanSementara3"]; ?></td>
                                <td>
                                    <img src="<?= base_url(); ?>/img-sr/<?= $row["evidence1"]; ?>" width="100px;" height="60px;">
                                </td>
                                <td>
                                    <img src="<?= base_url(); ?>/img-sr/<?= $row["evidence2"]; ?>" width="100px;" height="60px;">
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>