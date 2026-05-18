<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="section auth-section">
  <div class="container">
    <div class="error-card">
      <div class="error-code"><?= e($status ?? '404 Error') ?></div>
      <p class="error-message"><?= e($message ?? 'The page you requested could not be found.') ?></p>
      <div class="error-actions">
        <a href="<?= url('/') ?>" class="btn btn-primary">
          <i class="fa fa-home"></i> Go Home
        </a>
        <a href="<?= url('/listings') ?>" class="btn btn-outline">
          <i class="fa fa-search"></i> Browse Jobs
        </a>
      </div>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
