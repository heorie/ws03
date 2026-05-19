
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('flash') ?>
 
<section class="section">
  <div class="container container-narrow">

    <a href="<?= url('/listings') ?>" class="back-link">
      <i class="fa fa-arrow-left"></i> Back to Listings
    </a>

    <div class="card mt-md">
      <div class="card-header-bar">
        <div>
          <span class="listing-company"><?= e($listing->company ?: 'Company') ?></span>
          <h1 class="listing-title-lg"><?= e($listing->title) ?></h1>
          <div class="listing-location">
            <i class="fa fa-map-marker-alt"></i>
            <?= e($listing->city) ?>, <?= e($listing->state) ?>
            <span class="badge badge-blue ml-xs">Open</span>
          </div>
        </div>

        <?php if (isAuthenticated()): ?>
          <div class="listing-actions">
            <a href="<?= url('/listings/' . (int)$listing->id . '/edit') ?>" class="btn btn-secondary btn-sm">
              <i class="fa fa-edit"></i> Edit
            </a>
            <form method="POST" action="<?= url('/listings/' . (int)$listing->id) ?>">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('Are you sure you want to delete this listing?')">
                <i class="fa fa-trash"></i> Delete
              </button>
            </form>
          </div>
        <?php endif; ?>
      </div>

      <div class="card-body">
        <div class="detail-grid">
          <div class="detail-main">
            <h2 class="detail-section-title">Job Description</h2>
            <p class="detail-text"><?= nl2br(e($listing->description)) ?></p>

            <?php if ($listing->requirements): ?>
              <h2 class="detail-section-title mt-md">Requirements</h2>
              <p class="detail-text"><?= nl2br(e($listing->requirements)) ?></p>
            <?php endif; ?>

            <?php if ($listing->benefits): ?>
              <h2 class="detail-section-title mt-md">Benefits</h2>
              <p class="detail-text"><?= nl2br(e($listing->benefits)) ?></p>
            <?php endif; ?>

            <div class="apply-box mt-lg">
              <p class="apply-hint">
                <i class="fa fa-info-circle"></i>
                Use <strong>"Job Application — <?= e($listing->title) ?>"</strong> as your email subject and attach your resume.
              </p>
              <a href="https://mail.google.com/mail/?view=cm&to=<?= urlencode($listing->email ?? '') ?>"
                 target="_blank" class="btn btn-accent btn-full">
                <i class="fa fa-paper-plane"></i> Apply Now
              </a>
            </div>
          </div>

          <aside class="detail-sidebar">
            <div class="sidebar-card">
              <h3>Job Overview</h3>
              <ul class="sidebar-list">
                <li>
                  <i class="fa fa-dollar-sign"></i>
                  <span><strong>Salary</strong><br><?= formatSalary($listing->salary) ?> / year</span>
                </li>
                <?php if ($listing->phone): ?>
                <li>
                  <i class="fa fa-phone"></i>
                  <span><strong>Phone</strong><br><?= e($listing->phone) ?></span>
                </li>
                <?php endif; ?>
                <?php if ($listing->email): ?>
                <li>
                  <i class="fa fa-envelope"></i>
                  <span><strong>Email</strong><br><?= e($listing->email) ?></span>
                </li>
                <?php endif; ?>
                <?php if ($listing->address): ?>
                <li>
                  <i class="fa fa-building"></i>
                  <span><strong>Address</strong><br><?= e($listing->address) ?></span>
                </li>
                <?php endif; ?>
                <?php if ($listing->tags): ?>
                <li>
                  <i class="fa fa-tags"></i>
                  <span><strong>Tags</strong><br>
                    <?php foreach (explode(',', $listing->tags) as $tag): ?>
                      <span class="badge badge-gray"><?= e(trim($tag)) ?></span>
                    <?php endforeach; ?>
                  </span>
                </li>
                <?php endif; ?>
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
