<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Artikel</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item active">Artikel</li></ol></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="flash-container">
        <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success alert-auto-dismiss"><?= $this->session->flashdata('success') ?></div><?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger alert-auto-dismiss"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Artikel</h3>
          <a href="<?= site_url('articles/create') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus mr-1"></i> Tambah Artikel</a>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped datatable">
            <thead><tr><th>#</th><th>Judul</th><th>Author</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
              <?php foreach ($articles as $i => $article): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= html_escape($article->title) ?></td>
                <td><?= html_escape($article->author_name) ?></td>
                <td><span class="badge badge-<?= $article->status ?>"><?= ucfirst($article->status) ?></span></td>
                <td><?= date('d M Y H:i', strtotime($article->created_at)) ?></td>
                <td>
                  <a href="<?= site_url('articles/edit/'.$article->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                  <button type="button" class="btn btn-danger btn-sm btn-delete" data-url="<?= site_url('articles/delete/'.$article->id) ?>" data-title="<?= html_escape($article->title) ?>"><i class="fas fa-trash"></i> Delete</button>
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
      <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
      <div class="modal-body">Hapus artikel <strong id="deleteModalTitle"></strong>?</div>
      <div class="modal-footer">
        <?= form_open('', array('id' => 'deleteForm')) ?>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('layouts/footer'); ?>
