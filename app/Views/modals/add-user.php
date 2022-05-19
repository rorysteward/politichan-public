<form id="add-user-form" name="add-user-form" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/addUser">
    <fieldset class="govuk-fieldset">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h2 class="govuk-heading-m">Create new user</h2>
        </legend>
        <div class="govuk-form-group admin-username">
            <label class="govuk-label" for="admin_username">
                User Name
            </label>
            <input class="govuk-input" id="admin_username" name="admin_username" type="text" required />
        </div>
        <div class="govuk-form-group admin-email">
            <label class="govuk-label" for="admin_email">
                Email
            </label>
            <input class="govuk-input" id="admin_email" name="admin_email" type="text" required />
        </div>
        <div class="govuk-form-group admin-first-name">
            <label class="govuk-label" for="admin_first_name">
                First Name
            </label>
            <input class="govuk-input" id="admin_first_name" name="admin_first_name" type="text" required />
        </div>
        <div class="govuk-form-group admin-last-name">
            <label class="govuk-label" for="admin_last_name">
                Last Name
            </label>
            <input class="govuk-input" id="admin_last_name" name="admin_last_name" type="text" required />
        </div>
        <div class="govuk-form-group admin-rights">
            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--m admin-rights__legend">
                        <h1 class="govuk-fieldset__heading">
                            Admin rights:
                        </h1>
                    </legend>
                    <div class="govuk-checkboxes govuk-checkboxes--small" data-module="govuk-checkboxes">
                        <?php $counter = 0; ?>
                        <?php foreach ($boards as $board) { ?>
                            <div class="govuk-checkboxes__item">
                                <input class="govuk-checkboxes__input" id="board_<?php echo $counter++ ?>" name="boards[]" type="checkbox" value="<?php echo $board['board_id'] ?>">
                                <label class="govuk-label govuk-checkboxes__label" for="board_<?php echo $counter++ ?>">
                                    <?php echo $board['board_name'] ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>

                </fieldset>
            </div>
        </div>
        <div class="govuk-form-group admin-password">
            <label class="govuk-label" for="admin_password">
                Password
            </label>
            <input class="govuk-input" id="admin_password" name="admin_password" type="text" required />
        </div>
    </fieldset>
</form>
<div class="dialog_form_actions">
    <button class="govuk-button govuk-button--success add-user-submit" data-module="govuk-button">
        Add User
    </button>
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Close
    </button>
</div>