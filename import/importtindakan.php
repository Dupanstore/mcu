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
			<input name="upload" type="submit" class="btn btn-danger" value="Import Data Tindakan" style="padding:6.5px;">
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
	//print_r($data->val());
	//die();
	for ($i=3; $i<=$baris; $i++)
	{
	  $ala['id_ins_tind'] = $data->val($i, 1);
	  $ala['kd_grouptind'] = $data->val($i, 2);
	  $ala['kd_tind'] = $data->val($i, 3);
	  $ala['nm_tind'] = $data->val($i, 4);
	  $ala['id_user_tind'] = '1';
	  //simpan tindakan
	  $sn = mysql_fetch_array(mysql_query("select * from tb_tindakan where kd_tind='". $ala['kd_tind'] ."'"));
	  if($sn){
		$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
	  } else {
		$_a = array_keys($ala);
		$_b = array_values($ala);
		$_c = implode(", ", $_a);
		$_d = "'". implode("', '", $_b) ."'";
		$_e = mysql_query("insert into tb_tindakan (". $_c .") values (". $_d .")");
		if($_e){
			//ambil id tindakannya
			$id = mysql_fetch_array(mysql_query("select * from tb_tindakan where kd_tind='". $ala['kd_tind'] ."'"));
			$sd = mysql_query("select * from  tb_kelas where view_kel='show' order by id_kel DESC");
			$op = 1;
			while($er = mysql_fetch_array($sd)){
			$po = $op++;
				$num[1][1] = 5;
				$num[1][2] = 6;
				$num[1][3] = 7;
				$num[2][1] = 8;
				$num[2][2] = 9;
				$num[2][3] = 10;
				$num[3][1] = 11;
				$num[3][2] = 12;
				$num[3][3] = 13;
				$num[4][1] = 14;
				$num[4][2] = 15;
				$num[4][3] = 16;
				$num[5][1] = 17;
				$num[5][2] = 18;
				$num[5][3] = 19;
				//jika ada 6 kelas...kalo 5 ya cuma 5 aja ya
				$num[6][1] = 20;
				$num[6][2] = 21;
				$num[6][3] = 22;
				$subtind['id_tind'] = $id['id_tind'];
				$subtind['id_kelas'] = $er['id_kel'];
				$subtind['harg_bahan_tind'] = $data->val($i, $num[$po][1]);
				$subtind['js_rs_tind'] = $data->val($i, $num[$po][2]);
				$subtind['js_pl_tind'] = $data->val($i, $num[$po][3]);
				$subtind['js_pl_lsg_tind'] = '100%';
				$subtind['js_pl_tl_tind'] = '0%';
				$subtind['id_user_tind'] = '1';
				//cek apakah sudah ada tindakan yang tersimpan
				$cek = mysql_fetch_array(mysql_query("select * from tb_tindakan_bayar where id_tind='". $id['id_tind'] ."' and id_kelas='". $er['id_kel'] ."' "));
				if(!$cek){
					//baru simpan
					$_a = array_keys($subtind);
					$_b = array_values($subtind);
					$_c = implode(", ", $_a);
					$_d = "'". implode("', '", $_b) ."'";
					$_e = mysql_query("insert into  tb_tindakan_bayar (". $_c .") values (". $_d .")");
				}
				$sks = '<span class="label label-info">Sukses Menyimpan Data</span>';
			}
		} else {
			$sks = '<span class="label label-warning">Gagal Menyimpan Data</span>';
		}
	 }
?>
	<tr>
		<td><b>Menyimpan: </b><?=@implode(', ', $ala)?> / <?=@implode(', ', $subtind)?></td>
		<td><p class="text-right"><b><?=@$sks?></b></p></td>
	</tr>
<?php	} ?>
</table>
<?php } ?>
</body>
</html>
