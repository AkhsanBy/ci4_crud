<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
	<div class="row">
		<div class="col-md-8">
			<form action="/alat/prosesEditOrang/<?= $orang['nik']; ?>" method="post">
				<?= csrf_field(); ?>
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $orang['nama']; ?>">
					<div class="invalid-feedback">
						<?= $validation->getError('nama'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="text" class="form-control <?= ($validation->hasError('nik') ? 'is-invalid' : ''); ?>" id="nik" name="nik" value="<?= $orang['nik']; ?>"> 
					<div class="invalid-feedback">
						<?= $validation->getError('nik'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label> 
					<input type="text" class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : ''); ?>" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $orang['alamat']; ?>">
					<div class="invalid-feedback">
						<?= $validation->getError('alamat'); ?>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Edit</button>
				<a href="/alat/orang" class="btn btn-secondary">Batal</a>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>