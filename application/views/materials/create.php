<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Upload Materi</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-auto-dismiss">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">

                    <?= form_open_multipart('materials/create') ?>

                    <div class="form-group">
                        <label>Judul Materi</label>
                        <?= form_input([
                            'name' => 'title',
                            'class' => 'form-control',
                            'value' => set_value('title'),
                            'required' => 'required'
                        ]) ?>
                        <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <?= form_textarea([
                            'name' => 'description',
                            'class' => 'form-control',
                            'rows' => 4
                        ], set_value('description')) ?>
                        <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>File Materi</label>
                        <?= form_upload([
                            'name' => 'material_file',
                            'class' => 'form-control',
                            'accept' => '.pdf,.jpg,.jpeg,.png,.xls,.xlsx',
                            'required' => 'required'
                        ]) ?>

                        <small class="text-muted">
                            Format: PDF, JPG, JPEG, PNG, XLS, XLSX
                        </small>

                        <?= form_error('material_file', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload mr-1"></i> Upload
                    </button>

                    <a href="<?= site_url('materials') ?>" class="btn btn-secondary">
                        Batal
                    </a>

                    <?= form_close() ?>

                </div>
            </div>

        </div>
    </section>

</div>

<?php $this->load->view('layouts/footer'); ?>