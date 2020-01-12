<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NUWSP - Kementrian Dalam Negeri</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{base_url('dist/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{rt('dist/css/ionicon.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <script src="{{base_url('dist/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{rt('dist/map_source/hi.js')}}" charset="utf-8"></script>


 <!-- <script src="https://code.highcharts.com/maps/highmaps.js"></script> -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
  <link rel="stylesheet" href="{{base_url('dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{base_url('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{base_url('dist/plugins/jqvmap/jqvmap.min.css')}}"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{base_url('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{base_url('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{base_url('dist/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{base_url('dist/plugins/summernote/summernote-bs4.css')}}">
  <!-- <script src="{{rt('dist/fs/highcharts.js')}}" charset="utf-8"></script> -->

  <!-- jQuery UI 1.11.4 -->
  <script src="{{base_url('dist/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
 <!-- <script src="{{rt('dist/fs/highcharts-3d.js')}}" charset="utf-8"></script> -->
 <!-- <script src="{{rt('dist/fs/modules/exporting.js')}}" charset="utf-8"></script> -->
 <!-- <script src="{{rt('dist/fs//modules/export-data.js')}}" charset="utf-8"></script> -->
 <script src="{{rt('dist/map_source/treer9.js')}}" charset="utf-8"></script>
 <link rel="stylesheet" href="{{rt('dist/css/custome.css?v='.date('h:i'))}}">
 <script src="{{base_url('dist/js/adminlte.js')}}"></script>





   <style media="screen">
   .form-group input[type="checkbox"] {
  display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
  width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
  display: none;
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
  display: inline-block;
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
  display: inline-block;
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
  display: none;
}
   </style>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>
<body class=" layout-top-nav">
      @include('component.nav')


  <div class="wrapper bg-def" >
      <div class="container-fluid" >
        @yield('content')
      </div>
      @yield('side_bar')
  </div>
</body>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{base_url('dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{base_url('dist/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{base_url('dist/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<!-- <script src="{{base_url('dist/plugins/jqvmap/jquery.vmap.min.js')}}"></script> -->
<!-- <script src="{{base_url('dist/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> -->
<!-- jQuery Knob Chart -->
<script src="{{base_url('dist/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{base_url('dist/plugins/moment/moment.min.js')}}"></script>
<script src="{{base_url('dist/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{base_url('dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{base_url('dist/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{base_url('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->

@yield('script')

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{base_url('dist/js/pages/dashboard.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->

<style media="screen">
  .container-fluid{
    padding: 0px;
    max-width:calc( 100%);
    padding-left: 7.5px;
    padding-right: 7.5px;
  }
  .no-gutters{
    margin-left: -7.5px!important;
    margin-right: -7.5px!important;
  }
  .chart{
    margin-bottom: 15px;
    max-width: calc(100% - 15px);
  }
  .highcharts-container {
    max-width: calc(100% );
  }

  .highcharts-root{
    max-width: 100%;
  }

  .navbar{
    padding: 0px;
  }

  .navbar .nav-item {
    padding: 5px;
  }

  .nav-header{
    min-height: 50px;
  }
  .navbar-brand{
    flex: auto;
    padding: 5px;
    padding-left: 20px;
    min-height: 100%;
  }
  .wrapper{
    margin-top: 55px;
  }

  body{
    background: #f1f1f1;
  }

  .box,.card,.info-box,.form-control,.btn{
    border:1px solid #a3b3c3;
  }

</style>


<script type="text/javascript">

function buildDataChart(datalist){
  var categories=[];
  var data_con=[];
  var data=[];

  for(var i in datalist){
    if(!categories.includes(datalist[i].key_name)){
      categories.push(datalist[i].key_name);
    }

    for(var k in datalist[i]){
      if(k.includes('data_')){
        if(data[k] == undefined){
          data[k]=[];
          data[k]['name']=k.replace('data_','').replace(/_/g,' ');
          data[k]['data']=[];
        }
          data[k]['data'].push(parseFloat(datalist[i][k]));
      }
    }


  }
  var index=0;
  for(var i in data){
    data[index]=data[i];
    delete data[i];
    index++;
  }


  return {
    categories:categories,
    data:data
  };

}

</script>
</html>