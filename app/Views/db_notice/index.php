<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database notice</span></p>
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
                    <th scope="col">start time</th>
                    <th scope="col">end time</th>
                    <th scope="col">maked by</th>
                    <th scope="col">notice to</th>
                    <th scope="col">content</th>
                    <th scope="col">up. by</th>
                    <th scope="col">up. at</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">action</th>
                    <th scope="col">start time</th>
                    <th scope="col">end time</th>
                    <th scope="col">maked by</th>
                    <th scope="col">notice to</th>
                    <th scope="col">content</th>
                    <th scope="col">up. by</th>
                    <th scope="col">up. at</th>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($notice as $row) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-primary my-1" href="/db_notice/<?= $row["id"]; ?>" role="button"><i class="fas fa-pen"></i></a>
                            <form class="d-inline <?= $row['id']; ?>" action="/db_notice/<?= $row["id"]; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-warning my-1" type="button" onclick="return konfirmasi(<?= $row['id']; ?>)"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        <td><?= $row["start_time"]; ?></td>
                        <td><?= $row["end_time"]; ?></td>
                        <td><?= $row["maked_by"]; ?></td>
                        <td><?= $row["notice_to"]; ?></td>
                        <td><?= $row["content"]; ?></td>
                        <td><?= $row["updated_by"]; ?></td>
                        <td><?= $row["updated_at"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= base_url('/js/sweetalert.js'); ?>"></script>
<?= $this->endSection(); ?>