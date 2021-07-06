</div><!-- ./wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1
    </div>
    <strong><?=$fotter?> </a>.</strong> All rights
    reserved.
  </footer>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('assets/'); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets/'); ?>slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/'); ?>fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/'); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/dataTables.bootstrap.min.js"></script>
<!-- chart -->

<!-- Sparkline -->
<script src="<?= base_url('assets/'); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url('assets/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/'); ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/'); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url('assets/'); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
$(document).ready(function() {
	$('a.more').click(function() {
	
		// Toggle Class
		$tr = $(this).parent().parent();
		$tr.toggleClass('expanded');
		
		// Tampilkan - sembunyikan baris
		$i = $(this).children('i');
		$i.removeClass('fa-chevron-down', 'fa-chevron-up');
		var arrow = $tr.hasClass('expanded') ? 'fa-chevron-up' : 'fa-chevron-down';
		$i.addClass(arrow);
		
		return false;
	});
})
</script>
<!-- UNTUK GRAFIK  -->
</body>
</html>

<audio id="suarabel" src="<?= base_url('assets/'); ?>rekaman/Airport_Bell.mp3" ></audio>
<audio id="suarabelnomorurut" src="<?= base_url('assets/'); ?>rekaman/nomor-urut.wav"  ></audio>
<audio id="suarabelsuarabelloket" src="<?= base_url('assets/'); ?>rekaman/loket.wav"  ></audio>
<audio id="suaraA" src="<?= base_url('assets/'); ?>rekaman/A.mp3"  ></audio>
<audio id="suaraB" src="<?= base_url('assets/'); ?>rekaman/B.mp3"  ></audio>
<audio id="suaraC" src="<?= base_url('assets/'); ?>rekaman/C.mp3"  ></audio>
<audio id="belas" src="<?= base_url('assets/'); ?>rekaman/belas.wav"  ></audio>
<audio id="sebelas" src="<?= base_url('assets/'); ?>rekaman/sebelas.wav"  ></audio>
<audio id="puluh" src="<?= base_url('assets/'); ?>rekaman/puluh.wav"  ></audio>
<audio id="sepuluh" src="<?= base_url('assets/'); ?>rekaman/sepuluh.wav"  ></audio>
<audio id="ratus" src="<?= base_url('assets/'); ?>rekaman/ratus.wav"  ></audio>
<audio id="seratus" src="<?= base_url('assets/'); ?>rekaman/seratus.wav"  ></audio>