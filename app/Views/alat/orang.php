<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
	<div class="row">
		<div class="col">
			<a href="/alat/tambahorang" class="btn btn-primary mb-4">Tambah Orang</a>
			<?php if (session()->getFlashdata('pesan')) : ?>
			  <div class="alert alert-success" role="alert">
			    <?= session()->getFlashdata('pesan'); ?>
			  </div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table table-bordered" width="100%" cellspacing="0">
			    <thead>
			        <tr>
			            <th>No</th>
			            <th>Nama</th>
			            <th>NIK</th>
			            <th>Alamat</th>
			            <th>opsi</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $no = 1; ?>
			    	<?php foreach ($orang as $o) : ?>
				        <tr>
				            <td><?= $no++; ?></td>
				            <td><?= $o['nama']; ?></td>
				            <td><?= $o['nik']; ?></td>
				            <td><?= $o['alamat']; ?></td>
				            <td>
				            	<a href="/alat/editorang/<?= $o['nik']; ?>" class="badge badge-warning">edit</a>
				            	<a href="/alat/hapusorang/<?= $o['nik']; ?>" class="badge badge-danger" class="badge badge-danger" onclick="return confirm('yakin dihapus?')">hapus</a>
				            </td>
				        </tr>
			    	<?php endforeach; ?>
			    </tbody>
			</table>
			<br><br>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>