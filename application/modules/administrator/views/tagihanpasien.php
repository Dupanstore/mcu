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
					<form method="GET" id="dataformcetaklaporan" action="<?=base_url($this->u1 .'/cetaklaporankasirframe')?>">
					<table style="width:70%">
					<tr>
						<td width="10%">
							<input class="easyui-datebox" type="text" name="filter_tglawal" id="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td width="10%">
							<input class="easyui-datebox" type="text" name="filter_tglakhir" id="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td width="15%">
							<select name="filter_typejawatan" id="filter_typejawatan"  class="easyui-combobox" style="width:100%;">
								<option value="">Semua...</option>
								<?php 
									foreach(is_getTipeJawatan() as $ke => $va){ 
								?>
									<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
								<?php } ?>
							</select>
						</td>
						<td width="15%">
							<select  class="easyui-combobox" name="filter_jawatan" id="filter_jawatan" style="width:100%;">
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
							
							<select  class="easyui-combobox" name="filter_paket" id="filter_paket" style="width:100%;">
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
						<input class="easyui-textbox" id="filter_keyword" onkeypress="tindakandiagnosa(this, event)" data-options="prompt:'Masukkan Keyword'" style="width:100%;"></input>
						</td>
						<td>
						<button style="cursor:pointer" type="button" onclick="tampilkandatapembayaran()" style="width:100%;">Tampilkan</button>
						</td>
					</tr>
				</table>
						<button style="cursor:pointer" type="button" onclick="printbiasa()" style="width:100%;">Print Biasa</button>
						<button style="cursor:pointer" type="button" onclick="printkemenkes()" style="width:100%;">Print Kemenkes</button>
						<button style="cursor:pointer" type="button" onclick="printkemenkesarsip()" style="width:100%;">Print Kemenkes Arsip</button>
						<button style="cursor:pointer" type="button" onclick="printcnooc()" style="width:100%;">Print Cnooc</button>
						<button style="cursor:pointer" type="button" onclick="printcnoocarsip()" style="width:100%;">Print Cnooc Arsip</button>
				</form>
				</div>
			</div>
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
		function printbiasa(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapkasirbiasaframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword);
		}
		function printkemenkes(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapkasirkemenkesframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword);
		}
		function printkemenkesarsip(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapkasirkemenkesarsipframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword);
		}
		function printcnooc(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapkasircnoocframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword);
		}
		function printcnoocarsip(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_typejawatan = $('#filter_typejawatan').combobox('getValue');
			var filter_carabayar = $('#filter_cara_bayar').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapkasircnoocarsipframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_typejawatan='+filter_typejawatan+'&filter_carabayar='+filter_carabayar+'&filter_keyword='+filter_keyword);
		}
		function tindakandiagnosa(inField, e){
			var charCode;
			if(e && e.which){
				charCode = e.which;
			}else if(window.event){
				e = window.event;
				charCode = e.keyCode;
			}
			if(charCode == 13) {
				var ww = $('#id_diagnosa').val();
				$.post("<?=base_url('pelayanan/'. $this->session->userdata('slug_ins') .'/getdatadiagnosa')?>", {
					parent_id: $('#'+ww).val(), get_id: ww,
				}, function(response){
					setTimeout("finishAjax('show_diagnosa', '"+escape(response)+"')", 100);
				});
			}
		}
	</script>