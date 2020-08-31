<?= $this->extend("template/template_auth"); ?>

<?= $this->section("konten"); ?>
<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('pesan'); ?>
  </div>
<?php elseif (session()->getFlashdata('kesalahan')) : ?>
  <div class="alert alert-danger" role="alert">
    <?= session()->getFlashdata('kesalahan'); ?>
  </div>
<?php endif; ?>
<form class="user" action="auth/loginProces" method="post">
  <div class="form-group">
    <input type="text" class="form-control form-control-user <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="email" name="email" placeholder="Masukkan email..." value="<?= old('email'); ?>">
    <div class="invalid-feedback">
      <?= $validation->getError('email'); ?>
    </div>
  </div>
  <div class="form-group">
    <input type="password" class="form-control form-control-user <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" id="password" name="password" placeholder="Masukkan password">
    <div class="invalid-feedback">
      <?= $validation->getError('password'); ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-user btn-block">
    Login
  </button>
</form>
<hr>
<div class="text-center">
  <a class="small" href="#">Lupa Password?</a>
</div>
<div class="text-center">
  <a class="small" href="register">Buat akun baru!</a>
</div>
<?= $this->endSection(); ?>
