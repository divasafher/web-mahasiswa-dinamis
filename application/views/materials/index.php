<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Materi</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item active">Materi</li></ol></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success alert-auto-dismiss"><?= $this->session->flashdata('success') ?></div><?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger alert-auto-dismiss"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Materi PDF</h3>
          <?php if (in_array($this->session->userdata('role'), array('admin', 'dosen'), TRUE)): ?>
          <a href="<?= site_url('materials/create') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-upload mr-1"></i> Upload Materi</a>
          <?php endif; ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
              <thead><tr><th>#</th><th>Judul</th><th>Dosen</th><th>File</th><th>Tanggal</th><th>Aksi</th></tr></thead>
              <tbody>
                <?php foreach ($materials as $i => $material): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td>
                    <strong><?= html_escape($material->title) ?></strong>
                    <?php if ($material->description): ?><div class="text-muted small"><?= html_escape($material->description) ?></div><?php endif; ?>
                  </td>
                  <td><?= html_escape($material->lecturer_name) ?></td>
                  <td><?= html_escape($material->original_name) ?></td>
                  <td><?= date('d M Y H:i', strtotime($material->created_at)) ?></td>
                  <td>
                    <a href="<?= base_url('uploads/materials/'.$material->file_name) ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-book-open"></i> Baca</a>
                    <a href="<?= site_url('materials/download/'.$material->id) ?>" class="btn btn-secondary btn-sm"><i class="fas fa-download"></i> Download</a>
                    <?php if (in_array($this->session->userdata('role'), array('admin', 'dosen'), TRUE)): ?>
                    <a href="<?= site_url('materials/edit/'.$material->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-url="<?= site_url('materials/delete/'.$material->id) ?>" data-title="<?= html_escape($material->title) ?>"><i class="fas fa-trash"></i> Delete</button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
      <div class="modal-body">Hapus materi <strong id="deleteModalTitle"></strong>?</div>
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
