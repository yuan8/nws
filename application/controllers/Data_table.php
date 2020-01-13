<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_table extends CI_Controller {

	public function index(){

		$provinsi=request('provinsi');
		$kota=request('kota');
		$urusan=request('sub_urusan');
		$nuwas=request('nuwas');
		$q=request('q');

		$where_text='a.tag_air_minum = true';
		if($provinsi!=''){
			if($where_text==''){
				$where_text.='';

			}else{
				$where_text.=' and ';
			}

			if($kota!=''){
				$where_text.="a.kode_daerah = '".$kota."'"; 

			}else{
				$where_text.="a.kode_daerah ilike '".$provinsi." || %'"; 
			}
		}

		if($urusan!=''){
			if($where_text==''){
				$where_text.='';

			}else{
				$where_text.=' and ';
			}
			$where_text.="a.id_urusan = ".$urusan.""; 
		}

		if($sub_urusan!=''){
			if($where_text==''){
				$where_text.='';

			}else{
				$where_text.=' and ';
			}
			$where_text.="a.id_urusan = ".$sub_urusan.""; 
		}

	

		if($q!=''){
			$where='';
			if($where_text==''){
				$where_text.='';

			}else{
				$where_text.=' and ';
			}

			$where='where ('.$where_text." a.uraian_kode_program_daerah ilike '%".$q."%') and (".$where_text." a.uraian_kode_kegiatan_daerah ilike '%".$q."%')";

		}else{
			$where='where '.$where_text;
		}


		$query='select 
		a.kode_daerah,
		a.uraian_kode_program_daerah,
		a.uraian_kode__kegiatan

		from program_kegiatan_sipd2 as a 
		left join master_pn as pn on a.id_pn3 = pn.id
		left join master_nspk as pn on a.id_nspk = nspk.id
		left join master_spm as pn on a.id_nspk = nspk.id


		'

	}

}