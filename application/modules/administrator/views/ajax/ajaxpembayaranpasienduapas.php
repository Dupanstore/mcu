<?php
	if($this->uri->segment(3)){
		$this->db->where('id_reg', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_register');
		$tsts = $jjus->row();
		$kodetrs = $tsts->kode_transaksi;
		
		//ambil transaksiiiiiiiiii......................
		$this->db->where('kode_transaksi', $tsts->kode_transaksi);
		$this->db->limit('1');
		$nsdbns = $this->db->get('tb_pembayaran');
		$sndbsd = $nsdbns->row();
		$disabesp = "";
		if($sndbsd){
			$disabesp = "disabled";
			$pinks = unserialize($sndbsd->pmeta);
		}
		//print_r($pinks);
		
		
		//print_r($tsts);
		if($tsts->id_paket > 1){
			$this->db->where('id_paket', $tsts->id_paket);
			$this->db->limit('1');
			$njdjfd = $this->db->get('tb_paket');
			$sndnfs = $njdjfd->row();
			$loadatas[] = array(
				'id' => $sndnfs->id_paket,
				'nama' => $sndnfs->nm_paket,
				'jenis' => 'P',
				'biaya' => $sndnfs->harga_paket,
			);
		}else{
			
				$this->db->where("kode_transaksi", $kodetrs);
				$hdys = $this->db->get('tb_transaksi');
				$abg = $hdys->result();
				
				if($abg){
					foreach($abg as $bsd){
							$this->db->select("js_rs_tind, id_tind, tidak_dapat_diskon, nm_tind");
							$this->db->where("id_tind", $bsd->id_tind);
							$this->db->limit("1");
							$nam = $this->db->get("tb_tindakan");
							$nim = $nam->row();
							$harga = $nim->js_rs_tind;
							if($nim->tidak_dapat_diskon == "Y"){
								$loadbawah[] = array(
									'id' => $nim->id_tind,
									'nama' => $nim->nm_tind,
									'jenis' => 'T',
									'biaya' => $harga,
								);
							}else{
								$loadatas[] = array(
									'id' => $nim->id_tind,
									'nama' => $nim->nm_tind,
									'jenis' => 'T',
									'biaya' => $harga,
								);
							}
					}
				}
		
		
		}
		
		//selanjutnya ambil tambahannnn
		$this->db->where("unicode_transaksi", $kodetrs);
		$this->db->where("type_filter", "TAMBAH");
		$shy = $this->db->get(" tb_register_filterdata");
		$abg = $shy->result();
		if($abg){
			foreach($abg as $bsd){
					$this->db->select("js_rs_tind, id_tind, tidak_dapat_diskon, nm_tind");
					$this->db->where("id_tind", $bsd->id_tind);
					$this->db->limit("1");
					$nam = $this->db->get("tb_tindakan");
					$nim = $nam->row();
					$harga = $nim->js_rs_tind;
					if($nim->tidak_dapat_diskon == "Y"){
						$loadbawah[] = array(
							'id' => $nim->id_tind,
							'nama' => $nim->nm_tind,
							'jenis' => 'T',
							'biaya' => $harga,
						);
					}else{
						$loadatas[] = array(
							'id' => $nim->id_tind,
							'nama' => $nim->nm_tind,
							'jenis' => 'T',
							'biaya' => $harga,
						);
					}
			}
		}
		
?>
<input type="hidden" name="id_reg" value="<?=@$tsts->id_reg?>">
<input type="hidden" name="kode_transaksi" value="<?=@$tsts->kode_transaksi?>">
<table style="width:100%;font-size:12px;">
	<?php if(!$sndbsd){ ?>
	<tr>
		<td colspan="10"><small><i><b style="text-decoration:underline;">Merubah harga juga akan mengupdate master data..</b></i></small></td>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="10">
			<button style="cursor:pointer" type="button" onclick="cetakkwitansibayar('<?=@$tsts->kode_transaksi?>')" style="width:90%;">Cetak Kwitansi</button>
			&nbsp;&nbsp;&nbsp; <button style="cursor:pointer" type="button" onclick="batalbayarpasien('<?=@$tsts->kode_transaksi?>', '<?=@$tsts->id_reg?>')" style="width:90%;">Batal Bayar</button>
			<hr style="margin:5px;">
		</td>
	</tr>
	<?php } ?>
	<?php 
		$bn=1;
		foreach($loadatas as $bsbd){ 
			$ns = $bn++;
			$msna = "";
			if($bsbd['jenis'] == "P"){
				$msna = ' <b>(Paket)</b>';
			}
			
			$jumsebelumdiskon[] = $bsbd['biaya'];
			
			
			$biaya1 = $bsbd['biaya'];
			if(is_array($pinks)){
				$biaya1 = $pinks[$bsbd['jenis']][$bsbd['id']];
			}
	?>
	
	<tr>
		<td><?=@$ns?>.</td>
		<td><?=@$bsbd['nama']?> <?=@$msna?></td>
		<td><input <?=@$disabesp?> class="hitungatas" name="pdetail[<?=@$bsbd['jenis']?>][<?=@$bsbd['id']?>]" id="pc<?=@$bsbd['jenis']?><?=@$bsbd['id']?>" onchange="updateharga('<?=@$bsbd['jenis']?>', '<?=@$bsbd['id']?>', this.value)" onkeyup="rubahangka('<?=@$bsbd['jenis']?><?=@$bsbd['id']?>', this.value), hitungsemuadata()" type="text" value="<?=@$biaya1?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold"></td>
		<td><div style="font-size:12px;font-weight:normal" id="px<?=@$bsbd['jenis']?><?=@$bsbd['id']?>"><?=@is_no_rp($biaya1)?><div></td>
		<td width="1%"></td>
	</tr>
	<?php } ?>
	
	<?php
		$getjumlah   = array_sum($jumsebelumdiskon);
		$getdiskon   = 0;
		$getsubtotal = array_sum($jumsebelumdiskon);
		if($sndbsd){
			$getjumlah   = $sndbsd->pcjumlah;
			$getdiskon   = $sndbsd->pcdiskon;
			$getsubtotal = $sndbsd->pcsubtotal;
		}
	?>
	<tr>
		<td colspan="2"></td>
		<td colspan="10"><hr style="margin:5px;"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Jumlah</b></div></td>
		<td><input <?=@$disabesp?> id="pcjumlah" name="pcjumlah" readonly type="text" value="<?=@$getjumlah?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold;background:#eeeeee"></td>
		<td><div id="pxjumlah" style="font-size:12px;font-weight:normal"><?=@is_no_rp($getjumlah)?><div></td>
		<td width="1%"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Diskon (%)</b></div></td>
		<td><div align="right"><input  <?=@$disabesp?> name="pcdiskon" id="pcdiskon" type="text" value="<?=@$getdiskon?>" onkeyup="hitungsemuadata()" style="width:50%;text-align:right;padding:2px;font-size:14px;font-weight:bold"></div></td>
		<td>%</td>
		<td width="1%"></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td colspan="10"><hr style="margin:5px;"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Sub Total</b></div></td>
		<td><input id="pcsubtotal" <?=@$disabesp?>  name="pcsubtotal" readonly type="text" value="<?=@$getsubtotal?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold;background:#eeeeee"></td>
		<td><div id="pxsubtotal" style="font-size:12px;font-weight:normal"><?=@is_no_rp($getsubtotal)?><div></td>
		<td width="1%"></td>
	</tr>
	<?php 
		//$bn=1;
		foreach($loadbawah as $bsbd){ 
			$ns = $bn++;
			$msna = "";
			if($bsbd['jenis'] == "P"){
				$msna = ' <b>(Paket)</b>';
			}
			$jumsebelumdiskon[] = $bsbd['biaya'];
			
			$biaya1 = $bsbd['biaya'];
			if(is_array($pinks)){
				$biaya1 = $pinks[$bsbd['jenis']][$bsbd['id']];
			}
	?>
	<tr>
		<td><?=@$ns?>.</td>
		<td><?=@$bsbd['nama']?> <?=@$msna?></td>
		<td><input class="hitungbawah" <?=@$disabesp?>  name="pdetail[<?=@$bsbd['jenis']?>][<?=@$bsbd['id']?>]" id="pc<?=@$bsbd['jenis']?><?=@$bsbd['id']?>" onchange="updateharga('<?=@$bsbd['jenis']?>', '<?=@$bsbd['id']?>', this.value)" onkeyup="rubahangka('<?=@$bsbd['jenis']?><?=@$bsbd['id']?>', this.value), hitungsemuadata()" type="text" value="<?=@$biaya1?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold"></td>
		<td><div style="font-size:12px;font-weight:normal" id="px<?=@$bsbd['jenis']?><?=@$bsbd['id']?>"><?=@is_no_rp($biaya1)?><div></td>
		<td width="1%"></td>
	</tr>
	<?php } ?>
	
	<?php
		$gettotal   = array_sum($jumsebelumdiskon);
		$getbayar   = '';
		$getkembali = '';
		if($sndbsd){
			$gettotal   = $sndbsd->pctotal;
			$getbayar   = $sndbsd->pcbayar;
			$getkembali = $sndbsd->pckembali;
		}
	?>
	<tr>
		<td colspan="2"></td>
		<td colspan="10"><hr style="margin:5px;"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Total</b></div></td>
		<td><input name="pctotal" <?=@$disabesp?>  id="pctotal" readonly type="text" value="<?=@$gettotal?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold;background:#eeeeee"></td>
		<td><div id="pxtotal" style="font-size:12px;font-weight:normal"><?=@is_no_rp($gettotal)?><div></td>
		<td width="1%"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Bayar</b></div></td>
		<td><input name="pcbayar" <?=@$disabesp?>  id="pcbayar" type="text" value="<?=@$getbayar?>" onkeyup="rubahangka('bayar', this.value), hitungsemuadata()" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold"></td>
		<td><div id="pxbayar" style="font-size:12px;font-weight:normal"><?=@is_no_rp($getbayar)?><div></td>
		<td width="1%"></td>
	</tr>
	<tr>
		<td colspan="2"><div align="right"><b>Kembali</b></div></td>
		<td><input name="pckembali" <?=@$disabesp?>  id="pckembali" readonly type="text" value="<?=@$getkembali?>" style="width:98%;text-align:right;padding:2px;font-size:14px;font-weight:bold;background:#eeeeee"></td>
		<td><div id="pxkembali" style="font-size:12px;font-weight:normal"><?=@is_no_rp($getkembali)?><div></td>
		<td width="1%"></td>
	</tr>
	<?php if(!$sndbsd){ ?>
	<tr>
		<td colspan="2"></td>
		<td colspan="10"><button type="button" onclick="simpanpembayaranpasien('<?=@$tsts->id_reg?>')">Simpan Pembayaran</button></td>
	</tr>
	<?php } ?>
</table>
<script>
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
	function rubahangka(iddiv, isi){
		if(isNaN(isi)){
			$('#pc'+iddiv).val('');
			$('#px'+iddiv).html('');
		}else{
			$('#px'+iddiv).html(NilaiRupiah(isi));
		}
		
	}
	
	function updateharga(jenis, id, isi){
		$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/updatehargatindpaket')?>", {
			jenis:jenis, id:id, isi:isi
		}, function(response){
			//alert(response);
			
		});
	}
	
	function hitungsemuadata(){
		var sum = 0;
		$('.hitungatas').each(function(){
			sum = parseFloat(sum) + parseFloat(this.value);
		});
		$('#pcjumlah').val(sum);
		$('#pxjumlah').html(NilaiRupiah(sum.toString()));
		var diskon1 = parseFloat($('#pcdiskon').val());
		var diskon2 = (diskon1/100)*sum;
		var subtotal = sum-diskon2;
		$('#pcsubtotal').val(subtotal);
		$('#pxsubtotal').html(NilaiRupiah(subtotal.toString()));
		
		
		var bawah = 0;
		$('.hitungbawah').each(function(){
			bawah = parseFloat(bawah) + parseFloat(this.value);
		});
		var total = bawah+subtotal;
		$('#pctotal').val(total);
		$('#pxtotal').html(NilaiRupiah(total.toString()));
		
		//bayarrrr
		var bayar1 = parseFloat($('#pcbayar').val());
		var kembali = bayar1-total;
		$('#pckembali').val(kembali);
		$('#pxkembali').html(NilaiRupiah(kembali.toString()));
		//alert(sum);   
	}
	
</script>
<?php } ?>