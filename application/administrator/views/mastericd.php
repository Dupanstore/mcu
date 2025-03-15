<div class="easyui-layout" data-options="fit:true" id="dataicd_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="dataicd_table1"  url="<?=@base_url($this->u1.'/jsondataicd')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_icd" sortOrder="ASC" toolbar="#dataicd_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_icd'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_icd'" width="50" sortable="true">Nama</th>
							<th data-options="field:'alias_icd'" width="50" sortable="true">Alias</th>
						</tr>
					</thead>
				</table>
				<div id="dataicd_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama atau Alias ICD',searcher:dataicdcaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#dataicd_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="dataicd_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedataicd')?>">
				<div id="dataicd_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="dataicd_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="dataicdhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataicd_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataicd_refresh()"><b>Refresh</b></a>
				</div>
				<div id="dataicdhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataicd_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="dataicd_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataicd_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function dataicd_refresh(){
			$('#dataicdhidedua').hide();
			$('#dataicdhidesatu').show();
			$('#dataicd_table1').datagrid('reload');
			$('#dataicd_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdataicd')?>',
			});
		}
		$('#dataicdhidedua').hide();
		$('#dataicd_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdataicd')?>',
		});   
		$('#dataicd_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_icd;
				$('#dataicdhidesatu').hide();
				$('#dataicdhidedua').show();
				$('#dataicd_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdataicd')?>/'+id,
				});  
			}  
		}); 
		function dataicd_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data icd', function(r) {
				if (r){
					$('#dataicd_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								dataicd_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function dataicdcaridata(value){
			$('#dataicd_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function dataicd_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data icd', function(r) {
				if (r){
					var id = $('#id_icd').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdataicd/')?>", {
						id:id,
					}, function(response){	
						dataicd_refresh();
					});
				}  
			}); 	
		}
		$('#dataicd_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_icd == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>