<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class get_detail_kegiatan extends CI_Controller {


  public function index(){
    $where='';
    $where_array=[];

    foreach($_GET as $key=> $prm){
      if($key=='kode_daerah_kabupaten'){
        $where_array['kode_daerah']=['=',in_array($key,['kode_daerah_kabupaten','kode_daerah','kode_program'])?"'".$prm."'":$prm ];
      }else{
        $where_array[$key]=['=',in_array($key,['kode_daerah_kabupaten','kode_daerah','kode_program'])?"'".$prm."'":$prm];
      }
    }

    foreach ($where_array as $key => $value) {
      if($where==''){
        $where.='where '.$key.$value[0].$value[1];
      }else{
        $where.='and '.$key.$value[0].$value[1];
      }
    }

    $query=" select
     i.id as idn_id,
     i.indikator,
     i.target_awal,
     i.target_ahir,
     i.satuan,
     a.kode_kegiatan,
     a.uraian_kode_kegiatan_daerah,
     case when pn.kegiatan_prioritas is not null then   CONCAT('(KP)',pn.kegiatan_prioritas, ' , (PP)'  ,pn.program_prioritas, ' , ' , '(PN)' ,pn.prioritas_nasional)  end  as uraian_pn,
     CONCAT(nspk.nspk) as uraian_nspk,
     CONCAT(spm.spm) as uraian_spm,
     CONCAT(sdgs.sdgs) as uraian_sdgs

    from program_kegiatan_sipd2 as a
    left join indikator_program_kegiatan as i on i.id_kegiatan_supd_2 = a.id
    left join master_pn as pn on a.id_pn3 = pn.id
    left join master_nspk as nspk on a.id_nspk =nspk.id
    left join master_spm as spm on a.id_spm =nspk.id
    left join master_sdgs as sdgs on a.id_sdgs =sdgs.id





     ".$where;

    $data=query($this,$query);
    $data_return=[];
    foreach ($data as $key => $value) {
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nama"]="'.$value['uraian_kode_kegiatan_daerah'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nspk"]="";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["spm"]="";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["pn"]="";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["sdgs"]="";');

      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nspk"]="'.$value['uraian_nspk'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["spm"]="'.$value['uraian_spm'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["pn"]="'.$value['uraian_pn'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["sdgs"]="'.$value['uraian_sdgs'].'";');

      if(isset($value['indikator'])){

        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["nama"]="'.$value['indikator'].'";');
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["target_awal"]="'.$value['target_awal'].' '.$value['satuan'].'";');
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["target_ahir"]="'.$value['target_ahir'].' '.$value['satuan'].'";');
      }else{
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]=[];');
      }

    }

    foreach ($data_return as $key => $value) {
    }
      // code...


    return view('detail_kegiatan',['data'=>$data_return]);
  }

  public static function anggaran_perdaerah(){

    $query='select * from total_anggaran';

    return query($this,$query);
  }


}
