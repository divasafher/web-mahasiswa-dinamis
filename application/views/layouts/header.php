<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? html_escape($title).' | ' : '' ?>Admin Panel</title>
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/custom/css/style.css') ?>">
  <script>const baseUrl = '<?= site_url('/') ?>';</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user-circle"></i>
        <?= html_escape($this->session->userdata('name')) ?>
        <span class="badge badge-info"><?= html_escape($this->session->userdata('role')) ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <?php if ($this->session->userdata('role') === 'mahasiswa'): ?>
        <a href="<?= site_url('profile/mahasiswa') ?>" class="dropdown-item">
          <i class="fas fa-id-card mr-2"></i> Profil Mahasiswa
        </a>
        <div class="dropdown-divider"></div>
        <?php endif; ?>
        <a href="<?= site_url('logout') ?>" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
