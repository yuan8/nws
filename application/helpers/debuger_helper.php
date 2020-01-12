<?php

if(!function_exists('dd')){
  function dd($data){

    echo '<div style="background:#222; padding:10px;"><h5 style="color:#fff">Semangat BosQ :)</h5><hr><pre style="color:#fff">' . var_export($data, true) . '</pre></div>';
    die;

  }

}

if(!function_exists('last_query')){
  function last_query($t){
    dd($t->db->last_query());
  }

}


if(!function_exists('query')){
  function query($t,$data){
    $data=($t->db->query($data));
    $data=json_decode(json_encode($data->result()), True);
    return $data;
  }

}
