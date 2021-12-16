<form action="/input_limas/simpan" method="post">
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
                <?php $k = 1; ?>
                <?php foreach ($tables as $table) : ?>
                    <?php $j = 99; ?>
                    <?php foreach ($table as $tool) : ?>
                        <tr>
                            <td><?= $tool ?></td>
                            <?php for ($i = 1; $i <= $hari; $i++) : ?>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="<?= $i . $j . $k ?>" value="ya" <?= $schedule[$k - 1][$i - 1][$key[$k - 1][$j - 97]] == 'ya' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                            <?php endfor ?>
                        </tr>
                        <?php $j++ ?>
                    <?php endforeach ?>
                    <?php $k++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="position-relative">
        <div class="position-absolute top-0 end-0">
            <button class="btn btn-success btn-sm" type="submit" name="saveLimasBoiler">Save</button>
        </div>
    </div><br><br>
</form>