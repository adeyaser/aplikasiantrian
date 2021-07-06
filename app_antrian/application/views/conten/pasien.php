<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Master Data</li>
				<li class="active"><span>Master Pasien</span></li>
			</ol>
			<h1>MASTER PASIEN</h1>
		</div>
		<div class="col-12">
			<div class="card bg-white text-dark">
				<div class="card-body">
					<div class="row">
						<div class="col-12 text-right tp-m-tp-5">
							<button class="btn btn-primary" onclick="pasien_modal_add()">(<i class="fa fa-plus"></i>) Tambah </button>
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
										<th>NO</th><th>ID_PASIEN</th><th>NAMA PASIEN</th><th>JENIS KELAMIN</th><th>USIA</th><th>ALAMAT</th><th>NO TELEPON</th><th>EMAIL</th><th>AKSI</th>
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

<div id="pasien_modal" class="modal fade" JENIS_KELAMIN="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#067d99;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" id="pasien_modal_title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<table class="table">
								<tbody id="acl_pasien_container">																
									<tr>
										<td class="tp-n-bd" width="1%"><label for="ID_PASIEN" class="control-label">ID PASIEN(*)</label></td>
										<td class="tp-n-bd">
											<input name="ID_PASIEN" type ="text" id="ID_PASIEN" class="form-control" placeholder="Id pasien"/>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="NAMA_PASIEN" class="control-label">NAMA PASIEN(*)</label></td>
										<td class="tp-n-bd">
											<input name="NAMA_PASIEN" type ="text" id="NAMA_PASIEN" class="form-control" placeholder="Nama pasien"/>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="JENIS_KELAMIN" class="control-label">JENIS KELAMIN</label></td>
										<td class="tp-n-bd">
											<select class="form-control select2" name="JENIS_KELAMIN" id="JENIS_KELAMIN" style="width: 100%;">
												<option value="L">LAKI-LAKI </option>
												<option value="P">PEREMPUAN </option>
											</select>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="USIA" class="control-label">USIA(*)</label></td>
										<td class="tp-n-bd">
											<input name="USIA" type ="number" id="USIA" class="form-control" placeholder="Usia"/>
										</td>
									</tr>	
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="ALAMAT" class="control-label">ALAMAT(*)</label></td>
										<td class="tp-n-bd">
											<input name="ALAMAT" type ="text" id="ALAMAT" class="form-control" placeholder="Alamat"/>
										</td>
									</tr>	
									<tr>
										<td class="tp-n-bd" width="1%"><label for="NO_TELEPON" class="control-label">NO TELEPON(*)</label></td>
										<td class="tp-n-bd">
											<input name="NO_TELEPON" type ="text" id="NO_TELEPON" class="form-control" placeholder="No Telepon"/>
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
				<button class="btn btn-primary" id="pasien_modal_submit">Simpan</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="confirmation_modal" tabindex="-1" JENIS_KELAMIN="dialog">
	<div class="modal-dialog" JENIS_KELAMIN="document">
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

	const pasien_modal_validator = () =>{
		if ($("#ID_PASIEN").val() == "") { swal_fn('error','Gagal','Silahkan isi id Pasien'); return false; }
		if ($("#NAMA_PASIEN").val() == "") { swal_fn('error','Gagal','Silahkan isi Nama pasien'); return false; }
        if ($("#JENIS_KELAMIN").val() == "") { swal_fn('error','Gagal','Silahkan isi Jenis Kelamin'); return false; }
        if ($("#USIA").val() == "") { swal_fn('error','Gagal','Silahkan isi Usia'); return false; }
        if ($("#ALAMAT").val() == "") { swal_fn('error','Gagal','Silahkan isi Alamat'); return false; }
        if ($("#NO_TELEPON").val() == "") { swal_fn('error','Gagal','Silahkan isi No Telepon'); return false; }
        if ($("#EMAIL").val() == "") { swal_fn('error','Gagal','Silahkan isi Email'); return false; }
		return true;
	}

	const add_confirmation = () =>{
		if (pasien_modal_validator()==false){ return; }

		$('#pasien_modal').modal('hide');
		$("#pasienSave").modal();
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Penyimpanan Master Pasien');
		$('#confirmation-modal-message').html('Apakah anda yakin ingin menambah pasien ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="pasienSave()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#pasien_modal').modal('show'); });
	}

	const update_confirmation = (id_acl) =>{
        /* let id=id_acl;
        console.log(id); */
		if (pasien_modal_validator()==false){ return; }

		$('#pasien_modal').modal('hide');
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Ubah Data Pasien');
		$('#confirmation-modal-message').html('Apakah Anda yakin akan mengubah informasi pada pasien ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="Updatepasien()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#pasien_modal').modal('show'); });
	}

	const load_grid_data = () => {
		$('#overlay').fadeOut(500);
		$('#mastertable').DataTable( {
			"destroy": true,
            "responsive": true,
			"searching": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/get_pasien",
				data : function ( d ) {
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "id_pasien" },
			{ "data": "nama_pasien" },
            { "data": "jenis_kelamin" },
			{ "data": "usia" },
            { "data": "alamat" },
            { "data": "no_telepon" },
            { "data": "email" },
			{ "data": "action" },
			],} );
	}

	const pasien_modal_add = () => {
		$('#pasien_modal_title').html('Tambah Pasien');
		pasien_dom_creator('add');
		$('#pasien_modal').modal('show');
		$('#pasien_modal_submit').click(function(){ add_confirmation(); });
	}


	const editpasien = (id) => {
         console.log(id); 
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/edit_pasien?>",
			type: "POST",
			data: {id_pasien:id },
			success: function(data){ pasien_modal_edit(JSON.parse(data)[0]); $('#overlay').fadeOut(500); }
		});

	}

	const pasien_modal_edit = (json) => {
        console.log(json);
		swal.close();
		$('#pasien_modal_title').html('Ubah Data pasien');
		pasien_dom_creator('edit',json.nama_pasien,json.jenis_kelamin,json.usia,json.alamat,json.no_telepon,json.email,json.id_pasien);
		$('#pasien_modal').modal('show');
		$('#pasien_modal_submit').click(function(){ update_confirmation(json.id_acl); });
	}

	const pasien_dom_creator = (STATE,NAMA_PASIEN='',JENIS_KELAMIN='',USIA='',ALAMAT='',NO_TELEPON='',EMAIL='',ID_PASIEN='') => {
        /* console.log(ID_PASIEN);
         console.log(NO_TELEPON); */
		if (ID_PASIEN==null) { ID_PASIEN=''; }
		if (NAMA_PASIEN==null) { NAMA_PASIEN=''; }
		if (STATE=='add') {
			document.querySelector('#NAMA_PASIEN').value = '';
            document.querySelector('#JENIS_KELAMIN').value = '';
            document.querySelector('#USIA').value = '';
            document.querySelector('#ALAMAT').value = '';
            document.querySelector('#NO_TELEPON').value = '';
            document.querySelector('#EMAIL').value = '';
		}else{
			document.querySelector('#NAMA_PASIEN').value = NAMA_PASIEN;
            document.querySelector('#USIA').value =USIA;
            document.querySelector('#ALAMAT').value = ALAMAT;
            document.querySelector('#NO_TELEPON').value = NO_TELEPON;
            document.querySelector('#EMAIL').value = EMAIL;
             if(JENIS_KELAMIN=='L'){
                 document.querySelector('#JENIS_KELAMIN').selectedIndex = "0";
             }else if(JENIS_KELAMIN=='P'){
                 document.querySelector('#JENIS_KELAMIN').selectedIndex = "1";
             }          		
		}
        document.querySelector('#ID_PASIEN').value = ID_PASIEN;
	}

	const pasienSave = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/add_pasien?>",
			type: "POST",
			data: {
				id_pasien :$("#ID_PASIEN").val(),
				nama_pasien:$("#NAMA_PASIEN").val(),
                jenis_kelamin:$("#JENIS_KELAMIN").val(),
                usia:$("#USIA").val(),
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
	const Updatepasien = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/update_pasien?>",
			type: "POST",
			data: {
				id_pasien :$("#ID_PASIEN").val(),
				nama_pasien:$("#NAMA_PASIEN").val(),
                jenis_kelamin:$("#JENIS_KELAMIN").val(),
                usia:$("#USIA").val(),
                alamat:$("#ALAMAT").val(),
				no_telepon:$("#NO_TELEPON").val(),
				email:$("#EMAIL").val()
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

    const hapuspasien = (id) =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/delete_pasien?>",
			type: "POST",
			data: {
				id_pasien :id
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