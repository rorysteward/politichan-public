<h2 class="govuk-heading-m">Delete Existing Board</h2>
<fieldset class="govuk-fieldset">
    <form id="delete-board" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/deleteBoard">
        <div class="govuk-form-group">
            <label class="govuk-label" for="sort">
                Select board
            </label>
            <select class="govuk-select" name="board_id" id="board_id" for="board_id">
                <?php foreach ($details[0] as $row) : ?>
                    <option value="<?= $row['board_id'] ?>"><?= $row['board_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="govuk-checkboxes" data-module="govuk-checkboxes">
            <div class="govuk-checkboxes__item">
                <input class="govuk-checkboxes__input" id="purge" name="purge" type="checkbox" value="true">
                <label class="govuk-label govuk-checkboxes__label" for="purge">
                    Purge all records?
                </label>
            </div>
        </div>
</fieldset>
</form>
<div class="delete-confirm"></div>
<div class="dialog_form_actions">
    <button class="govuk-button govuk-button--warning delete-board-submit" data-module="govuk-button">
        Delete
    </button>
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Cancel
    </button>
</div>
</div>