<table class="easyui-datagrid" id="tablemodalriwayatpas"
				   data-options="singleSelect:true,fit:false,pagination:true,rownumbers:true,fitColumns:true" sortName="no_reg" sortOrder="ASC" toolbar="#tablemodalriwayatpas_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NRP/NIK</th>
							<th data-options="field:'last_mcu'" width="20" sortable="true">TGL MCU</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">NAMA</th>
							<th data-options="field:'no_tlp_pas'" width="20" sortable="true">TELP</th>
							<th data-options="field:'alamat_pas'" width="30" sortable="true">ALAMAT</th>
						</tr>
					</thead>
				</table>
				<div id="tablemodalriwayatpas_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkanfilterriwayat()"><b>Tampilkan Riwayat</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama, NIK, NRP Alamat dll ',searcher:tablemodalriwayatpascaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
				
				
<div id="filterdatariwayat" modal="true"  closed="true" fit="true" maximizable="true" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:100%;height:400px;padding:5px;background:#ffffff;">
</div>
				
<script>
	$('#tablemodalriwayatpas').datagrid({
				url:'<?=@base_url($this->u1.'/jsoncaririwayatpasienok')?>/',
			});	
	function tablemodalriwayatpascaridata(value){
			$('#tablemodalriwayatpas').datagrid('load',{  
				cari: value,
			});
		}
			
	function tampilkanfilterriwayat(){
			var row = $('#tablemodalriwayatpas').datagrid('getSelected');  
			if (row){  
				var id = row.id_pas;
				var nama = row.nm_pas;
				var nipnrp = row.nip_nrp_nik;
				$('#filterdatariwayat').window('open');
				$('#filterdatariwayat').panel({
					title: 'RIWAYAT PASIEN - '+nama+' - NIP/NRP/NIK - '+nipnrp,
					href:'<?=@base_url($this->u1.'/tampilkanfilterriwayat')?>/'+id,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
</script>