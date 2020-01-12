<?php

if(!function_exists('return_json')){
  function return_json($data){
    header('Content-Type: application/json');
    echo json_encode($data);

  }
}

if(!function_exists('query_map')){
  function query_map($m){
    if(strpos($m, 'DB_kode_daerah') !== false){
      return 'select d.nama as nama {selected} form program_kegiatan_sipd2 as a
          join view_daerah as d
          {where} group by a.kode_daerah
      ';
    }else if(strpos($m, 'DB_id_urusan') !== false){
      return array('id_urusan');
    }else if(strpos($m, 'DB_id_sub_urusan') !== false){
      return array('id_sub_urusan');
    }else if(strpos($m, 'DB_kode_program') !== false){
      return array('kode_program','kode_daerah');
    }
    else if(strpos($m, 'DB_id_pn') !== false){
      return array('id_pn');
    }
    else if(strpos($m, 'DB_id_pp') !== false){
      return array('id_pp');
    }
    else if(strpos($m, 'DB_id_kp') !== false){
      return array('id_kp');
    }
    else if(strpos($m, 'DB_id_nspk') !== false){
      return array('id_nspk');
    }
    else if(strpos($m, 'DB_id_sdgs') !== false){
      return array('id_id_sdgs');
    }
    else if(strpos($m, 'DB_id_spm') !== false){
      return array('id_id_spm');
    }
    else{
      return array();
    }

  }
}



if(!function_exists('include_where_map')){
  function include_where_map($m){
        if(strpos($m, 'DB_kode_daerah') !== false){
          return array('kode_daerah');
        }else if(strpos($m, 'DB_id_urusan') !== false){
          return array('id_urusan');
        }else if(strpos($m, 'DB_id_sub_urusan') !== false){
          return array('id_sub_urusan');
        }else if(strpos($m, 'DB_kode_program') !== false){
          return array('kode_program','kode_daerah');
        }
        else if(strpos($m, 'DB_id_pn') !== false){
          return array('id_pn');
        }
        else if(strpos($m, 'DB_id_pp') !== false){
          return array('id_pp');
        }
        else if(strpos($m, 'DB_id_kp') !== false){
          return array('id_kp');
        }
        else if(strpos($m, 'DB_id_nspk') !== false){
          return array('id_nspk');
        }
        else if(strpos($m, 'DB_id_sdgs') !== false){
          return array('id_id_sdgs');
        }
        else if(strpos($m, 'DB_id_spm') !== false){
          return array('id_id_spm');
        }
        else{
          return array();
        }

  }
}

if(!function_exists('return_json')){
  function adding_where_map($data){
    $data=explode('|',$data)[0];
    $data_where=[];

    switch ($data) {
      case 'key_daerah_p':

        break;

      default:
        // code...
        break;
    }

  }
}


if(!function_exists('request')){
  function request($data){
    if((isset($_GET[$data])) OR (isset($_POST[$data]))){
        return isset($_GET[$data])?$_GET[$data]:$_POST[$data];
    }else{

      return '';
    }
  }
}


if(!function_exists('mapper_json')){
  function mapper_json($data_return=[],$data=[],$where=[],$blue_map='key_daerah_p|DB_kode_daerah|key_urusan|DB_id_urusan|key_sub_urusan|DB_id_sub_urusan|key_program|DB_kode_program',$map='key_daerah_p|DB_kode_daerah',$optional=null){
    $data_next=[];
    $data_preview=[];

    $want_list=explode('|',$blue_map);
    $want_map=$map;
    $option_show=[
      'xd_total_angaran'=>['type'=>'sum','db'=>'jml_anggaran'],
      'xd_jumlah_program'=>['type'=>'sum','db'=>'jml_program'],
      'xd_jumlah_kegiatan'=>['type'=>'sum','db'=>'jml_kegiatan'],
      'nama'=>['type'=>'text','db'=>''],
    ];



    $map=explode('|',$map);
    $map_key=0;
    $map_con=[];
    $map_final=[];
    $text_map='';
    $where_final=[
      [
        ['tahun','=',2020],
      ]
    ];
    if($where==null){
      $where=[];
    }

    if(!($where==[])){
      foreach ($where as $key => $value) {
        // code...
      }
    }

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
    $array_exist=array_search($want_map,$want_list_final);
    $where_inclue=[];
    foreach ($want_list_final as $key => $value) {

    }


    if(isset($want_list_final[$array_exist+1])){
      $data_next['map']=$blue_map;
      $data_next['want']=($want_list_final[$array_exist+1]);
      $data_next['position']=$array_exist+1;
    }

    if(isset($want_list_final[$array_exist-1])){
      $data_preview['map']=$blue_map;
      $data_preview['want']=($want_list_final[$array_exist-1]);
      $data_preview['position']=$array_exist-1;
    }


    $where_con=[];
    foreach ($map as $key => $m) {
      if(strpos($m, 'DB_') !== false){
        array_push($map_con,$data[(str_replace('DB_','',$m))]);
        $map_final[$map_key]['head']=$map[$key-1];
        $map_final[$map_key]['mp']=$map_con;
        $map_key++;

      }else{
        array_push($map_con,$m);
      }
    }




    foreach ($map_final as $key => $m) {
      $text_map='$data_return';
      foreach ($m['mp'] as  $mm) {
        $text_map.='["'.$mm.'"]';
      }
      $map_final[$key]['mp']=[];
      $map_final[$key]['mp']=$text_map;
      $map_final[$key]['option']=mapper_op($map_final[$key]['head'],$optional);

    }


    foreach ($map_final as $key => $m) {
      eval($m['mp'].'["nama"]="";');
      eval($m['mp'].'["where"]=$where;');
      eval($m['mp'].'["no_wont_list"]=$want_list;');

       foreach ($m['option']  as $kp=>$mm ){
         if($mm['type']=='sum'){
           eval('$d=isset('.$m['mp'].'["'.$kp.'"]);');

          if(!$d){
            eval($m['mp'].'["'.$kp.'"]=(int) 0;');
          }else{
            eval($m['mp'].'["'.$kp.'"]+=(int) $data["'.$mm['db'].'"];');
          }

        }else{
          eval($m['mp'].'["'.$kp.'"]= $data["'.$mm['db'].'"];');

        }
       }
    }

    return $data_return;
  }


}


if(!function_exists('mapper_op')){
  function mapper_op($type,$optional){

    $lib=[
      'xd_jumlah_anggaran'=>['type'=>'sum','db'=>'jml_anggaran'],
      'xd_jumlah_program'=>['type'=>'sum','db'=>'jml_program'],
      'xd_jumlah_kegiatan'=>['type'=>'sum','db'=>'jml_kegiatan'],
      'nama'=>['type'=>'text','db'=>''],
    ];
    $lib_final=[];

    $op=['nama'=>false,'xd_jumlah_program'=>false,'xd_jumlah_kegiatan'=>false,'xd_jumlah_anggaran'=>false];
    $f=[];
    switch ($type) {
      case 'key_daerah_p':
        $f=['nama','xd_jumlah_program','xd_jumlah_kegiatan','xd_jumlah_anggaran'];
        $lib['nama']['db']='nama_daerah';
      break;
      default:
        // code...
      break;
    }
    if(count($f)==0){
      if($optional!=null){
        $f=$optional;
      }
    }

    foreach ($f as $key => $value) {
      if( isset($lib[$value])){
        $lib_final[$value]=$lib[$value];
      }
    }

    return $lib_final;
  }
}
