<div class="easyui-layout" data-options="fit:true" id="layoutsatuchamber">
        <div data-options="region:'west',split:true,footer:'#toolbar_paketmcu1'" title="" style="width:250px;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatuchamber" url="<?=@base_url($this->u1.'/jsondapatdetailchamber/'. $this->uri->segment(3).'/?kode_transaksi='.$_GET['kode_transaksi'])?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="det_order_pemeriksaan" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'det_nm_pemeriksaan'" width="100" sortable="true">Pemeriksaan</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
					<div id="panelsatuchamber" class="easyui-panel" title="">	
					</div>
	</div>
</div>
<script type="text/javascript">
	$('#tabelsatuchamber').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_pem;
				$('#panelsatuchamber').panel({
					href:'<?=@base_url($this->u1.'/ajaxdetailpemeriksaanchamber/'. $this->uri->segment(3).'/?kode_transaksi='. $_GET['kode_transaksi'] .'&id_paket='. $_GET['id_paket'] .'&noreg='. $_GET['noreg'].'&idins='. $_GET['idins'])?>&id_parent='+id,
				});  
			}  
	});
	function simpandetailpemeriksaanchamber(){
		$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan pemeriksaan', function(r) {
				if (r){
					$('#inputpemeriksaanformdatachamber').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								var gggg = $('#tabelsatuchamber').datagrid('getSelected');  
								var id = gggg.id_pem;
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panelsatuchamber').panel({
									href:'<?=@base_url($this->u1.'/ajaxdetailpemeriksaanchamber/'. $this->uri->segment(3).'/?kode_transaksi='. $_GET['kode_transaksi'] .'&id_paket='. $_GET['id_paket'] .'&noreg='. $_GET['noreg'].'&idins='. $_GET['idins'])?>&id_parent='+id,
								}); 
								
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
	}
</script>