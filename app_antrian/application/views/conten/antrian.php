<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Data Antrian</li>
				<li class="active"><span>Antrian</span></li>
			</ol>
			<h1>ANTRIAN PASIEN</h1>
		</div>

		<div class="row">
        <div class="col-sm-4">
          <div class="card bg-white text-dark">
            <div class="card-body">
              <class="card-title"><h3>ANTRIAN A </h3>
              <class="card-text"><h4><div id="id_antrianA"></h4>
              <button class="btn btn-primary" onclick="get_antrian('A')"> Klik disini </button>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card bg-white text-dark">
            <div class="card-body">
              <class="card-title"><h3>ANTRIAN  B</h3>
              <class="card-text"><h4><div id="id_antrianB"></h4>
              <button class="btn btn-primary" onclick="get_antrian('B')">Klik disini </button>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card bg-white text-dark">
            <div class="card-body">
              <class="card-title"><h3>ANTRIAN C</h3>
              <class="card-text"><h4><div id="id_antrianC"></h4>
              <button class="btn btn-primary" onclick="get_antrian('C')"> Klik disini </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card text-center">
      <div class="card-header">
        <br>
      </div>
      <div class="card-body">
        <class="card-title"><h3>Form Antrian Pasien</h3>
        <div class="form-group">
			<table class="table">
				<tbody id="acl_pasien_container">																
					<tr>
				    	<input name="antrianV" type ="hidden" id="antrianV" class="form-control" placeholder="no antrian"/>
						<td class="tp-n-bd" width="10%"><label for="ID_PASIEN" class="control-label">NAMA PASIEN / ID PASIEN</label></td>
						<td class="tp-n-bd">
							<input name="txt_search" type ="text" id="txt_search" class="form-control" placeholder="NAMA PASIEN"/>
							<ul id="searchResult"></ul>
						</td>
					</tr>
                    <tr>
						<td class="tp-n-bd" width="10%"><label for="DETAIL_PASIEN" class="control-label">DETAIL PASIEN</label></td>
						<td class="tp-n-bd">
							<input name="id_pasien" type ="text" id="id_pasien" class="form-control" placeholder="id pasein" readonly/>
                            <input name="nama_pasien" type ="text" id="nama_pasien" class="form-control" placeholder="nama pasein" readonly/>
						</td>
					</tr>
                    <tr>
						<td class="tp-n-bd" width="10%"></td>
						<td class="tp-n-bd">
                        <button class="btn btn-warning" onclick="reset()"> Batal </button>
                        <button class="btn btn-primary" onclick="save_antrian()"> Simpan </button>
						</td>
					</tr>							
				</tbody>
			</table>
		</div>

     </div>
        </div>
		    <div class="col-12">
			<hr style="margin: 4px;">
		</div>			
	  	<div class="row">
        	<div class="col-sm-12">
          	<div class="card bg-white text-dark">
          <div class="card-body">
         	<class="card-title"><h3>DATA ANTRIAN A </h3>
			 <div class="col-4 tp-m-tp- table-responsive">
         		<table id="tbl_a" class="table table-hover">
		  		  <thead>
					 <tr>
				 		<th>NO</th>
						 <th>NAMA PASIEN </th><th>ANTRIAN</th><th>AKSI</th>
				 	 </tr>
				  </thead>
				  <tbody></tbody>
			   	</table>
             </div>
          </div>
         </div>
	 </div>
     <div class="col-sm-12">
      <div class="card bg-white text-dark">
        <div class="card-body">
         <class="card-title"><h3>DATA ANTRIAN  B</h3>
		   <div class="col-12 tp-m-tp- table-responsive">	
             <table id="tbl_b" class="table table-hover">
				 <thead>
					<tr>
				 		<th>NO</th><th>NAMA PASIEN </th><th>ANTRIAN</th><th>AKSI</th>
				     </tr>
				 </thead>
				<tbody></tbody>
			 </table>
           </div>
        </div>
      </div>
	</div>	
    <div class="col-sm-12">
     <div class="card bg-white text-dark">
      <div class="card-body">
        <class="card-title"><h3>DATA ANTRIAN C</h3>
		  <div class="col-12 tp-m-tp- table-responsive"> 
			 <table id="tbl_c" class="table table-hover">
				 <thead>
				 	<tr>
				 		<th>NO</th><th>NAMA PASIEN </th><th>ANTRIAN</th><th>AKSI</th>
				 	</tr>
				</thead>
				<tbody></tbody>
			</table>
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
  			<class="card-title"><h3>ALL DATA ANTRIAN</h3>
  				<div class="row">
  					<div class="col-12 tp-m-tp- table-responsive">
  					 <table id="mastertable" class="table table-hover">
  						 <thead>
  							<tr>
  							  <th>NO</th><th>ID PASIEN </th><th>NAMA PASIEN </th><th>ANTRIAN</th><th>TANGGAL DAN JAM </th><th>AKSI</th>
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
   </div>
</div>
<script>
$( document ).ready(function() {
		$("body").append('<div id="overlay" style="background-color:rgba(0,0,0,0.8);position:fixed;top:0;left:0;height:100%;width:100%;z-index:999"></div>');
		$('#overlay').fadeOut(500);
		dataantrian_A();
		dataantrian_B();
		dataantrian_C();
		all_data_antrian();
	});

	const antrian_modal_validator = () =>{
		if ($("#antrianV").val() == "") { swal_fn('error','Gagal','Silahkan Ambil No Antrian'); return false; }
		if ($("#id_pasien").val() == "") { swal_fn('error','Gagal','Silahkan Isi Data Pasien'); return false; }
		return true;
	}

   const get_antrian = (id) => {
        /* console.log(id); */
		$.ajax({
			url: "<?=base_url(); ?>index.php/home/get_P_antrian",
			type: "POST",
			data: {room:id },
			success: function(data){ set_data(JSON.parse(data)); $('#overlay').fadeOut(500); }
		});
		// console.log(JSON);
	}

    const set_data = (json) => {
		 var rest=json.room ;
		 var res = rest.substring(0, 1);
		//  console.log(res);
		// console.log(json);
        if(res == 'A'){
        		if(rest == 'A Sudah Penuh'){
          		  document.querySelector('#id_antrianA').innerHTML ='ANTRIAN : '+json.room;
          		  document.querySelector('#antrianV').value ='';
						 }else{
						  	document.querySelector('#id_antrianA').innerHTML ='NO ANTRIAN : '+json.room;
							  document.querySelector('#antrianV').value =json.room;
						 }		
        }else if(res == 'B'){
        	 if(rest == 'B Sudah Penuh'){
            	document.querySelector('#id_antrianB').innerHTML ='ANTRIAN : '+ json.room;
							document.querySelector('#antrianV').value  ='';
					}else{
							document.querySelector('#id_antrianB').innerHTML ='NO ANTRIAN : '+ json.room;
							document.querySelector('#antrianV').value  =json.room;
					}
        }else if(res == 'C'){
        	 if(rest == 'C Sudah Penuh'){
           	  document.querySelector('#id_antrianC').innerHTML ='ANTRIAN : '+ json.room;
						  document.querySelector('#antrianV').value ='';
						}else{
							document.querySelector('#id_antrianC').innerHTML ='NO ANTRIAN : '+ json.room;
						  document.querySelector('#antrianV').value = json.room;
						}
        }
	}

	const save_antrian = () => {
		var id_antrian =$("#antrianV").val();
		var id_pasien  =$("#id_pasien").val();

		if (antrian_modal_validator()==false){ return; }

		$.ajax({
			url: "<?=base_url(); ?>index.php/home/add_antrian",
			type:"POST",
			data:{
				id_antrian:id_antrian,
				id_pasien:id_pasien
			},
			success: function(data){
				let json = JSON.parse(data);
				console.log(json);
				if((json.status)=='success'){
					swal_fn('success','Sukses','simpan data berhasil!'); 

					document.querySelector('#id_pasien').value ="";
					document.querySelector('#nama_pasien').value ="";
					document.querySelector('#txt_search').value ="";
				}else{
					swal_fn('error','Gagal','data gagal berhasil!'); 
				}
				dataantrian_A();
				dataantrian_B();
				dataantrian_C();
				all_data_antrian();

				document.querySelector('#id_antrianA').innerHTML ="";
				document.querySelector('#id_antrianB').innerHTML ="";
				document.querySelector('#id_antrianC').innerHTML ="";
				document.querySelector('#antrianV').value ="";	
			}

		});
	}

	const get_data_load = () =>{
		$("#txt_search").keyup(function(){
			var search = $(this).val();
			console.log(search);

			if(search != ""){
				$.ajax({
					url:"<?=base_url(); ?>index.php/home/get_autocomplie",
					type:"POST",
					dataType: 'json',
					data:{nama_pasien:search,type:1},
					success:function(data){
						// console.log(data);
					 var len =data.length;
					    // console.log(len);
					 $("#searchResult").empty();
					 	for(var i = 0; i<len; i++){
					 		var id   = data[i]['id_pasien'];
					 		var nama = data[i]['nama_pasien'];
					 		$("#searchResult").append("<li value='"+id+"'>"+nama+"-"+id+"</li>");
							 $("#searchResult").css('background', 'rgb(129,179,247)');
					 	}
					 
					$("#searchResult li").bind("click",function(){setText(this);});
				
					}
				});
			}

		});
		
	}
	
	const setText = (element) =>{
		var value = $(element).text();
		var userid= $(element).val();
		
		$("#txt_search").val(value);
		$("#serchResult").empty();

		$.ajax({
			url:"<?=base_url(); ?>index.php/home/get_autocomplie",
			type:"POST",
			dataType: 'json',
			data:{id_pasien:userid, type:2},
			success: function(data){
				var len =data.length;
				
				// console.log(data);

				$("#id_pasein").empty();
				$("#nama_pasien").empty();

				if(len > 0){
					document.querySelector('#id_pasien').value = data[0]['id_pasien'];
					document.querySelector('#nama_pasien').value = data[0]['nama_pasien'];
				}

				//untuk menghilangkan pencarian//		
				if($("#id_pasein")!=""){
					$("#searchResult").empty();
				}

			 }			
		});
	}

	get_data_load();


	const reset = () =>{
	    document.querySelector('#id_pasien').value ="";
	    document.querySelector('#nama_pasien').value ="";
	    document.querySelector('#txt_search').value ="";    
	}

	const dataantrian_A = () =>{
		var rooms         ="A";

		$('#overlay').fadeOut(500);
		$('#tbl_a').DataTable( {
			"destroy": true,
      "responsive": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/getall_antrian",
				data : function ( d ) {
					d.id_antrian=rooms
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "nama_pasien" },
			{ "data": "id_antrian" },
			{ "data": "action" },
			],} );
	}

	const dataantrian_B = () =>{
		var rooms         ="B";

		$('#overlay').fadeOut(500);
		$('#tbl_b').DataTable( {
			"destroy": true,
      "responsive": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/getall_antrian",
				data : function ( d ) {
					d.id_antrian=rooms
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "nama_pasien" },
			{ "data": "id_antrian" },
			{ "data": "action" },
			],} );
	}

	const dataantrian_C = () =>{
		var rooms         ="C";

		$('#overlay').fadeOut(500);
		$('#tbl_c').DataTable( {
			"destroy": true,
      "responsive": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/getall_antrian",
				data : function ( d ) {
					d.id_antrian=rooms
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "nama_pasien" },
			{ "data": "id_antrian" },
			{ "data": "action" },
			],} );
	}

	const all_data_antrian = () =>{
		$('#overlay').fadeOut(500);
		$('#mastertable').DataTable( {
			"destroy": true,
            "responsive": true,
			"searching": true,
			"ajax": {
				"url": "<?=base_url(); ?>index.php/home/get_antrian",
				data : function ( d ) {
					d.type=1;
				},
				"type": "POST"
			},
			"columns": [
			{ "data": "num" },
			{ "data": "id_pasien" },
			{ "data": "nama_pasien" },
			{ "data": "id_antrian" },
			{ "data": "tanggal" },
			{ "data": "action" },
			],} );
	}

	const update = (id) =>{
  	var no_antrian = id;
  	console.log(no_antrian);
  	$.ajax({
  		url:"<?=base_url(); ?>index.php/home/update_antrian",
  		type:"POST",
  		data:{no_antrian:no_antrian },
  		success: function(data){ dataantrian(); }
  	});
  }

	const  play_antrian = (id)=>{

		var room = id.substring(1,0);
		var urut = id.substring(1,5);
		var alamat ="";
		var urut_ratusan="";
		var urutan_lanjut ="";
		var urutan_lanjut_ratus ="";
		var audio  ="";
		var audio_belas="";
		var audio_puluhan="";
		var audio_ratus="";
		var audio_lanjut="";
		var alamat_loket ="";
		var audio_loket ="";
		var conter =0;
		    conter = conter + 1;
			
		/*SUARA UNTUK LOKET	*/
		alamat_loket ="<?= base_url('assets/'); ?>rekaman/loket.wav";
		audio_loket  = new Audio(alamat_loket);

		if(urut)

		if(urut < 10){
			  alamat ="<?= base_url('assets/'); ?>rekaman/"+urut+".wav";
		    audio = new Audio(alamat);
		}else if(urut < 20){
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urut+".wav";
			urut_ratusan = urut.substring(1,2);
			urutan_lanjut = urut.charAt(1);
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";
			audio_belas = new Audio(alamat_lanjut);

		}else if(urut < 100){
		  urut_ratusan = urut.substring(1,2);
			urutan_lanjut = urut.charAt(0); // mengambil angka sebelah kiri
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			audio = new Audio(alamat);
		  audio_puluhan = new Audio(alamat_lanjut);
		}else if(urut < 110){
			urutan_lanjut = urut.charAt(2); // mengambil angka sebelah kanan
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";	
			audio_lanjut = new Audio(alamat_lanjut);
		}else if(urut < 120){
			// urut_ratusan = urut.substring(1,2); // mengabil angka puluhan
			urutan_lanjut = urut.charAt(2); // mengambil angka sebelah kiri
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";
			audio_lanjut = new Audio(alamat);
		}else if(urut < 200){
		  urut_ratusan = urut.substring(1,2); // mengabil angka puluhan
			urutan_lanjut = urut.charAt(2); // mengambil angka sebelah kiri
		 	alamat ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";
			
			audio_puluhan = new Audio(alamat);
			audio_lanjut = new Audio(alamat_lanjut);
		}else if(urut == 200){
			 urut_ratusan = urut.charAt(0); // mengabil angka ratus
			 console.log(urut_ratusan);
			 alamat ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			 audio = new Audio(alamat);
		}else if (urut < 210){
			urut_ratusan = urut.charAt(0);
			urutan_lanjut = urut.charAt(2); // mengambil angka sebelah kiri
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut+".wav";
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			audio = new Audio(alamat);
		  audio_puluhan = new Audio(alamat_lanjut);
		}else if(urut == 211){
			urut_ratusan = urut.charAt(0);
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			audio  = new Audio(alamat);
		}else if(urut == 220){
			urut_ratusan = urut.charAt(0);
			urut_lanjut = urut.charAt(1);
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urut_lanjut+".wav";
			audio  = new Audio(alamat);
			audio_lanjut  = new Audio(alamat_lanjut);
		}else if(urut < 300){
			urut_ratusan = urut.charAt(0);
			urut_lanjut = urut.charAt(1);
			urutan_lanjut_ratus = urut.charAt(2);
			alamat ="<?= base_url('assets/'); ?>rekaman/"+urut_ratusan+".wav";
			alamat_lanjut ="<?= base_url('assets/'); ?>rekaman/"+urut_lanjut+".wav";
			urutan_lanjut_ratus ="<?= base_url('assets/'); ?>rekaman/"+urutan_lanjut_ratus+".wav";
			audio         = new Audio(alamat);
			audio_lanjut  = new Audio(alamat_lanjut);
			audio_ratus   = new Audio(urutan_lanjut_ratus);
		}

	 //MAINKAN SUARA BEL PADA SAAT AWAL
	 document.getElementById('suarabel').pause();
	 document.getElementById('suarabel').currentTime=0;
	 document.getElementById('suarabel').play();

	  //SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT

	 //totalwaktu=document.getElementById('suarabel').duration*1000;
	  totalwaktu=8*1000;

		if(room =='A'){
			suara ='suaraA';
		}else if(room =='B'){
			suara ='suaraB';
		}else if(room =='C'){
			suara ='suaraC';
		}

	 	 	setTimeout(function() {
	 	          document.getElementById('suarabelnomorurut').pause();
	 	          document.getElementById('suarabelnomorurut').currentTime=0;
	 	          document.getElementById('suarabelnomorurut').play();
	 	      }, totalwaktu);

	 	      totalwaktu=totalwaktu+2000;

	 	      setTimeout(function() {
	 	          document.getElementById(suara).pause();
	 	          document.getElementById(suara).currentTime=0;
	 	          document.getElementById(suara).play();
	 	      }, totalwaktu);
	 	      totalwaktu=totalwaktu+1000;

			if(urut < 10 ){
			setTimeout(function() {
				audio.pause();
	            audio.currentTime=0;
	            audio.play();
	        }, totalwaktu);

	        totalwaktu=totalwaktu+1000;
			} else if(urut == 10){
				setTimeout(function() {
	            document.getElementById('sepuluh').pause();
	            document.getElementById('sepuluh').currentTime=0;
	            document.getElementById('sepuluh').play();
	           }, totalwaktu);
	           totalwaktu=totalwaktu+1000;
			}else if(urut == 11){
				setTimeout(function() {
	            document.getElementById('sebelas').pause();
	            document.getElementById('sebelas').currentTime=0;
	            document.getElementById('sebelas').play();
	           }, totalwaktu);
	           totalwaktu=totalwaktu+1000;
			}else if(urut < 20){
			    setTimeout(function() {
			   	audio_belas.pause();
			   	audio_belas.currentTime=0;
				  audio_belas.play();
	        }, totalwaktu);

			  totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('belas').pause();
	            document.getElementById('belas').currentTime=0;
	            document.getElementById('belas').play();
	          }, totalwaktu);
	          totalwaktu=totalwaktu+1000;

			}else if(urut < 100){
				setTimeout(function() {
				audio.pause();
	            audio.currentTime=0;
	            audio.play();
	          }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('puluh').pause();
	            document.getElementById('puluh').currentTime=0;
	            document.getElementById('puluh').play();
	       	  }, totalwaktu);
				 totalwaktu=totalwaktu+1000;
				setTimeout(function() {
				      audio_puluhan.pause();
	            audio_puluhan.currentTime=0;
	            audio_puluhan.play();
	          }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
			}else if(urut == 100){
				setTimeout(function() {
	            document.getElementById('seratus').pause();
	            document.getElementById('seratus').currentTime=0;
	            document.getElementById('seratus').play();
	          }, totalwaktu);
	          totalwaktu=totalwaktu+1000;
			}
			else if(urut < 110){
				setTimeout(function() {
	            document.getElementById('seratus').pause();
	            document.getElementById('seratus').currentTime=0;
	            document.getElementById('seratus').play();
	          }, totalwaktu);
	          totalwaktu=totalwaktu+1000;
	          setTimeout(function() {
			      	audio_lanjut.pause();
	            audio_lanjut.currentTime=0;
	            audio_lanjut.play();
	          }, totalwaktu);
			}else if(urut ==111){
				setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
			}else if(urut < 120){
				setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
			      	audio_lanjut.pause();
	            audio_lanjut.currentTime=0;
	            audio_lanjut.play();
	          }, totalwaktu);
         totalwaktu=totalwaktu+1000;
        setTimeout(function() {
	            document.getElementById('belas').pause();
	            document.getElementById('belas').currentTime=0;
	            document.getElementById('belas').play();
	          }, totalwaktu);
         totalwaktu=totalwaktu+1000;
			}else if(urut == 120){
				 setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            audio_puluhan.pause();
	          audio_puluhan.currentTime=0;
	          audio_puluhan.play();
	       }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
			}else if(urut < 200){
				 setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            audio_puluhan.pause();
	          audio_puluhan.currentTime=0;
	          audio_puluhan.play();
	       }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            audio_lanjut.pause();
	          audio_lanjut.currentTime=0;
	          audio_lanjut.play();
	       }, totalwaktu);
        totalwaktu=totalwaktu+1000;
			}else if(urut == 200){
				setTimeout(function() {
            audio.pause();
	          audio.currentTime=0;
	          audio.play();
	       }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
			}else if(urut < 210){
				setTimeout(function() {
				audio.pause();
	            audio.currentTime=0;
	            audio.play();
	          }, totalwaktu);
			     totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('ratus').pause();
	            document.getElementById('ratus').currentTime=0;
	            document.getElementById('ratus').play();
	       	  }, totalwaktu);
				 totalwaktu=totalwaktu+1000;
				setTimeout(function() {
				      audio_puluhan.pause();
	            audio_puluhan.currentTime=0;
	            audio_puluhan.play();
	          }, totalwaktu);
			  totalwaktu=totalwaktu+1000;
			}else if(urut == 211){
				setTimeout(function() {
				audio.pause();
	            audio.currentTime=0;
	            audio.play();
	          }, totalwaktu);
			     totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('ratus').pause();
	            document.getElementById('ratus').currentTime=0;
	            document.getElementById('ratus').play();
	       	  }, totalwaktu);
				   totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('sebelas').pause();
	            document.getElementById('sebelas').currentTime=0;
	            document.getElementById('sebelas').play();
	          }, totalwaktu);
	          totalwaktu=totalwaktu+1000;
			}else if(urut == 220){
				setTimeout(function() {
				audio.pause();
	            audio.currentTime=0;
	            audio.play();
	          }, totalwaktu);
			     totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('ratus').pause();
	            document.getElementById('ratus').currentTime=0;
	            document.getElementById('ratus').play();
	       	  }, totalwaktu);
	         totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
							audio_lanjut.pause();
	            audio_lanjut.currentTime=0;
	            audio_lanjut.play();
	          }, totalwaktu);
				   totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('puluh').pause();
	            document.getElementById('puluh').currentTime=0;
	            document.getElementById('puluh').play();
	          }, totalwaktu);
	          totalwaktu=totalwaktu+1000;
			}else if(urut < 300){
				/*ANGKA PERTAMA */
				setTimeout(function() {
				      audio.pause();
	            audio.currentTime=0;
	            audio.play();
	          }, totalwaktu);
			     totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('ratus').pause();
	            document.getElementById('ratus').currentTime=0;
	            document.getElementById('ratus').play();
	       	  }, totalwaktu);
	         totalwaktu=totalwaktu+1000;

	         /*ANGKA KE DUA */
	            setTimeout(function() {
							audio_lanjut.pause();
	            audio_lanjut.currentTime=0;
	            audio_lanjut.play();
	          }, totalwaktu);
				   totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
	            document.getElementById('puluh').pause();
	            document.getElementById('puluh').currentTime=0;
	            document.getElementById('puluh').play();
	          }, totalwaktu);
	         totalwaktu=totalwaktu+1000;
	            setTimeout(function() {
							audio_ratus.pause();
	            audio_ratus.currentTime=0;
	            audio_ratus.play();
	          }, totalwaktu);
				   totalwaktu=totalwaktu+1000;
			}
			 setTimeout(function() {
		     	 audio_loket.pause();
	         audio_loket.currentTime=0;
	         audio_loket.play();
	       }, totalwaktu); 
			 totalwaktu=totalwaktu+1000;

			 setTimeout(function() {
	 	       document.getElementById(suara).pause();
	 	       document.getElementById(suara).currentTime=0;
	 	       document.getElementById(suara).play();
	 	     }, totalwaktu);


  }
</script>



