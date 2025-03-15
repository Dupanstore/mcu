<div class="easyui-layout" data-options="fit:true" id="datajawatan_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datajawatan_table1"  url="<?=@base_url($this->u1.'/jsondatajawatan')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_jawatan" sortOrder="ASC" toolbar="#datajawatan_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'tipe_jawatan_new'" width="10" sortable="true">Type</th>
							<th data-options="field:'kd_jawatan'" width="30" sortable="true">Kode</th>
							<th data-options="field:'nm_jawatan'" width="30" sortable="true">Nama</th>
							<th data-options="field:'alamat_jawatan'" width="30" sortable="true">Alamat</th>
							<th data-options="field:'no_tlp_jawatan'" width="30" sortable="true">Telp</th>
							<th data-options="field:'default_jawatan_new'" width="30" sortable="true">Default</th>
						</tr>
					</thead>
				</table>
				<div id="datajawatan_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
						<select  class="easyui-combobox" id="get_type_jawatan" style="width:20%">
						<option value="Semua">Semua Type</option>
						<?php
							//ambil kodenya yaaa
						?>
						<?php foreach(is_type_dinas() as $ke => $va){ 
						?>
							<option value="<?=@$ke?>"><?=@$va?></option>
						<?php } ?>
						</select>
							<input class="easyui-searchbox" id="get_type_cari" data-options="prompt:'Masukkan Nama jawatan',searcher:datajawatancaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datajawatan_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datajawatan_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatajawatan')?>">
				<div id="datajawatan_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datajawatan_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datajawatanhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datajawatan_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datajawatan_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datajawatanhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datajawatan_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datajawatan_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datajawatan_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datajawatan_refresh(){
			$('#datajawatanhidedua').hide();
			$('#datajawatanhidesatu').show();
			$('#datajawatan_table1').datagrid('reload');
			$('#datajawatan_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatajawatan')?>',
			});
		}
		$('#datajawatanhidedua').hide();
		$('#datajawatan_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatajawatan')?>',
		});   
		$('#datajawatan_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_jawatan;
				$('#datajawatanhidesatu').hide();
				$('#datajawatanhidedua').show();
				$('#datajawatan_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatajawatan')?>/'+id,
				});  
			}  
		}); 
		function datajawatan_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data jawatan', function(r) {
				if (r){
					$('#datajawatan_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datajawatan_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datajawatancaridata(){
			var value = $('#get_type_cari').textbox('getValue');
			var jawatan = $('#get_type_jawatan').combobox('getValue');
			$('#datajawatan_table1').datagrid('load',{  
				cari: value, jawatan:jawatan,
			}); 
        }
		$('#get_type_jawatan').combobox({
			    valueField:'id',
				textField:'text',
				onSelect: function(rec){
					datajawatancaridata();
				}
		});
		function datajawatan_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data jawatan', function(r) {
				if (r){
					var id = $('#id_jawatan').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatajawatan/')?>", {
						id:id,
					}, function(response){	
						datajawatan_refresh();
					});
				}  
			}); 	
		}
		$('#datajawatan_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_jawatan == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>