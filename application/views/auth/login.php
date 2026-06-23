<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Admin Panel</title>
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/custom/css/style.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo text-white"><b>Halaman</b>Login</div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masuk untuk memulai sesi</p>
      <?php if ($this->session->flashdata('error')): ?>
        <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>
        <div class="alert alert-danger alert-auto-dismiss"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>
      <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
      <?= form_open('login') ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      <?= form_close() ?>
      <p class="mt-3 mb-0">
    <a href="<?= base_url('auth/forgot_password') ?>">
    Forgot password?
</a>
</p>
    </div>
  </div>
</div>
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/custom/js/app.js') ?>"></script>
</body>
</html>