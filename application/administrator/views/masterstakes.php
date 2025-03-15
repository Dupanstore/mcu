<div class="easyui-layout" data-options="fit:true" id="datastakes_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datastakes_table1"  url="<?=@base_url($this->u1.'/jsondatastakes')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_stakes" sortOrder="ASC" toolbar="#datastakes_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_stakes'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datastakes_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama stakes',searcher:datastakescaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datastakes_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datastakes_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatastakes')?>">
				<div id="datastakes_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datastakes_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datastakeshidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datastakes_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datastakes_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datastakeshidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datastakes_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datastakes_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datastakes_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datastakes_refresh(){
			$('#datastakeshidedua').hide();
			$('#datastakeshidesatu').show();
			$('#datastakes_table1').datagrid('reload');
			$('#datastakes_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatastakes')?>',
			});
		}
		$('#datastakeshidedua').hide();
		$('#datastakes_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatastakes')?>',
		});   
		$('#datastakes_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_stakes;
				$('#datastakeshidesatu').hide();
				$('#datastakeshidedua').show();
				$('#datastakes_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatastakes')?>/'+id,
				});  
			}  
		}); 
		function datastakes_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data stakes', function(r) {
				if (r){
					$('#datastakes_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datastakes_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datastakescaridata(value){
			$('#datastakes_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datastakes_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data stakes', function(r) {
				if (r){
					var id = $('#id_stakes').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatastakes/')?>", {
						id:id,
					}, function(response){	
						datastakes_refresh();
					});
				}  
			}); 	
		}
		$('#datastakes_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_stakes == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>