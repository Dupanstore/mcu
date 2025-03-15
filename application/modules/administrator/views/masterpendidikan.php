<div class="easyui-layout" data-options="fit:true" id="datapendidikan_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datapendidikan_table1"  url="<?=@base_url($this->u1.'/jsondatapendidikan')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_pendidikan" sortOrder="ASC" toolbar="#datapendidikan_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_pendidikan'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_pendidikan'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datapendidikan_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama pendidikan',searcher:datapendidikancaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapendidikan_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datapendidikan_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatapendidikan')?>">
				<div id="datapendidikan_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datapendidikan_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datapendidikanhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapendidikan_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapendidikan_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datapendidikanhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapendidikan_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datapendidikan_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapendidikan_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datapendidikan_refresh(){
			$('#datapendidikanhidedua').hide();
			$('#datapendidikanhidesatu').show();
			$('#datapendidikan_table1').datagrid('reload');
			$('#datapendidikan_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatapendidikan')?>',
			});
		}
		$('#datapendidikanhidedua').hide();
		$('#datapendidikan_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatapendidikan')?>',
		});   
		$('#datapendidikan_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_pendidikan;
				$('#datapendidikanhidesatu').hide();
				$('#datapendidikanhidedua').show();
				$('#datapendidikan_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatapendidikan')?>/'+id,
				});  
			}  
		}); 
		function datapendidikan_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data pendidikan', function(r) {
				if (r){
					$('#datapendidikan_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datapendidikan_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datapendidikancaridata(value){
			$('#datapendidikan_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datapendidikan_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data pendidikan', function(r) {
				if (r){
					var id = $('#id_pendidikan').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatapendidikan/')?>", {
						id:id,
					}, function(response){	
						datapendidikan_refresh();
					});
				}  
			}); 	
		}
		$('#datapendidikan_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_pendidikan == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>