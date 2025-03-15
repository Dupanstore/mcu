<div class="easyui-layout" data-options="fit:true" id="pembayaranpasienpanel">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
               <table class="easyui-datagrid" id="tabelsatupembayaran"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tabelsatupembayaran_tolbar">
						<thead>
							<tr>
								<th data-options="field:'newtglnya'" width="30" sortable="true">Tanggal</th>
								<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NRP/NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'alamat_pas'" width="40" sortable="true">Alamat</th>
								<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatupembayaran_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
				<div align="right">
					<table style="width:70%">
					<tr>
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
						<td width="20%">
							<select  class="easyui-combobox" name="filter_cara_bayar" id="filter_cara_bayar" style="width:100%">
								<option value="">Semua...</option>
								<?php 
									$this->db->select('id_bayar, nm_bayar');
									/*if(isset($_GET['id_reg'])){
										$this->db->where('nm_bayar', $datareg[0]->cara_bayar);
									}*/
									$this->db->order_by('id_bayar', 'ASC');
									$cmb1 = $this->db->get('tb_bayar');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
										$sel = "";
								?>
									<option value="<?=@$va->nm_bayar?>" <?=@$sel?>><?=@$va->nm_bayar?></option>
								<?php } ?>
							</select>
						</td>
						<td width="20%">
						<input class="easyui-textbox" id="filter_keyword" data-options="prompt:'Masukkan Keyword'" style="width:100%;"></input>
						</td>
						<td>
						<button style="cursor:pointer" type="button" onclick="tampilkandatapembayaran()" style="width:100%;">Tampilkan</button>
						</td>
					</tr>
				</table>
				</div>
			</div>
            </div>
			<div id="modaltampilkandetailpembayaran" inline="true" modal="true"  closed="true" maximizable="false" draggable="false" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Referensi Registrasi" style="width:700px;height:500px;">
			</div>
        </div>
    </div>
	<div id="framepembayaran"></div>
	<script type="text/javascript">
		$('#tabelsatupembayaran').datagrid({
			url: '<?=@base_url($this->u1.'/jsonpasienpembayaran')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_jawatan=&filter_paket=&filter_typejawatan=&filter_carabayar=&filter_keyword=',
		});
		function tampilkandatapembayaran(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
			//alert(filter_tglawal);
			$('#tabelsatupembayaran').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienpembayaran')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword,
			});
		}
		$('#tabelsatupembayaran').datagrid({  
				onSelect:function(index,row){  
					var id = row.kode_transaksi;
					var nm = row.nm_pas;
					var fise = row.no_filemcu;
					var paket = row.no_filemcu;
					$('#modaltampilkandetailpembayaran').window('open');
					$('#modaltampilkandetailpembayaran').panel({
						title: nm+' | '+fise+' | Pembayaran Pasien',
						href:'<?=@base_url($this->u1.'/inputpembayaranpasien')?>/'+id,
					});
				}  
		}); 
		function simpanpembayaranya(kode){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data transaksi', function(r) {
				if (r){
					$('#detailinputpembayaran_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#modaltampilkandetailpembayaran').panel({
									href:'<?=@base_url($this->u1.'/inputpembayaranpasien')?>/'+kode,
								});
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function batalkantransaksi(kode){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan membatalkan transaksi', function(r) {
				if (r){
					$('#formbatalpembayaran_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#modaltampilkandetailpembayaran').panel({
									href:'<?=@base_url($this->u1.'/inputpembayaranpasien')?>/'+kode,
								});
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function cetakkwitansibayar(kode){
			$.post("<?=@base_url($this->u1.'/cetakkwitansipasien')?>/"+kode, {
			}, function(response){
					$('#framepembayaran').html(response);		
			});
			//window.open('<?=@base_url($this->u1.'/cetakkwitansipasienframe')?>/'+kode);
		}
	</script>