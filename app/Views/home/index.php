<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
	<div class="row">
		<?php foreach ($buku as $b) : ?>
			<div class="col-sm-4">
				<div class="card" style="width: 200px;">
					<img src="/img/buku/<?= $b['image']; ?>" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Judul : <?= $b['judul']; ?></h5>
						<p class="card-text">Pengarang : <?= $b['pengarang']; ?></p>
						<p class="card-text">Penerbit : <?= $b['penerbit']; ?></p>
						<a href="#" class="btn btn-primary">Beli</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>																			
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>