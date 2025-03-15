<div class="easyui-layout" data-options="fit:true" id="databayar_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="databayar_table1"  url="<?=@base_url($this->u1.'/jsondatabayar')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_bayar" sortOrder="ASC" toolbar="#databayar_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_bayar'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_bayar'" width="30" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="databayar_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama bayar',searcher:databayarcaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#databayar_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="databayar_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatabayar')?>">
				<div id="databayar_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="databayar_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="databayarhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databayar_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databayar_refresh()"><b>Refresh</b></a>
				</div>
				<div id="databayarhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databayar_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="databayar_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databayar_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function databayar_refresh(){
			$('#databayarhidedua').hide();
			$('#databayarhidesatu').show();
			$('#databayar_table1').datagrid('reload');
			$('#databayar_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatabayar')?>',
			});
		}
		$('#databayarhidedua').hide();
		$('#databayar_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatabayar')?>',
		});   
		$('#databayar_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_bayar;
				$('#databayarhidesatu').hide();
				$('#databayarhidedua').show();
				$('#databayar_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatabayar')?>/'+id,
				});  
			}  
		}); 
		function databayar_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data bayar', function(r) {
				if (r){
					$('#databayar_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								databayar_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function databayarcaridata(value){
			$('#databayar_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function databayar_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data bayar', function(r) {
				if (r){
					var id = $('#id_bayar').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatabayar/')?>", {
						id:id,
					}, function(response){	
						databayar_refresh();
					});
				}  
			}); 	
		}
		$('#databayar_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_bayar == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>