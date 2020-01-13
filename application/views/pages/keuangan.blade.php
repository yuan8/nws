
@extends('template.lay1')

@section('content')
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<div class="col-md-12 " style="padding-top:40px; ">
  <h5 class="text-center text-white "><b>DATA ANGGARAN KEGIATAN BERKAITAN DENGAN AIR MINUM</b></h5>
</div>
<div class="row no-gutters bg-def">
  <div class="col-12 col-sm-12 col-lg-12">
      <div class="col-md-12 mb-4 mt-4">
      <div class="col-md-12">
        <ul class="nav nav-tabs btn-group" id="custom-tabs-two-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link bg-default active" id="menu_menurut_daerah" data-toggle="pill" href="#menu_menurut_daerah_content" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">Berdasarkan Daerah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-default " id="menu_menurut_urusan" data-toggle="pill" href="#menu_menurut_urusan_content" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Berdasarkan Urusan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  e" target="_blank" href="{{rt('data_program_kegiatan',['nuwas'=>true])}}">Table Program Kegiatan</a>
          </li>
        </ul>

      </div>

      </div>
        <div class="col-md-12 mb-4">
          <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade active show" id="menu_menurut_daerah_content" role="tabpanel" aria-labelledby="menu_menurut_daerah">
              <div class="col-md-12 text-white" id="chart-container-per-daerah">
              </div>
            </div>
            <div class="tab-pane fade" id="menu_menurut_urusan_content" role="tabpanel" aria-labelledby="menu_menurut_urusan">
               <div class="col-md-12" id="chart-container-per-urusan">
              </div>
            </div>

          </div>
        </div>

        </div>

</div>

@stop

@section('script')
<script type="text/javascript">

  $.post('{{rt("keuangan/program_kegiatan_get_data_chart/per_provinsi")}}',{id_dom:'chart-container-per-daerah','where':[],map:['per_provinsi','per_kota','per_urusan','per_sub_urusan','per_program']},function(res){
    $('#chart-container-per-daerah').html(res);
  });

   $.post('{{rt("keuangan/program_kegiatan_get_data_chart/per_urusan")}}',{id_dom:'chart-container-per-urusan','where':[],map:['per_urusan','per_sub_urusan','per_program']},function(res){
    $('#chart-container-per-urusan').html(res);
  });

</script>


<script type="text/javascript">
  
  function getDataChart(dom,link_next,where,title,map=[]){
    $.post('{{rt("keuangan/program_kegiatan_get_data_chart/")}}'+link_next,{where:where
      ,id_dom:dom,title:title,map:map},function(res){
        $('#'+dom).html(res);
         $('html, body').animate(
            {
              scrollTop: $('#'+dom).offset().top,
            },
            500,
            'linear'
          );

         
      });
  }

</script>
@stop
