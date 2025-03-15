<div class="easyui-layout" data-options="fit:true" id="datakatberita_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datakatberita_table1"  url="<?=@base_url($this->u1.'/jsondatakatberita')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id" sortOrder="ASC" toolbar="#datakatberita_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'name'" width="100" sortable="true">Nama</th>
							<th data-options="field:'set_home'" width="10" sortable="true">Set Home</th>
						</tr>
					</thead>
				</table>
				<div id="datakatberita_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Kategori',searcher:datakatberitacaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakatberita_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datakatberita_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatakatberita')?>">
				<div id="datakatberita_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datakatberita_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datakatberitahidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakatberita_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakatberita_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datakatberitahidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakatberita_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datakatberita_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakatberita_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datakatberita_refresh(){
			$('#datakatberitahidedua').hide();
			$('#datakatberitahidesatu').show();
			$('#datakatberita_table1').datagrid('reload');
			$('#datakatberita_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatakatberita')?>',
			});
		}
		$('#datakatberitahidedua').hide();
		$('#datakatberita_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatakatberita')?>',
		});   
		$('#datakatberita_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id;
				$('#datakatberitahidesatu').hide();
				$('#datakatberitahidedua').show();
				$('#datakatberita_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatakatberita')?>/'+id,
				});  
			}  
		}); 
		function datakatberita_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data kategori layanan', function(r) {
				if (r){
					$('#datakatberita_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datakatberita_refresh();
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
						datakatberita_refresh();
					});
			
		}
        function datakatberitacaridata(value){
			$('#datakatberita_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datakatberita_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data kategori layanan', function(r) {
				if (r){
					var id = $('#id_kat').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatakatberita/')?>", {
						id:id,
					}, function(response){	
						datakatberita_refresh();
					});
				}  
			}); 	
		}
		$('#datakatberita_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_wilayah == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>