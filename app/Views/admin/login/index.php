<div class="govuk-width-container" style="width:30%; height:100%">
  <?php if (isset($validator)) { ?>
    <?php if (session()->get('success')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->get('success') ?>
      </div>
    <?php endif; ?>
    <main class="govuk-main-wrapper">
      <form id="MY_post" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/login">
        <div class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1" data-module="govuk-error-summary">
          <h2 class="govuk-error-summary__title" id="error-summary-title">
            Credentials invalid
          </h2>
          <div class="govuk-error-summary__body">
            <ul class="govuk-list govuk-error-summary__list">
              <li>
                <a href="#username">Enter your credentials</a>
              </li>
            </ul>
          </div>
        </div>

        <h1 class="govuk-heading-l">Log in</h1>

        <div class="govuk-form-group govuk-form-group--error">
          <label class="govuk-label" for="username">
            Username
          </label>
          <span id="username-input-error" class="govuk-error-message">
            <span class="govuk-visually-hidden">Error:</span> Enter your username
          </span>
          <input class="govuk-input govuk-input--error" id="username-input" name="admin_username" type="text" aria-describedby="username-input-error">
        </div>

        <div class="govuk-form-group govuk-form-group--error">
          <label class="govuk-label" for="password">
            Password
          </label>
          <span id="password-input-error" class="govuk-error-message">
            <span class="govuk-visually-hidden">Error:</span> Enter your password
          </span>
          <input type="password" class="govuk-input govuk-input--error" id="password-input" name="admin_password" type="text" aria-describedby="password-input-error">
        </div>
        <button class="govuk-button" data-module="govuk-button">
          Login
        </button>
      </form>
    </main>
</div>

<?php } else { ?>
  <?php if (session()->get('success')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->get('success') ?>
    </div>
  <?php endif; ?>
  <main class="govuk-main-wrapper">
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <h1 class="govuk-heading-xl">Please Log in</h1>
      </div>
    </div>
    <form id="MY_post" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/login">
      <div class="govuk-form-group">
        <label class="govuk-label" for="width-10">
          Username
        </label>
        <input class="govuk-input govuk-input--width-10" id="width-10" name="admin_username" type="text">
      </div>
      <div class="govuk-form-group">
        <label class="govuk-label" for="width-10">
          Password
        </label>
        <input type="password" class="govuk-input govuk-input--width-10" id="width-10" name="admin_password" type="text">
      </div>
      <button class="govuk-button" data-module="govuk-button">
        Login
      </button>
    </form>
  </main>
  </div>
<?php } ?>