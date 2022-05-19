<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Politichan.org</title>
  <link href="<?= base_url(); ?>/assets/css/govuk-frontend-4.0.1.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/politichan.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/datatables-govuk.css" rel="stylesheet" type="text/css">
  <script src="<?= base_url(); ?>/assets/js/govuk-frontend-4.0.1.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>/assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
  <link href="<?= base_url(); ?>/assets/css/dialog.css" rel="stylesheet" type="text/css">
  <script src="<?= base_url(); ?>/assets/js/politichan.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>/assets/js/politichan-admin.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>/assets/js/utils.js" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/a44229f0a2.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/b-2.2.2/sl-1.3.4/datatables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
    window.GOVUKFrontend.initAll()
  </script>

</head>
<div class="board-modal hidden" id="confirm" role="dialog"><i style="float:left;" class="fa-solid fa-xmark"></i></div>
<div class="main-container">
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
            <span id="header-text" class="govuk-header__logotype-text">
              politichan.org
            </span>
          </span>
        </a>
      </div>
    </div>
  </header>
  <div id="backdrop"></div>
  <div class="govuk-phase-banner">
    <p class="govuk-phase-banner__content">
      <strong class="govuk-tag govuk-phase-banner__content__tag">
        alpha
      </strong>
      <span class="govuk-phase-banner__text">
        This is a new service – your <a class="govuk-link" href="#">feedback</a> will help us to improve it.
      </span>
    </p>
  </div>
  <hr class="govuk-section-break govuk-section-break--visible">
  <div class="govuk-grid-row admin-panel">
    <div class="govuk-grid-column-one-quarter dashboard-sidenav">
      <ol>
        <a href="/admin" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-house"></i>Dashboard</a>
      </ol>
      <hr class="govuk-section-break govuk-section-break--visible">
      <ol>
        <a href="/admin/reportedposts" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-triangle-exclamation"></i>Reported Posts</a> <strong id="reported_post_counter"></strong>
      </ol>
      <hr class="govuk-section-break govuk-section-break--visible">
      <ol>
        <a href="/admin/boards" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-arrows-to-circle"></i>Boards</a>
      </ol>
      <hr class="govuk-section-break govuk-section-break--visible">
      <ol>
        <a href="/admin/users" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-users"></i>Users</a>
      </ol>
      <hr class="govuk-section-break govuk-section-break--visible">
      <ol>
        <a href="/admin/reports" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-table-list"></i>Reports</a>
      </ol>
      <hr class="govuk-section-break govuk-section-break--visible">
      <div class="dashboard_sidenav__bottom">
        <hr class="govuk-section-break govuk-section-break--visible" style="width: 100%;">
        <ol>
          <a href="/admin/logout" class="dashboard-sidenav__link govuk-link govuk-link--no-visited-state"><i class="fa-solid fa-arrow-right-to-bracket"></i>Logout</a>
        </ol>
      </div>
    </div>