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

	for ($i=2; $i<=$baris; $i++)
	{
	  $ala['no_rm_pas'] = $data->val($i, 1);
	  $ala['nm_pas'] = $data->val($i, 2);
	  $ala['tgl_lhr_pas'] = $data->val($i, 3);
	  $ala['jenkel_pas'] = $data->val($i, 4);
	  $ala['agama_pas'] = $data->val($i, 5);
	  $ala['pend_pas'] = $data->val($i, 6);
	  $ala['alamat_pas'] = $data->val($i, 7);
	  $ala['id_desa_pas'] = $data->val($i, 8);
	  $ala['no_ktp_pas'] = $data->val($i, 9);
	  $ala['no_telp_pas'] = $data->val($i, 10);
	  $ala['tgl_daft_pas'] = $data->val($i, 11);
	  $ala['pek_pas'] = $data->val($i, 12);
	  $ala['id_user_pas'] = '1';
	  $sn = mysql_fetch_array(mysql_query("select * from tb_pasien where no_rm_pas='". $ala['no_rm_pas'] ."'"));
	  if($sn){
		$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
	  } else {
		$_a = array_keys($ala);
		$_b = array_values($ala);
		$_c = implode(", ", $_a);
		$_d = "'". implode("', '", $_b) ."'";
		$_e = mysql_query("insert into tb_pasien (". $_c .") values (". $_d .")");
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
