<div class="form-section-title"><i class="fa fa-info-circle"></i> Basic Information</div>
<div class="form-group <?= isset($errors['title']) ? 'has-error' : '' ?>">
  <label for="title">Job Title <span class="required">*</span></label>
  <input type="text" id="title" name="title" class="form-control"
         placeholder="e.g. Senior Web Developer"
         value="<?= e($listing->title ?? '') ?>" />
  <?php if (isset($errors['title'])): ?><span class="form-error"><?= e($errors['title']) ?></span><?php endif; ?>
</div>

<div class="form-group <?= isset($errors['description']) ? 'has-error' : '' ?>">
  <label for="description">Job Description <span class="required">*</span></label>
  <textarea id="description" name="description" class="form-control" rows="5"
            placeholder="Describe the role, responsibilities, and ideal candidate..."><?= e($listing->description ?? '') ?></textarea>
  <?php if (isset($errors['description'])): ?><span class="form-error"><?= e($errors['description']) ?></span><?php endif; ?>
</div>

<div class="form-row">
  <div class="form-group">
    <label for="salary">Annual Salary <small>(USD)</small></label>
    <input type="number" id="salary" name="salary" class="form-control"
           placeholder="e.g. 75000"
           value="<?= e($listing->salary ?? '') ?>" />
  </div>
  <div class="form-group">
    <label for="tags">Tags <small>(comma-separated)</small></label>
    <input type="text" id="tags" name="tags" class="form-control"
           placeholder="e.g. PHP, Laravel, Remote"
           value="<?= e($listing->tags ?? '') ?>" />
  </div>
</div>

<div class="form-group">
  <label for="requirements">Requirements</label>
  <textarea id="requirements" name="requirements" class="form-control" rows="4"
            placeholder="List qualifications, experience, and skills required..."><?= e($listing->requirements ?? '') ?></textarea>
</div>

<div class="form-group">
  <label for="benefits">Benefits</label>
  <textarea id="benefits" name="benefits" class="form-control" rows="3"
            placeholder="Health insurance, remote work, bonuses..."><?= e($listing->benefits ?? '') ?></textarea>
</div>

<div class="form-section-title mt-lg"><i class="fa fa-building"></i> Company & Contact</div>

<div class="form-row">
  <div class="form-group">
    <label for="company">Company Name</label>
    <input type="text" id="company" name="company" class="form-control"
           placeholder="Your company name"
           value="<?= e($listing->company ?? '') ?>" />
  </div>
  <div class="form-group">
    <label for="address">Street Address</label>
    <input type="text" id="address" name="address" class="form-control"
           placeholder="123 Main St"
           value="<?= e($listing->address ?? '') ?>" />
  </div>
</div>

<div class="form-row">
  <div class="form-group">
    <label for="city">City</label>
    <input type="text" id="city" name="city" class="form-control"
           placeholder="Manila"
           value="<?= e($listing->city ?? '') ?>" />
  </div>
  <div class="form-group">
    <label for="state">State / Province</label>
    <input type="text" id="state" name="state" class="form-control"
           placeholder="NCR"
           value="<?= e($listing->state ?? '') ?>" />
  </div>
</div>

<div class="form-row">
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" class="form-control"
           placeholder="+63 9XX XXX XXXX"
           value="<?= e($listing->phone ?? '') ?>" />
  </div>
  <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
    <label for="email">Contact Email <span class="required">*</span></label>
    <input type="email" id="email" name="email" class="form-control"
           placeholder="hr@company.com"
           value="<?= e($listing->email ?? '') ?>" />
    <?php if (isset($errors['email'])): ?><span class="form-error"><?= e($errors['email']) ?></span><?php endif; ?>
  </div>
</div>
