<h2 class="govuk-heading-m">Edit Existing Board</h2>
<fieldset class="govuk-fieldset">
    <form id="MY_post" name="edit-modal" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/admin/modifyBoard">
        <div class="govuk-form-group">
            <label class="govuk-label" for="sort">
                Select board
            </label>
            <select class="govuk-select" name="board_id" id="board_id" for="board_id">
                <?php foreach ($details as $row) : ?>
                    <option value="<?= $row->board_id ?>"><?= $row->board_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="govuk-form-group board-title">
            <label class="govuk-label" for="board_title">
                Board Title
            </label>
            <input class="govuk-input" id="board_title" name="board_title" type="text">
        </div>
    </form>
</fieldset>
<div class="dialog_form_actions">
    <button type=submit class="govuk-button edit-modal" data-module="govuk-button">
        Edit
    </button>
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Cancel
    </button>
</div>
</div>