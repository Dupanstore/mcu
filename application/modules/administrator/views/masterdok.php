<div class="easyui-layout" data-options="fit:true" id="datadok_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datadok_table1"  url="<?=@base_url($this->u1.'/jsondatadok')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_dok" sortOrder="ASC" toolbar="#datadok_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_dok'" width="30" sortable="true">Kode</th>
							<th data-options="field:'nm_dok'" width="30" sortable="true">Nama</th>
							<th data-options="field:'nip_nrp'" width="30" sortable="true">NIK/NIP/NRP</th>
							<th data-options="field:'pangkat'" width="30" sortable="true">Pangkat</th>
							<th data-options="field:'golongan'" width="30" sortable="true">Jabatan</th>
						</tr>
					</thead>
				</table>
				<div id="datadok_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
						
							<input class="easyui-searchbox" id="get_type_cari" data-options="prompt:'Masukkan Nama Dokter',searcher:datadokcaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datadok_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datadok_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatadok')?>">
				<link rel="stylesheet" href="<?=@base_url('assets/resep')?>/js-lib/jquery.signature.css" />
				<link rel="stylesheet" href="<?=@base_url('assets/resep')?>/js-lib/jquery-ui.css" />
				<link rel="stylesheet" href="<?=@base_url('assets/resep')?>/js-lib/jquery.signature.css" />
				<script src="<?=@base_url('assets/resep')?>/js-lib/jquery.signature.js" type="text/javascript" >jQuery.noConflict();</script>
				<script src="<?=@base_url('assets/resep')?>/js-lib/jquery.ui.touch-punch.min.js" type="text/javascript" >jQuery.noConflict();</script>
				<div id="datadok_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datadok_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datadokhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datadok_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datadok_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datadokhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datadok_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datadok_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datadok_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function datadok_refresh(){
			$('#datadokhidedua').hide();
			$('#datadokhidesatu').show();
			$('#datadok_table1').datagrid('reload');
			$('#datadok_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatadok')?>',
			});
		}
		$('#datadokhidedua').hide();
		$('#datadok_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatadok')?>',
		});   
		$('#datadok_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_dok;
				$('#datadokhidesatu').hide();
				$('#datadokhidedua').show();
				$('#datadok_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatadok')?>/'+id,
				});  
			}  
		}); 
		function datadok_simpandata(){
			 var pesan = $('#ayeresepolman').signature('toDataURL');
			 //alert(pesan);
			 $('#tandatanganbase').val(pesan);
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data dok', function(r) {
				if (r){
					$('#datadok_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datadok_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datadokcaridata(){
			var value = $('#get_type_cari').textbox('getValue');
			$('#datadok_table1').datagrid('load',{  
				cari: value, 
			}); 
        }
		function datadok_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data dok', function(r) {
				if (r){
					var id = $('#id_dok').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatadok/')?>", {
						id:id,
					}, function(response){	
						datadok_refresh();
					});
				}  
			}); 	
		}
		$('#datadok_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_dok == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>