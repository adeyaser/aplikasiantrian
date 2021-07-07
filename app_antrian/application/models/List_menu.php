<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_menu extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_menu($data)
	{
		$sql   ="SELECT * FROM LISTMENU WHERE GROUP_ID='$data'";
		$result = $this->db->query($sql)->result();
		return $result;
	}

	public function login($username,$password)
	{
		$sql   ="select * from ACL_USER where USERNAME ='$username' and password='$password'";
		/*print_r($sql);die;*/
		$result = $this->db->query($sql)->result();
		return $result;
	}

	public function kunjungan()
	{
		$sql="select 'kunjungan',tgl_sort as tanggal,count(*) as jumlah
    		 from ( select DATE_FORMAT(tanggal,'%Y-%m-%d') as tgl_sort,
             tanggal FROM (
                SELECT * FROM antrian ORDER BY tanggal ASC)T 
                )A GROUP BY tgl_sort ORDER BY tgl_sort";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function get_P_antrian($id)
	{
		$room=$id['room'];
		$sql="select count_sq('$room') as room";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function reporting($tanggal_awal ='',$tanggal_akhir='')
	{
		$where='';

		if($tanggal_awal !='' && $tanggal_akhir !=''){
			$tanggal_akhir = date("Y-m-d", strtotime($tanggal_akhir.'+ 1 days'));
		   $where .= " WHERE  tanggal  BETWEEN CAST('$tanggal_awal' AS DATE) AND CAST('$tanggal_akhir' AS DATE)";
		}

		$sql=" select *
				 from (
						SELECT 
						no_antrian,
						id_antrian,
						room,
						DATE_FORMAT(tanggal,'%d-%m-%Y') as tgl_sort,
						tanggal,
						id_pasien,
						nama_pasien,
						id_pegawai,
						nama_pegawai,
						case 
						  when aktif = 'Y' then 'Belum Memenuhi Panggilan'
						  else 'Memenuhi Panggilan' end as keterangan
						FROM (
						  SELECT 
							a.no_antrian,
							a.id_antrian,
							substr(a.id_antrian,1,1)as room,
							a.tanggal,
							a.id_pasien,
							p.nama_pasien,
							a.id_pegawai,
							pg.nama_pegawai,
							a.aktif 
						  FROM ANTRIAN a 
						  LEFT JOIN pasien p on a.id_pasien = p.id_pasien 
						  LEFT JOIN pegawai pg on a.id_pegawai = pg.id_pegawai 
						  ORDER BY TANGGAL ASC
				  		 )T 
			  		)A  $where ";
			// print_r($sql);die;
		$data = $this->db->query($sql);
	    return $data->result();

	}

}

/* End of file List_menu.php */
/* Location: ./application/models/List_menu.php */