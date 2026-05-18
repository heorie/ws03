<footer class="site-footer">
  <div class="footer-inner container">
    <div class="footer-brand">
      <a href="<?= url('/') ?>" class="brand">
        <i class="fa fa-briefcase brand-icon"></i> Jobseek
      </a>
      <p>Connecting talent with opportunity.</p>
    </div>
    <nav class="footer-nav">
      <a href="<?= url('/') ?>">Home</a>
      <a href="<?= url('/listings') ?>">Browse Jobs</a>
      <?php if (isAuthenticated()): ?>
        <a href="<?= url('/listings/create') ?>">Post a Job</a>
        <a href="<?= url('/logout') ?>">Logout</a>
      <?php else: ?>
        <a href="<?= url('/login') ?>">Login</a>
        <a href="<?= url('/register') ?>">Register</a>
      <?php endif; ?>
    </nav>
  </div>
  <div class="footer-bottom">
    &copy; <?= date('Y') ?> Jobseek. All rights reserved.
  </div>
</footer>
</body>
</html>
