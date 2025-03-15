<html>
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
			<input name="upload" type="submit" class="btn btn-danger" value="Import Data Obat" style="padding:6.5px;">
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

	for ($i=2; $i<=$baris; $i++)
	{
	  $ala['kodebarang'] = $data->val($i, 1);
	  $ala['namabarang'] = $data->val($i, 2);
	  $ala['jenis'] = $data->val($i, 3);
	  $ala['kategori'] = $data->val($i, 4);
	  $ala['pabrik'] = $data->val($i, 5);
	  $ala['satuanbeli'] = $data->val($i, 6);
	  $ala['satuanjual'] = $data->val($i, 7);
	  $ala['konversi'] = $data->val($i, 8);
	  $ala['minimalstok'] = $data->val($i, 9);
	  $ala['hargasatuan'] = $data->val($i, 10);
	  $ala['hpp'] = $data->val($i, 11);
	  $ala['tglmasuk'] = date("Y-m-d H:i:s");
	  $ala['tglupdate'] = date("Y-m-d H:i:s");
	  $ala['id_user'] = '1';
	  $sn = mysql_fetch_array(mysql_query("select * from farm_masterbarang where kodebarang='". $ala['kodebarang'] ."'"));
	  if($sn){
		$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
	  } else {
		$_a = array_keys($ala);
		$_b = array_values($ala);
		$_c = implode(", ", $_a);
		$_d = "'". implode("', '", $_b) ."'";
		$_e = mysql_query("insert into farm_masterbarang (". $_c .") values (". $_d .")");
		if($_e){
			$sks = '<span class="label label-info">Sukses Menyimpan Data</span>';
		} else {
			$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
		}
	  }
?>
	<tr>
		<td><b>Menyimpan: </b><?=@implode(', ', $ala)?></td>
		<td><p class="text-right"><b><?=@$sks?></b></p></td>
	</tr>
<?php	} ?>
</table>
<?php } ?>
</body>
</html>
