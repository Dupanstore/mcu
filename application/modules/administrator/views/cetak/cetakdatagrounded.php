<?php

	$this->db->where('kd_dok', 'KABAGMINEVAL');
		$kklids = $this->db->get('tb_dokter');
		$sghdfs = $kklids->row();
		
		$this->db->where('kd_dok', 'KADEP');
		$kklids = $this->db->get('tb_dokter');
		$kadep = $kklids->row();
	//print_r($_GET);
	$sdas = $this->db->get('tb_kondisi');
	$sgds = $sdas->result();
	if($sgds){
		foreach($sgds as $gshghs){
			$kondisipasien[$gshghs->id_kondisi] = $gshghs->nm_kondisi;
		}
		
	}
	
	
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
				
				window.print();
				
				</script>';
		} else if($_GET['typecetak'] == 'excel'){
			$tm = 'lap_grounded';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}
		$tglawal = date("d/m/Y", strtotime($_GET['filter_tglawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['filter_tglakhir']));
		$que  = " select b.kesatuan_pas, a.tele_grounded, a.tele_cabut, a.tele_rilis, a. keterangan_grounded, a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, e.ila_medex ";
		$que .= " from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas e, tb_paket f ";
		$que .= " where a.no_reg=b.no_reg ";
		$que .= " and b.id_jawatan=c.id_jawatan ";
		$que .= " and a.id_paket=f.id_paket ";
		$que .= " and b.id_dinas=e.id_dinas ";
		$que .= " and a.pas_grounded='Y' ";
		if(is_array($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan IN (".implode(", ", $_GET['id_jawatan']).") ";
		}
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['filter_tglawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['filter_tglakhir'])))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		//print_r($que);
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
	<table width="100%" style="font-size:16px;border-spacing:0;font-family:arial;margin:10px 0 0 0;" cellpadding="2px" >
				<tr>
					<td style="border:none;" colspan="5">
						<div align="left">
							<b>
							<span>MARKAS BESAR ANGKATAN UDARA</span><br/>
							<span style="border-bottom:solid 1px #000000;padding:0 40px 0 40px;">LAKESPRA <?=@is_fixname()?></span>
							</b>
						</div>
					</td>
				</tr>
			</table>
		<div align="center">
			<h4>
			<?php
			$_GET['judulbawah'] = "DAFTAR NAMA GROUNDED DAN CABUT GROUNDED ". $tglawal ." - ".$tglakhir;
			?>
			<?=@urldecode($_GET['judulatas'])?><br />
			<?=@urldecode($_GET['judultengah'])?><br />
			<?=@urldecode($_GET['judulbawah'])?>
			<?php if(isset($_GET['id_dinas'])){ ?>
			<!--<br />(
			<?php  
				echo  implode(", ", $hhhsw);
			?>
			)-->
			<?php } ?>
			</h4>
		</div>
		<table style="width:100%;border-spacing:0;">
			<tr>
				<td width="1%"  style="vertical-align:middle;text-align:center;">NO</td>
				<td style="vertical-align:middle;text-align:center;">NAMA</td>
				<td  style="vertical-align:middle;text-align:center;">PANGKAT/NRP</td>
				<td  style="vertical-align:middle;text-align:center;">JABATAN</td>
				<td  style="vertical-align:middle;text-align:center;">SATUAN</td>
				<td  style="vertical-align:middle;text-align:center;">DIAGNOSA KELAINAN</td>
				<td  style="vertical-align:middle;text-align:center;">TELEGRAM GROUNDED</td>
				<td  style="vertical-align:middle;text-align:center;">TELEGRAM PERMOHONAN CABUT GROUNDED</td>
				<td  style="vertical-align:middle;text-align:center;">TELEGRAM RILIS TERBANG</td>
				<td  style="vertical-align:middle;text-align:center;">KET</td>
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
				<td style="vertical-align:middle;text-align:center;">9</td>
				<td style="vertical-align:middle;text-align:center;">10</td>
			</tr>
		<?php
				$nk=1;
				
				foreach($abd as $bs){
					
					
					
					
					
					

					$iudns = "select nama_kelainan, kelainan_key, stakes_kelainan, kesimpulan_kelainan from tb_resume_pasien where  kode_transaksi='".clean_data($bs->kode_transaksi)."' and aktif_diagnosakelainan !='N' and ket_resume='diagnosakelainan' ";
					$diagb = $this->db->query($iudns);
					$hdbsw = $diagb->result();
					$so=$nk++;
		?>
		
		<tr>
			<td><?=@$so?></td>
			<td><?=@$bs->nm_pas?></td>
			<td><?=@$bs->pangkat_pas?>/<?=@$bs->nip_nrp_nik?>&nbsp;</td>
			<td><?=@trim($bs->jabatan_pas)?>&nbsp;</td>
			<td><?=@trim($bs->nm_jawatan)?>&nbsp;</td>
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
				<?=@$wedus->isi_kelainan?>&nbsp;
			</td>
			
			<td><?=@trim($bs->tele_grounded)?>&nbsp;</td>
			<td><?=@trim($bs->tele_cabut)?>&nbsp;</td>
			<td><?=@trim($bs->tele_rilis)?>&nbsp;</td>
			<td><?=@trim($bs->keterangan_grounded)?>&nbsp;</td>
		</tr>
	<?php } ?>
	</table>
	
	<table style="width:100%;border:none;">
		<tr style="border:none;">
			<td style="width:50%;border:none;" colspan="2">
				<div align="center">
					Mengetahui<br />
					Kadepaeroklinik,<br /><br /><br /><br /><br />
					<?=@$kadep->nm_dok?><br />
					<?=@$kadep->nip_nrp?>
				</div>
			</td>
			<td style="border:none;vertical-align:top;" colspan="2">
				<div align="center">
					Jakarta, <?=@the_time(date("Y-m-d"))?><br />
					Kabagmineval,<br /><br /><br /><br /><br />
					<?=@$sghdfs->nm_dok?><br />
					<?=@$sghdfs->nip_nrp?>
				</div>
			</td>
		</tr>
	</table>
			
