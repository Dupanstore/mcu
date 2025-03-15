<?php
	//ambil data ditabel pembayaran
	$this->db->where("id_trans", $this->u3);
	$this->db->limit("1");
	$hey = $this->db->get("tb_transaksi");
	$hoy = $hey->result();
	$shu  = 'Update Harga';
?>
<table class="tableeasyui" style="width:100%">
	<tr>
		<td>Harga Jasa Dokter</td>
		<td><input type="text" id="jasanya" value="<?=@$hoy[0]->jasa_dokter?>" onkeyup="hargajasa(this.value)"></td>
	</tr>
	<tr>	
		<td>Harga Pemeriksaan</td>
		<td><input type="text" id="hrgnya" value="<?=@$hoy[0]->harga_pemeriksaan?>" onkeyup="ubahharga(this.value)"></td>
	</tr>
	<tr>
		<td><button style="cursor:pointer" type="button" onclick="updateharganya('<?=@$this->u3?>','<?=@$this->u4?>')" style="width:90%;"><?=@$shu?></button></td>
	</tr>
</table>
<script type="text/javascript">
	function updateharganya(id,kode){
		var hrgbaru = $('#hrgnya').val();
		var jasabaru = $('#jasanya').val();
		$.messager.confirm('Konfirmasi', 'Apa anda yakin ?', function(r) {
				if (r){
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/updateharganya')?>", {
							id:id, harga:hrgbaru, hrgjasa:jasabaru,
						}, function(response){
							$('#modaltampilkandetailpembayaran').panel({
								href:'<?=@base_url($this->u1.'/inputpembayaranpasien')?>/'+kode,
							});
							$.messager.alert('Informasi', 'Harga berhasil diubah', 'info');
						});
				}
			});
	}
	function ubahharga(hrg){
		$('#hrgnya').val(hrg);
	}
	function hargajasa(hrg){
		$('#jasanya').val(hrg);
	}
</script>