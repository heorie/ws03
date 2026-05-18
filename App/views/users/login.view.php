<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="section auth-section">
  <div class="container">
    <div class="auth-card">
      <div class="auth-header">
        <i class="fa fa-sign-in-alt auth-icon"></i>
        <h1>Welcome Back</h1>
        <p>Sign in to your Jobseek account</p>
      </div>

      <?php if (!empty($errors['auth'])): ?>
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-circle"></i> <?= e($errors['auth']) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= url('/login') ?>" class="auth-form">
        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
          <label for="email">Email Address</label>
          <div class="input-icon-wrap">
            <i class="fa fa-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-control with-icon"
                   placeholder="you@example.com"
                   value="<?= e($email ?? '') ?>" required autofocus />
          </div>
          <?php if (isset($errors['email'])): ?><span class="form-error"><?= e($errors['email']) ?></span><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
          <label for="password">Password</label>
          <div class="input-icon-wrap">
            <i class="fa fa-lock input-icon"></i>
            <input type="password" id="password" name="password" class="form-control with-icon"
                   placeholder="Your password" required />
          </div>
          <?php if (isset($errors['password'])): ?><span class="form-error"><?= e($errors['password']) ?></span><?php endif; ?>
        </div>

        <button type="submit" class="btn btn-accent btn-full mt-sm">
          <i class="fa fa-sign-in-alt"></i> Sign In
        </button>
      </form>

      <p class="auth-footer-text">
        Don't have an account? <a href="<?= url('/register') ?>">Create one free</a>
      </p>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
