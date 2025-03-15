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
		$que  = " select a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, f.nm_paket, f.harga_paket ";
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
				<td style="vertical-align:middle;text-align:center;">NAMA/PANGKAT/NRP/JAWATAN/JABATAN</td>
				<td  style="vertical-align:middle;text-align:center;">TANGGAL PERIKSA</td>
				<td style="vertical-align:middle;text-align:center;">KETERANGAN</td>
				<td style="vertical-align:middle;text-align:center;">SPECIFIC TEST</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">1</td>
				<td style="vertical-align:middle;text-align:center;">2</td>
				<td style="vertical-align:middle;text-align:center;">3</td>
				<td style="vertical-align:middle;text-align:center;">4</td>
				<td style="vertical-align:middle;text-align:center;">5</td>
			</tr>
		<?php
				$nk=1;
				
				foreach($abd as $bs){
					$so=$nk++;
					$this->db->where("unicode_transaksi", $bs->kode_transaksi);
					$this->db->where("type_filter", "TAMBAH");
					$shy = $this->db->get("tb_register_filterdata");
					$abg = $shy->result();
					//print_r($abg);
					if($abg){
						
						foreach($abg as $bsd){
								$this->db->select("nm_tind");
								$this->db->where("id_tind", $bsd->id_tind);
								$this->db->limit("1");
								$nam = $this->db->get("tb_tindakan");
								$nim = $nam->row();
								$namanya = $nim->nm_tind;
								$harga = $bsd->hargatindakan+$bsd->jasadokter;
								$newarray['nama'][$bs->kode_transaksi][$bsd->id_tind] = $namanya;
								$newarray['harga'][$bs->kode_transaksi][$bsd->id_tind] = is_no_rp($harga);
						}
						//print_r($newarray);
						//die();
					}
		?>
		
		<tr>
			<td><?=@$so?></td>
			<td>
				<?=@$bs->nm_pas?><br /><?=@$bs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($bs->tgl_lhr_pas))?><BR /><BR />
				<?=@$bs->pangkat_pas?>/<?=@$bs->nip_nrp_nik?><BR />
				<?=@$bs->nm_jawatan?><BR /><?=@$bs->jabatan_pas?>
			</td>
			<td style="vertical-align:middle;text-align:center;">
				<?=@date("Y-m-d",strtotime($bs->tgl_awal_reg))?>
			</td>
			<td style="vertical-align:middle;text-align:center;">
				<b><?=@is_no_rp($bs->harga_paket)?></b><br />
				<?php echo implode('<br />', $newarray['harga'][$bs->kode_transaksi])?> 
				
			</td>
			<td style="vertical-align:middle;text-align:center;">
			<b><?=@$bs->nm_paket?></b><br />
			<?php echo implode('<br />', $newarray['nama'][$bs->kode_transaksi])?> 
			</td>
			
		</tr>
	<?php } ?>
	</table>
			
