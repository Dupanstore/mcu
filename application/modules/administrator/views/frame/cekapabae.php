<?php
$cetakk =1;
if(isset($_GET['jumcetak'])){
	$cetakk =$_GET['jumcetak'];
}
$dfr = "select a.def_ttd, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
	//ambil data resumnya yaaa
	$oiu = "select * from tb_resume_pasien where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$aew = $this->db->query($oiu);
	$mdn = $aew->result();
	//print_r($mdn);
	if($mdn){
		foreach($mdn as $sa){
			
			if($sa->aktif_diagnosakelainan != "N"){
				if($sa->ket_resume == "anamnesa"){
					$getAnamnesa = $sa->isi_anamnesa;
				}
				if($sa->ket_resume == "diagnosakelainan"){
					$namakelainan = $sa->nama_kelainan;
					if($sa->kelainan_key == "01L"){
						$namakelainan = "Kulit";
					}
					if($sa->kelainan_key == "01B"){
						$namakelainan = "Bedah";
					}
					$getDiagnosalain[$sa->kelainan_key] = $namakelainan;
					$getDiagnosalain1[$sa->kelainan_key] = $sa->urut_kelainan;
					$getDiagnosalain2[$sa->kelainan_key][substr($sa->stakes_kelainan, 0, 1)] = "x";
					$ghdhhjshjg = "";
					if(!empty($sa->stakes_kelainan)){
						$ghdhhjshjg = " (".$sa->stakes_kelainan.")";
					}
					$getDiagnosalain3[$sa->kelainan_key] = $sa->kesimpulan_kelainan .$ghdhhjshjg;
				}
				if($sa->ket_resume == "periksatambahan"){
					$pemeriksaantambahan[$sa->nama_kelainan] = $sa->isi_kelainan;
				}
				if($sa->ket_resume == "kesimpulansaran"){
					$kesansaran[$sa->nama_kesansaran] = $sa->isi_kesansaran;
				}
			}
			
		}
	}
//headerrrrrr.....................................
$html = '';
for($jdmbf=1;$jdmbf<=$cetakk;$jdmbf++){
$html .= '
<style>
.underlined { 
      text-decoration: underline;       
}
</style>
<table style="font-size:10px;width:100%">
	<tr><td colspan="3"><b>MARKAS BESAR ANGKATAN UDARA</b></td></tr>
	<tr >
	<td style="width:1.5%">&nbsp;&nbsp;</td>
	<td style="border-bottom:1px solid #000000;width:28%;">&nbsp;&nbsp;&nbsp;&nbsp;<b>LAKESPRA '.@is_fixname().'</b></td></tr>
</table>
';

$html .= '
<table style="font-size:10px;width:100%" cellpadding="3">
	<tr><td colspan="3"><div align="center"><br /><b class="underlined">RESUME DATA MEDIS</b></div></td></tr>
</table>
';

$html .= '
<table width="100%" style="font-size:10px;border-spacing:0;font-family: arial;" cellpadding="1px">
<tr>
<td width="25%">No File / Umur</td>
<td width="2%">:</td>
<td width="73%" colspan="4">'.@$abs->no_filemcu.' ['.@get_umur($abs->tgl_lhr_pas).']</td>

</tr>
<tr>
<td>Nama / No Reg</td>
<td>:</td>
<td colspan="4">'.@$abs->nm_pas.' ['.@$abs->no_reg.']</td>

</tr>
<tr>
<td>Pangkat/NRP/NIP</td>
<td>:</td>
<td colspan="4">'.@$abs->pangkat_pas.'/'.@$abs->nip_nrp_nik.'</td>

</tr>
<tr>
<td>Jabatan / Jawatan</td>
<td>:</td>
<td colspan="4">'.@$abs->jabatan_pas.' / '.@$abs->nm_jawatan.'</td>

</tr>
<tr>
<td>Tempat/Tanggal Lahir</td>
<td>:</td>
<td colspan="4">'.@$abs->tmp_lahir_pas.', '.@date("d/m/Y", strtotime($abs->tgl_lhr_pas)).'</td>

</tr>
<tr>
<td>Tanggal Pemeriksaan</td>
<td>:</td>
<td>'.@date("d/m/Y", strtotime($abs->tgl_awal_reg)).'</td>
<td></td>
<td><div align="right"><b>Kategori </b></div></td>
<td> <b>: '.@$abs->nm_dinas.'</b></td>
</tr>
</table>
';

$getAnamnesa = str_replace(";", "<br />", $getAnamnesa);
$html .= '
<br /><br />
<table width="100%" style="font-size:10px;font-family:arial;" cellpadding="2px">
<tr>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="2.5%" >A.</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="20.1%">Berat Badan : '.@$pemkss['beratbadan'].' Kg</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="15.1%">Tinggi : '.@$pemkss['tinggibadan'].' cm</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="20.1%">Tensi : '.@$pemkss['tekanan_darah1'].'/'.@$pemkss['tekanan_darah2'].' mmHg</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="14.1%">Nadi : '.@$pemkss['nadi'].' x/mnt</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="14.1%">LP : '.@$pemkss['lingkarperut'].' Cm</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="14.1%">LD : '.@$pemkss['lingkardada1'].'-'.@$pemkss['lingkardada2'].' Cm</td>
</tr>
<tr>
	<td></td>
	<td colspan="6">
		<table>
			<tr>
				<td style="width:18%">Anamnesa</td>
				<td style="width:2%">:</td>
				<td style="width:80%">'.$getAnamnesa.'</td>
			</tr>
		</table>
	</td>
</tr>
</table>
';


$html .= '
<br /><br />
<table width="100%" style="font-size:10px;font-family:arial;" cellpadding="2px">
<tr>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="2.5%" >B.</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;" width="25.1%">PEMERIKSAAN</td>
		<td style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;border-left:solid 1px #000000;" width="73.1%">DIAGNOSA / KELAINAN</td>
</tr>';

//print_r($getDiagnosalain);
ksort($getDiagnosalain);
foreach($getDiagnosalain as $wy => $sb){
$html .='<tr>	
<td width="2.5%"></td>
<td width="25.1%" style="border-bottom:solid 1px #000000;">'.@$sb.'</td>
<td width="73.1%" style="border-left:solid 1px #000000;padding:2px;border-bottom:solid 1px #000000;">'.@$getDiagnosalain3[$wy].'</td>
</tr>';
}
$html .= '</table>';


$html .= '
<br /><br />
<table width="94.7%" style="font-size:10px;font-family:arial;" >
<tr>	
<td width="3%" style="border-top:solid 1px #000000;">C.</td>
<td width="3%" style="border-top:solid 1px #000000;">1.</td>
<td width="17%" style="border-top:solid 1px #000000;">Chamber</td>
<td colspan="2" style="border-top:solid 1px #000000;">: '.@$pemeriksaantambahan['Chamber-FI'].'</td>
<td rowspan="5" width="50%" style="border-top:solid 1px #000000;border-bottom:solid 1px #000000;">
<div align="left">
<br />
<table width="100%" style="font-size:10px;font-family:arial;margin:0 0 5px 0;">
<tr>
<td colspan="13"><div align="center">STATUS KESEHATAN</div></td>
</tr>
<tr>
<td style="border:solid 1px #000000;width:30%"><div align="left">Tanggal</div></td>
';
foreach(is_stakes() as $sg){

$html .= '<td style="border:solid 1px #000000;"><div align="center">'.@$sg.'</div></td>';
}
$html .= '</tr><tr><td style="border:solid 1px #000000;width:30%">'.@date("d/m/Y", strtotime($abs->tgl_awal_reg)).'</td>';
foreach(is_stakes() as $sg){
$html .= '<td style="border:solid 1px #000000;">
<div align="center">'.@$kesansaran[$sg].'</div>
</td>';
}
$html .= '</tr>
</table>
</div>
</td>
</tr>
<tr>	
<td width="3%"></td>
<td width="3%">2.</td>
<td>Psikologi</td>
<td colspan="2">: '.@$pemeriksaantambahan['Psikologi'].'</td>
</tr>
<tr>	
<td width="3%"></td>
<td width="3%">3.</td>
<td>Psikiatri</td>
<td colspan="2">: '.@$pemeriksaantambahan['Psikiatri'].'</td>
</tr>
<tr>	
<td width="3%"></td>
<td width="3%">4.</td>
<td>Kesamaptaan</td>
<td colspan="2">: '.@$pemeriksaantambahan['Kesamaptaan'].'</td>
</tr>
<tr>	
<td width="3%" style="border-bottom:solid 1px #000000;"></td>
<td width="3%" style="border-bottom:solid 1px #000000;">5.</td>
<td style="border-bottom:solid 1px #000000;">BC</td>
<td colspan="2" style="border-bottom:solid 1px #000000;">: '.@$pemeriksaantambahan['BC'].'</td>
</tr>
</table>';



$html .= '
<table width="100%" style="font-size:10px;font-family:arial;margin:0 0 5px 0;">
<tr>	
<td width="3%">D.</td>
<td width="20%">Kesimpulan / Saran</td>
<td width="1%">:</td>
<td width="77%">';

$sfghs = unserialize($kesansaran['saran']);
$sfghx = unserialize($kesansaran['kesimpulan']);
$sfghl = unserialize($kesansaran['detailsaran']);


$html .= '<table width="100%"  style="font-size:10px;font-family:arial;margin:0;">';
foreach(range(1,10) as $gsdd){ 
if($sfghs[$gsdd] != ""){
$ghdfsg = $sfghx[$gsdd] ." -> ". $sfghs[$gsdd];
$html .= '<tr>
<td width="3%" style="padding:1px;">-  </td>
<td style="width:97%">'.@htmlentities($ghdfsg).'</td>
</tr>';
}
} 
$html .= '</table>
</td>

</tr>
<tr>	
<td width="3%" ></td>
<td width="20%" ></td>
<td width="1%"></td>
<td style="width:77%">';
//print_r($kesansaran);
//ambil keterangan tarekhirnya ya
$this->db->select("nm_kondisi");
$this->db->where("id_kondisi", $kesansaran['keterangan_sehat']);
$this->db->limit("1");
$std = $this->db->get("tb_kondisi");
$ags = $std->result();



$html .= '<br /><br />
"<b>'.@$ags[0]->nm_kondisi.'</b>"<br />
'.@$kesansaran['catatan_tambahan_dinas'].'
</td>

</tr>
<tr>
	<td colspan="4" style="width:100%"><br /><hr /></td>
</tr>
</table>';
$this->db->where('kd_dok', 'KALA');
$kklids = $this->db->get('tb_dokter');
$sghdfs = $kklids->row();
if($abs->def_ttd > 0){
$this->db->where('id_dok', $abs->def_ttd);
$cmb1 = $this->db->get('tb_dokter');
$sghdfs = $cmb1->row();
}
$html .= '<br /><br />
<table width="100%" style="font-size:10px;font-family:arial;margin:0 0 5px 0;">
<tr>	
<td width="1%"></td>
<td width="35%"></td>
<td width="10%"></td>
<td width="54%">
<div align="center" style="margin:10px 0 0 0;">
KETUA TIM PEMERIKSAAN KESEHATAN<br/>'.$sghdfs->golongan.'<br/><br/><br/><br/>'.@$sghdfs->nm_dok.'<br />'.@$sghdfs->pangkat.'
</div>
</td>
</tr>
</table>
';

if($jdmbf != $cetakk){
	$html .='<div style="page-break-before:always">';
}

}


$this->load->library('Pdf');
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setCellPaddings(0,0,0,0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(PDF_MARGIN_LEFT+1, PDF_MARGIN_TOP-22, PDF_MARGIN_RIGHT+1, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$i=0;

$html=$html;
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('resume_medis'.$abs->no_filemcu.'.pdf', 'I');
die();
