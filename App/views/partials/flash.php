<?php if (!empty($_SESSION['flash'])): ?>
  <?php $flash = $_SESSION['flash']; unset($_SESSION['flash']); ?>
  <div class="flash flash-<?= e($flash['type'] ?? 'success') ?>">
    <i class="fa <?= $flash['type'] === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
    <?= e($flash['message'] ?? '') ?>
  </div>
<?php endif; ?>
 
