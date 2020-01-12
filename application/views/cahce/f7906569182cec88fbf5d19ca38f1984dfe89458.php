


<?php $__env->startSection('content'); ?>
<div class="row no-gutters bg-def">
  <div class="col-12 col-sm-12 col-lg-12">
      <div class="col-md-12 mb-4 mt-4">
      <div class="col-md-12">
        <ul class="nav nav-tabs btn-group" id="custom-tabs-two-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link bg-default active" id="menu_menurut_daerah" data-toggle="pill" href="#menu_menurut_daerah_content" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">Menurut Daerah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-default " id="menu_menurut_urusan" data-toggle="pill" href="#menu_menurut_urusan_content" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Menurut Urusan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  e" target="_blank" href="<?php echo e(rt('data_program_kegiatan',['nuwas'=>true])); ?>">Table Program Kegiatan</a>
          </li>
        </ul>

      </div>

      </div>
        <div class="col-md-12 mb-4">
          <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade active show" id="menu_menurut_daerah_content" role="tabpanel" aria-labelledby="menu_menurut_daerah">
              <div class="col-md-12" id="chart-container">
              </div>
            </div>
            <div class="tab-pane fade" id="menu_menurut_urusan_content" role="tabpanel" aria-labelledby="menu_menurut_urusan">

            </div>

          </div>
        </div>

        </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
// Set up the chart
$.get("<?php echo e(rt('/Program_kegiatan/per_provinsi')); ?>",function(res){
   build(buildDataChart(res));
})

function build(data){
console.log(data);

var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'chart-container',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        },
        // backgroundColor:'transparent',
        borderColor:'transparent'
    },
    xAxis: [{
       categories:data.categories,
       style:{
         color:'#222'
       },
       crosshair: true
   }],

    title: {
        text: 'Jumlah Program,Kegiatan Per Provinsi( Provinsi dan Kota/Kabupaten)',
        style:{
          color:'#222'
        }
    },
    subtitle: {
        text: 'Test options by dragging the sliders below',
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
              var val = (this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
              return val;
            }
          }
        }
    },
    series: data.data
});
}

// function showValues() {
//     $('#alpha-value').html(chart.options.chart.options3d.alpha);
//     $('#beta-value').html(chart.options.chart.options3d.beta);
//     $('#depth-value').html(chart.options.chart.options3d.depth);
// }
//
// // Activate the sliders
// $('#sliders input').on('input change', function () {
//     chart.options.chart.options3d[this.id] = parseFloat(this.value);
//     showValues();
//     chart.redraw(false);
// });
//
// showValues();

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/NUWAS/nuwas/application/views/pages/air_minum.blade.php ENDPATH**/ ?>