<?php
			//ambil data
			$id1 = $this->madmin->Get_setting('set_id_chamber');
			$id2 = $this->madmin->Get_setting('set_id_psikologi');
			$id3 = $this->madmin->Get_setting('set_id_psikiatri');
			$id4 = $this->madmin->Get_setting('set_id_samapta');
			$id5 = $this->madmin->Get_setting('set_id_bc');
			//print_r($id4);
			
			$cekfjh = "select b.id_tind_pem, b.kesimpulan_pemeriksaan";
			$cekfjh .= " from tb_register_pemeriksaan b ";
			$cekfjh .= " where (b.id_tind_pem=".$id2." OR b.id_tind_pem=".$id3." OR b.id_tind_pem=".$id4.") and b.kode_transaksi='".$_GET['kode_transaksi']."' ";
			$sgfdgfs = $this->db->query($cekfjh);
			$fdgfskd = $sgfdgfs->result();
			if($fdgfskd){
				foreach($fdgfskd as $tghdfd){
					$prcsok['ttm'][$tghdfd->id_tind_pem] = $tghdfd->kesimpulan_pemeriksaan;
				}
			}
			
			$cekfjh = "select a.id_parent_chamber, a.kesimpulan_det_pemeriksaan ";
			$cekfjh .= " from tb_register_detailpemeriksaan a ";
			$cekfjh .= " where (a.id_parent_chamber=".$id1." OR a.id_parent_chamber=".$id5.") and a.kode_transaksi='".$_GET['kode_transaksi']."' ";
			$sgfdgfs = $this->db->query($cekfjh);
			$fdgfskd = $sgfdgfs->result();
			if($fdgfskd){
				foreach($fdgfskd as $tghdfd){
					$prcsok['cmb'][$tghdfd->id_parent_chamber] = $tghdfd->kesimpulan_det_pemeriksaan;
				}
			}
		
			
			$newsatu['Chamber-FI'] = $prcsok['cmb'][$id1];
			$newsatu['BC'] = $prcsok['cmb'][$id5];
			$newsatu['Psikiatri'] = $prcsok['ttm'][$id3];
			$newsatu['Psikologi'] = $prcsok['ttm'][$id2];
			$newsatu['Kesamaptaan'] = $prcsok['ttm'][$id4];
			
			$pc1 = $newsatu['Chamber-FI'];
			$pc2 = $newsatu['BC'];
			$pc3 = $newsatu['Psikiatri'];
			$pc4 = $newsatu['Psikologi'];
			$pc5 = $newsatu['Kesamaptaan'];
			
			
		
		$this->db->where('ket_resume', 'periksatambahan');
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		//$this->db->limit('1');
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->result();
		//print_r($respas);
		if($respas){
			foreach($respas as $sgt){
				$iddata[$sgt->nama_kelainan] = $sgt->id_res;
				$newsatu[$sgt->nama_kelainan] = $sgt->isi_kelainan;
			}	
			
		}
?>
<?php if(!$respas){ ?>
	<table class="tableeasyui" style="width:100%">
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Pemeriksaan Tambahan Belum Tersimpan</div></b></td>
	</tr>
	</table>
	<?php } ?>
<form method="POST" id="detailevaluasitambahan_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaantambahan')?>">
<input type="hidden" name="kode_transaksi_resume" value="<?=@$_GET['kode_transaksi']?>">

<table>
	<tr>
		<td>Chamber-FI</td>
		<input type="hidden" name="id_res[Chamber-FI]" value="<?=@$iddata['Chamber-FI']?>">
		<td>
		<textarea cols="80" id="edito1" rows="2" disabled="true" style="background:#eeefff;width:99%;border:solid 1px #cccccc;"><?=@$pc1?></textarea>
		<textarea cols="80" id="edito1" name="pemeriksaan[Chamber-FI]" rows="2" style="width:99%;border:solid 1px #cccccc;"><?=@$newsatu['Chamber-FI']?></textarea>
		</td>
	</tr>
	<tr>
		<td>Psikologi</td>
		<input type="hidden" name="id_res[Psikologi]" value="<?=@$iddata['Psikologi']?>">
		<td>
			<textarea cols="80" id="edito1" rows="2" disabled="true" style="background:#eeefff;width:99%;border:solid 1px #cccccc;"><?=@$pc2?></textarea>
			<textarea cols="80" id="edito1" name="pemeriksaan[Psikologi]" rows="2" style="width:99%;border:solid 1px #cccccc;"><?=@$newsatu['Psikologi']?></textarea>
		</td>
	</tr>
	<tr>
		<td>Psikiatri</td>
		<input type="hidden" name="id_res[Psikiatri]" value="<?=@$iddata['Psikiatri']?>">
		<td>
			<textarea cols="80" id="edito1" rows="2" disabled="true" style="background:#eeefff;width:99%;border:solid 1px #cccccc;"><?=@$pc3?></textarea>
			<textarea cols="80" id="edito1" name="pemeriksaan[Psikiatri]" rows="2" style="width:99%;border:solid 1px #cccccc;"><?=@$newsatu['Psikiatri']?></textarea>
		</td>
	</tr>
	<tr>
		<td>Kesamaptaan</td>
		<input type="hidden" name="id_res[Kesamaptaan]" value="<?=@$iddata['Kesamaptaan']?>">
		<td>
			<textarea cols="80" id="edito1" rows="2" disabled="true" style="background:#eeefff;width:99%;border:solid 1px #cccccc;"><?=@$pc4?></textarea>
			<textarea cols="80" id="edito1" name="pemeriksaan[Kesamaptaan]" rows="2" style="width:99%;border:solid 1px #cccccc;"><?=@$newsatu['Kesamaptaan']?></textarea>
		</td>
	</tr>
	<tr>
		<td>BC</td>
		<input type="hidden" name="id_res[BC]" value="<?=@$iddata['BC']?>">
		<td>
			<textarea cols="80" id="edito1" rows="2" disabled="true" style="background:#eeefff;width:99%;border:solid 1px #cccccc;"><?=@$pc5?></textarea>
			<textarea cols="80" id="edito1" name="pemeriksaan[BC]" rows="2" style="width:99%;border:solid 1px #cccccc;"><?=@$newsatu['BC']?></textarea>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><button style="cursor:pointer" type="button" onclick="simpanpemeriksaantambahan()" style="width:100%;">Simpan Pemeriksaan Tambahan</button></td>
	</tr>
</table>
</form>
<script type="text/javascript">
function simpanpemeriksaantambahan(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk melanjutkan', function(r) {
				if (r){
					$('#detailevaluasitambahan_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panel_detailevaluasi_periksatambahan').panel({
									href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/<?=@$this->u3?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$_GET['no_reg']?>',
								});
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
</script>