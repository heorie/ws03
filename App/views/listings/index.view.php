<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('showcase-search') ?>
<?php loadPartial('flash') ?>
 
<section class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">
        <?= (!empty($keywords) || !empty($location)) ? 'Search Results' : 'All Job Listings' ?>
      </h2>
      <?php if (!empty($keywords) || !empty($location)): ?>
        <p class="section-subtitle">
          <?= count($listings) ?> result(s)
          <?= !empty($keywords) ? ' for "<strong>' . e($keywords) . '</strong>"' : '' ?>
          <?= !empty($location) ? ' in <strong>' . e($location) . '</strong>' : '' ?>
          &mdash; <a href="<?= url('/listings') ?>">Clear search</a>
        </p>
      <?php else: ?>
        <p class="section-subtitle"><?= count($listings) ?> job(s) available</p>
      <?php endif; ?>
    </div>

    <?php if (isAuthenticated()): ?>
      <div class="text-right mb-md">
        <a href="<?= url('/listings/create') ?>" class="btn btn-accent">
          <i class="fa fa-plus"></i> Post a Job
        </a>
      </div>
    <?php endif; ?>

    <?php if (empty($listings)): ?>
      <div class="empty-state">
        <i class="fa fa-search"></i>
        <p>No jobs found matching your criteria.</p>
        <a href="<?= url('/listings') ?>" class="btn btn-outline mt-sm">View All Jobs</a>
      </div>
    <?php else: ?>
      <div class="listings-grid">
        <?php foreach ($listings as $listing): ?>
          <div class="card listing-card">
            <div class="card-body">
              <div class="listing-meta-top">
                <span class="listing-company"><?= e($listing->company ?: 'Company') ?></span>
                <span class="badge badge-blue">Open</span>
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
    <?php endif; ?>
  </div>
</section>

<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer') ?>
