	<?php
		
			$tm = 'lap_konsul';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		
	?>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<?php
		//print_r($_GET);
		//ambil pt dan cabang
		$tglawal = date("d/m/Y", strtotime($_GET['filter_tglawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['filter_tglakhir']));
		$this->db->select('nm_jawatan');
		$this->db->where('id_jawatan', $_GET['filter_jawatan']);
		$this->db->limit('1');
		$jaw = $this->db->get('tb_jawatan');
		$jaw1 = $jaw->result();
		$que 	 = "select a.id_reg, a.no_filemcu, b.no_reg, b.alamat_pas, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas from tb_register a, tb_pasien b where a.no_reg=b.no_reg ";
		if(@!empty($_GET['filter_typejawatan'])){
			$que 	.= " and b.no_reg like '".$_GET['filter_typejawatan']."%' ";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		$que 	.= " and a.konsul='Y' ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh 	= $this->db->query($que);
		$abd = $nsh->result();
		//print_r($abd);
	?>
	<style>
		td{
			border:solid 1px #333333;
		}
	</style>
	<div align="center">
		<h3>Laporan Konsul <?=@$jaw1[0]->nm_jawatan?> <?=@$tglawal?> - <?=@$tglakhir?></h3>
	</div>
	<table style="width:100%;border-spacing:0;">
		<tr style="background:#eeeeee;">
			<td width="1%">No</td>
			<td>No File</td>
			<td>No reg</td>
			<td>Nip/Nik</td>
			<td>Nama</td>
			<td>Alamat</td>
			<td>No Telp</td>
		</tr>
		<?php
			if($abd){
				$sg=1;
				foreach($abd as $bs){
					$su=$sg++;
		?>
		<tr>
			<td><?=@$su?></td>
			<td><?=@$bs->no_filemcu?></td>
			<td><?=@$bs->no_reg?></td>
			<td><?=@$bs->nip_nrp_nik?></td>
			<td><?=@$bs->nm_pas?></td>
			<td><?=@$bs->alamat_pas?></td>
			<td><?=@$bs->no_tlp_pas?></td>
		</tr>
			<?php } ?>
		<?php } ?>
	</table>