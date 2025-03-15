<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
	function bar128($text) {
	echo '<style>
div.b128{
    border-left: 1px #000000 solid;
	height: 50px;
}	
</style>';
$char128asc=' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';					
$char128wid = array(
	'212222','222122','222221','121223','121322','131222','122213','122312','132212','221213', // 0-9 
	'221312','231212','112232','122132','122231','113222','123122','123221','223211','221132', // 10-19 
	'221231','213212','223112','312131','311222','321122','321221','312212','322112','322211', // 20-29 			
	'212123','212321','232121','111323','131123','131321','112313','132113','132311','211313', // 30-39 
	'231113','231311','112133','112331','132131','113123','113321','133121','313121','211331', // 40-49 
	'231131','213113','213311','213131','311123','311321','331121','312113','312311','332111', // 50-59 
	'314111','221411','431111','111224','111422','121124','121421','141122','141221','112214', // 60-69 
	'112412','122114','122411','142112','142211','241211','221114','413111','241112','134111', // 70-79 
	'111242','121142','121241','114212','124112','124211','411212','421112','421211','212141', // 80-89 
	'214121','412121','111143','111341','131141','114113','114311','411113','411311','113141', // 90-99
	'114131','311141','411131','211412','211214','211232','23311120'   );					   // 100-106
  
  $w = $char128wid[$sum = 104];							
  $onChar=1;
  for($x=0;$x<strlen($text);$x++)								
    if (!( ($pos = strpos($char128asc,$text[$x])) === false )){	
	  $w.= $char128wid[$pos];
	  $sum += $onChar++ * $pos;
	}					
  $w.= $char128wid[ $sum % 103 ].$char128wid[106];  		
	 					 						
  $html="<table cellpadding=0 cellspacing=0><tr>";				
  for($x=0;$x<strlen($w);$x+=2)   						
	$html .= "<td><div class=\"b128\" style=\"border-left-width:{$w[$x]};width:{$w[$x+1]}\"></div>";	
  return "$html<tr><td  colspan=".strlen($w)." align=center><font family=arial size=6>$text<b></table>";		
}


function bar456($text) {
$char128asc=' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';					
$char128wid = array(
	'212222','222122','222221','121223','121322','131222','122213','122312','132212','221213', // 0-9 
	'221312','231212','112232','122132','122231','113222','123122','123221','223211','221132', // 10-19 
	'221231','213212','223112','312131','311222','321122','321221','312212','322112','322211', // 20-29 			
	'212123','212321','232121','111323','131123','131321','112313','132113','132311','211313', // 30-39 
	'231113','231311','112133','112331','132131','113123','113321','133121','313121','211331', // 40-49 
	'231131','213113','213311','213131','311123','311321','331121','312113','312311','332111', // 50-59 
	'314111','221411','431111','111224','111422','121124','121421','141122','141221','112214', // 60-69 
	'112412','122114','122411','142112','142211','241211','221114','413111','241112','134111', // 70-79 
	'111242','121142','121241','114212','124112','124211','411212','421112','421211','212141', // 80-89 
	'214121','412121','111143','111341','131141','114113','114311','411113','411311','113141', // 90-99
	'114131','311141','411131','211412','211214','211232','23311120'   );					   // 100-106
  
  $w = $char128wid[$sum = 104];							
  $onChar=1;
  for($x=0;$x<strlen($text);$x++)								
    if (!( ($pos = strpos($char128asc,$text[$x])) === false )){	
	  $w.= $char128wid[$pos];
	  $sum += $onChar++ * $pos;
	}					
  $w.= $char128wid[ $sum % 103 ].$char128wid[106];  		
	 					 						
  $html="<table cellpadding=0 cellspacing=0><tr>";				
  for($x=0;$x<strlen($w);$x+=2){   						
	$html .= "<td><div class=\"b128\" style=\"height: 40px;border-left: 1px #000000 solid;border-left-width:{$w[$x]};width:{$w[$x+1]}\"></div></td>";	
  }
  $html .= '</tr></table>';
 return $html;		
}

if( ! function_exists('is_get_sn')){
	function is_get_sn(){
			$duit = "322b43eaaaa7a47b6567a8813eeba92e";
			return $duit;
	}
}
	if ( !function_exists('SchCleanChar') ){
		function SchCleanChar($result) {
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
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
	if ( !function_exists('nggolaporan') ){
		function nggolaporan($result) {
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
			//$result = preg_replace('/\s+/', ' ', $result);
			//$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
			$result = preg_replace('|-+|', ' ', $result);
			//$result = preg_replace('/&#?[a-z0-9]+;/i', ' ',$result);
			//$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
			$result = trim($result, ' ');
			$result	= str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), "", $result);
			return $result;
		}
	}
	if ( !function_exists('buat_nama_excel') ){
		function buat_nama_excel($result) {
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
			$result = preg_replace('/\s+/', ' ', $result);
			$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
			$result = preg_replace('|-+|', ' ', $result);
			$result = preg_replace('/&#?[a-z0-9]+;/i', ' ',$result);
			$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
			$result = trim($result, ' ');
			$result	= str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), "_", $result);
			return $result;
		}
	}
	if ( !function_exists('bersihkanbung') ){
		function bersihkanbung($result) {
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
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
	if ( !function_exists('bersihkanangka') ){
		function bersihkanangka($result) {
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
			$result = preg_replace('/\s+/', ' ', $result);
			$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
			$result = preg_replace('|-+|', ' ', $result);
			$result = preg_replace('/&#?[a-z0-9]+;/i', ' ',$result);
			$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
			$result = trim($result, '');
			$result	= str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), "", $result);
			return $result;
		}
	}

function is_jenis_pengajuan($cug = false)
{
	$sat = array(
		0 => 'Belum Diproses',
		1 => 'Diajukan',
		3 => 'Menunggu Verifikasi Kasi',
		5 => 'Menunggu Verifikasi Ka.Penunjang',
		7 => 'Menunggu Verifikasi Ka.Sie Bendahara',
		9 => 'Menunggu Verifikasi Ka.Bid.Keuangan',
		11 => 'Menunggu Pencairan Anggaran',
		13 => 'Terima Anggaran',
		15 => 'Proses Pembelian',
		17 => 'Proses Inventarisasi',
		19 => 'BAP',
		21 => 'Selesai'
	);
	if ($cug != "") {
		return $sat[$cug];
	} else {
		return $sat;
	}
}

function is_jenis_attribut($cug = false)
{
	$sat = array(
		2 => 'textfield',
		3 => 'Textarea',
		4 => 'Combobox',
		5 => 'Date',
	);
	if ($cug != "") {
		return $sat[$cug];
	} else {
		return $sat;
	}
}

function is_jenis_renbhp($cug = false)
{
	$sat = array(
		0 => 'Belum Diproses',
		1 => 'Menunggu Verifikasi Ka.Sie Akuntansi',
		3 => 'Menunggu Verifikasi Ka.Bid.Keuangan',
		5 => 'Menunggu Verifikasi Ka.Sie Bendahara',
		7 => 'Menunggu Pencairan Anggaran',
		9 => 'Terima Anggaran',
		11 => 'Proses Penerimaan',
		13 => 'BAP',
		15 => 'Selesai',
	);
	if ($cug != "") {
		return $sat[$cug];
	} else {
		return $sat;
	}
}

function is_jenis_pperbhp($cug = false)
{
	$sat = array(
		0 => 'Belum Diproses',
		1 => 'Proses Permintaan',
		2 => 'Belum Lengkap',
		3 => 'Sudah Lengkap'
	);
	if ($cug != "") {
		return $sat[$cug];
	} else {
		return $sat;
	}
}
	
function is_jenis_logistik($cug = "")
{
	$sat = array(
		'A' => 'Aset',
		'B' => 'BHP',
	);
	if ($cug != "") {
		return $sat[$cug];
	} else {
		return $sat;
	}
}
function get_umur_jg($str, $option=""){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day-1, $year);
	//$now = time();
	if($option != ""){
		$now = mktime(date("H", strtotime($option)), date("i", strtotime($option)), date("s", strtotime($option)), date("m", strtotime($option)), date("d", strtotime($option)), date("Y", strtotime($option)));
	}else {
		$now = time();
	}
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	array('name'=>'HR', 'amount' => 60*60*24),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
}   

function get_umur_tahun($str, $option=""){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day-1, $year);
	//$now = time();
	if($option != ""){
		$now = mktime(date("H", strtotime($option)), date("i", strtotime($option)), date("s", strtotime($option)), date("m", strtotime($option)), date("d", strtotime($option)), date("Y", strtotime($option)));
	}else {
		$now = time();
	}
	$blocks = array(
	array('name'=>'th', 'amount' => 60*60*24*365),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
} 

function get_umur_hitung_ringkes($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
}  

function get_umur_ringkes_pisan($str, $option=""){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day-1, $year);
	//$now = time();
	if($option != ""){
		$now = mktime(date("H", strtotime($option)), date("i", strtotime($option)), date("s", strtotime($option)), date("m", strtotime($option)), date("d", strtotime($option)), date("Y", strtotime($option)));
	}else {
		$now = time();
	}
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
}  
function cek_bmi($fd){
		if($fd < 17){
			$fs = "Sangat Kurus";
		} else if($fd >= 17 AND $fd < 18.5){
			$fs = "Kurus";
		} else if($fd >= 18.5 AND $fd <= 24.99){
			$fs = "Normal";
		} else if($fd >= 25.0 AND $fd <= 29.99){
			$fs = "Gemuk";
		} else if($fd >= 30.0 AND $fd <= 34.99){
			$fs = "Obesitas level I";
		} else if($fd >= 35.0 AND $fd <= 39.99){
			$fs = "Obesitas level II";
		} else if($fd >= 40){
			$fs = "Obesitas level III";
		} else {
			$fs = "-";	
		}
		return $fs;
	}
function selisih_tanggal($tglawal, $tglakhir){
  $tglawal1 = date("Y-m-d", strtotime($tglawal));
  $date1=$tglawal1;
  $date2=$tglakhir;
  $datetime1 = new DateTime($date1);
  $datetime2 = new DateTime($date2);
  $difference = $datetime1->diff($datetime2);
  return $difference->days;
}
	function bantai($url){
				 $data = curl_init();
				 curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
				 curl_setopt($data, CURLOPT_URL, $url);
				 $hasil = curl_exec($data);
				 curl_close($data);
				 return $hasil;
		}
	if ( !function_exists('typedaftar') ){
		function typedaftar($result=false) {
			$type = array("UMUM" => "UMUM", "KB" => "KB", "IMUNINASI" => "IMUNINASI");
			if($result){
				return $type[$result];
			} else {
				return $type;
			}
		} 
	}
	if( ! function_exists('ummuValidationInput'))
	{
		function ummuValidationInput($getPost, $getName, $valMin=2, $valMax=50){
			if (empty($getPost) OR strlen($getPost) < $valMin OR strlen($getPost) > $valMax){
						echo $getName . ' harus diisi, minimal '. $valMin .' karakter, maksimal '. $valMax .' karakter';
						die();
				}
		}
	}

	if( ! function_exists('ummuValidationCombo'))
	{
		function ummuValidationCombo($getPost, $getName){
			if (empty($getPost)){
						echo $getName . ' tidak boleh kosong';
						die();
				}
		}
	}

	if( ! function_exists('ummuKuduPodho'))
	{
		function ummuKuduPodho($post1, $post2, $pesan){
			if ($post1 != $post2){
						echo $pesan . ' tidak sama';
						die();
				}
		}
	}

if( ! function_exists('is_jenkel')){
	function is_jenkel($kel=false){
		$kl = array ('L' => 'Laki-laki', 'P' => 'Perempuan');
		$klo = $kel == true ? $kl[$kel] : $kl;
		return $klo;
	}
}
if( ! function_exists('is_rupiah')){
	function is_rupiah($r){
			$duit = "Rp " . number_format($r,2,',','.');
			return $duit;
	}
	
	
}

if( ! function_exists('is_rupiah_kosong')){
	function is_rupiah_kosong($r){
			$duit = number_format($r,2,',','.');
			return $duit;
	}
	
	
}
if( ! function_exists('dibulatkan')){
	function dibulatkan($r){
		//berarti yang pertama
		$snn = strlen($r)-3;
		//jika selisih sama dengan 1000 berarti ya ga usah
		$tigaangka = substr($r, $snn, 3);
		$penambahan = 1000-$tigaangka;
		if($penambahan < 1000){
			$ssd = $r+$penambahan;
		} else {
			$ssd = $r;
		}
		return $ssd;
	}
}

if( ! function_exists('is_try_sn')){
	function is_try_sn(){
			$duit = "322b43eaaaa7a47b6567a8813eeba92e";
			return $duit;
	}
}

if( ! function_exists('is_koma')){
	function is_koma($r){
			$duit = "Rp " . number_format($r,2,',','.');
			return $duit;
	}
}
if( ! function_exists('is_tanpanol')){
	function is_tanpanol($r){
			$duit = number_format($r,0,',','.');
			return $duit;
	}
}
if( ! function_exists('is_dua_koma')){
	function is_dua_koma($r, $d=false){
			$duit = number_format($r,0,',','.');
			//$duit = $r;
			if($d == true){
				if($d == 'excel'){
					return $r;
				} else {
					return $duit;
				}
			} else {
				return $duit;
			}
	}
}

if( ! function_exists('is_no_rp')){
	function is_no_rp($r, $d=false){
			$duit = number_format($r,0,',','.');
			//$duit = $r;
			if($d == true){
				if($d == 'excel'){
					return $r;
				} else {
					return $duit;
				}
			} else {
				return $duit;
			}
	}
}

if( ! function_exists('is_buat_cetak')){
	function is_buat_cetak($r, $d=false){
			$duit = number_format($r,0,',','.');
			//$duit = $r;
			if($d == true){
				if($d == 'excel'){
					return $r;
				} else {
					return $duit;
				}
			} else {
				return $duit;
			}
	}
}

if( ! function_exists('is_disabled_angka')){
	function is_disabled_angka($r, $d=false){
			return "--";
	}
}

if( ! function_exists('is_kanan')){
	function is_kanan($r){
			return '<div align="right">'. $r .'</div>';
	}
}

if( ! function_exists('is_tengah')){
	function is_tengah($r){
			return '<div align="center">'. $r .'</div>';
	}
}
if( ! function_exists('is_kiri')){
	function is_kiri($r){
			return '<div align="left">'. $r .'</div>';
	}
}

function inacbg_kel($kel){
	$_kel = array ('kelas_1' => 'Kelas I', 'kelas_2' => 'Kelas II', 'kelas_3' => 'Kelas III');
	return $_kel[$kel];
}
function status_barang(){
	$_kel = array ('Tersedia', 'Proses', 'Dipinjam', 'Hilang');
	return $_kel;
}
function masa_berlaku_pil($fsf=false){
	$_kel = array ('exp' => 'Sudah tidak Berlaku', '1' => 'Kurang dari 1 Bulan', '2' => 'Kurang dari 2 Bulan', '3' => 'Kurang dari 3 Bulan', '4' => 'Kurang dari 4 Bulan', '5' => 'Kurang dari 5 Bulan', '6' => 'Kurang dari 6 Bulan', '7' => 'Kurang dari 7 Bulan', '8' => 'Kurang dari 8 Bulan', '9' => 'Kurang dari 9 Bulan', '10' => 'Kurang dari 10 Bulan');
	if($fsf == false){
		return $_kel;
	} else {
		return $_kel[$fsf];
	}
}
function is_hari($s){
	$hari = array (0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	return $hari[$s];
}
function new_hari($s){
	$hari = array (0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	return $hari[$s];
}
function get_hari(){
	$hari = array (0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	return $hari;
}
function get_hari_aktif(){
	$hari = array (0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	return $hari;
}
function type_kondisi(){
	$hari = array ('Kondisi Masuk', 'Kondisi Keluar', 'Kondisi Masuk & Keluar');
	return $hari;
}
function att_barang(){
	$hari = array ('Kamera', 'Sayap', 'Laptop Lapangan', 'Baterai', 'Charger Baterai');
	return $hari;
}
if( ! function_exists('font_family')){
	function font_family(){
			$sss = array('Arial', 'Arial Narrow', 'Arial Unicode MS', 'Cataneo BT', 'Comic Sans MS', 'Courier', 'Courier New', 'Cursive', 'Dauphin', 'Georgia', 'Helvetica', 'Helvetica Neue', 'Lucida', 'Lucida Console', 'Lucida Sans', 'Monospace', 'Monotype Corsiva', 'Sans serif', 'Sans-serif', 'MS Sans serif', 'Square721 BT', 'Tahoma', 'Times New Roman', 'Trebuchet', 'Trebuchet MS', 'Frutiger', 'Droid Serif', 'Geneva', 'Fantasy', 'Palatino Linotype', 'Impact');
			return $sss;
	}
}

if( ! function_exists('the_time'))
{
	function the_time($time){
		$a = array ('01' => 'Januari',
			'02' => 'Febuari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
			'13' => '',
		);
		$getTime 	= explode (" ", $time);
		$getTime1 	= explode ("-", $getTime[0]);
		$getTime2	= $getTime1[2] .' '. $a[$getTime1[1]] .' '. $getTime1[0] .' '. $getTime[1];
		return $getTime2;
	}
}

if( ! function_exists('the_timedua'))
{
	function the_timedua($time){
		$a = array ('01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Ags',
			'09' => 'Sept',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
			'13' => '',
		);
		$getTime 	= explode (" ", $time);
		$getTime1 	= explode ("-", $getTime[0]);
		$getTime2	= $getTime1[2] .'-'. $a[$getTime1[1]] .'-'. $getTime1[0] .' '. $getTime[1];
		return $getTime2;
	}
}

if( ! function_exists('the_bulan_simple'))
{
	function the_bulan_simple($time=false){
		$a = array ('01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agst',
			'09' => 'Sept',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		);
		return $time == false ? $a : $a[$time];
	}
}
if( ! function_exists('the_bulan'))
{
	function the_bulan($time=false){
		$a = array ('01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		return $time == false ? $a : $a[$time];
	}
}

if( ! function_exists('the_bulan_rk'))
{
	function the_bulan_rk($time=false){
		$a = array ('1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		return $time == false ? $a : $a[$time];
	}
}

if( ! function_exists('is_organisasi'))
{
	function is_organisasi(){
		$clean = array(1 => 'Menyusun jadwal dinas', 'Memimpin operan', 'Supervisi Ka Ruang ke Ka Team', 'Supervisi Ka ruang ke PP', 'Supervisi Ka Team ke PP', 'Evaluasi IMKK', 'Audit Dokumen', 'Survey kepuasan pelanggan', 'Survey kepuasan perawat', 'Survey masalah kesehatan', 'Menilai kinerja staf perawatan', 'Memimpin rapat keperawatan', 'Memimpin case converence');
		return $clean;
	}
}
if( ! function_exists('is_pelayanan'))
{
	function is_pelayanan(){
		$clean = array(1 => 'Operan Jaga', 'Morning meeting', 'Pre Converence', 'Post Converence');
		return $clean;
	}
}
if( ! function_exists('clean_data'))
{
	function clean_data($dat){
		$clean = strip_tags(trim($dat));
		$clean = str_replace("'-", "", $clean);
		$clean = str_replace("'", "", $clean);
		return $clean;
	}
}


function get_time($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'Tahun', 'amount' => 60*60*24*365),
	array('name'=>'Bulan', 'amount' => 60*60*24*31),
	array('name'=>'Minggu', 'amount' => 60*60*24*7),
	array('name'=>'Hari', 'amount' => 60*60*24),
	array('name'=>'Jam', 'amount' => 60*60),
	array('name'=>'Menit', 'amount' => 60),
	array('name'=>'Detik', 'amount' => 1)
	);

	if($timestamp > $now) $string_type = ' tersisa';
	else $string_type = ' '.'yang lalu';

	$diff = abs($now-$timestamp);

	if($option=='smsd_check')
	{
		return $diff;	
	}
	else
	{
		if($diff < 60)
		{
			return "Kurang dari satu menit yang lalu";
		}
		else
		{
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($current_level > $levels) { break; }
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result).''.$string_type;
			return $res;
		}
	}	
}   


function get_selisih_jam($str, $akhir, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//untuk 
	
	list($tanggal, $jam) = explode(' ', $akhir);
	list($tahun, $bulan, $hari) = explode('-', $tanggal);
	list($jame, $menite, $detike) = explode(':', $jam);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = mktime($jame, $menite, $detike, $bulan, $hari, $tahun);
	$blocks = array(
	array('name'=>'M', 'amount' => 60),
	array('name'=>'D', 'amount' => 1)
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			$sjd = explode(" ", $res);
			if($sjd[1] == "M"){
				$ndbff = $sjd[0];
				if($sjd[2] >= 30){
					$ndbff = $ndbff+1;
				}
				return $ndbff;
			}else{
				$gdbbnf = 0;
				if($sjd[0] >= 30){
					$gdbbnf = 1;
				}
				return $gdbbnf;
			}
			
} 


function get_umur($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'Tahun', 'amount' => 60*60*24*365),
	array('name'=>'Bulan', 'amount' => 60*60*24*31),
	array('name'=>'Hari', 'amount' => 60*60*24)
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			return $res;
}  

function get_umur_gelang($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'thn', 'amount' => 60*60*24*365),
	array('name'=>'bln', 'amount' => 60*60*24*31),
	array('name'=>'hari', 'amount' => 60*60*24)
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			return $res;
}  

function get_umur_rekap($str, $akhir, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//untuk 
	
	list($tanggal, $jam) = explode(' ', $akhir);
	list($tahun, $bulan, $hari) = explode('-', $tanggal);
	list($jame, $menite, $detike) = explode(':', $jam);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = mktime($jame, $menite, $detike, $bulan, $hari, $tahun);
	$blocks = array(
	array('name'=>'', 'amount' => 60*60*24*365),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
} 

function get_sisa_garansi($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:01';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day+1, $year);
	$now = time(date("Y-m-d") ." 00:00:00");
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	array('name'=>'HR', 'amount' => 60*60*24),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			if(date("Ymd", strtotime($str)) > date("Ymd")){
				return $res;
			} else {
				return '-';
			}
}   
function get_telahdipakai($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:01';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day+1, $year);
	$now = time(date("Y-m-d") ." 00:00:00");
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	array('name'=>'HR', 'amount' => 60*60*24),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
} 


function getselisihmenit($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:01';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time(date("Y-m-d") ." 00:00:00");
	$blocks = array(
	//array('name'=>'TH', 'amount' => 60*60*24*365),
	//array('name'=>'BL', 'amount' => 60*60*24*31),
	array('name'=>'', 'amount' => 60),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
			
}  

function get_umur_hitung($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	//array('name'=>'BL', 'amount' => 60*60*24*31),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
}  
function get_umur_ranap($str, $option=NULL){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	if($time == ''){
		$time = '00:00:00';
	}
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	$now = time();
	$blocks = array(
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	);

	$diff = abs($now-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(' ',$result);
			return $res;
} 

function get_selisih($str, $akhir){
	// convert the date to unix timestamp
	list($tgll, $jamm) = explode(' ', $str);
	if($jamm == ''){
		$jamm = '00:00:00';
	}
	$str = date("Y-m-d", strtotime($str)) ." ". $jamm;
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//rubah tanggala akhir
	list($tgl, $waktu) = explode(' ', $akhir);
	list($thn, $bln, $hr) = explode('-', $tgl);
	list($jam, $mnit, $dtik) = explode(':', $waktu);
	$skrg  		= mktime($jam, $mnit, $dtik, $bln, $hr, $thn);
	$timestamp 	= mktime($hour, $minute, $second, $month, $day-1, $year);
	//$now = time();
	$blocks = array(
	array('name'=>'Hari', 'amount' => 60*60*24),
	array('name'=>'Jam', 'amount' => 60*60),
	);

	$diff = abs($skrg-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			//return $result;
			if(count($result) == '1'){
				$sd = explode(' ', $result[0]);
				if($sd[1] == 'Hari'){
					if($sd[0] == '1'){
						$result[0] = "0 Hari";
					}
					$result[1] = '0 Jam';
					return $result;
				} else {
					return $result;
				}
			} else if(count($result) == '2'){
				$sd = explode(' ', $result[0]);
				if($sd[1] == 'Hari'){
					if($sd[0] == '1'){
						$result[0] = $result[1];
						unset($result[1]);
					}
				}
				return $result;
			} else {
				return $result;
			}
}   




function keperluan_cek_awal_jam_akom($str, $akhir){
	// convert the date to unix timestamp
	list($tgll, $jamm) = explode(' ', $str);
	if($jamm == ''){
		$jamm = '00:00:00';
	}
	$str = date("Y-m-d", strtotime($str)) ." ". $jamm;
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//rubah tanggala akhir
	list($tgl, $waktu) = explode(' ', $akhir);
	list($thn, $bln, $hr) = explode('-', $tgl);
	list($jam, $mnit, $dtik) = explode(':', $waktu);
	$skrg  		= mktime($jam, $mnit, $dtik, $bln, $hr, $thn);
	$timestamp 	= mktime($hour, $minute, $second, $month, $day, $year);
	//$now = time();
	$blocks = array(
	array('name'=>'', 'amount' => 60*60),
	);

	$diff = abs($skrg-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			return trim($res);
			
}   



function get_akomodasi_pasien($umiiii, $akhir){
	// convert the date to unix timestamp
	$jamsatu = 0;
	$ci =& get_instance();	
	$pem = $ci->madmin->get_setting('akomodasi_dihitung_setelah_lebih_dari');
	$cekpertama = keperluan_cek_awal_jam_akom($umiiii, $akhir);
	if(trim($cekpertama) > $jamsatu){
		$jamsatu = $cekpertama;
	}
	
	if($jamsatu < $pem){
		$result[0] = "0 Jam";
		return $result;
	} else {
		$str = date("Y-m-d", strtotime($umiiii)) ." 00:00:00";
		//$str = date("Y-m-d H:i:s", strtotime($umiiii));
		list($date, $time) = explode(' ', $str);
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		//rubah tanggala akhir
		list($tgl, $waktu) = explode(' ', $akhir);
		list($thn, $bln, $hr) = explode('-', $tgl);
		list($jam, $mnit, $dtik) = explode(':', $waktu);
		$skrg  		= mktime($jam, $mnit, $dtik, $bln, $hr, $thn);
		//nah kita main main disini yaaa
		if(date("His", strtotime($umiiii)) > 120000 AND date("His", strtotime($akhir)) < 150001){
			$defaulttmbh = 0;
		} else if(date("His", strtotime($umiiii)) < 120000 AND date("His", strtotime($akhir)) > 150000){
			$defaulttmbh = 2;
		}else {
			$defaulttmbh = 1;
		}
		$timestamp 	= mktime($hour, $minute, $second, $month, $day-$defaulttmbh, $year);
		//$now = time();
		$blocks = array(
		array('name'=>'Hari', 'amount' => 60*60*24),
		array('name'=>'Jam', 'amount' => 60*60),
		);

		$diff = abs($skrg-$timestamp);
				$levels = 1;
				$current_level = 1;
				$result = array();
				foreach($blocks as $block)
				{
					if ($diff/$block['amount'] >= 1)
					{
						$amount = floor($diff/$block['amount']);
						$plural = '';
						//if ($amount>1) {$plural='s';} else {$plural='';}
						$result[] = $amount.' '.$block['name'].$plural;
						$diff -= $amount*$block['amount'];
						$current_level+=1;	
					}
				}
				$res = implode(', ',$result);
				//return $result;
				if(count($result) == '1'){
					$sd = explode(' ', $result[0]);
					if($sd[1] == 'Hari'){
						if($sd[0] == '1'){
							$result[0] = "0 Hari";
						}
						$result[1] = '0 Jam';
					} 
				} else if(count($result) == '2'){
					$sd = explode(' ', $result[0]);
					if($sd[1] == 'Hari'){
						if($sd[0] == '1'){
							$result[0] = $result[1];
							unset($result[1]);
						}
					}
					
				}
				//selanjutnya adalah cek kalo pasien pulang pagiiiiiiiiiiiii
				if(count($result) == '1'){
					$xd = explode(' ', $result[0]);
					if($xd[1] == 'Jam'){
						$result[0] = $cekpertama . " Jam";
					} 
				} 
				return $result;
	}
}  

function jumlah_akomodasi($sel, $setjam, $statuspindahberduang){
					if($sel == false){
						$hari = 0;
					} else {
						if(count($sel) == 2){
							$mks = strip_tags(trim(str_replace(" Hari", "", $sel[0])));
							$hari = $mks;
						} else{
							$jhg = strip_tags(trim(str_replace(" Jam", "", $sel[0])));
							if($jhg >= $setjam){
								$hari = 1;
							} else {
								$hari = 0;
							}
						}
					}
					//maksude nek pindah ruang apa bed jumalh harine dikurangi 1;
					if(!empty($statuspindahberduang)){
						if($hari >= 1){
							$hari = $hari-1;
						}
					}
					return $hari;
				}
function get_expired($str, $akhir){
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//rubah tanggala akhir
	list($tgl, $waktu) = explode(' ', $akhir);
	list($thn, $bln, $hr) = explode('-', $tgl);
	list($jam, $mnit, $dtik) = explode(':', $waktu);
	$skrg  		= mktime($jam, $mnit, $dtik, $bln, $hr, $thn);
	$timestamp 	= mktime($hour, $minute, $second, $month, $day, $year);
	//$now = time();
	$blocks = array(
	array('name'=>'', 'amount' => 60*60*24),
	);

	$diff = abs($skrg-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			return trim($res);
}  

if( ! function_exists('is_new_sn')){
	function is_new_sn(){
		if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir c:'), $m)) {
		$volname = ' ('.$m[1].')';
		$serial = str_replace("(","",str_replace(")","",$volname));
		return  md5('VIKOSHA-'. $serial);
		}
	}
}

if( ! function_exists('is_ringtone'))
	{
		function is_ringtone(){
			$dir    = 'ringtone';
			$files = scandir($dir, 1);
			$data['silent'] = 'silent';
			foreach ($files as $key=>$val){
				if($val != '..' AND $val != '.'){
					$data[$val] = $val;
				}
			}
			return $data;	
		}
	}

function is_encript($s){
	$x = 'vikoshaperdana'. md5(md5(md5(md5($s) .'vikosha') .'Perdana') .'encript by smoker') . md5($s);
	return $x;
}

function is_spasi($s){
	$ssd = '';
	for($q=1;$q<=$s;$q++){
		$ssd .= '&nbsp;';
	}
	return $ssd;
}

function terbilang_get_valid($str,$from,$to,$min=1,$max=9){
	$val=false;
	$from=($from<0)?0:$from;
	for ($i=$from;$i<$to;$i++){
		if (((int) $str{$i}>=$min)&&((int) $str{$i}<=$max)) $val=true;
	}
	return $val;
}
function terbilang_get_str($i,$str,$len){
	$numA=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
	$numB=array("","se","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
	$numC=array("","satu ","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
	$numD=array(0=>"puluh",1=>"belas",2=>"ratus",4=>"ribu", 7=>"juta", 10=>"milyar", 13=>"triliun");
	$buf="";
	$pos=$len-$i;
	switch($pos){
		case 1:
				if (!terbilang_get_valid($str,$i-1,$i,1,1))
					$buf=$numA[(int) $str{$i}];
			break;
		case 2:	case 5: case 8: case 11: case 14:
				if ((int) $str{$i}==1){
					if ((int) $str{$i+1}==0)
						$buf=($numB[(int) $str{$i}]).($numD[0]);
					else
						$buf=($numB[(int) $str{$i+1}]).($numD[1]);
				}
				else if ((int) $str{$i}>1){
						$buf=($numB[(int) $str{$i}]).($numD[0]);
				}				
			break;
		case 3: case 6: case 9: case 12: case 15:
				if ((int) $str{$i}>0){
						$buf=($numB[(int) $str{$i}]).($numD[2]);
				}
			break;
		case 4: case 7: case 10: case 13:
				if (terbilang_get_valid($str,$i-2,$i)){
					if (!terbilang_get_valid($str,$i-1,$i,1,1))
						$buf=$numC[(int) $str{$i}].($numD[$pos]);
					else
						$buf=$numD[$pos];
				}
				else if((int) $str{$i}>0){
					if ($pos==4)
						$buf=($numB[(int) $str{$i}]).($numD[$pos]);
					else
						$buf=($numC[(int) $str{$i}]).($numD[$pos]);
				}
			break;
	}
	return $buf;
}
function toTerbilang($nominal){
	$nom = explode('.',$nominal);
	$nominal = $nom[0];
	$buf=" ";
	$str=$nominal."";
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	$b = '';
	if($nom[1]){
		$a = $nom[1];
		$b = " koma ";
		$c = $a."";
		$d = strlen($c);
		for ($e=0;$e<$d;$e++){
			$b=$b." ".terbilang_get_str($e,$c,$d);
		}
	}
	//print_r ($nominal[0]);
	return ucwords(trim($buf)) ." ".  ucwords(trim($b)) . ' Rupiah';
}
function toTerbilang_qty($nominal){
	$nom = explode('.',$nominal);
	$nominal = $nom[0];
	$buf=" ";
	$str=$nominal."";
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	$b = '';
	if($nom[1]){
		$a = $nom[1];
		$b = " koma ";
		$c = $a."";
		$d = strlen($c);
		for ($e=0;$e<$d;$e++){
			$b=$b." ".terbilang_get_str($e,$c,$d);
		}
	}
	//print_r ($nominal[0]);
	return ucwords(trim($buf)) ."".  ucwords(trim($b)) . '';
}

function alasankeluar($ss=false){
	$kel = array('Kabur' => 'Kabur', 'Dirujuk' => 'Dirujuk', 'Persetujuan Dokter' => 'Persetujuan Dokter', 'Atas Permintaan Sendiri' => 'Atas Permintaan Sendiri', 'Meninggal' => 'Meninggal');
	if($ss){
	return $kel[$ss];
	} else {
		return $kel;
	}
}

function level_akun($ss=false){
		$kel = array ('Account Group', 'Account');
		if($ss){
		return $kel[$ss];
		} else {
			return $kel;
		}
}

function timezones($sw=false){
	$timezones = array (
		  '(GMT-12:00) International Date Line West' => 'Pacific/Wake',
		  '(GMT-11:00) Midway Island' => 'Pacific/Apia',
		  '(GMT-11:00) Samoa' => 'Pacific/Apia',
		  '(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
		  '(GMT-09:00) Alaska' => 'America/Anchorage',
		  '(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana' => 'America/Los_Angeles',
		  '(GMT-07:00) Arizona' => 'America/Phoenix',
		  '(GMT-07:00) Chihuahua' => 'America/Chihuahua',
		  '(GMT-07:00) La Paz' => 'America/Chihuahua',
		  '(GMT-07:00) Mazatlan' => 'America/Chihuahua',
		  '(GMT-07:00) Mountain Time (US &amp; Canada)' => 'America/Denver',
		  '(GMT-06:00) Central America' => 'America/Managua',
		  '(GMT-06:00) Central Time (US &amp; Canada)' => 'America/Chicago',
		  '(GMT-06:00) Guadalajara' => 'America/Mexico_City',
		  '(GMT-06:00) Mexico City' => 'America/Mexico_City',
		  '(GMT-06:00) Monterrey' => 'America/Mexico_City',
		  '(GMT-06:00) Saskatchewan' => 'America/Regina',
		  '(GMT-05:00) Bogota' => 'America/Bogota',
		  '(GMT-05:00) Eastern Time (US &amp; Canada)' => 'America/New_York',
		  '(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
		  '(GMT-05:00) Lima' => 'America/Bogota',
		  '(GMT-05:00) Quito' => 'America/Bogota',
		  '(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
		  '(GMT-04:00) Caracas' => 'America/Caracas',
		  '(GMT-04:00) La Paz' => 'America/Caracas',
		  '(GMT-04:00) Santiago' => 'America/Santiago',
		  '(GMT-03:30) Newfoundland' => 'America/St_Johns',
		  '(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
		  '(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
		  '(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
		  '(GMT-03:00) Greenland' => 'America/Godthab',
		  '(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
		  '(GMT-01:00) Azores' => 'Atlantic/Azores',
		  '(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
		  '(GMT) Casablanca' => 'Africa/Casablanca',
		  '(GMT) Edinburgh' => 'Europe/London',
		  '(GMT) Greenwich Mean Time : Dublin' => 'Europe/London',
		  '(GMT) Lisbon' => 'Europe/London',
		  '(GMT) London' => 'Europe/London',
		  '(GMT) Monrovia' => 'Africa/Casablanca',
		  '(GMT+01:00) Amsterdam' => 'Europe/Berlin',
		  '(GMT+01:00) Belgrade' => 'Europe/Belgrade',
		  '(GMT+01:00) Berlin' => 'Europe/Berlin',
		  '(GMT+01:00) Bern' => 'Europe/Berlin',
		  '(GMT+01:00) Bratislava' => 'Europe/Belgrade',
		  '(GMT+01:00) Brussels' => 'Europe/Paris',
		  '(GMT+01:00) Budapest' => 'Europe/Belgrade',
		  '(GMT+01:00) Copenhagen' => 'Europe/Paris',
		  '(GMT+01:00) Ljubljana' => 'Europe/Belgrade',
		  '(GMT+01:00) Madrid' => 'Europe/Paris',
		  '(GMT+01:00) Paris' => 'Europe/Paris',
		  '(GMT+01:00) Prague' => 'Europe/Belgrade',
		  '(GMT+01:00) Rome' => 'Europe/Berlin',
		  '(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
		  '(GMT+01:00) Skopje' => 'Europe/Sarajevo',
		  '(GMT+01:00) Stockholm' => 'Europe/Berlin',
		  '(GMT+01:00) Vienna' => 'Europe/Berlin',
		  '(GMT+01:00) Warsaw' => 'Europe/Sarajevo',
		  '(GMT+01:00) West Central Africa' => 'Africa/Lagos',
		  '(GMT+01:00) Zagreb' => 'Europe/Sarajevo',
		  '(GMT+02:00) Athens' => 'Europe/Istanbul',
		  '(GMT+02:00) Bucharest' => 'Europe/Bucharest',
		  '(GMT+02:00) Cairo' => 'Africa/Cairo',
		  '(GMT+02:00) Harare' => 'Africa/Johannesburg',
		  '(GMT+02:00) Helsinki' => 'Europe/Helsinki',
		  '(GMT+02:00) Istanbul' => 'Europe/Istanbul',
		  '(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
		  '(GMT+02:00) Kyiv' => 'Europe/Helsinki',
		  '(GMT+02:00) Minsk' => 'Europe/Istanbul',
		  '(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
		  '(GMT+02:00) Riga' => 'Europe/Helsinki',
		  '(GMT+02:00) Sofia' => 'Europe/Helsinki',
		  '(GMT+02:00) Tallinn' => 'Europe/Helsinki',
		  '(GMT+02:00) Vilnius' => 'Europe/Helsinki',
		  '(GMT+03:00) Baghdad' => 'Asia/Baghdad',
		  '(GMT+03:00) Kuwait' => 'Asia/Riyadh',
		  '(GMT+03:00) Moscow' => 'Europe/Moscow',
		  '(GMT+03:00) Nairobi' => 'Africa/Nairobi',
		  '(GMT+03:00) Riyadh' => 'Asia/Riyadh',
		  '(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
		  '(GMT+03:00) Volgograd' => 'Europe/Moscow',
		  '(GMT+03:30) Tehran' => 'Asia/Tehran',
		  '(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
		  '(GMT+04:00) Baku' => 'Asia/Tbilisi',
		  '(GMT+04:00) Muscat' => 'Asia/Muscat',
		  '(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
		  '(GMT+04:00) Yerevan' => 'Asia/Tbilisi',
		  '(GMT+04:30) Kabul' => 'Asia/Kabul',
		  '(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
		  '(GMT+05:00) Islamabad' => 'Asia/Karachi',
		  '(GMT+05:00) Karachi' => 'Asia/Karachi',
		  '(GMT+05:00) Tashkent' => 'Asia/Karachi',
		  '(GMT+05:30) Chennai' => 'Asia/Calcutta',
		  '(GMT+05:30) Kolkata' => 'Asia/Calcutta',
		  '(GMT+05:30) Mumbai' => 'Asia/Calcutta',
		  '(GMT+05:30) New Delhi' => 'Asia/Calcutta',
		  '(GMT+05:45) Kathmandu' => 'Asia/Katmandu',
		  '(GMT+06:00) Almaty' => 'Asia/Novosibirsk',
		  '(GMT+06:00) Astana' => 'Asia/Dhaka',
		  '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
		  '(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
		  '(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
		  '(GMT+06:30) Rangoon' => 'Asia/Rangoon',
		  '(GMT+07:00) Bangkok' => 'Asia/Bangkok',
		  '(GMT+07:00) Hanoi' => 'Asia/Bangkok',
		  '(GMT+07:00) Jakarta' => 'Asia/Jakarta',
		  '(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
		  '(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
		  '(GMT+08:00) Chongqing' => 'Asia/Hong_Kong',
		  '(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
		  '(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
		  '(GMT+08:00) Kuala Lumpur' => 'Asia/Singapore',
		  '(GMT+08:00) Perth' => 'Australia/Perth',
		  '(GMT+08:00) Singapore' => 'Asia/Singapore',
		  '(GMT+08:00) Taipei' => 'Asia/Taipei',
		  '(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
		  '(GMT+08:00) Urumqi' => 'Asia/Hong_Kong',
		  '(GMT+09:00) Osaka' => 'Asia/Tokyo',
		  '(GMT+09:00) Sapporo' => 'Asia/Tokyo',
		  '(GMT+09:00) Seoul' => 'Asia/Seoul',
		  '(GMT+09:00) Tokyo' => 'Asia/Tokyo',
		  '(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
		  '(GMT+09:30) Adelaide' => 'Australia/Adelaide',
		  '(GMT+09:30) Darwin' => 'Australia/Darwin',
		  '(GMT+10:00) Brisbane' => 'Australia/Brisbane',
		  '(GMT+10:00) Canberra' => 'Australia/Sydney',
		  '(GMT+10:00) Guam' => 'Pacific/Guam',
		  '(GMT+10:00) Hobart' => 'Australia/Hobart',
		  '(GMT+10:00) Melbourne' => 'Australia/Sydney',
		  '(GMT+10:00) Port Moresby' => 'Pacific/Guam',
		  '(GMT+10:00) Sydney' => 'Australia/Sydney',
		  '(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
		  '(GMT+11:00) Magadan' => 'Asia/Magadan',
		  '(GMT+11:00) New Caledonia' => 'Asia/Magadan',
		  '(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
		  '(GMT+12:00) Auckland' => 'Pacific/Auckland',
		  '(GMT+12:00) Fiji' => 'Pacific/Fiji',
		  '(GMT+12:00) Kamchatka' => 'Pacific/Fiji',
		  '(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
		  '(GMT+12:00) Wellington' => 'Pacific/Auckland',
		  '(GMT+13:00) Nuku alofa' => 'Pacific/Tongatapu',
		);
	if($sw){
		return $timezones[$sw];
	} else {
		return $timezones;
	}
}
function is_nota_costum($ss=false){
		$kel = array ('sejajar' => 'Sejajar dengan Instalasi', 'digroupkan' => 'Digroupkan dalam Instalasi');
		if($ss){
		return $kel[$ss];
		} else {
			return $kel;
		}
}
function taxinclude($hrg, $ppn){
		$pn1   = $hrg+($hrg*$ppn/100);
		$pn2   = $pn1/$hrg;
		$hrgBL = round($hrg/$pn2);
		//$ppnBL = $hrg-$hrgBL;
		//return array ('harga' => $hrgBL, $ppnBL);
		return $hrgBL;
}
//UNTUK SMS GATEWAY
function get_modem_status($status, $tolerant)
{
	// convert the date to unix timestamp
	list($date, $time) = explode(' ', $status);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	
	$timestamp = mktime($hour, $minute, $second+$tolerant, $month, $day, $year);
	$now = time();
	//$diff = abs($now-$timestamp);
	if($timestamp>$now)
	{
		return "Connect";
	}
	else 
	{
		return "Disconnect";
	}
}

function pesan_error($numb, $text, $auto){
		if($auto == 'ya'){
			$dataInsert = array (
					'InsertIntoDB' 		=> date("Y-m-d H:i:s"),
					'SendingDateTime' 	=> date("Y-m-d H:i:s"),
					'DeliveryReport'	=> 'yes',
					);	
			$isisms = $text;
				$jumsms = ceil(strlen($isisms)/160);
				//kirim jika hanya satu lembar pesan
				if($jumsms == 1){
					$dataInsert['TextDecoded'] = $text;
					$dataInsert['DestinationNumber'] = $numb;
					$this->db->insert('outbox', $dataInsert);
				} else {
					// process jika jumlah sms lebih dari 1 lembar
					$hitpecah = ceil(strlen($isisms)/153);
					$pecah    = str_split($isisms, 153);
					$hasil 	= $this->db->query("SHOW TABLE STATUS LIKE 'outbox'");
					$data = $hasil->result();
					$newID = $data[0]->Auto_increment;
					//$newID = $newID+$bb;
					// proses penyimpanan ke tabel outbox dan outbox_multipart untuk setiap pecahan
						$hur = range('A', 'F');
						$ang = range('1', '9');
						 shuffle($hur);
						 shuffle($hur);
						 shuffle($ang);
						 shuffle($ang);
						for ($i=1; $i<=$hitpecah; $i++){
							 // membuat UDH untuk setiap pecahan, sesuai urutannya
							$udh = "050003". $hur[3] . $ang[7] .sprintf("%02s", $hitpecah).sprintf("%02s", $i);
							// membaca text setiap pecahan
							$msg = $pecah[$i-1];
								if ($i == 1){
									$dataInsert['DestinationNumber'] 	= strip_tags(trim($numb));
									$dataInsert['UDH'] 					= $udh;
									$dataInsert['TextDecoded']			= $msg;
									$dataInsert['ID'] 					= $newID;
									$dataInsert['MultiPart'] 			= 'true';
									$this->db->insert('outbox', $dataInsert);
								} else {
									$multipart['UDH'] 				= $udh;
									$multipart['TextDecoded'] 		= $msg;
									$multipart['ID']				= $newID;
									$multipart['SequencePosition']	= $i;
									$this->db->insert('outbox_multipart', $multipart);
								}
						}
					
					//print_r ($hitpecah);
				}
		}
    }
	function update_error($id, $pesan){
        $update = array(
			'status' => 2,
			'pesan' => $pesan,
		);
		$this->db->where('ID', $id);
		$this->db->update('inbox', $update); 
    }
	function get_paper_a4(){
        $sr = "height:30.5cm;max-height:30.5cm";
		return $sr;
    }
	function get_ukuran_kertas($nm_kertas){
        $data['a4'] = "min-height:27.5cm";
        $data['f4'] = "min-height:30.5cm";
		//return $data[$nm_kertas];
    }
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function getRealMAcname($ip)
	{
		//$mac = shell_exec('arp -a ' . escapeshellarg($ip));
		return $ip;
	}
	function brikdown_lab(){
		$uu = array('Sederhana' => 'Sederhana', 'Sedang' => 'Sedang', 'Canggih' => 'Canggih');
		return $uu;
	}
	function is_keterangan_gizi($ket=false){
		$uu = array('I' => 'Infeksius', 'N' => 'Non Infeksius');
		if($ket ==  true){
			return $uu[$ket];
		} else {
			return $uu;
		}
	}
	function is_keterangan_waktu($ket=false){
		$uu = array('Pagi', 'Siang', 'Sore', 'Malam');
		if($ket ==  true){
			return $uu[$ket];
		} else {
			return $uu;
		}
	}
	
	
	
function get_indikator_pelayanan($str, $akhir){
	$tgl1 = strtotime($str);
	$tgl2 = strtotime($akhir);
	$diff_secs = abs($tgl1 - $tgl2);
	$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	//buat jam menit detik
	$jam = date("G", $diff);
	$menit = (int) date("i", $diff);
	$detik = (int) date("s", $diff);
	if($jam < 10){
		$jam = "0".$jam;
	}
	if($menit < 10){
		$menit = "0".$menit;
	}
	if($detik < 10){
		$detik = "0".$detik;
	}
	return $jam.":".$menit.":".$detik;
} 
	
	//MULAI UNTUK MCU
	//LATIEFFFF..............................................
	function is_getPoliMadanDawayaOraKaroAdministratorYaDuzMadSahudGemblungEdan($ket=false){
		$uu = array('Administrator' => 'Administrator', 'Pendaftaran' => 'Pendaftaran', 'Dokter' => 'Dokter', 'Kasir' => 'Kasir');
		if($ket ==  true){
			return $uu[$ket];
		} else {
			return $uu;
		}
	}
	//FAISHAL..............................................
	function is_getTipeJawatan($ket=false){
		$uy = array('D' => 'Dinas', 'N' => 'Non Dinas');
		if($ket ==  true){
			return $uy[$ket];
		} else {
			return $uy;
		}
	}
	
	//SEBUT SAJA ABY..............................................
	function is_pemeriksaan($ket=false){
		$ci =& get_instance();	
		$pem = $ci->madmin->model_pemeriksaan($ket);
		return $pem;
	}
	function is_poliklinik($ket=false){
		$ci =& get_instance();	
		$pol = $ci->madmin->model_poliklinik($ket);
		return $pol;
	}
	function is_agama($ket=false){
		$ci =& get_instance();	
		$aga = $ci->madmin->model_agama($ket);
		return $aga;
	}
	function is_pekerjaan($ket=false){
		$ci =& get_instance();	
		$pek = $ci->madmin->model_pekerjaan($ket);
		return $pek;
	}
	function is_jawatan($ket=false){
		$ci =& get_instance();	
		$jaw = $ci->madmin->model_jawatan($ket);
		return $jaw;
	}
	function is_dinas($ket=false){
		$ci =& get_instance();	
		$din = $ci->madmin->model_dinas($ket);
		return $din;
	}
	function is_pangkat($ket=false){
		$ci =& get_instance();	
		$pan = $ci->madmin->model_pangkat($ket);
		return $pan;
	}
	function is_bayar($ket=false){
		$ci =& get_instance();	
		$bay = $ci->madmin->model_bayar($ket);
		return $bay;
	}
	function is_sesi($ket=false){
		$ci =& get_instance();	
		$ses = $ci->madmin->model_sesi($ket);
		return $ses;
	}
	//MBUH LAH SAHUD 
	function is_paket_dus($ket=false){
		$ci =& get_instance();	
		$pak = $ci->madmin->model_paket($ket);
		return $pak;
	}
	function is_jenkel($kel=false){
		$kl = array ('L' => 'Laki Laki', 'P' => 'Perempuan');
		if($kel == true){
			return $kl[$kel];
		}else {
			return $kl;
		}
	}
	
	function is_kesatuan($kes=false){
		$sat = array('L' => 'LANUD', 'S' => 'SKUADRON');
		if($kes == true){
			return $sat[$kes];
		}else {
			return $sat;
		}
	}
	function is_goldar($kes=false){
		$sat = array('Belum Diketahui', 'A+', 'A-', 'AB+', 'AB-', 'B+', 'B-', 'O+', 'O-');
		if($kes == true){
			return $sat[$kes];
		}else {
			return $sat;
		}
	}
	
	function is_status_kawin($sta=false){
		$sts = array('B' => 'Belum Menikah', 'S' => 'Sudah Menikah');
		if($sta == true){
			return $sts[$sta];
		}else {
			return $sts;
		}
	}
	
	function is_bangsa($cug=false){
		$sat = array('I' => 'Indonesia', 'A' => 'Asing');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_paket($cug=false){
		$sat = array('K' => 'Konsul', 'P' => 'Pendaftaran');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_type_bayar($cug=false){
		$sat = array('G' => 'Gratis', 'B' => 'Bayar');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_type_ruangan($cug=false){
		$sat = array('rj' => 'Rawat Jalan', 'ri' => 'Rawat Inap', 'pj' => 'Penunjang');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_log_ruangan($cug=false){
		$sat = array('rj' => 'rawatjalan', 'ri' => 'rawatinap', 'pj' => 'penunjang');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function bacaloket($loket){
	   $hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas');
       $baca = "loket ". $hrri[$loket];
	   return $baca;
    }
	
	function bacakonter($loket){
	   $hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas');
       $baca = "khonter ". $hrri[$loket];
	   return $baca;
    }
	function bacapoliklinik($loket){
       $baca = "poliklinik ". $loket;
	   return $baca;
    }
	function bacaapotek($loket){
	   $hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
       $baca = "apotek ". $hrri[$loket];
	   return $baca;
    }
	function is_typefarm($cug=false){
		$sat = array('Gudang', 'Penjualan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_riwayat($cug=false){
		$sat = array('tbs' => 'Tuberkulosis', 'hbs' => 'HBsAg', 'hiv' => 'HIV', 'kel_jan' => 'Kelainan Jantung', 'kel_ginjal' => 'Kelainan Ginjal', 'ken_manis' => 'Kencing Manis', 'kel_darah' => 'Kelainan Darah', 'op' => 'Operasi');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_carabayar($cug=false){
		$sat = array('Tunai', 'Pengalihan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_yatidak($cug=false){
		$sat = array('N' => 'Tidak', 'Y' => 'Ya');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_tidakya($cug=false){
		$sat = array('Y' => 'Ya', 'N' => 'Tidak');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_filtertgl_op($cug=false){
		$sat = array('flt1' => 'Tgl Operasi', 'filt2' => 'Tgl Pulang/Bayar');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_tandatangan_pas($cug=false){
		$sat = array('pas' => 'Pasien', 'kel' => 'Keluarga');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_fix_id($cug){
		$sat = array(
			'is_logistikbr' => '186', 
			'is_lab' => '6', 
			'is_klinikvaksin' => '177', 
			'is_dok' => '114', 
			'is_bidan' => '119', 
			'is_perawat' => '117', 
			'is_farmasi' => '112', 
			'is_gizi' => '28', 
			'is_radiologi' => '7', 
			'is_ok' => '52', 
			'is_vk' => '77', 
			'is_darah' => '44',
			'is_rehabmedik' => '33',
			'is_fisioterapi' => '68',
			'is_pa' => '8',
		);
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_dibaca($cug){
		$sat = array(
			'Y' => 'Dibaca Dokter', 
			'N' => 'Tidak Dibaca Dokter', 
		);
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_fix_debitur($cug){
		$sat = array('is_umum' => '2');
		if($cug != ""){
			return $sat[$cug];
		}
	}
	function is_menupenunjang($cug){
		//$sat = array('mn1' => 'Input Permintaan', 'mn3' => 'Rujukan Keluar');
		$sat = array('mn1' => 'Input Permintaan');
		if($cug != ""){
			return $sat[$cug];
		}else{
			return $sat;
		}
	}
	function is_jenis_diag($cug=""){
		$sat = array('Utama', 'Sekunder', 'Komplikasi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_kasus_diag($cug=""){
		$sat = array('Baru', 'Lama');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_resiko_jatuh($cug=""){
		$sat = array('Tidak Ada Resiko', 'Resiko Rendah', 'Resiko Tinggi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_skala_nyeri($cug=""){
		$sat = array('Tidak nyeri', 'Sedikit nyeri', 'Sedikit lebih nyeri', 'Lebih nyeri', 'Sangat nyeri', 'Nyeri sangat hebat');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_y_n($cug=""){
		$sat = array('Y' => 'Ya', 'N' => 'Tidak');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_ya_tidak($cug=""){
		$sat = array('Ya', 'Tidak');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_hubungan_keluarga($cug=""){
		$sat = array('Baik', 'Kurang');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_kondisi_psikologis($cug=""){
		$sat = array('Tenang', 'Takut', 'Sedih', 'Cemas', 'Marah');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_adl($cug=""){
		$sat = array('Mandiri', 'Dibantu', 'Tergantung');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_triage($cug=""){
		$sat = array('P1', 'P2', 'P3');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_kunjungan_poli($cug=""){
		$sat = array('Lama', 'Baru');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_keadaandatang($cug=""){
		$sat = array('Hidup', 'Mati');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_statusberkas($cug=""){
		$sat = array('belum' => 'Berkas Belum Ditemukan', 'sudah' => 'Berkas Sudah Ditemukan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_statusdaftaronline($cug=""){
		$sat = array('belum' => 'Berkas Melakukan Verifikasi Online', 'sudah' => 'Sudah Melakukan Verifikasi Online');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_trauma($cug=""){
		$sat = array('Non Trauma', 'Trauma');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_transport($cug=""){
		$sat = array('Pribadi', 'Umum', 'Ambulance Luar', 'Ambulance Dalam', 'Lainnya');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_respon_bukamata($cug=""){
		$sat = array('4' => 'Respon spontan (tanpa stimulus/rangsang)', '3' => 'Respon terhadap suara (suruh buka mata)', '2' => 'Respon terhadap nyeri (dicubit)', '1' => 'Tidak ada respon (meski dicubit)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_respon_verbal($cug=""){
		$sat = array('5' => 'Berorientasi baik', '4' => 'Berbicara mengacau (bingung)', '3' => 'Kata-kata tidak teratur (kata-kata jelas dengan substansi tidak jelas dan non-kalimat)', '2' => 'Suara tidak jelas (tanpa arti, mengerang)', '1' => 'Tidak ada suara');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_respon_motorik($cug=""){
		$sat = array('6' => 'Mengikuti perintah', '5' => 'Melokalisir nyeri (menjangkau & menjauhkan stimulus saat diberi rangsang nyeri)', '4' => 'Fleksi normal (menarik anggota yang dirangsang)', '3' => 'Fleksi abnormal (dekortikasi: tangan satu atau keduanya posisi kaku diatas dada & kaki extensi saat diberi rangsang nyeri)', '2' => 'Ekstensi abnormal (deserebrasi: tangan satu atau keduanya extensi di sisi tubuh, dengan jari mengepal & kaki extensi saat diberi rangsang nyeri)', '1' => 'Tidak ada Gerakan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_hasil_GCS($cug){
		if($cug >= 14){
			$bbbb = "Compos Mentis";
		} else if($cug >= 12){
			$bbbb = "Apatis";
		} else if($cug >= 10){
			$bbbb = "Somnolen";
		} else if($cug >= 7){
			$bbbb = "Delirium";
		} else if($cug >= 4){
			$bbbb = "Soporos Coma";
		} else if($cug >= 3){
			$bbbb = "Coma";
		} else {
			$bbbb = "-";
		}
		return $bbbb;
	}
	
	
	function is_hari_rujukan(){
		return 30;
	}
	function is_status_lab($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Diisi', 'belumlengkap' => 'Belum Lengkap', 'belumdicetak' => 'Belum Dicetak', 'sudahlengkap' => 'Sudah Lengkap');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_vkok($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiverifikasi' => 'Belum Diverifikasi', 'sudahdiverifikasi' => 'Sudah Diverifikasi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_fgghkj_rajal($cug=""){
		$sat = array( 'semua' => 'Semua', 'belumdiperiksa' => 'Belum Diperiksa', 'sudahdiperiksa' => 'Sudah Diperiksa');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_farmasi($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Ditransaksikan', 'belumlengkap' => 'Belum Lengkap', 'belumdiambil' => 'Belum Diambil');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_farmasidua($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Ditransaksikan', 'belumdiambil' => 'Belum Selesai Transaksi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_mutasi($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Ditransaksikan', 'belumlengkap' => 'Belum Lengkap', 'sudahlengkap' => 'Sudah Lengkap');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_penerimaan($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Ditransaksikan', 'belumlengkap' => 'Belum Lengkap', 'sudahlengkap' => 'Sudah Lengkap');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_pengembalian($cug=""){
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Diverifikasi', 'diverifikasi' => 'Sudah Diverifikasi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_shift($cug=""){
		$sat = array('-', 'Pagi', 'Siang', 'Sore', 'Malam');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_suara_alert($cug=false){
		$sat = array('-' => 'Tidak Ada', 'abc' => 'Windows Error Song mp3', 'water' => 'Water Effect Sms Tone mp3', 'virus' => 'Virus Massage Tone mp3', 'jadul' => 'Nokia 8800 Sms Tone mp3', 'sms' => 'SMS mp3');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_menu_rajal_list($cug=false){
		$sat = array('menu1' => 'Tampilkan List Pasien Perhari', 'menu2' => 'Tampilkan List Pasien yang masih Aktif');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_menu_farmasi_list($cug=false){
		$sat = array('menu1' => 'Order Resep dilakukan diruangan', 'menu2' => 'Order dilakukan diFarmasi/Apotek (Resep Manual)');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_golongan_obat($cug=""){
		$sat = array('A', 'B', 'C', 'D', 'X');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_rj_ri($cug=""){
		$sat = array('rj' => 'Rawat Jalan', 'ri' => 'Rawat Inap');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jenis_biaya_closing($cug=""){
		$sat = array('jm_close' => 'Jumlah Closing', 'mod_awal' => 'Modal Awal');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jenis_biaya_verifikasi($cug=""){
		$sat = array('jm_close' => 'Jumlah Verifikasi', 'mod_awal' => 'Modal Awal');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_metode_bayar($cug=""){
		$sat = array('tunai' => 'Tunai','transfer' => 'Transfer', 'kartu_debet' => 'Kartu Debit', 'kartu_kredit' => 'Kartu Kredit');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_bayar_keuangan($cug=""){
		$sat = array('Kas' => 'Kas', 'Bank' => 'Bank');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jenis_penerimaan($cug=""){
		$sat = array('nonfaktur' => 'Pembelian Non Faktur', 'dropping' => 'Droppingan/Hibah Barang', 'peminjaman' => 'Peminjaman Barang');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}

	function the_tanggal(){
		$tgl=array("Tanggal 01"=>"01",
			"Tanggal 02"=>"02",
			"Tanggal 03"=>"03",
			"Tanggal 04"=>"04",
			"Tanggal 05"=>"05",
			"Tanggal 06"=>"06",
			"Tanggal 07"=>"07",
			"Tanggal 08"=>"08",
			"Tanggal 09"=>"09",
			"Tanggal 10"=>"10",
			"Tanggal 11"=>"11",
			"Tanggal 12"=>"12",
			"Tanggal 13"=>"13",
			"Tanggal 14"=>"14",
			"Tanggal 15"=>"15",
			"Tanggal 16"=>"16",
			"Tanggal 17"=>"17",
			"Tanggal 18"=>"18",
			"Tanggal 19"=>"19",
			"Tanggal 20"=>"20",
			"Tanggal 21"=>"21",
			"Tanggal 22"=>"22",
			"Tanggal 23"=>"23",
			"Tanggal 24"=>"24",
			"Tanggal 25"=>"25",
			"Tanggal 26"=>"26",
			"Tanggal 27"=>"27",
			"Tanggal 28"=>"28",
			"Tanggal 29"=>"29",
			"Tanggal 30"=>"30",
			"Tanggal 31"=>"31");
		return $tgl;
	}
	function is_jenis_kelahiran($cug=""){
		$sat = array('1' => 'Tunggal', '2' => 'Kembar 2', '3' => 'Kembar 3', '4' => 'Kembar 4');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function apgar_appearance($cug=""){
		$sat = array('2' => 'Warna kulit seluruh tubuh bayi kemerahan', '1' => 'Kulit bayi pucat pada bagian ekstremitas', '0' => 'Kulit bayi pucat pada seluruh badan (Biru atau putih semua)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function apgar_pulse($cug=""){
		$sat = array('2' => 'Denyut jantung bayi kuat dan lebih dari 100 x/menit', '1' => 'Denyut jantung lemah dan kurang dari 100 x/menit', '0' => 'Denyut jantung tidak ada atau tidak terdengar');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function apgar_gremace($cug=""){
		$sat = array('2' => 'Bayi menangis kuat saat bayi diberi stimulasi', '1' => 'Bayi meringis, merintih atau menangis lemah saat di beri stimulasi', '0' => 'Bayi tidak berespon saat di beri stimulasi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function apgar_activity($cug=""){
		$sat = array('2' => 'Gerakan bayi kuat', '1' => 'Gerakan bayi lemah dan sedikit', '0' => 'Tidak ada gerakan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function apgar_respiration($cug=""){
		$sat = array('2' => 'Pernafasan bayi baik dan teratur', '1' => 'Pernafasan bayi lemah dan tidak teratur', '0' => 'Tidak ada pernafasan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_apgar_score($cug){
		if($cug >= 7){
			$bbbb = "Bayi normal";
		} else if($cug >= 4){
			$bbbb = "Asfiksia ringan sedang";
		} else if($cug >= 0){
			$bbbb = "Asfiksia berat";
		} else {
			$bbbb = "-";
		}
		return $bbbb;
	}
	function is_lap_pendapatan($cug=""){
		$sat = array('deb' => 'Group by Debitur', 'pas' => 'Group by Pasien', 'pasrj' => 'Group by Pasien/Reg (RJ)','pasrjri' => 'Group by Pasien/Reg (RJ+RI)', 'tind' => 'Group by Tindakan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_penerimaankasir($cug=""){
		$sat = array('unit' => 'Group by Unit');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_penerimaankasir_tanggal($cug=""){
		$sat = array('tg1' => 'Tanggal Bayar', 'tg2' => 'Tanggal Masuk','tg3' => 'Tanggal Pulang');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_grouptind($cug=""){
		$sat = array('pasrj' => 'Group by Pasien/Reg (RJ)','pasrjri' => 'Group by Pasien/Reg (RJ+RI)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_model_rekanan($cug=""){
		$sat = array('fakt' => 'Group by Faktur', 'po' => 'Group by PO', 'rek' => 'Group by Supplier/Rekanan', 'det' => 'Group by Pembayaran', 'barang' => 'Group by Barang', 'faksup' => 'Group by Detail Faktur/Supplier');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_rekap_pendapatan($cug=""){
		$sat = array('deb' => 'Rekap by Debitur', 'ruang' => 'Rekap by Unit / Ruang', 'pasien' => 'Rekap Per Pasien');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_rekap_jasars($cug=""){
		$sat = array('deb' => 'Rekap by Debitur', 'ruang' => 'Rekap by Unit / Ruang', 'tind' => 'Rekap by Tindakan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_rekap_jasadokter($cug=""){
		$sat = array('all' => 'Tampilkan Semua Data', 'rj' => 'Hanya Rawat Jalan', 'ri' => 'Rawat Inap (RI, OK dan VK)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_byfarmdua($cug=""){
		$sat = array('reg' => 'Group by Pasien/Register');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_byfarm($cug=""){
		$sat = array('deb' => 'Group by Debitur', 'pas' => 'Group by Pasien (Semua)', 'pasrj' => 'Group by Pasien/Reg (RJ)', 'pasrjri' => 'Group by Pasien/Reg (RJ+RI)', 'resep' => 'Group by Resep' , 'obat' => 'Group by Barang', 'detail' => 'Group by Detail');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_penggunaanbarang($cug=""){
		$sat = array('obat' => 'Group by Barang', 'barhar' => 'Group by Barang Per Harga', 'detail' => 'Group by Detail/Pasien');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function pola_lap_rjri($cug=""){
		$sat = array('rajal' => 'Rajal', 'ranap' => 'Ranap');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_lap_tglhutang($cug=""){
		$sat = array('tgltmp' => 'Berdasarkan Tgl Jth Tempo', 'tglpo' => 'Berdasarkan Tgl PO', 'tglpen' => 'Berdasarkan Faktur Masuk / Tgl Input Penerimaan');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_verifikasi_data($cug=""){
		$sat = array('R' => 'Revisi', 'Y' => 'Diterima', 'T' => 'Ditolak');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_chart($cug=false){
		$sat = array('column' => 'Basic Column', 'bar' => 'Basic Bar', 'line' => 'Basic Line', 'pie' => 'Pie');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenispelayanan_bpjs($cug=false){
		$sat = array('RITL' => 'RITL', 'RJTL' => 'RJTL');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenispelayanan_bpjs_dua($cug=false){
		$sat = array('ri' => 'RITL', 'rj' => 'RJTL');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function get_hariperawatan($str, $akhir){
	// convert the date to unix timestamp
	//maksudnya adalah masuknya lebih dari jam 10 malam maka jamnya dirubah menjadi jam 00
	$tmbhday = 1;
	$str = date("Y-m-d", strtotime($str)) ." 00:00:00";
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	//rubah tanggala akhir
	list($tgl, $waktu) = explode(' ', $akhir);
	list($thn, $bln, $hr) = explode('-', $tgl);
	list($jam, $mnit, $dtik) = explode(':', $waktu);
	$skrg  		= mktime($jam, $mnit, $dtik, $bln, $hr, $thn);
	$timestamp 	= mktime($hour, $minute, $second, $month, $day-$tmbhday, $year);
	//$now = time();
	$blocks = array(
	array('name'=>'', 'amount' => 60*60*24),
	);

	$diff = abs($skrg-$timestamp);
			$levels = 1;
			$current_level = 1;
			$result = array();
			foreach($blocks as $block)
			{
				if ($diff/$block['amount'] >= 1)
				{
					$amount = floor($diff/$block['amount']);
					$plural = '';
					//if ($amount>1) {$plural='s';} else {$plural='';}
					$result[] = $amount.' '.$block['name'].$plural;
					$diff -= $amount*$block['amount'];
					$current_level+=1;	
				}
			}
			$res = implode(', ',$result);
			//return $result;
			if(count($result) == '1'){
				$sd = explode(' ', $result[0]);
				if($sd[1] == 'Hari'){
					if($sd[0] == '1'){
						$result[0] = "0 Hari";
					}
					$result[1] = '0 Jam';
					return $result;
				} else {
					return $result;
				}
			} else if(count($result) == '2'){
				$sd = explode(' ', $result[0]);
				if($sd[1] == 'Hari'){
					if($sd[0] == '1'){
						$result[0] = $result[1];
						unset($result[1]);
					}
				}
				return $result;
			} else {
				return $result;
			}
} 
function pengurangan_jasa_pel($cug=false){
		$sat = array('Pembebasan' => 'Pembebasan', 'Keringanan' => 'Keringanan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	} 
function jenis_pasien_farmasi($cug=false){
		$sat = array('Standar' => 'Standar');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	} 
function is_ambul_ket($cug=false){
		$sat = array('umum' => 'Pasien Masih Hidup', 'jenazah' => 'Jenazah');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	} 

	function is_closed_data(){
		$sat = '<div style="padding:5px;background:red;color:white;font-weight:bold;font-size:16px;text-align:center;">--- CLOSED ---</div>';
		return $sat;
	}
	function is_pindah_ruang(){
		$sat = '<div style="padding:5px;background:red;color:white;font-weight:bold;font-size:16px;text-align:center;">Pasien Sudah Pindah Bed / Ruang / Proses Pulang</div>';
		return $sat;
	}
	function belum_closing_transaksi(){
		$sat = '<div style="padding:5px;background:green;color:white;font-weight:bold;font-size:16px;text-align:center;">Transaksi Belum Ditutup, Silahkan klik Closing Transaksi Untuk Melanjutkan...</div>';
		return $sat;
	}
	function sudah_closing_transaksi(){
		$sat = '<div style="padding:5px;background:#3C8DBC;color:white;font-weight:bold;font-size:16px;text-align:center;">Transaksi Sudah Ditutup, Silahkan klik Batalkan Closing Transaksi Untuk Membuka Transaksi...</div>';
		return $sat;
	}

	function is_ket_inap_stt($cug=""){
		$sat = array('aktif' => 'Aktif Didalam Sistem', 'nonaktif' => 'Sudah Pindah Bed/Ruang', 'checkoutpas' => 'Pasien Sudah Checkout(Closed)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_ket_penu_stt($cug=""){
		$sat = array('aktif' => 'Aktif Didalam Sistem', 'checkoutpas' => 'Pasien Sudah Checkout(Closed)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_status_dokter($cug=""){
		$sat = array('A' => 'Aktif', 'N' => 'Non Aktif');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_ket_rajal_stt($cug=""){
		$sat = array('aktif' => 'Aktif Didalam Sistem', 'nonaktif' => 'Sudah Konsul / Sudah Isi Cara Pulang / Masuk RI', 'checkoutpas' => 'Pasien Sudah Checkout (Closed)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_hitung_ppn($cug=""){
		$sat = array('Y' => 'Hitung PPN', 'N' => 'Non PPN', 'I' => 'Include PPN');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jenis_po($cug=""){
		$sat = array('' => '-', 'NK' => 'Narkotika', 'PS' => 'Psikotropika', 'OT' => 'Obat obatan Tertentu', 'PK' => 'Prekursor');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	
	
	function is_bayar_po($cug=""){
		$sat = array('Kredit' => 'Kredit', 'Tunai/COD' => 'Tunai/COD', 'Hibah' => 'Hibah');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_terima_penunjang($cug=""){
		$sat = array('N' => 'Belum Datang', 'Y' => 'Sudah Datang');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jumlah_loket(){
		return 5;
	}
	function filter_pengurang($cug=""){
		$sat = array('L' => 'Laboratorium', 'R' => 'Radiologi', 'O' => 'Oksigen & N2O');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_ambil_penunjang($cug=""){
		$sat = array('N' => 'Belum Diambil', 'Y' => 'Sudah Diambil');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_romawi_ya_dek($cug=""){
		$sat = array(
			'01' => 'I',
			'02' => 'II',
			'03' => 'III',
			'04' => 'IV',
			'05' => 'V',
			'06' => 'VI',
			'07' => 'VII',
			'08' => 'VIII',
			'09' => 'IX',
			'10' => 'X',
			'11' => 'XI',
			'12' => 'XII',
		);
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
function is_jenispasienodonto($cug=""){
		$sat = array('dewasa' => 'Pasien Dewasa', 'anak' => 'Pasien Anak-anak');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
function is_ijinkan($cug=""){
		$sat = array('Y' => 'Aktif', 'N' => 'NonAktif');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}

function ltf_key_enc($str) {
  /* $keymaster = 'smokerlopedesi199101019119931204xxxL0V3JFGFvncbvghfjh74rfjccvb677657ghfvcvbJFKhfgfghfhDJDFHDgfDfdfgOPIYPYUGhvbncGDFXBvnfhjdhcVXGHFXGF67845E56TDYD6Dx67xxr7767e7dSSS';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = substr($str, $i, 1);
        $charkey = substr($keymaster, ($i % strlen($keymaster))-1, 1);
        $char = chr(ord($char)+ord($charkey));
        $dede .= $char;
        
    }
    return "ltf_enc_data_". urlencode(base64_encode($dede));*/
	return $str;
}

function ltf_key_dec($str) {
	/*$str = str_replace("ltf_enc_data_", "", $str);
    $str = base64_decode(urldecode($str));
    $dede = '';
    $keymaster = 'smokerlopedesi199101019119931204xxxL0V3JFGFvncbvghfjh74rfjccvb677657ghfvcvbJFKhfgfghfhDJDFHDgfDfdfgOPIYPYUGhvbncGDFXBvnfhjdhcVXGHFXGF67845E56TDYD6Dx67xxr7767e7dSSS';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = substr($str, $i, 1);
        $charkey = substr($keymaster, ($i % strlen($keymaster))-1, 1);
        $char = chr(ord($char)-ord($charkey));
        $dede .= $char;
        
    }*/
    return $str;
}


function is_angka_skrininggizi($cug){
	$ui = array(
		'par1n1' => 0,
		'par1n2' => 2,
		'par1n3' => 1,
		'par1n4' => 2,
		'par1n5' => 3,
		'par1n6' => 4,
		'par1n7' => 2,
		'par2n1' => 0,
		'par2n2' => 1,
	);	
	return $ui[$cug];
}

function is_keterangan_skrininggizi($cug){
	if($cug >= 2){
		$lia = "Pasien beresiko malnutrisi, konsul ke Ahli Gizi";
	}else{
		$lia = "Normal";
	}
	return $lia;
}

function skrining_gizi_lanjutan_ya($mu){
	$nnnx = array(
		'par1n1' => 0,
		'par1n2' => 1,
		'par1n3' => 2,
		'par2n1' => 0,
		'par2n2' => 1,
		'par2n3' => 2,
		'par3n1' => 0,
		'par3n2' => 2,
		'par4n1' => 2,
		'par4n2' => 0,
	);
	return $nnnx[$mu];
}

function is_kategori_jenis_ok($mu=false){
	$nnnx = array(
		'DO' => 'Dokter Operator',
		'DA' => 'Dokter Anastesi',
		'AO' => 'Asisten Operator',
		'AA' => 'Asisten Anastesi',
		'FR' => 'Freelance',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}
function is_filter_pasien_farm($mu=false){
	$nnnx = array(
		'all' => 'Semua Pasien',
		'pasrm' => 'Pasien RM',
		'pasaps' => 'Pasien Non RM/APS',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}
function is_status_pulang($mu=false){
	$nnnx = array(
		'N' => 'Check-in',
		'Y' => 'Check-out',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_jen_gd($mu=false){
	$nnnx = array(
		'GDG' => 'Gudang',
		'APT' => 'Apotek',
		'DPT' => 'Depot',
		'SGD' => 'Sub Gudang',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function cek_status_sep($mu=false){
	$nnnx = array(
		'BL' => 'Belum Verifikasi',
		'SD' => 'Sudah Verifikasi'
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_status_claim($mu=false){
	$nnnx = array(
		'00' => 'Klaim_Baru',
		'10' => 'Klaim_Terima_CBG',
		'21' => 'Klaim_Layak',
		'22' => 'Klaim_Tidak_Layak',
		'23' => 'Klaim_Pending',
		'30' => 'TerVerifikasi',
		'40' => 'Proses_Cabang',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_grupediagnosane($mu=false){
	$nnnx = array(
		'pas' => 'Group by Pasien',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_keterangan_gizi_lanjutan($cug){
	if($cug >= 2){
		$lia = "Beresiko tinggi; bekerja sama dengan Tim Dukungan Gizi. Upayakan peningkatan status gizi dan memberikan makanan sesuai dengan daya terima. Monitoring asupan makan setiap hari. Ulangi skrining setiap 7 hari";
	}else{
		if($cug == "1"){
			$lia = "Resiko menengah; monitor asupan selama 3 hari. Jika tidak ada peningkatan,  lanjutkan pengkajian dan ulangi setiap 7 hari";
		}else{
			$lia = "Beresiko rendah; ulangi skrining setiap 7 hari";
		}
	}
	return $lia;
}

function seturl($result){
			$result = strip_tags($result);
			//$result = preg_replace('/&.+?;/', ' ', $result);
			$result = preg_replace('/\s+/', ' ', $result);
			$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
			$result = preg_replace('|-+|', ' ', $result);
			$result = preg_replace('/&#?[a-z0-9]+;/i', ' ',$result);
			$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
			$result = trim($result, ' ');
			$result	= str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), " ", $result);
			$result = str_replace(" ", "-", $result);
			return $result;
}

function kat_batal_checkout($mu=false){
	$nnnx = array(
		'TU' => 'Batal TANPA Update Tanggal Pulang',
		'DU' => 'Batal DAN Update Tanggal Pulang',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}








//YANG TIAP RUMAH SAKIT DIRUBAH	.....................................
function nourutbayi(){
		$gff = "RSIA";
		return $gff;
	} 
function farm_apoteker(){
		$gff = "Apoteker IFRS RSIA Bunda Arif";
		return $gff;
	} 
function farm_mengetahui_po(){
		$gff = "-";
		return $gff;
	}
function farm_disetujui_po(){
		$gff = "-";
		return $gff;
	}
function farm_namakaapotik(){
		$gff = "-";
		return $gff;
	} 
function farm_sipaapotek(){
		$gff = "Rizki Pradani Cahyatunufus, S.Farm.Apt";
		return $gff;
	} 
function farm_sipaapotekputri(){
		$gff = "-";
		return $gff;
	} 
function farm_b(){
		$gff = "-";
		return $gff;
	} 
function farm_c(){
		$gff = "-";
		return $gff;
	}
function farm_d(){
		$gff = "-";
		return $gff;
	}
	
function kodetukerfakturrs(){
	$gff = "STF";
	return $gff;
}
function kodepors(){
	$gff = "SPORSIA";
	return $gff;
}
function kodespbrs(){
	$gff = "SPBRSIA";
	return $gff;
}  
function kodelogs(){
	$gff = "LOG";
	return $gff;
}
//ini dpake banyak kaummmm yang noradiologi
function noradiologi(){
		$gff = "RSIA";
		return $gff;
	} 
function is_tempat_penyerahan(){
		$gff = "RSIA Bunda Arif";
		return $gff;
	}
function is_head_skrining_lanjutan(){
		$gff = "INSTALASI GIZI RSIA Bunda Arif";
		return $gff;
	}
function is_ppj_lab(){
		$gff = "-";
		return $gff;
	}
function is_kepala_sdm(){
		$gff = "-";
		return $gff;
	}
function is_kepala_tu(){
		$gff = "-";
		return $gff;
	}
	
	function apoteker_gud_utama(){
		$gff = "-";
		return $gff;
	}
//vika
	function jumlah_hari_bulan($month,$year){
		return date('t',mktime(0,0,0,$month+1,0,$year));
	}
	
	
	
	
	function antrianterbilangkonter($bilangan, $loket, $prefik){ 
    $angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
        '0', '0', '0');
    $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
        'delapan', 'sembilan');
    $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');

    $panjang_bilangan = strlen($bilangan);
    if ($panjang_bilangan > 15)
    {
        $kalimat = "Diluar Batas";
        return $kalimat;
    }
    for ($i = 1; $i <= $panjang_bilangan; $i++)
    {
        $angka[$i] = substr($bilangan, -($i), 1);
    }

    $i = 1;
    $j = 0;
    $kalimat = "";
    while ($i <= $panjang_bilangan)
    {
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
        if ($angka[$i + 2] != "0")
        {
            if ($angka[$i + 2] == "1")
            {
                $kata1 = "seratus";
            }
            else
            {
                $kata1 = $kata[$angka[$i + 2]] . " ratus";
            }
        }
        if ($angka[$i + 1] != "0")
        {
            if ($angka[$i + 1] == "1")
            {
                if ($angka[$i] == "0")
                {
                    $kata2 = "sepuluh";
                }
                elseif ($angka[$i] == "1")
                {
                    $kata2 = "sebelas";
                }
                else
                {
                    $kata2 = $kata[$angka[$i]] . " belas";
                }
            }
            else
            {
                $kata2 = $kata[$angka[$i + 1]] . " puluh";
            }
        }
        if ($angka[$i] != "0")
        {
            if ($angka[$i + 1] != "1")
            {
                $kata3 = $kata[$angka[$i]];
            }
        }
        if (($angka[$i] != "0") or ($angka[$i + 1] != "0") or ($angka[$i + 2] != "0"))
        {
            $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;

    }
    if (($angka[5] == "0") and ($angka[6] == "0"))
    {
        $kalimat = str_replace("satu ribu", "seribu", $kalimat);
    }
    return trim('tongtong nomor '. $prefik .' '. $kalimat . " ". $loket);
}
	function antrianterbilang($bilangan, $loket, $prefik){
    $angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
        '0', '0', '0');
    $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
        'delapan', 'sembilan');
    $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');

    $panjang_bilangan = strlen($bilangan);
    if ($panjang_bilangan > 15)
    {
        $kalimat = "Diluar Batas";
        return $kalimat;
    }
    for ($i = 1; $i <= $panjang_bilangan; $i++)
    {
        $angka[$i] = substr($bilangan, -($i), 1);
    }

    $i = 1;
    $j = 0;
    $kalimat = "";
    while ($i <= $panjang_bilangan)
    {
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
        if ($angka[$i + 2] != "0")
        {
            if ($angka[$i + 2] == "1")
            {
                $kata1 = "seratus";
            }
            else
            {
                $kata1 = $kata[$angka[$i + 2]] . " ratus";
            }
        }
        if ($angka[$i + 1] != "0")
        {
            if ($angka[$i + 1] == "1")
            {
                if ($angka[$i] == "0")
                {
                    $kata2 = "sepuluh";
                }
                elseif ($angka[$i] == "1")
                {
                    $kata2 = "sebelas";
                }
                else
                {
                    $kata2 = $kata[$angka[$i]] . " belas";
                }
            }
            else
            {
                $kata2 = $kata[$angka[$i + 1]] . " puluh";
            }
        }
        if ($angka[$i] != "0")
        {
            if ($angka[$i + 1] != "1")
            {
                $kata3 = $kata[$angka[$i]];
            }
        }
        if (($angka[$i] != "0") or ($angka[$i + 1] != "0") or ($angka[$i + 2] != "0"))
        {
            $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;

    }
    if (($angka[5] == "0") and ($angka[6] == "0"))
    {
        $kalimat = str_replace("satu ribu", "seribu", $kalimat);
    }
    return trim('tongtong nomornya '. $prefik .' '. $kalimat . " ". $loket);
}




function antrianterbilangpoliklinik($bilangan, $loket, $prefik){
    $angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
        '0', '0', '0');
    $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
        'delapan', 'sembilan');
    $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');

    $panjang_bilangan = strlen($bilangan);
    if ($panjang_bilangan > 15)
    {
        $kalimat = "Diluar Batas";
        return $kalimat;
    }
    for ($i = 1; $i <= $panjang_bilangan; $i++)
    {
        $angka[$i] = substr($bilangan, -($i), 1);
    }

    $i = 1;
    $j = 0;
    $kalimat = "";
    while ($i <= $panjang_bilangan)
    {
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
        if ($angka[$i + 2] != "0")
        {
            if ($angka[$i + 2] == "1")
            {
                $kata1 = "seratus";
            }
            else
            {
                $kata1 = $kata[$angka[$i + 2]] . " ratus";
            }
        }
        if ($angka[$i + 1] != "0")
        {
            if ($angka[$i + 1] == "1")
            {
                if ($angka[$i] == "0")
                {
                    $kata2 = "sepuluh";
                }
                elseif ($angka[$i] == "1")
                {
                    $kata2 = "sebelas";
                }
                else
                {
                    $kata2 = $kata[$angka[$i]] . " belas";
                }
            }
            else
            {
                $kata2 = $kata[$angka[$i + 1]] . " puluh";
            }
        }
        if ($angka[$i] != "0")
        {
            if ($angka[$i + 1] != "1")
            {
                $kata3 = $kata[$angka[$i]];
            }
        }
        if (($angka[$i] != "0") or ($angka[$i + 1] != "0") or ($angka[$i + 2] != "0"))
        {
            $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;

    }
    if (($angka[5] == "0") and ($angka[6] == "0"))
    {
        $kalimat = str_replace("satu ribu", "seribu", $kalimat);
    }
    return trim('tingting nomorku '. $prefik .' '. $kalimat . " ". $loket);
}




function terbilanghurufoke($bilangan){
    $angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
        '0', '0', '0');
    $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
        'delapan', 'sembilan');
    $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');

    $panjang_bilangan = strlen($bilangan);
    if ($panjang_bilangan > 15)
    {
        $kalimat = "Diluar Batas";
        return $kalimat;
    }
    for ($i = 1; $i <= $panjang_bilangan; $i++)
    {
        $angka[$i] = substr($bilangan, -($i), 1);
    }

    $i = 1;
    $j = 0;
    $kalimat = "";
    while ($i <= $panjang_bilangan)
    {
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
        if ($angka[$i + 2] != "0")
        {
            if ($angka[$i + 2] == "1")
            {
                $kata1 = "seratus";
            }
            else
            {
                $kata1 = $kata[$angka[$i + 2]] . " ratus";
            }
        }
        if ($angka[$i + 1] != "0")
        {
            if ($angka[$i + 1] == "1")
            {
                if ($angka[$i] == "0")
                {
                    $kata2 = "sepuluh";
                }
                elseif ($angka[$i] == "1")
                {
                    $kata2 = "sebelas";
                }
                else
                {
                    $kata2 = $kata[$angka[$i]] . " belas";
                }
            }
            else
            {
                $kata2 = $kata[$angka[$i + 1]] . " puluh";
            }
        }
        if ($angka[$i] != "0")
        {
            if ($angka[$i + 1] != "1")
            {
                $kata3 = $kata[$angka[$i]];
            }
        }
        if (($angka[$i] != "0") or ($angka[$i + 1] != "0") or ($angka[$i + 2] != "0"))
        {
            $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;

    }
    if (($angka[5] == "0") and ($angka[6] == "0"))
    {
        $kalimat = str_replace("satu ribu", "seribu", $kalimat);
    }
    return trim($kalimat);
}

function is_filter_faktur($mu=false){
	$nnnx = array(
		'det' => 'Berdasarkan Detail Barang',
		'fak' => 'Berdasarkan Nomor Faktur',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_pasienkonsul($mu=false){
	$nnnx = array(
		'all' => 'Semua Pasien',
		'kns' => 'Pasien Konsul',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}
function is_geriatripasien($mu=false){
	$nnnx = array(
		'a' => 'Geriatri A',
		'b' => 'Geriatri B',
		'c' => 'Geriatri C',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}


function is_statuspemberkasan($mu=false){
	$nnnx = array(
		'BL' => 'Belum Lengkap',
		'L' => 'Lengkap',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}




function jenispelayanan_bpjsdua($cug=false){
		$sat = array('1' => 'Rawat Inap', '2' => 'Rawat Jalan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenispelayanan_kontrol($cug=false){
		$sat = array('1' => 'Tanggal Entry', '2' => 'Tanggal Rencana Kontrol');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenispelayanan_bpjstiga($cug=false){
		$sat = array('RITL' => 'Rawat Inap', 'RJTL' => 'Rawat Jalan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenispelayanan_bpjsempat($cug=false){
		$sat = array(1 => 'RITL', 2 => 'RJTL');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function jenis_pengajuan_sep($cug=false){
		$sat = array('1' => 'Pengajuan SEP Backdate', '2' => 'Pengajuan Finger Print');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function status_persetujuan_sep($cug=false){
		$sat = array('1' => 'Menunggu', '2' => 'Disetujui', '3' => 'SEP Terbit');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_rencanatl($cug=""){
		$sat = array(1 => 'Diperbolehkan Pulang' , 2 => 'Pemeriksaan Penunjang',  3 => 'Dirujuk Ke', 4 => 'Kontrol Kembali');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_statusclaim($cug=""){
		$sat = array(1 => 'Proses Verifikasi' , 2 => 'Pending Verifikasi',  3 => 'Klaim');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function asal_rujukan_pasien_dua($cug=false){
	$sat = array(1 => 'Faskes Tingkat 1', 2 => 'Fakses Tingkat 2');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function pas_kecelakaandankerja($cug=false){
		$sat = array(1 => 'Bukan Kecelakaan', 2 => 'Kecelakaan Lalulintas dan Bukan Kecelakaan Kerja', 3 => 'Kecelakaan Lalulintas dan Kecelakaan Kerja', 4 => 'Kecelakaan Kerja');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function asal_rujukan_pasien($cug=false){
	$sat = array(1 => 'Faskes Tingkat 1/FKTP/PPK1', 2 => 'Fakses Tingkat 2/FKTL/PPK2');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function is_jenis_rujukanbpjs($cug=""){
		$sat = array(0 => 'Rujukan Penuh' , 1 => 'Rujukan Partial',  2 => 'Rujuk Balik PRB');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
function is_pesan_error($pesan){
		$pes['gagal_dokter'] = "Gagal memilih data, Silahkan Pilih Dokter yang masih aktif";
		return $pes[$pesan];
	}
	
function is_kedatangan_pasien_lama_skrining($cug=""){
		$sat = array(1 => 'Pasien Lama' , 2 => 'Pasien Kontrol',  3 => 'Pasien Online');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}

function is_format_input_cppt($cug=""){
		$sat = array('SOAP' => 'SOAP' , 'SBAR' => 'SBAR', 'HANDOVER' => 'HANDOVER');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}	
	
function is_prognosis($cug=""){
		$sat = array('a' => 'Ad. Bonam', 'b' => 'Ad. Malam', 'c' => 'Dubia ad Bonam', 'd' => 'Dubia ad Malam');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
function is_prognosisdua($cug=""){
		$sat = array('1' => 'Ad. Bonam', '2' => 'Ad. Malam', '3' => 'Dubia ad Bonam', '4' => 'Dubia ad Malam');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	
function is_aktifbiayaperawatanresikotinggi(){
	return "N";
}
function is_citocoronamas(){
	return "N";
}
function is_persentasebiayaperawatanresikotinggi(){
	return 0;
}


//data diri pasien edukasi pasien
function edukasi_tinggalbersama($cug=""){
	$sat = array(
		1 => 'Anak', 
		'Orang tua', 
		'Suami/istri', 
		'Sendiri', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_kemampuanbahasa($cug=""){
	$sat = array(
		1 => 'Indonesia', 
		'Daerah', 
		'Asing', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function getigd_doa($cug=""){
	$sat = array(
		1 => 'Tanda kehidupan',
		'Denyut nadi','RC -/-', 'EKG flat','Jam DOA', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function kondisitibars_doa($cug=""){
	$sat = array(
		1 => 'Baik',
		'Sedang','Jelek', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function jeniskasus_igda($cug=""){
	$sat = array(
		1 => 'TRAUMA',
		'NON TRAUMA', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function pemeriksaanairhigd(){
	$sat[1] = "AIRWAY";
	$sat[2] = "BREATHING";
	$sat[3] = "CIRCU-LATION";
	$sat[4] = "KESADARAN";
	$sat[5] = "DISABILITY";
	$sat[6] = "RESPON TIME";
	$sat[7] = "OBSERVASI";
	
	return $sat;
}


function pemeriksaanairhigd_detail(){
	$sat[1][1][1] = "Sumbatan Total";
	$sat[1][2][1] = "Bebas";
	$sat[1][3][1] = "Bebas";
	$sat[1][4][1] = "Bebas";
	$sat[1][5][1] = "Bebas";
	
	
	$sat[2][1][1] = "Berhenti napas / Hipoventilasi";
	$sat[2][1][2] = "Distress pernapasan berat(pernapasan abdominal ,retraksi dada berat (+), sianosis akut)";
	$sat[2][1][3] = "Tidak mampu berbicara";
	$sat[2][1][4] = "Frekuensi napas <10x/mnt";
	
	$sat[2][2][1] = "Napas spontan (+)";
	$sat[2][2][2] = "Distress pernapasan moderate (pernapasan abdominal, retraksi dada sedang (+), kulit pucat)";
	$sat[2][2][3] = "Bicara hanya satu kata";
	
	$sat[2][3][1] = "Napas spontan (+)";
	$sat[2][3][2] = "Distress pernapasan moderate (pernapasan abdominal, bicara pendek- pendek (+) kulit kemerahan)";
	
	$sat[2][4][1] = "Napas spontan (+)";
	$sat[2][4][2] = "Distress pernapasan (-)";
	$sat[2][4][3] = "Dapat berkomunikasi baik (kalimat penuh)";
	
	$sat[2][5][1] = "Napas spontan (+)";
	$sat[2][5][2] = "Distress pernapasan (-)";
	$sat[2][5][3] = "Dapat berkomunikasi baik (kalimat penuh)";
	
	
	$sat[3][1][1] = "Henti jantung";
	$sat[3][1][2] = "Tidak mampu berbicara";
	$sat[3][1][3] = "Gangguan hemodinamik berat (akral dingin, pucat, kebiruan perfusi buruk)";
	$sat[3][1][4] = "Pendarahan berat tidak terkontrol";
	
	$sat[3][2][1] = "Nadi teraba";
	$sat[3][2][2] = "Gangguan hemodinamik sedang (akral dingin, pucat, kulit basah)";
	$sat[3][2][3] = "Takikardi moderate";
	$sat[3][2][4] = "Kehilangan banyak darah";
	$sat[3][2][5] = "Tanda dehidrasi berat (+)";
	
	$sat[3][3][1] = "Sirkulasi (+)";
	$sat[3][3][2] = "Gangguan hemodinamik ringan (Denyut nadi perifer teraba, kulit pucat, akral hangat)";
	$sat[3][3][3] = "Takikardia ringan";
	$sat[3][3][4] = "Tanda dehidrasi sedang";
	
	$sat[3][4][1] = "Nadi teraba";
	$sat[3][4][2] = "Tanpa gangguan Hemodinamik";
	$sat[3][4][3] = "Denyut nadi perifer teraba";
	$sat[3][4][4] = "Kulit pucat/kemerahan, akral hangat";
	
	$sat[3][5][1] = "Nadi teraba";
	$sat[3][5][2] = "Tanpa gangguan Hemodinamik";
	$sat[3][5][3] = "Denyut nadi perifer teraba";
	$sat[3][5][4] = "Kulit kemerahan, akral hangat";
	
	$sat[4][1][1] = "GCS < 8";
	$sat[4][2][1] = "GCS 9 - 12";
	$sat[4][3][1] = "GCS > 13";
	$sat[4][4][1] = "GCS 15";
	$sat[4][5][1] = "GCS 15";
	
	$sat[5][2][1] = "Penurunan aktivitas berat (kontak mata (-), tegangan otot menurun)";
	$sat[5][2][2] = "Kontak mata (-)";
	$sat[5][2][3] = "Nyeri hebat (+) Mengerang kesakitan";
	$sat[5][2][4] = "Gangguan neuravaskular berat (nadi sukar diraba, akral dingin, sensasi rasa (-), pergerakan (-), pengisian kapiler &#8595;)";
	
	
	$sat[5][3][1] = "Nyeri sedang-berat (pasien dapat menunjukan letak nyeri, kulit tampak pucat, memohon analgesia)";
	$sat[5][3][2] = "Kontak mata saat dipanggil atau terganggu";
	$sat[5][3][3] = "Gangguan neuravaskular sedang (nadi teraba, akral dingin, sensasi rasa (+), pergerakkan (+), pengisian kapiler &#8595;)";
	
	
	$sat[5][4][1] = "Nyeri sedang-berat (pasien sadar nyeri, kulit hangat kemerahan, meminta analgesia)";
	$sat[5][4][2] = "Tenang, ada kontak mata";
	$sat[5][4][3] = "Gangguan neuravaskular sedang (nadi teraba, akral dingin, sensasi rasa (+), pergerakan (+), pengisian kapiler normal)";
	
	
	$sat[5][5][1] = "Gejala klinis (-)";
	$sat[5][5][2] = "Rencana imunisasi";
	$sat[5][5][3] = "Nyeri telinga tidak demam";
	$sat[5][5][4] = "Sakit dengan gejala ringan";
	$sat[5][5][5] = "Lebam post trauma ringan";
	
	$sat[6][1][1] = "Immediate";
	$sat[6][2][1] = "< 10 menit";
	$sat[6][3][1] = "30 menit";
	$sat[6][4][1] = "60 menit";
	$sat[6][5][1] = "120 menit";
	
	$sat[7][1][1] = "R.Resusitasi";
	$sat[7][2][1] = "R.Resusitasi";
	$sat[7][3][1] = "R.observasi biasa";
	$sat[7][4][1] = "R.observasi biasa";
	$sat[7][5][1] = "R.observasi biasa";
	return $sat;
}
function triase_detail(){
	
	$sat[1][1] = "Cardiac arrest";
	$sat[1][2] = "Apneu";
	$sat[1][3] = "Distres napas hebat";
	$sat[1][4] = "Sumbatan jalan napas";
	$sat[1][5] = "SpO2 < 50 %";
	$sat[1][6] = "RR < 10 x/menit";
	$sat[1][7] = "CRT > 2 detik";
	$sat[1][8] = "Sianosis";
	$sat[1][9] = "TD sistolik < 60 mmHg";
	$sat[1][10] = "GCS 3-8";
	$sat[1][11] = "Pupil midriasis";
	$sat[1][12] = "Pupil miosis/ pin-poin";
	$sat[1][13] = "Luka bakar > 30 %";
	$sat[1][14] = "Luka bakar di daerah vital";
	$sat[1][15] = "Suhu < 36 C pada neonatus";
	$sat[1][16] = "Kejang pada ibu hamil";
	$sat[1][17] = "Kondisi kritis lain";
	
	
	$sat[2][1] = "Skala nyeri > 7";
	$sat[2][2] = "Agitasi";
	$sat[2][3] = "GCS 9 – 12";
	$sat[2][4] = "Amnesia retrograd";
	$sat[2][5] = "KLL dengan riwayat pasien";
	$sat[2][6] = "Disorientasi";
	$sat[2][7] = "Kejang";
	$sat[2][8] = "Muntah proyektil";
	$sat[2][9] = "Trismus";
	$sat[2][10] = "Suhu > 38 C (usia 0–3 bulan)";
	$sat[2][11] = "Suhu > 39 C (usia 3 bln–1 thn)";
	$sat[2][12] = "Perdarahan aktif";
	$sat[2][13] = "Nyeri dada khas";
	
	$sat[3][1] = "Membutuhkan > 1 dari:";
	$sat[3][2] = "a. Laboratorium";
	$sat[3][3] = "b. EKG";
	$sat[3][4] = "c. Rontgen";
	$sat[3][5] = "e. USG";
	$sat[3][6] = "f. Bedside monitor";
	$sat[3][7] = "f. Cairan melalui IV";
	$sat[3][8] = "g. Inj IV/ IM";
	$sat[3][9] = "h. Nebulisasi";
	$sat[3][10] = "i. Pasang kateter urin";
	$sat[3][11] = "j. Pasang pipa lambung";
	$sat[3][12] = "k. Hecting";
	$sat[3][13] = "l. Konsultasi spesialis";
	$sat[3][14] = "Tanda vital*";
	
	$sat[4][1] = "Membutuhkan 1 dari:";
	$sat[4][2] = "a. Laboratorium";
	$sat[4][3] = "b. EKG";
	$sat[4][4] = "c. Rontgen";
	$sat[4][5] = "e. USG";
	$sat[4][6] = "f. Bedside monitor";
	$sat[4][7] = "f. Cairan melalui IV";
	$sat[4][8] = "g. Inj IV/ IM";
	$sat[4][9] = "h. Nebulisasi";
	$sat[4][10] = "i. Pasang kateter urin";
	$sat[4][11] = "j. Pasang pipa lambung";
	$sat[4][12] = "k. Hecting";
	$sat[4][13] = "l. Konsultasi spesialis";
	
	$sat[5][1] = "Tidak membutuhkan:";
	$sat[5][2] = "a. Laboratorium";
	$sat[5][3] = "b. EKG";
	$sat[5][4] = "c. Rontgen";
	$sat[5][5] = "e. USG";
	$sat[5][6] = "f. Bedside monitor";
	$sat[5][7] = "f. Cairan melalui IV";
	$sat[5][8] = "g. Inj IV/ IM";
	$sat[5][9] = "h. Nebulisasi";
	$sat[5][10] = "i. Pasang kateter urin";
	$sat[5][11] = "j. Pasang pipa lambung";
	$sat[5][12] = "k. Hecting";
	$sat[5][13] = "l. Konsultasi spesialis";
	
	return $sat;
}
function edukasi_perlupenerjemah($cug=""){
	$sat = array(
		1 => 'Ya', 
		'Tidak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_bacatulis($cug=""){
	$sat = array(
		1 => 'Biasa', 
		'Tidak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_caraedukasi($cug=""){
	$sat = array(
		1 => 'Lisan', 
		'Tulisan', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function edukasi_hambatan($cug=""){
	$sat = array(
		1 => 'Ada, yaitu :', 
		'Tidak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function is_anggota_keluarga($cug=""){
	$sat = array(
		'Nenek/Kakek' => 'Nenek/Kakek', 
		'Ibu/Bapak' => 'Ibu/Bapak', 
		'Anak' => 'Anak', 
		'Saudara' => 'Saudara', 
		'Kerabat' => 'Kerabat', 
		'Teman' => 'Teman', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_pasien_keluarga($cug=""){
	$sat = array(
		'Nenek/Kakek' => 'Cucu', 
		'Ibu/Bapak' => 'Anak', 
		'Anak' => 'Orang Tua', 
		'Saudara' => 'Saudara', 
		'Kerabat' => 'Kerabat', 
		'Teman' => 'Teman', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function edukasi_hambatandetail($cug=""){
	$sat = array(
		1 => 'Gangguan pendengaran', 
		'Gangguan emosi', 
		'Gangguan penglihatan', 
		'Gangguan bicara', 
		'Motivasi kurang', 
		'Memori emosi', 
		'Fisik lemah', 
		'Alkoholik', 
		'Perokok (aktif/pasif)', 
		'Secara fisiologis tidak mampu belajar', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_sediamenerimaedukasi($cug=""){
	$sat = array(
		1 => 'Ya', 
		'Tidak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_kebutuhanedukasi($cug=""){
	$sat = array(
		1 => 'Hak untuk berpartisipasi dalam pelayanan', 
		'Prosedur pemeriksaan penunjang', 
		'Kondisi kesehatan, diagnosis dan penatalaksanaan', 
		'Proses pemberian informed consent', 
		'Diet dan nutrisi', 
		'Teknik rehabilitasi', 
		'Penggunaan obat secara efektif dan aman', 
		'Efek samping serta interaksi obat', 
		'Teknik rehabilitasi', 
		'Penggunaan alat medis yang aman', 
		'Manajemen nyeri', 
		'Cuci tangan yang benar', 
		'Bahaya merokok', 
		'Lain-lain, sebutkan', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function edukasi_metodeedukasi($cug=""){
	$sat = array(
		1 => 'Individu', 
		'Kelompok', 
		'Ceramah', 
		'Demonstrasi', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function jenis_pemberian($cug=""){
	$sat = array(
		1 => 'Injeksi', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_jenkel_angka($cug=""){
	$sat = array(
		'L' => '1', 
		'P' => '2', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_jenis_hitung_embalase($cug=""){
	$sat = array(
		'resep' => 'Dari Resep', 
		'detail' => 'Dari Detail', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_proseslklaim($cug=""){
	$sat = array(
		'1' => 'Klaim Baru', 
		'2' => 'Input Klaim', 
		'3' => 'Pengendalian', 
		'5' => 'Grouping stage 1', 
		'6' => 'Finalisasi', 
		'7' => 'Kirim OL', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}



function hubungan_tertanggung($cug=""){
	$sat = array(
		1 => 'Suami / Istri', 
		'Anak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function is_kesadaranpasien($cug=""){
	$sat = array(
		'com' => 'Compos mentis', 
		'apa' => 'Apatis', 
		'som' => 'Somnolen', 
		'del' => 'Delirium', 
		'soc' => 'Stupor (Soporos Coma)', 
		'kom' => 'Koma', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_kesadaranpasiendua($cug=""){
	$sat = array(
		'com' => 'Compos mentis', 
		'apa' => 'Apatis', 
		'som' => 'Somnolen', 
		'del' => 'Delirium', 
		'soc' => 'Stupor (Soporos Coma)', 
		'kom' => 'Koma', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function is_derajatok($cug=""){
	$sat = array(
		'd0' => array(
			'Derajat 0',
			'Pasien membutuhkan ruang perawatan biasa.',
			'Perawat, Petugas keamanan, Pendaftaran',
			'Semua rekam medik, hasil pemeriksaan penunjang, format transfer internal',
		), 
		'd1' => array(
			'Derajat 1',
			'Pasien beresiko mengalami perburukan, pasien baru pindah dari HCU/ICU, pasien yang akan dirawat diruang perawatan khusus.',
			'Petugas Perawat Klinik I / Petugas keamanan',
			'Peralatan derajat 0 + tabung oksigen dan canul, stand infus dan pulse oksimetri',
		), 
		'd2' => array(
			'Derajat 2',
			'Pasien memerlukan pengawasan ketat atau intervensi khusus, mis : pada pasien yang mengalami kegagalan satu sistem organ.',
			'Dokter/Perawat Klinik II',
			'Peralatan derajat 1, + bedside monitor, syringe pump',
		), 
		'd3' => array(
			'Derajat 3',
			'Pasien mengalami kegagalan multi organ dan memerlukan bantuan hidup jangka panjang ditambah dengan kebutuhan akan alat bantu nafas.',
			'Dokter/Perawat Klinik III',
			'Peralatan derajat 2, + alat bantu nafas',
		), 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function edukasi_hasilverifikasi($cug=""){
	$sat = array(
		1 => 'Sudah mengerti', 
		'Re-edukasi', 
		'Re-demonstrasi', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_keterangan_online($cug=""){
	$sat = array(
		1 => 'Sudah mengerti', 
		'Re-edukasi', 
		'Re-demonstrasi', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function rencan_pemulangan_pasien($cug=""){
	$sat = array(
		1 => array(
			'1' => 'Edukasi mengenai DPJP, Diagnosis, Rencana Medis, Hasil Pemeriksaan Penunjang, Terapi, Rencana Pemulangan Pasien (<small>dilakukan oleh dokter dengan  menyertakan leaflet edukasi</small>)',
			'2' => 'Edukasi mengenai diit, pola makan, pembatgasan makanan, persiapan dan pemberian makanan (<small>dilakukan oleh ahli gizi</small>)',
			'3' => 'Edukasi Fisioterapi (<small>dilakukan oleh fisioterapis</small>)',
		),
		2 => array(
			'1' => 'Edukasi farmasi meliputi nama obat, kegunaan obat, aturan pakai, cara penyimpanan obat, masa pemberian, efek samping, tanda-tanda alergi obat  (<small>dilakukan oleh dokter</small>)',
			'2' => 'Edukasi kesehatan mengenai perawatan di rumah (hygiene, perawatan luka*, perawatan NGT / Catheter*, pencegahan infeksi, dll), pembatasan aktifitas, alat bantu yang diperlukan*, diet, tanda dan gejala yang perlu diawasi, nomor telepon emergency (<small>dilakukan oleh dokter</small>)',
		),
		3 => array(
			'1' => 'Tempat perawatan setelah pulang / Data Alamat Pulang Jelas',
			'2' => 'Hasil pemeriksaan penunjang medis',
			'3' => 'Obat pulang',
			'4' => 'Alat bantu / peralatan kesehatan yang dibawa pulang',
			'5' => 'Rencana kontrol, tanggal ',
			'6' => 'Ringkasan keperawatan dan resume medis yang sudah terisi',
			'7' => 'Alat transportasi untuk pulang (ambulance / mobil pribadi)',
			'8' => 'Kelengkapan administrasi',
			'9' => ' Lain-lain',
		),
		
		4 => array(
			'1' => 'Ringkasan masuk terisi lengkap (Anamnesa,riwayat pengobatan, pemeriksaan penunjang, diagnosa, indikasi masuk, alergi)',
			'2' => 'Diagnosa penyakit ditulis DPJP dengan jelas',
			'3' => 'Formulir pemberian edukasi terisi lengkap (Edukasi pasien baru, re-assessment, rdukasi gizi, edukasi farmasi)',
			'4' => 'Persetujuan / Penolakan tindakan medis terisi lengkap',
			'5' => 'Resume medis terisi lengkap ',
		),
		
		5 => array(
			'1' => 'Daftar cek pasien baru terisi lengkap',
			'2' => 'Pernyataan membuka rahasia kedokteran terisi lengkap',
			'3' => 'Informasi resiko pasien jatuh terisi lengkap',
			'4' => 'Assessment pasien (awal dan lanjutan) terisi lengkap ',
			'5' => 'Formulir surveilens terisi lengkap ',
			'6' => 'Formulir Askep (Renpra, Catatan Keperawatan, Catatan Perkembangan) terisi lengkap ',
		),
		
		6 => array(
			'1' => 'Dokumentasi pemberian informasi tindakan bedah terisi lengkap',
			'2' => 'Persetujuan tindakan bedah terisi lengkap',
			'3' => 'Evaluasi Pra Anastesi terisi lengkap',
			'4' => 'Daftar tilik keselamatan bedah terisi lengkap',
			'5' => 'Catatan anestesi terisi lengkap ',
			'6' => 'Laporan operasi terisi lengkap',
		),
		7 => array(
			'1' => 'Surveilence ILO terisi lengkap',
			'2' => 'Penatalaksanaan pre / post operasi terisi lengkap',
		),
	);
	return $sat;
}


function is_diskon_pelayanan(){
	return 0;
}

function is_fix_id_umum(){
	return 2;
}
function is_fix_nama_umum(){
	return "UMUM";
}

function is_pilihanwarna($cug=""){
		$sat = array('#15558D' => 'Techno-Biru' , '#079245' => 'Techno-Hijau', '#E00883' => 'Techno-Pink', '#AD8D6C' => 'Techno-Coklat');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	
function is_jenisantrianfarm($cug=""){
	$sat = array('2' => 'RA', '3' => 'RB', '4' => 'RC', '5' => 'RD');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function is_statusantrianfarm($cug=""){
	$sat = array('2' => 'UMUM', '3' => 'BPJS', '4' => 'UMUM', '5' => 'BPJS');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function is_katsantrianfarm($cug=""){
	$sat = array('2' => 'NON RACIKAN', '3' => 'NON RACIKAN', '4' => 'RACIKAN', '5' => 'RACIKAN');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function ispbinon($cug=""){
	$sat = array('Y' => 'PBI', 'N' => 'NON PBI');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function ispotensiprb($cug=""){
	$sat = array('P' => 'Tidak Dibuatkan Form PRB', 'D' => 'Dibuatkan Form PRB');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}

function is_lap_pbi_non($cug=""){
	$sat = array('P' => 'Group by Poliklinik', 'D' => 'Berdasarkan Detail Pasien');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}
function is_lap_waktutunggupasien($cug=""){
	$sat = array('D' => 'Berdasarkan Detail Pasien');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}



function is_jenisrestriksi($cug=""){
	$sat = array(2 => 'Jangka Waktu', 3 => 'Total Pemberian', 4 => 'Catatan Restriksi');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
}



function mc_encrypt($data, $key) {
require_once "random/lib/random.php";
$key = hex2bin($key);
if (mb_strlen($key, "8bit") !== 32) {
throw new Exception("Needs a 256-bit key!");

}
$iv_size = openssl_cipher_iv_length("aes-256-cbc");

$iv = random_bytes($iv_size);
$encrypted = openssl_encrypt($data,"aes-256-cbc",$key,OPENSSL_RAW_DATA,$iv);
$signature = mb_substr(hash_hmac("sha256",$encrypted,$key,true),0,10,"8bit");
$encoded = chunk_split(base64_encode($signature.$iv.$encrypted));
return $encoded;
}


function mc_decrypt($str,$strkey) {
	$key = hex2bin($strkey);
	if(mb_strlen($key, "8bit") !== 32) {
		throw new Exception("Needs a 256-bit key!");
	}
	$iv_size = openssl_cipher_iv_length("aes-256-cbc");
	$decoded = base64_decode($str);
	$signature = mb_substr($decoded,0,10,"8bit");
	$iv = mb_substr($decoded,10,$iv_size,"8bit");
	$encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
	$calc_signature = mb_substr(hash_hmac("sha256",$encrypted,$key,true),0,10,"8bit");
	if(!mc_compare($signature,$calc_signature)) {
		return "SIGNATURE_NOT_MATCH"; 
	}
	$decrypted = openssl_decrypt($encrypted,"aes-256-cbc",$key,OPENSSL_RAW_DATA,$iv);
	return $decrypted;
}

function mc_compare($a, $b) {
if (strlen($a) !== strlen($b)) return false;
$result = 0;
for($i = 0; $i < strlen($a); $i ++) { 
	$result |= ord($a[$i]) ^ ord($b[$i]);
}
return $result == 0;
}



function inacbg_jenisrawat($cug=""){
	$sat = array(
		'1' => 'Rawat Inap', 
		'2' => 'Rawat Jalan', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function inacbg_kelasrawat($cug=""){
	$sat = array(
		'1' => 'Kelas 1', 
		'2' => 'Kelas 2', 
		'3' => 'Kelas 3', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function inacbg_icuindikator($cug=""){
	$sat = array(
		'0' => 'Ya', 
		'1' => 'Tidak', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_logistik_jenis($cug=""){
	$sat = array(
		'A' => 'Aset', 
		'I' => 'Inventory', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function upgrade_kelas($cug=""){
	$sat = array(
		'kelas_1' => 'Naik Kelas 1', 
		'kelas_2' => 'Naik Kelas 2', 
		'vip' => 'Naik Kelas VIP', 
		'vip' => 'Naik Kelas VVIP', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_jenis_rujuk_balik($cug=""){
	$sat = array(
		's' => 'Membuat Rujukan Baru ke FKTP karena kondisi belum stabil namun sudah melakukan pelayanan di RS slama 3 bulan', 
		'd' => 'Dikelola sebagai Program Rujuk Balik (PRB) di FKTP dengan pengobatan sebagai berikut (jenis/signa) :', 

	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_kategori_rujuk_balik($cug=""){
	$sat = array(
		's' => 'Perlu Rawat Inap', 
		'd' => 'Konsultasi Selesai',
		'r' => 'Lainnya',

	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_caradatangpasigd($cug=""){
	$sat = array(
		's' => 'Datang sendiri', 
		'd' => 'Diantar', 
		'r' => 'Rujukan dari', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_pjbiayaigd($cug=""){
	$sat = array(
		'1' => 'Pribadi', 
		'2' => 'Perusahaan', 
		'3' => 'Asuransi',
		'4' => 'JKN-KIS',
		'5' => 'Jamkesda',
		'6' => 'BPJS-TK',
		'7' => 'Lainnya',
		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_trauma_igd($cug=""){
	$sat = array(
		'1' => 'Kecelakaan Lalu Lintas', 
		'2' => 'Kecelakaan Kerja', 
		'3' => 'Lainnya', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_triase_igd($cug=""){
	$sat = array(
		'1' => 'Merah', 
		'2' => 'Kuning', 
		'3' => 'Hijau',
		'4' => 'Hitam',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_penglihatan($cug=""){
	$sat = array(
		'1' => 'Normal', 
		'2' => 'Kabur', 
		'3' => 'Kaca Mata',
		'4' => 'Lensa Mata',
		'5' => 'Lensa Kontak',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_pendengaran($cug=""){
	$sat = array(
		'1' => 'Normal', 
		'2' => 'Tuli Kanan/ Kiri', 
		'3' => 'Alat Bantu Dengar Kanan / Kiri',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_kognitif($cug=""){
	$sat = array(
		'1' => 'Orientasi Penuh', 
		'2' => 'Bingung', 
		'3' => 'Pelupa',
		'4' => 'Tidak Dapat Dimengerti',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_motorik_aktifitas($cug=""){
	$sat = array(
		'1' => 'Mandiri', 
		'2' => 'Bantuan Sebagian', 
		'3' => 'Bantuan Minimal',
		'4' => 'Ketergantungan Total',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_motorik_berjalan($cug=""){
	$sat = array(
		'1' => 'Tidak ada kesulitan', 
		'2' => 'Sering Jatuh', 
		'3' => 'Perlu Bantuan',
		'4' => 'Kelumpuhan',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_provokatif($cug=""){
	$sat = array(
		'1' => 'Benturan', 
		'2' => 'Lainnya', 		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_qualitas($cug=""){
	$sat = array(
		'1' => 'Tertusuk', 
		'2' => 'Tertekan',
		'3' => 'Teriris', 
		'4' => 'Lainnya', 		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_region($cug=""){
	$sat = array(
		'1' => 'Satu Titik', 
		'2' => 'Menjalar',
		'3' => 'Lainnya', 		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_time($cug=""){
	$sat = array(
		'1' => 'Saat Bergerak', 
		'2' => 'Lainnya', 		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_jalan_nafas($cug=""){
	$sat = array(
		'1' => 'Paten', 
		'2' => 'Obstruksi parsial',
		'3' => 'Obstruksi total', 
		'4' => 'Stridor', 		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_pernafasan_dada($cug=""){
	$sat = array(
		'1' => 'Simetri', 
		'2' => 'Asimetri',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_pernafasan($cug=""){
	$sat = array(
		'1' => 'Normal', 
		'2' => 'Retraktif',
		'3' => 'Kussmaul', 
		'4' => 'Dangkal',		
		'5' => 'Takipneu',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_sirkulasi1($cug=""){
	$sat = array(
		'1' => 'Ada', 
		'2' => 'Tidak',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_sirkulasi2($cug=""){
	$sat = array(
		'1' => 'Teraba hangat', 
		'2' => 'Teraba dingin',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_mukosa($cug=""){
	$sat = array(
		'1' => 'Merah', 
		'2' => 'Ikterik',
		'3' => 'Sianotik', 
		'4' => 'Anemis',			
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_pulse($cug=""){
	$sat = array(
		'1' => 'Normal', 
		'2' => 'Kecil',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_ritme($cug=""){
	$sat = array(
		'1' => 'Reguler', 
		'2' => 'Aritmia',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_onset($cug=""){
	$sat = array(
		'1' => 'Akut', 
		'2' => 'Kronik',		
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function inacbg_jeniskelas($cug=""){
	$sat = array(
		'3' => 'Reguler', 
		'1' => 'Eksekutif', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}



function inacbg_discharge($cug=""){
	$sat = array(
		'1' => 'Atas persetujuan dokter', 
		'2' => 'Dirujuk', 
		'3' => 'Atas permintaan sendiri', 
		'4' => 'Meninggal', 
		'5' => 'Lain-lain', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function inacbg_nokatambahan($cug=""){
	$sat = array(
		'nik' => 'NIK', 
		'kitas' => 'KITAS/KITAP', 
		'paspor' => 'Passpor', 
		'kartu_jkn' => 'Kartu Peserta JKN', 
		'kk' => ' Kartu Keluarga', 
		'unhcr' => 'dokumen dari UNHCR', 
		'dinsos' => 'dokumen dari Dinas Sosial', 
		'dinkes' => 'dokumen dari Dinas Kesehatan', 
		'sjp' => 'Surat Jaminan Perawatan (SJP)', 
		'klaim_ibu' => 'jaminan bayi baru lahir', 
		'lainnya' => 'identitas lainnya', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function inacbg_statuscovid($cug=""){
	$sat = array(
		'4' => 'Suspek', 
		'5' => 'Probabel', 
		'3' => 'pasien terkonfirmasi positif COVID-19', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function inacbg_aploadfile($cug=""){
	$sat = array(
		'resumse_medis' => 'Resume Medis', 
		'ruang_rawat' => 'Ruang Rawat', 
		'laboratorium' => 'Laboratorium', 
		'radiolog' => 'Radiologi', 
		'penunjang_la' => 'Penunjang Lain', 
		'resep_oba' => 'Resep Obat', 
		'tagihan' => 'Tagihan', 
		'kartu_identita' => 'Kartu Pasien', 
		'dokumen_kipi' => 'Dokument Kipi', 
		'lain_lai' => 'Lain Lain', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function is_upload_hasil($cug=""){
	$sat = array(
		'dalam' => 'Hasil Internal', 
		'luar' => 'Hasil Eksternal (Luar)', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_upload_hasil_dalam($cug=""){
	$sat = array(
		'dalam' => 'Hasil Internal', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_upload_hasil_luar($cug=""){
	$sat = array(
		'luar' => 'Hasil Eksternal (Luar)', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}
function is_gudang_logistik(){
	return 23;
}


function waapiuri($cug=""){
	$sat = array(
		'WA-SERVER1-5.55' => 'http://192.168.5.55:8000', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function is_breakdown_claim($mu=false){
	$nnnx = array(
		1 =>'Prosedur Non Bedah',
		'Prosedur Bedah',
		'Konsultasi',
		'Tenaga Ahli',
		'Keperawatan',
		'Penunjang',
		'Radiologi',
		'Laboratorium',
		'Pelayanan Darah',
		'Rehabilitasi',
		'Kamar/Akomodasi',
		'Rawat Intensif',
		'Obat',
		'Alkes',
		'BMHP',
		'Sewa Alat',
		'Obat Kronis',
		'Obat Kemoterapi',
	);
	if($mu==false){
		return $nnnx;
	}else{
		return $nnnx[$mu];
	}
	
}

function is_status_sinkron_sep($cug=""){
	$sat = array(
		'2' => 'Belum Memiliki SEP', 
		'3' => 'Belum Menambahkan Klaim Baru', 
		'4' => 'Belum Input Klaim', 
		'5' => 'Belum Grouping', 
		'6' => 'Belum Finalisasi', 
		'7' => 'Belum Kirim Online', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}

function is_hariantrol($cug=""){
	$sat = array(
		'1' => 'Senin', 
		'2' => 'Selasa', 
		'3' => 'Rabu', 
		'4' => 'Kamis', 
		'5' => 'Jumat', 
		'6' => 'Sabtu', 
		'7' => 'Minggu', 
		'8' => 'Hari Libur Nasional', 
	);
	if($cug != ""){
		return $sat[$cug];
	}else {
		return $sat;
	}
}


function decrypt_bpjs_code($key, $metadata){
	require_once "random/lz/LZString.php";
	$encrypt_method = 'AES-256-CBC';
	$key_hash = hex2bin(hash('sha256', $key));
	$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
	$output = openssl_decrypt(base64_decode($metadata), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
	return json_decode(\LZCompressor\LZString::decompressFromEncodedURIComponent($output));
}

function bpjs_generate_uri($ai){
	//$ui['base_url2'] = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/";
	//$ui['base_url'] = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/";
	
	$ui['base_url2'] = "https://apijkn.bpjs-kesehatan.go.id/antreanrs/";
	$ui['base_url'] = "https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/";
	$ui['lpk_insert'] = "LPK/insert";
	$ui['lpk_update'] = "LPK/update";
	$ui['lpk_hapus'] = "LPK/delete";
	$ui['lpk_datalpk'] = "LPK/TglMasuk/";
	
	$ui['monitoring_datakunjungan'] = "Monitoring/Kunjungan/Tanggal/";
	$ui['monitoring_dataklaim'] = "Monitoring/Klaim/Tanggal/";
	$ui['monitoring_datahistorypelayananpeserta'] = "monitoring/HistoriPelayanan/NoKartu/";
	$ui['monitoring_jaminanjasaraharja'] = "monitoring/JasaRaharja/JnsPelayanan/";
	$ui['peserta_noka'] = "Peserta/nokartu/";
	$ui['peserta_nik'] = "Peserta/nik/";
	$ui['referensi_diagnosa'] = "referensi/diagnosa/";
	$ui['referensi_poliklinik'] = "referensi/poli/";
	$ui['referensi_faskes'] = "referensi/faskes/";
	$ui['referensi_dpjp'] = "referensi/dokter/pelayanan/";
	$ui['referensi_propinsi'] = "referensi/propinsi";
	$ui['referensi_kabupaten'] = "referensi/kabupaten/propinsi/";
	$ui['referensi_kecamatan'] = "referensi/kecamatan/kabupaten/";
	$ui['referensi_procedure'] = "referensi/procedure/";
	$ui['referensi_lpkdokter'] = "referensi/dokter/";
	$ui['referensi_lpkruangrawat'] = "referensi/ruangrawat";
	$ui['referensi_lpkkelasrawat'] = "referensi/kelasrawat";
	$ui['referensi_lpkspesialistik'] = "referensi/spesialistik";
	$ui['referensi_lpkcarakeluar'] = "referensi/carakeluar";
	$ui['referensi_lpkpascapulang'] = "referensi/pascapulang";
	$ui['referensi_diagnosaprb'] = "referensi/diagnosaprb";
	$ui['referensi_obatprb'] = "referensi/obatprb/";
	
	$ui['rujukan_listspesialisrujukan'] = "Rujukan/ListSpesialistik/PPKRujukan/";
	$ui['rujukan_listsarana'] = "Rujukan/ListSarana/PPKRujukan/";
	$ui['rujukan_insertrujukanv2'] = "Rujukan/2.0/insert";
	$ui['rujukan_updaterujukanv2'] = "Rujukan/2.0/Update";
	$ui['rujukan_deleterujukanv2'] = "Rujukan/delete";
	$ui['rujukan_rujukannorujukanppk1'] = "Rujukan/";
	$ui['rujukan_rujukannorujukanppk2'] = "Rujukan/RS/";
	$ui['rujukan_rujukannokasaturecordppk1'] = "Rujukan/Peserta/";
	$ui['rujukan_rujukannokasaturecordppk2'] = "Rujukan/RS/Peserta/";
	$ui['rujukan_rujukannokamultippk1'] = "Rujukan/List/Peserta/";
	$ui['rujukan_rujukannokamultippk2'] = "Rujukan/RS/List/Peserta/";
	$ui['rujukan_insertrujukankhusus'] = "Rujukan/Khusus/insert";
	$ui['rujukan_deleterujukankhusus'] = "Rujukan/Khusus/delete";
	$ui['rujukan_listrujukankhusus'] = "Rujukan/Khusus/List/Bulan/";
	$ui['rujukan_listrujukankeluarrs'] = "Rujukan/Keluar/List/tglMulai/";
	$ui['rujukan_rujukankeluarbynorujukan'] = "Rujukan/Keluar/";
	$ui['rujukan_jumlahrujukankeluar'] = "Rujukan/JumlahSEP/";
	
	$ui['sep_suplesijasarahaja'] = "sep/JasaRaharja/Suplesi/";
	$ui['sep_pengajuansep'] = "Sep/pengajuanSEP";
	$ui['sep_approvalsep'] = "Sep/aprovalSEP";
	$ui['sep_insertsepv2'] = "SEP/2.0/insert";
	$ui['sep_updatesepv2'] = "SEP/2.0/update";
	$ui['sep_deletesepv2'] = "SEP/2.0/delete";
	$ui['sep_updatetglpulangv2'] = "SEP/2.0/updtglplg";
	$ui['sep_carisep'] = "SEP/";
	$ui['sep_sepinternal'] = "SEP/Internal/";
	$ui['sep_hapussepinternal'] = "SEP/Internal/delete";
	$ui['sep_cekfingerprint'] = "SEP/FingerPrint/Peserta/";
	$ui['sep_getfingerprint'] = "SEP/FingerPrint/List/Peserta/TglPelayanan/";
	
	
	$ui['prb_insertdata'] = "PRB/insert";
	$ui['prb_updatedata'] = "PRB/Update";
	$ui['prb_hapusdata'] = "PRB/Delete";
	$ui['prb_detaildata'] = "prb/";
	$ui['prb_hapusprb'] = "PRB/Delete";
	$ui['prb_tanggalprb'] = "prb/tglMulai/";
	
	$ui['rencanakontrol_insertspri'] = "RencanaKontrol/InsertSPRI";
	$ui['rencanakontrol_updatespri'] = "RencanaKontrol/UpdateSPRI";
	$ui['rencanakontrol_insertrencana'] = "RencanaKontrol/insert";
	$ui['rencanakontrol_updaterencana'] = "RencanaKontrol/Update";
	$ui['rencanakontrol_datapoli'] = "RencanaKontrol/ListSpesialistik/JnsKontrol/";
	$ui['rencanakontrol_jadwalpraktek'] = "RencanaKontrol/JadwalPraktekDokter/JnsKontrol/";
	$ui['rencanakontrol_listsuratkonrolbynoka'] = "RencanaKontrol/ListRencanaKontrol/Bulan/";
	$ui['rencanakontrol_hapusrencana'] = "RencanaKontrol/Delete";
	$ui['rencanakontrol_detaildata'] = "RencanaKontrol/noSuratKontrol/";
	$ui['rencanakontrol_listrencanakontrol'] = "RencanaKontrol/ListRencanaKontrol/tglAwal/";
	
	
	$ui['antrian_jadwaldokter'] = "jadwaldokter/kodepoli/";
	$ui['antrian_refpoli'] = "ref/poli";
	$ui['antrian_refdokter'] = "ref/dokter";
	$ui['antrian_updatejadwaldokter'] = "jadwaldokter/updatejadwaldokter";
	$ui['antrian_antreanadd'] = "antrean/add";
	$ui['antrian_antreanupdatewkt'] = "antrean/updatewaktu";
	$ui['antrian_antreanlistwaktutask'] = "antrean/getlisttask";
	$ui['antrian_dashboardbulan'] = "dashboard/waktutunggu/bulan/";
	return $ui[$ai];
}

function bpjs_attribut_v2($ky, $vl=false){
	$dat['statusPulang'][1] = "Atas Persetujuan Dokter";
	$dat['statusPulang'][3] = "Atas Permintaan Sendiri";
	$dat['statusPulang'][4] = "Meninggal";
	$dat['statusPulang'][5] = "Lain-lain";
	
	$dat['tujuanKunj'][0] = "Normal";
	$dat['tujuanKunj'][1] = "Prosedur";
	$dat['tujuanKunj'][2] = "Konsul Dokter";
	$dat['flagProcedure'][0] = "Prosedur Tidak Berkelanjutan";
	$dat['flagProcedure'][1] = "Prosedur dan Terapi Berkelanjutan";
	$dat['kdPenunjang'][1] = "Radioterapi";
	$dat['kdPenunjang'][2] = "Kemoterapi";
	$dat['kdPenunjang'][3] = "Rehabilitasi Medik";
	$dat['kdPenunjang'][4] = "Rehabilitasi Psikososial";
	$dat['kdPenunjang'][5] = "Transfusi Darah";
	$dat['kdPenunjang'][6] = "Pelayanan Gigi";
	$dat['kdPenunjang'][7] = "Laboratorium";
	$dat['kdPenunjang'][8] = "USG";
	$dat['kdPenunjang'][9] = "Farmasi";
	$dat['kdPenunjang'][10] = "Lain-Lain";
	$dat['kdPenunjang'][11] = "MRI";
	$dat['kdPenunjang'][12] = "HEMODIALISA";
	//$dat['assesmentPel'][1] = "Poli spesialis tidak tersedia pada hari sebelumnya";
	$dat['assesmentPel'][2] = "Jam Poli telah berakhir pada hari sebelumnya";
	//$dat['assesmentPel'][3] = "Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya";
	//$dat['assesmentPel'][4] = "Atas Instruksi RS";
	$dat['assesmentPel'][5] = "Tujuan Kontrol";
	$dat['pembiayaan'][1] = "Pribadi";
	$dat['pembiayaan'][2] = "Pemberi Kerja";
	$dat['pembiayaan'][3] = "Asuransi Kesehatan Tambahan";
	$dat['klsRawatNaik'][1] = "VVIP";
	$dat['klsRawatNaik'][2] = "VIP";
	$dat['klsRawatNaik'][3] = "Kelas 1";
	$dat['klsRawatNaik'][4] = "Kelas 2";
	$dat['klsRawatNaik'][5] = "Kelas 3";
	$dat['klsRawatNaik'][6] = "ICCU";
	$dat['klsRawatNaik'][7] = "ICU";
	if($vl == true){
		return $dat[$ky][$vl];
	}else{
		return $dat[$ky];
	}
	
}

//satusehattt
function satusehat_getkey($ky){
	$dat['auth_url'] = "https://api-satusehat.kemkes.go.id/oauth2/v1";
	$dat['base_url'] = "https://api-satusehat.kemkes.go.id/fhir-r4/v1";
	$dat['consent_url'] = "https://api-satusehat.dto.kemkes.go.id/consent/v1";
	$dat['client_id'] = "VG0FRD3EEAKPfywEjrkGPMkRPOCEhdUxUZTjstvnyBgVMlHh";
	$dat['client_secret'] = "iA7P4sc9Yv20M8qFojRKcAUZiaNkyWa3JrrSCAgEXGptgHqhUhKuT6RaPQRki8S7";
	return $dat[$ky];
}

function satusehat_generatetoken(){
		$params = array('foo' => 'bar');
		$url = satusehat_getkey('auth_url') ."/accesstoken?grant_type=client_credentials";
		$request_headers = array();
		$request_headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$request_headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&client_id='.satusehat_getkey('client_id').'&client_secret='.satusehat_getkey('client_secret').'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		$dti = json_decode($response);
		return $dti->access_token;
}
	