
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<?php
	if(isset($_GET['typecetak'])){
		if($_GET['typecetak'] == 'print'){
			echo '<script>window.print(); window.onfocus=function(){ window.close();}</script>';
		}

		else if($_GET['typecetak'] == 'excel'){
			$tm = 'lap_registrasi';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		
		
		}
	}
		//print_r($_GET['type']);
		//ambil pt dan cabang
		
		//print_r($_GET);
		$tglawal = date("d/m/Y", strtotime($_GET['filter_tglawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['filter_tglakhir']));
		$this->db->select('nm_jawatan');
		$this->db->where('id_jawatan', $_GET['filter_jawatan']);
		$this->db->limit('1');
		$jaw = $this->db->get('tb_jawatan');
		$jaw1 = $jaw->result();
		$this->db->select('nm_paket');
		$this->db->where('id_paket', $_GET['filter_paket']);
		$this->db->limit('1');
		$pak = $this->db->get('tb_paket');
		$pak1 = $pak->result();
		$this->db->select('nm_dinas');
		$this->db->where('id_dinas', $_GET['filter_tujuan']);
		$this->db->limit('1');
		$cak = $this->db->get('tb_dinas');
		$cak1 = $cak->result();
		
		$que 	 = "select a.tgl_awal_reg, a.kode_transaksi, a.id_dinas_dua, a.id_reg, a.no_filemcu, a.id_paket, b.no_reg, b.nm_pekerjaan, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, b.id_pas, b.nm_pas, b.no_tlp_pas, b.nip_nrp_nik, b.id_dinas, c.nm_paket, d.kd_jawatan, d.nm_jawatan, e.id_dinas, e.nm_dinas from tb_register a, tb_pasien b, tb_paket c, tb_jawatan d, tb_dinas e where a.no_reg=b.no_reg and a.id_paket=c.id_paket and b.id_jawatan=d.id_jawatan  and a.id_dinas_dua=e.id_dinas";
		if(@!empty($_GET['filter_paket'])){
			$que 	.= " and a.id_paket='".$_GET['filter_paket']."' ";
		}
		if(@!empty($_GET['filter_typejawatan'])){
			$que 	.= " and b.no_reg like '".$_GET['filter_typejawatan']."%' ";
		}
		if(@!empty($_GET['filter_tujuan'])){
			$que 	.= " and a.id_dinas_dua like '".$_GET['filter_tujuan']."%' ";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		$que 	.= " and a.konsul <> 'Y' ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh 	= $this->db->query($que);
		$abd = $nsh->result();
		//print_r($abd);die();
	?>
	<style>
		td{
			border:solid 1px #333333;
			font-size:11px;
			padding:2px;
		}
		th{
			border:solid 1px #333333;
			font-size:11px;
			padding:2px;
		}
	</style>
	<div style="padding:0.5%">
	<table style="width:100%;border-spacing:0;">
		<thead>
		<tr>
			<td colspan="12" style="border:none;"><div align="center">
		<h3 style="font-size:16px;">Laporan MCU <?=@$pak1[0]->nm_paket?> <?=@$jaw1[0]->nm_jawatan?> <?=@$cak1[0]->nm_dinas?> <?=@$tglawal?> - <?=@$tglakhir?></h3>
	</div></td>
		</tr>
		<tr style="background:#eeeeee;">
			<th width="1%">No</th>
			<th>Tanggal</th>
			<th>No reg</th>
			<th>No File</th>
			<th>Nama</th>
			<th>Pekerjaan</th>
			<th>NIP/NRP/NIK</th>
			<th>Pangkat</th>
			<th>Jabatan</th>
			<th>Jawatan</th>
			<th>Paket</th>
			<th>Pemeriksaan Tambahan</th>
		</tr>
		</thead>
		<tbody>
			<?php
				$nb = 1;
				foreach($abd as $beak){
					$sulah[$beak->id_dinas_dua] = $beak->nm_dinas;
					$sihlah[$beak->id_dinas_dua][$beak->id_reg] = $beak; 
				}
				foreach($sulah as $ke => $va){
				?>
		<tr>
			<td colspan="12" style="background:#eaeaea;"><b><?=$va?></b></td>
		</tr>
				
		<?php
			if($abd){
				foreach($sihlah[$ke] as $bs){
					$su=$nb++;
					$nhy = "select a.id_fil, b.nm_tind ";
					$nhy .= " from tb_register_filterdata a, tb_tindakan b ";
					$nhy .= " where a.id_tind=b.id_tind  ";
					$nhy .= " and a.unicode_transaksi='".$bs->kode_transaksi."' and a.id_paket='".$bs->id_paket."' and a.type_filter='TAMBAH'  ";
					$anh = $this->db->query($nhy);
					$nhs = $anh->result();
					//print_r($nhs);
					foreach($nhs as $ds){
						$pas = $pos++;
						$bawah3[$su][$ds->nm_tind] = $ds->nm_tind;
						
					}
					
		?>
		<tr>
			<td><?=@$su?></td>
			<td><?=@date("Y-m-d", strtotime($bs->tgl_awal_reg))?></td>
			<td><?=@$bs->no_reg?></td>
			<td><?=@$bs->no_filemcu?></td>
			<td><?=@$bs->nm_pas?></td>
			<td><?=@$bs->nm_pekerjaan?></td>
			<td><?=@$bs->nip_nrp_nik?></td>
			<td><?=@$bs->pangkat_pas?></td>
			<td><?=@$bs->jabatan_pas?></td>
			<td><?=@$bs->nm_jawatan?></td>
			<td><?=@$bs->nm_paket?></td>
			<td><?=@implode(", ", $bawah3[$su])?></td>
		</tr>
			<?php } ?>
		<?php } ?>
		<?php 
			$su=1;
			}
		?>
		</tbody>
	</table>
	</div>

				
			