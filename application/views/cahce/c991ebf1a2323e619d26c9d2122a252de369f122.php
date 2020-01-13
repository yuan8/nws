<?php $__env->startSection('content'); ?>
<script src="<?php echo e(rt('dist/map_source/map.idn.js?v='.date('h:i'))); ?>" charset="utf-8"></script>
<div class="bg-def">

  <div class="row no-gutters ">
      <div class="col-lg-12">
        <h5 class="text-white text-center mb-4 mt-4">Data Suport System (<?php echo e($tahun); ?>)</h5>
      </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5>Perencanaan Kegiatan</h5>
                  <p><?php echo e(number_format($data['jumlah_kegiatan'],0,',','.')); ?> Kegiatan</p>
                </div>
                <div class="icon">
                    <i class="icon ion-android-locate"></i>
                </div>
                <a href="<?php echo e(rt('air_minum')); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h5>Anggaran</h5>

                  <p>Rp. <?php echo e(number_format($data['jumlah_anggaran'],0,',','.')); ?></p>
                </div>
                <div class="icon">
                  <i class="icon ion-cash"></i>
                </div>
                <a href="<?php echo e(rt('Keuangan')); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h5>Profile PDAM</h5>

                  <p><?php echo e(number_format($data2['jumlah_pdam'],0,',','.')); ?></p>
                </div>
                <div class="icon">
                  <i class="icon ion-waterdrop"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h5>Profile Kebijakan</h5>
                  <p style="min-height: 25px;"></p>
                </div>
                <div class="icon">
                  <i class="icon ion-home"></i>
                </div>
                <a href="<?php echo e(rt('kebijakan')); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
  </div>

  <div class="row" >
    <div class="col-md-12">
      <div class="chart" id="map-container" style="max-width:calc(100vw - 20px);">
      </div>
    </div>
  </div>

</div>

  <style media="screen">
  #map-container{
    /* min-height: 35vw; */
  }

  .highcharts-null-point {
    fill:#fff6db!important;
  }



  </style>

<script type="text/javascript">


Highcharts.setOptions({
  defs: {
    hatchLeft: {
      tagName: 'pattern',
      id: 'hatch-left',
      patternUnits: 'userSpaceOnUse',
      width: 4,
      height: 4,
      children: [{
        tagName: 'path',

      }]
    }
  }
});;


Highcharts.mapChart('map-container', {
  chart: {
      map: 'custome_idn',
      borderWidth: 0,
      backgroundColor:'transparent',
      borderColor:'transparent',

  },
  title: {
      text: 'Kategori PDAM Daerah Khusus NUWAS (12 Daerah)',
      style:{
        color:'#fff'
      }

  },
  subtitle: {
      text: 'BANGDA KEMENDAGRI (2020)',
      style:{
        color:'#fff'
      }
  },
  legend: {
      enabled: false
  },
  // mapNavigation: {
  //      enabled: true
  //    },
  plotOptions: {
    map: {
      color:'green'
    },
  },
  series: [{
    animation: {
       duration: 500
     },
    data:  [],
    keys: ['id_daerah', 'color','value','anggaran'],
    name: '',
    borderColor:'#d2d2d2',
    borderWidth:1,
    opacity:1,

    joinBy: 'id_daerah',
    zoomLevel:9,
    color:'red',
    tooltip: {
        headerFormat: '{point.name}',
        pointFormat: '<b>{point.name}</b><hr><br> {point.value} Kegiatan <br> Rp. {point.anggaran}'
    },
    dataLabels: {
            enabled: true,
              format: '{point.name}',
             color: '#fff',
             style: {
                        fontSize: 8,
                    },
        },
    states: {
        // backgroundColor:'red',
        hover: {
            color: '#BADA55'
        }
    }
}
]




});



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nuwas\application\views/pages/index.blade.php ENDPATH**/ ?>