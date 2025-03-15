<div class="easyui-layout" data-options="fit:true" id="datakeseatan_pasien_subnyadetailfisikpem2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		 <div data-options="region:'west',split:true" title="" style="width:250px;background:#eeffff;">
			<table class="easyui-datagrid" id="datatabelsubpemeriksaanfisikdaricd"  url="<?=@base_url($this->u1.'/jsongrouppemfisikcdinteractive')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:false,fitColumns:true" sortName="kd_groupfisik" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'nm_groupfisik'" width="100" sortable="true"><b>Sub Kelompok Analisa</b></th>
						</tr>
					</thead>
				</table>
		</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakeseatan_pasien_subnyadetailfisikpem2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:80%;background:#eeffff;">
			<div id="panel_posisi3" class="easyui-panel" title="" fit="true">	
			</div>
		</div>
    </div>
	<script type="text/javascript">
	$('#datatabelsubpemeriksaanfisikdaricd').datagrid({  
				onSelect:function(index,row){  
						var a = $('#formfilteranalisa').serialize();
						var id = row.id_groupfisik;
						var kd = row.kd_groupfisik;
						var nm = row.nm_groupfisik;
						$('#panel_posisi3').panel({
							href:'<?=@base_url($this->u1.'/analisa3')?>/?'+a+'&id='+id+'&kd='+kd+'&nm='+nm,
						});
						$('#panel_posisi2').panel({
							href:'<?=@base_url($this->u1.'/analisa4')?>/?'+a+'&id='+id+'&kd='+kd+'&nm='+nm,
						});
				}  
				
		});
		function rubahsubpemfisikjuga(vall){
			var row = $('#tabelkelompokanalisa').datagrid('getSelected');  
			if(row.uri_key == "pemfisik"){
				$.post('<?=@base_url('administrator/caripaketpasien')?>',{id:vall},function(result){ 
					$('#defaultpaket').html(result);
					efghtampil();
				}); 
			}
		}
		function efghtampil(){
				var row = $('#datatabelsubpemeriksaanfisikdaricd').datagrid('getSelected');  
				if (row){
						var a = $('#formfilteranalisa').serialize();
						var id = row.id_groupfisik;
						var kd = row.kd_groupfisik;
						var nm = row.nm_groupfisik;
						$('#panel_posisi3').panel({
							href:'<?=@base_url($this->u1.'/analisa3')?>/?'+a+'&id='+id+'&kd='+kd+'&nm='+nm,
						});
						$('#panel_posisi2').panel({
							href:'<?=@base_url($this->u1.'/analisa4')?>/?'+a+'&id='+id+'&kd='+kd+'&nm='+nm,
						});
				} else {
					
				}
		}
	</script>