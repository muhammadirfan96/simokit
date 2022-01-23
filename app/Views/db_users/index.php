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
                            <a class="btn btn-sm btn-primary" href="/db_users/<?= $row["id"]; ?>" role="button"><i class="fas fa-eye"></i></a>

                            <?php if (in_groups('admin')) : ?>
                                <form class="d-inline" action="/db_users/<?= $row["id"]; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-warning mt-2" type="submit" onclick="return confirm('delete?')"><i class="fas fa-trash"></i></button>
                                </form>
                            <?php endif ?>
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

<?= $this->endSection(); ?>