<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="section auth-section">
  <div class="container">
    <div class="auth-card">
      <div class="auth-header">
        <i class="fa fa-user-plus auth-icon"></i>
        <h1>Create an Account</h1>
        <p>Join thousands of job seekers on Jobseek</p>
      </div>

      <form method="POST" action="<?= url('/register') ?>" class="auth-form">
        <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
          <label for="name">Full Name</label>
          <div class="input-icon-wrap">
            <i class="fa fa-user input-icon"></i>
            <input type="text" id="name" name="name" class="form-control with-icon"
                   placeholder="Juan dela Cruz"
                   value="<?= e($name ?? '') ?>" required autofocus />
          </div>
          <?php if (isset($errors['name'])): ?><span class="form-error"><?= e($errors['name']) ?></span><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
          <label for="email">Email Address</label>
          <div class="input-icon-wrap">
            <i class="fa fa-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-control with-icon"
                   placeholder="you@example.com"
                   value="<?= e($email ?? '') ?>" required />
          </div>
          <?php if (isset($errors['email'])): ?><span class="form-error"><?= e($errors['email']) ?></span><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
          <label for="password">Password</label>
          <div class="input-icon-wrap">
            <i class="fa fa-lock input-icon"></i>
            <input type="password" id="password" name="password" class="form-control with-icon"
                   placeholder="At least 6 characters" required />
          </div>
          <?php if (isset($errors['password'])): ?><span class="form-error"><?= e($errors['password']) ?></span><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['password_confirm']) ? 'has-error' : '' ?>">
          <label for="password_confirm">Confirm Password</label>
          <div class="input-icon-wrap">
            <i class="fa fa-lock input-icon"></i>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control with-icon"
                   placeholder="Re-enter your password" required />
          </div>
          <?php if (isset($errors['password_confirm'])): ?><span class="form-error"><?= e($errors['password_confirm']) ?></span><?php endif; ?>
        </div>

        <button type="submit" class="btn btn-accent btn-full mt-sm">
          <i class="fa fa-user-plus"></i> Create Account
        </button>
      </form>

      <p class="auth-footer-text">
        Already have an account? <a href="<?= url('/login') ?>">Sign in here</a>
      </p>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
