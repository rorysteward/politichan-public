<!DOCTYPE html>
<html>

<head>
  <link href="<?= base_url(); ?>/assets/css/govuk-frontend-4.0.1.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/dialog.css" rel="stylesheet" type="text/css">
  <script src="<?= base_url(); ?>/assets/js/govuk-frontend-3.13.0.min.js" type="text/javascript"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
    window.GOVUKFrontend.initAll()
  </script>
  <script>
    function onSubmit(token) {
      document.getElementById("demo-form").submit();
    }
  </script>

</head>
<header class="govuk-header" role="banner" data-module="govuk-header">
  <div class="govuk-header__container govuk-width-container">
    <div class="govuk-header__logo">
      <a href="#" class="govuk-header__link govuk-header__link--homepage">
        <span class="govuk-header__logotype">
          <!--[if gt IE 8]><!-->
          <!--<![endif]-->
          <!--[if IE 8]>
          <img src="/assets/images/govuk-logotype-crown.png" class="govuk-header__logotype-crown-fallback-image" width="36" height="32">
          <![endif]-->
          <span class="govuk-header__logotype-text">
            politichan.org
          </span>
        </span>
      </a>
    </div>
  </div>
</header>
<div class="govuk-phase-banner">
  <p class="govuk-phase-banner__content">
    <strong class="govuk-tag govuk-phase-banner__content__tag">
      alpha
    </strong>
    <span class="govuk-phase-banner__text">
      This is a new service – your <a class="govuk-link" href="mailto:admin@viszon.net">feedback</a> will help us to improve it.
    </span>
  </p>
</div>
<div class="govuk-width-container">
  <main class="govuk-main-wrapper govuk-main-wrapper--l" id="main-content" role="main">
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <h1 class="govuk-heading-l">Page not found</h1>
        <p class="govuk-body">
          If you typed the web address, check it is correct.
        </p>
        <p class="govuk-body">
          If you pasted the web address, check you copied the entire address.
        </p>
        <a href="<?= base_url() ?>" class="govuk-link govuk-link--no-visited-state">Go back</a>
      </div>
    </div>
  </main>
</div>
</body>

</html>