<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Master Data</li>
				<li class="active"><span>Master Pegawai</span></li>
			</ol>
			<h1>MASTER PEGAWAI</h1>
		</div>
		<div class="col-12">
			<div class="card bg-white text-dark">
				<div class="card-body">
					<div class="row">
						<div class="col-12 text-right tp-m-tp-5">
							<button class="btn btn-primary" onclick="pegawai_modal_add()">(<i class="fa fa-plus"></i>) Tambah </button>
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
										<th>NO</th><th>ID_PEGAWAI</th><th>NAMA PEGAWAI</th><th>ALAMAT</th><th>NO TELEPON</th><th>EMAIL</th><th>AKSI</th>
									</tr>
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

<div id="pegawai_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#067d99;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" id="pegawai_modal_title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<table class="table">
								<tbody id="acl_Pegawai_container">																
									<tr>
										<td class="tp-n-bd" width="1%"><label for="ID_PEGAWAI" class="control-label">ID PEGAWAI(*)</label></td>
										<td class="tp-n-bd">
											<input name="ID_PEGAWAI_1" type ="text" id="ID_PEGAWAI_1" class="form-control" placeholder="Id Pegawai"/>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="NAMA_PEGAWAI" class="control-label">NAMA PEGAWAI(*)</label></td>
										<td class="tp-n-bd">
											<input name="NAMA_PEGAWAI" type ="text" id="NAMA_PEGAWAI" class="form-control" placeholder="Nama Pegawai"/>
										</td>
									</tr>
									<tr>
										<td class="tp-n-bd" width="1%"><label for="NO_TELEPON" class="control-label">NO_TELEPON(*)</label></td>
										<td class="tp-n-bd">
											<input name="NO_TELEPON" type ="text" id="NO_TELEPON" class="form-control" placeholder="No Telepon"/>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="ALAMAT" class="control-label">ALAMAT(*)</label></td>
										<td class="tp-n-bd">
											<input name="ALAMAT" type ="text" id="ALAMAT" class="form-control" placeholder="Alamat"/>
										</td>
									</tr>
										<td class="tp-n-bd" width="1%"><label for="EMAIL" class="control-label">EMAIL(*)</label></td>
										<td class="tp-n-bd">
											<input name="EMAIL" type ="email" id="EMAIL" class="form-control" placeholder="Email"/>
										</td>
									</tr>							
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" style="background-color: #e0dcdc;" data-dismiss="modal">Tutup</button>
				<button class="btn btn-primary" id="pegawai_modal_submit">Simpan</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="confirmation_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div style="background-color:#067d99;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" id="confirmation-modal-title"></h4>
			</div>
			<div class="modal-body">
				<div><h3 id="confirmation-modal-message"></h3></div>
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

	const pegawai_modal_validator = () =>{
		if ($("#ID_PEGAWAI_1").val() == "") { swal_fn('error','Gagal','Silahkan isi id pegawai'); return false; }
		if ($("#NAMA_PEGAWAI").val() == "") { swal_fn('error','Gagal','Silahkan isi Nama Pegawai'); return false; }
		if ($("#NO_TELEPON").val() == "") { swal_fn('error','Gagal','Silahkan isi No Telepon'); return false; }
        if ($("#EMAIL").val() == "") { swal_fn('error','Gagal','Silahkan isi Email'); return false; }
		return true;
	}

	const add_confirmation = () =>{
		if (pegawai_modal_validator()==false){ return; }

		$('#pegawai_modal').modal('hide');
		$("#PegawaiSave").modal();
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Penyimpanan Master Pegawai');
		$('#confirmation-modal-message').html('Apakah anda yakin ingin menambah Pegawai ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="PegawaiSave()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#pegawai_modal').modal('show'); });
	}

	const update_confirmation = (id_acl) =>{
        /* let id=id_acl;
        console.log(id); */
		if (pegawai_modal_validator()==false){ return; }

		$('#pegawai_modal').modal('hide');
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Ubah Data Pegawai');
		$('#confirmation-modal-message').html('Apakah Anda yakin akan mengubah informasi pada Pegawai ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="UpdatePegawai()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#Pegawai_modal').modal('show'); });
	}

	const load_grid_data = () => {
		$('#overlay').fadeOut(500);
		$('#mastertable').DataTable( {
			"destroy": true,
            "responsive": true,
			"searching": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/get_pegawai",
				data : function ( d ) {
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "id_pegawai" },
			{ "data": "nama_pegawai" },
            { "data": "alamat" },
			{ "data": "no_telepon" },
            { "data": "email" },
			{ "data": "action" },
			],} );
	}

	const pegawai_modal_add = () => {
		$('#pegawai_modal_title').html('Tambah Pegawai');
		pegawai_dom_creator('add');
		$('#pegawai_modal').modal('show');
		$('#pegawai_modal_submit').click(function(){ add_confirmation(); });
	}


	const editpegawai = (id) => {
        /* console.log(id); */
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/edit_pegawai?>",
			type: "POST",
			data: {id_pegawai:id },
			success: function(data){ pegawai_modal_edit(JSON.parse(data)[0]); $('#overlay').fadeOut(500); }
		});

	}

	const pegawai_modal_edit = (json) => {
        console.log(json);
		swal.close();
		$('#pegawai_modal_title').html('Ubah Data Pegawai');
		pegawai_dom_creator('edit',json.nama_pegawai,json.alamat,json.no_telepon,json.email,json.id_pegawai);
		$('#pegawai_modal').modal('show');
		$('#pegawai_modal_submit').click(function(){ update_confirmation(json.id_acl); });
	}

	const pegawai_dom_creator = (STATE,NAMA_PEGAWAI='',ALAMAT='',NO_TELEPON='',EMAIL='',ID_PEGAWAI='') => {
        /* console.log(ID_PEGAWAI);
         console.log(NO_TELEPON); */
		if (ID_PEGAWAI==null) { ID_PEGAWAI=''; }
		if (NAMA_PEGAWAI==null) { NAMA_PEGAWAI=''; }
		if (STATE=='add') {
			document.querySelector('#NAMA_PEGAWAI').value = '';
			document.querySelector('#ALAMAT').value = '';
            document.querySelector('#NO_TELEPON').value = '';
            document.querySelector('#EMAIL').value = '';
		}else{
			document.querySelector('#NAMA_PEGAWAI').value = NAMA_PEGAWAI;
            document.querySelector('#ALAMAT').value = ALAMAT;
            document.querySelector('#NO_TELEPON').value = NO_TELEPON;
            document.querySelector('#EMAIL').value = EMAIL;
          		
		}
        document.querySelector('#ID_PEGAWAI_1').value = ID_PEGAWAI;
	}

	const PegawaiSave = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/add_pegawai?>",
			type: "POST",
			data: {
				id_pegawai :$("#ID_PEGAWAI_1").val(),
				nama_pegawai:$("#NAMA_PEGAWAI").val(),
                alamat:$("#ALAMAT").val(),
				no_telepon:$("#NO_TELEPON").val(),
				email:$("#EMAIL").val()
			},
			success: function(data){ 
                /* console.log(JSON.parse(data)); */
                 let json = JSON.parse(data);
				if(json.status == "success"){
					swal_fn('success','Sukses','simpan data berhasil!');
				}else{
					
                    swal_fn('error','Error','Data Gagal Disimpan'); 
				}
				load_grid_data(); 
             }
		});
	}
	const UpdatePegawai = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/update_pegawai?>",
			type: "POST",
			data: {
				id_pegawai :$("#ID_PEGAWAI_1").val(),
				nama_pegawai:$("#NAMA_PEGAWAI").val(),
                alamat:$("#ALAMAT").val(),
				no_telepon:$("#NO_TELEPON").val(),
				email:$("#EMAIL").val(),
			},
			success: function( data ) {
                let json = JSON.parse(data);
				/* console.log(json); */
				if(json.status == "success"){
                    swal_fn('success','Sukses','simpan data berhasil!'); 
				}else{
                    swal_fn('error','Error','Data Gagal Disimpan'); 
				}
				load_grid_data(); 
            }
		});
		
		return false;
	}

    const hapus_pegawai = (id) =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/delete_pegawai?>",
			type: "POST",
			data: {
				id_pegawai :id
			},
			success: function( data ) {
                let json = JSON.parse(data);
				/* console.log(json); */
				if(json.status == "success"){
                    swal_fn('success','Sukses','Hapus data berhasil!'); 
				}else{
                    swal_fn('error','Error','Hapus Data Gagal'); 
				}
				load_grid_data(); 
            }
		});
		
		return false;
	}

</script>