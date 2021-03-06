<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">user list</span></p>
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
                    <th scope="col">fullname</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">bidang</th>
                    <th scope="col">active</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th scope="col">reset at</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">action</th>
                    <th scope="col">fullname</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">bidang</th>
                    <th scope="col">active</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th scope="col">reset at</th>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($users as $row) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-primary my-1" href="/db_users/<?= $row["id"]; ?>" role="button"><i class="fas fa-eye"></i></a>

                            <form class="d-inline <?= $row['id']; ?>" onclick="return konfirmasi(<?= $row['id']; ?>)" action="/db_users/<?= $row["id"]; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-warning my-1" type="button" onclick="return konfirmasi(<?= $row['id']; ?>)"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        <td><?= $row["fullname"]; ?></td>
                        <td><?= $row["username"]; ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["bidang"] ?></td>
                        <td><?= $row["active"] ?></td>
                        <td><?= $row["created_at"] ?></td>
                        <td><?= $row["updated_at"] ?></td>
                        <td><?= $row["reset_at"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= base_url('/js/sweetalert.js'); ?>"></script>
<?= $this->endSection(); ?>