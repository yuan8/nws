<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

  public function index(){
    $this->load->model('AnggaranNuwas');
    $data=$this->AnggaranNuwas->a();
  }


}
