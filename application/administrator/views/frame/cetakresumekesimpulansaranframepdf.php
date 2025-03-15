<?php if(!$_GET['noprint']){ ?>
<style>
td{
	padding:0;
	margin:0;
	font-size:14px;
}
body {
width: 100%;
height: 100%;
margin: 0;
padding: 0;
background-color: #666666;
font: 12pt "Helvetica";
}
* {
box-sizing: border-box;
-moz-box-sizing: border-box;
}
.ddd {
background:#ffffff !important; 
border:solid 1px #000000 !important; 
margin:-13px 0 0 530px !important; 
}
.page {
width: 8.5in;
padding: 5mm;
margin: 10mm auto;
border: 1px #D3D3D3 solid;
background: white;
}
@media print {
html, body {
width: 8.27in;
min-height: 3.69in;        
}
.page {
margin: 0;
border: initial;
border-radius: initial;
width: initial;
min-height: initial;
box-shadow: initial;
background: initial;
page-break-after: always;
}
.ddd {
background:#ffffff !important; 
border:solid 1px #000000 !important; 
margin:-13px 0 0 456px !important; 
padding:3px 22px 3px 22px !important; 
}
}
@page {
size: 8.27in;
margin: 0;
}

.footer {
position: fixed;
left: 0;
bottom: 0;
width: 100%;
border-top: solid 1px #000000;
color: white;
text-align: center;
}
</style>
<?php } ?>
<?php
$dfr = "select a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
$sbd = $this->db->query($dfr);
$abs = $sbd->result();
$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
$sgd = $this->db->query($shc);
$dgs = $sgd->result();
if($dgs){
	foreach($dgs as $bd){
		$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
	}
}
//ambil data resumnya yaaa
$oiu = "select * from tb_resume_pasien where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' and ket_resume='anamnesa' ";
$aew = $this->db->query($oiu);
$mdn = $aew->result();
if($mdn){
	foreach($mdn as $sa){
		if($sa->ket_resume == "anamnesa"){
			$getAnamnesa = $sa->isi_anamnesa;
		}
		
	}
}
$sga = "select a.kesimpulan_pemeriksaan, a.kesantext, a.val_stakes, b.id_tind, b.kd_tind, b.nm_tind, b.id_ins_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan, e.order_evalusi_group, e.kd_grouptindakan from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
$sfc = $this->db->query($sga);
$ash = $sfc->result();
//print_r($ash);die();
if($ash){
	foreach($ash as $bs){
		//pertama adalah buat barisnya yaaaaa
		//yang pasti bedakan page kanan dan kiriiii yaaaaa
		//intine page 1 tek buat fix kaya asline
		$hsbb = "select a.adakelainan, a.hasilnya, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, c.kd_pem, c.det_order_pemeriksaan, c.satuan, c.nilai_rujukan, d.id_ins from tb_register_detailpemeriksaan a, tb_pemeriksaan c, tb_instalasi d ";
		$hsbb .= "where a.id_pem_deb=c.id_pem  and a.id_ins_tind_detpem=d.id_ins ";
		$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.apakah_pemeriksaan_khusus <> 'Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' order by c.kd_pem ASC ";
		$ansd = $this->db->query($hsbb);
		$ssv = $ansd->result();
		//print_r($ssv);die();
		$nminsnya = strtoupper(str_replace("Poliklinik", "Pemeriksaan", $bs->nm_ins));
		if($bs->id_ins == "2"){
			//yang dihalaman 2 hanya hematologi selain itu dihalaman 3 ya
			if($bs->kd_grouptindakan == "01" OR $bs->kd_grouptindakan == "02" OR $bs->kd_grouptindakan == "03" OR $bs->kd_grouptindakan == "04" ){
				//$pages[2]['kanan'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". strtoupper($bs->nm_ins)."</b></span>";	
				$pages[2]['kanan'][$bs->order_evaluasi] = "<span><b>". strtoupper($bs->nm_ins)."</b></span>";	
				$pages1[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br /><b>". strtoupper($bs->nm_grouptindakan)."</b></span>";
				$pages2[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
				$pages3[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
				foreach($ssv as $hsd){
					$bintangtang = "";
					$lainwarnbld = "";
					if($hsd->adakelainan == "Y"){
						$bintangtang = "*";
						$lainwarnbld = 'style="font-weight:bold;"';
					}
					if($hsd->nm_pem == "HITUNG JENIS"){
						$hsd->nm_pem = "<br /><b>". $hsd->nm_pem ."</b>" ;
					}
					if($hsd->nm_pem == "Monosit"){
						$hsd->nm_pem = $hsd->nm_pem. "<br /><br />";
					}
					if($hsd->satuan == "-"){
						$hsd->satuan = "";
					}
					$pages4[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
					$pages5[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span ".$lainwarnbld.">".$hsd->hasilnya.$bintangtang."</span>";
					$pages6[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
				}
			} else {
				if($bs->kd_grouptindakan == "05" OR $bs->kd_grouptindakan == "06" OR $bs->kd_grouptindakan == "07" OR $bs->kd_grouptindakan == "08" OR $bs->kd_grouptindakan == "09"){
					$pages[3]['kiri'][$bs->order_evaluasi] = "";	
					$pages1[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br /><b>". strtoupper($bs->nm_grouptindakan)."</b></span>";
					$pages2[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
					$pages3[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
					foreach($ssv as $hsd){
						if($hsd->satuan == "-"){
							$hsd->satuan = "";
						}
						$bintangtang = "";
						$lainwarnbld = "";
						if($hsd->adakelainan == "Y"){
							$bintangtang = "*";
							$lainwarnbld = 'style="font-weight:bold;"';
						}
						$pages4[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
						$pages5[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span ".$lainwarnbld.">".$hsd->hasilnya.$bintangtang."</span>";
						$pages6[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
					}
				}else {
					$pages[3]['kanan'][$bs->order_evaluasi] = "";	
					$pages1[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br /><b>". strtoupper($bs->nm_grouptindakan)."</b></span>";
					$pages2[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
					$pages3[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
					foreach($ssv as $hsd){
						if($hsd->satuan == "-"){
							$hsd->satuan = "";
						}
						$bintangtang = "";
						if($hsd->adakelainan == "Y"){
							$bintangtang = "*";
						}
						$pages4[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
						$pages5[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->hasilnya.$bintangtang."</span>";
						$pages6[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
					}
				}
			}
		}else if($bs->id_ins == "3"){
			if($bs->order_evalusi_group <= 11){
				//$pages[2]['kiri'][$bs->order_evalusi_group] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evalusi_group .". PEMERIKSAAN ". strtoupper($bs->nm_grouptindakan)."</b></span>";
				$pages[2]['kiri'][$bs->order_evalusi_group] = "<span><b>PEMERIKSAAN ". strtoupper($bs->nm_grouptindakan)."</b></span>";
				foreach($ssv as $hsd){
					if($hsd->hasilnya == 'Lainnya'){
						$apa = $hsd->ketkelainanlainnya;
					}else{
						$apa = $hsd->hasilnya;
					}
					$pages1[2]['kiri'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $hsd->rad_namapemeriksaan."</span>";
					$pages2[2]['kiri'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
				}
					$pages1[2]['kiri'][$bs->order_evalusi_group][999999] = "<span>Kesan</span>";
					$pages2[2]['kiri'][$bs->order_evalusi_group][999999] = $bs->kesantext;
					
					//$pages1[2]['kiri'][$bs->order_evalusi_group][1000000] = "<span>Kesimpulan</span>";
					//$pages2[2]['kiri'][$bs->order_evalusi_group][1000000] = $bs->kesimpulan_pemeriksaan;
					
					
			}else {
				//$pages[2]['kanan'][$bs->order_evalusi_group] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evalusi_group .". PEMERIKSAAN ". strtoupper($bs->nm_grouptindakan)."</b></span>";
				$pages[2]['kanan'][$bs->order_evalusi_group] = "<span><b>PEMERIKSAAN ". strtoupper($bs->nm_grouptindakan)."</b></span>";
				foreach($ssv as $hsd){
					if($hsd->hasilnya == 'Lainnya'){
						$apa = $hsd->ketkelainanlainnya;
					}else{
						$apa = $hsd->hasilnya;
					}
					$pages1[2]['kanan'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $hsd->rad_namapemeriksaan."</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
				}
					$pages1[2]['kanan'][$bs->order_evalusi_group][999999] = "<span>Kesan</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][999999] = $bs->kesantext;
					
					$pages1[2]['kanan'][$bs->order_evalusi_group][1000000] = "<span>Kesimpulan</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][1000000] = $bs->kesimpulan_pemeriksaan;
			}					
		} else {
			if($bs->order_evaluasi >= 1 and $bs->order_evaluasi <= 3){
				//bedakan antara kiri dan kanan
				
				if($bs->order_evaluasi <= 1){
					if($ssv){
						
						//$pages[1]['kiri'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". $nminsnya."</b></span>";
						$pages[1]['kiri'][$bs->order_evaluasi] = "<span><b>". $nminsnya."</b></span>";
						foreach($ssv as $hsd){
							if($hsd->hasilnya == 'Lainnya'){
								$apa = $hsd->ketkelainanlainnya;
							}else{
								$apa = $hsd->hasilnya;
							}
							$pages1[1]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $hsd->det_nm_pemeriksaan."</span>";
							$pages2[1]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
						}
						$pages1[1]['kiri'][$bs->order_evaluasi][1000000] = "<span>Kesimpulan</span>";
						if(!empty($bs->kesimpulan_pemeriksaan)){
							$pagesx[1]['kiri'][$bs->order_evaluasi][1000000][] = $bs->kesimpulan_pemeriksaan;
						}
						$pages2[1]['kiri'][$bs->order_evaluasi][1000000] = implode(", ", $pagesx[1]['kiri'][$bs->order_evaluasi][1000000]);
						
					}
				} else {
					//$pages[1]['kanan'][$bs->order_evaluasi] = "<span style='margin:0 0 0 15px;'><b>". $bs->order_evaluasi .". ". $nminsnya."</b></span>";
					$pages[1]['kanan'][$bs->order_evaluasi] = "<span><b>". $nminsnya."</b></span>";
					foreach($ssv as $hsd){
						if($hsd->hasilnya == 'Lainnya'){
							$apa = $hsd->ketkelainanlainnya;
						}else{
							$apa = $hsd->hasilnya;
						}
							$pages1[1]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $hsd->det_nm_pemeriksaan."</span>";
							$pages2[1]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
						}
						$pages1[1]['kanan'][$bs->order_evaluasi][1000000] = "<span>Kesimpulan</span>";
						if(!empty($bs->kesimpulan_pemeriksaan)){
							$pagesx[1]['kanan'][$bs->order_evaluasi][1000000][] = $bs->kesimpulan_pemeriksaan;
						}
						$pages2[1]['kanan'][$bs->order_evaluasi][1000000] = implode(", ", $pagesx[1]['kanan'][$bs->order_evaluasi][1000000]);
				}
			} else {
				if($bs->order_evaluasi <= 11){
					if($ssv){
						//$pages[2]['kiri'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". $nminsnya."</b></span>";
						$pages[2]['kiri'][$bs->order_evaluasi] = "<span><b>". $nminsnya."</b></span>";
						foreach($ssv as $hsd){
							if($hsd->hasilnya == 'Lainnya'){
								$apa = $hsd->ketkelainanlainnya;
							}else{
								$apa = $hsd->hasilnya;
							}
							$pages1[2]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $hsd->det_nm_pemeriksaan."</span>";
							$pages2[2]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
						}
						$pages1[2]['kiri'][$bs->order_evaluasi][1000000] = "<span>Kesimpulan</span>";
						if(!empty($bs->kesimpulan_pemeriksaan)){
							$pagesx[2]['kiri'][$bs->order_evaluasi][1000000][] = $bs->kesimpulan_pemeriksaan;
						}
						$pages2[2]['kiri'][$bs->order_evaluasi][1000000] = implode(", ", $pagesx[2]['kiri'][$bs->order_evaluasi][1000000]);
					}
				} else {
					//$pages[2]['kanan'][$bs->order_evaluasi] = "<span style='margin:0 0 0 15px;'><b>". $bs->order_evaluasi .". ". $nminsnya."</b></span>";
					$pages[2]['kanan'][$bs->order_evaluasi] = "<span><b>". $nminsnya."</b></span>";
					foreach($ssv as $hsd){
						if($hsd->hasilnya == 'Lainnya'){
							$apa = $hsd->ketkelainanlainnya;
						}else{
							$apa = $hsd->hasilnya;
						}
							$pages1[2]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $hsd->det_nm_pemeriksaan."</span>";
							$pages2[2]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $apa."</span>";
					}
					$pages1[2]['kanan'][$bs->order_evaluasi][1000000] = "<span>Kesimpulan</span>";
					if(!empty($bs->kesimpulan_pemeriksaan)){
							$pagesx[2]['kanan'][$bs->order_evaluasi][1000000][] = $bs->kesimpulan_pemeriksaan;
						}
						$pages2[2]['kanan'][$bs->order_evaluasi][1000000] = implode(", ", $pagesx[2]['kanan'][$bs->order_evaluasi][1000000]);
				}
			}
		}
	}
}
//print_r($pages4);
	
?>


<?php
$html  =   '<html><body>';
$html   .=  '<style>
.tb1{
font-size:14px;
}
.tb2{
font-size:14px;
border-spacing: 0;
text-decoration:underline;
}
.tb3{
font-size:14px;
border-spacing: 0;
}
.tb4{
font-size:14px;
border-spacing: 0;
}
</style>';


$f = range(1,3);
$akhirpage = 3;
if($f){ 
$nm = 1;
foreach($f as $val){
$um = $nm++;

$html   .= '<div class="page">';
$html   .= '<div style="border-bottom:solid 1px #000000;'.@get_ukuran_kertas('f4').';">';
if($um == "1") {
if(!$_GET['noprint']){ 
$html   .=  '
<table style="vertical-align:top;width:100%">
<tr>
<td style="vertical-align:top">
<div align="left">
<b class="tb1">MARKAS BESAR ANGKATAN UDARA</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<b class="tb2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LAKESPRA '.is_fixname().'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

</div>
</td>
</tr>
</table>
<div align="center"><b class="tb2">RESUME DATA MEDIS</b></div>
<table style="vertical-align:top;width:100%;margin-top:10px;" class="tb3">
<tr>
<td style="vertical-align:top;width:22%;">No File / Umur</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs[0]->no_filemcu.' ['.@get_umur($abs[0]->tgl_lhr_pas).']</td>
</tr>
<tr>
<td style="vertical-align:top">Nama / No Reg</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs[0]->nm_pas.' ['.@$abs[0]->no_reg.']</td>
</tr>
<tr>
<td style="vertical-align:top">Pangkat/NRP/NIP</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@$abs[0]->pangkat_pas.'/'.@$abs[0]->nip_nrp_nik.'</td>
</tr>
<tr>
<td style="vertical-align:top">Jawatan / Jabatan</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs[0]->nm_jawatan.' / '.@$abs[0]->jabatan_pas.'</td>
</tr>
<tr>
<td style="vertical-align:top">Tempat/Tanggal Lahir</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@$abs[0]->tmp_lahir_pas.', '.@date("d/m/Y", strtotime($abs[0]->tgl_lhr_pas)).'</td>
</tr>
<tr>
<td style="vertical-align:top">Tanggal Pemeriksaan</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@date("d/m/Y", strtotime($abs[0]->tgl_awal_reg)).'</td>
</tr>
</table>
<hr />
<table style="vertical-align:top;width:100%" class="tb4">
<tr>
<td width="2%">A.</td>
<td style="vertical-align:top">Berat Badan : '.@$pemkss['beratbadan'].' Kg</td>
<td style="vertical-align:top">Tinggi : '.@$pemkss['tinggibadan'].' cm</td>
<td style="vertical-align:top">Tensi : '.@$pemkss['tekanan_darah1'].'/'.@$pemkss['tekanan_darah2'].' mmHg</td>
<td style="vertical-align:top">Nadi : '.@$pemkss['nadi'].' x/mnt</td>
<td style="vertical-align:top">LP : '.@$pemkss['lingkarperut'].' Cm</td>
<td style="vertical-align:top">LD : '.@$pemkss['lingkardada1'].'-'.@$pemkss['lingkardada2'].' Cm</td>
</tr>
<tr>
<td colspan="7"><hr />
<table width="100%" class="tb4">
<tr>
<td width="15%" style="vertical-align:top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anamnesa</td>
<td width="1%" style="vertical-align:top;">:</td>
<td style="vertical-align:top;">
<pre style="border:0;background:#ffffff;font-size:14px;font-family: arial;margin:0;padding:0;">'.$getAnamnesa.'<br /></pre>
</td>
</tr>
</table>
</td>
</tr>
</table>
<hr />';
}
}

$html   .= '<table style="vertical-align:top;width:100%" class="tb4" >
<tr>';
$html   .= '<td style="vertical-align:top;width:48%;vertical-align:top;">';


//kiriiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
$html   .='<table width="100%" class="tb4">'; 
ksort($pages[$um]['kiri']);
foreach($pages[$um]['kiri'] as $ke => $fr){
$html   .='<tr><td colspan="3">'.$fr.'</td></tr>';
if($ke == 1){
$pemkss['ketimt'] = str_replace("kg", "", $pemkss['ketimt']);
$pemkss['ketimt'] = str_replace("Kg", "", $pemkss['ketimt']);
$ketimts = $pemkss['ketimt'] != "" ? " (". $pemkss['ketimt'].")" :"";
$html   .='<tr>
<td style="vertical-align:top">Tinggi Badan</td>
<td style="vertical-align:top">'.$pemkss['tinggibadan'].' cm</td>
</tr>
<tr>
<td style="vertical-align:top">Berat Badan</td>
<td style="vertical-align:top">'.$pemkss['beratbadan'].' Kg</td>
</tr>
<tr>
<td style="vertical-align:top"><span style="margin:0 0 0 8px">Ideal</td>
<td style="vertical-align:top">'.$pemkss['beratbadanideal'].' Kg</td>
</tr>
<tr>
<td style="vertical-align:top"><span style="margin:0 0 0 8px">Max</td>
<td style="vertical-align:top">'.$pemkss['beratbadanmax'].' Kg</td>
</tr>
<tr>
<td style="vertical-align:top"><span style="margin:0 0 0 8px">Min</td>
<td style="vertical-align:top">'.$pemkss['beratbadanmin'].' Kg</td>
</tr>
<tr>
<td style="vertical-align:top">IMT</td>
<td style="vertical-align:top">'.$pemkss['imt'].' Kg/m<sup>2</sup> '.  $ketimts. '</td>
</tr>
<tr>
<td style="vertical-align:top">TD Sistolik</td>
<td style="vertical-align:top">'.$pemkss['tekanan_darah1'].' mmHg</td>
</tr>
<tr>
<td style="vertical-align:top">TD Diastolik</td>
<td style="vertical-align:top">'.$pemkss['tekanan_darah2'].' mmHg</td>
</tr>
<tr>
<td style="vertical-align:top">Denyut Nadi (x/mnt)</td>
<td style="vertical-align:top">'.$pemkss['nadi'].' x/mnt</td>
</tr>
<tr>
<td style="vertical-align:top">Frekuensi Pernafasan</td>
<td style="vertical-align:top">'.$pemkss['pernafasan'].' mnt</td>
</tr>';

} 
ksort($pages1[$um]['kiri'][$ke]);
foreach($pages1[$um]['kiri'][$ke] as $ju => $va){
if($ke <> 13 OR ($ke == 13 and is_array($pages4[$um]['kiri'][$ke][$ju]))){
$html   .='<tr>
<td style="vertical-align:top;width:40%">'.$va.'</td>
<td style="vertical-align:top">'.$pages2[$um]['kiri'][$ke][$ju].'</td>
</tr>';
}	
//jika ada uri 3 brrti lab yaaaaaaaaaaaaa
if(is_array($pages3)){
ksort($pages3[$um]['kiri'][$ke][$ju]);
foreach($pages3[$um]['kiri'][$ke][$ju] as $mo => $at){
ksort($pages4[$um]['kiri'][$ke][$ju][$mo]);
foreach($pages4[$um]['kiri'][$ke][$ju][$mo] as $bb => $cc){
$html   .='<tr>
<td style="vertical-align:top">'.$cc.'</td>
<td style="vertical-align:top">'.$pages5[$um]['kiri'][$ke][$ju][$mo][$bb].'</td>
<td style="vertical-align:top"><div align="right">'.$pages6[$um]['kiri'][$ke][$ju][$mo][$bb].'</div></td>
</tr>';
}
}
}
} 
$html   .= '<tr><td colspan="3"><br /></td></tr>';
if($ke == 1){ 
$html   .= '<!--<tr><td colspan="3"><span style="margin:0 0 0 8px"><b>INBODY</b></span></td></tr>
<tr>
<td style="vertical-align:top">KESAN</td>
<td style="vertical-align:top">'.$pemkss['inbody'].'</td>
</tr>
<tr><td colspan="3"><br /></td></tr>-->';
}
}
$html   .= '</table>';
$html   .= '</td>';	
$html   .= '<td style="vertical-align:top"></td>';
$html   .= '<td style="vertical-align:top;width:48%;vertical-align:top;">';



//kanannnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn
$html   .='<table width="100%" class="tb4">';
ksort($pages[$um]['kanan']);
foreach($pages[$um]['kanan'] as $ke => $fr){
$html   .='<tr><td colspan="3">'.$fr.'</td></tr>';
ksort($pages1[$um]['kanan'][$ke]);
foreach($pages1[$um]['kanan'][$ke] as $ju => $va){
if($ke <> 13 OR ($ke == 13 and is_array($pages4[$um]['kanan'][$ke][$ju]))){
$html   .= '<tr>
<td style="vertical-align:top;width:40%">'.$va.'</td>
<td style="vertical-align:top">'.$pages2[$um]['kanan'][$ke][$ju].'</td>
</tr>';
if(is_array($pages3)){
ksort($pages3[$um]['kanan'][$ke][$ju]);
foreach($pages3[$um]['kanan'][$ke][$ju] as $mo => $at){
ksort($pages4[$um]['kanan'][$ke][$ju][$mo]);
foreach($pages4[$um]['kanan'][$ke][$ju][$mo] as $bb => $cc){
$html   .= '<tr>
<td style="vertical-align:top">'.$cc.'</td>
<td style="vertical-align:top">'.$pages5[$um]['kanan'][$ke][$ju][$mo][$bb].'</td>
<td style="vertical-align:top"><div align="right">'.$pages6[$um]['kanan'][$ke][$ju][$mo][$bb].'</div></td>
</tr>';
}
} 
} 
}
} 
$html   .= '<tr><td colspan="3"><br /></td></tr>';
}
$html   .= '</table>';									
$html   .= '</td>';	
$html   .=	'</tr></table>';
$html   .=  '</div>';



$html   .= '<div class="footerss">';
$html   .= '<table width="100%" style="font-size:14px;">';
$this->db->where('kd_dok', 'KALA');
$kklids = $this->db->get('tb_dokter');
$sghdfs = $kklids->row();
 if(!$_GET['noprint']){
$html   .= '<td style="vertical-align:top;"><small>Halaman '.$um.' of '.$akhirpage.'<br />'.$abs[0]->nm_pas.' ['.$abs[0]->no_reg.']</small></td>
<td style="vertical-align:top;"><div align="right"><small>'.$pen[0]->nm_sub.' '.$this->rs_code[0]->NAMA_PPK.'</small></div></td>';
 }
if($akhirpage == $um){
	 if(!$_GET['noprint']){
$html   .= '<td width="20%"></td>
<td style="vertical-align:top">
<div align="center" style="font-size:14px;font-family: arial;">
KETUA TIM PEMERIKSAAN KESEHATAN<br/><br/><br/><br/><br/><span >'.$sghdfs->nm_dok.'</span><br />'.$sghdfs->pangkat.'
</div>
</td>';
}
}
$html   .='</table>';
$html   .=  '</div>';
$html   .=  '</div>';
}
}
$html   .=  '</body></html>';

?>
<?php if(!$_GET['noprint']){ ?>
<script type="text/javascript">
	window.print();
</script>
<?php } ?>
<?php
echo $html;
die();

?>