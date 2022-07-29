<?php foreach ($ket as $row) : ?>
    <div class="col-md-6 col-lg-4 col-xl-2">
        <div class="rounded shadow p-2 mb-3">
            <span class="fw-bold text-light text-uppercase px-2 rounded bg_orange0"><?= $row; ?></span>
            <div class="overflow-auto mb-2" style="max-height: 380px;">
                <table class="table table-sm">
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td>
                                <input class="form-check-input ms-2" type="radio" id="<?= $user['username'] . $row; ?>" name="<?= $user['username']; ?>" value="<?= $row; ?>">
                            </td>
                            <td width="97%">
                                <label class="form-check-label me-2 text-lowercase" for="<?= $user['username'] . $row; ?>">
                                    <?= $user['fullname']; ?>
                                </label>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
<?php endforeach ?>