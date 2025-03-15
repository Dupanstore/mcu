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
    return trim('tingting nomornya '. $prefik .' '. $kalimat . " ". $loket);
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
		$kl = array ('L' => 'Laki Laki', 'P' => 'Perempuan');
		$klo = $kel == true ? $kl[$kel] : $kl;
		return $klo;
	}
}

if( ! function_exists('is_jenkelenid')){
	function is_jenkelenid($kel=false, $lang){
		if($lang == "en"){
			$kl = array ('L' => 'Male', 'P' => 'Female');
		}else{
			$kl = array ('L' => 'Laki Laki', 'P' => 'Perempuan');
		}
		
		$klo = $kel == true ? $kl[$kel] : $kl;
		return $klo;
	}
}
if( ! function_exists('is_jenkel_en')){
	function is_jenkel_en($kel=false){
		$kl = array ('L' => 'Male', 'P' => 'Female');
		$klo = $kel == true ? $kl[$kel] : $kl;
		return $klo;
	}
}

if( ! function_exists('is_kebangsaan_en')){
	function is_kebangsaan_en($kel=false, $lang){
		if($lang == "en"){
			$kl = array ('Indonesia' => 'Indonesia', 'Asing' => 'Foreign');
		}else{
			$kl = array ('Indonesia' => 'Indonesia', 'Asing' => 'Foreign');
		}
		
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
	$_kel = array ('Tersedia', 'Dipakai', 'Perawatan', 'Hilang');
	return $_kel;
}
function is_hari($s){
	$hari = array (1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
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
			'13' => '',
		);
		$getTime 	= explode (" ", $time);
		$getTime1 	= explode ("-", $getTime[0]);
		$getTime2	= $getTime1[2] .' '. $a[$getTime1[1]] .' '. $getTime1[0] .' '. $getTime[1];
		return $getTime2;
	}
}


if( ! function_exists('the_time_noth'))
{
	function the_time_noth($time){
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
			'13' => '',
		);
		$getTime 	= explode (" ", $time);
		$getTime1 	= explode ("-", $getTime[0]);
		$getTime2	= $getTime1[2] .' '. $a[$getTime1[1]] ;
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
function bacaloket($loket){
	   $hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas');
       $baca = "loket ". $hrri[$loket];
	   return $baca;
    }
if( ! function_exists('clean_data'))
{
	function clean_data($dat){
		$clean = strip_tags(trim($dat));
		$clean = str_replace("'-", "", $clean);
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


function get_umur_laporan($str, $akhir, $option=NULL){
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
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	//array('name'=>'HR', 'amount' => 60*60*24)
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
	array('name'=>'TH', 'amount' => 60*60*24*365),
	array('name'=>'BL', 'amount' => 60*60*24*31),
	//array('name'=>'HR', 'amount' => 60*60*24)
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
	function is_def_ttdkatim(){
		return 20;
	}
	function get_ukuran_kertas($nm_kertas){
        $data['a4'] = "";
        $data['a4tutup'] = "";
        $data['f4'] = "";
		return $data[$nm_kertas];
    }
	function get_ukuran_buku($nm_kertas){
        $data['a4'] = "";
        $data['kecil'] = "height:13.2cm;max-height:13.2cm";
        $data['sedang'] = "height:22.5cm;max-height:22.5cm";
        $data['besar'] = "height:30.5cm;max-height:30.5cm";
		return $data[$nm_kertas];
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
	
	
	
	
	
	//MULAI UNTUK MCU
	//LATIEFFFF..............................................
	function is_getPoliMadanDawayaOraKaroAdministratorYaDuzMadSahudGemblungEdan($ket=false){
		$uu = array('Administrator' => 'Administrator', 'Operator' => 'Operator');
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
	
	function is_status_kawin($sta=false){
		$sts = array('B' => 'Belum Menikah', 'S' => 'Sudah Menikah');
		if($sta == true){
			return $sts[$sta];
		}else {
			return $sts;
		}
	}
	
	function is_bangsa($cug=false){
		$sat = array('Indonesia' => 'Indonesia', 'Asing' => 'Asing');
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
	function is_type_dinas($cug=false){
		$sat = array('D' => 'Dinas', 'N' => 'Non Dinas');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_type_detailperiksa($cug=false){
		$sat = array('tetap' => 'Tetap', 'range' => 'Range Angka');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_jenis_detailperiksa($cug=false){
		$sat = array('combo' => 'Combobox', 'radio' => 'Radio Button');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_kesatuan($cug=false){
		$sat = array('-' => '-', 'LANUD' => 'LANUD', 'SKADRON' => 'SKADRON', 'MABES TNI' => 'MABES TNI', 'MABES AD' => 'MABES AD', 'MABES AL' => 'MABES AL', 'MABES AU' => 'MABES AU');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_typeruang($cug=false){
		$sat = array('P' => 'Poliklinik', 'J' => 'Penunjang Medis', 'L' => 'Ruang Tambahan');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_keteranganfisikkhusus($cug=false){
		$sat = array('keterangan_td' => 'Tekanan Darah', 'ketimt' => 'IMT');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function cek_bmi($fd){
		if($fd < 18.5){
			$fs = "Underweight";
		} else if($fd >= 18.5 AND $fd <= 22.99){
			$fs = "Normal";
		} else if($fd >= 23 AND $fd <= 24.99){
			$fs = "Overweight";
		} else if($fd >= 25 AND $fd <= 29.99){
			$fs = "Obesitas I";
		} else if($fd >= 30){
			$fs = "Obesitas II";
		} else {
			$fs = "-";	
		}
		return $fs;
	}
	function is_stakes($cug=false){
		$sat = array('U' => 'U', 'A' => 'A', 'B' => 'B', 'D' => 'D', 'L' => 'L', 'G' => 'G', 'J' => 'J', 'P' => 'P', 'S' => 'S');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_stakes_en($cug=false){
		$sat = array('U' => 'P', 'A' => 'U', 'B' => 'L', 'D' => 'H', 'L' => 'E', 'G' => 'D', 'J' => 'P', 'P' => 'P', 'S' => 'F');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_penyakit_lama($cug=false){
		$sat = array("Hipertensi" => 'Hypertension', "Ayan" => "Epilepsy", "KP" => "Tubercoluse", "Jantung" => "Heart", "Jiwa" => "Psychiatry", "Operasi" => "Surgery", "DM" => "Diabetes", "Alergi" => "Allergy", "Vaksinasi" => "Vaccination", "Lain-Lain" => "Others");
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_penyakit_keluarga($cug=false){
		$sat = array("Hipertensi" => 'Hypertension', "Asma" => "Asthma", "DM" => "Diabetes", "Kanker" => "Cancer", "Lain-Lain" => "Others");
		if($cug == true){
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
	
	
	//--------------satupaket=-----------
	function is_tdfix($cug=false){
		$sat = array('hipo' => 'Hipotensi', 'normal' => 'Normal', 'prehiper' => 'Prehipertensi', 'hpgradesatu' => 'Hipertensi Grade I', 'hpgradedua' => 'Hipertensi Grade II');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	
	function is_tdfixdua($cug=false){
		$sat = array('Hipotensi' => 'hipo', 'Normal' => 'normal', 'Prehipertensi' => 'prehiper', 'Hipertensi Grade I' => 'hpgradesatu', 'Hipertensi Grade II' => 'hpgradedua');
		if($cug == true){
			return $sat[$cug];
		}else {
			return $sat;
		}
	}
	function is_fixname(){
		return "dr. SARYANTO";
	}
	
	function hitungtekanandarah($td1,$td2){
		$gsfsa = "";
		if($td2 < 80){
			if($td1 < 85){
				$gsfsa = "Hipotensi";
			}else{
				$gsfsa = "Normal";
			}
		} else if($td2 < 90){
			$gsfsa = "Prehipertensi";
		} else if($td2 < 100){
			$gsfsa = "Hipertensi Grade I";
		}else{
			$gsfsa = "Hipertensi Grade II";
		}
		return $gsfsa;
	}
	
	function is_laporanlaporan($cug=false){
		$rrrs = array(	
					'a1' => 'Laporan Casis TNI',
					'a2' => 'Laporan ILA/MEDEX KORPS PENERBANG, NAVIGATOR, ILA JMU, MEDEX JMU',
					'a3' => 'Riwayat Pemeriksaan Pasien',
					'a4' => 'Laporan Casis TNI Non Penerbang',
					'a5' => 'Laporan PATI AU',
					'a6' => 'Laporan Rekap MCU KEMENKES',
					'a7' => 'Laporan Pemeriksaan COVID19',
					'a8' => 'Laporan Pasien Grounded',
					'a9' => 'Laporan Pasien Overweight/Obesitas ILA-MEDEX',
					'a10' => 'Laporan Penerimaan Tagihan',
					'a11' => 'Laporan Penerimaan Umum / Swasta',
					'a12' => 'Laporan Tagihan Pasien Berdasarkan No File',
					'a13' => 'Laporan Top 10 Penyakit',
					'a14' => 'Rekapan Dinas Laboratorium',
					'a15' => 'Rekapan Hasil MCU',
					'a16' => 'Rekapan Hasil Spirometri',
				);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	//--------------satupaket=------------------------------------------
	
	
	function is_stakesidtind_casis($cug=false){
		$rrrs = array(	
			'pemfisik' => '6592',
			'treadmill' => '6555',
			'treadmilldua' => '6556',
			'paru' => '6579',
			'neurologi' => '6574',
			'kulit' => '6563',
			'lab' => '5250',
			'ro' => '6626',
			'usg' => '6646',
			'audio' => '6586',
			'tht' => '6583',
			'bedah' => '6548',
			'mata' => '6651',
			'gigi' => '6549',
			'jiwa' => '6632',
			'aero' => '6630',
			'ginekologi' => '6591',
			'ginekologidua' => '6553',
		);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	
	function is_stakesidtind_casis_nonpenerbad($cug=false){
		$rrrs = array(	
			'pemfisik' => '6592',
			'ekg' => '6555',
			'treadmill' => '6556',
			'paru' => '6579',
			'neurologi' => '6574',
			'kulit' => '6563',
			'lab' => '5250',
			'labdua' => '5249',
			'labtiga' => '5249',
			'labtiga' => '6298',
			'labempat' => '5350',
			'ro' => '6626',
			'usg' => '6646',
			'audio' => '6586',
			'tht' => '6583',
			'bedah' => '6548',
			'mata' => '6564',
			'matadua' => '6651',
			'gigi' => '6549',
			'jiwa' => '6632',
			'aero' => '6630',
			'ginekologi' => '6591',
			'ginekologidua' => '6553',
		);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	
	function is_stakesidtind_kemenkes($cug=false){
		$rrrs = array(	
			'ekg' => '6555',
			'spirometri' => '6579',
			'audiometri' => '6586',
			'lab' => '5250',
			'radiologi' => '6626',
			'papsmear' => '6591',
			'usg' => '6646',
			'treadmill' => '6556',
			'dokter_bedah' => '6548',
			'dokter_tht' => '6583',
			'dokter_mata' => '6564',
			'dokter_matadua' => '6651',
			'dokter_syaraf' => '6574',
			'dokter_gigi' => '6549',
			'dokter_dalam' => '6592',
		);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	function is_pemeriksaandokter_kemenkes($cug=false){
		$rrrs = array(	
			'Jantung' => 'dri pemeriksaan fisik jantung',
			'P. Dalam' => 'kesimpulan pemeriksaan fisik',
			'Bedah' => 'pemeriksaan bedah',
			'Paru' => 'dri pemeriksaan fisik paru',
			'THT' => 'dokter_tht',
			'Mata' => 'dokter_mata',
			'Syaraf' => 'dokter_syaraf',
			'Gigi' => 'dokter_gigi',
		);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	function is_ilamedex($cug=false){
		$rrrs = array(	
			'ila' => 'ILA',
			'medex' => 'MEDEX',
			'patiau' => 'PATI AU',
			'kemenkes' => 'KEMENKES',
		);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	//rapid test
	function is_antigen_isi($key, $isi){
		$wjb['kesimpulan']['normal'] = 'Antigen SARS-CoV-2: <b>Negatif</b>';
		
		
		$wjb['saran']['normal'] = array(
			'1' => 'Hasil <b>Negatif</b> tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan ke orang lain',
			'2' => 'Hasil negatif dapat terjadi pada kondisi kuantitas antigen pad spesimen dibawah level deteksi alat',
			'3' => 'Menerapkan PHBS (perilaku hidup bersih dan sehat: mencuci tangan, menerapkan etika batuk, menggunakan masker saat sakit, menjaga stamina), dan <i>physical distancing</i>',
		);
		
		
		$wjb['kesimpulan']['abnormal'] = 'Antigen SARS-CoV-2: <b>Positif</b>';
		
		
		$wjb['saran']['abnormal'] = array(
			'1' => 'Pemeriksaan konfirmasi dengan pemeriksaan RT PCR sebanyak 2 kali dalam 2 hari berturut-turut',
			'2' => 'Lakukan karantina atau isolasi sesuai dengan ketentuan',
			'3' => 'Menerapkan PHBS (perilaku hidup bersih dan sehat: mencuci tangan, menerapkan etika batuk, menggunakan masker saat sakit, menjaga stamina), dan <i>physical distancing</i>',
		);
		
		return $wjb[$key][$isi];
	}
	function is_covid_isi($key, $isi){
		$wjb['kesimpulan']['normal'] = 'Hasil <b>non reaktif</b> tidak menyingkirkan kemungkinan terinfeksi SARS-Cov-2, bisa terjadi pada :';
		
		$wjb['catatan']['normal'] = array(
			'1' => 'Seseorang belum/tidak terinfeksi',
			'2' => 'Window periode (terinfeksi namun antibodi belum terbentuk)',
			'3' => 'Imunokompromais',
			'4' => 'Kadar antibodi dibawah deteksi alat',
		);
		
		$wjb['saran']['normal'] = array(
			'1' => 'Bila hasil  Rapid tes antibodi ini merupakan pemeriksaan pertama, ulangi pemeriksaan 7 sd 10 hari lagi',
			'2' => 'Bila ini merupakan pemeriksaan ulangan, saat ini belum/tidak terdeteksi anti SARS-CoV-2',
			'3' => 'Tetap lakukan social/physical distancing',
			'4' => 'Pertahankan perilaku hidup bersih dan sehat (cuci tangan, terapkan etika batuk, gunakan masker, jaga stamina)',
		);
		
		
		$wjb['kesimpulan']['abnormal'] = 'Hasil <b>Reaktif saat dilakukan pemeriksaan saat ini</b> belum dapat memastikan infeksi SARS-Cov-2.  Hasil Reaktif bisa terjadi pada:';
		$wjb['catatan']['abnormal'] = array(
			'1' => 'Paparan/infeksi SARS-CoV 2',
			'2' => 'Reaksi silang dengan antibody Corona virus lain/ virus lain yang menyerupai',
		);
		
		$wjb['saran']['abnormal'] = array(
			'1' => 'Lanjutkan dengan pemeriksaan  konfirmasi <b>PCR</b>',
			'2' => 'Isolasi diri dengan tetap menjaga  <i>social/physical distancing</i>',
			'3' => 'Perilaku hidup bersih dan sehat (cuci tangan, terapkan etika batuk, gunakan masker, jaga stamina)',
		);
		
		return $wjb[$key][$isi];
	}
	
	
	function is_keteranganstakesok($cug=false){
		$rrrs = array(	
					'1' => 'MS-B',
					'2' => 'MS-C',
					'3' => 'MS-K1',
					'4' => 'TMS-K2',
				);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	function is_romawi($cug=false){
		$rrrs = array(	
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
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	function is_yatidak($cug=false){
		$rrrs = array(	
					'Tidak' => 'Tidak',
					'Ya' => 'Ya',
				);
		if($cug == true){
			return $rrrs[$cug];
		}else {
			return $rrrs;
		}
	}
	
	function is_status_tn($cug){
		$rrrs = array(	
			'L' => 'Tn.',
			'P' => 'Ny.',
		);
		return $rrrs[$cug];
	}
	
	
	function get_lang_hasil($p,$h){
		$phsl['p1'] = "Mohon Konsultasi Ke";
		$phsl['p2'] = "KETUA TIM EVALUASI";
		$phsl['p3'] = "Penjelasan";
		$phsl['p4'] = "Alkohol";
		$phsl['p5'] = "Lendir";
		$phsl['p6'] = "Darah";
		$phsl['p7'] = "Lekosit";
		$phsl['p8'] = "Eritrosit";
		$phsl['p9'] = "Amuba";
		$phsl['p10'] = "Telur Cacing";
		$phsl['p11'] = "Serat Organic";
		$phsl['p12'] = "Keton";
		$phsl['p13'] = "Leukosit";
		$phsl['p14'] = "Nitrit";
		$phsl['p15'] = "Bilirubin Total";
		$phsl['p16'] = "Direk";
		$phsl['p17'] = "Indirek";
		$phsl['p18'] = "Protein Total";
		$phsl['p19'] = "Agregasi Trombosit";
		$phsl['p20'] = "Kolesterol Total";
		$phsl['p21'] = "Trigliserid";
		$phsl['p22'] = "Ureum";
		$phsl['p23'] = "Kreatinin";
		$phsl['p24'] = "Asam Urat";
		$phsl['p25'] = "Hematokrit";
		$phsl['p26'] = "Trombosit";
		$phsl['p27'] = "Negatif";
		$phsl['p28'] = "Positif Satu";
		if($h == "en"){
			$phsl['p1'] = "Please Consult to";
			$phsl['p2'] = "Chief of Medical Evaluation";
			$phsl['p3'] = "Explanation";
			$phsl['p4'] = "Alcohol";
			$phsl['p5'] = "Mucus";
			$phsl['p6'] = "Blood";
			$phsl['p7'] = "Leucocyte";
			$phsl['p8'] = "Erytrocyte";
			$phsl['p9'] = "Amoeba";
			$phsl['p10'] = "Worm eggs";
			$phsl['p11'] = "Organic Fiber";
			$phsl['p12'] = "Ketone";
			$phsl['p13'] = "Leucocytes";
			$phsl['p14'] = "Nitrite";
			$phsl['p15'] = "Total Bilirubin";
			$phsl['p16'] = "Direct";
			$phsl['p17'] = "Indirect";
			$phsl['p18'] = "Total Protein";
			$phsl['p19'] = "Platelets Aggregation";
			$phsl['p20'] = "Total Cholesterol";
			$phsl['p21'] = "Triglycerid";
			$phsl['p22'] = "Urea";
			$phsl['p23'] = "Creatinin";
			$phsl['p24'] = "Uric Acid";
			$phsl['p25'] = "Hematocryte";
			$phsl['p26'] = "Platelets";
			$phsl['p27'] = "Negative";
			$phsl['p28'] = "Positive +";
			
		}
		return $phsl[$p];
	}
	
	function get_api_hash(){
		$gsb = md5(rand(1,1000) . date("YmdHis")) . rand(1,1000);
		$options['sc'] = $gsb;
		$hast = password_hash($gsb, PASSWORD_BCRYPT, $options);
		return $hast;
	}
	
	function is_iplocalserverandroid(){
		return 'http://192.168.30.244';
	}
	