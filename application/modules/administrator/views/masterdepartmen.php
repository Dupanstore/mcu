<div class="easyui-layout" data-options="fit:true" id="newdepartmen_layout1">
        <div data-options="region:'west',split:true" title="Jawatan" style="width:350px;background:#eeffff;">
			<table class="easyui-datagrid" id="datapolidepartemntabel"  url="<?=@base_url($this->u1.'/jsongrouptambahjawatan')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_jawatan" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'nm_jawatan'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="tabel_groupdepartemn"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_dept" sortOrder="ASC" toolbar="#newdepartmen_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_dept'" width="40" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="newdepartmen_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama bagian',searcher:newdepartmencaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#newdepartmen_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<input type="hidden" id="xxinstid" value="">
			<form method="POST" id="newdepartmen_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatagroupdepartemn')?>">
				<div id="newdepartmen_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="newdepartmen_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="newdepartmenhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="newdepartmen_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="newdepartmen_refresh()"><b>Refresh</b></a>
				</div>
				<div id="newdepartmenhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="newdepartmen_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="newdepartmen_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="newdepartmen_batal()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		$('#datapolidepartemntabel').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_jawatan;
				$('#xxinstid').val(id);
				$('#newdepartmenhidesatu').show();
				$('#newdepartmenhidedua').hide();
				    $('#tabel_groupdepartemn').datagrid({
						url:'<?=@base_url($this->u1.'/jsondatanewdepartmen')?>/'+id,
					});
				$('#newdepartmen_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatanewdepartmen')?>/'+id,
				});  
				
			}  
		}); 
		function newdepartmen_refresh(){
			$('#newdepartmenhidedua').hide();
			$('#newdepartmenhidesatu').show();
			$('#newdepartmen_table1').datagrid('reload');
			$('#newdepartmen_panel1').panel('refresh');
		}
		function newdepartmen_batal(){
			var xxinstid = $('#xxinstid').val();
			$('#newdepartmenhidedua').hide();
			$('#newdepartmenhidesatu').show();
			$('#newdepartmen_table1').datagrid('reload');
			$('#tabel_groupdepartemn').datagrid({
						url:'<?=@base_url($this->u1.'/jsondatanewdepartmen')?>/'+xxinstid,
					});
				$('#newdepartmen_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatanewdepartmen')?>/'+xxinstid,
				});   
		}
		$('#newdepartmenhidedua').hide();  
		$('#tabel_groupdepartemn').datagrid({  
			onSelect:function(index,row){  
				var id_jawatan = row.id_jawatan;
				var idgroup = row.id_dept;
				$('#newdepartmenhidesatu').hide();
				$('#newdepartmenhidedua').show();
				$('#newdepartmen_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatanewdepartmen')?>/'+id_jawatan+'/'+idgroup,
				});  
			}  
		}); 
		function newdepartmen_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data Departmen', function(r) {
				if (r){
					$('#newdepartmen_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								newdepartmen_batal();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function newdepartmencaridata(value){
			$('#tabel_groupdepartemn').datagrid('load',{  
				cari: value,
			}); 
        }
		function newdepartmen_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data Departmen', function(r) {
				if (r){
					var id = $('#id_dept').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatadept/')?>", {
						id:id,
					}, function(response){	
						newdepartmen_batal();
					});
				}  
			}); 	
		}  
	</script>