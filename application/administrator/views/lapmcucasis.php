<div class="easyui-layout" data-options="fit:true" id="lapcasispasienpanel">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
               <table class="easyui-datagrid" id="tabelsatulapcasis"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tabelsatulapcasis_tolbar">
						<thead>
							
						</thead>
					</table>
			<div id="tabelsatulapcasis_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
				<div align="right">
					<form method="GET" id="dataformcetaklaporan" action="<?=base_url($this->u1 .'/cetaklapilamedexframe')?>">
					<table style="width:80%">
					<tr>
						<td width="10%">
							<input class="easyui-datebox" type="text" name="filter_tglawal" id="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td width="10%">
							<input class="easyui-datebox" type="text" name="filter_tglakhir" id="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
						</td>
						<td>
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
						<td>
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
						<td>
							<input class="easyui-textbox" id="filter_keyword" data-options="prompt:'Masukkan Keyword'" style="width:100%;"></input>
						</td>
						<td>
							<button style="cursor:pointer" type="button" onclick="tampilkandatalapcasis()" style="width:100%;">Tampilkan</button>
						</td>
						<td>
							<button style="cursor:pointer" type="button" onclick="printbiasa('print')" style="width:100%;">Print</button>
						</td>
						<td>
							<button style="cursor:pointer" type="button" onclick="printbiasa('excel')" style="width:100%;">Cetak</button>
						</td>
					</tr>
				</table>
						
						
				</form>
				</div>
			</div>
            </div>
        </div>
    </div>
	<div id="framelapcasis"></div>
	<script type="text/javascript">
		function printbiasa(type){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_jawatan = $('#filter_jawatan').combobox('getValue');
			var filter_paket = $('#filter_paket').combobox('getValue');
			var filter_keyword = $('#filter_keyword').val();
				window.open('<?=@base_url($this->u1.'/cetaklapcasisframe')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_jawatan='+filter_jawatan+'&filter_paket='+filter_paket+'&filter_keyword='+filter_keyword+'&type='+type);
		}
			
	</script>