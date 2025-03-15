<div class="easyui-layout" data-options="fit:true" id="datacdinteraktif_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
               <div class="easyui-layout" data-options="fit:true" id="datadetailnyacdinteraktif_layout1">
					<div data-options="region:'north',split:true,iconCls:'icon-lock'" title="" style="height:45px;background:#E4F1FB;padding:5px;">
						<form id="formfilteranalisa" method="POST" action="javascript:void(0)">
						
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
						
						
						<table style="width:100%">
							<tr>
								
								<td width="1%">Kesatuan/Perusahaan</td>
								<td>
									<select  name="id_cabang" id="id_cabang" style="width:100%" onchange="abcdetampil(), efghtampil()">
										<option value="1"></option>
										<!--<?php 
											$this->db->select('id_jawatan, nm_jawatan');
											$this->db->order_by('nm_jawatan', 'ASC');
											$cmb1 = $this->db->get('tb_jawatan');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
										?>
											<option value="<?=@$va->id_jawatan?>"><?=@$va->nm_jawatan?></option>
										<?php } ?>-->
										</select>
								</td>
								<td width="1%">CaraBayar</td>
								<td>
									<select  name="id_unit" id="id_unit" style="width:100%" onchange="abcdetampil(), efghtampil()">
										<option value="1"></option>
										<!--<?php 
											$this->db->select('id_bayar, nm_bayar');
											$this->db->order_by('nm_bayar', 'ASC');
											$cmb1 = $this->db->get('tb_bayar');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
										?>
											<option value="<?=@$va->id_bayar?>"><?=@$va->nm_bayar?></option>
										<?php } ?>-->
										</select>
								</td>
								<td width="1%">Paket</td>
								<td>
									<div id="defaultpaket">
									<select name="id_paket" id="id_paket" style="width:100%" onchange="abcdetampil(), efghtampil()">
										<option value=""></option>
										<?php 
											$this->db->select('id_paket, nm_paket');
											$this->db->order_by('id_paket', 'ASC');
											$cmb1 = $this->db->get('tb_paket');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
										?>
											<option value="<?=@$va->id_paket?>"><?=@$va->nm_paket?></option>
										<?php } ?>
									</select>
									</div>
								</td>
								<td width="1%">Jenkel</td>
								<td>
									<select name="id_jenkel" id="id_jenkel" style="width:100%" onchange="abcdetampil(), efghtampil()">
										<option value=""></option>
										<?php 
											foreach(is_jenkel() as $fgs => $va){ 
										?>
											<option value="<?=@$fgs?>"><?=@$va?></option>
										<?php } ?>
									</select>
								</td>
								<td width="1%">Charts</td>
								<td>
									<select name="id_chart" id="id_chart" style="width:100%" onchange="abcdetampil(), efghtampil()">
										<?php 
											foreach(is_chart() as $fgs => $va){ 
										?>
											<option value="<?=@$fgs?>"><?=@$va?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
						</form>
					</div>
					<div data-options="region:'center',iconCls:'icon-ok'" title="">
						<div class="easyui-layout" data-options="fit:true">
						   <div id="panel_posisi1" class="easyui-panel" title="" fit="true">	
							</div>
						</div>
					</div>
					
			</div>
            </div>
        </div>
		<div data-options="region:'west',split:true,iconCls:'icon-lock'" title="" style="width:250px;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelkelompokanalisa"  url="<?=@base_url($this->u1.'/jsonkelompokanalisa')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:false,fitColumns:true" sortName="kd_paket" sortOrder="ASC" title="">
					<thead>
						<tr>
							<th data-options="field:'nm_tind'" width="100" sortable="true"><b style="color:#2779AA;">KELOMPOK ANALISA</b></th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'south',split:true,iconCls:'icon-lock'" title="" style="height:200px;background:#eeffff;">
			<div id="panel_posisi2" class="easyui-panel" title="" fit="true">	
			</div>
		</div>
</div>
	<script type="text/javascript">
		/*$('#panel_posisi1').panel({
				href:'<?=@base_url($this->u1.'/masterkondisi')?>',
			});
		$('#panel_posisi2').panel({
				href:'<?=@base_url($this->u1.'/masterkondisi')?>',
			});
		*/
		$('#tabelkelompokanalisa').datagrid({  
				onSelect:function(index,row){  
						var a = $('#formfilteranalisa').serialize();
						var id = row.id_tind;
						var nm = row.nm_tind;
						var urikey = row.uri_key;
						var idins = row.id_ins_tind;
						$('#panel_posisi1').panel({
							href:'<?=@base_url($this->u1.'/analisa1')?>/'+id+'/?'+a+'&idins='+idins+'&urikey='+urikey,
						});
						$('#panel_posisi2').panel({
							href:'<?=@base_url($this->u1.'/analisa2')?>/'+id+'/?'+a+'&idins='+idins+'&urikey='+urikey,
						});
						/*if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
						   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
							if (document.documentElement.requestFullScreen) {  
							  document.documentElement.requestFullScreen();  
							} else if (document.documentElement.mozRequestFullScreen) {  
							  document.documentElement.mozRequestFullScreen();  
							} else if (document.documentElement.webkitRequestFullScreen) {  
							  document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
							}
							$('#getfull').val('Pindah ke Mode Biasa');				
						  }
						  */
				}  
				
		});  
		function rubahkunjunganpaket(vall){
			$.post('<?=@base_url('administrator/caripaketpasien')?>',{id:vall},function(result){ 
				$('#defaultpaket').html(result);
				abcdetampil();
			}); 
		}
		function abcdetampil(){
				var row = $('#tabelkelompokanalisa').datagrid('getSelected');  
				if (row){
						var a = $('#formfilteranalisa').serialize();
						var id = row.id_tind;
						var nm = row.nm_tind;
						var urikey = row.uri_key;
						var idins = row.id_ins_tind;
						if(urikey != "pemfisik"){
							$('#panel_posisi1').panel({
								href:'<?=@base_url($this->u1.'/analisa1')?>/'+id+'/?'+a+'&idins='+idins+'&urikey='+urikey,
							});
							$('#panel_posisi2').panel({
								href:'<?=@base_url($this->u1.'/analisa2')?>/'+id+'/?'+a+'&idins='+idins+'&urikey='+urikey,
							});
						}
				} else {
					
				}
		}
		
		
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
		
	</script>