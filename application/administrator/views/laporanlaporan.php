<div class="easyui-layout" data-options="fit:true" id="keipalingawallaporan">
        <div data-options="region:'center',iconCls:''" title="Laporan Laporan">
			<table id="anu_laporan_laporan" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
					<thead>
						<tr>
							<th field="key_laporan" hidden="true" width="100">Diagnosa Kesehatan Kerja</th>
							<th field="val_laporan" width="20"><b>Medical Check-Up Report</b></th>
						</tr>                          
					</thead>                           
					<tbody>                            
						<?php
								foreach(is_laporanlaporan() as $cvbs => $vb){
						?>
						<tr>
							<td><?=@$cvbs?></td>
							<td><div align="left"><?=@$vb?></div></td>
						</tr>
							<?php } ?>
					</tbody>                           
				</table>
		</div>
		<div data-options="region:'east',split:true,footer:'#datakeseatan_pasien_kerjakelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:53%;background:#AFC9EC;">
			<div id="panel_laporanlaporan" class="easyui-panel" title="">	
			</div>
		</div>
    </div>
	<script type="text/javascript">
		$('#anu_laporan_laporan').datagrid({  
			onSelect:function(index,row){  
				var key = row.key_laporan;
				var vak = row.val_laporan;
				$('#panel_laporanlaporan').panel({
					title:vak,
					href:'<?=@base_url($this->u1.'/ajaxplaporanlaporan')?>/'+key,
				});
			}  
	});
	function bukalaporan(dek){
		var a = $('#akuinginsehatlaporan').serialize();
		window.open('<?=@base_url('administrator/ayocetakcetak')?>/?typecetak='+dek+'&'+a, "myWindow", "width=800px,height=auto,scrollbars=1");
	}
	</script>