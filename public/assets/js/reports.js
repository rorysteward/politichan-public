$(document).ready(function () {
  $.getJSON("/reports/dailyCount", function (data) {
    const ctx = document.getElementById("dailyCount");
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["New", "Responses"],
        datasets: [
          {
            label: "Daily Count",
            data: [data["count"][0], data["count"][1]],
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
            ],
            borderColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: false,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    });
  });
});
