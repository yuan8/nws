<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_pu extends CI_Controller {

  public function index(){
    return view('profile_pu',['title'=>'Profile Air Minum']);
  }

}
