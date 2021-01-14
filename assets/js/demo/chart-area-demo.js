// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

var data = {
  labels: ["Jan", "Mar", "Jun", "Sep", "Dec"],
  datasets: [{
      label: "D",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "purple",
      borderColor: "purple", // The main line color
      // notice the gap in the data and the spanGaps: true
      data: [65, 59, 80, 81, 56],
      spanGaps: true,
    }, {
      label: "I",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "green",
      borderColor: "green", // The main line color
      // notice the gap in the data and the spanGaps: false
      data: [10, 20, 60, 95, 64],
      spanGaps: false,
    }, {
      label: "S",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "aqua",
      borderColor: "aqua", // The main line color
      // notice the gap in the data and the spanGaps: false
      data: [41, 24, 66, 100, 99],
      spanGaps: false,
    }, {
      label: "C",
      fill: false,
      lineTension: 0.1,
      backgroundColor: "orange",
      borderColor: "orange", // The main line color
      // notice the gap in the data and the spanGaps: false
      data: [70, 67, 30, 25, 10],
      spanGaps: false,
    }

  ]
};

// var options = {
//   scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 },
//                 scaleLabel: {
//                      display: true,
//                      labelString: 'Moola',
//                      fontSize: 20 
//                   }
//             }]            
//         }  
// };

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: true
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ": " + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
