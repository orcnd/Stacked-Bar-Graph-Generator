import 'https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js'
import 'https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0'
import 'https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline'
$(document).ready(function () {
  Chart.register(ChartDataLabels)
  //Chart.register(pluginTrendlineLinear)
})
$('#regenerateButton').click(function () {
  drawChart(formatData($('#csvData').val()))
})

function formatData(dataVirgin) {
  var dataLines = dataVirgin.split('\n')
  var rowLabels = []
  var datasets = []

  var trendlineColors = dataLines[0].split('\t')
  var backgroundColors = dataLines[1].split('\t')
  var borderColors = dataLines[2].split('\t')
  var textColors = dataLines[3].split('\t')
  var stacks = dataLines[4].split('\t')
  var columnLabels = dataLines[5].split('\t')

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

  if ($('#trendline').is(':checked')) {
    for (var i = 1; i < trendlineColors.length; i++) {
      if (trendlineColors[i].length > 0) {
        datasets[i - 1].trendlineLinear = {
          colorMin: trendlineColors[i],
          colorMax: trendlineColors[i],
          lineStyle: 'dotted|solid',
          width: 2,
          projection: true,
        }
      }
    }
  }

  for (var i = 6; i < dataLines.length; i++) {
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
  var scaleYOptions = {
    stacked: true,
    ticks: {
      beginAtZero: true,
    },
  }

  if (!$('#autoMinMax').is(':checked')) {
    scaleYOptions.min = parseFloat($('#min').val())
    scaleYOptions.max = parseFloat($('#max').val())
    scaleYOptions.barStart = parseFloat($('#min').val())
    scaleYOptions.barEnd = parseFloat($('#max').val())
  }

  const config = {
    type: 'bar',
    data: dataGiven,
    plugins: [ChartDataLabels],
    options: {
      responsive: $('#responsiveSize').is(':checked'),
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
            var str = ''
            if ($('#barInsidePercentage').is(':checked')) {
              str += '%' + Math.round((value / total) * 100)
            }

            if ($('#barInsideAmount').is(':checked')) {
              if ($('#barInsidePercentage').is(':checked')) str = '\n'
              str += '(' + new Intl.NumberFormat().format(value) + ')'
            }
            return str
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
        y: scaleYOptions,
      },
    },
  }

  $('#myChart').remove() // this is my <canvas> element
  $('#canvasContainer').append('<canvas id="myChart"><canvas>')

  if (!$('#responsiveSize').is(':checked')) {
    $('#myChart').attr('width', $('#width').val())
    $('#myChart').attr('height', $('#height').val())
  }
  var ctx = document.getElementById('myChart').getContext('2d')
  var myChart = new Chart(ctx, config)
}
