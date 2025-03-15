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
$dfr = "select a.qr_code_keys, a.def_ttd, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
$sbd = $this->db->query($dfr);
$abs = $sbd->row();

if(!empty($abs->qr_code_keys)){
	$qkeysx = $abs->qr_code_keys;
	$this->load->library('ciqrcode');
	$params['data'] = "https://qr.lakesprasaryanto.com/?uid=".$qkeysx;
	$params['level'] = 'H';
	$params['size'] = 2;
	$params['savename'] = FCPATH.'/qr/Q1-'.$abs->kode_transaksi.'.png';
	$this->ciqrcode->generate($params);
}
	
	
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

$kop1 = explode("RKP:",$getAnamnesa);
$kop2 = explode("RKK:",$kop1[1]);
$sdcd = '<table style="width:100%;font-size:10px;font-family:arial;">';
			if(!empty(trim(trim($kop1[0])))){ 
			$sdcd .='<tr>
				<td style="width:15%">Complaint</td>
				<td style="width:2%">:</td>
				<td style="width:88%">'.@str_replace("Keluhan:", "", $kop1[0]).'</td>
			</tr>';
			} 
			if(!empty(trim(trim($kop2[0])))){
			$sdcd .='<tr>
				<td>Past History</td>
				<td>:</td>
				<td>'.@$kop2[0].'</td>
			</tr>';
			}
			if(!empty(trim(trim($kop2[1])))){ 
			$sdcd .='<tr>
				<td>Past Family History</td>
				<td>:</td>
				<td>'.@$kop2[1].'</td>
			</tr>';
			 } 
		$sdcd .='</table>';
$sga = "select a.kesimpulan_pemeriksaan, a.kesantext, a.val_stakes, b.id_tind, b.kd_tind, b.nm_tind, b.id_ins_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d.in_english_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan,e.en_english_group, e.order_evalusi_group, e.kd_grouptindakan from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
$sfc = $this->db->query($sga);
$ash = $sfc->result();
//print_r($ash);die();
if($ash){
	$arrpre = array('DBN', 'D.B.N');
	foreach($ash as $bs){
		if(!empty($bs->en_english_group)){
			$bs->nm_grouptindakan = $bs->en_english_group;
		}
		if($bs->id_ins == "13"){
			//kalau tht dbn dihilangkannnnn
			$bs->kesimpulan_pemeriksaan = str_replace($arrpre, '', $bs->kesimpulan_pemeriksaan);
		}
		//pertama adalah buat barisnya yaaaaa
		//yang pasti bedakan page kanan dan kiriiii yaaaaa
		//intine page 1 tek buat fix kaya asline
		$hsbb = "select a.adakelainan, a.hasilnya, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, c.kd_pem, c.det_order_pemeriksaan, c.in_english_pem, c.satuan, c.nilai_rujukan, d.id_ins from tb_register_detailpemeriksaan a, tb_pemeriksaan c, tb_instalasi d ";
		$hsbb .= "where a.id_pem_deb=c.id_pem  and a.id_ins_tind_detpem=d.id_ins ";
		$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.apakah_pemeriksaan_khusus <> 'Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' order by c.kd_pem ASC ";
		$ansd = $this->db->query($hsbb);
		$ssv = $ansd->result();
		//print_r($ssv);die();
		$nminsnya = strtoupper(str_replace("Poliklinik", "Pemeriksaan ", $bs->nm_ins));
		if(!empty($bs->in_english_ins)){
			$nminsnya = strtoupper($bs->in_english_ins);
		}
		if($bs->id_ins == "2"){
			//yang dihalaman 2 hanya hematologi selain itu dihalaman 3 ya
			if($bs->kd_grouptindakan == "01" OR $bs->kd_grouptindakan == "02" OR $bs->kd_grouptindakan == "03" OR $bs->kd_grouptindakan == "04" ){
				//$pages[2]['kanan'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". strtoupper($bs->nm_ins)."</b></span>";	
				$pages[2]['kanan'][$bs->order_evaluasi] = "<span><b>". strtoupper($nminsnya)."</b></span>";	
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
					$kdnfnf = $hsd->in_english_pem;
					if(empty($kdnfnf)){
						$kdnfnf = $hsd->nm_pem;
					}
					
					if($hsd->nm_pem == "HITUNG JENIS"){
						if(!empty($hsd->in_english_pem)){
							$kdnfnf = "<br /><b>". strtoupper($hsd->in_english_pem) ."</b>" ;
						}else{
							$kdnfnf = "<br /><b>". $hsd->nm_pem ."</b>" ;
						}
						
					}
					if($hsd->nm_pem == "Monosit"){
						if(!empty($hsd->in_english_pem)){
							$kdnfnf = $hsd->in_english_pem. "<br /><br />";
						}else{
							$kdnfnf = $hsd->nm_pem. "<br /><br />";
						}
					}
					if($hsd->satuan == "-"){
						$hsd->satuan = "";
					}
					
					$pqwer = $hsd->nilai_rujukan;
					if($this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan)){
						$pqwer = $this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan);
					}
					
					$isihasil = $hsd->hasilnya;
					if($this->madmin->rsau_postifif_negatif_en($isihasil)){
						$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
					}
					
					$pages4[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$kdnfnf."</span>";
					$pages5[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span ".$lainwarnbld.">".$isihasil.$bintangtang."</span>";
					$pages6[2]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$pqwer ."</span>";
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
						
						$kdnfnf = $hsd->in_english_pem;
						if(empty($kdnfnf)){
							$kdnfnf = $hsd->nm_pem;
						}
						
						$pqwer = $hsd->nilai_rujukan;
						if($this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan)){
							$pqwer = $this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan);
						}
						
						$isihasil = $hsd->hasilnya;
						if($this->madmin->rsau_postifif_negatif_en($isihasil)){
							$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
						}
						$pages4[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$kdnfnf."</span>";
						$pages5[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span ".$lainwarnbld.">".$isihasil.$bintangtang."</span>";
						$pages6[3]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$pqwer ."</span>";
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
						
						$kdnfnf = $hsd->in_english_pem;
						if(empty($kdnfnf)){
							$kdnfnf = $hsd->nm_pem;
						}
						
						$pqwer = $hsd->nilai_rujukan;
						if($this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan)){
							$pqwer = $this->madmin->rsau_postifif_negatif_en($hsd->nilai_rujukan);
						}
						
						$isihasil = $hsd->hasilnya;
						if($this->madmin->rsau_postifif_negatif_en($isihasil)){
							$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
						}
						
						$pages4[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$kdnfnf."</span>";
						$pages5[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$isihasil.$bintangtang."</span>";
						$pages6[3]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$pqwer ."</span>";
					}
				}
			}
		}else if($bs->id_ins == "3"){
			if($bs->order_evalusi_group <= 11){
				//$pages[2]['kiri'][$bs->order_evalusi_group] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evalusi_group .". PEMERIKSAAN ". strtoupper($bs->nm_grouptindakan)."</b></span>";
				$pages[2]['kiri'][$bs->order_evalusi_group] = "<span><b>". strtoupper($bs->nm_grouptindakan)."</b></span>";
				foreach($ssv as $hsd){
					if($hsd->hasilnya == 'Lainnya'){
						$apa = $hsd->ketkelainanlainnya;
					}else{
						$apa = $hsd->hasilnya;
					}
						$kdnfnf = $hsd->in_english_pem;
						if(empty($kdnfnf)){
							$kdnfnf = $hsd->rad_namapemeriksaan;
						}
						
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
					$pages1[2]['kiri'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
					$pages2[2]['kiri'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
				}
					$pages1[2]['kiri'][$bs->order_evalusi_group][999999] = "<span>Impression</span>";
					$pages2[2]['kiri'][$bs->order_evalusi_group][999999] = $bs->kesantext;
					  
					//$pages1[2]['kiri'][$bs->order_evalusi_group][1000000] = "<span>Summary</span>";
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
						$kdnfnf = $hsd->in_english_pem;
						if(empty($kdnfnf)){
							$kdnfnf = $hsd->rad_namapemeriksaan;
						}
						
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
					$pages1[2]['kanan'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
				}
					$pages1[2]['kanan'][$bs->order_evalusi_group][999999] = "<span>Impression</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][999999] = $bs->kesantext;
					
					$pages1[2]['kanan'][$bs->order_evalusi_group][1000000] = "<span>Summary</span>";
					$pages2[2]['kanan'][$bs->order_evalusi_group][1000000] = $bs->kesimpulan_pemeriksaan;
			}					
		} else {
			if($bs->order_evaluasi >= 1 and $bs->order_evaluasi <= 3){				
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
							$kdnfnf = $hsd->in_english_pem;
							if(empty($kdnfnf)){
								$kdnfnf = $hsd->det_nm_pemeriksaan;
							}
							
							//ngrubah IMT jdi BMI
							
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
							$pages1[1]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
							$pages2[1]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
						}
						$pages1[1]['kiri'][$bs->order_evaluasi][1000000] = "<span>Summary</span>";
						if(!empty($bs->kesimpulan_pemeriksaan)){
							$bs->kesimpulan_pemeriksaan = str_replace("IMT ", "BMI ", $bs->kesimpulan_pemeriksaan);
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
							$kdnfnf = $hsd->in_english_pem;
							if(empty($kdnfnf)){
								$kdnfnf = $hsd->det_nm_pemeriksaan;
							}
							
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
							$pages1[1]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
							$pages2[1]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
						}
						$pages1[1]['kanan'][$bs->order_evaluasi][1000000] = "<span>Summary</span>";
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
							$kdnfnf = $hsd->in_english_pem;
							if(empty($kdnfnf)){
								$kdnfnf = $hsd->det_nm_pemeriksaan;
							}
							
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
							$pages1[2]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
							$pages2[2]['kiri'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
						}
						$pages1[2]['kiri'][$bs->order_evaluasi][1000000] = "<span>Summary</span>";
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
							$kdnfnf = $hsd->in_english_pem;
							if(empty($kdnfnf)){
								$kdnfnf = $hsd->det_nm_pemeriksaan;
							}
							$isihasil = $apa;
							if($this->madmin->rsau_postifif_negatif_en($isihasil)){
								$isihasil = $this->madmin->rsau_postifif_negatif_en($isihasil);
							}
							$pages1[2]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $kdnfnf."</span>";
							$pages2[2]['kanan'][$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = "<span>". $isihasil."</span>";
					}
					$pages1[2]['kanan'][$bs->order_evaluasi][1000000] = "<span>Summary</span>";
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
<b class="tb1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Indonesian Airforce Headquarter</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<b class="tb2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Institute of Aviation and Aerospace Medicine dr.Saryanto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

</div>
</td>
</tr>
</table>
<div align="center"><b class="tb2"><br />MEDICAL RESUME</b></div>
<table style="vertical-align:top;width:100%;margin-top:10px;" class="tb3">
<tr>
<td style="vertical-align:top;width:22%;">File Number / Age</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs->no_filemcu.' ['.@get_umur($abs->tgl_lhr_pas).']</td>
<td rowspan="6" style="width:20%"><br /><br /></td>
</tr>
<tr>
<td style="vertical-align:top">Name / Reg Number</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs->nm_pas.' ['.@$abs->no_reg.']</td>
</tr>
<tr>
<td style="vertical-align:top">Grade / Security Number</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@$abs->pangkat_pas.'/'.@$abs->nip_nrp_nik.'</td>
</tr>
<tr>
<td style="vertical-align:top">Occupation</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.$abs->nm_jawatan.' / '.@$abs->jabatan_pas.'</td>
</tr>
<tr>
<td style="vertical-align:top">Place / Date of birth</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@$abs->tmp_lahir_pas.', '.@date("d/m/Y", strtotime($abs->tgl_lhr_pas)).'</td>
</tr>
<tr>
<td style="vertical-align:top">Date of examination</td>
<td style="vertical-align:top;width:10px;">:</td>
<td style="vertical-align:top">'.@date("d/m/Y", strtotime($abs->tgl_awal_reg)).'</td>
</tr>
</table>
<hr />
<table style="vertical-align:top;width:100%" class="tb4">
<tr>
<td width="2%" style="vertical-align:top;">A.</td>
<td style="vertical-align:top">Weight: <br />'.@$pemkss['beratbadan'].' Kg</td>
<td style="vertical-align:top">Height: <br />'.@$pemkss['tinggibadan'].' cm</td>
<td style="vertical-align:top">Blood Presure: <br />'.@$pemkss['tekanan_darah1'].'/'.@$pemkss['tekanan_darah2'].' mmHg</td>
<td style="vertical-align:top">Pulse rate: <br />'.@$pemkss['nadi'].' x/mnt</td>
<td style="vertical-align:top">Abdominal circumference: <br />'.@$pemkss['lingkarperut'].' Cm</td>
<td style="vertical-align:top">Chest circumference: <br />'.@$pemkss['lingkardada1'].'-'.@$pemkss['lingkardada2'].' Cm</td>
</tr>
<tr>
<td colspan="7"><hr />
<table width="100%" class="tb4">
<tr>
<td width="15%" style="vertical-align:top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anamnesis</td>
<td width="1%" style="vertical-align:top;">:</td>
<td style="vertical-align:top;">
<pre style="border:0;background:#ffffff;font-size:14px;font-family: arial;margin:0;padding:0;">'.$sdcd.'<br /></pre>
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
$pemkss['plt'] = $pemkss['plt'] == "" ? "" : $pemkss['plt']." %";
$html   .='<tr>
<td style="vertical-align:top">Height</td>
<td style="vertical-align:top">'.$pemkss['tinggibadan'].' cm</td>
</tr>
<tr>
<td style="vertical-align:top">Weight</td>
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
<td style="vertical-align:top">BMI</td>
<td style="vertical-align:top">'.$pemkss['imt'].' Kg/m<sup>2</sup> '.  $ketimts. '</td>
</tr>
<tr>
<td style="vertical-align:top">PLT</td>
<td style="vertical-align:top">'.$pemkss['plt'].' </td>
</tr>
<tr>
<td style="vertical-align:top">Foot length</td>
<td style="vertical-align:top">'.$pemkss['panjangkaki'].' </td>
</tr>
<tr>
<td style="vertical-align:top">Sitting Height</td>
<td style="vertical-align:top">'.$pemkss['tinggiduduk'].' </td>
</tr>
<tr>
<td style="vertical-align:top">Blood Presure Sistolik</td>
<td style="vertical-align:top">'.$pemkss['tekanan_darah1'].' mmHg</td>
</tr>
<tr>
<td style="vertical-align:top">Blood Presure Diastolik</td>
<td style="vertical-align:top">'.$pemkss['tekanan_darah2'].' mmHg</td>
</tr>
<tr>
<td style="vertical-align:top">Pulse Rate (x/mnt)</td>
<td style="vertical-align:top">'.$pemkss['nadi'].' x/mnt</td>
</tr>
<tr>
<td style="vertical-align:top">Respiration Rate</td>
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
<td style="vertical-align:top">Impression</td>
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
if($abs->def_ttd > 0){
	$this->db->where('id_dok', $abs->def_ttd);
	$cmb1 = $this->db->get('tb_dokter');
	$sghdfs = $cmb1->row();
}
 if(!$_GET['noprint']){
$html   .= '<td style="vertical-align:top;"><small>Page '.$um.' of '.$akhirpage.'<br />'.$abs->nm_pas.' ['.$abs->no_reg.']</small></td>
<td style="vertical-align:top;"><div align="right"><small>'.$pen[0]->nm_sub.' '.$this->rs_code[0]->NAMA_PPK.'</small></div></td>';
 }
if($akhirpage == $um){
	 if(!$_GET['noprint']){
$html   .= '<td width="20%"></td>
<td style="vertical-align:top">
<div align="center" style="font-size:14px;font-family: arial;">
Chief of IAAM dr Saryanto<br/><!--'.$sghdfs->golongan.'<br/><br/><br/>--><img src="'.@base_url('qr/Q1-'.$abs->kode_transaksi.'.png').'" style="width:95px"><br/><span >'.$sghdfs->nm_dok.'</span><br />'.$sghdfs->pangkat_en.'
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