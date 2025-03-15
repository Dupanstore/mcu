<form method="GET" id="dataformcetakmcu" action="<?=base_url($this->u1 .'/'. $this->u1 .'/cetakdataexcelmcukonsul')?>">
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend></legend>
		<table style="width:99%"> 
							<tr>
								<td width="50%"><input class="easyui-datebox" type="text" id="filter_tglawal" name="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;"></td>
								<td><input class="easyui-datebox" type="text" id="filter_tglakhir" name="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;"></td>
							</tr>
							<tr>
								<td>
									<select  class="easyui-combobox" id="filter_jawatan" name="filter_jawatan" style="width:100%;">
									<option value="">Semua Jawatan...</option>
									<?php 
										$this->db->select('id_jawatan, nm_jawatan');
										$this->db->order_by('nm_jawatan', 'ASC');
										$cmb1 = $this->db->get('tb_jawatan');
										$cmb1 = $cmb1->result();
										foreach($cmb1 as $va){ 
									?>
										<option value="<?=@$va->id_jawatan?>" <?=@$sel?>><?=@$va->nm_jawatan?></option>
									<?php } ?>
									</select>
								</td>
								<td>
								
								</td>
							</tr>
							<tr>
								<td colspan="2"><input type="radio" name="filter_typejawatan" checked="true" value="">Semua Pasien</td>
							</tr>
							<?php 
								foreach(is_getTipeJawatan() as $ke => $va){ 
							?>
								<tr>
									<td colspan="2"><input type="radio" name="filter_typejawatan" value="<?=@$ke?>"><?=@$va?></td>
								</tr>
							<?php } ?>
							<tr>
								<td colspan="2"><button type="button" style="cursor:pointer" onclick="importdataexceldua('preview')">Preview Data</button>
												<button type="button" style="cursor:pointer" onclick="importdataexceldua('excel')">Import Data ke Excel</button>
								</td>
							</tr>			
		</table>
</fieldset>
</form>