<?php
				$this->db->where("kode_transaksi", $this->u3);
				$this->db->limit("1");
				$hey = $this->db->get("tb_pembayaran");
				$hoy = $hey->result();
				if($hoy){
					$totbiaya  = $hoy[0]->total_biaya;
					$tglnya  = date("Y-m-d", strtotime($hoy[0]->tgl_bayar));
				}
				//ambil nama pasiennya yaaa
				$que 	 = "select a.no_filemcu, b.nm_pas from tb_register a, tb_pasien b where a.no_reg=b.no_reg and a.kode_transaksi='".$this->u3."' limit 1";
				$svv = $this->db->query($que);
				$nhsa = $svv->result();
				//print_r($this->u3);
				//ambil nama pemeriksaan dan totalnya yaa
				$this->db->where("kode_transaksi", $this->u3);
				$sfa = $this->db->get("tb_transaksi");
				$afs = $sfa->result();
				if($afs){
					foreach($afs as $sc){
						//ambil kalau paket dan pemeriksaan konsulya
						if($sc->trans_konsul == "Y"){
							$this->db->select("nm_tind");
							$this->db->where("id_tind", $sc->id_tind);
							$this->db->limit("1");
							$nam = $this->db->get("tb_tindakan");
							$nim = $nam->result();
							$namanya = $nim[0]->nm_tind;
							$harga = $sc->harga_pemeriksaan+$sc->jasa_dokter;
						} else {
							$this->db->select("nm_paket");
							$this->db->where("id_paket", $sc->id_paket);
							$this->db->limit("1");
							$nam = $this->db->get("tb_paket");
							$nim = $nam->result();
							$namanya = $nim[0]->nm_paket;
							$harga = $sc->harga;
						}
						$newarray['nama'][] = $namanya;
						$newarray['harga'][] = $harga;
					}
				}
				//ambil juga dari tabel tambah kurang yaaa
				$this->db->where("unicode_transaksi", $this->u3);
				$this->db->where("type_filter", "TAMBAH");
				$shy = $this->db->get(" tb_register_filterdata");
				$abg = $shy->result();
				if($abg){
					foreach($abg as $bsd){
							$this->db->select("nm_tind");
							$this->db->where("id_tind", $bsd->id_tind);
							$this->db->limit("1");
							$nam = $this->db->get("tb_tindakan");
							$nim = $nam->result();
							$namanya = $nim[0]->nm_tind;
							$harga = $bsd->hargatindakan+$bsd->jasadokter;
							$newarray['nama'][] = $namanya;
							$newarray['harga'][] = $harga;
					}
				}
	//print_r($bawah);
?>
<script type="text/javascript">
<!--
	window.print();
//-->
</script>

<style>
	th, td {
		padding: 5px;
	}
</style>
<html>
	<head>
		<link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/select2/select2.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker-bs3.css">
	</head>
	<body>
		<div class="container" style="width:94%;margin-left:3%;margin-right:3%;">
			<table width="100%" style="font-size:12px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="10px" >
				<tr>
					<td width="35%">
						<h5 style="font-size:16px;font-family:times new roman;margin-top:-10px;"><p class="text-center"><b>AEROKLINIK LAKESPRA SARYANTO</b></p></h5>
						<h5 style="font-size:12px;font-family:arial;margin-top:-8px;"><p class="text-center"><b>Jl. M.T. Haryono Kav. 46, Jakarta Selatan</b></p></h5>
						<h5 style="font-size:12px;font-family:arial;margin-top:-8px;"><p class="text-center"><b> Telp. (021) 7994151 / 7996175 / 7980002, Fax. (021) 799 6634</b></p></h5><br />	
					</td>
					<td width="35%">
						<div align="center">
						<span style="font-size:16px;font-weight:bold;border-bottom:solid 1px #000000;">KWITANSI</span><br/>
						<span style="font-size:16px;font-weight:bold;">RECEIPT</span>
						</div>
					</td>
					<td style="vertical-align:middle">
						<b>No. MCU-<?=@sprintf("%010s", $hoy[0]->id_bayar)?></b>
					</td>
				</tr>
			</table>
			
			<table width="100%" style="font-size:12px;">
				<tr>
					<td width="15%" style="border-bottom:solid 1px #000000;">
						<span>Sudah terima dari</span>
					</td>
					<td width="3%"></td>
					<td style="border-bottom:solid 1px #000000;"><?=@$nhsa[0]->nm_pas?></td>
				</tr>
				<tr>
					<td>
						<span><i>Received from</i></span>
					</td>
					<td width="3%"></td>
					<td></td>
				</tr>
				<tr>
					<td width="15%" style="border-bottom:solid 1px #000000;">
						<span>Banyaknya Uang</span>
					</td>
					<td width="3%"></td>
					<td style="border-bottom:solid 1px #000000;"><?=@toTerbilang($totbiaya)?></td>
				</tr>
				<tr>
					<td>
						<span><i>The amount of</i></span>
					</td>
					<td width="3%"></td>
					<td></td>
				</tr>
				<tr>
					<td width="15%" style="border-bottom:solid 1px #000000;">
						<span>Untuk</span>
					</td>
					<td width="3%"></td>
					<td style="border-bottom:solid 1px #000000;">Pembayaran pemeriksaan <?=@implode(", ", $newarray['nama'])?></td>
				</tr>
				<tr>
					<td>
						<span><i>For</i></span>
					</td>
					<td width="3%"></td>
					<td></td>
				</tr>
				<tr>
					<td width="15%">
						<span></span>
					</td>
					<td width="3%"></td>
					<td></td>
				</tr>
				<tr>
					<td width="15%">
						<span>&nbsp;</span>
					</td>
					<td width="3%"></td>
					<td style="border-bottom:solid 1px #000000;"></td>
				</tr>
				<tr>
					<td>
						<span><i></i></span>
					</td>
					<td width="3%"></td>
					<td></td>
				</tr>
			</table>
			<table width="100%" style="font-size:12px;">
				<tr>
					<td width="30%" style="vertical-align:middle">
						<hr style="border:solid 2px #000000;"/>
						<hr style="border:solid 1px #000000;margin-top:-18px;margin-bottom:2px;"/>
						<span style="font-size:20px;font-family:times new roman;margin-top:-18px;"><i>Rp. <?=@is_no_rp($totbiaya)?></i></span>
						<hr style="border:solid 1px #000000;margin-bottom:-18px;margin-top:2px;"/>
						<hr style="border:solid 2px #000000;"/>
					</td>
					<td width="30%"></td>
					<td style="vertical-align:top">
						<div align="center">
							<br />Jakarta, <span style="border-bottom:solid 1px #000000;"><?=@the_time($tglnya)?></span><br />KASIR<br /><br /><br />
							<?=@$this->session->userdata('nmlengkap')?><br/><span style="border-top:solid 1px #000000;">NIP.<?=@$this->session->userdata('nip_nik')?></span>
						</div>
					</td>
				</tr>
			</table>
			
<script type="text/javascript">
	window.print();
</script>