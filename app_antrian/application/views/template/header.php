
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Manangen</title>
  <style type="text/css">
    .alert {
      padding: 6px !important;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }
    .alert{
      border-radius: 0px !important;
    }
    
	.sc-modal {
		overflow-y: scroll;
		position: relative;
		padding: 20px;
		height: 400px;
	}
	.card-body{
		padding: 2rem 3rem 2rem 3rem;
		background-color: #fff;
	}
	.tp-m-tp-5{
		margin-top: 5px;
	}
	.tp-m-tp-10{
		margin-top: 10px;
	}
	.tp-n-bd{
		border: 0px !important;
	}
	#overlay {
	    background-color: rgba(0, 0, 0, 0.8);
	    z-index: 999;
	    position: fixed;
	    left: 0;
	    top: 0;
	    width: 100vw;
	    height: 100vh;
	}​
</style>

<style type="text/css">
.table{
	overflow: auto;
}
</style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>bootstrap/css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>fontawesome-5.12.0/css/fontawesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>datatables/dataTables.bootstrap.css">
  <!-- chart -->
  <script src="<?= base_url('assets/'); ?>chartnew.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/morris.js/morris.css">
  <script src="<?= base_url('assets/'); ?>jQuery/jquery-2.1.4.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?= base_url('assets/'); ?>bower_components/raphael/raphael.min.js"></script>
  <script src="<?= base_url('assets/'); ?>bower_components/morris.js/morris.min.js"></script>
   <!-- sweetalert -->
  <script src="<?= base_url('assets/'); ?>alert.js">"></script>
   <!-- fungsi sweetalert -->
 <script> const swal_fn=(icon,title,text)=>{ Swal.fire({ icon: icon, title: title, text: text }); }</script>

  