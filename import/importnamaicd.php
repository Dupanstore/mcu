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
	$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);
	$sukses = 0;
	$gagal = 0;
	for ($i=1; $i<=$baris; $i++)
	{
		$icd = $data->val($i, 3);
		if(strlen($icd)  > 3){
			$icd  = substr($data->val($i, 3), 0, 3) .'.'. substr($data->val($i, 3), 3, 1);
			//die();
		}
	  $ala['ALIAS'] = SchCleanChar($data->val($i, 2));
	  $buat['ALIAS'] = SchCleanChar($data->val($i, 2));
	  $buat['CODE'] = SchCleanChar($data->val($i, 3));
	 //print_r($ala);
	  //die();
	  $sn = mysql_fetch_array(mysql_query("select * from tb_icd where CODE='". strip_tags(trim($icd)) ."'"));
	  if($sn){
		$srr = is_update('tb_icd', $ala, 'CODE', strip_tags(trim($icd)));
		if($srr){
			$sks = '<span class="label label-info">Sukses UPDATE Data</span>';
		} else {
			$sks = '<span class="label label-warning">Gagal UPDATE Data</span>';
		}
	  } else {
		$sks = '<span class="label label-warning">KODE TIDAK DITEMUKAN DI ICD</span>';
	  }
?>
	<tr>
		<td><b>Menyimpan: </b><?=@implode(', ', $buat)?></td>
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
