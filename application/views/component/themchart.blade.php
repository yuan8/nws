
<div>
  <div class="col-md-12 mb-4" id="{{$dom}}"></div>
  <div class=" mb-4" id="{{$id_chart}}-chart-container-table"></div>
</div>


<script type="text/javascript">
  

var {{$id_chart}}_datasources=<?php echo json_encode($data);?>;

var {{$id_chart}}_data=buildDataChart({{$id_chart}}_datasources,"{{in_array($next_link,['','x'])?'':$next_link}}" ,<?php echo json_encode($map); ?>);
// var {{$id_chart}}_id_chart={{$id_chart}}_datasources.data.id_chart;

var {{$id_chart}}_chart = new Highcharts.Chart({
    chart: {
        renderTo: '{{$dom}}',
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
                  if({{$id_chart}}_data.options[index].link_next!=''){
                    getDataChart('{{$id_chart}}-chart-container-table',{{$id_chart}}_data.options[index].link_next,{{$id_chart}}_data.options[index].where_add,'Program Kegiatan '+{{$id_chart}}_data.options[index].key_name,{{$id_chart}}_data.options[index].map);
                  }
                  
                }
        },
        // backgroundColor:'transparent',
        borderColor:'transparent'
    },
    xAxis: [{
       categories:{{$id_chart}}_data.categories,
       style:{
         color:'#222'
       },
       crosshair: true,
       options:{{$id_chart}}_data.options
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
        text: '{{$title}}',
        style:{
          color:'#222'
        }
    },
    subtitle: {
        text: '{{$subtitle}}',
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
                   if({{$id_chart}}_data.options[index].link_next!=''){
                    getDataChart('{{$id_chart}}-chart-container-table',{{$id_chart}}_data.options[index].link_next,{{$id_chart}}_data.options[index].where_add,'Program Kegiatan '+{{$id_chart}}_data.options[index].key_name,{{$id_chart}}_data.options[index].map);
                  }
                  console.log(e);
                }
             },

          }
        },
         
    },
    series: {{$id_chart}}_data.data
});

var {{$id_chart}}_dom_table='<div class="col-md-12"><div class="card text-dark "><div class="card-body"><table class="table table-condensed"><thead><tr>';
for(var i in {{$id_chart}}_data['table'][0]){
  {{$id_chart}}_dom_table+='<th>'+{{$id_chart}}_data['table'][0][i]+'</th>';
}
{{$id_chart}}_dom_table+='</tr></thead><tbody>';

for(var i=1; i < {{$id_chart}}_data['table'].length;i++ ){
  {{$id_chart}}_dom_table+='<tr>';
      for(var k in {{$id_chart}}_data['table'][i] ){
        var dt= {{$id_chart}}_data['table'][i][k];
        if((typeof dt)=='number'){
          if((dt%1)!=0){
            dt={{$id_chart}}_data['table'][i][k].toFixed(2);
          }
          dt=dt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        {{$id_chart}}_dom_table+='<td>'+dt+'</td>';
      }

  {{$id_chart}}_dom_table+='</tr>';


}

{{$id_chart}}_dom_table+='</tbody></table></div></div></div>';


$('#{{$id_chart}}-chart-container-table').html({{$id_chart}}_dom_table);

setTimeout(function(){

          $('#{{$id_chart}}-chart-container-table table').DataTable();

},500);

</script>