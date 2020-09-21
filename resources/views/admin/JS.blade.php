<script>
(function($) {
    'use strict';

    $('[data-href]').click(function (){
      window.location = $(this).data("href");
    });

    $(function() {
        Chart.defaults.global.legend.labels.usePointStyle = true;

        if ($("#visit-sale-chart").length) {
      Chart.defaults.global.legend.labels.usePointStyle = true;
      var ctx = document.getElementById('visit-sale-chart').getContext("2d");

      var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
      gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
      gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
      var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';
      
      var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
      gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
      gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
      var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

      var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
      gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
      var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

      
      var dobj = new Date();
      var month = {
                    1:'JAN', 2:'FEB', 3:'MAR', 4:'APR', 5:'MEI', 
                    6:'JUN', 7:'JUL', 8:'AGU', 9:'SEP', 10:'OKT', 
                    11:'NOV', 12:'DES'
                  }
      let monthAkhirTahun = [];
      let monthTahunSkrg = [];
      for(const [key, value] of Object.entries(month)){
        if (dobj.getMonth()+2 <= key){
          monthAkhirTahun.push(value+' '+(dobj.getFullYear() - 1));
          continue;
        } else{
          monthTahunSkrg.push(value+' '+dobj.getFullYear());
        }
      }
      
      for(const [key, value] of Object.entries(monthTahunSkrg)){
        monthAkhirTahun.push(value);
      }

      let myjson = JSON.parse("{{ $ChartAllMonth }}");
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthAkhirTahun, 
            datasets: [
              {
                label: "Penjualan",
                borderColor: gradientStrokeViolet,
                backgroundColor: gradientStrokeViolet,
                hoverBackgroundColor: gradientStrokeViolet,
                legendColor: gradientLegendViolet,
                pointRadius: 0,
                fill: false,
                borderWidth: 1,
                fill: 'origin',
                data: myjson[0],
              },
              {
                label: "Pengeluaran",
                borderColor: gradientStrokeRed,
                backgroundColor: gradientStrokeRed,
                hoverBackgroundColor: gradientStrokeRed,
                legendColor: gradientLegendRed,
                pointRadius: 0,
                fill: false,
                borderWidth: 1,
                fill: 'origin',
                data: myjson[1]
              },
          ]
        },
        options: {
          responsive: true,
          legend: false,
          legendCallback: function(chart) {
            var text = []; 
            text.push('<ul>'); 
            for (var i = 0; i < chart.data.datasets.length; i++) { 
                text.push('<li><span class="legend-dots" style="background:' + 
                           chart.data.datasets[i].legendColor + 
                           '"></span>'); 
                if (chart.data.datasets[i].label) { 
                    text.push(chart.data.datasets[i].label); 
                } 
                text.push('</li>'); 
            } 
            text.push('</ul>'); 
            return text.join('');
          },
          scales: {
              yAxes: [{
                  ticks: {
                    //   display: false,
                    //   min: 0,
                    //   stepSize: 500000,
                    //   max: 3000000,
                    //   beginAtZero:true,
                  },
                  gridLines: {
                    drawBorder: false,
                    color: 'rgba(235,237,242,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  }
              }],
              xAxes: [{
                  gridLines: {
                    display:false,
                    drawBorder: false,
                    color: 'rgba(0,0,0,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  },
                  ticks: {
                      padding: 20,
                      fontColor: "#9c9fa6",
                      autoSkip: true,
                  },
                  categoryPercentage: 1,
                  barPercentage: 1
              }]
            },
            tooltips: {
            callbacks: {
                    label: function(tooltipItem, chart){
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + rupiah(tooltipItem.yLabel);
                    }
                }
            }
          },
          elements: {
            point: {
              radius: 0
            }
          }
      })
      $("#visit-sale-chart-legend").html(myChart.generateLegend());
    }
    });    
})(jQuery);

function rupiah(angka){
    var rupiah = '';		
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}  
</script>
    
    