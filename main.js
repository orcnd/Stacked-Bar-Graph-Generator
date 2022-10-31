import 'https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js'
import 'https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0'

$(document).ready(function () {
  Chart.register(ChartDataLabels)
})
$('#addDataSave,#regenerateButton').click(function () {
  $('#addCSVModal').modal('hide')
  drawChart(formatData($('#csvData').val()))
  return true
})

function formatData(dataVirgin) {
  var dataLines = dataVirgin.split('\n')
  var rowLabels = []
  var datasets = []

  var backgroundColors = dataLines[0].split('\t')
  var borderColors = dataLines[1].split('\t')
  var textColors = dataLines[2].split('\t')
  var stacks = dataLines[3].split('\t')
  var columnLabels = dataLines[4].split('\t')

  for (var i = 1; i < columnLabels.length; i++) {
    datasets[i - 1] = {
      label: columnLabels[i],
      data: [],
      stack: stacks[i],
      backgroundColor: backgroundColors[i],
      borderColor: borderColors[i],
      color: textColors[i],
    }
  }

  for (var i = 5; i < dataLines.length; i++) {
    var line = dataLines[i].split('\t')
    rowLabels.push(line[0])
    for (var j = 1; j < line.length; j++) {
      datasets[j - 1].data.push(parseFloat(line[j]))
    }
  }

  return {
    labels: rowLabels,
    datasets: datasets,
  }
}

function drawChart(dataGiven) {
  const config = {
    type: 'bar',
    data: dataGiven,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      tooltips: { enabled: false },
      events: [],
      plugins: {
        datalabels: {
          formatter: (value, ctx) => {
            var total = 0
            for (var i in ctx.chart.data.datasets) {
              var ds = ctx.chart.data.datasets[i]
              if (ds.stack == ctx.dataset.stack) {
                total += ds.data[ctx.dataIndex]
              }
            }

            return (
              '%' + Math.round((value / total) * 100) + '\n (' + value + ')'
            )
          },
          color: $('#barInsideColor').val(),
        },
      },
      interaction: {
        intersect: false,
      },
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true,
          min: parseFloat($('#min').val()),
          max: parseFloat($('#max').val()),
          barStart: parseFloat($('#min').val()),
          barEnd: parseFloat($('#max').val()),
          ticks: {
            beginAtZero: true,
          },
        },
      },
    },
  }

  $('#myChart').remove() // this is my <canvas> element
  $('#canvasContainer').append('<canvas id="myChart"><canvas>')
  var ctx = document.getElementById('myChart').getContext('2d')
  var myChart = new Chart(ctx, config)
}
