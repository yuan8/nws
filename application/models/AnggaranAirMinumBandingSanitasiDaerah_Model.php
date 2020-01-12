<?php

class AnggaranAirMinumBandingSanitasiDaerah_Model extends CI_Model{

  public  function anggaran_perdaerah(){
    $query='select * from total_anggaran';
    return query($this,$query);
  }

  public function getData($where=[]){
    $query="
    select
    a.tag_air_minum,
    a.tag_sanitasi,
    a.kode_daerah as kode_daerah,
    case when LENGTH(a.kode_daerah) >2 then a.kode_daerah else null end as kode_daerah_kabupaten,
    d.nama as nama_daerah,
    a.id_urusan as id_urusan,
    u.nama as uraian_urusan,
    su.nama as uraian_sub_urusan,
    a.id_sub_urusan as id_sub_urusan,
    sum(a.anggaran) as total_anggaran,
    sum(CASE WHEN a.tag_air_minum then a.anggaran else 0 end) as total_anggaran_air_minum,
    sum(CASE WHEN a.tag_sanitasi then a.anggaran else 0 end) as total_anggaran_sanitasi,
    case when (a.tambahan) then (a.kode_program) else (CONCAT(a.kode_daerah,'|_|',a.kode_program)) end  as kode_program,
    a.uraian_kode_program_daerah,
    pn.prioritas_nasional as uraian_pn,
    pn.program_prioritas as uraian_pp,
    pn.kegiatan_prioritas as uraian_kp,
    pn.kp as id_kp,
    pn.pp as id_pp,
    pn.pn as id_pn,
    sdgs.id as id_sdgs,
    sdgs.sdgs as uraian_sdgs,
    spm.id as id_spm,
    spm.spm as uraian_spm,
    nspk.id as id_nspk,
    nspk.nspk as uraian_nspk,
    count(case when nspk.id is not null then 1 end ) as jumlah_nspk,
    count(case when spm.id is not null then 1 end ) as jumlah_spm,
    count(case when sdgs.id is not null then 1 end ) as jumlah_sdgs,
    count(case when pn.id is not null then 1 end ) as jumlah_pn,
    count(CASE WHEN a.kode_program is not null then DISTINCT(a.kode_program) end) as jumlah_program,
    count(CASE WHEN a.kode_kegiatan is not null then DISTINCT(a.kode_kegiatan) end ) as jumlah_kegiatan

    FROM program_kegiatan_sipd2 as a
      left join view_daerah as d on a.kode_daerah =d.id

      left join master_nspk as nspk on a.id_nspk =nspk.id
      left join master_pn as pn on a.id_pn3 =pn.id
      left join master_sdgs as sdgs on a.id_sdgs =sdgs.id
      left join master_spm as spm on a.id_spm =spm.id
      left join master_urusan as u on a.id_urusan =u.id
      left join master_sub_urusan as su on a.id_sub_urusan =su.id


      group by
      a.kode_daerah,
      d.nama,
      a.id_urusan,
      u.nama,
      a.id_sub_urusan,
      su.nama,
      a.kode_program,
      a.uraian_kode_program_daerah,
      nspk.id,
      nspk.nspk,
      pn.pn,
      pn.pp,
      pn.kp,
      pn.prioritas_nasional,
      pn.program_prioritas,
      pn.kegiatan_prioritas,
      spm.id,
      spm.spm,
      sdgs.id,
      sdgs.sdgs,
      a.tambahan,
      a.tag_sanitasi,
      a.tag_air_minum

    ";

    $query2='select sum(total_anggaran) as anggaran from view_nuwas_data {{where}}';
    $query='select * from view_nuwas_data {{where}}';
    if($where==[]){
      $query=str_replace('{{where}}','',$query);
      $query2=str_replace('{{where}}','',$query2);


    }else{
      $where_text='';
      foreach ($where as $key => $value) {
        if($where_text==''){
          $where_text.='where';
          if(strpos($value,',')!==false){
            $where_text.=' '.$key.' in ['.$value.'] ';
          }else{
            $where_text.=' '.$key.' = '.$value.' ';

          }
        }else{
          if(strpos($value,',')!==false){
            $where_text.=' and '.$key.' in ['.$value.'] ';
          }else{
            $where_text.=' and '.$key.' = '.$value.' ';

          }

        }
      }
    $query= str_replace('{{where}}',$where_text,$query);
    $query2= str_replace('{{where}}',$where_text,$query2);

    }

    return array(
        'data'=>query($this,$query),
        'presentase'=>query($this,$query2)
    );

  }


  public function map($want_list_s,$data_view=[],$where=[],$title=''){
    $data_anggaran_daerah=[];

    if(in_array('persentase_anggaran',$data_view)){
      $data_anggaran_daerah_con=$this->anggaran_perdaerah();
      foreach ($data_anggaran_daerah_con as $key => $value) {
        $data_anggaran_daerah[$value['kodepemda']]=$value['total_anggaran'];
      }

    }

    $data_return=[];


    $data=$this->getData($where);
    // foreach (array_keys($data['data'][0]) as $key => $value) {
    //     echo "null as ".$value.',';
    // }
    //
    // die;

    $data_keuangan_glob=(float)$data['presentase'][0]['anggaran'];
    if($data_keuangan_glob<0){
      $data_keuangan_glob=0;
    }

    $data=$data['data'];


    foreach ($data as $keyl => $d) {
      $list_cont='';
      $list_final=[];

      $vk_next=true;
      $vk_last_key='';

      $want_list=$want_list_s;
      $need_list=[];
      $want_list_new=[];
      $wr=[];
      foreach ($want_list as $kl => $value) {
        if(strpos($value,'DB_')!==false){
            $k=explode('DB_',$value);

            if(($d[$k[1]]==null) || !isset($d[$k[1]]) ){
              $vk_next=false;
            }else{
              if($vk_next){
                $wr[]=[$k[1]=>$d[$k[1]]];
                $k=$k[0].$d[$k[1]];
                $need_list[]=$value;
                $want_list_new[]=$k;
              }
            }

        }
        if($kl>2){
        }
      }

      $want_list=$want_list_new;
      $vk_next=true;
      $vk_last_key='';

      foreach ($want_list as $key => $value) {

        $list_cont.=($list_cont!=''?'|*|':'').$value;
        array_push($list_final,$list_cont);
        $ky=explode('|*|',$list_cont);
        $text_eval='$data_return';
        foreach ($ky as  $vk) {
          if(($vk==''||$vk==null)){
            if($vk_last_key!=''){
              $text_eval=str_replace("['".$vk_last_key."']",'',$text_eval);
              $vk_next=false;
            }
          }else{
            if($vk_next){
              if(isset($need_list[$key -1])){
                if(strpos($need_list[$key],$need_list[$key-1])===false){
                  $need_list[$key]=$need_list[$key-1].'|*|'.$need_list[$key];

                }
              }
              $vk_last_key=$vk;
              $text_eval.="['".$vk."']";
            }
          }
        }



        if($text_eval!='$data_return'){
          eval("!isset(".$text_eval.")?".$text_eval."=[]".':NULL;');
          eval($text_eval."['map']='".$need_list[$key]."';");
          eval($text_eval."['map_current']='".$list_final[$key]."';");
          $wr=[];
          $nda=explode('|*|',$list_final[$key]);
          foreach (explode('|*|',$need_list[$key]) as $kwrv=>  $wrv) {
            if(strpos($wrv,'DB_')!==false){
              $o=explode('DB_',$wrv);
              $wr[]=[$o[1]=>$nda[$kwrv]];
            }
          }
          eval($text_eval."['current_where']='".json_encode($wr)."';");

          $wr=[];
          $mbf='';

        if(isset($list_final[$key-1])){
          $mbf=$need_list[$key-1];
          $nda=explode('|*|',$list_final[$key -1]);
          foreach (explode('|*|',$need_list[$key -1]) as $kwrv=>  $wrv) {
            if(strpos($wrv,'DB_')!==false){
              $o=explode('DB_',$wrv);
              $wr[]=[$o[1]=>$nda[$kwrv]];
            }
          }
        }
        eval($text_eval."['map_before']='".$mbf."';");

        eval($text_eval."['before_where']='".json_encode($wr)."';");

        // penamaan
        if($title==''){
          eval("$"."data_return['nama']='Nasional';");
          eval("$"."data_return['tag']='Nasional';");
        }else{
          eval("$"."data_return['nama']='".$title."';");
          eval("$"."data_return['tag']='".$title."';");
        }

        if(strpos($value,'provinsi|*|')!==false){
          eval($text_eval."['nama']='".$d['nama_daerah']."';");
          eval($text_eval."['tag']='provinsi';");
          eval($text_eval."['add_where']=['kode_daerah'=>'".$d['kode_daerah']."'];");
        }

        if(strpos($value,'kabupaten|*|')!==false){
          eval($text_eval."['nama']='".$d['nama_daerah_kabupaten']."';");
          eval($text_eval."['tag']='kabupaten';");
          eval($text_eval."['add_where']=['kode_daerah_kabupaten'=>'".$d['kode_daerah_kabupaten']."'];");
        }

        if(strpos($value,'urusan|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_urusan']."';");
          eval($text_eval."['tag']='urusan';");
          eval($text_eval."['add_where']=['id_urusan'=>".$d['id_urusan']."];");
        }

        if(strpos($value,'sub_urusan|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_sub_urusan']."';");
          eval($text_eval."['tag']='sub_urusan';");
          eval($text_eval."['add_where']=['id_sub_urusan'=>".$d['id_sub_urusan']."];");


        }
        if(strpos($value,'program|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_kode_program_daerah']."';");
          eval($text_eval."['tag']='program';");
          eval($text_eval."['add_where']=['kode_program'=>'".$d['kode_program']."'];");


        }
        if(strpos($value,'pn|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_pn']."';");
          eval($text_eval."['tag']='PN';");
          eval($text_eval."['add_where']=['id_pn'=>".$d['id_pn']."];");



        }
        if(strpos($value,'pp|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_pp']."';");
          eval($text_eval."['tag']='PP';");
          eval($text_eval."['add_where']=['id_pp'=>".$d['id_pp']."];");


        }

        if(strpos($value,'kp|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_kp']."';");
          eval($text_eval."['tag']='KP';");
          eval($text_eval."['add_where']=['id_kp'=>".$d['id_kp']."];");


        }
        if(strpos($value,'spm|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_spm']."';");
          eval($text_eval."['tag']='SPM';");
          eval($text_eval."['add_where']=['id_spm'=>".$d['id_spm']."];");


        }
        if(strpos($value,'sdgs|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_sdgs']."';");
          eval($text_eval."['tag']='SDGS';");
          eval($text_eval."['add_where']=['id_sdgs'=>".$d['id_sdgs']."];");


        }

        if(strpos($value,'nspk|*|')!==false){
          eval($text_eval."['nama']='".$d['uraian_nspk']."';");
          eval($text_eval."['tag']='NSPK';");
          eval($text_eval."['add_where']=['id_nspk'=>".$d['id_nspk']."];");
        }

        if($key>300){
          dd($data_return);
        }

          foreach ($data_view as $dv) {

            if($dv=='jumlah_pn'){
              eval("!isset($"."data_return['key_jumlah_pn'])?$"."data_return['key_jumlah_pn']=0".':NULL;');
              eval("$"."data_return['key_jumlah_pn']+=".$d['jumlah_pn'].";");

              eval("!isset(".$text_eval."['key_jumlah_pn'])?".$text_eval."['key_jumlah_pn']=0".':NULL;');
              eval($text_eval."['key_jumlah_pn']+=".$d['jumlah_pn'].";");
            }
            if($dv=='jumlah_nspk'){
              eval("!isset($"."data_return['key_jumlah_nspk'])?$"."data_return['key_jumlah_nspk']=0".':NULL;');
              eval("$"."data_return['key_jumlah_nspk']+=".$d['jumlah_nspk'].";");

              eval("!isset(".$text_eval."['key_jumlah_nspk'])?".$text_eval."['key_jumlah_nspk']=0".':NULL;');
              eval($text_eval."['key_jumlah_nspk']+=".$d['jumlah_nspk'].";");
            }
            if($dv=='jumlah_spm'){
              eval("!isset($"."data_return['key_jumlah_spm'])?$"."data_return['key_jumlah_spm']=0".':NULL;');
              eval("$"."data_return['key_jumlah_spm']+=".$d['jumlah_spm'].";");

              eval("!isset(".$text_eval."['key_jumlah_spm'])?".$text_eval."['key_jumlah_spm']=0".':NULL;');
              eval($text_eval."['key_jumlah_spm']+=".$d['jumlah_spm'].";");
            }
            if($dv=='jumlah_sdgs'){
              eval("!isset($"."data_return['key_jumlah_sdgs'])?$"."data_return['key_jumlah_sdgs']=0".':NULL;');
              eval("$"."data_return['key_jumlah_sdgs']+=".$d['jumlah_sdgs'].";");

              eval("!isset(".$text_eval."['key_jumlah_sdgs'])?".$text_eval."['key_jumlah_sdgs']=0".':NULL;');
              eval($text_eval."['key_jumlah_sdgs']+=".$d['jumlah_sdgs'].";");
            }

            if($dv=='jumlah_program'){
              eval("!isset($"."data_return['key_jumlah_program'])?$"."data_return['key_jumlah_program']=0".':NULL;');
              eval("$"."data_return['key_jumlah_program']+=".$d['jumlah_program'].";");

              eval("!isset(".$text_eval."['key_jumlah_program'])?".$text_eval."['key_jumlah_program']=0".':NULL;');
              eval($text_eval."['key_jumlah_program']+=".$d['jumlah_program'].";");
            }
            if($dv=='total_anggaran'){
              eval("!isset($"."data_return['key_total_anggaran'])?$"."data_return['key_total_anggaran']=0".':NULL;');
              eval("$"."data_return['key_total_anggaran']+=".$d['total_anggaran'].";");

              eval("!isset(".$text_eval."['key_total_anggaran'])?".$text_eval."['key_total_anggaran']=0".':NULL;');
              eval($text_eval."['key_total_anggaran']+=".$d['total_anggaran'].";");

              // eval("!isset(".$text_eval."['key_persentase_total_anggaran'])?".$text_eval."['key_persentase_total_anggaran']=0".':NULL;');
              // eval($text_eval."['key_persentase_total_anggaran']=(float) number_format(".($text_eval."['key_total_anggaran']")."*"."100"."/".$data_keuangan_glob.",3);");


            }

            if($dv=='total_anggaran_air_minum'){

              eval("!isset($"."data_return['key_total_anggaran_air_minum'])?$"."data_return['key_total_anggaran_air_minum']=0".':NULL;');
              eval("$"."data_return['key_total_anggaran_air_minum']+=".$d['total_anggaran_air_minum'].";");

              eval("!isset(".$text_eval."['key_total_anggaran_air_minum'])?".$text_eval."['key_total_anggaran_air_minum']=0".':NULL;');
              eval($text_eval."['key_total_anggaran_air_minum']+=".$d['total_anggaran_air_minum'].";");

              // eval($text_eval."['key_persentase_total_anggaran_air_minum']=(float) number_format(".($text_eval."['key_total_anggaran_air_minum']")."*"."100"."/".$data_keuangan_glob.",3);");
            }

            if($dv=='total_anggaran_sanitasi'){

              eval("!isset($"."data_return['key_total_anggaran_sanitasi'])?$"."data_return['key_total_anggaran_sanitasi']=0".':NULL;');
              eval("$"."data_return['key_total_anggaran_sanitasi']+=".$d['total_anggaran_sanitasi'].";");

              eval("!isset(".$text_eval."['key_total_anggaran_sanitasi'])?".$text_eval."['key_total_anggaran_sanitasi']=0".':NULL;');
              eval($text_eval."['key_total_anggaran_sanitasi']+=".$d['total_anggaran_sanitasi'].";");

              // eval($text_eval."['key_persentase_total_anggaran_sanitasi']=(float) number_format(".($text_eval."['key_total_anggaran_sanitasi']")."*"."100"."/".$data_keuangan_glob.",3);");

            }

            if($dv=='jumlah_kegiatan'){

              eval("!isset($"."data_return['key_jumlah_kegiatan'])?$"."data_return['key_jumlah_kegiatan']=0".':NULL;');
              eval("$"."data_return['key_jumlah_kegiatan']+=".$d['jumlah_kegiatan'].";");

              eval("!isset(".$text_eval."['key_jumlah_kegiatan'])?".$text_eval."['key_jumlah_kegiatan']=0".':NULL;');
              eval($text_eval."['key_jumlah_kegiatan']+=".$d['jumlah_kegiatan'].";");
            }

            if($dv=='persentase_anggaran'){
              $key_anggaran=false;
              eval("$"."key_anggaran=isset(".$text_eval."['key_total_anggaran'])?true:false;");
              if($key_anggaran){
                eval("isset(".$text_eval."['key_persentase_total_anggaran'])?null:".$text_eval."['key_persentase_total_anggaran']=0;");

                $key_daerah=0;
                eval("$"."key_daerah=".$text_eval."['map_current'];");
                if(strpos($key_daerah,'tb_kabupaten')!==false){
                  $key_daerah=explode('tb_kabupaten',$key_daerah)[1];
                  $key_daerah=explode('|*|',$key_daerah)[1];
                  if(isset($data_anggaran_daerah[$key_daerah])){
                    eval($text_eval."['key_persentase_total_anggaran']=(float) number_format( (((".($text_eval."['key_persentase_total_anggaran']").")*"."100".")/ ( ".$data_anggaran_daerah[$key_daerah].")) ,3);");
                  }else{
                    eval($text_eval."['key_persentase_total_anggaran']=100;");
                  }
                }
              }
              eval("$"."key_anggaran=isset(".$text_eval."['key_total_anggaran_air_minum'])?true:false;");
              if($key_anggaran){
                eval("isset(".$text_eval."['key_persentase_total_anggaran_air_minum'])?null:".$text_eval."['key_persentase_total_anggaran_air_minum']=0;");


                $key_daerah=0;
                eval("$"."key_daerah=".$text_eval."['map_current'];");
                if(strpos($key_daerah,'tb_kabupaten')!==false){
                  $key_daerah=explode('tb_kabupaten',$key_daerah)[1];
                  $key_daerah=explode('|*|',$key_daerah)[1];
                  if(isset($data_anggaran_daerah[$key_daerah])){
                    eval($text_eval."['key_persentase_total_anggaran_air_minum']=(float) number_format( (((".($text_eval."['key_persentase_total_anggaran_air_minum']").")*"."100".")/ ( ".$data_anggaran_daerah[$key_daerah].")) ,3);");
                  }else{
                    eval($text_eval."['key_persentase_total_anggaran_air_minum']=100;");
                  }
                }
              }

              eval("$"."key_anggaran=isset(".$text_eval."['key_total_anggaran_sanitasi'])?true:false;");

              if($key_anggaran){
                eval("isset(".$text_eval."['key_persentase_total_anggaran_sanitasi'])?null:".$text_eval."['key_persentase_total_anggaran_sanitasi']=0;");

                $key_daerah=0;
                eval("$"."key_daerah=".$text_eval."['map_current'];");
                if(strpos($key_daerah,'tb_kabupaten')!==false){
                  $key_daerah=explode('tb_kabupaten',$key_daerah)[1];
                  $key_daerah=explode('|*|',$key_daerah)[1];
                  if(isset($data_anggaran_daerah[$key_daerah])){
                    eval($text_eval."['key_persentase_total_anggaran_sanitasi']=(float) number_format( (((".($text_eval."['key_total_anggaran_sanitasi']").")*"."100".")/ ( ".$data_anggaran_daerah[$key_daerah].")) ,3);");
                  }else{
                    eval($text_eval."['key_persentase_total_anggaran_sanitasi']=100;");
                  }
                }


              }


            }

          }
          // end foreach data_op


          eval("!isset(".$text_eval."['bf_map'])?".$text_eval."['bf_map']='".(isset($list_final[$key-1])?$list_final[$key-1]:null)."'".':NULL;');
        }

      }




    }

    return $data_return;

  }

}
