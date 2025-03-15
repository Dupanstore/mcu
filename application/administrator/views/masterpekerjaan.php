<div class="easyui-layout" data-options="fit:true" id="datapekerjaan_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datapekerjaan_table1"  url="<?=@base_url($this->u1.'/jsondatapekerjaan')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_pekerjaan" sortOrder="ASC" toolbar="#datapekerjaan_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_pekerjaan'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_pekerjaan'" width="30" sortable="true">Nama</th>
							<th data-options="field:'list_pangkat'" width="70" sortable="true">List Pangkat</th>
						</tr>
					</thead>
				</table>
				<div id="datapekerjaan_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Pekerjaan',searcher:datapekerjaancaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapekerjaan_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datapekerjaan_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatapekerjaan')?>">
				<div id="datapekerjaan_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datapekerjaan_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datapekerjaanhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapekerjaan_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapekerjaan_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datapekerjaanhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapekerjaan_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datapekerjaan_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapekerjaan_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datapekerjaan_refresh(){
			$('#datapekerjaanhidedua').hide();
			$('#datapekerjaanhidesatu').show();
			$('#datapekerjaan_table1').datagrid('reload');
			$('#datapekerjaan_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatapekerjaan')?>',
			});
		}
		$('#datapekerjaanhidedua').hide();
		$('#datapekerjaan_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatapekerjaan')?>',
		});   
		$('#datapekerjaan_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_pekerjaan;
				$('#datapekerjaanhidesatu').hide();
				$('#datapekerjaanhidedua').show();
				$('#datapekerjaan_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatapekerjaan')?>/'+id,
				});  
			}  
		}); 
		function datapekerjaan_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data pekerjaan', function(r) {
				if (r){
					$('#datapekerjaan_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datapekerjaan_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datapekerjaancaridata(value){
			$('#datapekerjaan_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datapekerjaan_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data pekerjaan', function(r) {
				if (r){
					var id = $('#id_pekerjaan').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatapekerjaan/')?>", {
						id:id,
					}, function(response){	
						datapekerjaan_refresh();
					});
				}  
			}); 	
		}
		$('#datapekerjaan_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_pekerjaan == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>