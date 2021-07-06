 <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php if($group==1 && $this->session->userdata('loket')=='ADMIN'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i> <span><?php echo $masterdata[0]->idetitas;?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

            <?php foreach ($masterdata as $master) { ?>
            <li>
              <a href=" <?= base_url(); ?>index.php/<?=$master->link?>"><i class="fa fa-circle-o text-warning"></i> <span><?php echo $master->nama_listmenu ?></span>
            <?php }?>

            </a>
          </li>
          </ul>
        </li>
         <?php } ?>
         <?php if($group==1 && $this->session->userdata('loket')=='ADMIN'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span><?php echo $antrian[0]->idetitas;?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php foreach ($antrian as $antri) { ?>
            <li>

              <a href=" <?= base_url(); ?>index.php/<?=$antri->link?>"><i class="fa fa-circle-o text-warning"></i> <span><?php echo $antri->nama_listmenu ?></span>
            <?php }?>

            </a>
          </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-card"></i> <span><?php echo $laporan[0]->idetitas;?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

            <?php foreach ($laporan as $lapor) { ?>
            <li>
              <a href=" <?= base_url(); ?>index.php/<?=$lapor->link?>"><i class="fa fa-circle-o text-warning"></i> <span><?php echo $lapor->nama_listmenu ?></span>
            <?php }?>

           </a>
           </li>
          </ul>
        </li>
         <?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tag"></i> <span><?php echo $pengaturan[0]->idetitas;?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

           <?php foreach ($pengaturan as $set) { ?>
            <li>
              <a href=" <?= base_url(); ?>index.php/<?=$set->link?>"><i class="fa fa-circle-o text-warning"></i> <span><?php echo $set->nama_listmenu ?></span>
            <?php }?>

           </a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  