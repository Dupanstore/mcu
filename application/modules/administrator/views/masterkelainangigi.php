<div class="easyui-layout" data-options="fit:true" id="datakelainangigi_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datakelainangigi_table1"  url="<?=@base_url($this->u1.'/jsondatakelainangigi')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kelainan" sortOrder="ASC" toolbar="#datakelainangigi_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kode_kelainan'" width="10" sortable="true">Kode</th>
							<th data-options="field:'kelainan'" width="100" sortable="true">Kelainan</th>
							<th data-options="field:'setpemeriksaan'" width="20" sortable="true">Set Pemeriksaan</th>
						</tr>
					</thead>
				</table>
				<div id="datakelainangigi_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Kelainan',searcher:datakelainangigicaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakelainangigi_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datakelainangigi_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatakelainangigi')?>">
				<div id="datakelainangigi_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datakelainangigi_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datakelainangigihidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakelainangigi_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakelainangigi_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datakelainangigihidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakelainangigi_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datakelainangigi_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakelainangigi_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datakelainangigi_refresh(){
			$('#datakelainangigihidedua').hide();
			$('#datakelainangigihidesatu').show();
			$('#datakelainangigi_table1').datagrid('reload');
			$('#datakelainangigi_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatakelainangigi')?>',
			});
		}
		$('#datakelainangigihidedua').hide();
		$('#datakelainangigi_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatakelainangigi')?>',
		});   
		$('#datakelainangigi_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_kln;
				$('#datakelainangigihidesatu').hide();
				$('#datakelainangigihidedua').show();
				$('#datakelainangigi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatakelainangigi')?>/'+id,
				});  
			}  
		}); 
		function datakelainangigi_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data kelainangigi', function(r) {
				if (r){
					$('#datakelainangigi_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datakelainangigi_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datakelainangigicaridata(value){
			$('#datakelainangigi_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function datakelainangigi_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data kelainangigi', function(r) {
				if (r){
					var id = $('#id_kln').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatakelainangigi/')?>", {
						id:id,
					}, function(response){	
						datakelainangigi_refresh();
					});
				}  
			}); 	
		}
		$('#datakelainangigi_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_kelainangigi == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		}); 

		function rubahuntuksetkelainan(id, isi){
			//alert(id+" - "+isi);
			$.post("<?=@base_url($this->u1.'/'. $this->u1 .'_action/rubahuntuksetkelainan')?>", {
				id:id, isi:isi,
			}, function(response){
					$('#framependaftaran').html(response);		
			});
		}
	</script>