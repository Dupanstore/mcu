<div class="easyui-layout" data-options="fit:true" id="onlinedokterpas_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="onlinedokterpas_table1"  url="<?=@base_url($this->u1.'/jsononlinedokterpas')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id_pas" sortOrder="ASC" toolbar="#onlinedokterpas_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nip_nrp_nik'" width="30" sortable="true">NIK/NIP/NRP</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
							<th data-options="field:'no_tlp_pas'" width="30" sortable="true">No.Telp</th>
							<th data-options="field:'pangkat_pas'" width="30" sortable="true">Pangkat</th>
							<th data-options="field:'nm_ins'" width="30" sortable="true">Poliklinik</th>
							<th data-options="field:'name'" width="30" sortable="true">Spesialis</th>
						</tr>
					</thead>
				</table>
				<div id="onlinedokterpas_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
						
							<input class="easyui-searchbox" id="get_type_cari" data-options="prompt:'Masukkan Nama Dokter',searcher:onlinedokterpascaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#onlinedokterpas_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="onlinedokterpas_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdateonlinedokterpas')?>">
				<div id="onlinedokterpas_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="onlinedokterpas_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="onlinedokterpashidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="onlinedokterpas_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="onlinedokterpas_refresh()"><b>Refresh</b></a>
				</div>
				<div id="onlinedokterpashidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="onlinedokterpas_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="onlinedokterpas_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="onlinedokterpas_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function onlinedokterpas_refresh(){
			$('#onlinedokterpashidedua').hide();
			$('#onlinedokterpashidesatu').show();
			$('#onlinedokterpas_table1').datagrid('reload');
			$('#onlinedokterpas_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxonlinedokterpas')?>',
			});
		}
		$('#onlinedokterpashidedua').hide();
		$('#onlinedokterpas_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxonlinedokterpas')?>',
		});   
		$('#onlinedokterpas_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_pas;
				$('#onlinedokterpashidesatu').hide();
				$('#onlinedokterpashidedua').show();
				$('#onlinedokterpas_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxonlinedokterpas')?>/'+id,
				});  
			}  
		}); 
		function onlinedokterpas_simpandata(){
			 //var pesan = $('#ayeresepolman').signature('toDataURL');
			 //alert(pesan);
			 //$('#tandatanganbase').val(pesan);
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data dok', function(r) {
				if (r){
					$('#onlinedokterpas_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								onlinedokterpas_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function onlinedokterpascaridata(){
			var value = $('#get_type_cari').textbox('getValue');
			$('#onlinedokterpas_table1').datagrid('load',{  
				cari: value, 
			}); 
        }
		function onlinedokterpas_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data dok', function(r) {
				if (r){
					var id = $('#id_pas').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusonlinedokterpas/')?>", {
						id:id,
					}, function(response){	
						onlinedokterpas_refresh();
					});
				}  
			}); 	
		}
		$('#onlinedokterpas_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_dok == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>