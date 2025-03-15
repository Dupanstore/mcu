<?php
		$bay = '';
		$din = '';
		if(@!empty($_GET['filter_cara_bayar'])){
			$bay = $_GET['filter_cara_bayar'];
		}
		if(@!empty($_GET['filter_cara_bayar'])){
			$ddd = $_GET['filter_typejawatan'];
			if($ddd=="D"){
				$din = "DINAS";
			}else{
				$din = "NON-DINAS";
			}
		}
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
		$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, a.no_filemcu, b.dept_pas, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.nm_pekerjaan, b.pangkat_pas, b.jabatan_pas, c.harga_paket, c.nm_paket from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket";
		//$que 	 = "select a.id_paket, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.dept_pas, b.nm_pas, b.nm_pekerjaan, b.pangkat_pas, b.jabatan_pas, c.nm_dept, d.harga_paket from tb_register a, tb_pasien b, tb_departmen c, tb_paket d where a.no_reg=b.no_reg and b.dept_pas=c.id_dept and a.id_paket=d.id_paket ";
		if(@!empty($_GET['filter_paket'])){
			$que 	.= " and a.id_paket='".$_GET['filter_paket']."' ";
		}
		if(@!empty($_GET['filter_typejawatan'])){
			$que 	.= " and b.no_reg like '".$_GET['filter_typejawatan']."%' ";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		if(@!empty($_GET['filter_cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$_GET['filter_cara_bayar']."' ";
		}
		//$que 	.= " and a.konsul <> 'Y' ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		$sqldept = "select id_dept, nm_dept from tb_departmen";
		$qrydept = $this->db->query($sqldept);
		$tsts    = $qrydept->result();
		foreach($tsts as $sotoayam){
			$ininya[$sotoayam->id_dept] = $sotoayam->nm_dept;
		}
		//print_r($_GET['filter_tglawal']);die();
?>
<style>
	th, td {
		padding: 5px;
	}
</style>
		<div align="center">
			<h4>DAFTAR PEGAWAI KEMENKES<br />YANG MELAKSANAKAN MCU DI LAKESPRA<br /><?=@$pak1[0]->nm_paket?> <?=@$jaw1[0]->nm_jawatan?> <?=@$din?> <?=@$bay?> <?=@$tglawal?> - <?=@$tglakhir?></h4>
		</div>
		<table style="width:100%;border-spacing:0;" border="1">
		<tr style="background:#eeeeee;">
			<td width="1%">No</td>
			<td>Nama</td>
			<td>Jabatan & Nip/Nrp/Nik</td>
			<td>Unit Organisasi</td>
			<td>Tgl RIK</td>
			<td>Harga</td>
		</tr>
		<?php
			if($abd){
				$no=1;
				foreach($abd as $bs){
					$su=$no++;
		?>
		<tr>
			<td><?=@$su?></td>
			<td><?=@$bs->nm_pas?></td>
			<td><?=@$bs->jabatan_pas.' ('.$bs->nip_nrp_nik.')'?></td>
			<td><?=@$ininya[$bs->dept_pas]?></td>
			<td><?=@$bs->newtglnya?></td>
			<td><?=@$bs->harga_paket?></td>
		</tr>
			<?php } ?>
		<?php } ?>
	</table>
			
<script type="text/javascript">
	window.print();
</script>