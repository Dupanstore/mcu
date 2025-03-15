<html>
<?php
	if ( !function_exists('SchCleanChar') ){
		function SchCleanChar($result) {
			$result = strip_tags($result);
			$result = preg_replace('/&.+?;/', ' ', $result);
			$result = preg_replace('/\s+/', ' ', $result);
			$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
			$result = preg_replace('|-+|', ' ', $result);
			$result = preg_replace('/&#?[a-z0-9]+;/i', ' ',$result);
			$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
			$result = trim($result, ' ');
			$result	= str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), " ", $result);
			return $result;
		}
	}
?>
	<head>
		<script type="text/javascript" src="../assets/js/jquery-1.8.0.min.js">jQuery.noConflict();</script>
		<script type="text/javascript" src="../assets/js/jquery.easyui.min.js">jQuery.noConflict();</script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/easyui.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/sticky-footer.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/icon.css">
		<style>
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 999px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}
		</style>
	</head>
	<body>	
	<?php
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		error_reporting(0);
		?>
<form method="post" enctype="multipart/form-data" action="">
	<div style="position:relative;">
			<a class='btn btn-primary' href='javascript:;'>
			   Pilih File...
				<input type="file" name="userfile"  style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40"  onchange='$("#upload-file-info").html($(this).val());'>
			</a>
			<span class='label label-info' id="upload-file-info"></span>
			<input name="upload" type="submit" class="btn btn-danger" value="Import Data Pasien" style="padding:6.5px;">
	</div>
</form>

<?php if($_POST){ ?>
<table class="table" style="font-size:13px;" width="100%">
<?php
	include "excel_reader2.php";
	$sm = mysql_connect('localhost', 'root', 'admin');
	if($sm) mysql_select_db($_GET['db']);
	if( ! function_exists('is_update')){
		function is_update ($table, $val=array(), $where, $id){
			$isi = false;
			foreach ($val as $key => $value){
				$isi .= $key ."='". $value ."', ";
			}
			$isi .= "where ". $where."='". $id ."'";
			$newIsi = str_replace (", where", " where", $isi);
			$newQuery = mysql_query("UPDATE ". $table ." SET ". $newIsi);
			return $newQuery;
		}
	}
	if( ! function_exists('is_insert')){
		function is_insert ($table, $val=array()){
			$ky = array_keys ($val);
			$vl = array_values ($val);
			$field = implode (", ", $ky);
			$values = "'". implode ("', '", $vl) ."'";
			$insert = mysql_query("insert into ". $table . " (". $field .") values (". $values .")");
			return $insert;
		}
	}
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);
	$sukses = 0;
	$gagal = 0;

	for ($i=1; $i<=$baris; $i++)
	{
	$rmm = sprintf("%08s", $data->val($i, 3));
	  $ala['no_rm_pas'] = $rmm;
	  $ala['nm_pas'] = SchCleanChar($data->val($i, 4));
	  $ala['kategori_pasien'] = SchCleanChar($data->val($i, 5));
	// print_r($ala);
	 //die();
	  $sn = mysql_fetch_array(mysql_query("select * from tb_pasien where no_rm_pas='". $ala['no_rm_pas'] ."'"));
	  if($sn){
		
		$srr = is_update('tb_pasien', $ala, 'no_rm_pas', $ala['no_rm_pas']);
		
		if($srr){
			//die('test');
			$sks = '<span class="label label-info">Sukses UPDATE Data</span>';
			//selanjutnya adalah cek pada tabel register yang tanggalnya sesuai perjanjian
			//ambil data poli dan dokterny
			$debitur = 2;
			if($data->val($i, 5) == "YANMASUM"){
				$debitur = 1;
			}
			//ambil nama polinya ya
			$poli  = trim(str_replace("KLINIK ", "", $data->val($i, 7)));
			//nah setelah itu ambil default pasiennya ya
			$qss = "select * from  tb_dokter_poli, tb_sub_instalasi ";
			$qss .= " where tb_dokter_poli.id_sub_pol=tb_sub_instalasi.id_sub ";
			$qss .= " AND  tb_sub_instalasi.nm_sub='Poliklinik ". $poli ."' LIMIT 1 ";
			//print_r($qss);
			//die();
			$smm = mysql_fetch_array(mysql_query($qss));
			if($smm){
			//print_r($smm);
			//die();
			$dataRegistrasi = array (
				'tgl_awal_reg' => date("Y-m-d H:i:s", strtotime($data->val($i, 8))),
				'no_rm_pas_reg' => $rmm,
				'status_reg' => 'Check-in',
				'id_dok_reg' => $smm['id_dok_pol'],
				'id_pol_reg' => $smm['id_sub_pol'],
				'id_deb_reg' => $debitur,
				'id_user_reg' => '1',
				'ket_rawat_inap_reg' => 'no',
				'type_daftar' => 'UMUM',
				'pas_perjanjian' => 'Y',
				'sebabrudapaksa' => 'dari import',
			);
				//cek jangan sampai ada duplikasi penyimpanan
				$asj = mysql_fetch_array(mysql_query("select * from tb_register where no_rm_pas_reg='". $ala['no_rm_pas'] ."' and  tgl_awal_reg like '%".  date("Y-m-d", strtotime($data->val($i, 8))) ."%' "));
				if(!$asj){
					$abs1 = is_insert('tb_register', $dataRegistrasi);
					if($abs1){
						$ah = mysql_fetch_array(mysql_query("select * from tb_register where no_rm_pas_reg='". $ala['no_rm_pas'] ."' and  tgl_awal_reg like '%".  date("Y-m-d", strtotime($data->val($i, 8))) ."%' AND status_reg='Check-in' "));
						if($ah){
							$dataRegistrasi['id_register'] = $ah['id_reg'];
							$abs2 = is_insert('tb_register_meta',  $dataRegistrasi);
						}
					}
					//selanjutnya adalah masukkan kedalam tabel antrian
					$urutnya = 1;
					$asy = mysql_fetch_array(mysql_query("select * from tb_urutrajal where id_sub='". $smm['id_sub_pol'] ."' and tglmasuk like '%".  date("Y-m-d", strtotime($data->val($i, 8))) ."%' order by id_urut DESC limit 1"));
					if($asy){
						$urutnya = $asy['urutanke']+1;
					}
					$urut =  array(	
						'id_sub' => $smm['id_sub_pol'],
						'norm' => $ala['no_rm_pas'],
						'urutanke' => $urutnya,
						'tglmasuk' => date("Y-m-d H:i:s", strtotime($data->val($i, 8))),
					);
					$abs3 = is_insert('tb_urutrajal',  $urut);
				}	
			} else {
				$sks = '<span class="label label-warning">Gagal UPDATE Data POLINYA GA ADA</span>';
			}
		} else {
			$sks = '<span class="label label-warning">Gagal UPDATE Data</span>';
		}
	  } else {
		$sks = '<span class="label label-warning">Gagal Menyimpan Data Belum ada pasien</span>';
	  }
?>
	<tr>
		<td><b>Menyimpan: </b><?=@implode(', ', $ala)?></td>
		<td><p class="text-right"><b><?=@$sks?></b></p></td>
	</tr>
<?php
} 
?>
</table>
<?php } ?>
</body>
</html>