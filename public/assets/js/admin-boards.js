$(document).ready(function () {
  $("#board-list").DataTable({
    ajax: {
      url: "/admin/boardsAjax",
      dataSrc: "boards",
    },
    language: {
      search: "",
      searchPlaceholder: "Search records",
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: ["sorting_disabled"],
      },
    ],
    columns: [
      {
        data: "board_name",
        render: function (val, type, row) {
          return row.board_name;
        },
      },
      {
        data: "board_title",
        render: function (val, type, row) {
          return row.board_title;
        },
      },
    ],
  });
});
