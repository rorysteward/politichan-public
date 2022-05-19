$(document).ready(function () {
  function reported_posts_counter() {
    $.getJSON("/admin/ajaxReportedPosts").done(function (data) {
      if (data["count"].length > 0) {
        $("#reported_post_counter").addClass("govuk-tag govuk-tag--red");
      } else {
        $("#reported_post_counter").addClass("govuk-tag");
      }
      $("#reported_post_counter").append(data["count"].length);
    });
  }
  $(document).on("click", ".edit-user-submit", function () {
    let permissions = $(".checkbox-modal").is(":checked");
    let username = document.forms["edit-modal"]["admin_id"].value;
    if (username == 0) {
      $(".selected-user").addClass("govuk-form-group--error");
      return false;
    }
    if (permissions == false) {
      $(".admin-rights").addClass("govuk-form-group--error");
      $(".admin-rights__legend").empty()
        .append(`<h1 class="govuk-fieldset__heading">
        Admin rights:
    </h1><p class="govuk-error-message" style="margin-top: 2%">
      <span class="govuk-visually-hidden">Error:</span> You need to select at least one board.
    </p>`);
      return false;
    }
    $("#edit-user").submit();
  });
  $(document).on("click", ".add-user-submit", function () {
    let username = document.forms["add-user-form"]["admin_username"].value;
    let first_name = document.forms["add-user-form"]["admin_first_name"].value;
    let last_name = document.forms["add-user-form"]["admin_last_name"].value;
    let email = document.forms["add-user-form"]["admin_email"].value;
    let permissions = $(".govuk-checkboxes__input").is(":checked");
    let password = document.forms["add-user-form"]["admin_password"].value;
    if (username.length == 0) {
      $(".admin-username")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="admin_username">
        User Name
      </label>
      <span class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Enter User Name
      </span>
      <input class="govuk-input govuk-input--error" id="admin_username" name="admin_username" type="text">
    </div>`);
      return false;
    }
    if (email.length == 0) {
      $(".admin-email")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="admin_email">
        Email
      </label>
      <span class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Email is required.
      </span>
      <input class="govuk-input govuk-input--error" id="admin_email" name="admin_email" type="text">
    </div>`);
      return false;
    }
    if (first_name.length == 0) {
      $(".admin-first-name")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="admin_first_name">
        First Name
      </label>
      <span class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> First Name is required.
      </span>
      <input class="govuk-input govuk-input--error" id="admin_first_name" name="admin_first_name" type="text">
    </div>`);
      return false;
    }
    if (last_name.length == 0) {
      $(".admin-last-name")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="admin_last_name">
        Last Name
      </label>
      <span class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Last Name is required.
      </span>
      <input class="govuk-input govuk-input--error" id="admin_last_name" name="admin_last_name" type="text">
    </div>`);
      return false;
    }
    if (password.length == 0) {
      $(".admin-password")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="admin_password">
        Password
      </label>
      <div class="govuk-hint">
      Must contain at least 8 characters
    </div>
      <span class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Password is required.
      </span>
      <input class="govuk-input govuk-input--error" id="admin_password" name="admin_password" type="password">
    </div>`);
      return false;
    }
    if (permissions == false) {
      $(".admin-rights").addClass("govuk-form-group--error");
      $(".admin-rights__legend")
        .append(`<p class="govuk-error-message" style="margin-top: 2%">
      <span class="govuk-visually-hidden">Error:</span> You need to select at least one board.
    </p>`);
      return false;
    }
    $("#add-user-form").submit();
  });
  $(".user-list").DataTable({
    ajax: {
      url: "/admin/usersAjax",
      dataSrc: "users",
    },
    language: {
      searchPlaceholder: "Search records",
      search: "",
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: ["sorting_disabled"],
      },
    ],
    columns: [
      {
        data: "admin_username",
        render: function (val, type, row) {
          return val;
        },
      },
      {
        data: "admin_email",
        render: function (val, type, row) {
          const html =
            `<a class="govuk-link" href="mailto:` + val + `">` + val + `</a>`;
          return html;
        },
      },
      {
        data: "board",
        render: function (val, type, row) {
          let boards = [];
          row["board"].map(function (data) {
            boards += `<li>` + data["board_name"] + `</li>`;
          });
          let html =
            `<details class="govuk-details" data-module="govuk-details">
          <summary class="govuk-details__summary">
            <span class="govuk-details__summary-text">
              Assigned Boards
            </span>
          </summary>
          <ul class="govuk-list govuk-list--bullet">
          ` +
            boards +
            `
            </ul>
        </details>`;
          return html;
        },
      },
      {
        data: "active",
        render: function (val, type, row) {
          let html = [];
          if (val == "y") {
            html += `<div class="govuk-checkboxes__item" style="vertical-align: middle; display: flex; align-items: center; justify-content: center;">
          <input class="govuk-checkboxes__input active_checkbox" disabled="disabled" checked="checked" type="checkbox">
          <label class="govuk-label govuk-checkboxes__label">
          </label>
        </div>`;
          } else {
            html += `<div class="govuk-checkboxes__item">
            <input class="govuk-checkboxes__input active_checkbox" disabled="disabled" type="checkbox">
            <label class="govuk-label govuk-checkboxes__label">
            </label>
          </div>`;
          }
          return html;
        },
      },
      {
        data: "active",
        render: function (val, type, row) {
          const html =
            `<div class="govuk-button-group admin-buttons">
          <button class="govuk-button govuk-button--secondary users-button" data-id="` +
            row.admin_id +
            `" data-module="govuk-button" data-target="/admin/modalUsers?action=info&id=` +
            row.admin_id +
            `">
            View details
          </button>
        </div>`;
          return html;
        },
      },
    ],
  });
  reported_posts_counter();
});
