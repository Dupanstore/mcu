<?php
$this->db->select("id_pem_sinkron_odonto, posisi_struktur_gigi, warna_kelainan_gigi, hasilnya, id_reg_detpem");
$this->db->where("kode_transaksi", $_POST['kdtrans']);
$this->db->where("apakah_struktur_gigi", "Y");
$jshdc = $this->db->get("tb_register_detailpemeriksaan");
$nhdsv = $jshdc->result();
foreach($nhdsv as $gdgl){
	if(!empty($gdgl->warna_kelainan_gigi)){
		$getkelainan[$gdgl->posisi_struktur_gigi] = $gdgl->warna_kelainan_gigi;
		$loopkelainan[$gdgl->posisi_struktur_gigi] = $gdgl;
		$kelsinrkonloopkel[$gdgl->id_pem_sinkron_odonto][$gdgl->posisi_struktur_gigi] = $gdgl->posisi_struktur_gigi ." - ". $gdgl->hasilnya;
	}
}
//print_r($kelsinrkonloopkel);
$strukturgigikiri = array(
	'18' => array('id' => 18, 'transfom' => '0,0'),
	'17' => array('id' => 17, 'transfom' => '25,0'),
	'16' => array('id' => 16, 'transfom' => '50,0'),
	'15' => array('id' => 15, 'transfom' => '75,0'),
	'14' => array('id' => 14, 'transfom' => '100,0'),
	'13' => array('id' => 13, 'transfom' => '125,0'),
	'12' => array('id' => 12, 'transfom' => '150,0'),
	'11' => array('id' => 11, 'transfom' => '175,0'),
	'55' => array('id' => 55, 'transfom' => '75,40'),
	'54' => array('id' => 54, 'transfom' => '100,40'),
	'53' => array('id' => 53, 'transfom' => '125,40'),
	'52' => array('id' => 52, 'transfom' => '150,40'),
	'51' => array('id' => 51, 'transfom' => '175,40'),
	'85' => array('id' => 85, 'transfom' => '75,80'),
	'84' => array('id' => 84, 'transfom' => '100,80'),
	'83' => array('id' => 83, 'transfom' => '125,80'),
	'82' => array('id' => 82, 'transfom' => '150,80'),
	'81' => array('id' => 81, 'transfom' => '175,80'),
	'48' => array('id' => 48, 'transfom' => '0,120'),
	'47' => array('id' => 47, 'transfom' => '25,120'),
	'46' => array('id' => 46, 'transfom' => '50,120'),
	'45' => array('id' => 45, 'transfom' => '75,120'),
	'44' => array('id' => 44, 'transfom' => '100,120'),
	'43' => array('id' => 43, 'transfom' => '125,120'),
	'42' => array('id' => 42, 'transfom' => '150,120'),
	'41' => array('id' => 41, 'transfom' => '175,120'),
);



$strukturgigikanan = array(
	'21' => array('id' => 21, 'transfom' => '210,0'),
	'22' => array('id' => 22, 'transfom' => '235,0'),
	'23' => array('id' => 23, 'transfom' => '260,0'),
	'24' => array('id' => 24, 'transfom' => '285,0'),
	'25' => array('id' => 25, 'transfom' => '310,0'),
	'26' => array('id' => 26, 'transfom' => '335,0'),
	'27' => array('id' => 27, 'transfom' => '360,0'),
	'28' => array('id' => 28, 'transfom' => '385,0'),
	'61' => array('id' => 61, 'transfom' => '210,40'),
	'62' => array('id' => 62, 'transfom' => '235,40'),
	'63' => array('id' => 63, 'transfom' => '260,40'),
	'64' => array('id' => 64, 'transfom' => '285,40'),
	'65' => array('id' => 65, 'transfom' => '310,40'),
	'71' => array('id' => 71, 'transfom' => '210,80'),
	'72' => array('id' => 72, 'transfom' => '235,80'),
	'73' => array('id' => 73, 'transfom' => '260,80'),
	'74' => array('id' => 74, 'transfom' => '285,80'),
	'75' => array('id' => 75, 'transfom' => '310,80'),
	'31' => array('id' => 31, 'transfom' => '210,120'),
	'32' => array('id' => 32, 'transfom' => '235,120'),
	'33' => array('id' => 33, 'transfom' => '260,120'),
	'34' => array('id' => 34, 'transfom' => '285,120'),
	'35' => array('id' => 35, 'transfom' => '310,120'),
	'36' => array('id' => 36, 'transfom' => '335,120'),
	'37' => array('id' => 37, 'transfom' => '360,120'),
	'38' => array('id' => 38, 'transfom' => '385,120'),
);
$pict1 = array(
	'C' => '5,5 	15,5 	15,15 	5,15',
	'T' => '0,0 	20,0 	15,5 	5,5',
	'B' => '5,15 	15,15 	20,20 	0,20',
	'R' => '15,5 	20,0 	20,20 	15,15',
	'L' => '0,0 	5,5 	5,15 	0,20',
);




$pict2 = array(
	'C' => '4,4 	12,4 	12,12 	4,12',
	'T' => '0,0 	16,0 	12,4 	4,4',
	'B' => '4,12 	12,12 	16,16 	0,16',
	'R' => '12,4 	16,0 	16,16 	12,12',
	'L' => '0,0 	4,4 	4,12 	0,16',
);

$lokasibesar = array(
	'C' => 'x="8" y="12" ',
	'T' => 'x="8" y="4"  ',
	'B' => 'x="7" y="19"  ',
	'R' => 'x="15" y="12" ',
	'L' => 'x="-1" y="12" ',
);

$lokasikecil = array(
	'C' => 'x="5" y="9" ',
	'T' => 'x="5" y="3"  ',
	'B' => 'x="5" y="16"  ',
	'R' => 'x="12" y="9" ',
	'L' => 'x="0" y="9" ',
);
?>
<?php
	foreach($kelsinrkonloopkel as $gppo => $gvsv){
		echo '<div style="display:none;" id="untukambilke'.$gppo.'">'.implode(', ', $gvsv).'</div>';
	}
?>
<div align="center"><div id="svgselect" style="width: 100%; height: 320px; ">
	<svg version="1.1" height="100%" width="100%">
		<g transform="scale(2.0)" id="gmain">
			<?php 
				foreach($strukturgigikiri as $vllok){ 
					
			?>
			<g id="P<?=@$vllok['id']?>" transform="translate(<?=@$vllok['transfom']?>)">
			<?php 
				$pict = $pict1;
				$lokasi = $lokasibesar;
				$ukuran = "4pt";
				if($vllok['id'] > 50){
					$ukuran = "3pt";
					$lokasi = $lokasikecil;
					$pict = $pict2;
				}
				foreach($pict as $kjj => $gsfs){ 
					$warnaku = "";
					$kods = "P".$vllok['id']."-". $kjj;
					if(isset($getkelainan[$kods])){
						$warnaku = $getkelainan[$kods];
					}
			?>
				<polygon points="<?=@$gsfs?>" fill="white" stroke="navy" stroke-width="0.5" id="<?=@$kjj?>" opacity="1"></polygon>
				<text <?=@$lokasi[$kjj]?> stroke="red" fill="red" stroke-width="0.1" style="font-size: <?=@$ukuran?>;font-weight:normal;color:red;text-align:center"><?=@$warnaku?></text>
			<?php } ?>
				<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal"><?=@$vllok['id']?></text>
			</g>
			<?php } ?>
			
			<?php 
				foreach($strukturgigikanan as $vllok){ 
					
			?>
			<g id="P<?=@$vllok['id']?>" transform="translate(<?=@$vllok['transfom']?>)">
			<?php 
				$pict = $pict1;
				$lokasi = $lokasibesar;
				$ukuran = "4pt";
				if($vllok['id'] > 50){
					$ukuran = "3pt";
					$lokasi = $lokasikecil;
					$pict = $pict2;
				}
				foreach($pict as $kjj => $gsfs){ 
					$warnaku = "";
					$kods = "P".$vllok['id']."-". $kjj;
					if(isset($getkelainan[$kods])){
						$warnaku = $getkelainan[$kods];
					}
			?>
				<polygon points="<?=@$gsfs?>" fill="white" stroke="navy" stroke-width="0.5" id="<?=@$kjj?>" opacity="1"></polygon>
				<text <?=@$lokasi[$kjj]?> stroke="red" fill="red" stroke-width="0.1" style="font-size: <?=@$ukuran?>;font-weight:normal;color:red"><?=@$warnaku?></text>
			<?php } ?>
				<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal"><?=@$vllok['id']?></text>
			</g>
			<?php } ?>
			
			<!-- Row pertama baris kedua -->
			
			
		</g>
	</svg>
</div></div>
<?php if(is_array($loopkelainan)){ ?>
<hr style="margin:5px;background:#ccceee;height:2px;border:none;">
<table style="width:100%">
	<tr>
		<td>
	<?php 
		$sgf=1;
		foreach($loopkelainan as $lpklni){ 
			$dns=$sgf++;
	?>
	
	<!--	<td><?=@$lpklni->posisi_struktur_gigi?></td>-->
		 <span style="cursor:pointer" onclick="hapuspilihodonto('<?=@$lpklni->id_reg_detpem?>')"><?=@$lpklni->posisi_struktur_gigi?>  - <?=@$lpklni->hasilnya?> (<?=@$lpklni->warna_kelainan_gigi?>)</span> |  
		
	<?php }  ?>
	</td>
	</tr>
</table>
<?php } ?>
<script>
	var nomencladores = {"practicas": [
			{"nomenclador": "02.01", "color": "cyan"},
			{"nomenclador": "02.02", "color": "magenta"},
    ]
	};
	
	var odontograma = {"dientes": [
        {"pieza": "P18", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P17", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P16", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P15", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P14", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P13", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P12", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
        {"pieza": "P11", "anterior": {"C": "", "T": "", "B": "", "L": "", "R": ""}, "nuevo": {"C": "", "T": "", "B": "", "L": "", "R": ""} },
    ]
	};
	
	var color_lapiz = 'navy';
	
	$(document).ready(function () {
		$('polygon').attr('stroke', color_lapiz);
		$('text').attr('stroke', color_lapiz);
		$('text').attr('fill', color_lapiz);
		
		//alert(odontograma.dientes[0].pieza);
		//alert(odontograma.dientes[0].anterior.C);
		
		$('polygon').mouseover(function (evt) {
			var svg = $('#svgselect').svg('get'); 
			//alert(svg);
			var sector = $(evt.target);
			var cara = sector.attr('id');
			var diente = sector.parent().attr('id');
			$('#piezanumero').html(diente);
			$('#piezacara').html(cara);
			//sector.attr('fill', 'yellow');
			//var over = sector.clone();
			//over.attr('fill', 'yellow');
			//sector.parent().add(over);
		});
		
		$('polygon').mouseout(function (evt) {
			//var sector = $(evt.target);
			//sector.attr('fill', 'white');
			
			$('#piezanumero').html('XX');
			$('#piezacara').html('X');
		});
		
		$('polygon').click(function (evt) {
			var sector = $(evt.target); 
			var strdebug = sector.parent().attr('id') + '-' + sector.attr('id');
			inputhasilgigitampil(strdebug)
			//$("#message").html('<a style="font-size:30px;" href="javascript:void(0)" onclick="inputhasilgigitampil(\''+strdebug+'\')">'+strdebug+'</a>' );
			//console.debug(strdebug);
		});
		
		$('#chkAnterior').click( function() {
		});
		
		$('#chkNuevo').click( function() {
		});
		
	});
</script>