<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header"><div class="container-fluid"><h1>Edit User</h1></div></section>
  <section class="content">
    <div class="container-fluid">
      <div class="card"><div class="card-body">
        <?= form_open('users/edit/'.$user->id) ?>
          <div class="form-group">
            <label>Nama</label>
            <?= form_input(array('name' => 'name', 'class' => 'form-control', 'value' => set_value('name', $user->name), 'required' => 'required')) ?>
            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Email</label>
            <?= form_input(array('name' => 'email', 'type' => 'email', 'class' => 'form-control', 'value' => set_value('email', $user->email), 'required' => 'required')) ?>
            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <?= form_password(array('name' => 'password', 'class' => 'form-control')) ?>
            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
          </div>
          <div class="form-group">
            <label>Role</label>
            <?= form_dropdown('role', $roles, set_value('role', $user->role), array('class' => 'form-control', 'required' => 'required')) ?>
            <?= form_error('role', '<small class="text-danger">', '</small>') ?>
          </div>
          <div class="form-group form-check">
            <?= form_checkbox('is_active', '1', set_checkbox('is_active', '1', (bool) $user->is_active), 'class="form-check-input" id="is_active"') ?>
            <label class="form-check-label" for="is_active">Aktif</label>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
          <a href="<?= site_url('users') ?>" class="btn btn-secondary">Batal</a>
        <?= form_close() ?>
      </div></div>
    </div>
  </section>
</div>
<?php $this->load->view('layouts/footer'); ?>
