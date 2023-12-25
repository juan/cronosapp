if (typeof Chart !== "undefined") {
  // Colors
  let colors = {};
  let fonts = {};

  const style = getComputedStyle(document.body);

  colors.primary = style.getPropertyValue("--color-primary");
  colors.text = style.getPropertyValue("--color-text-normal");
  fonts.body = style.getPropertyValue("--font-body");

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    colors.primary = style.getPropertyValue("--color-primary");
  });

  // Tooltips Options
  const tooltipOptions = {
    backgroundColor: "white",
    borderColor: "rgb(" + colors.primary + ")",
    borderWidth: 0.5,
    bodyColor: "rgb(" + colors.text + ")",
    bodySpacing: 8,
    cornerRadius: 4,
    padding: 16,
    titleColor: "rgb(" + colors.primary + ")",
  };

  // Chart defaults
  Chart.defaults.color = "rgb(" + colors.text + ")";
  Chart.defaults.font.family = fonts.body;

  // REGISTER CHART TYPES
  // Line with shadow element
  class LineWithShadowElement extends Chart.elements.LineElement {
    draw(ctx) {
      const originalStroke = ctx.stroke;

      ctx.stroke = function () {
        ctx.save();
        ctx.shadowColor = "rgba(0, 0, 0, 0.25)";
        ctx.shadowBlur = 8;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 4;
        originalStroke.apply(this, arguments);
        ctx.restore();
      };

      Chart.elements.LineElement.prototype.draw.apply(this, arguments);
    }
  }

  LineWithShadowElement.id = "lineWithShadowElement";

  Chart.register(LineWithShadowElement);

  // Line with shadow
  class LineWithShadow extends Chart.controllers.line {}

  LineWithShadow.id = "lineWithShadow";
  LineWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(LineWithShadow);

  // Bar with shadow
  class BarWithShadow extends Chart.controllers.bar {
    draw(ease) {
      const ctx = this.chart.ctx;

      const originalStroke = ctx.stroke;

      ctx.stroke = function () {
        ctx.save();
        ctx.shadowColor = "rgba(0, 0, 0, 0.25)";
        ctx.shadowBlur = 8;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 4;
        originalStroke.apply(this, arguments);
        ctx.restore();
      };

      Chart.controllers.bar.prototype.draw.call(this, ease);
      ctx.save();
      ctx.shadowColor = "rgba(0, 0, 0, 0.25)";
      ctx.shadowBlur = 8;
      ctx.shadowOffsetX = 0;
      ctx.shadowOffsetY = 4;
      Chart.controllers.bar.prototype.draw.apply(this, arguments);
      ctx.restore();
    }
  }

  BarWithShadow.id = "barWithShadow";

  Chart.register(BarWithShadow);

  // Pie with shadow
  class PieWithShadow extends Chart.controllers.pie {}

  PieWithShadow.id = "pieWithShadow";
  PieWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(PieWithShadow);

  // Doughnut with shadow
  class DoughnutWithShadow extends Chart.controllers.doughnut {}

  DoughnutWithShadow.id = "doughnutWithShadow";
  DoughnutWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(DoughnutWithShadow);

  // Radar with shadow
  class RadarWithShadow extends Chart.controllers.radar {}

  RadarWithShadow.id = "radarWithShadow";
  RadarWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(RadarWithShadow);

  // PolarArea with shadow
  class PolarAreaWithShadow extends Chart.controllers.polarArea {}

  PolarAreaWithShadow.id = "polarAreaWithShadow";
  PolarAreaWithShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(PolarAreaWithShadow);

  // Line with annotation
  class LineWithAnnotation extends Chart.controllers.line {
    draw(ease) {
      const ctx = this.chart.ctx;

      Chart.controllers.line.prototype.draw.call(this, ease);

      if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
        const activePoint = this.chart.tooltip._active[0];
        const x = activePoint.element.x;
        const topY = this.chart.scales["y"].top;
        const bottomY = this.chart.scales["y"].bottom;

        ctx.save();
        ctx.beginPath();
        ctx.moveTo(x, topY);
        ctx.lineTo(x, bottomY);
        ctx.lineWidth = 1;
        ctx.stroke();
        ctx.restore();
      }
    }
  }

  LineWithAnnotation.id = "lineWithAnnotation";

  Chart.register(LineWithAnnotation);

  // Line with annotation and shadow
  class LineWithAnnotationAndShadow extends Chart.controllers.line {
    draw(ease) {
      const ctx = this.chart.ctx;

      Chart.controllers.line.prototype.draw.call(this, ease);

      if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
        const activePoint = this.chart.tooltip._active[0];
        const x = activePoint.element.x;
        const topY = this.chart.scales["y"].top;
        const bottomY = this.chart.scales["y"].bottom;

        ctx.save();
        ctx.beginPath();
        ctx.moveTo(x, topY);
        ctx.lineTo(x, bottomY);
        ctx.lineWidth = 1;
        ctx.stroke();
        ctx.restore();
      }
    }
  }

  LineWithAnnotationAndShadow.id = "lineWithAnnotationAndShadow";
  LineWithAnnotationAndShadow.defaults = {
    datasetElementType: "lineWithShadowElement",
  };

  Chart.register(LineWithAnnotationAndShadow);

  // CHARTS
  let ctx = "";

  // DASHBOARD
  // Visitors chart
  ctx = document.getElementById("visitorsChart");

  if (ctx) {
    ctx = ctx.getContext("2d");

    let gradientBackground = ctx.createLinearGradient(0, 0, 0, 450);
    gradientBackground.addColorStop(0, "rgb(" + colors.primary + "/ .5)");
    gradientBackground.addColorStop(0.75, "rgb(" + colors.primary + "/ 0)");

    var visitorsChart = new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            data: [6.25, 7.5, 10, 7.5, 10, 12.5, 10, 12.5, 10, 12.5, 15, 16.25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            // backgroundColor: gradientBackground,
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (visitorsChart) {
      const datasets = visitorsChart.data.datasets[0];

      datasets.backgroundColor = "rgb(" + colors.primary + "/ .1)";
      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      visitorsChart.options.plugins.tooltip.borderColor =
        "rgb(" + colors.primary + ")";
      visitorsChart.options.plugins.tooltip.titleColor =
        "rgb(" + colors.primary + ")";

      visitorsChart.update();
    }
  });

  // Categories chart
  ctx = document.getElementById("categoriesChart");

  if (ctx) {
    ctx.getContext("2d");

    var categoriesChart = new Chart(ctx, {
      type: "polarAreaWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (categoriesChart) {
      const datasets = categoriesChart.data.datasets[0];

      datasets.backgroundColor = [
        "rgb(" + colors.primary + "/ .1)",
        "rgb(" + colors.primary + "/ .5)",
        "rgb(" + colors.primary + "/ .25)",
      ];
      datasets.borderColor = "rgb(" + colors.primary + ")";

      categoriesChart.options.plugins.tooltip.borderColor =
        "rgb(" + colors.primary + ")";
      categoriesChart.options.plugins.tooltip.titleColor =
        "rgb(" + colors.primary + ")";

      categoriesChart.update();
    }
  });

  // CHARTS
  // Area chart
  ctx = document.getElementById("areaChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Area chart with shadow
  ctx = document.getElementById("areaChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Bar chart
  ctx = document.getElementById("barChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            label: "Potatoes",
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
          {
            label: "Tomatoes",
            data: [7.5, 10, 17.5, 15, 12.5, 5],
            backgroundColor: "rgb(" + colors.primary + "/ .5)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Bar chart with shadow
  ctx = document.getElementById("barChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "barWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            label: "Potatoes",
            data: [5, 10, 15, 10, 15, 10],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
          {
            label: "Tomatoes",
            data: [7.5, 10, 17.5, 15, 12.5, 5],
            backgroundColor: "rgb(" + colors.primary + "/ .5)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Line chart
  ctx = document.getElementById("lineChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 8,
            pointHoverBorderWidth: 2,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Line chart with shadow
  ctx = document.getElementById("lineChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithShadow",
      data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [
          {
            data: [5, 10, 15, 10, 15, 10],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 8,
            pointHoverBorderWidth: 2,
            tension: 0.5,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            display: false,
          },
          tooltip: tooltipOptions,
        },
        scales: {
          y: {
            grid: {
              display: true,
              drawBorder: false,
            },
            min: 0,
            max: 20,
            ticks: {
              stepSize: 5,
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Pie chart
  ctx = document.getElementById("pieChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Pie chart with shadow
  ctx = document.getElementById("pieChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "pieWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Doughnut chart
  ctx = document.getElementById("doughnutChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        cutout: "75%",
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Doughnut chart with shadow
  ctx = document.getElementById("doughnutChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "doughnutWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        cutout: "75%",
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
      },
    });
  }

  // Radar chart
  ctx = document.getElementById("radarChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "radar",
      data: {
        labels: ["Drinks", "Snacks", "Lunch", "Dinner"],
        datasets: [
          {
            label: "Potatoes",
            data: [25, 25, 25, 25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
          {
            label: "Tomatoes",
            data: [15, 15, 0, 15],
            backgroundColor: "rgb(" + colors.primary + "/ .25",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            max: 30,
            ticks: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Radar chart with shadow
  ctx = document.getElementById("radarChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "radarWithShadow",
      data: {
        labels: ["Drinks", "Snacks", "Lunch", "Dinner"],
        datasets: [
          {
            label: "Potatoes",
            data: [25, 25, 25, 25],
            backgroundColor: "rgb(" + colors.primary + "/ .1)",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
          {
            label: "Tomatoes",
            data: [15, 15, 0, 15],
            backgroundColor: "rgb(" + colors.primary + "/ .25",
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            fill: true,
            pointBackgroundColor: "white",
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverBorderWidth: 2,
            pointHoverRadius: 6,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            max: 30,
            ticks: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Polar chart
  ctx = document.getElementById("polarChart");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "polarArea",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // Polar chart with shadow
  ctx = document.getElementById("polarChartWithShadow");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "polarAreaWithShadow",
      data: {
        labels: ["Potatoes", "Tomatoes", "Onions"],
        datasets: [
          {
            data: [25, 10, 15],
            backgroundColor: [
              "rgb(" + colors.primary + "/ .1)",
              "rgb(" + colors.primary + "/ .5)",
              "rgb(" + colors.primary + "/ .25)",
            ],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "bottom",
            labels: {
              usePointStyle: true,
              padding: 20,
            },
          },
          tooltip: tooltipOptions,
        },
        scales: {
          r: {
            ticks: {
              display: false,
            },
          },
        },
        layout: {
          padding: 5,
        },
      },
    });
  }

  // Line with annotation plugin
  const lineWithAnnotationPlugin = {
    afterInit: (chart) => {
      const info = chart.canvas.parentNode;

      const value = chart.data.datasets[0].data[0];
      const heading = chart.data.datasets[0].label;
      const label = chart.data.labels[0];

      info.querySelector(".chart-heading").innerHTML = heading;
      info.querySelector(".chart-value").innerHTML = "$" + value;
      info.querySelector(".chart-label").innerHTML = label;
    },
  };

  // Line with annotation options
  const lineWithAnnotationOptions = {
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        enabled: false,
        intersect: false,
        external: (ctx) => {
          const info = ctx.chart.canvas.parentNode;

          const value = ctx.tooltip.dataPoints[0].formattedValue;
          const heading = ctx.tooltip.dataPoints[0].dataset.label;
          const label = ctx.tooltip.dataPoints[0].label;

          info.querySelector(".chart-heading").innerHTML = heading;
          info.querySelector(".chart-value").innerHTML = "$" + value;
          info.querySelector(".chart-label").innerHTML = label;
        },
      },
    },
    scales: {
      y: {
        display: false,
      },

      x: {
        display: false,
      },
    },
    layout: {
      padding: {
        left: 5,
        right: 5,
        top: 10,
        bottom: 10,
      },
    },
  };

  // Line with annotation chart 1
  ctx = document.getElementById("lineWithAnnotationChart1");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart1 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Total Orders",
            data: [1250, 1300, 1550, 900, 1800, 1100, 1600],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart1) {
      const datasets = lineWithAnnotationChart1.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart1.update();
    }
  });

  // Line with annotation chart 2
  ctx = document.getElementById("lineWithAnnotationChart2");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart2 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Active Orders",
            data: [100, 125, 75, 125, 100, 75, 75],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }
  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart2) {
      const datasets = lineWithAnnotationChart2.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart2.update();
    }
  });

  // Line with annotation chart 3
  ctx = document.getElementById("lineWithAnnotationChart3");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart3 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Pending Orders",
            data: [300, 300, 600, 700, 600, 300, 300],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart3) {
      const datasets = lineWithAnnotationChart3.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart3.update();
    }
  });

  // Line with annotation chart 4
  ctx = document.getElementById("lineWithAnnotationChart4");

  if (ctx) {
    ctx.getContext("2d");

    var lineWithAnnotationChart4 = new Chart(ctx, {
      type: "lineWithAnnotation",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Shipped Orders",
            data: [200, 400, 200, 500, 100, 100, 400],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // On Theme Change
  document.addEventListener("ThemeChanged", () => {
    if (lineWithAnnotationChart4) {
      const datasets = lineWithAnnotationChart4.data.datasets[0];

      datasets.borderColor = "rgb(" + colors.primary + ")";
      datasets.pointBorderColor = "rgb(" + colors.primary + ")";
      datasets.pointHoverBackgroundColor = "rgb(" + colors.primary + ")";

      lineWithAnnotationChart4.update();
    }
  });

  // Line with annotation and shadow chart 1
  ctx = document.getElementById("lineWithAnnotationAndShadowChart1");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Total Orders",
            data: [1250, 1300, 1550, 900, 1800, 1100, 1600],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 2
  ctx = document.getElementById("lineWithAnnotationAndShadowChart2");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Active Orders",
            data: [100, 125, 75, 125, 100, 75, 75],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 3
  ctx = document.getElementById("lineWithAnnotationAndShadowChart3");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Pending Orders",
            data: [300, 300, 600, 700, 600, 300, 300],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }

  // Line with annotation and shadow chart 4
  ctx = document.getElementById("lineWithAnnotationAndShadowChart4");

  if (ctx) {
    ctx.getContext("2d");

    new Chart(ctx, {
      type: "lineWithAnnotationAndShadow",
      plugins: [lineWithAnnotationPlugin],
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Shipped Orders",
            data: [200, 400, 200, 500, 100, 100, 400],
            borderColor: "rgb(" + colors.primary + ")",
            borderWidth: 2,
            pointBorderColor: "rgb(" + colors.primary + ")",
            pointBorderWidth: 4,
            pointRadius: 2,
            pointHoverBackgroundColor: "rgb(" + colors.primary + ")",
            pointHoverBorderColor: "white",
            pointHoverRadius: 2,
            tension: 0.5,
          },
        ],
      },
      options: lineWithAnnotationOptions,
    });
  }
}
