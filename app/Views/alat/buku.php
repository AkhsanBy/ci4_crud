<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
	<div class="row">
		<div class="col">
			<a href="/alat/tambahbuku" class="btn btn-primary mb-4">Tambah Buku</a>
			<?php if (session()->getFlashdata('pesan')) : ?>
			  <div class="alert alert-success" role="alert">
			    <?= session()->getFlashdata('pesan'); ?>
			  </div>
			<?php endif; ?>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Pengarang</th>
					<th>Penerbit</th>
					<th>Image</th>
					<th>opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; ?>
				<?php foreach ($buku as $b) : ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $b['judul']; ?></td>
						<td><?= $b['pengarang']; ?></td>
						<td><?= $b['penerbit']; ?></td>
						<td>
							<img src="/img/buku/<?= $b['image']; ?>" width="60">	
						</td>
						<td>
							<a href="/alat/editbuku/<?= $b['id']; ?>" class="badge badge-warning">edit</a>
							<a href="/alat/hapusbuku/<?= $b['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin dihapus?')">hapus</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<br><br>
	</div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>