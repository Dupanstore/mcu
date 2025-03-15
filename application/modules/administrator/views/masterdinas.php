<div class="easyui-layout" data-options="fit:true" id="datadinas_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datadinas_table1"  url="<?=@base_url($this->u1.'/jsondatadinas')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_dinas" sortOrder="ASC" toolbar="#datadinas_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'tipe_dinas_new'" width="10" sortable="true">Type</th>
							<th data-options="field:'nm_dinas'" width="30" sortable="true">Nama</th>
							<th data-options="field:'set_ila_jmu'" width="10" sortable="true">ILA AU/MEDEX/PATI AU</th>
						</tr>
					</thead>
				</table>
				<div id="datadinas_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
						<select  class="easyui-combobox" id="get_type_din" style="width:20%">
						<option value="Semua">Semua Type</option>
						<?php
							//ambil kodenya yaaa
						?>
						<?php foreach(is_type_dinas() as $ke => $va){ 
						?>
							<option value="<?=@$ke?>"><?=@$va?></option>
						<?php } ?>
						</select>
							<input class="easyui-searchbox" id="get_type_cari" data-options="prompt:'Masukkan Nama dinas',searcher:datadinascaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datadinas_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datadinas_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatadinas')?>">
				<div id="datadinas_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datadinas_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datadinashidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datadinas_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datadinas_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datadinashidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datadinas_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datadinas_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datadinas_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datadinas_refresh(){
			$('#datadinashidedua').hide();
			$('#datadinashidesatu').show();
			$('#datadinas_table1').datagrid('reload');
			$('#datadinas_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatadinas')?>',
			});
		}
		$('#datadinashidedua').hide();
		$('#datadinas_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatadinas')?>',
		});   
		$('#datadinas_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_dinas;
				$('#datadinashidesatu').hide();
				$('#datadinashidedua').show();
				$('#datadinas_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatadinas')?>/'+id,
				});  
			}  
		}); 
		function datadinas_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data dinas', function(r) {
				if (r){
					$('#datadinas_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datadinas_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datadinascaridata(){
			var value = $('#get_type_cari').textbox('getValue');
			var dinas = $('#get_type_din').combobox('getValue');
			$('#datadinas_table1').datagrid('load',{  
				cari: value, dinas:dinas,
			}); 
        }
		$('#get_type_din').combobox({
			    valueField:'id',
				textField:'text',
				onSelect: function(rec){
					datadinascaridata();
				}
		});
		function datadinas_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data dinas', function(r) {
				if (r){
					var id = $('#id_dinas').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatadinas/')?>", {
						id:id,
					}, function(response){	
						datadinas_refresh();
					});
				}  
			}); 	
		}
		$('#datadinas_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_dinas == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>