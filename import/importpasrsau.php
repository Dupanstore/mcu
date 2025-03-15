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
?>
	<head>
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
	<div style="text-align:left">
			<input type="file" name="userfile" value"Pilih File" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
			<span class='label label-info' id="upload-file-info"></span>
			<input name="upload" type="submit" value="Import Data Pasien" style="cursor:pointer">
	</div>
</form>

<?php if($_POST){ ?>
<table class="table" style="font-size:13px;background:#ffffff;" width="100%">
<?php
	include "excel_reader2.php";
	$sm = mysql_connect('localhost', 'root', 'lakespra');
	if($sm) mysql_select_db($_GET['db']);
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);
	$sukses = 0;
	$gagal = 0;
	$kode_transaksi = "L-A". date("Ymd-9");
	for ($i=2; $i<=$baris; $i++)
	{
	  $ala['no_reg'] = SchCleanChar($data->val($i, 1));
	  $ala['preposisi'] = SchCleanChar($data->val($i, 2));
	  $ala['nm_pas'] = SchCleanChar($data->val($i, 3));
	  $ala['tmp_lahir_pas'] = SchCleanChar($data->val($i, 4));
	  $ala['tgl_lhr_pas'] = date("Y-m-d", strtotime($data->val($i, 5)));
	  $ala['jenkel_pas'] = SchCleanChar($data->val($i, 6));
	  $ala['id_agama'] = SchCleanChar($data->val($i, 7));
	  $ala['alamat_pas'] = SchCleanChar($data->val($i, 8));
	  $ala['no_ktp_pas'] = SchCleanChar($data->val($i, 9));
	  $ala['no_tlp_pas'] = SchCleanChar($data->val($i, 10));
	  $ala['nm_pekerjaan'] = SchCleanChar($data->val($i, 11));
	  $ala['jabatan_pas'] = SchCleanChar($data->val($i, 12));
	  $ala['kesatuan_pas'] = SchCleanChar($data->val($i, 13));
	  $ala['pangkat_pas'] = SchCleanChar($data->val($i, 14));
	  $ala['bangsa_pas'] = SchCleanChar($data->val($i, 15));
	  $ala['kawin_pas'] = SchCleanChar($data->val($i, 16));
	  $ala['id_pendidikan'] = SchCleanChar($data->val($i, 17));
	  $ala['gol_darah'] = SchCleanChar($data->val($i, 18));
	  $ala['nip_nrp_nik'] = SchCleanChar($data->val($i, 19));
	  $ala['id_jawatan'] = SchCleanChar($data->val($i, 20));
	  $ala['id_dinas'] = SchCleanChar($data->val($i, 21));
	  $ala['tgl_daftar'] = date("Y-m-d", strtotime($data->val($i, 22))) . date(" H:i:s");
	  $sn = mysql_fetch_array(mysql_query("select no_reg, nip_nrp_nik from tb_pasien where no_reg='". $ala['no_reg'] ."' limit 1"));
	  if(strlen($ala['no_reg']) == '10'){
		  if($sn){
			$srr = is_update('tb_pasien', $ala, 'no_reg', $ala['no_reg']);
			if($srr){
				$sks = '<span class="label label-info">Sukses UPDATE Data</span>';
			} else {
				$sks = '<span class="label label-warning">Gagal UPDATE Data</span>';
			}
		  } else {
			$_a = array_keys($ala);
			$_b = array_values($ala);
			$_c = implode(", ", $_a);
			$_d = "'". implode("', '", $_b) ."'";
			$_e = mysql_query("insert into tb_pasien (". $_c .") values (". $_d .")");
			if($_e){
				$bnr = "";
				$sks = '<span class="label label-info">Sukses Menyimpan Data</span>';
			} else {
				$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
				$bnr = 'style="background:red;color:white"';
			}
		  }
	  }else {
		  $sks = '<span class="label label-warning">No REG Wajib 10 digit</span>';
			$bnr = 'style="background:red;color:white"';
	  }
?>
	<tr <?=@$bnr?>>
		<td><b>Menyimpan: </b><?=@implode(', ', $ala)?></td>
		<td><p class="text-right"><b><?=@$sks?></b></p></td>
	</tr>
<?php
		//DIE();
} 
?>
</table>
<?php } ?>
</body>
</html>
