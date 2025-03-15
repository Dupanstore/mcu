<?php
	if($this->uri->segment(3)){
		$this->db->where('id_reg', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_register');
		$tsts = $jjus->row();
		//print_r($tsts);
?>
<input type="hidden" name="kode_transaksi" value="<?=@$tsts->kode_transaksi?>">
<input type="hidden" name="id_reg" value="<?=@$tsts->id_reg?>">
<input type="hidden" name="no_reg" value="<?=@$tsts->no_reg?>">
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td colspan="2"><div align="center"><b style="text-decoration:underline;"><?=@$tsts->no_filemcu?></b></div></td>
			</tr>
			<tr>
				<td>Jenis:</td>
				<td>
					<select id="jenis_revisi" name="jenis_revisi" onchange="rubahsttrevisi(this.value)" style="width:100%;"  >
					<?php
					?>
					<?php foreach(is_getTipeJawatan() as $bsg =>  $va){ 
					?>
						<option value="<?=@$bsg?>"><?=@$va?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr id="pk1">
				<td>Kode:</td>
				<td>
					<select  name="ppcomborevisidinas" id="ppcomborevisidinas" style="width:100%;"  >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->order_by("nm_dinas", "ASC");
						$this->db->where("tipe_dinas", "D");
						$sggd = $this->db->get("tb_dinas");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
					?>
						<option value="<?=@$va->id_dinas?>"><?=@$va->nm_dinas?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr id="pk2">
				<td>Kode:</td>
				<td>
					<select  name="ppcomborevisinon" id="ppcomborevisinon" style="width:100%;"  >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->order_by("nm_dinas", "ASC");
						$this->db->where("tipe_dinas", "N");
						$sggd = $this->db->get("tb_dinas");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
					?>
						<option value="<?=@$va->id_dinas?>"><?=@$va->nm_dinas?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr id="pk3">
				<td>Cara Bayar:</td>
				<td>
					<select  name="ppcomborevisibayar" id="ppcomborevisibayar" style="width:100%;" onchange="getdetaildatarevisi()" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->where("id_bayar <> 1");
						$sggd = $this->db->get("tb_bayar");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
					?>
						<option value="<?=@$va->id_bayar?>"><?=@$va->nm_bayar?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="5"><div id="revisidataajax"></div></td>
			</tr>
		</table>
</fieldset>
<script>
	$('#ppcomborevisidinas').combobox({
			onSelect: function(data){
			getdetaildatarevisi();
		}
	});
	
	$('#ppcomborevisinon').combobox({
			onSelect: function(data){
			getdetaildatarevisi();
		}
	});
	function rubahsttrevisi(ik){
		if(ik == "D"){
			$('#ppcomborevisidinas').combobox('setValue', '');
			$('#ppcomborevisinon').combobox('setValue', '');
			$('#ppcomborevisibayar').val('');
			$('#pk1').show();
			$('#pk2').hide();
			$('#pk3').hide();
		}else{
			$('#ppcomborevisidinas').combobox('setValue', '');
			$('#ppcomborevisinon').combobox('setValue', '');
			$('#ppcomborevisibayar').val('');
			$('#pk1').hide();
			$('#pk2').show();
			$('#pk3').show();
		}
		getdetaildatarevisi();
	}
	rubahsttrevisi('D');
	
	function getdetaildatarevisi(){
		var jenis = $('#jenis_revisi').val();
		var kode1 = $('#ppcomborevisidinas').combobox('getValue');
		var kode2 = $('#ppcomborevisinon').combobox('getValue');
		var bayar = $('#ppcomborevisibayar').val();
		$('#revisidataajax').html('Loading data....');
		$.post('<?=@base_url('administrator/getdetaildatarevisi')?>',{
			jenis:jenis, kode1:kode1, kode2:kode2, bayar:bayar,tglawal:'<?=@$tsts->tgl_awal_reg?>'
		},function(result){ 
			$('#revisidataajax').html(result);
		}); 
	}
</script>
<?php } ?>