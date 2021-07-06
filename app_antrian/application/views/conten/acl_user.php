<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Master Data</li>
				<li class="active"><span>Master User</span></li>
			</ol>
			<h1>MASTER USER</h1>
		</div>
		<div class="col-12">
			<div class="card bg-white text-dark">
				<div class="card-body">
					<div class="row">
						<div class="col-12 text-right tp-m-tp-5">
							<button class="btn btn-primary" onclick="acl_modal_add()">(<i class="fa fa-plus"></i>) Tambah </button>
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
										<th>NO</th><th>ID_ACL</th><th>ID PEGAWAI/USER</th><th>USERNAME</th><th>PASSWORD</th><th>ROLE</th><th>AKSI</th>
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

<div id="acl_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div style="background-color:#067d99;" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="color:white" id="acl_modal_title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<table class="table">
								<tbody id="acl_user_container">								
                                <input type="hidden" name="aclx" id="aclx" class="form-control"/>									
									<tr>
										<td class="tp-n-bd" width="1%"><label for="ID_PEGAWAI_PASIEN" class="control-label">ID PEGAWAI / PASIEN(*)</label></td>
										<td class="tp-n-bd">
											<input name="ID_PEGAWAI_PASIEN" type ="text" id="ID_PEGAWAI_PASIEN" class="form-control" placeholder="Id Pegawai / user"/>
										</td>
									</tr>
                                    <tr>
										<td class="tp-n-bd" width="1%"><label for="USERNAME" class="control-label">USERNAME(*)</label></td>
										<td class="tp-n-bd">
											<input name="USERNAME" type ="text" id="USERNAME" class="form-control" placeholder="Username"/>
										</td>
									</tr>
									<tr>
										<td class="tp-n-bd" width="1%"><label for="PASSWORD" class="control-label">PASSWORD(*)</label></td>
										<td class="tp-n-bd">
											<input name="PASSWORD" type ="text" id="PASSWORD" class="form-control" placeholder="Password"/>
										</td>
									</tr>
									<tr>
										<td class="tp-n-bd" width="1%"><label for="ROLE" class="control-label">ROLE</label></td>
										<td class="tp-n-bd">
											<select class="form-control select2" name="ROLE" id="ROLE" style="width: 100%;">
												<option value="admin">ADMIN </option>
												<option value="pegawai">PEGAWAI </option>
                                                <option value="pasien">PASIEN </option>
											</select>
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
				<button class="btn btn-primary" id="acl_modal_submit">Simpan</button>
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

	const acl_modal_validator = () =>{
		if ($("#ID_PEGAWAI_PASIEN").val() == "") { swal_fn('error','Gagal','Silahkan isi id pegawai'); return false; }
		if ($("#USERNAME").val() == "") { swal_fn('error','Gagal','Silahkan isi username'); return false; }
		if ($("#IPASSWORD").val() == "") { swal_fn('error','Gagal','Silahkan isi password'); return false; }
		return true;
	}

	const add_confirmation = () =>{
		if (acl_modal_validator()==false){ return; }

		$('#Acl_modal').modal('hide');
		$("#AclSave").modal();
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Penyimpanan Master User');
		$('#confirmation-modal-message').html('Apakah anda yakin ingin menambah User ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="saveacl()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#acl_modal').modal('show'); });
	}

	const update_confirmation = (id_acl) =>{
        /* let id=id_acl;
        console.log(id); */
		if (acl_modal_validator()==false){ return; }

		$('#acl_modal').modal('hide');
		$('#confirmation_modal').modal('show');
		$('#confirmation-modal-title').html('Konfirmasi Ubah Data User');
		$('#confirmation-modal-message').html('Apakah Anda yakin akan mengubah informasi pada User ini?');
		let dom = `
			<button class="btn" id="confirmation-back-once" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" onclick="updateacl()" data-dismiss="modal">Simpan</button>
		`;
		$('#confirmation_modal_footer').html(dom);
		$('#confirmation-back-once').click(function(){ $('#user_modal').modal('show'); });
	}

	const load_grid_data = () => {
		$('#overlay').fadeOut(500);
		$('#mastertable').DataTable( {
			"destroy": true,
            "responsive": true,
			"searching": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/get_user",
				data : function ( d ) {
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "id_acl" },
			{ "data": "id_pegawai_pasien" },
			{ "data": "username" },
			{ "data": "password" },
            { "data": "role" },
			{ "data": "action" },
			],} );
	}

	const acl_modal_add = () => {
		$('#acl_modal_title').html('Tambah User');
		acl_dom_creator('add');
		$('#acl_modal').modal('show');
		$('#acl_modal_submit').click(function(){ add_confirmation(); });
	}


	const editacl = (id) => {
        /* console.log(id); */
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/edit_user?>",
			type: "POST",
			data: {ID_ACL:id },
			success: function(data){ acl_modal_edit(JSON.parse(data)[0]); $('#overlay').fadeOut(500); }
		});

	}

	const acl_modal_edit = (json) => {
        /* console.log(json); */
		swal.close();
		$('#acl_modal_title').html('Ubah Data User');
		acl_dom_creator('edit',json.id_pegawai_pasien,json.username,json.password,json.role,json.id_acl);
		$('#acl_modal').modal('show');
		$('#acl_modal_submit').click(function(){ update_confirmation(json.id_acl); });
	}

	const acl_dom_creator = (STATE,ID_PEGAWAI_PASIEN='',USERNAME='',PASSWORD='',ROLE='',ID_ACL='') => {
        /* console.log(USERNAME);
        console.log(PASSWORD);
        console.log(ID_ACL); */
		if (ID_PEGAWAI_PASIEN==null) { ID_PEGAWAI_PASIEN=''; }
		if (USERNAME==null) { USERNAME=''; }
		if (STATE=='add') {
			document.querySelector('#ID_PEGAWAI_PASIEN').value = '';
			document.querySelector('#USERNAME').value = '';
            document.querySelector('#PASSWORD').value = '';
			document.querySelector('#ROLE').value = '';
		}else{
            document.querySelector('#ID_PEGAWAI_PASIEN').value = ID_PEGAWAI_PASIEN;
			document.querySelector('#USERNAME').value = USERNAME;
            document.querySelector('#PASSWORD').value = PASSWORD;
            if(ROLE=='admin'){
                document.querySelector('#ROLE').selectedIndex = "0";
            }else if(ROLE=='pegawai'){
                document.querySelector('#ROLE').selectedIndex = "1";
            }else if(ROLE=='pasien'){
                document.querySelector('#ROLE').selectedIndex = "2"; 
            }
          		
		}
        document.querySelector('#aclx').value =ID_ACL;
	}

	const saveacl = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/add_user?>",
			type: "POST",
			data: {
				id_pegawai_pasien :$("#ID_PEGAWAI_PASIEN").val(),
				username:$("#USERNAME").val(),
				password:$("#PASSWORD").val(),
				role:$("#ROLE").val()
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
	const updateacl = () =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/update_user?>",
			type: "POST",
			data: {
				id_pegawai_pasien :$("#ID_PEGAWAI_PASIEN").val(),
				username:$("#USERNAME").val(),
				password:$("#PASSWORD").val(),
				role:$("#ROLE").val(),
                id_acl:$("#aclx").val(),
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

	const hapus_acl = (id) =>{
		$('#overlay').fadeIn(500);
		swal_fn('info','Mohon Tunggu','transaksi data sedang dilakukan');
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/delete_user?>",
			type: "POST",
			data: {
				id_acl :id
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