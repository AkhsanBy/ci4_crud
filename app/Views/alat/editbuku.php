<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
	<div class="row">
		<div class="col-md-8">
			<form action="/alat/prosesEditBuku/<?= $buku['id']; ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<input type="hidden" name="oldImage" value="<?= $buku['image']; ?>">
				<div class="form-group">
					<label for="judul">Judul</label>
					<input type="text" class="form-control <?= ($validation->hasError('judul') ? 'is-invalid' : ''); ?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $buku['judul']; ?>">
					<div class="invalid-feedback">
						<?= $validation->getError('judul'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="pengarang">Pengarang</label>
					<input type="text" class="form-control <?= ($validation->hasError('pengarang') ? 'is-invalid' : ''); ?>" id="pengarang" name="pengarang" value="<?= (old('pengarang')) ? old('pengarang') : $buku['pengarang']; ?>">
					<div class="invalid-feedback">
						<?= $validation->getError('pengarang'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="penerbit">Penerbit</label> 
					<input type="text" class="form-control <?= ($validation->hasError('penerbit') ? 'is-invalid' : ''); ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $buku['penerbit']; ?>">
					<div class="invalid-feedback">
						<?= $validation->getError('penerbit'); ?>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4">
						<img src="/img/buku/<?= $buku['image']; ?>" width="100">
					</div>
					<div class="col-sm-8">
						<label for="image">Image</label>
						<input type="file" class="form-control <?= ($validation->hasError('image') ? 'is-invalid' : ''); ?>" id="image" name="image">
						<div class="invalid-feedback">
							<?= $validation->getError('image'); ?>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Edit</button>
				<a href="/alat/buku" class="btn btn-secondary">Batal</a>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>