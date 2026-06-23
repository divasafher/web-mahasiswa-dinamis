<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Dashboard</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item">Home</li><li class="breadcrumb-item active">Dashboard</li></ol></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $total_articles ?></h3><p>Total Artikel</p></div><div class="icon"><i class="fas fa-newspaper"></i></div></div></div>
        <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $total_published ?></h3><p>Published</p></div><div class="icon"><i class="fas fa-check-circle"></i></div></div></div>
        <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $total_draft ?></h3><p>Draft</p></div><div class="icon"><i class="fas fa-edit"></i></div></div></div>
        <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3><?= $total_materials ?></h3><p>Total Materi</p></div><div class="icon"><i class="fas fa-book"></i></div></div></div>
        <?php if ($this->session->userdata('role') === 'admin'): ?>
        <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3><?= $total_users ?></h3><p>Total User</p></div><div class="icon"><i class="fas fa-users"></i></div></div></div>
        <?php endif; ?>
      </div>
      <div class="card">
        <div class="card-header"><h3 class="card-title">Artikel Terbaru</h3></div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead><tr><th>#</th><th>Judul</th><th>Author</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
              <?php foreach ($recent_articles as $i => $article): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= html_escape($article->title) ?></td>
                <td><?= html_escape($article->author_name) ?></td>
                <td><span class="badge badge-<?= $article->status ?>"><?= ucfirst($article->status) ?></span></td>
                <td><?= date('d M Y H:i', strtotime($article->created_at)) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('layouts/footer'); ?>
