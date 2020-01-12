<?php

class anggaranNuwas extends CI_Model{

  public function a(){
    $query="

    select * from (
      select

        case when length(a.kode_daerah)<3 then a.kode_daerah else null end as  kode_daerah_provinsi,
        a.id_urusan,
        a.id_sub_urusan,
        a.uraian_kode_program_daerah,
        a.uraian_kode_kegiatan_daerah,
        a.kode_program,
        a.kode_kegiatan,
        a.anggaran,
        case when length(a.kode_daerah)>3 then d.nama else null end as nama_daerah_kabupaten,
        case when length(a.kode_daerah)<3 then d.nama else null end as nama_daerah,

        case when length(a.kode_daerah)>2 then a.kode_daerah else null end as kode_daerah_kabupaten,
        su.nama as nama_sub_urusan,
        u.nama as nama_urusan

        from program_kegiatan_sipd2 as a

       left join view_daerah as d on d.id = a.kode_daerah

       left join master_urusan as u on u.id = a.id_urusan

       left join master_sub_urusan as su on su.id = a.id_sub_urusan

       where tag_air_minum=true order by kode_daerah

      ) as p

     UNION

     select
         k.id_provinsi as kode_daerah_provinsi,
         null as id_urusan,
         null as id_sub_urusan,
         null as uraian_kode_program_daerah,
         null as uraian_kode_kegiatan_daerah,
         null as kode_program,
         null as kode_kegiatan,
         null as anggaran,
         null as nama_daerah_kabupaten,
         k.nama as nama_daerah,
         null as kode_daerah_kabupaten,
         null as  nama_sub_urusan,
         null  as nama_urusan
         from provinsi as k;

     ";


    $query2="select * from total_anggaran";
    $data_anggaran_daerah_con=query($this,$query2);
    $data=query($this,$query);

    $data_anggaran_daerah=[];
    foreach($data_anggaran_daerah_con as $d){
      $data_anggaran_daerah[$d['kodepemda']]['anggaran']=$d['total_anggaran'];
      $data_anggaran_daerah[$d['kodepemda']]['tb_urusan'][3]['anggaran']=$d['anggaran_pu'];
      $data_anggaran_daerah[$d['kodepemda']]['tb_urusan'][4]['anggaran']=$d['anggaran_perkim'];

    }

    $data_return=[];
    foreach ($data as $key => $d) {


      if((strlen($d['kode_daerah_provinsi']) == 2 ) && ($d['kode_daerah_kabupaten']==null)){
          if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_total_anggaran_air_minum'])){
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
          }else{
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_total_anggaran_air_minum']=(int) 0;
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
          }

          if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['nama'])){
          }else{
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['nama']=$d['nama_daerah'];
          }

          // $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_persentase_anggran']=($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['key_total_anggaran_air_minum']*100)/isset($data_anggaran_daerah[$d['kode_daerah_provinsi']])?$data_anggaran_daerah[$d['kode_daerah_provinsi']]['anggaran']:0;


        }


      if((($d['kode_daerah_provinsi']) == null) && ($d['kode_daerah_kabupaten']!=null) ){
        if(isset($data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_total_anggaran_air_minum'])){
          $data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
        }else{
          $data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_total_anggaran_air_minum']=(int) 0;
          $data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
        }
        if(isset($data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['nama'])){
        }else{
          $data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['nama']=$d['nama_daerah_kabupaten'];
        }

        // $data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_persentase_anggran']=($data_return['tb_provinsi'][substr($d['kode_daerah_provinsi'],0,1)]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['key_total_anggaran_air_minum']*100)/isset($data_anggaran_daerah[$d['kode_daerah_kabupaten']])?$data_anggaran_daerah[$d['kode_daerah_kabupaten']]['anggaran']:0;

      }

      if((strlen($d['id_urusan'])) && ($d['id_urusan']!=null) ){
        if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['ikey_total_anggaran_air_minumd_urusan']]['key_total_anggaran_air_minum'])){
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
        }else{
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['key_total_anggaran_air_minum']=(int) 0;
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
        }
        if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['nama'])){
        }else{
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['nama']=$d['nama_urusan'];
        }
        // $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['key_persentase_anggran']=($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['key_total_anggaran_air_minum']*100)/isset($data_anggaran_daerah[$d['kode_daerah_kabupaten']])?$data_anggaran_daerah[$d['kode_daerah_kabupaten']]['tb_urusan'][3]['anggaran']:0;

      }

      if((strlen($d['id_sub_urusan'])) && ($d['id_sub_urusan']!=null) ){
        if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['key_total_anggaran_air_minum'])){
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
        }else{
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['key_total_anggaran_air_minum']=(int) 0;
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];

          // $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['persentase_anggran']=
          // ($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['key_total_anggaran_air_minum']*100)/$data_anggaran_daerah[$d['kode_daerah_kabupaten']]['tb_urusan'][3]['anggaran'];

        }
        if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['nama'])){
        }else{
          $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['nama']=$d['nama_sub_urusan'];
        }
      }

        if((strlen($d['kode_program'])) && ($d['kode_program']!=null) ){

          if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['key_total_anggaran_air_minum'])){
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
          }else{
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['key_total_anggaran_air_minum']=(int) 0;
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['key_total_anggaran_air_minum']+=(float) $d['anggaran'];
          }
          if(isset($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['nama'])){
          }else{
            $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['nama']=$d['uraian_kode_program_daerah'];
          }
      }

      // $data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]['nama']=
      // ($data_return['tb_provinsi'][$d['kode_daerah_provinsi']]['tb_kabupaten'][$d['kode_daerah_kabupaten']]['tb_urusan'][$d['id_urusan']]['tb_sub_urusan'][$d['id_sub_urusan']]['tb_program'][$d['kode_program']]*100)/0;




    }

    return $data_return;
  }

}
