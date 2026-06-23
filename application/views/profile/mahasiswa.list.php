<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Data Mahasiswa</h1>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Email</th>
    <th>NIM</th>
    <th>Program Studi</th>
    <th>Angkatan</th>
</tr>
</thead>

<tbody>

<?php
$no=1;
foreach($profiles as $row):
?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $row->name ?></td>
    <td><?= $row->email ?></td>
    <td><?= $row->nim ?></td>
    <td><?= $row->program_studi ?></td>
    <td><?= $row->angkatan ?></td>
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