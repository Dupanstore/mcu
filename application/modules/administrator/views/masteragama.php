<div class="easyui-layout" data-options="fit:true" id="dataagama_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="dataagama_table1"  url="<?=@base_url($this->u1.'/jsondataagama')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_agama" sortOrder="ASC" toolbar="#dataagama_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_agama'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_agama'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="dataagama_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Agama',searcher:dataagamacaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#dataagama_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="dataagama_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedataagama')?>">
				<div id="dataagama_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="dataagama_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="dataagamahidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataagama_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataagama_refresh()"><b>Refresh</b></a>
				</div>
				<div id="dataagamahidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataagama_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="dataagama_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataagama_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function dataagama_refresh(){
			$('#dataagamahidedua').hide();
			$('#dataagamahidesatu').show();
			$('#dataagama_table1').datagrid('reload');
			$('#dataagama_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdataagama')?>',
			});
		}
		$('#dataagamahidedua').hide();
		$('#dataagama_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdataagama')?>',
		});   
		$('#dataagama_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_agama;
				$('#dataagamahidesatu').hide();
				$('#dataagamahidedua').show();
				$('#dataagama_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdataagama')?>/'+id,
				});  
			}  
		}); 
		function dataagama_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data agama', function(r) {
				if (r){
					$('#dataagama_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								dataagama_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function dataagamacaridata(value){
			$('#dataagama_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function dataagama_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data agama', function(r) {
				if (r){
					var id = $('#id_agama').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdataagama/')?>", {
						id:id,
					}, function(response){	
						dataagama_refresh();
					});
				}  
			}); 	
		}
		$('#dataagama_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_agama == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>