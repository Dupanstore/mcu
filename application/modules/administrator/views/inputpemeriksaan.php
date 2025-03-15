<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'west',split:true,footer:'#toolbar_paketmcu1'" title="" style="width:250px;background:#eeffff;">
			<table class="easyui-datagrid" id="datapolipemeriksaantabel"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_tind" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'nm_tind'" width="100" sortable="false">Pemeriksaan</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
			<div class="easyui-layout" data-options="fit:true">
				<?php ///print_r($this->session->all_userdata())?>
				<table class="easyui-datagrid" id="tableregisterpas"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tableregisterpas_toolbar">
						<thead>
							<tr>
								<th data-options="field:'newtglnya',styler:cellStyler" width="30" sortable="true">Tanggal</th>
								<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NRP/NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'nm_paket'" width="40" sortable="true">Paket</th>
								<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
								<th data-options="field:'sinkronasi_paket'" width="20" sortable="true">Sinkronasi</th>
							</tr>
						</thead>
					</table>
			<div id="tableregisterpas_toolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
				<div align="right">
					<table style="width:70%">
					<tr>
						<td width="20%">
						<input class="easyui-searchbox" id="filter_keyword" data-options="prompt:'Masukkan Keyword',searcher:tampilkandataregister" style="width:100%;"></input>
						</td>
						<td width="10%">
							<input class="easyui-datebox" type="text" id="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td width="10%">
							<input class="easyui-datebox" type="text" id="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td width="15%">
							<select id="filter_typejawatan"  class="easyui-combobox" style="width:100%;">
								<option value="">Semua...</option>
								<?php 
									foreach(is_getTipeJawatan() as $ke => $va){ 
								?>
									<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
								<?php } ?>
							</select>
						</td>
						<td width="15%">
							<select  class="easyui-combobox" id="filter_jawatan" style="width:100%;">
								<option value="">Semua...</option>
								<?php 
									$this->db->select('id_jawatan, nm_jawatan');
									$this->db->order_by('nm_jawatan', 'ASC');
									$cmb1 = $this->db->get('tb_jawatan');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
								?>
								<option value="<?=@$va->id_jawatan?>" <?=@$sel?>><?=@$va->nm_jawatan?></option>
								<?php } ?>
							</select>
						</td>
						<td width="20%">
							
							<select  class="easyui-combobox" id="filter_paket" style="width:100%;">
											<option value="">Semua...</option>
											<?php 
												$this->db->select('id_paket, nm_paket');
												//$this->db->where('jenis_paket', 'P');
												$this->db->order_by('id_paket', 'ASC');
												$cmb1 = $this->db->get('tb_paket');
												$cmb1 = $cmb1->result();
												foreach($cmb1 as $va){ 
												$ksb = $va->nm_paket;
												if($va->id_paket == "1"){
													$ksb = "KONSUL";
												}
											?>
												<option value="<?=@$va->id_paket?>"><?=@$ksb?></option>
											<?php } ?>
										</select>
						</td>
						
					</tr>
				</table>
				</div>
			</div>
        </div>
		<div id="modaltampilkandetailapabae" inline="true" modal="true"  closed="true" maximizable="false" draggable="false" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Referensi Registrasi" fit="true">
		</div>
		<div id="modaltampilkanhistory" modal="true"  closed="true" maximizable="false" draggable="false" minimizable="false"  collapsible="false" class="easyui-window" title="" style="width:600px;height:400px;">
		</div>
	</div>
</div>
<script type="text/javascript">

		$('#filter_tglawal').datebox({
			onSelect: function(date){
				tampilkandataregister();
			}
		});
		
		$('#filter_tglakhir').datebox({
			onSelect: function(date){
				tampilkandataregister();
			}
		});
		
		$('#filter_jawatan').combobox({
			onSelect: function(date){
				tampilkandataregister();
			}
		});
		
		$('#filter_paket').combobox({
			onSelect: function(date){
				tampilkandataregister();
			}
		});
		
		$('#filter_typejawatan').combobox({
			onSelect: function(date){
				tampilkandataregister();
			}
		});
		
		setTimeout(function(){
		   $('#filter_keyword').textbox('textbox').focus().select();
		},20);
		
			//alert(filter_tglawal);
			$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienpemeriksaan')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_jawatan=&filter_paket=&filter_typejawatan=&filter_keyword=',
			});
			
			
			function cellStyler(value,row,index){
				if (row.warnaok < 1){
					return 'background-color:red;color:white;font-weight:bold';
				}
			}
			document.getElementById("filter_keyword").focus();
			
	function tampilkandataregister(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
			$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienpemeriksaan')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_keyword='+filter_keyword,
			});
			
			setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
			
		}
	$('#tableregisterpas').datagrid({  
			onSelect:function(index,row){  
				var id = row.kode_transaksi;
				$('#datapolipemeriksaantabel').datagrid({
					url: '<?=@base_url($this->u1.'/jsondatapemeriksaanperpasien')?>/'+id,
				});
			}  
	}); 
	$('#datapolipemeriksaantabel').datagrid({  
			onSelect:function(index,row){  
				var gggg = $('#tableregisterpas').datagrid('getSelected');  
				if (gggg){
					var id = row.id_tind;
					var nm = row.nm_tind;
					var idins = row.id_ins_tind;
					var kode_transaksi = gggg.kode_transaksi;
					var id_paket = gggg.id_paket;
					var noreg = gggg.no_reg;
					$('#modaltampilkandetailapabae').window('open');
					$('#modaltampilkandetailapabae').panel({
						title: nm+' | '+gggg.nm_pas+' | '+gggg.no_filemcu+' | Mode Input Detail Pemeriksaan',
						href:'<?=@base_url($this->u1.'/inputisidetailpemeriksaan')?>/'+id+'/?kode_transaksi='+kode_transaksi+'&id_paket='+id_paket+'&noreg='+noreg+'&idins='+idins,
					});
				} else {
					$.messager.alert('Informasi', 'Pilih Pasien terlebih dahulu', 'info');
				}
			}  
	}); 
	
	function rubahstatusmestruasii(nofile){
		
			var gggg = $('#tableregisterpas').datagrid('getSelected');  
			var cccc = $('#datapolipemeriksaantabel').datagrid('getSelected');  
			var id = cccc.id_tind;
			var nm = cccc.nm_tind;
			var idins = cccc.id_ins_tind;
			var kode_transaksi = gggg.kode_transaksi;
			var id_paket = gggg.id_paket;
			var noreg = gggg.no_reg;
		//	$('#modaltampilkandetailapabae').window('close');
			//$('#tableregisterpas').datagrid('reload');
			$('#modaltampilkandetailapabae').panel({
				title: nm+' | '+gggg.nm_pas+' | '+gggg.no_filemcu+' | Mode Input Detail Pemeriksaan',
				href:'<?=@base_url($this->u1.'/inputisidetailpemeriksaan')?>/'+id+'/?kode_transaksi='+kode_transaksi+'&id_paket='+id_paket+'&noreg='+noreg+'&idins='+idins+'&apdetstatusmens='+nofile,
			});
	}
	
	function simpandetailpemeriksaanpoligabungtind(id, nm){
		$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan '+nm, function(r) {
				if (r){
					$('#inputpemeriksaangabungform'+id).form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								var gggg = $('#tableregisterpas').datagrid('getSelected');  
								var cccc = $('#datapolipemeriksaantabel').datagrid('getSelected');  
								var id = cccc.id_tind;
								var nm = cccc.nm_tind;
								var idins = cccc.id_ins_tind;
								var kode_transaksi = gggg.kode_transaksi;
								var id_paket = gggg.id_paket;
								var noreg = gggg.no_reg;
								$('#modaltampilkandetailapabae').window('close');
								$('#tableregisterpas').datagrid('reload');
								//$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								/*$('#modaltampilkandetailapabae').panel({
									title: nm+' | '+gggg.nm_pas+' | '+gggg.no_filemcu+' | Mode Input Detail Pemeriksaan',
									href:'<?=@base_url($this->u1.'/inputisidetailpemeriksaan')?>/'+id+'/?kode_transaksi='+kode_transaksi+'&id_paket='+id_paket+'&noreg='+noreg+'&idins='+idins,
								});*/
								
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
	}
	
	
	function simpandetailpemeriksaanpoli(){
		$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan pemeriksaan', function(r) {
				if (r){
					$('#inputpemeriksaanformdata').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								var gggg = $('#tableregisterpas').datagrid('getSelected');  
								var cccc = $('#datapolipemeriksaantabel').datagrid('getSelected');  
								var id = cccc.id_tind;
								var nm = cccc.nm_tind;
								var idins = cccc.id_ins_tind;
								var kode_transaksi = gggg.kode_transaksi;
								var id_paket = gggg.id_paket;
								var noreg = gggg.no_reg;
								$('#modaltampilkandetailapabae').window('close');
								$('#tableregisterpas').datagrid('reload');
								//$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								/*$('#modaltampilkandetailapabae').panel({
									title: nm+' | '+gggg.nm_pas+' | '+gggg.no_filemcu+' | Mode Input Detail Pemeriksaan',
									href:'<?=@base_url($this->u1.'/inputisidetailpemeriksaan')?>/'+id+'/?kode_transaksi='+kode_transaksi+'&id_paket='+id_paket+'&noreg='+noreg+'&idins='+idins,
								});*/
								
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
	}
	
	function sinkronkanpaket(kode, idpaket){
		$.messager.confirm('Konfirmasi', 'Sinkronasi Paket hanya berfungsi untuk menambahkan pemeriksaan yang belum masuk kedalam transaksi', function(r) {
				if (r){
					
					
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/sinkronkanpaket')?>", {
							kode:kode, idpaket:idpaket,
						}, function(response){
							$.messager.alert('Informasi', response, 'info');
						});
						
						
				}
			});
	}
</script>