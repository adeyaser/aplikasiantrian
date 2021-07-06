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

}

/* End of file List_menu.php */
/* Location: ./application/models/List_menu.php */