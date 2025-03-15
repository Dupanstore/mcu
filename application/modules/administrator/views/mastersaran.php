<div class="easyui-layout" data-options="fit:true" id="datasaran_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datasaran_table1"  url="<?=@base_url($this->u1.'/jsondatasaran')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_saran" sortOrder="ASC" toolbar="#datasaran_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_saran'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datasaran_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama saran',searcher:datasarancaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datasaran_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datasaran_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatasaran')?>">
				<div id="datasaran_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datasaran_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datasaranhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datasaran_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datasaran_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datasaranhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datasaran_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datasaran_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datasaran_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datasaran_refresh(){
			$('#datasaranhidedua').hide();
			$('#datasaranhidesatu').show();
			$('#datasaran_table1').datagrid('reload');
			$('#datasaran_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatasaran')?>',
			});
		}
		$('#datasaranhidedua').hide();
		$('#datasaran_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatasaran')?>',
		});   
		$('#datasaran_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_saran;
				$('#datasaranhidesatu').hide();
				$('#datasaranhidedua').show();
				$('#datasaran_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatasaran')?>/'+id,
				});  
			}  
		}); 
		function datasaran_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data saran', function(r) {
				if (r){
					$('#datasaran_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datasaran_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datasarancaridata(value){
			$('#datasaran_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datasaran_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data saran', function(r) {
				if (r){
					var id = $('#id_saran').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatasaran/')?>", {
						id:id,
					}, function(response){	
						datasaran_refresh();
					});
				}  
			}); 	
		}
		$('#datasaran_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_saran == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>