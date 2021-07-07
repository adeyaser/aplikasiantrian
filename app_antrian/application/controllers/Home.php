<?php

defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model("list_menu");
    }

/*INDEX */
    public function index()
    {
        if($this->session->userdata('group') !=null){
           $sub_title='Dashboard';
            if($this->session->userdata('loket') !='ADMIN'){
                $views='conten/conten_user';
                $this->view_request($sub_title,$views);
             }else{
                if($this->session->userdata('group')== 1){ 
                    $views='conten/conten';
                    $this->view_request($sub_title,$views);
                }else{ 
                    $this->session->set_flashdata('notif','Anda Bukan Seorang Admin'); 
                    $this->view_request_login(); 
                }
            }
           
        }else{
          $this->view_request_login();
      }
    }
/*INDEX */

/*UNTUK VIEW MENAMPILKAN */
    public function view_request($conten,$views)
    {
      if(! $this->session->userdata('group')){
               $this->view_request_login();
        }
        $data= $this->get_menuList();
      /*  echo "<pre>";
        print_r($data);die;*/
        $this->load->view('template/header',$data);
        $this->load->view('template/top',$data);
        $this->load->view('template/side',$data);
        $this->load->view($views,$conten);
        $this->load->view('template/footer',$data);
    }
/*UNTUK VIEW MENAMPILKAN */

/*UNTUK VIEW MENAMPILKAN LOGIN*/
    public function view_request_login()
    {
        $this->load->view('template/header');
        $this->load->view('conten/login');
    }
/*UNTUK VIEW MENAMPILKAN LOGIN*/

/*UNTUK LOGIN*/

    public function login()
    {
        $username =$this->input->post('username');
        $password =md5($this->input->post('password'));
        // $password='d41d8cd98f00b204e9800998ecf8427e';
        // $username='adejoko';
        $login=$this->list_menu->login($username,$password);

         if($login){
            $data_sesion = array( 'username'             => $login[0]->username,
                                   'id_pegawai_pasien'   => $login[0]->id_pegawai_pasien,
                                   'group'               => $login[0]->group_id,
                                   'loket'               => $this->input->post('loket'),
                                  );
        
             $this->session->set_userdata($data_sesion);
         }else{
            $this->session->set_flashdata('notif','Login Gagal Silakan Coba Kembali'); 
         }
         // print_r($this->session->userdata('group'));die;
         $this->index();

    }
/*END UNTUK LOGIN*/

    public function get_menuList()
    {
        $group = $this->session->userdata('group');
        $result= $this->list_menu->get_menu($group);
        foreach($result as $key=> $val)
        {
            if($val->idetitas=='Data Master'){
                $masterdata[] = $val;
            }elseif($val->idetitas=='Data Antrian'){
                $antrian[] = $val;
            }elseif($val->idetitas=='Laporan'){
                $laporan[] = $val;
            }elseif($val->idetitas=='Pengaturan'){
                $pengaturan[] = $val;
            }
        }

        $data['title']       ='Sistem Antrian';
        $data['user']        = $this->session->userdata('id_pegawai_pasien');
        $data['username']    = $this->session->userdata('username');
        $data['group']       = $this->session->userdata('group');
        $data['littel_title']='<b>S</b>A';
        $data['fotter']      ='Sistem Informasi Antrian';

        if($group == 1){
          $data['masterdata']  =$masterdata;
          $data['laporan']     =$laporan;
        }

        $data['antrian']     =$antrian;
        $data['pengaturan']  =$pengaturan;
        // echo"<pre>";
        // print_r($result);die;
        return $data;

    }
 
 /* UNTUK USER */
    public function master_user()
    {
       $data['conten']='Master User';
       $views='conten/acl_user';
       $this->view_request($data,$views);
        
    }

    public function get_user()
    {
        // $params=2;
        $params = $this->input->post('id_acl');
        if($params !=null){
          $master_user  =$this->getdataurl('acl_user?id_acl='.$params);
        }else{
          $master_user  =$this->getdataurl('acl_user');  
        }

        $result       = $master_user;
        // print_r($result);die;

        $data = array(
            'data' => array()
		);
		$num = 1;		
        foreach($result  as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
            $data['data'][$key]['action']  = '<button type="button" id="ID_ACL" name="ID_ACL" onclick="editacl(\''.$data['data'][$key]['id_acl'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_acl"><i class="fa fa-pencil-square"></i></button>';
            $data['data'][$key]['action'] .= ' <button type="button" id="ID_ACL" name="ID_ACL" onclick="hapus_acl(\''.$data['data'][$key]['id_acl'].'\')"  value="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="hapus_acl"><i class="fa fa-trash-o"></i></button>';
            $num++;
        }
        echo json_encode($data);


    }

    public function edit_user()
    {
        // $params=2;
        $params = $this->input->post('ID_ACL');
        // print_r($params);die;
        $master_user  =$this->getdataurl('acl_user?id_acl='.$params);

        $result       = $master_user;
        echo json_encode($result);

    }

    public function update_user()
    {
        // $params=2;
        $params       = ($_POST);
        //  print_r($params);die;
        $master_user  = $this->senddataurl('acl_user',$params,'PUT');
        $result       = $master_user;
        echo json_encode($result);

    }

    public function add_user()
    {
        // $params=2;
        $params       = ($_POST);
        $master_user  = $this->senddataurl('acl_user',$params,'POST');
        $result       = $master_user;
        echo json_encode($result);

    }

    public function delete_user()
    {
        // $params=2;
        $params       = ($_POST);
        $master_user  = $this->senddataurl('acl_user',$params,'DELETE');
        $result       = $master_user;
        echo json_encode($result);

    }
/* END UNTUK USER */

/* UNTUK PEGAWAI*/

    public function master_pegawai()
    {
       $data['conten']='Master Pegawai ';
       $views='conten/pegawai';
       $this->view_request($data,$views);
        
    }

    public function get_pegawai()
    {
        // $params=2;
        $params = $this->input->post('id_pegawai');
        if($params !=null){
          $master_pegawai  =$this->getdataurl('pegawai?id_pegawai='.$params);
        }else{
          $master_pegawai  =$this->getdataurl('pegawai');  
        }
        $result       = $master_pegawai;
        $data = array(
            'data' => array()
		);
		$num = 1;		
        foreach($result  as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
            $data['data'][$key]['action']  = '<button type="button" id="ID_PEGAWAI" name="ID_PEGAWAI" onclick="editpegawai(\''.$data['data'][$key]['id_pegawai'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_pegawai"><i class="fa fa-pencil-square"></i></button>';
            $data['data'][$key]['action'] .= '<button type="button" id="ID_PEGAWAI" name="ID_PEGAWAI" onclick="hapus_pegawai(\''.$data['data'][$key]['id_pegawai'].'\')"  value="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="hapus_pegawai"><i class="fa fa-trash-o"></i></button>';
            $num++;
        }
        echo json_encode($data);
    }

    public function edit_pegawai()
    {
        // $params=2;
        $params = $this->input->post('id_pegawai');
        $master_pegawai  =$this->getdataurl('pegawai?id_pegawai='.$params);

        $result          = $master_pegawai;
        echo json_encode($result);

    }

    public function update_pegawai()
    {
        // $params=2;
        $params         = ($_POST);
        $master_pegawai = $this->senddataurl('pegawai',$params,'PUT');
        $result         = $master_pegawai;
        echo json_encode($result);

    }

    public function add_pegawai()
    {
        // $params=2;
        $params        = ($_POST);
        $master_pegawai= $this->senddataurl('pegawai',$params,'POST');
        $result        = $master_pegawai;
        echo json_encode($result);

    }

    public function delete_pegawai()
    {
        // $params=2;
        $params         = ($_POST);
        $master_pegawai = $this->senddataurl('pegawai',$params,'DELETE');
        $result         = $master_pegawai;
        echo json_encode($result);

    }

/* END UNTUK PEGAWAI*/

/* UNTUK PASIEN*/

    public function master_pasien()
    {
       $data['conten']='Master Pasien ';
       $views='conten/pasien';
       $this->view_request($data,$views);
        
    }

    public function get_pasien()
    {
        // $params=2;
        $params = $this->input->post('id_pasien');
        if($params !=null){
          $master_pasien  =$this->getdataurl('pasien?id_pasien='.$params);
        }else{
          $master_pasien  =$this->getdataurl('pasien');  
        }

        $result       = $master_pasien;
        $data = array(
            'data' => array()
		);
		$num = 1;		
        foreach($result  as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
            $data['data'][$key]['action']  = '<button type="button" id="btn_passien" name="btn_passien" onclick="editpasien(\''.$data['data'][$key]['id_pasien'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="update_pasien"><i class="fa fa-pencil-square"></i></button>';
            $data['data'][$key]['action'] .= ' <button type="button" id="btn_passien" name="btn_passien" onclick="hapuspasien(\''.$data['data'][$key]['id_pasien'].'\')"  value="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="hapus_pasien"><i class="fa fa-trash-o"></i></button>';
            $num++;
        }
        echo json_encode($data);

    }

    public function edit_pasien()
    {
        // $params=2;
        $params = $this->input->post('id_pasien');
        $master_pasien  =$this->getdataurl('pasien?id_pasien='.$params);

        $result          = $master_pasien;
        // print_r( $result);die;
        echo json_encode($result);

    }

    public function update_pasien()
    {
        // $params=2;
        $params         = ($_POST);
        $master_pasien = $this->senddataurl('pasien',$params,'PUT');
        $result         = $master_pasien;
        echo json_encode($result);

    }

    public function add_pasien()
    {
        // $params=2;
        $params        = ($_POST);
        // print_r ($params);die;
        $master_pasien = $this->senddataurl('pasien',$params,'POST');
        // print_r ($master_pasien);die;
        $result        = $master_pasien;
        echo json_encode($result);

    }

    public function delete_pasien()
    {
        // $params=2;
        $params         = ($_POST);
        $master_pasien  = $this->senddataurl('pasien',$params,'DELETE');
        $result         = $master_pasien;
        echo json_encode($result);

    }

/* END UNTUK PASIEN*/

/* UNTUK ANTRIAN*/

    public function antrian()
    {
       $data['conten']='Data Antrian';
       $views='conten/antrian';
       $this->view_request($data,$views);
        
    }

    public function get_antrian()
    {
        // $params=2;
        $params = $this->input->post('no_antrian');
        if($params !=null){
          $data_antrian  =$this->getdataurl('antrian?no_antrian='.$params);
        }else{
          $data_antrian  =$this->getdataurl('antrian');  
        }

        $result       = $data_antrian;

      // print_r($result);die;
        $data = array(
            'data' => array()
        );
        $num = 1;       
        foreach($result  as $key => $value) {
            foreach ($value as $key1 => $values) {
                $data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
            }
            $data['data'][$key]['num'] = $num;
            $data['data'][$key]['action']  = '<button type="button" id="btn_antrian" name="btn_antrian" onclick="play_antrian(\''.$data['data'][$key]['id_antrian'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="panggil"><i class="fa fa-bullhorn"></i></button>';
            $data['data'][$key]['action'] .= ' <button type="button" id="btn_passien" name="btn_passien" onclick="update(\''.$data['data'] [$key]['no_antrian'].'\')"  value="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="hapus_antrian"><i class="fa   fa-trash-o"></i></button>';
            $num++;
        }
        echo json_encode($data);
    }

    public function getall_antrian()
    {
        // $params=2;
        $params = $this->input->post('id_antrian');
        $type = $this->input->post('type');
        // print_r($type);die;
        if($params !=null){
          $data_antrian  =$this->getdataurl('antrian/getallantrian?id_antrian='.$params);
        }else{
          $data_antrian  =$this->getdataurl('antrian/getallantrian');  
        }

        $result       = $data_antrian;

        //  print_r($result);die;
        $data = array(
            'data' => array()
		);
		$num = 1;		
        foreach($result  as $key => $value) {
			foreach ($value as $key1 => $values) {
				$data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
			}
			$data['data'][$key]['num'] = $num;
            $data['data'][$key]['action']  = '<button type="button" id="btn_antrian" name="btn_antrian" onclick="play_antrian(\''.$data['data'][$key]['id_antrian'].'\')"  value="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="panggil"><i class="fa fa-bullhorn"></i></button>';
            $data['data'][$key]['action'] .= ' <button type="button" id="btn_passien" name="btn_passien" onclick="update(\''.$data['data'] [$key]['no_antrian'].'\')"  value="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="hapus_antrian"><i class="fa   fa-trash-o"></i></button>';
            $num++;
        }
        echo json_encode($data);


    }

    public function get_autocomplie()
    {
        $param =($_POST);
        $data_antrian  =$this->senddataurl('antrian/get_pasien',$param,'POST');  

        $result       = $data_antrian;
        echo json_encode($result);

    }

    public function edit_antrian()
    {
        // $params=2;
        $params = $this->input->post('no_antrian');
        $data_antrian =$this->getdataurl('antrian?no_antrian='.$params);

        $result       = $data_antrian;
        echo json_encode($result);

    }

    public function update_antrian()
    {
        // $params=2;
         $params        = array('no_antrian'=>$_POST['no_antrian'],
                                'id_pegawai'=>$this->session->userdata('id_pegawai_pasien'),
                                'aktif'     =>'N',
                                );

        $data_antrian   = $this->senddataurl('antrian',$params,'PUT');
        $result         = $data_antrian;
        echo json_encode($result);

    }

    public function add_antrian()
    {
        // $params=2;
        $params        = array('id_antrian'=>$_POST['id_antrian'],
                                'id_pasien'=>$_POST['id_pasien'],
                                'id_pegawai'=>$this->session->userdata('id_pegawai_pasien'),
                              );
        // print_r($params);die;
        $data_antrian  = $this->senddataurl('antrian',$params,'POST');
        // print_r( $data_antrian);die;
        $result        = $data_antrian;
        echo json_encode($result);

    }

    public function delete_antrian()
    {
        // $params=2;
        $params         = ($_POST);
        $data_antrian   = $this->senddataurl('antrian',$params,'DELETE');
        $result         = $data_antrian;
        echo json_encode($result);

    }

    public function laporan_antrian(){
       $data['conten']='Laporan Antrian';
       $views='conten/laporan';
       $this->view_request($data,$views);
    }

    public function reporting_view()
    {
      $tanggal_awal = $this->input->post('tanggal_awal');
      $tanggal_akhir= $this->input->post('tanggal_akhir');

      $result = $this->list_menu->reporting($tanggal_awal,$tanggal_akhir);

      $data = array(
        'data' => array()
    );
    $num = 1;		
    foreach($result  as $key => $value) {
        foreach ($value as $key1 => $values) {
            $data['data'][$key][$key1] = htmlspecialchars($values,ENT_QUOTES);
        }
        $data['data'][$key]['num'] = $num;
        $num++;
    }
    echo json_encode($data);
    
    }

    public function reporting_print()
    {
      $tanggal_awal = $this->input->post('tanggal_awal');
      $tanggal_akhir= $this->input->post('tanggal_akhir');
      $this->load->library('Libexcel');
      $objPHPExcel = new PHPExcel();
      $result = $this->list_menu->reporting($tanggal_awal,$tanggal_akhir);

      $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Laporan Antrian')
      ->setCellValue('A2', 'Dari Tanggal')
      ->setCellValue('A3', 'Sampai Tanggal')
      ->setCellValue('C2', $tanggal_awal)
      ->setCellValue('C3', $tanggal_akhir)
      ->setCellValue('A5', 'No')
      ->setCellValue('B5', 'Tanggal')
      ->setCellValue('C5', 'No Antrian')
      ->setCellValue('D5', 'Id Pasien')
      ->setCellValue('E5', 'Nama Pasien')
      ->setCellValue('F5', 'Id Pegawai')
      ->setCellValue('G5', 'Nama Pegawai')
      ->setCellValue('H5', 'Keterangan')
      ->mergeCells('A1:B1')
      ->mergeCells('A2:B2')
      ->mergeCells('A3:B3');

      $row = 6;
      $num = 1;
      foreach ($result as $data_header ) {
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(21);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

        $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $num);
        $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data_header->tanggal);
        $objPHPExcel->getActiveSheet()->setCellValue('C'. $row, $data_header->id_antrian);
        $objPHPExcel->getActiveSheet()->setCellValue('E'. $row, $data_header->id_pasien);
        $objPHPExcel->getActiveSheet()->setCellValue('D'. $row, $data_header->nama_pasien);
        $objPHPExcel->getActiveSheet()->setCellValue('F'. $row, $data_header->id_pegawai);
        $objPHPExcel->getActiveSheet()->setCellValue('G'. $row, $data_header->nama_pegawai);
        $objPHPExcel->getActiveSheet()->setCellValue('H'. $row, $data_header->keterangan);

        $row++;
        $num++;

      }
       $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getFill()
  							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
  							->getStartColor()->setARGB('EBE9E9');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.":H".$row)->getFill()
  							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
  							->getStartColor()->setARGB('EBE9E9');

        $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                              ->getStartColor()->setARGB('EBE9E9');

       $styleArray = array(
                    'borders' => array(
                    'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '0F0F0F'),
                    ),
                ),
             );

      $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('A1:C3')->getFont()->setBold(true);
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

      //Header
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

      //Nama File
      header('Content-Disposition: attachment;filename="Laporan Antrian.xlsx"');

      //Download
      $objWriter->save("php://output");

    }

/* END UNTUK ANTRIAN*/

/*CURL UNTUK MENGIRIM DAN MENERIMA DATA KE DAN DARI REST SERVER API*/
    protected function senddataurl($url,$data,$type){
        $time = time();
        $uri = "http://localhost/aplikasiantrian/api_antrian/index.php/".$url;
        //  die($uri);
        $apiKey = '123456';
        $params = array(
            'Content-Type: application/x-www-form-urlencoded',
            'x-api-key:'.$apiKey
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data,'','&'));
        $ex = curl_exec($ch);
        $result  = json_decode($ex);
        return $result;
    }

    protected function getdataurl($url){
        $uri = 'http://localhost/aplikasiantrian/api_antrian/index.php/'.$url;
        // print_r($uri);die;
        $apiKey = '123456';
        $params = array(
            'Content-Type: application/json',
            'x-api-key:'.$apiKey
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
        $data  = json_decode(curl_exec($ch));
        return $data;
    }
/*CURL UNTUK MENGIRIM DAN MENERIMA DATA KE DAN DARI REST SERVER API*/

/*UNTUK MENGAMBIL DATA KUNJUNGAN*/
 public function kunjungan()
    {
        $no=0;
        $rest=array();
        $result= $this->list_menu->kunjungan();
        foreach ($result as $key=>$valy)
        {
            $rest[$no++]=array("y"=>$valy->tanggal, "kunjungan"=>$valy->jumlah,);
        }

        echo json_encode($rest);
    }
/*END UNTUK MENGAMBIL DATA KUNJUNGAN*/

/*UNTUK LOGOUT*/
public function logout()
{
    $this->session->unset_userdata(array(
       'username',          
        'id_pegawai_pasien',
        'group',            
    ));
    $this->view_request_login();
}
/*END UNTUK LOGOUT*/

public function get_P_antrian()
    {
        $param=($_POST);
        $result= $this->list_menu->get_P_antrian($param);
        $room=$result[0]->room;
        $data = array('room'=>$room);
        echo json_encode($data);
    }
    

}
