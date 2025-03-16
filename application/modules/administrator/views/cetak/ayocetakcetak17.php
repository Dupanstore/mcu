<?php
	
	//print_r($_GET);
	//MARI KITA BUAT LAPORAN
	$kesatuanpanpas = urldecode($_GET['kesatuan_pas']);
	$carabayarpas = urldecode($_GET['cara_bayar']);
	if(isset($_GET['typecetak'])){
		if($_GET['typecetak'] == 'print'){
			echo '
				<script type="text/javascript">
				<!--
				//window.print();
				//-->
				</script>';
		} else if($_GET['typecetak'] == 'excel'){
			$tm = 'lap_penerimaan_tagihan';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}

$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.jabatan_pas, b.id_pas, b.pangkat_pas, b.nm_pas, b.no_tlp_pas, b.alamat_pas from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket ";
		$que 	.= " and c.casis_tni='Y' and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		if(!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan=".$_GET['id_jawatan']." ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		$que 	.= "  order by a.id_reg ASC";
		$gsv 	 = $this->db->query($que);
		$ffds = $gsv->result();


		$tglawal = date("d/m/Y", strtotime($_GET['tanggalawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['tanggalakhir']));
		$que  = " select a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.no_ktp_pas, b.no_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.jenkel_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, f.nm_paket, f.harga_paket ";
		$que .= " from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas e, tb_paket f ";
		$que .= " where a.no_reg=b.no_reg ";
		$que .= " and b.id_jawatan=c.id_jawatan ";
		$que .= " and a.id_paket=f.id_paket ";
		$que .= " and b.id_dinas=e.id_dinas ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		
		
		$que  = " select x.id_tind_pem, x.kesantext, x.kesimpulan_pemeriksaan, a.id_reg, x.id_paket ";
		$que .= " from tb_register_pemeriksaan x, tb_register a, tb_pasien b ";
		$que .= " where x.kode_transaksi=a.kode_transaksi ";
		$que .= " and a.no_reg=b.no_reg ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$sss = $this->db->query($que);
		$asd = $sss->result();
		foreach($asd as $hsh){
			
			$hasillx4[$hsh->id_reg][$hsh->id_tind_pem] = $hsh->kesimpulan_pemeriksaan;
			$hasillx5[$hsh->id_reg][$hsh->id_tind_pem] = $hsh->kesantext;
			


		}
		
		//print_r($hasillx4);
		
						foreach($ffds as $vdvb){

	$judh = "select nama_pemeriksaan_khusus, hasilnya from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$vdvb->kode_transaksi."' and  nama_pemeriksaan_khusus IN ('tinggibadan', 'beratbadan', 'imt', 'plt', 'tekanan_darah1', 'tekanan_darah2', 'panjangkaki', 'tinggiduduk', 'beratbadanmax', 'nadi') ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					if($dswew){
						foreach($dswew as $gdb){
							$pemkhususnya[$vdvb->id_reg][$gdb->nama_pemeriksaan_khusus] = $gdb->hasilnya;
						}
					}

                    	if(trim(trim($stakestbbb)) == "4"){
						$warnstakes3 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes3 = 'color:red;font-weight:bold';
						$bintang3 = "*";

                        if(trim(trim($stakesimt)) == "4"){
						$warnstakes4 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes4 = 'color:red;font-weight:bold';
						$bintang4 = "*";
					}
					}
                    
                        }
					
		
		
		
		$que  = " select x.nama_pemeriksaan_khusus, x.hasilnya, a.id_reg, x.id_pem_deb, x.id_paket ";
		$que .= " from tb_register_detailpemeriksaan x, tb_register a, tb_pasien b ";
		$que .= " where x.kode_transaksi=a.kode_transaksi ";
		$que .= " and a.no_reg=b.no_reg ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$nsh = $this->db->query($que);
		$nss = $nsh->result();
		foreach($nss as $hsh){
			if(!empty($hsh->nama_pemeriksaan_khusus)){
				$hasill[$hsh->id_reg][$hsh->nama_pemeriksaan_khusus] = $hsh->hasilnya;
			}
			$hasillx3[$hsh->id_reg][$hsh->id_pem_deb] = $hsh->hasilnya;
			
		}
		
		$que  = " select x.ket_resume, x.isi_anamnesa, x.nama_kelainan, x.kesimpulan_kelainan, a.id_reg ";
		$que .= " from tb_resume_pasien x, tb_register a, tb_pasien b ";
		$que .= " where x.kode_transaksi=a.kode_transaksi ";
		$que .= " and a.no_reg=b.no_reg ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$nsh = $this->db->query($que);
		$nss = $nsh->result();
		foreach($nss as $hsh){
			if(!empty($hsh->nama_kelainan)){
				$hasillx1[$hsh->id_reg][$hsh->nama_kelainan] = $hsh->kesimpulan_kelainan;
			}
			$hasillx2[$hsh->id_reg][$hsh->ket_resume] = $hsh->isi_anamnesa;
			
			
		}
		
?>
<style>
	th, td{
			font-size:14px;
			PADDING:3PX;
			border:solid 1px #333333;
			vertical-align:top;
	}
	.bordernone td{
		border:none;
	}
</style>
<style>
        .ps {
            writing-mode: vertical-lr;
            -webkit-writing-mode: vertical-lr;
            -moz-writing-mode: vertical-lr;
        }
    </style>
		<div align="center">
			<h4>
			<?=@urldecode($_GET['judulatas'])?><br />
			<?=@urldecode($_GET['judultengah'])?><br />
			<?=@urldecode($_GET['judulbawah'])?>
			<?php if(isset($_GET['id_dinas'])){ ?>
			<!--<br />(
			<?php  
				//echo  implode(", ", $hhhsw);
			?>
			)-->
			<?php } ?>
			</h4>
		</div>
		<table style="width:100%;border-spacing:0;">
			<tr>
				<td width="1%" style="vertical-align:middle;text-align:center;">No</td>
				<td  style="vertical-align:middle;text-align:center;">Nama</td>
				<td  style="vertical-align:middle;text-align:center;">Pangkat</td>
				 
				<td  style="vertical-align:middle;text-align:center;">NRP</td>
				<td  style="vertical-align:middle;text-align:center;">Kesatuan</td>
				<td  style="vertical-align:middle;text-align:center;">Paket</td>
				<td  style="vertical-align:middle;text-align:center;">TGL Periksa</td>
				<td  style="vertical-align:middle;text-align:center;">Tekanan Darah SISTOLE</td>
				<td  style="vertical-align:middle;text-align:center;">Tekanan Datah DIASTOLE</td>
				<td  style="vertical-align:middle;text-align:center;">NADI</td>
				<td  style="vertical-align:middle;text-align:center;">TB / BB</td>
 				<td  style="vertical-align:middle;text-align:center;">IMT</td>
				<td  style="vertical-align:middle;text-align:center;">Lingkar Perut</td>
				<td  style="vertical-align:middle;text-align:center;">Lingkar Dada</td>
				<td  style="vertical-align:middle;text-align:center;">PLT</td>
				 
			</tr>
			
			<?php
				$nk=1;
				
				foreach($abd as $bs){
					$uuuu = "-";
					if(!empty($hasill[$bs->id_reg]['nadi'])){
						if($hasill[$bs->id_reg]['nadi'] < 60){
							$uuuu = "Bradikardi";
						}
						if($hasill[$bs->id_reg]['nadi'] > 100){
							$uuuu = "Takikardi";
						}
						if($hasill[$bs->id_reg]['nadi'] >= 60 and $hasill[$bs->id_reg]['nadi'] <= 100){
							$uuuu = "Normal";
						}
					}
					$so=$nk++;
					
					$kolestrottola = "-";
					if(!empty($hasillx3[$bs->id_reg][29])){
						$kolestrottola = $hasillx3[$bs->id_reg][29];
						if($hasillx3[$bs->id_reg][29] > 200){
							$kolestrottola .= " (Hiperkolesterolemia)";
						}else{
							$kolestrottola .= " (Normal)";
						}
						
					}
					
					$ldl = "-";
					if(!empty($hasillx3[$bs->id_reg][31])){
						$ldl = $hasillx3[$bs->id_reg][31];
						if($hasillx3[$bs->id_reg][31] > 100){
							$ldl .= " (Hiperkolesterolemia)";
						}else{
							$ldl .= " (Normal)";
						}
						
					}
					
					$hdl = "-";
					if(!empty($hasillx3[$bs->id_reg][30])){
						$hdl = $hasillx3[$bs->id_reg][30];
						if($hasillx3[$bs->id_reg][30] < 40){
							$hdl .= " (Rendah)";
						}else{
							$hdl .= " (Normal)";
						}
						
					}
					
					$trigliserida = "-";
					if(!empty($hasillx3[$bs->id_reg][32])){
						$trigliserida = $hasillx3[$bs->id_reg][32];
						if($hasillx3[$bs->id_reg][32] >= 150){
							$trigliserida .= " (Hipertrigliserida)";
						}else{
							$trigliserida .= " (Normal)";
						}
						
					}
					
					$glukpuasa = "-";
					if(!empty($hasillx3[$bs->id_reg][24])){
						$glukpuasa = $hasillx3[$bs->id_reg][24];
						if($hasillx3[$bs->id_reg][24] >= 70 and $hasillx3[$bs->id_reg][24] <= 99){
							$glukpuasa .= " (Normal)";
						}
						if($hasillx3[$bs->id_reg][24] >= 100 and $hasillx3[$bs->id_reg][24] <= 125){
							$glukpuasa .= " (Prediabetes)";
						}
						if($hasillx3[$bs->id_reg][24] >= 126){
							$glukpuasa .= " (Diabetes)";
						}
						
					}
					
					$gu2jampp = "-";
					if(!empty($hasillx3[$bs->id_reg][25])){
						$gu2jampp = $hasillx3[$bs->id_reg][25];
						if($hasillx3[$bs->id_reg][25] >= 70 and $hasillx3[$bs->id_reg][25] <= 139){
							$gu2jampp .= " (Normal)";
						}
						if($hasillx3[$bs->id_reg][25] >= 140 and $hasillx3[$bs->id_reg][25] <= 199){
							$gu2jampp .= " (Prediabetes)";
						}
						if($hasillx3[$bs->id_reg][25] >= 200){
							$gu2jampp .= " (Diabetes)";
						}
						
					}
		?>
			<tr>
					<td><?=@$so?></td>
 				<td><?=@$bs->nm_pas?></td>
                 				<td><?=@$bs->pangkat_pas?></td>
				<td>&nbsp;  <?=@$bs->nip_nrp_nik?></td>
				<td><?=@$bs->nm_jawatan?></td>
				<td><?=@$bs->nm_paket?></td>
                				<td><?=@date("Y-m-d",strtotime($bs->tgl_awal_reg))?></td>
				<td <?=@$warnstakes6?>>Tensi: <?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah1']?>/<?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah2']?> mmHg. Nadi <?=@$pemkhususnya[$vdvb->id_reg]['nadi']?>/mnt.<br /><?=@$bintang6?></td>

				<td <?=@$warnstakes6?>>Tensi: <?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah1']?>/<?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah2']?> mmHg. Nadi <?=@$pemkhususnya[$vdvb->id_reg]['nadi']?>/mnt.<br /><?=@$bintang6?></td>
								<td><?=@$hasill[$bs->id_reg]['nadi']?></td>
	<td <?=@$warnstakes3?> >
					<?=@$pemkhususnya[$vdvb->id_reg]['tinggibadan']?> / <?=@$pemkhususnya[$vdvb->id_reg]['beratbadan']?>
					<?php if($pemkhususnya[$vdvb->id_reg]['beratbadan'] > $pemkhususnya[$vdvb->id_reg]['beratbadanmax']){ ?>
					[<?=@$pemkhususnya[$vdvb->id_reg]['beratbadan']-$pemkhususnya[$vdvb->id_reg]['beratbadanmax']?>]
					<?php } ?><br /><?=@$bintang3?>
				</td>
				
	<td <?=@$warnstakes4?>><?=@$pemkhususnya[$vdvb->id_reg]['imt']?>
                    				<td></td>
                				<td></td>
<td>
				<?php if(!empty($pemkhususnya[$vdvb->id_reg]['plt'])){ ?>
				<br /><br />PLT: <?=@$pemkhususnya[$vdvb->id_reg]['plt']?> %
				<?php } ?>
				<br /><?=@$bintang4?></td>                			 
				
			</tr>
		<?php } ?>
		</table>
			
