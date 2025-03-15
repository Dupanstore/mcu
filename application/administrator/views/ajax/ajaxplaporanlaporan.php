<form method="POST" id="akuinginsehatlaporan" action="javascript:void(0)">
<fieldset style="border:#cccccc 1px dotted;margin:5px;background:#E0EFFB">
	<legend></legend>
		<table style="width:100%" cellpadding="2px;">
		<input type="hidden" name="urilaporan" value="<?=@$this->u3?>">
					<tr>
						<td>Perusahaan/Kesatuan</td>
						<td style="width:30%">
							<select  name="id_jawatan"  id="id_jawatan" style="width:100%">
								<option value="">--Semua--</option>
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
						<td>Kode</td>
						<td>
							<?php
								$lappp = "getnamadinas";
								if($this->u3 == "a2"){
									$lappp = "getnamadinasilamedex";
								}
							
							?>
							<input  name="id_dinas[]" id="id_dinas" class="easyui-combotree" data-options="url:'<?=@base_url('administrator/'. $lappp)?>',method:'get',label:'Select Nodes:',labelPosition:'top',multiple:true" style="width:100%">
							
						</td>
					</tr>
					<tr>
						<td>Type</td>
						<td>
							<select name="kesatuan_pas" id="kesatuan_pas"  style="width:100%">
							<option value="">--Semua--</option>
							<?php 
								foreach(is_kesatuan() as $ke => $va){ 
							?>
								<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
							<?php } ?>
							</select>
						</td>
						<td >Cara Bayar</td>
						<td >
							<select  name="cara_bayar" id="cara_bayar" style="width:100%">
								<option value="">--Semua--</option>
								<?php 
									$this->db->select('id_bayar, nm_bayar');
									$this->db->order_by('id_bayar', 'ASC');
									$cmb1 = $this->db->get('tb_bayar');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
								?>
									<option value="<?=@$va->nm_bayar?>" <?=@$sel?>><?=@$va->nm_bayar?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Dari Tanggal</td>
						<td>
							<input class="easyui-datebox" name="tanggalawal" style="width:100%;" value="<?=@date('m/d/Y')?>">
						</td>
						<td ></td>
						<td >
							
						</td>
					</tr>
					<tr>
						<td>Tanggal Akhir</td>
						<td>
							<input class="easyui-datebox" name="tanggalakhir" style="width:100%;" value="<?=@date('m/d/Y')?>">
						</td>
						<td ></td>
						<td >
							
						</td>
					</tr>
					<tr>
						<td></td>
						<td colspan="3">
							<button type="button" class="easyui-linkbutton" style="cursor:pointer" onclick="bukalaporan('print')">Tampilkan Dilayar</button>
							<button type="button" class="easyui-linkbutton" style="cursor:pointer" onclick="bukalaporan('excel')">Import Data ke Excel</button>
						</td>
					</tr>
		</table>
		<br />
</fieldset>
</form>
<script type="text/javascript">
function rubahpaketlaporanlaporan(vall){
			$.post('<?=@base_url('administrator/caripaketpasien')?>',{id:vall},function(result){ 
				$('#defaultpaket').html(result);
				abcdetampil();
			}); 
		}
</script>