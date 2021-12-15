<form action="/input_co/simpan" method="post">
    <input type="hidden" name="<?= $bagian; ?>" value="v">
    <div class="table-responsive mb-3">
        <table class="table table-hover table-border">
            <thead class="table-success text-capitalize align-middle">
                <tr>
                    <th><?= $bagian; ?></th>
                    <th colspan="<?= $hari ?>" class="text-center"><?= date('F Y') ?></th>
                </tr>
                <tr>
                    <th class="text-center">nama peralatan</th>
                    <?php for ($i = 1; $i <= $hari; $i++) : ?>
                        <th><?= $i; ?></th>
                    <?php endfor ?>
                </tr>
            </thead>
            <tbody>
                <?php $j = 99; ?>
                <?php foreach ($tools as $tool) : ?>
                    <tr>
                        <td><?= $tool ?></td>
                        <?php for ($i = 1; $i <= $hari; $i++) : ?>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="<?= $i . $j ?>" value="ya" <?= $schedule[$i - 1][$key[$j - 97]] == 'ya' ? 'checked' : ''; ?>>
                                </div>
                            </td>
                        <?php endfor ?>
                    </tr>
                    <?php $j++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="position-relative">
        <div class="position-absolute top-0 end-0">
            <button class="btn btn-success btn-sm" type="submit">Save</button>
        </div>
    </div><br><br>
</form>