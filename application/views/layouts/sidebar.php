<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= site_url('dashboard') ?>" class="brand-link">
    <span class="brand-text font-weight-light"><b>Dashboard</b></span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <li class="nav-item">
          <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('articles') ?>" class="nav-link <?= $this->uri->segment(1) == 'articles' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-newspaper"></i><p>Artikel</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('materials') ?>" class="nav-link <?= $this->uri->segment(1) == 'materials' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-book"></i><p>Materi</p>
          </a>
        </li>
        <?php if ($this->session->userdata('role') === 'mahasiswa'): ?>
        <li class="nav-item">
          <a href="<?= site_url('profile/mahasiswa') ?>" class="nav-link <?= $this->uri->segment(1) == 'profile' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-id-card"></i><p>Profil Mahasiswa</p>
          </a>
        </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('role') === 'admin'): ?>
        <li class="nav-item">
          <a href="<?= site_url('users') ?>" class="nav-link <?= $this->uri->segment(1) == 'users' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i><p>Manajemen User</p>
          </a>
        </li>
        <?php endif; ?>
        <?php if($this->session->userdata('role') == 'admin'): ?>

<li class="nav-item">
    <a href="<?= site_url('profile/mahasiswa_list') ?>"
       class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Data Mahasiswa</p>
    </a>
</li>

<?php endif; ?>
<?php if($this->session->userdata('role') == 'admin'): ?>

<li class="nav-item">
    <a href="<?= site_url('mahasiswa') ?>" class="nav-link">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>Data Mahasiswa</p>
    </a>
</li>

<?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>
