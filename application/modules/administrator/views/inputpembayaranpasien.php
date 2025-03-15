<div class="easyui-layout" data-options="fit:true" id="detailpembayaran_layout1">
        <div data-options="region:'west',split:true,footer:'#toolbar_paketmcu1'" title="" style="width:500px;background:#eeffff;padding:5px;">
			<?php
				//ambil data ditabel pembayaran
				$this->db->where("kode_transaksi", $this->u3);
				$this->db->limit("1");
				$hey = $this->db->get("tb_pembayaran");
				$hoy = $hey->result();
				$dis  = 'disabled="true"';
				$shu  = 'Simpan Transaksi';
				$alih  = '0';
				$bayar  = '-';
				if($hoy){
					$dis  = '';
					$shu  = 'Simpan Ulang Transaksi';
					$alih  = $hoy[0]->pengalihan;
					$bayar  = $hoy[0]->dibayar;
				}
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
			?>
			<form method="POST" id="formbatalpembayaran_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/batalkantransaksipembayaran')?>">
				<input type="hidden" name="id_bayar_batal" value="<?=@$hoy[0]->id_bayar?>">
				<input type="hidden" name="kode_transaksi_batal" value="<?=@$this->u3?>">
			</form>
			<form method="POST" id="detailinputpembayaran_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatapembayaran')?>">
			<input type="hidden" name="id_bayar" value="<?=@$hoy[0]->id_bayar?>">
			<input type="hidden" name="kode_transaksi" value="<?=@$this->u3?>">
			<input type="hidden" name="total_biaya" value="<?=@array_sum($newarray['harga'])?>">
			<table class="tableeasyui" style="width:100%">
				<tr>
					<td><b>Pemeriksaan/Paket</b></td>
					<td><div align="right"><b>Harga</b></div></td>
					<td width="1%"></td>
				</tr>
				<?php
					//ambil paket maupun yang konsul yaaaaaaa
					if($newarray){
						foreach($newarray['nama'] as $ke => $va){
							
							
				?>
				<tr>
					<td><?=@$va?></td>
					<td><div align="right"><?=@is_no_rp($newarray['harga'][$ke])?></div></td>
					<td></td>
				</tr>
					<?php } ?>
				<tr>
					<td><div align="right">Total</div></td>
					<td><div align="right"><b><?=@is_no_rp(array_sum($newarray['harga']))?></b></div></td>
					<td></td>
				</tr>
				<tr>
					<td><div align="right">Pengalihan</div></td>
					<td><div align="right">
						<input type="hidden" id="pengalihan" name="pengalihan" value="<?=@$alih?>">
						<input type="text" id="pengalihan_tampil" value="<?=@is_no_rp($alih)?>" style="text-align:right" onchange="rubahangkanyaya('pengalihan')">
						</div>
					</td>
					<td><button type="button" onclick="tambahsemuapengalihan('<?=@array_sum($newarray['harga'])?>', '<?=@is_no_rp(array_sum($newarray['harga']))?>')">Semua</button></td>
				</tr>
				<tr>
					<td><div align="right">Dibayar</div></td>
					<td><div align="right"><input type="text" disabled="true" value="<?=@is_no_rp($bayar)?>" style="text-align:right"></div></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						<button style="cursor:pointer" type="button" onclick="simpanpembayaranya('<?=@$this->u3?>')" style="width:90%;"><?=@$shu?></button>
						<button style="cursor:pointer" type="button" onclick="cetakkwitansibayar('<?=@$this->u3?>')" style="width:90%;" <?=@$dis?>>Cetak Kwitansi</button>
					</td>
				</tr>
				<?php } ?>
			</table>
			</form>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
			<div align="right" style="padding:5px;">
				<button style="cursor:pointer" type="button" onclick="batalkantransaksi('<?=@$this->u3?>')" style="width:90%;" <?=@$dis?>>Batalkan Transaksi</button><hr style="border:solid 1px #cccccc;"/>
			</div>
	</div>
</div>
<script type="text/javascript">
	function tambahsemuapengalihan(ang, rup){
		$('#pengalihan').val(ang);
		$('#pengalihan_tampil').val(rup);
	}
	function NilaiRupiah(jumlah){
			var titik = ".";
			var nilai = new String(jumlah);
			var pecah = [];
			while(nilai.length > 3)
			{
				var asd = nilai.substr(nilai.length-3);
				pecah.unshift(asd);
				nilai = nilai.substr(0, nilai.length-3);
			}
		 
			if(nilai.length > 0) { pecah.unshift(nilai); }
			nilai = pecah.join(titik);
			return nilai;
		}
		function rubahangkanyaya(d){
				if($('#'+d+'_tampil').val() != '' && !isNaN($('#'+d+'_tampil').val())){
					var text = $('#'+d+'_tampil').val();
					var new_text = text.replace('.', '');
					var dm = new_text.replace('.', '');
					var db = dm.replace('.', '');
					var dc = db.replace('.', '');
					var dx = dc.replace('.', '');
					$('#pengalihan').val(dx);
					$('#pengalihan_tampil').val(NilaiRupiah(dx));
				} else {
					$('#pengalihan_tampil').val('');
					$('#pengalihan').val('');
				}
		}
</script>