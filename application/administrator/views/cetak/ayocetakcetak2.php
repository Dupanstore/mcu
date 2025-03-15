<?php
	//print_r($_GET);
	$this->db->select('id_dinas, nm_dinas');
	$cmb1 = $this->db->get('tb_dinas');
	$cmb1 = $cmb1->result();
	if($cmb1){
		foreach($cmb1 as $vd){
			$pids[$vd->id_dinas] = $vd->nm_dinas;
		}
		
	}
	foreach($_GET['id_dinas'] as $dsa){ 
		$hhhsw[$dsa] = $pids[$dsa];
	}
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
			$tm = 'lap_ilamedex';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}
		$tglawal = date("d/m/Y", strtotime($_GET['tanggalawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['tanggalakhir']));
		$que  = " select a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, e.ila_medex ";
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
		$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		
		
		
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
		<div align="center">
			<h4>LAPORAN HASIL ILA/MEDEX KORPS PENERBANG NAVIGATOR ILA JMU, MEDEX JMU<br />DI LAKESPRA dr. SARYANTO<br /><?=@$tglawal?> - <?=@$tglakhir?>
			<?php if(isset($_GET['id_dinas'])){ ?>
			<br />(
			<?php  
				echo  implode(", ", $hhhsw);
			?>
			)
			<?php } ?>
			</h4>
		</div>
		<table style="width:100%;border-spacing:0;">
			<tr>
				<td width="1%" rowspan="2" style="vertical-align:middle;text-align:center;">No</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">NAMA/PANGKAT/NRP/JAWATAN/JABATAN</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">TENSI/NADI/TB/BB</td>
				<td colspan="2" style="vertical-align:middle;text-align:center;">RIKKES</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">KELAINAN</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">SARAN/TINDAKAN</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">KETERANGAN</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">ILA</td>
				<td style="vertical-align:middle;text-align:center;">MEDEX</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">1</td>
				<td style="vertical-align:middle;text-align:center;">2</td>
				<td style="vertical-align:middle;text-align:center;">3</td>
				<td style="vertical-align:middle;text-align:center;">4</td>
				<td style="vertical-align:middle;text-align:center;">5</td>
				<td style="vertical-align:middle;text-align:center;">6</td>
				<td style="vertical-align:middle;text-align:center;">7</td>
				<td style="vertical-align:middle;text-align:center;">8</td>
			</tr>
		<?php
				$nk=1;
				
				foreach($abd as $bs){
					
					
					$judh = "select nama_pemeriksaan_khusus, hasilnya from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$bs->kode_transaksi."' and  nama_pemeriksaan_khusus IN ('tinggibadan', 'beratbadan', 'tekanan_darah1', 'tekanan_darah2',  'nadi') ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					if($dswew){
						foreach($dswew as $gdb){
							$pemkhususnya[$bs->id_reg][$gdb->nama_pemeriksaan_khusus] = $gdb->hasilnya;
						}
					}
					
					
					$nofilll1 = explode("/", $bs->no_filemcu);
					$nofilll2 = $nofilll1[0];
					$kuku = "-";
					$kaka = "-";
					if($bs->ila_medex == "ila"){
						$kuku = $nofilll2 ."<br />". date("d/m/Y", strtotime($bs->tgl_awal_reg));
					}
					if($bs->ila_medex == "medex"){
						$kaka = $nofilll2 ."<br />". date("d/m/Y", strtotime($bs->tgl_awal_reg));
					}
					
					
				

					$iudns = "select nama_kelainan, kelainan_key, stakes_kelainan, kesimpulan_kelainan from tb_resume_pasien where  kode_transaksi='".clean_data($bs->kode_transaksi)."' and aktif_diagnosakelainan !='N' and ket_resume='diagnosakelainan' ";
					$diagb = $this->db->query($iudns);
					$hdbsw = $diagb->result();
					
					//ambil data resumnya yaaa
					$oiu = "select ket_resume, nama_kesansaran, isi_kesansaran from tb_resume_pasien where  kode_transaksi='".clean_data($bs->kode_transaksi)."' ";
					$aew = $this->db->query($oiu);
					$mdn = $aew->result();
					//print_r($sapi);
						if($mdn){
							foreach($mdn as $sa){
								if($sa->ket_resume == "kesimpulansaran"){	
									$kesansaran[$sa->nama_kesansaran] = $sa->isi_kesansaran;
									$keterangan[$sa->nama_kesansaran] = $sa->isi_kesansaran;	
								}else{
									unset($kesansaran);
									unset($keterangan);
								}				
							}
						}
					$so=$nk++;
		?>
		
		<tr>
			<td><?=@$so?></td>
			<td>
				<?=@$bs->nm_pas?><br /><?=@$bs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($bs->tgl_lhr_pas))?><BR /><BR />
				<?=@$bs->pangkat_pas?>/<?=@$bs->nip_nrp_nik?><BR />
				<?=@$bs->nm_jawatan?><BR /><?=@$bs->jabatan_pas?>
			</td>
			<td style="vertical-align:middle;text-align:center;">
				<?=@$pemkhususnya[$bs->id_reg]['tekanan_darah1']?>/<?=@$pemkhususnya[$bs->id_reg]['tekanan_darah2']?> mmHg<br /><?=@$pemkhususnya[$bs->id_reg]['nadi']?>/mnt
				<br /><br />
				<?=@$pemkhususnya[$bs->id_reg]['tinggibadan']?> cm<br />
				<?=@$pemkhususnya[$bs->id_reg]['beratbadan']?> cm<br />
			</td>
			<td style="vertical-align:middle;text-align:center;"><?=@$kuku?></td>
			<td style="vertical-align:middle;text-align:center;"><?=@$kaka?></td>
			<td>
				<table class="bordernone">
					<?php 
						foreach($hdbsw as $fvds){ 
						$ghdhhjshjg = "";
						if(!empty($fvds->stakes_kelainan)){
							$ghdhhjshjg = " (".$fvds->stakes_kelainan.")";
						}
						
						$namakelainan = $fvds->nama_kelainan;
						if($fvds->kelainan_key == "01L"){
							$namakelainan = "Kulit";
						}
						if($fvds->kelainan_key == "01B"){
							$namakelainan = "Bedah";
						}
					?>
					<tr>
						<td><?=@$fvds->kesimpulan_kelainan ." ". $ghdhhjshjg?> </td>
					</tr>
					<?php } ?>
				</table>
				<?=@$wedus->isi_kelainan?>
			</td>
			<td>
				<table style="border:none;">
				<?php
					$sfghs = unserialize($kesansaran['saran']);
					$no=0;
					foreach(range(1,10) as $gsdd){ 
						$nb=$no++;
						if($sfghs[$gsdd] !=""){
							echo "<tr><td style='border:none;vertical-align:top;'>". $no. '</td><td style="border:none;">'.$sfghs[$gsdd].'</td></tr>';
						}
					} 
				?>
				</table>
			</td>
			<td>
				<?php
					unset($kesansaran['kesimpulan']);
					unset($kesansaran['saran']);
					unset($kesansaran['detailsaran']);
					unset($kesansaran['keterangan_sehat']);
					unset($kesansaran['catatan_tambahan_dinas']);
					//print_r($kesansaran);
					echo max($kesansaran);
				?>
				<br/>
				<?php
					$iviv = "select nm_kondisi from tb_kondisi where id_kondisi='".$keterangan['keterangan_sehat']."'";
					$viat = $this->db->query($iviv);
					$siny = $viat->row();
				?>
				<?=@$siny->nm_kondisi?>
			</td>
		</tr>
	<?php } ?>
	</table>
			
