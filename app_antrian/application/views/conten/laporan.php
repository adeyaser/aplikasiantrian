<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Laporan</li>
				<li class="active"><span>Laporan Antrian</span></li>
			</ol>
			<h1>Laporan Antrian</h1>
		</div>
		<div class="col-12">
			<div class="card bg-white text-dark">
				<div class="card-body">
					<div class="row">
                        <div class="col-12 text-left tp-m-tp-5">
                            <form class="form-horizontal" id="formsearch">
							    <div class="form-group">
                                   <div class="col-12">
                                      <div class="box-body">
                                          <label for="" class="col-sm-2 control-label">Tanggal Awal</label>
                                            <div class="row">
                                               <div class="col-xs-4">
                                                  <div class="input-group">
                                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form_datetime" placeholder="m-d-YYYY" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
	                             </div>

                                 <div class="col-12">
                                      <div class="box-body">
                                          <label for="" class="col-sm-2 control-label">Tanggal Akhir</label>
                                            <div class="row">
                                               <div class="col-xs-4">
                                                  <div class="input-group">
                                                    <input onchange="load_grid_data()" type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form_datetime" placeholder="m-d-YYYY" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
	                             </div>
                             </div>
                          </form> 
					    </div>
						<div class="col-12 text-right tp-m-tp-5">
                            <button class="btn btn-warning" onclick="Reset()"> Reset </button>
							<button class="btn btn-primary" onclick="print_confirmation()"><span class="glyphicon glyphicon-print"></span> Print </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<hr style="margin: 4px;">
		</div>
		<div class="col-12">
			<div class="card bg-white text-dark">
				<div class="card-body">
					<div class="row">
						<div class="col-12 tp-m-tp-5 table-responsive">
							<table id="mastertable" class="table table-hover">
								<thead>
									<tr>
										<th>NO</th><th>TANGGAL</th><th>NO ANTRIAN</th><th>ID PASIEN</th><th>NAMA PASIEN </th>
                                        <th>ID PEGAWAI</th><th>NAMA PEGAWAI</th><th>KETERANGAN</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmation_modal" tabindex="-1" print="dialog">
	<div class="modal-dialog" print="document">
		<div class="modal-content">
			<div style="background-color:#067d99;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white">Konfirmasi Print Data </h4>
			</div>
			<div class="modal-body">
			<form method="POST" action="<?=base_url(); ?>index.php/home/reporting_print?>">
				<div>
			   		<h3>Apakah anda yakin ingin mencaetak data antrian</h3>
				     Dari : <input name='tanggal_awal' id='tanggal_awal_' readonly> 
					 Hingga tanggal : <input name='tanggal_akhir' id='tanggal_akhir_' readonly>
				</div>
				<div>
				<hr>
				<button class="btn btn-warning" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			    <button Type="submit" onclick="colsed()" class="btn btn-primary"><span class="glyphicon glyphicon-print"> Print</button>
				</div>
			</form>
			</div>
			<div class="modal-footer" id="confirmation_modal_footer"></div>
		</div>
	</div>
</div>

<script>
	$( document ).ready(function() {
		load_grid_data();
		$("body").append('<div id="overlay" style="background-color:rgba(0,0,0,0.8);position:fixed;top:0;left:0;height:100%;width:100%;z-index:999"></div>');
		$('#overlay').fadeOut(500);
	});

	const reload = () =>{ location.reload(); }

    const Reset = () => {
        $("#tanggal_awal").val(new Date());
        $("#tanggal_akhir").val(new Date());

        load_grid_data();
    }

	const print_confirmation = () =>{
		document.querySelector('#tanggal_awal_').value =  $("#tanggal_awal").val();
		document.querySelector('#tanggal_akhir_').value =  $("#tanggal_akhir").val();
		$('#confirmation_modal').modal('show');
	}

	const colsed = () =>{
		$('#confirmation_modal').modal('toggle');
	}

	const load_grid_data = () => {
		$('#overlay').fadeOut(500);
		$('#mastertable').DataTable( {
			"destroy": true,
            "responsive": true,
			"searching": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/reporting_view",
				data : function ( d ) {
                        d.tanggal_awal =$("#tanggal_awal").val();
                        d.tanggal_akhir=$("#tanggal_akhir").val();
				},
				"type": "POST"
			},
			"columns": [
		        { "data": "num" },
		        { "data": "tanggal" },
		        { "data": "id_antrian" },
                { "data": "id_pasien" },
		        { "data": "nama_pasien" },
                { "data": "id_pegawai" },
                { "data": "nama_pegawai" },
                { "data": "keterangan" },
		    ],} );
	}

	const print = () =>{
		var xhr = new XMLHttpRequest();
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/reporting_print?>",
			type: "POST",
			data: {
				tanggal_awal :$("#tanggal_awal").val(),
				tanggal_akhir:$("#tanggal_akhir").val(),
			},
			xhr: function() { return xhr; },
			success: function () {
    console.log(xhr);
}
		});
		load_grid_data(); 

	console.log(xhr.responseURL);
		
		return false;
	}


</script>