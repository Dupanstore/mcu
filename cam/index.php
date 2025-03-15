<script type="text/javascript" src="../assets/js/jquery.min.js">jQuery.noConflict();</script>
<body onload="pilihanfoto()">
<script type="text/javascript">
<?php
	$gmbrnyaya = "noimage.png";
	
	if(file_exists('gambar/' .$_GET['rm'] .'.jpg')){
		$gmbrnyaya = $_GET['rm']. ".jpg?dt=". date("YmdHis");
	}
?>

function pilihanfoto(){
	$('#imagesnya').html("<img src='gambar/<?=@$gmbrnyaya?>' width='120px'>");
	var val = 0;
	var val = 0;
	for( i = 0; i < document.form3.pilihan.length; i++ ){
	if( document.form3.pilihan[i].checked == true ){
		val = document.form3.pilihan[i].value;
		if(val=="1"){
			document.form3.foto.disabled=false;
			document.form3.konfigurasi.disabled=true;
			document.form3.take.disabled=true;
			document.getElementById("kamera").innerHTML="";		
		}else{
			document.form3.foto.disabled=true;
			document.form3.konfigurasi.disabled=false;
			document.form3.take.disabled=false;
			document.getElementById("kamera").innerHTML=webcam.get_html(215,215);
		}
	}
	}
}
</script>
<script type="text/javascript" src="webcam.js"></script>
<!-- Configure a few settings -->
<script language="JavaScript">
	webcam.set_api_url( "test.php?rm=<?=@$_GET['rm']?>");
	webcam.set_quality( 90 ); // JPEG quality (1 - 100)
	webcam.set_shutter_sound( true ); // play shutter click sound
</script>
<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			document.getElementById("hasil-foto").innerHTML = '<b>Proses Upload...</b>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				document.getElementById("hasil-foto").innerHTML = '<b>Sukses Menyimpan Foto</b>';
				//document.form3.hasilfoto.value="1";
				webcam.reset();
				location.href=location.href;
			}else alert("PHP Error: " + msg);
		}
</script>
<div style="margin-top:-5px;">
<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form3" name="form3" />
<table border="0" cellspacing="0" cellpadding="0" width="100%;">
<tr>
    <td>
		<div id="hasil-foto"><input type="hidden" name="hasilfoto" value=""></div>
		<div id="kamera"></div>
		<input style="opacity:1;display:none;" type="radio" name="pilihan" value="1" onClick="pilihanfoto()" />
		<input style="opacity:1;display:none;" type="file" name="foto" disabled="" /><br>
		<input style="opacity:1;display:none;" type="radio" name="pilihan" value="2" onload="pilihanfoto()" checked="true"/>
		<div align="center" style="margin-top:-15px;margin-bottom:5px;">
		<input type="button" style="padding:3px;cursor:pointer" name="konfigurasi" value="Konfigurasi..." onClick="webcam.configure()" disabled="">
		<input type="button" style="padding:3px;cursor:pointer" name="take" value="Ambil Foto" onClick="take_snapshot()" disabled="">
		</div>
		<div align="center" >
		<div id="imagesnya"></div>
		</div>
	</td>
	
</tr>
</table>
</form>
</div>
