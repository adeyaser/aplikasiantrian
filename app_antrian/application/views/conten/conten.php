<section class="content">
	<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Selamat Datang <?=$username?></h3>
           </div><!-- /.box-header -->
           <div class="row">
            <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Kunjungan Pasien</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
             </div>
              <div class="box-body chart-responsive">
              <div class="chart" id="data_kunjungan" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
           </div>
          </div> 
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section>

<!-- UNTUK GRAFIK  -->
<script>
$(function () {
const chart_zone = (data_kunjungan) => {
	 console.log(data_kunjungan);
    // LINE CHART
    var line = new Morris.Line({
      element: 'data_kunjungan',
      resize: true,
      data:data_kunjungan,
      xkey: 'y',
      ykeys: ['kunjungan'],
      labels: ['kunjungan'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto',
    });
  }

  const get_data = () => {
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/kunjungan",
			type: "POST",
			success: function(data){
				chart_zone(JSON.parse(data));
			}
		});
	}
	var interval = (1000 * 60) * 10 * 1;
	setInterval(function(){get_data();}, interval);
	get_data();
});
</script>
