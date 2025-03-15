<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'west',split:true,footer:'#toolbar_paketmcu1'" title="" style="width:450px;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatupaketmcu"  url="<?=@base_url($this->u1.'/jsonloadpaketmcu')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="kd_paket" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'kd_paket'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_paket'" width="60" sortable="true">Nama</th>
							<th data-options="field:'casis_tniok'" width="15" sortable="true">Casis</th>
							<th data-options="field:'en_hasil'" width="10" sortable="true">EN</th>
							<th data-options="field:'harga_paket_baru',align:'right'" width="30" sortable="true">Harga</th>
						</tr>
					</thead>
				</table>
		</div>
		<div id="toolbar_paketmcu1" style="padding:5px;background:#CEDFF3">
					<div style="text-align:left;">
						<input type="hidden" id="xxinstid" value="">
						<a href="javascript:void(0)" data-options="iconCls:'icon-add'" class="easyui-linkbutton" onclick="paketmcu_tambahpaket()"><b>Tambah Paket</b></a>
						<a href="javascript:void(0)" data-options="iconCls:'icon-edit'" class="easyui-linkbutton" onclick="paketmcu_editpaket()"><b>Edit Paket</b></a>
						<a href="javascript:void(0)" data-options="iconCls:'icon-remove'" class="easyui-linkbutton" onclick="paketmcu_hapuspaket()"><b>Hapus Paket</b></a>
					</div>
				</div>	
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
            <table class="easyui-datagrid" id="tabeldetailpaketmcu" data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="nm_tind" sortOrder="ASC" toolbar="#datapaket_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_grouptindakan'" width="30" sortable="true">Group</th>
							<th data-options="field:'kd_tind'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_tind'" width="60" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="datapaket_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" data-options="iconCls:'icon-search'" class="easyui-linkbutton" onclick="paketmcu_lihatpaketlain()"><b>Lihat Paket Lain</b></a>
							<a href="javascript:void(0)" data-options="iconCls:'icon-add'" class="easyui-linkbutton" onclick="paketmcu_tambahpemeriksaan()"><b>Tambah Rincian</b></a>
							<a href="javascript:void(0)" data-options="iconCls:'icon-remove'" class="easyui-linkbutton" onclick="paketmcu_hapuspemeriksaan()"><b>Hapus Rincian</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Group, kode atau nama',searcher:detailtaficaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
        </div>
    </div>
	<div id="modalpaketmcutiga" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modalpaketmcutiga_toolbar" collapsible="false" class="easyui-window" title="" style="width:800px;height:500px;padding:5px;background:#ffffff;">
    </div>
	<div id="modalpaketmcutiga_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanupdatesamainpaketmcuya()"><b>Simpan Perubahan</b></a>
			</div>
	</div>
	<div id="modalpaketmcusatu" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modalpaketmcusatu_toolbar" collapsible="false" class="easyui-window" title="" style="width:400px;height:150px;padding:5px;background:#ffffff;">
    </div>
	<div id="modalpaketmcusatu_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanupdatepaketmcuya()"><b>Simpan Perubahan</b></a>
			</div>
	</div>
	<div id="modalpaketmcudua" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modalpaketmcudua_toolbar" collapsible="false" class="easyui-window" title="" style="width:600px;height:500px;padding:5px;background:#ffffff;">
    </div>
	<div id="modalpaketmcudua_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="tambahkandetailpaketmcuyakakak()"><b>Tambahkan</b></a>
			</div>
	</div>
	<script type="text/javascript">
		$('#tabelsatupaketmcu').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_paket;
				var nama = row.nm_paket;
				$('#xxinstid').val(id); 
				$('#tabeldetailpaketmcu').datagrid({
					iconCls: 'icon-ok',
					title:'<b>'+nama+'</b>',
					url:'<?=@base_url($this->u1.'/jsondetailtarifmcuya')?>/'+id,
				});					
			}  
		});
		function detailtaficaridata(value){
			$('#tabeldetailpaketmcu').datagrid('load',{  
				cari: value,
			}); 
        }		
		function paketmcu_tambahpaket(){
			$('#modalpaketmcusatu').window('open');
				$('#modalpaketmcusatu').panel({
					title: 'Tambah Paket MCU',
					href:'<?=@base_url($this->u1.'/ajaxtambahpaketmcu')?>',
				});
		}
		function paketmcu_editpaket(){
			var row = $('#tabelsatupaketmcu').datagrid('getSelected');  
            if (row){  
				$('#modalpaketmcusatu').window('open');
				$('#modalpaketmcusatu').panel({
					title: 'Edit Paket MCU',
					href:'<?=@base_url($this->u1.'/ajaxtambahpaketmcu')?>/'+row.id_paket,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
					
		}
		function paketmcu_hapuspaket(){
			var row = $('#tabelsatupaketmcu').datagrid('getSelected');  
            if (row){  
				$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus paket', function(r) {
				if (r){
						var id = row.id_paket;
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapuspaketmcu/')?>", {
							id:id,
						}, function(response){	
							$('#xxinstid').val(''); 
							$('#tabeldetailpaketmcu').datagrid({
								url:'<?=@base_url($this->u1.'/jsondetailtarifmcuya')?>',
							});	
							$('#tabelsatupaketmcu').datagrid('reload');
						});
					}  
				}); 	
			}else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
					
		}
		function simpanupdatepaketmcuya(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data', function(r) {
				if (r){
					$('#formtambahpaketmcusatu').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#xxinstid').val(''); 
								$('#tabeldetailpaketmcu').datagrid({
									url:'<?=@base_url($this->u1.'/jsondetailtarifmcuya')?>',
								});
								$('#modalpaketmcusatu').window('close');
								$('#tabelsatupaketmcu').datagrid('reload');
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function paketmcu_tambahpemeriksaan(){
			var dd = $('#xxinstid').val();
			if(dd != ""){
				//$.messager.alert('Informasi', dd, 'info');
				$('#modalpaketmcudua').window('open');
				$('#modalpaketmcudua').panel({
					title: 'Tambah Rincian Paket',
					href:'<?=@base_url($this->u1.'/ajaxrincianpemeriksaan')?>/'+dd,
				});
			} else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
		}
		function paketmcu_hapuspemeriksaan(){
			var dd = $('#xxinstid').val(); 
			if(dd != ""){
				var row = $('#tabeldetailpaketmcu').datagrid('getSelected');  
				if (row){  
					$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus pemeriksaan', function(r) {
					if (r){
							var id = row.id_paket_meta;
							$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusrincianpaketmcu/')?>", {
								id:id,
							}, function(response){	
								$('#tabeldetailpaketmcu').datagrid('reload');
							});
						}  
					}); 	
				}else {
					$.messager.alert('Informasi', 'Pilih rincian terlebih dahulu', 'info');
				}
			} else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
		}
		function tambahkandetailpaketmcuyakakak(){
			var row = $('#tabel_grouppemeriksaan').datagrid('getSelected');  
            if (row){
				$.messager.confirm('Konfirmasi', 'Anda yakin akan menambahkan rincian', function(r) {
				if (r){
						var idtind  = row.id_tind;
						var idpaket = $('#xxinstid').val();
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanrincianpaketdetailmcu/')?>", {
							idtind:idtind, idpaket:idpaket,
						}, function(response){	
							if(response == "simpan"){
								//$('#modalpaketmcudua').window('close');
								$('#tabeldetailpaketmcu').datagrid('reload');
								$.messager.alert('Informasi', 'Data Berhasil ditambahkan', 'info');
							} else {
								$.messager.alert('Informasi', response, 'info');
							}
						});
					}  
				}); 	
			}else {
				$.messager.alert('Informasi', 'Pilih rincian terlebih dahulu', 'info');
			}
		}
		//ABY
		function paketmcu_lihatpaketlain(){
			var dd = $('#xxinstid').val(); 
			if(dd != ""){
				//$.messager.alert('Informasi', dd, 'info');
				$('#modalpaketmcutiga').window('open');
				$('#modalpaketmcutiga').panel({
					title: 'Samakan Rincian Paket',
					href:'<?=@base_url($this->u1.'/ajaxrincianpemeriksaansamain')?>/'+dd,
				});
			} else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}	
		}
		function simpanupdatesamainpaketmcuya(){
			var row = $('#tabel_grouppemeriksaansamain').datagrid('getSelected'); 			
            if (row){
				//alert(row.id_paket);
				$.messager.confirm('Konfirmasi', 'Anda yakin akan menyamakan rincian ini ?', function(r) {
				if (r){
						var idpaket = $('#xxinstid').val();
						var idpaketsamakan = row.id_paket;
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanrincianpaketdetailmcusamakan/')?>", {
							idpaket:idpaket,idpaketsama:idpaketsamakan,
						}, function(response){	
							if(response == "simpan"){
								//$('#modalpaketmcudua').window('close');
								$('#tabeldetailpaketmcu').datagrid('reload');
								$.messager.alert('Informasi', 'Data Paket Berhasil disamakan', 'info');
							} else {
								$.messager.alert('Informasi', response, 'info');
							}
						});
					}  
				}); 	
			}
			else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
		}
		
		function rubahstatusbahasa(idp){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/rubahstatusbahasa/')?>", {
				idp:idp,
			}, function(response){	
				
			});
		}
		
		function rubahstatuscasistni(idp){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/rubahstatuscasistni/')?>", {
				idp:idp,
			}, function(response){	
				
			});
		}
	</script>