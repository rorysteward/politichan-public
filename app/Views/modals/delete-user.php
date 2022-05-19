<h2 class="govuk-heading-m">Delete User</h2>
<fieldset class="govuk-fieldset">
    <form id="delete-board" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/deleteUser">
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
</fieldset>
</form>
<div class="delete-confirm"></div>
<div class="dialog_form_actions">
    <button class="govuk-button govuk-button--warning delete-user-submit" data-module="govuk-button">
        Delete
    </button>
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Cancel
    </button>
</div>
</div>