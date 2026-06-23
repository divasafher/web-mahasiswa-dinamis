<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header"><div class="container-fluid"><h1>Edit Materi</h1></div></section>
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger alert-auto-dismiss"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
      <div class="card"><div class="card-body">
        <?= form_open_multipart('materials/edit/'.$material->id) ?>
          <div class="form-group">
            <label>Judul Materi</label>
            <?= form_input(array('name' => 'title', 'class' => 'form-control', 'value' => set_value('title', $material->title), 'required' => 'required')) ?>
            <?= form_error('title', '<small class="text-danger">', '</small>') ?>
          </div>
         <div class="form-group">
    <label>Ganti File Materi</label>
    <?= form_upload(array(
        'name' => 'material_file',
        'class' => 'form-control',
        'accept' => '.pdf,.jpg,.jpeg,.png,.xls,.xlsx'
    )) ?>
    <small class="text-muted">
        Format yang diizinkan: PDF, JPG, JPEG, PNG, XLS, XLSX
    </small>
</div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
          <a href="<?= site_url('materials') ?>" class="btn btn-secondary">Batal</a>
        <?= form_close() ?>
      </div></div>
    </div>
  </section>
</div>
<?php $this->load->view('layouts/footer'); ?>
