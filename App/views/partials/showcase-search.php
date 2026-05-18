<div class="showcase">
  <div class="showcase-overlay"></div>
  <div class="showcase-content">
    <h1 class="showcase-title">Find Your <span>Dream Job</span> Today</h1>
    <p class="showcase-subtitle">Thousands of opportunities waiting for you — search, apply, succeed.</p>

    <form action="<?= url('/listings') ?>" method="GET" class="search-form">
      <div class="search-fields">
        <div class="search-field">
          <i class="fa fa-search search-icon"></i>
          <input
            type="text"
            name="keywords"
            class="search-input"
            placeholder="Job title, keywords, or tags..."
            value="<?= e($keywords ?? '') ?>"
          />
        </div>
        <div class="search-field">
          <i class="fa fa-map-marker-alt search-icon"></i>
          <input
            type="text"
            name="location"
            class="search-input"
            placeholder="City or state..."
            value="<?= e($location ?? '') ?>"
          />
        </div>
        <button type="submit" class="search-btn">
          <i class="fa fa-search"></i> Search Jobs
        </button>
      </div>
    </form>
  </div>
</div>
