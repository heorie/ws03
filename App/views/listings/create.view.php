<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="section">
  <div class="container container-narrow">
    <div class="page-header">
      <h1><i class="fa fa-plus-circle"></i> Post a New Job</h1>
      <p>Fill in the details below to create your job listing.</p>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="POST" action="<?= url('/listings') ?>">
          <?php loadPartial('listing-form-fields', ['listing' => $listing ?? null, 'errors' => $errors ?? []]) ?>
          <div class="form-actions mt-lg">
            <button type="submit" class="btn btn-accent">
              <i class="fa fa-check"></i> Publish Listing
            </button>
            <a href="<?= url('/listings') ?>" class="btn btn-ghost">
              <i class="fa fa-times"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
