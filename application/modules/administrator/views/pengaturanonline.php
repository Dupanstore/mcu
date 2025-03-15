<div class="easyui-layout" data-options="fit:true" id="pengumumonline_layout1">
        
		<div data-options="region:'east',split:true,footer:'#pengumumonline_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:100%;background:#eeffff;">
			<form method="POST" id="pengumumonline_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatepengumumonline')?>">
				<div id="pengumumonline_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="pengumumonline_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="pengumumonline_simpandata()"><b>Simpan Data</b></a>
				<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="pengumumonline_refresh()"><b>Refresh</b></a>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function pengumumonline_refresh(){
			$('#pengumumonline_table1').datagrid('reload');
			$('#pengumumonline_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxpengumumonline')?>',
			});
		}
		$('#pengumumonline_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxpengumumonline')?>',
		});  
		function pengumumonline_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data', function(r) {
				if (r){
					$('#pengumumonline_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								pengumumonline_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function pengumumonlinecaridata(value){
			$('#pengumumonline_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function pengumumonline_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data', function(r) {
				if (r){
					var id = $('#id_bayar').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapuspengumumonline/')?>", {
						id:id,
					}, function(response){	
						pengumumonline_refresh();
					});
				}  
			}); 	
		}
		$('#pengumumonline_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_bayar == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>