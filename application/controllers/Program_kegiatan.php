<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_kegiatan extends CI_Controller {

  public function per_provinsi(){

    $query="select p.id_provinsi as key,p.nama as key_name,
      count(DISTINCT(a.kode_program)) as data_jumlah_program,count(DISTINCT(a.kode_kegiatan)) as data_jumlah_kegiatan from provinsi as p
      left join program_kegiatan_sipd2 as a on a.kode_daerah ILIKE '%' || p.id_provinsi || '%'
      group by p.id_provinsi order by count(DISTINCT(a.kode_kegiatan)) desc
    ";
    $data=query($this,$query);

    return_json($data);
  }

  public function per_kota($id_provinsi=''){

    $query="select p.id_kota as key,p.nama as key_name,
      count(DISTINCT(a.kode_program)) as data_jumlah_program,count(DISTINCT(a.kode_kegiatan)) as data_jumlah_kegiatan
      from kabupaten as p
      left join program_kegiatan_sipd2 as a on a.kode_daerah = p.id_kota where p.id_kota ilike '".$id_provinsi."%'
      group by p.id_kota order by count(DISTINCT(a.kode_kegiatan)) desc
    ";

    $data=query($this,$query);

    return_json($data);

  }


}
