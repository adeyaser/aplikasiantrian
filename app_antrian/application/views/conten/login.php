<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Sistem Antrian</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat Datang Di Sistem Antrian</p>
    <form action="<?= base_url()?>index.php/home/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" name='username' class="form-control" placeholder="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name='password' class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <select name='loket' class="form-control">
          <option value='ADMIN'>ADMIN</option>
          <option value='A'>LOKET A</option>
          <option value='B'>LOKET B</option>
          <option value='C'>LOKET C</option>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
 </div>
</body>
<script>
if('<?php echo $this->session->flashdata('notif');?>' !=''){
swal_fn('error','Error', '<?php echo $this->session->flashdata('notif');?>');
}
</script>