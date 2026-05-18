<header class="site-header">
  <nav class="container">
    <div class="nav-container">
      <a href="<?= url('/') ?>" class="brand">
        <i class="fa fa-briefcase brand-icon"></i> Jobseek
      </a>

      <div class="nav-links" id="navLinks">
        <a href="<?= url('/listings') ?>" class="nav-link">
          <i class="fa fa-th-list"></i> Browse Jobs
        </a>

        <?php if (isAuthenticated()): ?>
          <span class="nav-user">
            <i class="fa fa-user-circle"></i>
            <?= e($_SESSION['user_name'] ?? 'User') ?>
          </span>
          <div class="nav-divider"></div>
          <a href="<?= url('/listings/create') ?>" class="btn btn-accent btn-sm">
            <i class="fa fa-plus"></i> Post a Job
          </a>
          <a href="<?= url('/logout') ?>" class="nav-link">
            <i class="fa fa-sign-out-alt"></i> Logout
          </a>
        <?php else: ?>
          <div class="nav-divider"></div>
          <a href="<?= url('/login') ?>" class="nav-link">
            <i class="fa fa-sign-in-alt"></i> Login
          </a>
          <a href="<?= url('/register') ?>" class="btn btn-accent btn-sm">
            <i class="fa fa-user-plus"></i> Register
          </a>
        <?php endif; ?>
      </div>

      <button class="nav-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')" aria-label="Toggle menu">
        <i class="fa fa-bars"></i>
      </button>
    </div>
  </nav>
</header>
