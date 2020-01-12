

<?php $__env->startSection('content'); ?>
<script src="<?php echo e(rt('dist/js/sort.js')); ?>" charset="utf-8"></script>
<script src="<?php echo e(rt('dist/js/datatable.js')); ?>" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo e(rt('dist/css/datatable.css')); ?>">

<style media="screen">
  .space-right {
    margin-left: 5px;
    margin-right: 5px;

  }
</style>
<div class="co bg bg-white mb-4" style="padding:10px">
  <h4><b><?php echo e($title); ?></b> </h4>
  <hr>
</div>
<div class="row mb-4">

<form id="form_data_op" class="col-md-9" >
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" checked name="data_show[]" value="total_anggaran" id="sd3">
          <label class="custom-control-label" for="sd3">Total Anggaran</label>
        </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" checked name="data_show[]" value="total_anggaran_sanitasi" id="sd4">
          <label class="custom-control-label" for="sd4">Total Anggaran Sanitasi</label>
        </div>

        <!-- <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" checked name="data_show[]" value="total_anggaran_air_minum" id="sd5">
          <label class="custom-control-label" for="sd5">Total Anggaran Air Minum</label>
        </div> -->




      </div>
    </div>
    <div class="col-md-3">
      <div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" checked name="data_show[]" value="jumlah_program" id="customSwitch1">
          <label class="custom-control-label" for="customSwitch1">Jumlah Program</label>
        </div>

        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" checked name="data_show[]" value="jumlah_kegiatan" id="sd2">
          <label class="custom-control-label" for="sd2">Jumlah Kegiatan</label>
        </div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input"  name="data_show[]" value="jumlah_pn" id="sd6">
          <label class="custom-control-label" for="sd6">Jumlah PN</label>
        </div>


      </div>

    </div>
    <div class="col-md-3">
      <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input"  name="data_show[]" value="jumlah_nspk" id="sd7">
        <label class="custom-control-label" for="sd7">Jumlah NSKP</label>
      </div>
      <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input"  name="data_show[]" value="jumlah_spm" id="sd8">
        <label class="custom-control-label" for="sd8">Jumlah SPM</label>
      </div>
        <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input"  name="data_show[]" value="jumlah_sdgs" id="sd9">
        <label class="custom-control-label" for="sd9">Jumlah SDGS</label>
      </div>

    </div>

  </div>
</form>

    <div class="col-md-3">
      <!-- <label for="">FILTER</label> -->
      <button type="button" class="btn btn-primary col mb-3" data-widget="control-sidebar" data-slide="true" href="#k" name="button"><i class="fas fa-sort-alpha-up"></i> Atur Tingkatan </button>
      <!-- <div class="input-group">
        <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas sort-numeric-down text-primary"></i>
                </span>
              </div>
              <select class="form-control" name="">
                <option value="jumlah_program">Jumlah Program</option>
                <option value="jumlah_kegiatan">Jumlah Kegiatan</option>
                <option value="total_anggaran">Total Anggaran</option>
                <option value="total_anggaran_sanitasi">Total Anggaran Sanitasi</option>
                <option value="total_anggaran_air_minum">Total Anggaran Air Minum</option>

              </select>
            </div>

      </div> -->
    </div>

  </div>



<div class="chart text-center" id='chart'>

</div>


<div class="card card-">
  <div class="card-header">
    <!-- <a data-widget="control-sidebar" data-slide="true" href="#k"><i class="fas fa-th-large"></i> Filter Data </a> -->
  </div>
  <div class="card-body table-responsive" id="container-table">
  </div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('side_bar'); ?>

<aside class="control-sidebar control-sidebar-dark" id="k" style="height:calc(100vh - 60px); overflow-y:scroll; position:fixed;">
  <button type="button" class="btn btn-primary col" data-widget="control-sidebar" data-slide="true" href="#k" name="button"> Close </button>

  <form class="" action="" method="get" id="form_filter">
    <ul class="list-group" id="list_positif" style="min-height: 100px; background-color: #f1f1f1;">
      <li class="list-group-item bg bg-dark text-white">Filter</li>

      <b class="text-center" style="margin-top: 2px; padding-bottom: 2px; margin-bottom: 0px; border-bottom: 1px solid #222">Drop Area</b>
      <li class="list-group-item tr op daerah text-dark">Daerah
        <input type="hidden" name="map[]" value="tb_provinsi|*|DB_kode_daerah">

      </li>
      <li class="list-group-item tr op bidang text-dark">Bidang
        <input type="hidden" name="map[]" value="tb_urusan|*|DB_id_urusan">
      </li>
      <li class="list-group-item tr op sub_bidang text-dark">Sub Bidang
        <input type="hidden" name="map[]" value="tb_sub_urusan|*|DB_id_sub_urusan">
      </li>



      <li class="list-group-item tr op program text-dark">Program
        <input type="hidden" name="map[]" value="tb_program|*|DB_kode_program">
      </li>
    </ul>
  </form>


  <ul class="list-group" id="">
    <li class="list-group-item bg bg-dark text-white">
      <button type="btn" id="btn" class="btn btn-primary col" onclick="getdtFrom()">Submit</button>
    </li>
  </ul>


  <ul class="list-group" style="min-height: 100px; background-color: #f1f1f1;">
    <li class="list-group-item bg bg-danger text-white">Tidak Digunakan</li>
    <b class="text-center" style="margin-top: 2px; padding-bottom: 2px; margin-bottom: 0px; border-bottom: 1px solid #222">Drag Area</b>
    <div id="list_negatif">

      <li class="list-group-item tr op pn text-dark">PN
        <input type="hidden" name="map[]" value="tb_pn|*|DB_id_pn">
      </li>
      <li class="list-group-item tr op pn text-dark">PP
        <input type="hidden" name="map[]" value="tb_pp|*|DB_id_pp">
      </li>
      <li class="list-group-item tr op pn text-dark">KP
        <input type="hidden" name="map[]" value="tb_kp|*|DB_id_kp">
      </li>
      <li class="list-group-item tr op pn text-dark">SPM
        <input type="hidden" name="map[]" value="tb_spm|*|DB_id_spm">
      </li>
      <li class="list-group-item tr op pn text-dark">SDGS
        <input type="hidden" name="map[]" value="tb_sdgs|*|DB_id_sdgs">
      </li>

    </div>

  </ul>


</aside>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  function buildChart(title, sub_title, y_title, categories, data) {
    Highcharts.chart('chart', {
        chart: {
          type: 'column',
          events: {
            click: function(e) {

              var l = parseInt(Math.round(e.xAxis[0].value));
              if (l < 0) {
                l = 0;
              }
              var d = (data_container[l]);
              if (d != undefined) {
                navigation_chart(d.map_current);
              } else {
                alert('sistem gagal');
              }
            }
          }
        },
        title: {
          text: title
        },
        subtitle: {
          text: sub_title

        },
        xAxis: {

          categories: categories,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: y_title
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormatter: function() {
            var val = (this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return '<tr><td style="color:{series.color};padding:0">' + this.series.name + ' </td>' +
              '<td style="padding:0"><b>: ' + val + '</b></td></tr>'

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
              formatter: function() {
                var val = (this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return val;
              }
            },
            point: {
              events: {
                click: function() {
                  var d = (data_container[this.index]);
                  if (d != undefined) {
                    navigation_chart(d.map_current);
                  } else {
                    alert('sistem gagal');
                  }
                }
              }
            }
          }
        },
        series: data
      }, function(chart) { // on complete
        chart.renderer.button('Back', 5, 5)
          .attr({
            zIndex: 9999,

          }).on('click', function() {
            if (current_data.hasOwnProperty('bf_map')) {
              if (current_data.bf_map != '') {
                navigation_chart(current_data.bf_map);

              } else {
                navigation_chart('');

              }
            } else {
              // navigation_chart('');
              navigation_chart('');




            }

          }).addClass('btn btn-warning').add();

      }

    );

  }
</script>


<script type="text/javascript">
  function replaceName(name) {
    name = name.replace(/key_/g, '');

    name = name.replace(/_/g, ' ');
    name = name.toUpperCase();

    return name;
  }

  var global_data = [];
  var data_container = [];
  var current_data = [];






  function getDATA(map = [], data_show = [], where = []) {

    $('#chart').html('<i class="align-middle fa fa-spinner mb-4 fa-spin fa-fw margin-bottom fas text-center text-primary" style="font-size: 100px; margin:15px;"></i><h5 class="text-center text-primary mb-4">Loading ...</h5>');

    $.post('<?php echo e(rt('/api/anggaran_air_minum')); ?>', {
      list_need: map,
      data_show,
      where: where
    }, function(res) {

      if (parseInt(res.code) == 200) {
        global_data = res.data;
        resData(res);
      }
    });
  }


  $('.list-group-item.op').on('change', function() {
    getdtFrom();
  });


  function getdtFrom() {
    var data = $('#form_filter').serializeArray();
    var data_show = $('#form_data_op').serializeArray();
    var data_s = [];
    for (var i in data_show) {
      if (data_show.hasOwnProperty(i)) {
        data_s.push(data_show[i].value);

      }
    }

    var map = [];
    for (var i in data) {
      if (data.hasOwnProperty(i)) {
        map.push(data[i].value);
      }
    }
    getDATA(map, data_s, []);
  }

  getDATA(['tb_provinsi|*|DB_kode_daerah', 'tb_urusan|*|DB_id_urusan', 'tb_sub_urusan|*|DB_id_sub_urusan', 'tb_program|*|DB_kode_program'], ['total_anggaran', 'total_anggaran_sanitasi', 'jumlah_program',
    'jumlah_kegiatan'], []);

  function resData(res, title = '', subtitle = 'Sumber Data RKPD', y_title = '') {

    var data_c = [];
    var categories = [];
    var data_chart = [];
    data_container = [];
    current_data = res.data;
    for (var i in res.data) {
      if (i.indexOf('tb_') > -1) {
        var dt = res.data[i];
        title = res.data.nama;
        for (var ik in dt) {
          if (dt.hasOwnProperty(ik)) {
            categories.push(dt[ik].nama);
            y_title = (dt[ik].tag).toUpperCase();
            data_container.push(dt[ik]);
            for (var k in dt[ik]) {
              if (k.indexOf('key_') > -1) {
                if (data_c.hasOwnProperty(k)) {
                  data_c[k].push((dt[ik][k]));
                } else {
                  data_c[k] = [];
                  data_c[k].push(dt[ik][k]);
                }
              }
            }

          }
        }


      }
    }

    for (var i in data_c) {
      if (data_c.hasOwnProperty(i)) {
        data_chart.push({
          'name': replaceName(i),
          'data': data_c[i]
        });
      }
    }
    buildTable(categories, data_container, data_chart);

    buildChart(title.toUpperCase() + ' / ' + y_title.toUpperCase(), subtitle, y_title, categories, data_chart);
  }


  function navigation_chart(map) {

    var map = map.split('|*|');
    var text_eval = 'global_data';
    if ((typeof map) == ('object')) {
      for (var i = 0; i < map.length; i++) {
        if (map[i] != '') {
          text_eval += "['" + map[i] + "']";
        }
      }
    } else {}


    var data = eval(text_eval + ';');
    var res = {
      data: data
    };
    resData(res, '', null, null);



  }

  function buildTable(categories, dt = data_container, data_chart) {
    dom_tb = [];
    dom_head = [];

    for (var i = 0; i < dt.length; i++) {
      var arr = [];
      arr.push('<button class="btn btn-primary" onclick="navigation_chart(`' + dt[i].map_current + '`)">Detail</button>');
      if (!dom_head.hasOwnProperty(0)) {
        dom_head[0] = 'NO.';
        dom_head[1] = 'ACTION';
      }

      arr.push(categories[i]);
      if (!dom_head.hasOwnProperty(2)) {
        dom_head[2] = dt[i].tag.toUpperCase();
      }
      var lk=0;
      for (var k in data_chart) {
        arr.push((data_chart[k].data[i]).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        if (!dom_head.hasOwnProperty((3 + k))) {
          lk=3+k;
          dom_head[(3 + k)] = '';
          dom_head[(3 + k)] = data_chart[k].name;
        }
      }

      dom_head[lk+1]='Detail Kegiatan';
      dom_tb.push(arr);
    }

    dom_head = dom_head.filter(function(el) {
      return el != null;
    });

    var dmh = '<table id="tbdata_table" class="table table-bordered table-condensed"><thead><tr>';
    for (var i = 0; i < dom_head.length; i++) {
      dmh += '<th>' + dom_head[i] + '</th>';
    }
    dmh + '</tr></thead><tbody>';

    for (var i = 0; i < dom_tb.length; i++) {
      dmh += '<tr><td>'+(i+1)+'</td>';
      for (var k = 0; k < dom_tb[i].length; k++) {
        var satuan='';
        // if(dom_head[k+5].indexOf('PERSENTASE')>-1){
        //   satuan="%";
        // }
        dmh += '<td>' + dom_tb[i][k]+' '+satuan + '</td>';
      }
      dmh+='<td><button class="btn btn-primary" onclick="detailKegiatan('+i+')">Detail Kegiatan</button></td>';
      dmh += '</tr>';
    }
    dmh + '</body><table>';


    $('#container-table').html(dmh);
    setTimeout(function(){
      $('.table').DataTable();
    },1000);
  }




  Sortable.create(list_positif, {
    animation: 100,
    group: 'list-1',
    draggable: '.tr',
    handle: '.tr',
    sort: true,
    filter: '.sortable-disabled',
    chosenClass: 'active'
  });


  Sortable.create(list_negatif, {
    group: 'list-1',
    handle: '.tr'
  });


  function detailKegiatan(i){
    var data=data_container[i];
    var where=JSON.parse(data.current_where);
    var where_final={};
    for (var i in where) {
      if (where.hasOwnProperty(i)) {
        for(var k in where[i]){
          where_final[k]=where[i][k];
        }
      }
    }
    console.log(where_final);
    where_final=$.param(where_final);

    window.open('<?php echo e(rt('get_detail_kegiatan')); ?>?'+where_final,'_blank');

  }
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.lay1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/NUWAS/nuwas/application/views/keuangan_pu.blade.php ENDPATH**/ ?>