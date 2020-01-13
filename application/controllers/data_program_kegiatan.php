<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_program_kegiatan extends CI_Controller {

	public function index(){


		$where='';
		$nuwas=''!=request('nuwas')?request('nuwas'):null;
		$kode_daerah=''!=request('kode_daerah')?request('kode_daerah'):null;
		$urusan=''!=request('id_urusan')?request('id_urusan'):null;
		$sub_urusan=''!=request('id_sub_urusan')?request('id_sub_urusan'):null;
		$wh=isset($_GET['wh'])?$_GET['wh']:null;

		if($wh){

		}
		


		if($nuwas){
			if($where!=''){
				$where.=' and ';
			}

			$where.=" a.kode_daerah in ('1207','1373','1472','1403','1709','3202','3311','3572','3524','3502','6301','7172') ";
		}

		$s_daerah=query($this,'select * from view_daerah '.(($nuwas)?" where id in ('1207','1373','1472','1403','1709','3202','3311','3572','3524','3502','6301','7172')":'') );

		$s_urusan=query($this,'select * from master_urusan' );

		$s_sub_urusan=query($this,'select * from master_sub_urusan' );

		if($kode_daerah){
			if($where!=''){
				$where.=' and ';
			}

			$where.=" a.kode_daerah = '".$kode_daerah."'";
		}

		if($urusan){
			if($where!=''){
				$where.=' and ';
			}

			$where.=" a.id_urusan = ".$urusan;
		}

		if($sub_urusan){
			if($where!=''){
				$where.=' and ';
			}

			$where.=" a.id_sub_urusan = ".$sub_urusan;
		}



		if($where!=''){
			$where='where '.$where;
		}

		if($wh){
			$where='';
			$where_text='';
			foreach (json_decode($wh) as $key => $value) {
		      if($key==0){
		      $where_text.=' where ';
		      }else{
		        $where_text.=' and ';
		      }

		      $where_text.=' '.$value[0].' '.$value[1];
		      if($value[3]=='string'){
		        $where_text.="'".((string) $value[2] )."'";
		      }else if($value[3]=='boolean'){
		        $where_text.=((boolean) $value[2] )?'true':'false';

		      }else if($value[3]=='numberic'){
		        $where_text.=((int) $value[2] );

		      }else{
		        $where_text.=( $value[2] );

		      }
		    }

		    $where=$where_text;
		}
		


		 $query=" select
		     i.id as idn_id,
		     i.indikator,
		     i.target_awal,
		     i.target_ahir,
		     i.satuan,
		     a.kode_kegiatan,
		     a.anggaran,
		     a.uraian_kode_kegiatan_daerah,
		     a.uraian_kode_program_daerah,
		     u.nama as nama_urusan,
		     su.nama as nama_sub_urusan,
		     d.nama as nama_daerah,


		     case when pn.kegiatan_prioritas is not null then   CONCAT('(KP)',pn.kegiatan_prioritas, ' , (PP)'  ,pn.program_prioritas, ' , ' , '(PN)' ,pn.prioritas_nasional)  end  as uraian_pn,
		     CONCAT(nspk.nspk) as uraian_nspk,
		     CONCAT(spm.spm) as uraian_spm,
		     CONCAT(sdgs.sdgs) as uraian_sdgs

		    from program_kegiatan_sipd2 as a
		    left join indikator_program_kegiatan as i on i.id_kegiatan_supd_2 = a.id
		    left join master_pn as pn on a.id_pn3 = pn.id
		    left join master_nspk as nspk on a.id_nspk =nspk.id
		    left join master_spm as spm on a.id_spm =nspk.id
		    left join master_sdgs as sdgs on a.id_sdgs =sdgs.id
		    left join master_sub_urusan as su on a.id_sub_urusan =su.id
		    left join master_urusan as u on a.id_urusan =u.id
		    left join view_daerah as d on a.kode_daerah =d.id






     ".$where.' ';

    $data=query($this,$query);
    $data_return=[];
    foreach ($data as $key => $value) {
    	eval('!isset($data_return["'.''.$value['kode_kegiatan'].'"]["indikator"])?$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]=[]:null;');

      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nama"]="'.$value['uraian_kode_kegiatan_daerah'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nspk"]="";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["anggaran"]='.$value['anggaran'].';');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["urusan"]="'.$value['nama_urusan'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["daerah"]="'.$value['nama_daerah'].'";');

      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["sub_urusan"]="'.$value['nama_sub_urusan'].'";');


      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["program"]="'.$value['uraian_kode_program_daerah'].'";');


      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["spm"]="";');
      
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["pn"]="";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["sdgs"]="";');

      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["nspk"]="'.$value['uraian_nspk'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["spm"]="'.$value['uraian_spm'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["pn"]="'.$value['uraian_pn'].'";');
      eval('$data_return["'.''.$value['kode_kegiatan'].'"]["sdgs"]="'.$value['uraian_sdgs'].'";');


      if(isset($value['indikator'])){

        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["nama"]="'.$value['indikator'].'";');
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["target_awal"]="'.$value['target_awal'].' '.$value['satuan'].'";');
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]["'.$value['idn_id'].'"]["target_ahir"]="'.$value['target_ahir'].' '.$value['satuan'].'";');
      }else{
        eval('$data_return["'.''.$value['kode_kegiatan'].'"]["indikator"]=[];');
      }

    }

		return view('pages.data_program_kegiatan',['datas'=>$data_return,'s_daerah'=>$s_daerah,'s_urusan'=>$s_urusan,'s_sub_urusan'=>$s_sub_urusan]);
	}

}