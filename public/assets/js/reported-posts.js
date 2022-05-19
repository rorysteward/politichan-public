$(document).ready(function () {
  $("#posts_table").DataTable({
    ajax: {
      url: "/admin/ajaxReportedPosts",
      dataSrc: "count",
    },
    sPaginationType: "full_numbers",
    language: {
      searchPlaceholder: "Search records",
      search: "",
    },
    order: [[2, "desc"]],
    columns: [
      {
        data: "report_id",
        render: function (val, type, row) {
          return `<div class="govuk-inset-text">
          <span class="govuk-caption-l">Report ID</span>
          <p class="govuk-body-s">${row.report_id}</p>
          <span class="govuk-caption-l">IP address</span>
          <p class="govuk-text-align-centre">${row.ip_address}</p>
          <span class="govuk-caption-l">Submited:</span>
          <p class="govuk-text-align-centre">${row.created_at}</p>
        </div>`;
        },
      },
      {
        data: "post_id",
        render: function (val, type, row) {
          return `<p class="govuk-body">${row.post_text}</p>`;
        },
      },
      {
        data: "created_at",
        render: function (val, type, row) {
          return `<p class="govuk-body">${row.reason}</p>`;
        },
      },
      {
        data: "action",
        render: function (val, type, row) {
          return `<button class="govuk-button take-action" data-id="${row.report_id}">Take action</button>`;
        },
      },
    ],
    columnDefs: [
      {
        className: "dt-head-center",
        targets: [0, 1, 2, 3],
      },
    ],
  });

  $(document).on("click", ".take-action", function () {
    const id = $(this).attr("data-id");
    window.location.href = `/admin/actionReportedPost/?report_id=` + id;
  });
});
