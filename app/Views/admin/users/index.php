<div class="govuk-grid-column-three-quarters admin-content">
  <div class="govuk-grid-row">
    <table class="dataTable user-list cell-border">
      <thead>
        <tr>
          <th scope="col" class="govuk-table__header">Username</th>
          <th scope="col" class="govuk-table__header">Contact</th>
          <th scope="col" class="govuk-table__header sorting_disabled">Permissions</th>
          <th scope="col" class="govuk-table__header sorting_disabled">Active</th>
          <th scope="col" class="govuk-table__header sorting_disabled">More info</th>
        </tr>
      </thead>
    </table>
    <div class="govuk-grid-row">
      <div class="govuk-button-group admin-buttons">
        <button class="govuk-button users-button" data-module="govuk-button" data-target="/admin/modalUsers?action=add">
          Create new user
        </button>

        <button class="govuk-button govuk-button--secondary users-button" data-module="govuk-button" data-target="/admin/modalUsers?action=edit">
          Assign Permissions
        </button>
        <button class="govuk-button govuk-button--warning users-button" data-module="govuk-button" data-target="/admin/modalUsers?action=delete">
          Delete user
        </button>

      </div>
    </div>

  </div>
</div>
</div>