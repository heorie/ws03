<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="section">
  <div class="container container-narrow">
    <a href="<?= url('/listings/' . (int)$listing->id) ?>" class="back-link">
      <i class="fa fa-arrow-left"></i> Back to Listing
    </a>

    <div class="page-header mt-sm">
      <h1><i class="fa fa-edit"></i> Edit Job Listing</h1>
      <p>Update the details for <strong><?= e($listing->title) ?></strong>.</p>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="POST" action="<?= url('/listings/' . (int)$listing->id) ?>">
          <input type="hidden" name="_method" value="PUT">
          <?php loadPartial('listing-form-fields', ['listing' => $listing, 'errors' => $errors ?? []]) ?>
          <div class="form-actions mt-lg">
            <button type="submit" class="btn btn-accent">
              <i class="fa fa-save"></i> Save Changes
            </button>
            <a href="<?= url('/listings/' . (int)$listing->id) ?>" class="btn btn-ghost">
              <i class="fa fa-times"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
