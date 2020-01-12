<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Air_minum extends CI_Controller {

  public function index(){
    return view('pages.air_minum');
  }

  public static function build($data){

    $data_return=[];
    foreach ($data as $key => $d) {
      $data_return[$d['key_id']]['jumlah_program']=isset($data_return[$d['key_id']]['jumlah_program'])?$data_return[$d['key_id']]['jumlah_program']+=((float) $d['jumlah_program']):((float) $d['jumlah_program']);
      $data_return[$d['key_id']]['jumlah_kegiatan']=isset($data_return[$d['key_id']]['jumlah_kegiatan'])?$data_return[$d['key_id']]['jumlah_kegiatan']+=((float) $d['jumlah_kegiatan']):((float) $d['jumlah_kegiatan']);
      $data_return[$d['key_id']]['nama']=isset($data_return[$d['key_id']]['nama'])?$data_return[$d['key_id']]['nama']:((string) $d['key_name']);
    }

    $data_return2=[];
    foreach ($data_return as $x => $value) {
      if(isset($value['nama'])){
        $data_return2['categories'][]=$value['nama'];
      }else{
        if(isset($value['name'])){
          $data_return2['categories'][]='Unknow';
        }
      }
      foreach ($value as $key => $v) {
        if(in_array($key,['jumlah_program','jumlah_kegiatan'])){
          $data_return2['series'][$key]['name']=$key;
          $data_return2['series'][$key]['data'][]=$v;
        }
      }

      if(count($data_return2['series'])>0){
        $key=0;
        foreach ($data_return2['series'] as $i => $value) {
          $data_return2['series'][$key]=$value;
          unshift($data_return2['series'][$i]);
          $key++;
        }
      }


    }

    return $data_return2;
  }

  public function from_urusan($where=[]){
    $query="select
      a.uraian_kode_program_daerah,
      u.nama as key_name,
      a.id_urusan as key_id,
      a.kode_program,
      count(DISTINCT(a.kode_program)) as jumlah_program,
      count(DISTINCT(a.kode_kegiatan)) as jumlah_kegiatan
      from program_kegiatan_sipd2 as a
      left join master_urusan as u on u.id = a.id_urusan
      where  a.kode_program is not null {{where}}  group by u.nama, a.kode_daerah, a.id_urusan , a.kode_program,a.uraian_kode_program_daerah  ";
      if($where!=[]){
      }else{
        $query=str_replace('{{where}}','',$query);
      }

      $data=query($this,$query);

      return_json(static::build($data));


  }
  public function form_sub_urusan($where=[]){
    $query="select
      a.uraian_kode_program_daerah,
      u.nama as key_name,
      a.id_sub_urusan as key_id,
      a.kode_program,
      count(DISTINCT(a.kode_program)) as jumlah_program,
      count(DISTINCT(a.kode_kegiatan)) as jumlah_kegiatan
      from program_kegiatan_sipd2 as a
      left join master_sub_urusan as u on u.id = a.id_sub_urusan
      where  a.kode_program is not null {{where}}   group by u.nama,a.kode_daerah, a.id_sub_urusan, a.kode_program,a.uraian_kode_program_daerah  ";
      if($where!=[]){
      }else{
        $query=str_replace('{{where}}','',$query);
      }

      $data=query($this,$query);
      return_json(static::build($data));
  }

  public function from_daerah($where=[]){
    $query="select
      d.nama,
      a.kode_daerah as kode_daerah,
      a.kode_program,
      count(DISTINCT(a.kode_program)) as jumlah_program,
      count(DISTINCT(a.kode_kegiatan)) as jumlah_kegiatan
      from program_kegiatan_sipd2 as a
      left join provinsi as d on d.id_provinsi = a.kode_daerah
      where  a.kode_program is not null {{where}}  group by d.nama, a.kode_daerah order by count(DISTINCT(a.kode_kegiatan)) desc ";

      if($where!=[]){
      }else{
        $query=str_replace('{{where}}','',$query);
      }

      $data=query($this,$query);
      return_json(static::build($data));


  }


}
