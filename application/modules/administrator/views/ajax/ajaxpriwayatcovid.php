<table class="easyui-datagrid" id="tablemodalriwayatcovid"
				   data-options="singleSelect:true,fit:false,pagination:true,rownumbers:true,fitColumns:true" sortName="c.no_reg" sortOrder="ASC" toolbar="#tablemodalriwayatcovid_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NRP/NIK</th>
							<th data-options="field:'newtgl'" width="20" sortable="true">TGL MCU</th>
							<th data-options="field:'nm_tind'" width="30" sortable="true">PEMERIKSAAN</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">NAMA</th>
							<th data-options="field:'no_tlp_pas'" width="20" sortable="true">TELP</th>
							<!--<th data-options="field:'alamat_pas'" width="30" sortable="true">ALAMAT</th>-->
							<th data-options="field:'hasilnama'" width="20" sortable="true">HASIL</th>
						</tr>
					</thead>
				</table>
				<div id="tablemodalriwayatcovid_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="left" style="margin:0 10px 0 0;">
							<a style="margin-bottom:7px;" href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkanfilterriwayatswab()"><b>Swab Antigen</b></a>
							<a style="margin-bottom:7px;" href="javascript:void(0)" class="easyui-linkbutton" onclick="cetaksuratketerangan()"><b>Surat Keterangan</b></a>
							<a style="margin-bottom:7px;" href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkanfilterriwayatcovidlab()"><b>Versi Lab</b></a>
							<!--<a style="margin-bottom:7px;" href="javascript:void(0)" class="easyui-linkbutton" onclick="tampilkanfilterriwayatcovid()"><b>Print Data</b></a>--><br />
							<table style="width:70%">
								<tr>
									<td width="30%">
										<input class="easyui-datebox" type="text" id="filter_tglawal" value="<?=@date("m/d/Y")?>" style="width:100%;">
									</td>
									<td width="30%">
										<input class="easyui-datebox" type="text" id="filter_tglakhir" value="<?=@date("m/d/Y")?>" style="width:100%;">
									</td>
									<td>
										<input class="easyui-searchbox" id="filter_keyword" data-options="prompt:'Masukkan Nama, NIK, NRP Alamat dll ',searcher:tablemodalriwayatcovidcaridata" style="width:300px"></input>
									</td>
								</tr>
							</table>
							
						</div>
					</div>
				</div>
				
				
<div id="filterdatariwayat" modal="true"  closed="true" fit="true" maximizable="true" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:100%;height:400px;padding:5px;background:#ffffff;">
</div>
				
<script>
	setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
	$('#tablemodalriwayatcovid').datagrid({
		url:'<?=@base_url($this->u1.'/jsoncaririwayatcovidienok')?>/?filter_tglawal=<?=@date('Y-m-d')?>&filter_tglakhir=<?=@date('Y-m-d')?>&filter_keyword=',
	});	
	
		$('#filter_tglawal').datebox({
			onSelect: function(date){
				tablemodalriwayatcovidcaridata();
			}
		});
		
		$('#filter_tglakhir').datebox({
			onSelect: function(date){
				tablemodalriwayatcovidcaridata();
			}
		});
	function tablemodalriwayatcovidcaridata(){
			var filter_tglawal = $('#filter_tglawal').datebox('getValue');
			var filter_tglakhir = $('#filter_tglakhir').datebox('getValue');
			var filter_keyword = $('#filter_keyword').val();
			$('#tablemodalriwayatcovid').datagrid({
				url:'<?=@base_url($this->u1.'/jsoncaririwayatcovidienok')?>/?filter_tglawal='+filter_tglawal+'&filter_tglakhir='+filter_tglakhir+'&filter_keyword='+filter_keyword,
			});	
			
			setTimeout(function(){
			   $('#filter_keyword').textbox('textbox').focus().select();
			},20);
		}	
	function tampilkanfilterriwayatcovid(){
			var row = $('#tablemodalriwayatcovid').datagrid('getSelected');  
			if (row){  
				var kd = row.kode_transaksi;
				var pkt = row.id_paket;
				window.open('<?=@base_url($this->u1.'/cetakrapiddua')?>/?kode_transaksi='+kd+'&id_paket='+pkt+'', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
	function tampilkanfilterriwayatswab(){
			var row = $('#tablemodalriwayatcovid').datagrid('getSelected');  
			if (row){  
				var kd = row.kode_transaksi;
				var pkt = row.id_paket;
				window.open('<?=@base_url($this->u1.'/cetakantigen')?>/?kode_transaksi='+kd+'&id_paket='+pkt+'', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}	
		
	function cetaksuratketerangan(){
			var row = $('#tablemodalriwayatcovid').datagrid('getSelected');  
			if (row){  
				var kd = row.kode_transaksi;
				var pkt = row.id_paket;
				var ids = row.id_tind;
				window.open('<?=@base_url($this->u1.'/cetaksuratket')?>/?kode_transaksi='+kd+'&id_paket='+pkt+'&idpem='+ids, '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}	
		
		
	
	function tampilkanfilterriwayatcovidlab(){
			var row = $('#tablemodalriwayatcovid').datagrid('getSelected');  
			if (row){  
				var kd = row.kode_transaksi;
				var pkt = row.id_paket;
				window.open('<?=@base_url($this->u1.'/cetakrapid')?>/?kode_transaksi='+kd+'&id_paket='+pkt+'', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
</script>