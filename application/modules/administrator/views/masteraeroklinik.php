<div class="easyui-layout" data-options="fit:true" id="dataaero_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="dataaero_table1"  url="<?=@base_url($this->u1.'/jsondataaero')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_aero" sortOrder="ASC" toolbar="#dataaero_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_ins'" width="50" sortable="true">Poliklinik</th>
							<th data-options="field:'nm_aero'" width="50" sortable="true">Pemeriksaan</th>
							<th data-options="field:'alias_aero'" width="50" sortable="true">Keterangan</th>
						</tr>
					</thead>
				</table>
				<div id="dataaero_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama atau Alias Diagnosa',searcher:dataaerocaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#dataaero_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="dataaero_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedataaero')?>">
				<div id="dataaero_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="dataaero_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="dataaerohidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataaero_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataaero_refresh()"><b>Refresh</b></a>
				</div>
				<div id="dataaerohidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="dataaero_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="dataaero_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="dataaero_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function dataaero_refresh(){
			$('#dataaerohidedua').hide();
			$('#dataaerohidesatu').show();
			$('#dataaero_table1').datagrid('reload');
			$('#dataaero_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdataaero')?>',
			});
		}
		$('#dataaerohidedua').hide();
		$('#dataaero_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdataaero')?>',
		});   
		$('#dataaero_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_aero;
				$('#dataaerohidesatu').hide();
				$('#dataaerohidedua').show();
				$('#dataaero_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdataaero')?>/'+id,
				});  
			}  
		}); 
		function dataaero_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data?', function(r) {
				if (r){
					$('#dataaero_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								dataaero_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function dataaerocaridata(value){
			$('#dataaero_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function dataaero_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data?', function(r) {
				if (r){
					var id = $('#id_aero').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdataaero/')?>", {
						id:id,
					}, function(response){	
						dataaero_refresh();
					});
				}  
			}); 	
		}
		$('#dataaero_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_aero == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>