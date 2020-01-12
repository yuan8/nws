<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  public function get(){

    if ($user_logged_in === FALSE)
      {
           redirect('/account/login', 'refresh');
      }
    echo json_encode(['code'=>500,'message'=>'server not found','data'=>[]]);
  }


  public function index(){
      $query="select
        a.kode_daerah,
        a.id_urusan,
        a.id_sub_urusan,
        a.kode_program,
        d.nama as nama_daerah,
        sum(a.anggaran) as jml_anggaran,
        count(DISTINCT(CONCAT(a.kode_daerah,a.kode_program))) as jml_program,
        count(DISTINCT(CONCAT(a.kode_daerah,a.kode_kegiatan))) as jml_kegiatan

        from program_kegiatan_sipd2 as a
        left join view_daerah as d on a.kode_daerah = d.id
        group by
        a.kode_daerah,
        a.id_urusan,
        a.id_sub_urusan,
        a.kode_program,
        d.nama

      ";

      $want_list=explode('|',request('map'));
      $want_map=request('want');

      $want_list_final=[];
      $want_list_cont='';
      $want_list_cont_key=0;
      foreach($want_list as $key => $m) {
        if(strpos($m, 'DB_') !== false){
          if($want_list_cont==''){
            $want_list_cont.=$m;
          }else{
            $want_list_cont.='|'.$m;
          }
          $want_list_final[]=$want_list_cont;
          $want_list_cont='';
        }else{
          if($want_list_cont==''){
            $want_list_cont.=$m;
          }else{
            $want_list_cont.='|'.$m;
          }
        }
      }

      // dapatkan letak data yang dimita dari blue print
      $array_exist=0;
      $array_exist=array_search($want_map,$want_list_final);
      $query_used='select * from program_kegiatan_sipd2';

      $where_include=[];
      foreach ($want_list_final as $key => $value) {
          if($key<$array_exist){
            array_push($where_include,include_where_map($value));
          }
          if(strpos($value,$want_map)){
            $query_used=query_map($value);
          }
      }








      $data=query($this,$query);

      $data_return=[];

    foreach ($data as $key => $value) {
      $data_return=mapper_json($data_return,$value,$where_include,request('map'),request('want'));
    }

    return_json(array('code'=>200,'data'=>$data_return));

  }


  public function data(){
    $this->load->model('AnggaranAirMinumBandingSanitasiDaerah_Model');

    $list_need=''!==request('list_need')?request('list_need'):[];
    $data_show=''!==request('data_show')?request('data_show'):[];
    $where=''!==(request('where'))?request('where'):[];

    $data=$this->AnggaranAirMinumBandingSanitasiDaerah_Model->map($list_need,$data_show,$where);

    return_json(array('code'=>200,'data'=>$data));


    // $data=($this->AnggaranAirMinumBandingSanitasiDaerah_Model->map(['provinsi|*|DB_kode_daerah'],['jumlah_pn','jumlah_spm','jumlah_nspk','jumlah_program','jumlah_kegiatan','total_anggaran','total_anggaran_sanitasi','total_anggaran_air_minum']));
    // dd($this->AnggaranAirMinumBandingSanitasiDaerah_Model->map(['sdgs|*|DB_id_sdgs','pn|*|DB_id_pn','pp|*|DB_id_pp','kp|*|DB_id_kp'],['jumlah_pn','jumlah_spm','jumlah_nspk','jumlah_program','jumlah_kegiatan','total_anggaran']));

    // dd($data);
  }


  public function pu(){
    $this->load->model('AnggaranAirMinumBandingSanitasiDaerah_Model');

    $list_need=''!==request('list_need')?request('list_need'):[];
    $data_show=''!==request('data_show')?request('data_show'):[];
    $where=''!==(request('where'))?request('where'):[];

    $data=$this->AnggaranAirMinumBandingSanitasiDaerah_Model->map($list_need,$data_show,['tag_sanitasi'=>'true'],'Profile Program,Kegiatan Sanitas');

    return_json(array('code'=>200,'data'=>$data));

  }

  public function perkim(){
    $this->load->model('AnggaranAirMinumBandingSanitasiDaerah_Model');

    $list_need=''!==request('list_need')?request('list_need'):[];
    $data_show=''!==request('data_show')?request('data_show'):[];
    $where=''!==(request('where'))?request('where'):[];

    $data=$this->AnggaranAirMinumBandingSanitasiDaerah_Model->map($list_need,$data_show,['tag_air_minum'=>'true'],'Profile Program,Kegiatan Air Minum');

    return_json(array('code'=>200,'data'=>$data));

  }

  public function anggaran_air_minum(){
    $this->load->model('AnggaranNuwas');
    $data=$this->AnggaranNuwas->a();
    return_json(array('code'=>200,'data'=>$data));

  }

}
