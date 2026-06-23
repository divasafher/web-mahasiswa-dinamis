<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2"><div class="col-sm-6"><h1>Tambah Artikel</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item">Artikel</li><li class="breadcrumb-item active">Tambah</li></ol></div></div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <?= form_open('articles/create') ?>
            <div class="form-group">
              <label for="title">Judul</label>
              <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => 'form-control', 'value' => set_value('title'), 'required' => 'required')) ?>
              <?= form_error('title', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="content">Konten</label>
              <?= form_textarea(array('name' => 'content', 'id' => 'content', 'class' => 'form-control', 'rows' => 8, 'value' => set_value('content'), 'required' => 'required')) ?>
              <?= form_error('content', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <?= form_dropdown('status', array('draft' => 'Draft', 'published' => 'Published'), set_value('status', 'draft'), array('id' => 'status', 'class' => 'form-control', 'required' => 'required')) ?>
              <?= form_error('status', '<small class="text-danger">', '</small>') ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            <a href="<?= site_url('articles') ?>" class="btn btn-secondary">Batal</a>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('layouts/footer'); ?>