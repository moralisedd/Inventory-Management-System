document.addEventListener('DOMContentLoaded', function () {

  // Sales & Purchase - Bar Chart
  const barctx = document.getElementById("barchart");
  if (barctx) {
    new Chart(barctx, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Sales",
            data: [12, 19, 3, 5, 2, 3, 4, 8, 7, 10, 6, 9],
            backgroundColor: "rgba(129, 122, 243, 1)",
            borderColor: "rgba(129, 122, 243, 1)",
            borderWidth: 1,
            barThickness: 15,
            borderRadius: 4,
          },
          {
            label: "Purchase",
            data: [15, 10, 8, 7, 6, 9, 12, 13, 14, 10, 11, 5],
            backgroundColor: "rgba(87, 218, 101, 1)",
            borderColor: "rgba(87, 218, 101, 1)",
            borderWidth: 1,
            barThickness: 15,
            borderRadius: 4,
          },
        ],
      },
      options: {
        scales: {
          y: { beginAtZero: true },
        },
      },
    });
  }

  // Order Summary - Line Chart
  const lineCtx = document.getElementById("line-chart");
  if (lineCtx) {
    new Chart(lineCtx, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Ordered",
            data: [50, 50, 70, 40, 80, 10, 0, 50, 40, 20, 30, 60],
            borderColor: "rgb(173, 107, 32)",
            backgroundColor: "rgba(219, 163, 98, 1)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: "rgb(173, 107, 32)",
            fill: true,
          },
          {
            label: "Delivered",
            data: [110, 140, 160, 130, 170, 200, 190, 240, 230, 210, 220, 250],
            borderColor: "rgb(64, 121, 196)",
            backgroundColor: "rgba(182, 211, 250, 1)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: "rgb(64, 121, 196)",
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true, position: "top" },
        },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: "Amount (£)" },
          },
        },
      },
    });
  }

  // Reports Page - Line Chart
  const lineCtx2 = document.getElementById("rev-line-chart");
  if (lineCtx2) {
    new Chart(lineCtx2, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Revenue",
            data: [50, 50, 70, 40, 80, 10, 0, 50, 40, 20, 30, 60],
            borderColor: "rgba(19, 102, 217, 1)",
            backgroundColor: "rgba(68, 140, 242, 0.64)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: "rgba(68, 141, 242, 1)",
            fill: true,
          },
          {
            label: "Profit",
            data: [110, 140, 160, 130, 170, 200, 190, 240, 230, 210, 220, 250],
            borderColor: "rgba(219, 163, 98, 1)",
            backgroundColor: "rgba(219, 163, 98, 0.54)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: "rgba(219, 163, 98, 1)",
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true, position: "top" },
        },
        scales: {
          y: {
            beginAtZero: true,
            title: { display: true, text: "Amount (£)" },
          },
        },
      },
    });
  }
});
