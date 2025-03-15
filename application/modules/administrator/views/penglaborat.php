<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'west',split:true" title="Golongan Pemeriksaan" style="width:250px;background:#eeffff;">
			<table class="easyui-datagrid" id="datapolipemeriksaantabel"  url="<?=@base_url($this->u1.'/jsonloadpemeriksaanlab')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_grouptindakan" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'nm_grouptindakan'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <div class="easyui-tabs" id="newtabketerangan" style="width:auto;" data-options="fit:true">
					       
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#dataagama_panel1_toolbar',iconCls:'icon-lock'" title="Pengaturan Awal Laboratorium" style="width:350px;background:#eeffff;">
			<input type="hidden" id="xxinstid" value="">
			<form method="POST" id="tabelpengaturanlabumum" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatepenglabawal')?>">
				<div id="dataagama_panel1" class="easyui-panel" title="">
					<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
							<table style="width:100%" cellpadding="2px;">
								<tr>
									<td width="100%" colspan="2">
										<i><small>Silahkan set satuan pemeriksaan, gunakan koma spasi (, ) untuk satuan yang lainnya</small></i><br />
										<textarea name="is_pemeriksaan_lab" style="font-weight:bold;width:100%"><?=@$this->madmin->Get_setting('is_pemeriksaan_lab')?></textarea><br />
									</td>
								</tr>
								<tr>
									<td width="50%">
										<small>Dikatakan bayi jika umur <= </small><br />
										<select  name="rsau_lab_umur_bayi">
											<option value="">Silahkan pilih...</option>
											<?php
												//ambil kodenya yaaa
											?>
											<?php foreach(range(1,5) as $ke => $va){ 
													$sel = "";
													if($this->madmin->Get_setting('rsau_lab_umur_bayi') == $ke){
														$sel = 'selected="true"';
													}
											?>
												<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?> Thn</option>
											<?php } ?>
										</select>
									</td>
									<td>
										<small>Dikatakan anak jika umur <= </small><br />
										<select  name="rsau_lab_umur_anak">
											<option value="">Silahkan pilih...</option>
											<?php
												//ambil kodenya yaaa
											?>
											<?php foreach(range(1,20) as $ke => $va){ 
													$sel = "";
													if($this->madmin->Get_setting('rsau_lab_umur_anak') == $ke){
														$sel = 'selected="true"';
													}
											?>
												<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?> Thn</option>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<i><small>Silahkan set untuk pemeriksaan darah tepi</small></i><br />
										<?php
											$this->db->select("id_tind, nm_tind");
											$this->db->where("id_ins_tind", 2);
											$this->db->order_by("nm_tind", "ASC");
											$cekdarahtepi = $this->db->get('tb_tindakan');
											$getdarahtepi = $cekdarahtepi->result();
										?>
										<select  name="lab_darah_tepi_tind_id" style="width:100%">
											<option value="">Silahkan pilih...</option>
											<?php foreach($getdarahtepi as $va){ 
													$sel = "";
													if($this->madmin->Get_setting('lab_darah_tepi_tind_id') == $va->id_tind){
														$sel = 'selected="true"';
													}
											?>
												<option value="<?=@$va->id_tind?>" <?=@$sel?>><?=@$va->nm_tind?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
							</table>
					</fieldset>
				</div>
			</form>
		</div>
    </div>
	<div id="dataagama_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="simpanpenglabawal()"><b>Simpan Perubahan</b></a>
			</div>
		</div>
	<script type="text/javascript">
		$('#datapolipemeriksaantabel').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_grouptindakan;
				$('#xxinstid').val(id); 
				if ($('#newtabketerangan').tabs('exists', 'Konfigurasi Jenis Pemeriksaan')){  
					$('#newtabketerangan').tabs('select', 'Konfigurasi Jenis Pemeriksaan');
					var bbb = $('#newtabketerangan').tabs('getSelected');
					bbb.panel('refresh', '<?=@base_url($this->u1.'/ajaxkonfigurasipemeriksaanlab')?>/'+id);
				} else {  
					$('#newtabketerangan').tabs('add',{  
						title:'Konfigurasi Jenis Pemeriksaan',  
						href:'<?=@base_url($this->u1.'/ajaxkonfigurasipemeriksaanlab')?>/'+id,
						closable:true  
					});  
				} 
				if ($('#newtabketerangan').tabs('exists', 'Tambah Pemeriksaan Laboratorium')){  
					$('#newtabketerangan').tabs('select', 'Tambah Pemeriksaan Laboratorium');
					var tab = $('#newtabketerangan').tabs('getSelected');
					tab.panel('refresh', '<?=@base_url($this->u1.'/ajaxtambahpemlaborat')?>/'+id);
				} else {  
					$('#newtabketerangan').tabs('add',{  
						title:'Tambah Pemeriksaan Laboratorium',  
						href:'<?=@base_url($this->u1.'/ajaxtambahpemlaborat')?>/'+id,
						closable:true  
					});  
				}  	
			}  
		}); 
		function simpanpenglabawal(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan pengaturan', function(r) {
				if (r){
					$('#tabelpengaturanlabumum').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							}
						}  
					}); 
				}
			});
		}
	</script>