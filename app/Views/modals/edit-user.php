<h2 class="govuk-heading-m">Edit Existing User</h2>
<fieldset class="govuk-fieldset">
    <form id="edit-user" name="edit-modal" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/modifyUser">
        <div class="govuk-form-group selected-user">
            <label class="govuk-label" for="sort">
                Select User
            </label>
            <select class="govuk-select" name="admin_id" id="admin_id" for="admin_id">
                <option disabled selected value="0">Select user:</option>
                <?php foreach ($details as $row) : ?>
                    <option value="<?= $row['admin_id'] ?>"><?= $row['admin_username'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="govuk-form-group admin-rights">
            <legend class="govuk-fieldset__legend govuk-fieldset__legend--m admin-rights__legend">
                <h1 class="govuk-fieldset__heading">
                    Admin rights:
                </h1>
            </legend>
            <div class="govuk-checkboxes govuk-checkboxes--small" data-module="govuk-checkboxes">
                <?php $counter = 0; ?>
                <?php foreach ($boards as $board) { ?>
                    <div class="govuk-checkboxes__item">
                        <input class="govuk-checkboxes__input checkbox-modal" id="board_<?php echo $counter++ ?>" name="boards[]" type="checkbox" value="<?php echo $board['board_id'] ?>">
                        <label class="govuk-label govuk-checkboxes__label" for="board_<?php echo $counter++ ?>">
                            <?php echo $board['board_name'] ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
</fieldset>
<div class="dialog_form_actions">
    <button class="govuk-button edit-user-submit" data-module="govuk-button">
        Edit
    </button>
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Cancel
    </button>
</div>
</div>