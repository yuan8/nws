<?php

if(!function_exists('rt')){
  function rt($url,$data=[]){
    if(count($data)>0){
      $data='?'.http_build_query($data);
    }else{
      $data='';
    }
    $url=base_url($url);
    return $url.$data;
  }
}
