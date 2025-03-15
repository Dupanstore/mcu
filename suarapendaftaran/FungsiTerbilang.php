<?php
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
function terbilangSuara($kalimat){
    $boxKata	= explode(" ",$kalimat);
    $last[0]	= "stop";		
    $boxKata = array_merge($boxKata,$last);
	
    include "OwnXmlWriter.php";
    $xml = new OwnXmlWriter();

    $xml->push('xml');
    foreach ($boxKata as $key => $val)
    {
        if ($val != "")
        {
            $xml->push('track');
            $xml->element('path', 'audio/' . $val . '.mp3');
            $xml->element('title', $val);
            $xml->pop();
        }
    }
    $xml->pop();

    $fp = fopen('playlist.xml', 'w');
    fwrite($fp, $xml->getXml());
    fclose($fp);
    print $kalimat;
}

//untuk antrian pasien poliklinik

function antrianterbilangpoli($bilangan, $loket){
    $kata = array('kosong', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
	$hh = explode("-", $bilangan);
	foreach($hh as $vv){
		$ggggg[] = $kata[$vv];
	}
	$jawab = implode(" ", $ggggg);
   return trim('tongtong nomor rekam medis '. $jawab . " masuk ke poliklinik ". $loket);
}
function terbilangSuarapoli($kalimat){
    $boxKata	= explode(" ",$kalimat);
    $last[0]	= "stop";		
    $boxKata = array_merge($boxKata,$last);
	
    include "OwnXmlWriter.php";
    $xml = new OwnXmlWriter();

    $xml->push('xml');
    foreach ($boxKata as $key => $val)
    {
        if ($val != "")
        {
            $xml->push('track');
            $xml->element('path', 'audio/' . $val . '.mp3');
            $xml->element('title', $val);
            $xml->pop();
        }
    }
    $xml->pop();

    $fp = fopen('playlist.xml', 'w');
    fwrite($fp, $xml->getXml());
    fclose($fp);
    print $kalimat;
}

?>