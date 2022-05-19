<div class="govuk-grid-column-three-quarters admin-content">
  <div class="govuk-grid-row">
    <?php if (isset($validation)) { ?>

      <center>
        <h2 class="govuk-heading-m">Actions:</h2>
      </center>
      <div class="govuk-form-group">
        <form id="MY_post" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/resolveReportedPost">
          <input name="report_id" type="hidden" value="<?php echo $report_id ?>" />

          <fieldset class="govuk-fieldset">
            <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
            <label class="govuk-label" for="sort">
              Select action:
            </label>
            <details class="govuk-details" data-module="govuk-details">
              <summary class="govuk-details__summary">
                <span class="govuk-details__summary-text">
                  Help with choice
                </span>
              </summary>
              <div class="govuk-details__text">
                <ul class="govuk-list govuk-list--bullet govuk-list--spaced">
                  <li>Do nothing - No action will be taken</li>
                  <li>Ban for one day - Client's IP address will be banned for 24 hours.</li>
                  <li>Ban for one week - Client's IP address will be banned for 168 hours.</li>
                  <li>Ban for one month - Client's IP address will be banned for 30 days.</li>
                  <li>Permanent - Client's IP address will be banned for 99 years.</li>
                </ul>
              </div>
            </details>

            <select class="govuk-select" name="length">
              <option value="null">Do nothing</option>
              <option value="day">Ban for one day</option>
              <option value="week">Ban for one week</option>
              <option value="month">Ban for one month</option>
              <option value="permanent">Permanent</option>
            </select>
            <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
            <div class="govuk-form-group">
              <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="more-detail">
                  Justification
                </label>
              </h1>
              <div id="more-detail-hint" class="govuk-hint">
                Justify your action you have taken, so it will be passed over to the banned client
              </div>
              <textarea class="govuk-textarea" id="more-detail" name="ban_text" rows="5" aria-describedby="more-detail-hint"></textarea>
            </div>
            <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
            <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
              <h1 class="govuk-fieldset__heading">
                Delete post?
              </h1>
            </legend>
            <details class="govuk-details" data-module="govuk-details">
              <summary class="govuk-details__summary">
                <span class="govuk-details__summary-text">
                  Help with choice
                </span>
              </summary>
              <div class="govuk-details__text">
                If you will select No, no further action will be taken.
              </div>
            </details>
            <div class="govuk-radios">
              <div class="govuk-radios__item">
                <input class="govuk-radios__input" id="action" name="action" type="radio" value="y">
                <label class="govuk-label govuk-radios__label" for="action">
                  Yes
                </label>
              </div>
              <div class="govuk-radios__item">
                <input class="govuk-radios__input" id="action" name="action" type="radio" value="n">
                <label class="govuk-label govuk-radios__label" for="action">
                  No
                </label>
              </div>
            </div>
          </fieldset>
          <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">

          <span style="float:right;">
            <button class="govuk-button govuk-button--warning" data-module="govuk-button">
              Take action
            </button>
          </span>
        </form>
        <span style="float:left;">
          <form method="post" action="<?= base_url() ?>/admin/reportedposts">
            <button class="govuk-button govuk-button--secondary" data-module="govuk-button">
              Return back
            </button>
      </div>
      </form>
      </span>
  </div>
<?php } else { ?>
  <center>
    <h2 class="govuk-heading-m">Actions:</h2>
  </center>
  <div class="govuk-form-group">
    <form id="MY_post" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/resolveReportedPost">
      <input name="report_id" type="hidden" value="<?php echo $report_id ?>" />

      <fieldset class="govuk-fieldset">
        <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
        <label class="govuk-label" for="sort">
          Select action:
        </label>
        <details class="govuk-details" data-module="govuk-details">
          <summary class="govuk-details__summary">
            <span class="govuk-details__summary-text">
              Help with choice
            </span>
          </summary>
          <div class="govuk-details__text">
            <ul class="govuk-list govuk-list--bullet govuk-list--spaced">
              <li>Do nothing - No action will be taken</li>
              <li>Ban for one day - Client's IP address will be banned for 24 hours.</li>
              <li>Ban for one week - Client's IP address will be banned for 168 hours.</li>
              <li>Ban for one month - Client's IP address will be banned for 30 days.</li>
              <li>Permanent - Client's IP address will be banned for 99 years.</li>
            </ul>
          </div>
        </details>

        <select class="govuk-select" name="length">
          <option value="null">Do nothing</option>
          <option value="day">Ban for one day</option>
          <option value="week">Ban for one week</option>
          <option value="month">Ban for one month</option>
          <option value="permanent">Permanent</option>
        </select>
        <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
        <div class="govuk-form-group">
          <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="more-detail">
              Justification
            </label>
          </h1>
          <div id="more-detail-hint" class="govuk-hint">
            Justify your action you have taken, so it will be passed over to the banned client
          </div>
          <textarea class="govuk-textarea" id="more-detail" name="ban_text" rows="5" aria-describedby="more-detail-hint"></textarea>
        </div>
        <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
          <h1 class="govuk-fieldset__heading">
            Delete post?
          </h1>
        </legend>
        <details class="govuk-details" data-module="govuk-details">
          <summary class="govuk-details__summary">
            <span class="govuk-details__summary-text">
              Help with choice
            </span>
          </summary>
          <div class="govuk-details__text">
            If you will select No, no further action will be taken.
          </div>
        </details>
        <div class="govuk-radios">
          <div class="govuk-radios__item">
            <input class="govuk-radios__input" id="action" name="action" type="radio" value="y">
            <label class="govuk-label govuk-radios__label" for="action">
              Yes
            </label>
          </div>
          <div class="govuk-radios__item">
            <input class="govuk-radios__input" id="action" name="action" type="radio" value="n">
            <label class="govuk-label govuk-radios__label" for="action">
              No
            </label>
          </div>
        </div>
      </fieldset>
      <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">

      <span style="float:right;">
        <button class="govuk-button govuk-button--warning" data-module="govuk-button">
          Take action
        </button>
      </span>
    </form>
    <span style="float:left;">
      <form method="post" action="<?= base_url() ?>/admin/reportedposts">
        <button class="govuk-button govuk-button--secondary" data-module="govuk-button">
          Return back
        </button>
  </div>
  </form>
  </span>
</div>
<?php } ?>
</div>
</div>