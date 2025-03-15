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
				<td  style="vertical-align:middle;text-align:center;">No.RM</td>
				<td  style="vertical-align:middle;text-align:center;">Tgl Periksa</td>
				<td  style="vertical-align:middle;text-align:center;">Nama</td>
				<td  style="vertical-align:middle;text-align:center;">NIK</td>
				<td  style="vertical-align:middle;text-align:center;">NIP</td>
				<td  style="vertical-align:middle;text-align:center;">Unit Kerja</td>
				<td  style="vertical-align:middle;text-align:center;">Jenis Kelamin</td>
				<td  style="vertical-align:middle;text-align:center;">TGL LHR</td>
				<td  style="vertical-align:middle;text-align:center;">USIA</td>
				<td  style="vertical-align:middle;text-align:center;">Nadi (kali/ menit)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Nadi (Normal/ Takikardi/ Bradikardi)</td>
				<td  style="vertical-align:middle;text-align:center;">Irama Nadi (Teratur/ Tidak Teratur)</td>
				<td  style="vertical-align:middle;text-align:center;">Pernafasan (kali/ menit)</td>
				<td  style="vertical-align:middle;text-align:center;">Tekanan darah Sistolik (mmHg)/ Diastolik (mmHg)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Tek Darah (Normal/ Normal Tinggi (prehipertensi)/ HT grade 1/ HT grade 2/HT grade 3)</td>
				<td  style="vertical-align:middle;text-align:center;">Berat Badan (Kg)</td>
				<td  style="vertical-align:middle;text-align:center;">Tinggi Badan (Cm)</td>
				<td  style="vertical-align:middle;text-align:center;">IMT (kg/m2)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan IMT</td>
				<td  style="vertical-align:middle;text-align:center;">Kolesterol Total (Normal/ Hiperkolesterolemia)</td>
				<td  style="vertical-align:middle;text-align:center;">LDL (Normal/ Hiperkolesterolemia)</td>
				<td  style="vertical-align:middle;text-align:center;">HDL (Rendah/ Normal)</td>
				<td  style="vertical-align:middle;text-align:center;">Trigliserida(Normal/ Hipertrigliserida)</td>
				<td  style="vertical-align:middle;text-align:center;">Glukosa Darah Puasa (Normal/ Prediabetes/ Diabetes)</td>
				<td  style="vertical-align:middle;text-align:center;">Glukosa Darah 2jam PP (Normal/ Prediabetes/ Diabetes)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Hasil Laboratorium</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Pemeriksaan Gigi (caries/ tidak)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Pemeriksaan THT (Normal/ Hearing loss)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Pem Neuro</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Pem Mata (Normal/ Gangguan visus)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Spirometri (Normal/ Restriktif/ Obstruktif )</td>
				<td  style="vertical-align:middle;text-align:center;">Kesan Rontgen Thorax (Normal/ TBC paru aktif)</td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Paru</td>
				<td  style="vertical-align:middle;text-align:center;">Kesan USG Abdomen</td>
				<td  style="vertical-align:middle;text-align:center;">KESAN USG MAMMAE</td>
				<td  style="vertical-align:middle;text-align:center;">Kesan Papsmear </td>
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan EKG</td> 
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Pem Kes Jiwa</td> 
				<td  style="vertical-align:middle;text-align:center;">Kesimpulan Okupasi</td> 
				<td  style="vertical-align:middle;text-align:center;">Riwayat Kesehatan Pribadi</td> 
				<td  style="vertical-align:middle;text-align:center;">Riwayat Kesehatan Keluarga</td> 
				<td  style="vertical-align:middle;text-align:center;">Anamnesa</td> 
				<td  style="vertical-align:middle;text-align:center;">Saran/Rujukan</td> 
				<td  style="vertical-align:middle;text-align:center;">SARAN BAGI INSTANSI </td> 
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
				<td><?=@$bs->no_reg?></td>
				<td><?=@date("Y-m-d",strtotime($bs->tgl_awal_reg))?></td>
				<td><?=@$bs->nm_pas?></td>
				<td>&nbsp;  <?=@$bs->no_ktp_pas?></td>
				<td>&nbsp;  <?=@$bs->nip_nrp_nik?></td>
				<td><?=@$bs->nm_jawatan?></td>
				<td><?=@$bs->jenkel_pas?></td>
				
				
				<td><?=@$bs->tgl_lhr_pas?></td>
				<td><?=@get_umur($bs->tgl_lhr_pas)?></td>
				<td><?=@$hasill[$bs->id_reg]['nadi']?></td>
				<td><?=@$uuuu?></td>
				<td></td>
				<td><?=@$hasill[$bs->id_reg]['pernafasan']?></td>
				<td><?=@$hasill[$bs->id_reg]['tekanan_darah1']?>/<?=@$hasill[$bs->id_reg]['tekanan_darah2']?></td>
				<td><?=@$hasill[$bs->id_reg]['keterangan_td']?></td>
				<td><?=@$hasill[$bs->id_reg]['beratbadan']?></td>
				<td><?=@$hasill[$bs->id_reg]['tinggibadan']?></td>
				<td><?=@$hasill[$bs->id_reg]['imt']?></td>
				<td><?=@$hasill[$bs->id_reg]['ketimt']?></td>
				<td ><?=@$kolestrottola?></td>
				<td ><?=@$ldl?></td>
				<td  ><?=@$hdl?></td>
				<td ><?=@$trigliserida?></td>
				<td ><?=@$glukpuasa?></td>
				<td><?=@$gu2jampp?></td>
				<td><?=@$hasillx1[$bs->id_reg]['Laboratorium']?></td>
				<td><?=@$hasillx4[$bs->id_reg][6549]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6583]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6574]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6651]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6579]?></td>
				<td><?=@$hasillx5[$bs->id_reg][6626]?></td>
				<td></td>
				<td><?=@$hasillx4[$bs->id_reg][6646]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6648]?></td>
				<td><?=@$hasillx4[$bs->id_reg][6591]?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?=@$hasillx2[$bs->id_reg]['anamnesa']?></td>
				<td></td>
				<td></td>
				
			</tr>
		<?php } ?>
		</table>
			
