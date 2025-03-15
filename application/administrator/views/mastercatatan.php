<div class="easyui-layout" data-options="fit:true" id="datacatatan_dinas_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datacatatan_dinas_table1"  url="<?=@base_url($this->u1.'/jsondatacatatan_dinas')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_ctd" sortOrder="ASC" toolbar="#datacatatan_dinas_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_ctd'" width="100" sortable="true">Catatan</th>
							<th data-options="field:'jencatatan'" width="10" sortable="true">Jenis</th>
						</tr>
					</thead>
				</table>
				<div id="datacatatan_dinas_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Catatan',searcher:datacatatan_dinascaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datacatatan_dinas_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datacatatan_dinas_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatacatatan_dinas')?>">
				<div id="datacatatan_dinas_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datacatatan_dinas_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datacatatan_dinashidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datacatatan_dinas_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datacatatan_dinas_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datacatatan_dinashidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datacatatan_dinas_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datacatatan_dinas_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datacatatan_dinas_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datacatatan_dinas_refresh(){
			$('#datacatatan_dinashidedua').hide();
			$('#datacatatan_dinashidesatu').show();
			$('#datacatatan_dinas_table1').datagrid('reload');
			$('#datacatatan_dinas_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatacatatan_dinas')?>',
			});
		}
		$('#datacatatan_dinashidedua').hide();
		$('#datacatatan_dinas_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatacatatan_dinas')?>',
		});   
		$('#datacatatan_dinas_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_ctd;
				$('#datacatatan_dinashidesatu').hide();
				$('#datacatatan_dinashidedua').show();
				$('#datacatatan_dinas_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatacatatan_dinas')?>/'+id,
				});  
			}  
		}); 
		function datacatatan_dinas_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data catatan_dinas', function(r) {
				if (r){
					$('#datacatatan_dinas_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datacatatan_dinas_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datacatatan_dinascaridata(value){
			$('#datacatatan_dinas_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datacatatan_dinas_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data catatan_dinas', function(r) {
				if (r){
					var id = $('#id_ctd').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatacatatan_dinas/')?>", {
						id:id,
					}, function(response){	
						datacatatan_dinas_refresh();
					});
				}  
			}); 	
		}
		$('#datacatatan_dinas_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_catatan_dinas == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>