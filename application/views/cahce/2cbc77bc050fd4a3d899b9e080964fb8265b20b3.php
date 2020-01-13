
<div>
  <div class="col-md-12 mb-4" id="<?php echo e($dom); ?>"></div>
  <div class=" mb-4" id="<?php echo e($id_chart); ?>-chart-container-table"></div>
</div>


<script type="text/javascript">
  

var <?php echo e($id_chart); ?>_datasources=<?php echo json_encode($data);?>;

var <?php echo e($id_chart); ?>_data=buildDataChart(<?php echo e($id_chart); ?>_datasources,"<?php echo e(in_array($next_link,['','x'])?'':$next_link); ?>" ,<?php echo json_encode($map); ?>);
// var <?php echo e($id_chart); ?>_id_chart=<?php echo e($id_chart); ?>_datasources.data.id_chart;

var <?php echo e($id_chart); ?>_chart = new Highcharts.Chart({
    chart: {
        renderTo: '<?php echo e($dom); ?>',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        },
        events:{
              click:function(e){

                  var index=parseInt(Math.round(e.xAxis[0].value));
                  if(index<0){
                    index=0;
                  }
                  if(<?php echo e($id_chart); ?>_data.options[index].link_next!=''){
                    getDataChart('<?php echo e($id_chart); ?>-chart-container-table',<?php echo e($id_chart); ?>_data.options[index].link_next,<?php echo e($id_chart); ?>_data.options[index].where_add,'Program Kegiatan '+<?php echo e($id_chart); ?>_data.options[index].key_name,<?php echo e($id_chart); ?>_data.options[index].map);
                  }
                  
                }
        },
        // backgroundColor:'transparent',
        borderColor:'transparent'
    },
    xAxis: [{
       categories:<?php echo e($id_chart); ?>_data.categories,
       style:{
         color:'#222'
       },
       crosshair: true,
       options:<?php echo e($id_chart); ?>_data.options
   }],
   yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Program Kegiatan',
                
            }
        },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormatter:function(){
         var val=this.y;
              if((val%1)!=0){
                val=val.toFixed(2);
              }
              val = (val).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
          '<td style="padding:0"><b>: '+val+'</b></td></tr>'

      },

      footerFormat: '</table>',
      shared: true,
      crosshairs: true,
      useHTML: true
  },

    title: {
        text: '<?php echo e($title); ?>',
        style:{
          color:'#222'
        }
    },
    subtitle: {
        text: '<?php echo e($subtitle); ?>',
        style:{
          color:'#222'
        }
    },
    colors:['#007bff','#001f3f'],
    plotOptions: {
        column: {
            depth: 25
        },
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            formatter: function() {
              var val=this.y;
              if((val%1)!=0){
                val=val.toFixed(2);
              }
              val = (val).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

              return val;
            }
          },
          point:{
            events:{
              click:function(e){
                  var index=this.index;
                   if(<?php echo e($id_chart); ?>_data.options[index].link_next!=''){
                    getDataChart('<?php echo e($id_chart); ?>-chart-container-table',<?php echo e($id_chart); ?>_data.options[index].link_next,<?php echo e($id_chart); ?>_data.options[index].where_add,'Program Kegiatan '+<?php echo e($id_chart); ?>_data.options[index].key_name,<?php echo e($id_chart); ?>_data.options[index].map);
                  }
                  console.log(e);
                }
             },

          }
        },
         
    },
    series: <?php echo e($id_chart); ?>_data.data
});

var <?php echo e($id_chart); ?>_dom_table='<div class="col-md-12"><div class="card text-dark "><div class="card-body"><table class="table table-condensed"><thead><tr>';
for(var i in <?php echo e($id_chart); ?>_data['table'][0]){
  <?php echo e($id_chart); ?>_dom_table+='<th>'+<?php echo e($id_chart); ?>_data['table'][0][i]+'</th>';
}
<?php echo e($id_chart); ?>_dom_table+='</tr></thead><tbody>';

for(var i=1; i < <?php echo e($id_chart); ?>_data['table'].length;i++ ){
  <?php echo e($id_chart); ?>_dom_table+='<tr>';
      for(var k in <?php echo e($id_chart); ?>_data['table'][i] ){
        var dt= <?php echo e($id_chart); ?>_data['table'][i][k];
        if((typeof dt)=='number'){
          if((dt%1)!=0){
            dt=<?php echo e($id_chart); ?>_data['table'][i][k].toFixed(2);
          }
          dt=dt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        <?php echo e($id_chart); ?>_dom_table+='<td>'+dt+'</td>';
      }

  <?php echo e($id_chart); ?>_dom_table+='</tr>';


}

<?php echo e($id_chart); ?>_dom_table+='</tbody></table></div></div></div>';


$('#<?php echo e($id_chart); ?>-chart-container-table').html(<?php echo e($id_chart); ?>_dom_table);

setTimeout(function(){

          $('#<?php echo e($id_chart); ?>-chart-container-table table').DataTable();

},500);

</script><?php /**PATH C:\xampp\htdocs\nuwas\application\views/component/themchart.blade.php ENDPATH**/ ?>