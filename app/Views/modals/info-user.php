    <div class="govuk-form-group">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h2 class="govuk-heading-m">User details</h2>
        </legend>
        <dl class="govuk-summary-list">
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    User Name
                </dt>
                <dd class="govuk-summary-list__value">
                    <?php echo $details[0]['admin_username'] ?>
                </dd>
            </div>
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Full Name
                </dt>
                <dd class="govuk-summary-list__value">
                    <?php echo $details[0]['admin_first_name'] ?>&nbsp;<?php echo $details[0]['admin_last_name'] ?>
                </dd>
            </div>
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Email
                </dt>
                <dd class="govuk-summary-list__value">
                    <?php echo $details[0]['admin_email'] ?>
                </dd>
            </div>
        </dl>
    </div>
    <div class="dialog_form_actions">
        <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
            Close
        </button>
    </div>