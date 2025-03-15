<div class="easyui-layout" data-options="fit:true" id="datastatus_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datastatus_table1"  url="<?=@base_url($this->u1.'/jsondatastatus')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_status" sortOrder="ASC" toolbar="#datastatus_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_status'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_status'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datastatus_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama status',searcher:datastatuscaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datastatus_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datastatus_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatastatus')?>">
				<div id="datastatus_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datastatus_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datastatushidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datastatus_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datastatus_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datastatushidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datastatus_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datastatus_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datastatus_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datastatus_refresh(){
			$('#datastatushidedua').hide();
			$('#datastatushidesatu').show();
			$('#datastatus_table1').datagrid('reload');
			$('#datastatus_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatastatus')?>',
			});
		}
		$('#datastatushidedua').hide();
		$('#datastatus_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatastatus')?>',
		});   
		$('#datastatus_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_status;
				$('#datastatushidesatu').hide();
				$('#datastatushidedua').show();
				$('#datastatus_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatastatus')?>/'+id,
				});  
			}  
		}); 
		function datastatus_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data status', function(r) {
				if (r){
					$('#datastatus_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datastatus_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datastatuscaridata(value){
			$('#datastatus_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datastatus_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data status', function(r) {
				if (r){
					var id = $('#id_status').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatastatus/')?>", {
						id:id,
					}, function(response){	
						datastatus_refresh();
					});
				}  
			}); 	
		}
		$('#datastatus_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_status == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>