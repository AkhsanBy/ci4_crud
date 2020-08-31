<?= $this->extend("template/template_auth"); ?>

<?= $this->section("konten"); ?>
<form class="user" action="auth/registerProces" method="post">
  <div class="form-group">
    <input type="text" class="form-control form-control-user <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" id="username" name="username" placeholder="Masukkan username" value="<?= old('username'); ?>">
    <div class="invalid-feedback">
      <?= $validation->getError('username'); ?>
    </div>
  </div>
  <div class="form-group">
    <input type="text" class="form-control form-control-user <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="email" name="email" placeholder="Masukkan email" value="<?= old('email'); ?>">
    <div class="invalid-feedback">
      <?= $validation->getError('email'); ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <input type="password" class="form-control form-control-user <?= ($validation->hasError('password1') ? 'is-invalid' : ''); ?>" id="password1" name="password1" placeholder="Password">
      <div class="invalid-feedback">
        <?= $validation->getError('password1'); ?>
      </div>
    </div>
    <div class="col-sm-6">
      <input type="password" class="form-control form-control-user <?= ($validation->hasError('password2') ? 'is-invalid' : ''); ?>" id="password2" name="password2" placeholder="Ulangi Password">
      <div class="invalid-feedback">
        <?= $validation->getError('password2'); ?>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-user btn-block">
    Daftar
  </button>
</form>
<hr>
<div class="text-center">
  <a class="small" href="login">Sudah punya akun? Login!</a>
</div>
<?= $this->endSection(); ?>