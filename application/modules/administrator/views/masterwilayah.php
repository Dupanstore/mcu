<div class="easyui-layout" data-options="fit:true" id="datawilayah_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datawilayah_table1"  url="<?=@base_url($this->u1.'/jsondatawilayah')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_wilayah" sortOrder="ASC" toolbar="#datawilayah_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_wilayah'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_wilayah'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datawilayah_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama wilayah',searcher:datawilayahcaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datawilayah_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datawilayah_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatawilayah')?>">
				<div id="datawilayah_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datawilayah_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datawilayahhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datawilayah_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datawilayah_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datawilayahhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datawilayah_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datawilayah_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datawilayah_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datawilayah_refresh(){
			$('#datawilayahhidedua').hide();
			$('#datawilayahhidesatu').show();
			$('#datawilayah_table1').datagrid('reload');
			$('#datawilayah_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatawilayah')?>',
			});
		}
		$('#datawilayahhidedua').hide();
		$('#datawilayah_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatawilayah')?>',
		});   
		$('#datawilayah_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_wilayah;
				$('#datawilayahhidesatu').hide();
				$('#datawilayahhidedua').show();
				$('#datawilayah_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatawilayah')?>/'+id,
				});  
			}  
		}); 
		function datawilayah_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data wilayah', function(r) {
				if (r){
					$('#datawilayah_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datawilayah_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datawilayahcaridata(value){
			$('#datawilayah_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datawilayah_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data wilayah', function(r) {
				if (r){
					var id = $('#id_wilayah').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatawilayah/')?>", {
						id:id,
					}, function(response){	
						datawilayah_refresh();
					});
				}  
			}); 	
		}
		$('#datawilayah_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_wilayah == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>