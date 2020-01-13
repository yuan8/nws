<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdam extends CI_Controller {

  public function index(){

  	$query="select a.id,d.nama as nama, a.nilai_kinerja_total,a.nilai_aspek_keuangan,a.nilai_aspek_pelayanan,a.nilai_aspek_operasional from data_sat_nuwas as a
  	join view_daerah as d on d.id = TO_CHAR(a.kode_pdam,'1111')
  	";
  	$data=query($this,$query);

    return view('pages.pdam',['data'=>$data]);
    
  }
}
