<div class="easyui-layout" data-options="fit:true" id="evaluasipasienpanel">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
               <table class="easyui-datagrid" id="tabelsatuevaluasi"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tabelsatuevaluasi_tolbar">
						<thead>
							<tr>
								<th data-options="field:'newtglnya',styler:cellStylereval" width="30" sortable="true">Tanggal</th>
								<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NRP/NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'alamat_pas'" width="40" sortable="true">Alamat</th>
								<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatuevaluasi_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
				<div align="right">
					<table style="width:70%">
							<tr>
								<td width="20%">
								<input class="easyui-searchbox" id="filter_keyword" data-options="prompt:'Masukkan Keyword',searcher:tampilkandataevaluasi" style="width:100%;"></input>
								</td>
								<td width="10%">
									<input class="easyui-datebox" type="text" id="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
								</td>
								<td width="10%">
									<input class="easyui-datebox" type="text" id="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
								</td>
								<td width="15%">
									<select id="filter_typejawatan"  style="width:100%;">
										<option value="">--Tipe--</option>
										<?php 
											foreach(is_getTipeJawatan() as $ke => $va){ 
										?>
											<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
										<?php } ?>
									</select>
								</td>
								<td width="15%">
									<select   id="filter_jawatan" style="width:100%;">
										<option value="">--Kesatuan--</option>
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
								<td width="15%">
									<select   id="filter_dinas" style="width:100%;">
										<option value="">--Kode--</option>
										<?php 
											$this->db->select('id_dinas, nm_dinas');
											$this->db->order_by('nm_dinas', 'ASC');
											$cmb1 = $this->db->get('tb_dinas');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
										?>
										<option value="<?=@$va->id_dinas?>" <?=@$sel?>><?=@$va->nm_dinas?></option>
										<?php } ?>
									</select>
								</td>
								<td width="20%">
									
									<select   id="filter_paket" style="width:100%;">
													<option value="">--Paket--</option>
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
			<div id="modaltampilkandetailevaluasi" inline="true" modal="true"  closed="true" maximizable="false" draggable="false" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Referensi Registrasi" fit="true">
			</div>
        </div>
    </div>
	<script type="text/javascript">
	
	function cellStylereval(value,row,index){
				if (row.warnaok == 200){
					
				} else{
					if (row.warnaok < 1){
						return 'background-color:red;color:white;font-weight:bold';
					}else{
						return 'background-color:#F7F700;color:black;font-weight:bold';
					}
				}
			}
		$('#tabelsatuevaluasi').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienevaluasi')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_jawatan=&filter_paket=&filter_typejawatan=&filter_keyword=',
			});
			
		
		$('#filter_tglawal').datebox({
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		
		$('#filter_tglakhir').datebox({
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		
		$('#filter_jawatan').combobox({
			filter: function(q, row){
				var opts = $(this).combobox('options');
				return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
			},
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		
		$('#filter_dinas').combobox({
			filter: function(q, row){
				var opts = $(this).combobox('options');
				return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
			},
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		$('#filter_paket').combobox({
			filter: function(q, row){
				var opts = $(this).combobox('options');
				return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
			},
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		
		$('#filter_typejawatan').combobox({
			filter: function(q, row){
				var opts = $(this).combobox('options');
				return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
			},
			onSelect: function(date){
				tampilkandataevaluasi();
			}
		});
		setTimeout(function(){
		   $('#filter_keyword').textbox('textbox').focus().select();
		},20);

		function tampilkandataevaluasi(){
			var filter_dinas = $('#filter_dinas').datebox('getValue');
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
			//alert(filter_tglawal);
			$('#tabelsatuevaluasi').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpasienevaluasi')?>/?filter_dinas='+filter_dinas+'&filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_keyword='+filter_keyword,
			});
			setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
		}
		$('#tabelsatuevaluasi').datagrid({  
				onSelect:function(index,row){  
					var id = row.kode_transaksi;
					var nm = row.nm_pas;
					var fise = row.no_filemcu;
					var paket = row.id_paket;
					$('#modaltampilkandetailevaluasi').window('open');
					$('#modaltampilkandetailevaluasi').panel({
						title: nm+' | '+fise+' | Mode Evaluasi Pasien',
						href:'<?=@base_url($this->u1.'/inputevaluasipasien')?>/'+id+'/?id_paket='+paket,
					});
				}  
		}); 
	</script>