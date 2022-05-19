<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="description" content="Discussions about politics">
  <meta name="keywords" content="imageboard, chan, board, 4chan, 8ch, politics, karachan, vichan">
  <title>Politichan</title>
  <link href="<?= base_url(); ?>/assets/css/govuk-frontend-4.0.1.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/datatables-govuk.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/dialog.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>/assets/css/politichan.css" rel="stylesheet" type="text/css">
  <script src="<?= base_url(); ?>/assets/js/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/politichan.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>/assets/js/js.cookie.js"></script>
  <script src="<?= base_url(); ?>/assets/js/jquery.validate.js" type="text/javascript"></script>
  <link rel="apple-touch-icon" sizes="57x57" href="/assets/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/assets/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="/assets/icons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/assets/icons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>

<body class="govuk-template__body">
  <div id="backdrop"></div>
  <script>
    document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
  </script>
  <div class="main-container">
    <div class="board-modal hidden" id="confirm" role="dialog" style="display: none;"></div>
    <?php if (isset($board_ids)) { ?>
      <div class="header-div">
        <div class="govuk-breadcrumbs board-list">
          <ol class="govuk-breadcrumbs__list">
            <?php foreach ($board_ids as $row) : ?>
              <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="<?= base_url() ?>/boards/<?= $row['board_name'] ?>">/<?= $row['board_name'] ?></a>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
        <div class="header-right-options">
          <a class="govuk-link govuk-link--no-visited-state govuk-link--no-underline delete-post-pass" data-target="/board/deletePost" href="#">Delete post</a>
        </div>
      </div>
    <?php } ?>
    <hr class="govuk-section-break govuk-section-break--visible">
    <div class="govuk-phase-banner">
      <p class="govuk-phase-banner__content">
        <strong class="govuk-tag govuk-phase-banner__content__tag">
          alpha
        </strong>
        <span class="govuk-phase-banner__text">
          This is a new service – your <a class="govuk-link" href="mailto:admin@politichan.org">feedback</a> will help us to improve it.
        </span>
      </p>
    </div>