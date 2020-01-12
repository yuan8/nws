<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$tahun=2020;

		$query='select count(*) jumlah_kegiatan, sum(anggaran) as jumlah_anggaran from program_kegiatan_sipd2 where tahun='.$tahun;
		$data=query($this,$query);
		if(count($data)>0){
			$data=$data[0];
		}

		$data_return=[];

		$query='select count(*) jumlah_kegiatan, sum(anggaran) as jumlah_anggaran from program_kegiatan_sipd2 where tahun='.$tahun;

	   return view('pages.index',['title'=>'Dashboard','data'=>$data,'tahun'=>$tahun]);
	}

	public function t(){
		return view('index');

	}

	public function keuangan_pu(){
		return view('keuangan_pu',['title'=>'Profile PU']);
	}

}
