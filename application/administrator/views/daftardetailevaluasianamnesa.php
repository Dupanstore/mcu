<?php
	//print_r($_GET);
	//AMBIL ANAMNESANYA YAAAA
		$this->db->select('keluhan_utama,  no_reg');
		$this->db->where('kode_transaksi', clean_data($_GET['kode_transaksi']));
		$this->db->limit('1');
		$sssa = $this->db->get('tb_register');
		$duslam = $sssa->result();
		$shn = "";
		if($duslam){
			$shn .= $duslam[0]->keluhan_utama;
			$this->db->select('riwayat_kesehatan_pasien,  riwayat_kesehatan_keluarga');
			$this->db->where('no_reg', $duslam[0]->no_reg);
			$this->db->limit('1');
			$jsuy = $this->db->get('tb_pasien');
			$anhs = $jsuy->result();
			if($anhs){
				if($anhs[0]->riwayat_kesehatan_pasien != ""){
					$shn .= "\nRPD: ". $anhs[0]->riwayat_kesehatan_pasien;
				}
				if($anhs[0]->riwayat_kesehatan_keluarga != ""){
					$shn .= "\nRPK: ".$anhs[0]->riwayat_kesehatan_keluarga;
				}
			}
		}
		$this->db->where('ket_resume', 'anamnesa');
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		$this->db->limit('1');
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->result();
		if($respas){
			$shn = $respas[0]->isi_anamnesa;
		}
		
?>
	<?php if(!$respas){ ?>
	<table class="tableeasyui" style="width:100%">
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Anamnesa Belum Tersimpan</div></b></td>
	</tr>
	</table>
	<?php } ?>
<form method="POST" id="detailevaluasianamnesa_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpandetailanamnesapasien')?>">
<input type="hidden" name="id_res" value="<?=@$respas[0]->id_res?>">
<input type="hidden" name="kode_transaksi_resume" value="<?=@$_GET['kode_transaksi']?>">
<textarea cols="80" id="edito1" name="anamnesanyaya" rows="10" style="width:99%;border:solid 1px #cccccc;"><?=@$shn?></textarea>
</form>
<hr style="border:#eeeeee;margin:5px;"/>
<div style="padding:10px;">
<button style="cursor:pointer" type="button" onclick="simpanevaluasianamnesa()" style="width:100%;">Simpan Anamnesa</button>
</div>
<script type="text/javascript">
function simpanevaluasianamnesa(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk melanjutkan', function(r) {
				if (r){
					$('#detailevaluasianamnesa_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panel_detailevaluasi_anamnesa').panel({
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
