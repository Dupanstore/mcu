<table class="easyui-datagrid" id="tablepasiengrounded"
				   data-options="singleSelect:true,fit:false,pagination:true,rownumbers:true,fitColumns:true" sortName="c.no_reg" sortOrder="ASC" toolbar="#tablepasiengrounded_toolbar">
					<thead>
						<tr>
							<th data-options="field:'newtgl'" width="20" sortable="true">TGL MCU</th>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NRP/NIK</th>
							
							<th data-options="field:'nm_pas'" width="30" sortable="true">NAMA</th>
							<th data-options="field:'no_tlp_pas'" width="20" sortable="true">TELP</th>
							<th data-options="field:'alamat_pas'" width="30" sortable="true">ALAMAT</th>
							<th data-options="field:'statusterbang'" width="20" sortable="true">STATUS</th>
						</tr>
					</thead>
				</table>
				<div id="tablepasiengrounded_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="left" style="margin:0 10px 0 0;">
							
							<form method="POST" id="formlaporangroundeds" action="javascript:void(0)">
							<table style="width:70%">
								<tr>
									<td width="25%">
										<input class="easyui-datebox" type="text" id="filter_tglawal" name="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
									</td>
									<td width="25%">
										<input class="easyui-datebox" type="text" id="filter_tglakhir" name="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
									</td>
									<td>
										<a  href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkandetaildatagroundedpas()"><b>Proses</b></a>
										<a href="javascript:void(0)" class="easyui-linkbutton" onclick="cetakdatagroundedkokpas('print')"><b>Cetak Data</b></a>
										<a href="javascript:void(0)" class="easyui-linkbutton" onclick="cetakdatagroundedkokpas('excel')"><b>Excel</b></a>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?php
											$lappp = "getnamajawatanjabatan";
										?>
										<input  name="id_jawatan[]" id="id_jawatan" class="easyui-combotree" data-options="url:'<?=@base_url('administrator/'. $lappp)?>',method:'get',label:'Select Nodes:',labelPosition:'top',multiple:true" style="width:100%">
									</td>
									<td colspan="2">
										<input class="easyui-searchbox" name="filter_keyword" id="filter_keyword" data-options="prompt:'Masukkan Nama, NIK, NRP Alamat dll ',searcher:tablepasiengroundedcaridata" style="width:300px"></input>
									</td>
								</tr>
							</table>
							</form>
						</div>
					</div>
				</div>
				
				
<div id="detopendatagrounded" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:50%;height:500px;padding:5px;background:#ffffff;">
</div>
				
<script>
	setTimeout(function(){
	   $('#filter_keyword').textbox('textbox').focus().select();
	},20);
	$('#tablepasiengrounded').datagrid({
		url:'<?=@base_url($this->u1.'/jsonpasiendatagrounded')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_keyword=',
	});	
	
		$('#filter_tglawal').datebox({
			onSelect: function(date){
				tablepasiengroundedcaridata();
			}
		});
		
		$('#filter_tglakhir').datebox({
			onSelect: function(date){
				tablepasiengroundedcaridata();
			}
		});
		
		$('#id_jawatan').combotree({
			onChange: function(date){
				tablepasiengroundedcaridata();
			}
		});
		
		
	function tablepasiengroundedcaridata(){
			//var t = $('#id_jawatan').combotree('tree');	// get the tree object
			var a = $('#formlaporangroundeds').serialize();
			$('#tablepasiengrounded').datagrid({
				url:'<?=@base_url($this->u1.'/jsonpasiendatagrounded')?>/?cek=ok'+'&'+a,
			});	
			
			setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
		}	
	function tampilkandetaildatagroundedpas(){
			var row = $('#tablepasiengrounded').datagrid('getSelected');  
			if (row){  
				var id = row.id_pas;
				var nama = row.nm_pas;
				var nipnrp = row.nip_nrp_nik;
				var kd = row.kode_transaksi;
				var pkt = row.id_paket;
				$('#detopendatagrounded').window('open');
				$('#detopendatagrounded').panel({
					title: 'DETAIL GROUNDED - '+nama+' - NIP/NRP/NIK - '+nipnrp,
					href:'<?=@base_url($this->u1.'/tampilkantablepasiengrounded')?>/'+kd+'/'+pkt,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
		
	function cetakdatagroundedkokpas(dek){
		var a = $('#formlaporangroundeds').serialize();
		window.open('<?=@base_url('administrator/cetakdatagrounded')?>/?typecetak='+dek+'&'+a);
	}
</script>