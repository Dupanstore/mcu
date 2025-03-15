		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap/easyui.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap-responsive.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sticky-footer.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/icon.css')?>">
<?php
	
		$tglawal = date("d/m/Y", strtotime($_GET['filter_tglawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['filter_tglakhir']));
		$que  = " select a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas ";
		$que .= " from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas e, tb_paket f ";
		$que .= " where a.no_reg=b.no_reg ";
		$que .= " and b.id_jawatan=c.id_jawatan ";
		$que .= " and a.id_paket=f.id_paket ";
		$que .= " and b.id_dinas=e.id_dinas ";
		if (@!empty($_GET['filter_keyword'])){
			$que 	.= " and (b.nm_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.jabatan_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR  b.pangkat_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR c.nm_jawatan like '%".strip_tags(trim($_GET['filter_keyword']))."%')";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		if(@!empty($_GET['filter_paket'])){
			$que 	.= " and a.id_paket='".$_GET['filter_paket']."' ";
		}
		$que 	.= " and (e.id_dinas='45' OR e.id_dinas='80') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		
		//print_r($abd);
		
?>
<style>
	th, td {
		padding: 5px;
	}
</style>
		<div align="center">
			<h4>LAPORAN HASIL ILA/MEDEX<br />KORPS PENERBANG NAVIGATOR ILA JMU, MEDEX JMU<br /><?=@$tglawal?> - <?=@$tglakhir?></h4>
		</div>
		<table style="width:100%;border-spacing:0;" border="1">
			<tr style="background:#eeeeee;">
				<td width="1%" rowspan="2">No</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Nama</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Pangkat</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">NRP</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Jawatan/Jabatan</td>
				<td colspan="2" style="vertical-align:middle;text-align:center;">RIKKES</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Kelainan</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Saran/Tindakan</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">Keterangan</td>
			</tr>
			<tr style="background:#eeeeee;">
				<td style="vertical-align:middle;text-align:center;">ILA</td>
				<td style="vertical-align:middle;text-align:center;">MEDEX</td>
			</tr>
		<?php
				$no=1;
				
				foreach($abd as $bs){
					$papa = $bs->id_dinas;
					if($papa == '45'){
						$kuku = $bs->nm_dinas;
					}else{
						$kuku = "-";
					}
					if($papa == '80'){
						$kaka = $bs->nm_dinas;
					}else{
						$kaka = "-";
					}
					$bapuk = " select isi_kelainan from tb_resume_pasien where kode_transaksi='". $bs->kode_transaksi ."' and ket_resume='diagnosakelainan' and isi_kelainan !='' ";
					$peka = $this->db->query($bapuk);
					$wedus = $peka->result();
					
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
								}			
							}
						}
					//print_r($kesansaran['saran']);
					$su=$no++;
		?>
		<tr>
			<td><?=@$su?></td>
			<td><?=@$bs->nm_pas?></td>
			<td><?=@$bs->pangkat_pas?></td>
			<td><?=@$bs->nip_nrp_nik?></td>
			<td><?=@$bs->nm_jawatan?>/<?=@$bs->jabatan_pas?></td>
			<td style="vertical-align:middle;text-align:center;"><?=@$kuku?></td>
			<td style="vertical-align:middle;text-align:center;"><?=@$kaka?></td>
			<td><?=@$wedus[0]->isi_kelainan?></td>
			<td>
				
				
				<?php
					$sfghs = unserialize($kesansaran['saran']);
					$no=0;
					foreach(range(1,10) as $gsdd){ 
						$nb=$no++;
						if($sfghs[$gsdd] != ""){
							echo $no.'.'.' '. $sfghs[$gsdd] .'<br />';
						}
					} 
				?>
			
				
			</td>
			<td>
				<?php
					foreach(is_stakes() as $sg){
						echo $kesansaran[$sg];
					}
				?>
				<br />
				<?php
					$iviv = "select nm_kondisi from tb_kondisi where id_kondisi='".$keterangan['keterangan_sehat']."'";
					$viat = $this->db->query($iviv);
					$siny = $viat->result();
				?>
				<?=@$siny[0]->nm_kondisi?>
			</td>
		</tr>
		
		<?php } ?>

	</table>
			
<script type="text/javascript">
	window.print();
</script>