<?php if($this->uri->segment(3)){ ?>
<table style="100%">
	<tr>
		<td><input class="easyui-combo" id="list_gantipemeriksaan" name="list_gantipemeriksaan[]" data-options="valueField:'id',textField:'text',multiple:true" style="width:100%"></td>
		<td width="5%"><button type="button" style="cursor:pointer" onclick="lanjutkangantipaket()">Lanjutkan</button></td>
		<td width="5%"><button type="button" style="cursor:pointer" onclick="batalkangantipemeriksaan()">Batal</button></td>
	</tr>
	<tr>
		<td colspan="3">Pemeriksaan yang dipilih <div id="newpilihpemeriksaan"></div></td>
	</tr>
</table>
<script type="text/javascript">
	$('#list_gantipemeriksaan').combobox({
		url:'<?=@base_url($this->u1 . '/getdatalistpemeriksaan/?gantipemeriksaantampil='.$this->uri->segment(3))?>',
	});
	$('#list_gantipemeriksaan').combo({
						onChange: function(newValue,oldValue){
							var hh = $('#list_gantipemeriksaan').combo('getValues');
							$.post("<?=base_url($this->u1 .'/tampilkandaftarpemeriksaansaya')?>", {
								arrpem:hh,
							}, function(response){
								$('#newpilihpemeriksaan').html(response);
							});
						}
					});
</script>
<?php } ?>