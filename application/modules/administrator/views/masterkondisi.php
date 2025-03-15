<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datakondisi_table1"  url="<?=@base_url($this->u1.'/jsondatakondisi')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_kondisi" sortOrder="ASC" toolbar="#datakondisi_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_kondisi'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_kondisi'" width="100" sortable="true">Nama</th>
							<th data-options="field:'nm_kondisi_en'" width="100" sortable="true">Nama EN</th>
							<th data-options="field:'status_grounded'" width="20" sortable="true">Set Grounded</th>
						</tr>
					</thead>
				</table>
				<div id="datakondisi_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Kondisi',searcher:datakondisicaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakondisi_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datakondisi_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatakondisi')?>">
				<div id="datakondisi_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datakondisi_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datakondisihidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakondisi_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakondisi_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datakondisihidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakondisi_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datakondisi_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakondisi_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datakondisi_refresh(){
			$('#datakondisihidedua').hide();
			$('#datakondisihidesatu').show();
			$('#datakondisi_table1').datagrid('reload');
			$('#datakondisi_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatakondisi')?>',
			});
		}
		$('#datakondisihidedua').hide();
		$('#datakondisi_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatakondisi')?>',
		});   
		$('#datakondisi_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_kondisi;
				$('#datakondisihidesatu').hide();
				$('#datakondisihidedua').show();
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatakondisi')?>/'+id,
				});  
			}  
		}); 
		function datakondisi_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data kondisi', function(r) {
				if (r){
					$('#datakondisi_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datakondisi_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datakondisicaridata(value){
			$('#datakondisi_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datakondisi_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data kondisi', function(r) {
				if (r){
					var id = $('#id_kondisi').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatakondisi/')?>", {
						id:id,
					}, function(response){	
						datakondisi_refresh();
					});
				}  
			}); 	
		}
		$('#datakondisi_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_kondisi == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>