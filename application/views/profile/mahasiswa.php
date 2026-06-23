<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Profil Mahasiswa</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item active">Profil</li></ol></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success alert-auto-dismiss"><?= $this->session->flashdata('success') ?></div><?php endif; ?>
      <div class="card"><div class="card-body">
       <?= form_open_multipart('profile/mahasiswa') ?>
       <div class="col-md-12 form-group">

    <label>Foto Profil</label>

    <?php if(!empty($profile->photo)): ?>

        <div class="mb-2">
            <img src="<?= base_url('uploads/profiles/'.$profile->photo) ?>"
                 width="150"
                 class="img-thumbnail">
        </div>

    <?php endif; ?>

    <input type="file"
           name="photo"
           class="form-control"
           accept="image/*">

</div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Nama</label>
              <?= form_input(array('name' => 'name', 'class' => 'form-control', 'value' => set_value('name', $user->name), 'required' => 'required')) ?>
              <?= form_error('name', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-6 form-group">
              <label>Email</label>
              <?= form_input(array('class' => 'form-control', 'value' => $user->email, 'disabled' => 'disabled')) ?>
            </div>
            <div class="col-md-6 form-group">
              <label>NIM</label>
              <?= form_input(array('name' => 'nim', 'class' => 'form-control', 'value' => set_value('nim', $profile ? $profile->nim : ''), 'required' => 'required')) ?>
              <?= form_error('nim', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-6 form-group">
              <label>Program Studi</label>
              <?= form_input(array('name' => 'program_studi', 'class' => 'form-control', 'value' => set_value('program_studi', $profile ? $profile->program_studi : ''), 'required' => 'required')) ?>
              <?= form_error('program_studi', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-4 form-group">
              <label>Angkatan</label>
              <?= form_input(array('name' => 'angkatan', 'class' => 'form-control', 'value' => set_value('angkatan', $profile ? $profile->angkatan : ''), 'required' => 'required')) ?>
              <?= form_error('angkatan', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-4 form-group">
              <label>Jenis Kelamin</label>
              <?= form_dropdown('jenis_kelamin', array('' => 'Pilih', 'L' => 'Laki-laki', 'P' => 'Perempuan'), set_value('jenis_kelamin', $profile ? $profile->jenis_kelamin : ''), array('class' => 'form-control', 'required' => 'required')) ?>
              <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-4 form-group">
              <label>No HP</label>
              <?= form_input(array('name' => 'no_hp', 'class' => 'form-control', 'value' => set_value('no_hp', $profile ? $profile->no_hp : ''))) ?>
              <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-6 form-group">
              <label>Tempat Lahir</label>
              <?= form_input(array('name' => 'tempat_lahir', 'class' => 'form-control', 'value' => set_value('tempat_lahir', $profile ? $profile->tempat_lahir : ''))) ?>
              <?= form_error('tempat_lahir', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-6 form-group">
              <label>Tanggal Lahir</label>
              <?= form_input(array('name' => 'tanggal_lahir', 'type' => 'date', 'class' => 'form-control', 'value' => set_value('tanggal_lahir', $profile ? $profile->tanggal_lahir : ''))) ?>
              <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="col-md-12 form-group">
              <label>Alamat</label>
              <?= form_textarea(array('name' => 'alamat', 'class' => 'form-control', 'rows' => 3, 'value' => set_value('alamat', $profile ? $profile->alamat : ''))) ?>
              <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
            </div>
          <div class="mt-3">

<?php if($profile): ?>

<button type="submit"
        class="btn btn-warning">
    <i class="fas fa-edit"></i>
    Update Profil
</button>

<a href="<?= site_url('profile/delete_mahasiswa') ?>"
   class="btn btn-danger"
   onclick="return confirm('Yakin hapus profil?')">

    <i class="fas fa-trash"></i>
    Hapus Profil
</a>

<?php else: ?>
  <div class="col-md-12 form-group">
    <label>Foto Profil</label>

    <input type="file"
           name="photo"
           class="form-control"
           accept="image/*">
</div>

<button type="submit"
        class="btn btn-primary">

    <i class="fas fa-save"></i>
    Simpan Profil
</button>

<?php endif; ?>

</div></div>
    </div>
  </section>
</div>
<?php $this->load->view('layouts/footer'); ?>
