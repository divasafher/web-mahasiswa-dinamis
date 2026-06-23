<form method="post">

<div class="form-group">
    <label>Mahasiswa</label>

    <select name="user_id" class="form-control">

        <?php foreach($users as $u): ?>

        <option value="<?= $u->id ?>">
            <?= $u->name ?>
        </option>

        <?php endforeach; ?>

    </select>
</div>

<div class="form-group">
    <label>NIM</label>
    <input type="text"
           name="nim"
           class="form-control">
</div>

<div class="form-group">
    <label>Program Studi</label>
    <input type="text"
           name="program_studi"
           class="form-control">
</div>

<div class="form-group">
    <label>Angkatan</label>
    <input type="text"
           name="angkatan"
           class="form-control">
</div>

<button type="submit"
        class="btn btn-primary">

    Simpan
</button>

</form>