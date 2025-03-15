<div class="easyui-layout" data-options="fit:true" id="datapaketkonsul_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datapaketkonsul_table1"  url="<?=@base_url($this->u1.'/jsondatapaketkonsul')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true, nowrap:false" sortName="idc" sortOrder="ASC" toolbar="#datapaketkonsul_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nama_pkt'" width="50" sortable="true">Paket</th>
							<th data-options="field:'isi_pkt'" width="100" sortable="true">Detail</th>
						</tr>
					</thead>
				</table>
				<div id="datapaketkonsul_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama / Detail Data',searcher:datapaketkonsulcaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapaketkonsul_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datapaketkonsul_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatapaketkonsul')?>">
				<div id="datapaketkonsul_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datapaketkonsul_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datapaketkonsulhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapaketkonsul_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapaketkonsul_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datapaketkonsulhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datapaketkonsul_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datapaketkonsul_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datapaketkonsul_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datapaketkonsul_refresh(){
			$('#datapaketkonsulhidedua').hide();
			$('#datapaketkonsulhidesatu').show();
			$('#datapaketkonsul_table1').datagrid('reload');
			$('#datapaketkonsul_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatapaketkonsul')?>',
			});
		}
		$('#datapaketkonsulhidedua').hide();
		$('#datapaketkonsul_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatapaketkonsul')?>',
		});   
		$('#datapaketkonsul_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.idc;
				$('#datapaketkonsulhidesatu').hide();
				$('#datapaketkonsulhidedua').show();
				$('#datapaketkonsul_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatapaketkonsul')?>/'+id,
				});  
			}  
		}); 
		function datapaketkonsul_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data', function(r) {
				if (r){
					$('#datapaketkonsul_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datapaketkonsul_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datapaketkonsulcaridata(value){
			$('#datapaketkonsul_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datapaketkonsul_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data', function(r) {
				if (r){
					var id = $('#idc').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatapaketkonsul/')?>", {
						id:id,
					}, function(response){	
						datapaketkonsul_refresh();
					});
				}  
			}); 	
		}
		$('#datapaketkonsul_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_paketkonsul == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>