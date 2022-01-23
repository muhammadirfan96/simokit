<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database service request</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_home">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead class="table-success text-capitalize">
                <tr>
                    <th scope="col">aksi</th>
                    <th scope="col">ket</th>
                    <th scope="col">diinput oleh</th>
                    <th scope="col">nomor sr</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">unit</th>
                    <th scope="col">area</th>
                    <th scope="col">nama peralatan</th>
                    <th scope="col">KKS</th>
                    <th scope="col">ur. gangguan(1)</th>
                    <th scope="col">ur. gangguan(2)</th>
                    <th scope="col">nor. operasi(1)</th>
                    <th scope="col">nor. operasi(2)</th>
                    <th scope="col">gejala(1)</th>
                    <th scope="col">gejala(2)</th>
                    <th scope="col">prioritas</th>
                    <th scope="col">ak. kerusakan(1)</th>
                    <th scope="col">ak. kerusakan(2)</th>
                    <th scope="col">kem. dampak(1)</th>
                    <th scope="col">kem. dampak(2)</th>
                    <th scope="col">tin. sementara(1)</th>
                    <th scope="col">tin. sementara(2)</th>
                    <th scope="col">tin. sementara(3)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">aksi</th>
                    <th scope="col">ket</th>
                    <th scope="col">diinput oleh</th>
                    <th scope="col">nomor sr</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">unit</th>
                    <th scope="col">area</th>
                    <th scope="col">nama peralatan</th>
                    <th scope="col">KKS</th>
                    <th scope="col">ur. gangguan(1)</th>
                    <th scope="col">ur. gangguan(2)</th>
                    <th scope="col">nor. operasi(1)</th>
                    <th scope="col">nor. operasi(2)</th>
                    <th scope="col">gejala(1)</th>
                    <th scope="col">gejala(2)</th>
                    <th scope="col">prioritas</th>
                    <th scope="col">ak. kerusakan(1)</th>
                    <th scope="col">ak. kerusakan(2)</th>
                    <th scope="col">kem. dampak(1)</th>
                    <th scope="col">kem. dampak(2)</th>
                    <th scope="col">tin. sementara(1)</th>
                    <th scope="col">tin. sementara(2)</th>
                    <th scope="col">tin. sementara(3)</th>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($servicerequest as $rows) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td>
                                <?php if (in_groups('admin')) : ?>
                                    <a class="btn btn-sm btn-primary" href="/db_servicerequest/<?= $row["id"]; ?>" role="button" target="_blank"><i class="fas fa-print"></i></a>

                                    <form action="/db_servicerequest/<?= $row["id"]; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-warning mt-2" type="submit" onclick="return confirm('delete?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                <?php endif ?>
                                <form action="/db_servicerequest/<?= $row["id"]; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="approve" value="y">
                                    <button class="btn btn-sm <?= $row["approved"] == 'y' ? 'btn-success' : 'btn-danger'; ?> mt-2" type="<?= $row["approved"] == 'y' ? 'button' : 'submit'; ?>"><?php if (in_groups('admin')) : ?> <i class="fas fa-check-double"></i> <?php endif; ?> <?php if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) : ?> <?= $row["approved"] == 'y' ? 'approved' : 'approve'; ?> <?php endif; ?></button>
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
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>