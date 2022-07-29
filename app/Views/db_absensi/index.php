<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database absensi</span></p>
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
                    <th scope="col">action</th>
                    <th scope="col">diinput</th>
                    <th scope="col">waktu absensi</th>
                    <th scope="col">shift</th>
                    <th scope="col">sakit</th>
                    <th scope="col">izin</th>
                    <th scope="col">sppd</th>
                    <th scope="col">mangkir</th>
                    <th scope="col">catatan</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">action</th>
                    <th scope="col">diinput</th>
                    <th scope="col">waktu absensi</th>
                    <th scope="col">shift</th>
                    <th scope="col">sakit</th>
                    <th scope="col">izin</th>
                    <th scope="col">sppd</th>
                    <th scope="col">mangkir</th>
                    <th scope="col">catatan</th>
                </tr>
            </tfoot>

            <tbody>
                <?php $i = 0 ?>
                <?php foreach ($absensi as $row) : ?>
                    <tr>
                        <td>
                            <button class="btn btn-sm text-white bg_merah0 fst-italic" type="button" onclick="return konfir('db_absensi','delete','<?= $row['id']; ?>',null)">delete</button>
                        </td>
                        <td><?= $nama[$i] . ' | ' . $waktu[$i]; ?></td>
                        <td><?= $row["waktu"]; ?></td>
                        <td><?= $row["shift"]; ?></td>
                        <td><?= $row["sakit"]; ?></td>
                        <td><?= $row["izin"]; ?></td>
                        <td><?= $row["sppd"]; ?></td>
                        <td><?= $row["mangkir"]; ?></td>
                        <td><?= $row["catatan"]; ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?= base_url('/js/sweetalert.js'); ?>"></script>
<?= $this->endSection(); ?>