<div class="easyui-layout" data-options="fit:true" id="datakatspesialis_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datakatspesialis_table1"  url="<?=@base_url($this->u1.'/jsondatakatspesialis')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id" sortOrder="ASC" toolbar="#datakatspesialis_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'name'" width="100" sortable="true">Spesialis</th>
						</tr>
					</thead>
				</table>
				<div id="datakatspesialis_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Spesialis',searcher:datakatspesialiscaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakatspesialis_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datakatspesialis_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatakatspesialis')?>">
				<div id="datakatspesialis_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datakatspesialis_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datakatspesialishidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakatspesialis_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakatspesialis_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datakatspesialishidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakatspesialis_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datakatspesialis_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakatspesialis_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datakatspesialis_refresh(){
			$('#datakatspesialishidedua').hide();
			$('#datakatspesialishidesatu').show();
			$('#datakatspesialis_table1').datagrid('reload');
			$('#datakatspesialis_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatakatspesialis')?>',
			});
		}
		$('#datakatspesialishidedua').hide();
		$('#datakatspesialis_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatakatspesialis')?>',
		});   
		$('#datakatspesialis_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id;
				$('#datakatspesialishidesatu').hide();
				$('#datakatspesialishidedua').show();
				$('#datakatspesialis_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatakatspesialis')?>/'+id,
				});  
			}  
		}); 
		function datakatspesialis_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data?', function(r) {
				if (r){
					$('#datakatspesialis_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datakatspesialis_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		
		function rubahstatusyaok(idhs){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/rubahstatusyaok/')?>", {
						idhs:idhs,
					}, function(response){	
						datakatspesialis_refresh();
					});
			
		}
        function datakatspesialiscaridata(value){
			$('#datakatspesialis_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datakatspesialis_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data?', function(r) {
				if (r){
					var id = $('#id_kat').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatakatspesialis/')?>", {
						id:id,
					}, function(response){	
						datakatspesialis_refresh();
					});
				}  
			}); 	
		}
		$('#datakatspesialis_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_wilayah == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>