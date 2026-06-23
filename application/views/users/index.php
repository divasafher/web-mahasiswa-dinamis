<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Manajemen User</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item active">User</li></ol></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success alert-auto-dismiss"><?= $this->session->flashdata('success') ?></div><?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger alert-auto-dismiss"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar User</h3>
          <a href="<?= site_url('users/create') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus mr-1"></i> Tambah User</a>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
              <?php foreach ($users as $i => $user): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= html_escape($user->name) ?></td>
                <td><?= html_escape($user->email) ?></td>
                <td><span class="badge badge-info"><?= ucfirst($user->role) ?></span></td>
                <td><span class="badge badge-<?= $user->is_active ? 'success' : 'secondary' ?>"><?= $user->is_active ? 'Aktif' : 'Nonaktif' ?></span></td>
                <td>
                  <a href="<?= site_url('users/edit/'.$user->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                  <button type="button" class="btn btn-danger btn-sm btn-delete" data-url="<?= site_url('users/delete/'.$user->id) ?>" data-title="<?= html_escape($user->name) ?>"><i class="fas fa-trash"></i> Nonaktifkan</button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Konfirmasi</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
      <div class="modal-body">Nonaktifkan user <strong id="deleteModalTitle"></strong>?</div>
      <div class="modal-footer">
        <?= form_open('', array('id' => 'deleteForm')) ?>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Nonaktifkan</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('layouts/footer'); ?>
