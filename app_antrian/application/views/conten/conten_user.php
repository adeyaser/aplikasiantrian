<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<ol class="breadcrumb">
				<li>Data Antrian</li>
				<li class="active"><span>Antrian</span></li>
			</ol>
			<h1>ANTRIAN PASIEN</h1>
		</div>
		<div class="col-12">
			<hr style="margin: 4px;">
		</div>
		
		   <div class="row">
   			    <div class="col-sm-12">
   			      <div class="card bg-white text-dark">
   			        <div class="card-body">
   			          <class="card-title"><h3>DATA ANTRIAN A </h3>
			              <div class="col-12 tp-m-tp- table-responsive">
   			               <table id="master" class="table table-hover">
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
   	</div>
</div>
<script>
$( document ).ready(function() {
		$("body").append('<div id="overlay" style="background-color:rgba(0,0,0,0.8);position:fixed;top:0;left:0;height:100%;width:100%;z-index:999"></div>');
		$('#overlay').fadeOut(500);
		dataantrian();
	});

	
	const dataantrian = () =>{
		var rooms         ="<?php echo $this->session->userdata('loket')?>";
		console.log(rooms);

		$('#overlay').fadeOut(500);
		$('#master').DataTable( {
			"destroy": true,
      "responsive": true,
			"searching": true,
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
		console.log(id);

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



