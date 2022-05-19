<script src="<?= base_url(); ?>/assets/js/admin-boards.js" type="text/javascript"></script>
<div class="govuk-grid-column-three-quarters admin-content">
  <div class="govuk-grid-row">
    <table class="dataTable cell-border" id="board-list">
      <thead class="govuk-table__head">
        <tr class="govuk-table__row">
          <th scope="col" class="govuk-table__header govuk-table__header">Board Name</th>
          <th scope="col" class="govuk-table__header govuk-table__header">Board Title</th>
        </tr>
      </thead>
    </table>
    <div class="govuk-grid-row">


      <div class="govuk-button-group admin-buttons">
        <button class="govuk-button add-board" data-module="govuk-button" data-target="/admin/modal?action=add">
          Create new board
        </button>

        <button class="govuk-button govuk-button--secondary edit-board" data-module="govuk-button" data-target="/admin/modal?action=edit">
          Edit existing board
        </button>
        <button class="govuk-button govuk-button--warning delete-board" data-module="govuk-button" data-target="/admin/modal?action=delete">
          Delete board
        </button>

      </div>
    </div>
  </div>
</div>
</div>