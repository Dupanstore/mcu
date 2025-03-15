<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datains_table1"  url="<?=@base_url($this->u1.'/jsondatains')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_ins" sortOrder="ASC" toolbar="#datains_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_ins'" width="10" sortable="true">Kode</th>
							<th data-options="field:'nm_ins'" width="100" sortable="true">Nama</th>
							<th data-options="field:'order_ins'" width="30" sortable="true">Order</th>
							<th data-options="field:'order_evaluasi'" width="30" sortable="true">Order Evaluasi</th>
						</tr>
					</thead>
				</table>
				<div id="datains_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Poliklinik',searcher:datainscaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datains_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datains_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatains')?>">
				<div id="datains_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datains_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datainshidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datains_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datains_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datainshidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datains_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datains_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datains_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datains_refresh(){
			$('#datainshidedua').hide();
			$('#datainshidesatu').show();
			$('#datains_table1').datagrid('reload');
			$('#datains_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatains')?>',
			});
		}
		$('#datainshidedua').hide();
		$('#datains_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatains')?>',
		});   
		$('#datains_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_ins;
				$('#datainshidesatu').hide();
				$('#datainshidedua').show();
				$('#datains_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatains')?>/'+id,
				});  
			}  
		}); 
		function datains_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data ins', function(r) {
				if (r){
					$('#datains_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datains_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datainscaridata(value){
			$('#datains_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datains_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data ins', function(r) {
				if (r){
					var id = $('#id_ins').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatains/')?>", {
						id:id,
					}, function(response){	
						datains_refresh();
					});
				}  
			}); 	
		}
		$('#datains_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_ins == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>