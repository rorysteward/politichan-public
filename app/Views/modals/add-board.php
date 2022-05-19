<form id="add-board-form" name="add-board-form" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/addBoard">
    <fieldset class="govuk-fieldset">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h2 class="govuk-heading-m">Create new board</h2>
        </legend>
        <div class="govuk-form-group board-name">
            <label class="govuk-label" for="board_name">
                Board Name
            </label>
            <input class="govuk-input" id="board_name" name="board_name" type="text" required />
        </div>
        <div class="govuk-form-group board-title">
            <label class="govuk-label" for="board_title">
                Board Title
            </label>
            <input class="govuk-input" id="board_title" name="board_title" type="text" required />
        </div>
    </fieldset>
    <div class="dialog_form_actions">
        <button class="govuk-button govuk-button--success add-board-submit" data-module="govuk-button">
            Create board
        </button>
</form>
<button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
    Close
</button>
</div>