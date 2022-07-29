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
            <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
            <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
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
                    <th scope="col">bidang</th>
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
                    <th scope="col">bidang</th>
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
                <?php $i = 0 ?>
                <?php foreach ($servicerequest as $row) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-success my-1" href="/db_servicerequest/details/<?= $row["id"]; ?>" role="button"><i class="fas fa-eye"></i></a>

                            <form class="d-inline <?= $row['id']; ?>" action="/db_servicerequest/<?= $row["id"]; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-warning my-1" type="button" onclick="return konfirmasi(<?= $row['id']; ?>)"><i class="fas fa-trash"></i></button>
                            </form>

                            <a style="pointer-events:<?= $row["approved"] == 'n' ? 'none' : ''; ?>;" class="btn btn-sm <?= $row["approved"] == 'n' ? 'btn-danger' : 'btn-primary'; ?> my-1" href="/db_servicerequest/<?= $row["id"]; ?>" role="button" target="_blank"><i class="fas fa-print"></i></a>

                        </td>
                        <td><?= $row["ket"]; ?></td>
                        <td><?= $row["diinput_oleh"]; ?></td>
                        <td><?= $bidang[$i]; ?></td>
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
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= base_url('/js/sweetalert.js'); ?>"></script>
<?= $this->endSection(); ?>