
<div class="chart" id="chart">

</div>



<script type="text/javascript">

Highcharts.chart('chart', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'JUMLAH NSPK,SPM,PN,SDGS PER PROVINSI'
  },
  subtitle: {
      text: 'SUMBER DATA RKPD'

  },
  xAxis: {

      categories: ['a','b','c','d'],
      crosshair: true
  },
  yAxis: {
      min: 0,
      title: {
          text: 'JUMLAH'
      }
  },
   tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormatter:function(){
        var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
          '<td style="padding:0"><b>: '+val+'</b></td></tr>'

      },

      footerFormat: '</table>',
      shared: true,
      useHTML: true
  },
  plotOptions: {
      column: {
          pointPadding: 0.2,
          borderWidth: 0
      },
       series: {
          borderWidth: 0,
          dataLabels: {
              enabled: true,
              formatter: function(){
            var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return val;                }
          }
      }
  },
  series: [
   {
      name: 'NSPK',
      data: [2,10,60,23]

  }]
});


</script>
<?php /**PATH /var/NUWAS/nuwas/application/views/component/mapper.blade.php ENDPATH**/ ?>