<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('showcase-search') ?>
<?php loadPartial('flash') ?>
<?php loadPartial('top-banner') ?>

<section class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Recent Job Listings</h2>
      <p class="section-subtitle">Hand-picked opportunities just posted</p>
    </div>

    <?php if (empty($listings)): ?>
      <div class="empty-state">
        <i class="fa fa-folder-open"></i>
        <p>No listings yet. <a href="<?= url('/listings/create') ?>">Be the first to post a job!</a></p>
      </div>
    <?php else: ?>
      <div class="listings-grid">
        <?php foreach ($listings as $listing): ?>
          <div class="card listing-card">
            <div class="card-body">
              <div class="listing-meta-top">
                <span class="listing-company"><?= e($listing->company ?: 'Company') ?></span>
                <span class="badge badge-amber">New</span>
              </div>
              <h3 class="listing-title">
                <a href="<?= url('/listings/' . (int)$listing->id) ?>">
                  <?= e($listing->title) ?>
                </a>
              </h3>
              <p class="listing-desc"><?= e(substr($listing->description, 0, 120)) ?>...</p>
              <ul class="listing-details">
                <li><i class="fa fa-dollar-sign"></i> <?= formatSalary($listing->salary) ?> / yr</li>
                <li><i class="fa fa-map-marker-alt"></i> <?= e($listing->city) ?>, <?= e($listing->state) ?></li>
                <?php if ($listing->tags): ?>
                  <li><i class="fa fa-tags"></i> <?= e($listing->tags) ?></li>
                <?php endif; ?>
              </ul>
            </div>
            <div class="card-footer">
              <a href="<?= url('/listings/' . (int)$listing->id) ?>" class="btn btn-primary btn-sm btn-full">
                View Details <i class="fa fa-arrow-right"></i>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="text-center mt-lg">
        <a href="<?= url('/listings') ?>" class="btn btn-outline">
          <i class="fa fa-th-list"></i> Browse All Jobs
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer') ?>
