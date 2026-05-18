<section class="bottom-banner">
  <div class="bottom-banner-inner">
    <div>
      <h2>Ready to hire great talent?</h2>
      <p>Post your job listing in minutes and reach thousands of applicants.</p>
    </div>
    <div class="bottom-banner-actions">
      <?php if (isAuthenticated()): ?>
        <a href="<?= url('/listings/create') ?>" class="btn btn-accent">
          <i class="fa fa-plus"></i> Post a Job Now
        </a>
      <?php else: ?>
        <a href="<?= url('/register') ?>" class="btn btn-white">
          <i class="fa fa-user-plus"></i> Get Started Free
        </a>
        <a href="<?= url('/login') ?>" class="btn btn-outline-light">
          <i class="fa fa-sign-in-alt"></i> Sign In
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
