<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
	function bar128($text) {
	echo '<style>
div.b128{
    border-left: 1px #000000 solid;
	height: 30px;
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
  return "$html<tr><td  colspan=".strlen($w)." align=center><font family=arial size=1><b></table>";		
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
	$hari = array (1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
	return $hari[$s];
}
function new_hari($s){
	$hari = array (0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	return $hari[$s];
}
function get_hari(){
	$hari = array (1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
	return $hari;
}
function get_hari_aktif(){
	$hari = array (1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
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
		$sat = array('Belum Diketahui', 'A', 'B', 'AB', 'O');
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
	   $hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
       $baca = "loket ". $hrri[$loket];
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
		$sat = array('kel_jan' => 'Kelainan Jantung', 'tbc' => 'Tuberkulosis', 'kel_ginjal' => 'Kelainan Ginjal', 'ken_manis' => 'Kencing Manis', 'kel_darah' => 'Kelainan Darah', 'op' => 'Operasi');
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
	function is_fix_id($cug){
		$sat = array(
			'is_lab' => '46', 
			'is_dok' => '114', 
			'is_bidan' => '119', 
			'is_perawat' => '117', 
			'is_farmasi' => '112', 
			'is_gizi' => '163', 
			'is_radiologi' => '10', 
			'is_ok' => '52', 
			'is_vk' => '77', 
			'is_darah' => '44',
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
		$sat = array('mn1' => 'Input Permintaan', 'mn3' => 'Rujukan Keluar');
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
		$sat = array('Tidak ada rasa sakit', 'Nyeri hampir tak terasa', 'Tidak menyenangkan', 'bisa ditoleransi', 'menyedihkan', 'sangat menyedihkan', 'intens', 'sangat intens', 'benar-benar mengerikan', 'menyiksa tak tertahankan', 'sakit tak terbayangkan tak dapat diungkapkan');
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
		} else if($cug >= 7){
			$bbbb = "Soporo Coma";
		} else if($cug >= 4){
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
		$sat = array('semua' => 'Semua', 'belumdiisi' => 'Belum Diisi', 'belumlengkap' => 'Belum Lengkap', 'belumdicetak' => 'Belum Dicetak');
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
		$sat = array('tunai' => 'Tunai', 'kartu_debet' => 'Kartu Debet (ATM)', 'kartu_kredit' => 'Kartu Kredit');
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
	function is_lap_byfarm($cug=""){
		$sat = array('deb' => 'Group by Debitur', 'pas' => 'Group by Pasien (Semua)', 'pasrj' => 'Group by Pasien/Reg (RJ)', 'pasrjri' => 'Group by Pasien/Reg (RJ+RI)', 'resep' => 'Group by Resep' , 'obat' => 'Group by Barang', 'detail' => 'Group by Detail');
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
		$sat = array('tgltmp' => 'Berdasarkan Tgl Jth Tempo', 'tglpo' => 'Berdasarkan Tgl PO', 'tglpen' => 'Berdasarkan Faktur Masuk');
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
	function is_ket_rajal_stt($cug=""){
		$sat = array('aktif' => 'Aktif Didalam Sistem', 'nonaktif' => 'Sudah Konsul / Sudah Isi Cara Pulang / Masuk RI', 'checkoutpas' => 'Pasien Sudah Checkout (Closed)');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_hitung_ppn($cug=""){
		$sat = array('Y' => 'Hitung PPN', 'N' => 'Non PPN');
		if($cug != ""){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_bayar_po($cug=""){
		$sat = array('Kredit' => 'Kredit', 'Tunai/COD' => 'Tunai/COD');
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
		$gff = "RSDK";
		return $gff;
	} 
function farm_apoteker(){
		$gff = "Apoteker IFRS RSDK Purwokerto";
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
		$gff = "-";
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
	
function kodepors(){
	$gff = "SPORSDK";
	return $gff;
} 
//ini dpake banyak kaummmm yang noradiologi
function noradiologi(){
		$gff = "RSDK";
		return $gff;
	} 
function is_tempat_penyerahan(){
		$gff = "RSDK Purwokerto";
		return $gff;
	}
function is_head_skrining_lanjutan(){
		$gff = "INSTALASI GIZI RSDK Purwokerto";
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
    return trim('tongtong nomor '. $prefik .' '. $kalimat . " ". $loket);
}
	