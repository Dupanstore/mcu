<div class="easyui-layout" data-options="fit:true" id="bookingonlinepaspasienpanel">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
               <table class="easyui-datagrid" id="tabelsatubookingonlinepas"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tglbooking" sortOrder="DESC" toolbar="#tabelsatubookingonlinepas_tolbar">
						<thead>
							<tr>
								<th data-options="field:'tglbooking',styler:cellStylereval" width="30" sortable="true">Tanggal</th>
								<th data-options="field:'nip_nrp_nik'" width="30" sortable="true">NRP/NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'kode_book'" width="20" sortable="true">Kode Booking</th>
								<th data-options="field:'nm_paket'" width="30" sortable="true">Paket</th>
								<th data-options="field:'dari_online'" width="30" sortable="true">Daftar Online</th>
								<th data-options="field:'prosesdata'" width="40" sortable="true">Proses</th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatubookingonlinepas_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
				<div align="right">
					<table style="width:70%">
					<tr>
						<td width="20%">
						<input class="easyui-searchbox" id="filter_keyword" data-options="prompt:'Masukkan Keyword',searcher:tampilkandatabookingonlinepas" style="width:100%;"></input>
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
												$this->db->where('jenis_paket', 'P');
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
			<div id="modaltampilkandetailbookingonlinepas" inline="true" modal="true"  closed="true" maximizable="false" draggable="false" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Referensi Registrasi" fit="true">
			</div>
        </div>
    </div>
	<script type="text/javascript">
	
	function cellStylereval(value,row,index){
				if (row.sudah_didaftarkan == "Y"){
					
				} else{
					return 'background-color:red;color:white;font-weight:bold';
				}
			}
		$('#tabelsatubookingonlinepas').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienbookingonlinepas')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_jawatan=&filter_paket=&filter_typejawatan=&filter_keyword=',
			});
			
		
		$('#filter_tglawal').datebox({
			onSelect: function(date){
				tampilkandatabookingonlinepas();
			}
		});
		
		$('#filter_tglakhir').datebox({
			onSelect: function(date){
				tampilkandatabookingonlinepas();
			}
		});
		
		$('#filter_jawatan').combobox({
			onSelect: function(date){
				tampilkandatabookingonlinepas();
			}
		});
		
		$('#filter_paket').combobox({
			onSelect: function(date){
				tampilkandatabookingonlinepas();
			}
		});
		
		$('#filter_typejawatan').combobox({
			onSelect: function(date){
				tampilkandatabookingonlinepas();
			}
		});
		setTimeout(function(){
		   $('#filter_keyword').textbox('textbox').focus().select();
		},20);

		function tampilkandatabookingonlinepas(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
			//alert(filter_tglawal);
			$('#tabelsatubookingonlinepas').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienbookingonlinepas')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_keyword='+filter_keyword,
			});
			setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
		}
		/*$('#tabelsatubookingonlinepas').datagrid({  
				onSelect:function(index,row){  
					var id = row.kode_transaksi;
					var nm = row.nm_pas;
					var fise = row.no_filemcu;
					var paket = row.id_paket;
					$('#modaltampilkandetailbookingonlinepas').window('open');
					$('#modaltampilkandetailbookingonlinepas').panel({
						title: nm+' | '+fise+' | Mode bookingonlinepas Pasien',
						href:'<?=@base_url($this->u1.'/inputbookingonlinepaspasien')?>/'+id+'/?id_paket='+paket,
					});
				}  
		}); 
		*/
		
		function lanjutkanpendaftaranpasien(idpas, idbook){
			//alert(er);
			newtabnya('Pendaftaran Pasien', '<?=@base_url($this->u1 . '/pendaftaranpasien')?>/?idpas='+idpas+'&idol='+idbook);
		}
	</script>