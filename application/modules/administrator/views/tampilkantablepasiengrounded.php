<div class="easyui-layout" data-options="fit:true" id="tampildatagrounded_layout1">
		<div data-options="region:'east',split:true,footer:'#tampildatagrounded_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:100%;background:#eeffff;">
			<form method="POST" id="tampildatagrounded_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatetampildatagrounded')?>">
				<?php
					$this->db->where('kode_transaksi', $this->u3);
					$cekdatagrounded = $this->db->get('tb_register');
					$setdatagrounded = $cekdatagrounded->row();
				?>
				<input type="hidden" name="kode_transaksi_grounded" value="<?=@$this->u3?>">
				<table style="width:100%" cellpadding="2px;">
					<tr>
						<td><b>Telegram Grounded:</b></td>
					</tr>
					<tr>
						<td>
							<textarea style="width:95%" name="tele_grounded"><?=@$setdatagrounded->tele_grounded?></textarea>
						</td>
					</tr>
					<tr>
						<td><b>Telegram Permohonan Cabut Grounded:</b></td>
					</tr>
					<tr>
						<td>
							<textarea style="width:95%" name="tele_cabut"><?=@$setdatagrounded->tele_cabut?></textarea>
						</td>
					</tr>
					<tr>
						<td><b>Telegram Rilis Terbang:</b></td>
					</tr>
					<tr>
						<td>
							<textarea style="width:95%" name="tele_rilis"><?=@$setdatagrounded->tele_rilis?></textarea>
						</td>
					</tr>
					<tr>
						<td><b>Keterangan:</b></td>
					</tr>
					<tr>
						<td>
							<textarea style="width:95%" name="keterangan_grounded"><?=@$setdatagrounded->keterangan_grounded?></textarea>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="tampildatagrounded_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="tampildatagroundedhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="tampildatagrounded_simpandata()"><b>Simpan Data</b></a>
				</div>
			</div>
		</div>
    </div>
	<script>
		function tampildatagrounded_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data', function(r) {
				if (r){
					$('#tampildatagrounded_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#detopendatagrounded').window('close');
								tablepasiengroundedcaridata();
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
	</script>