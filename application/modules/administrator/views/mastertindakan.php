<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'west',split:true" title="Poliklinik & Penunjang" style="width:350px;background:#eeffff;">
			<table class="easyui-datagrid" id="datapolipemeriksaantabel"  url="<?=@base_url($this->u1.'/jsonsemuapolipenu')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_ins" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'kd_ins'" width="50" sortable="true">Kode</th>
							<th data-options="field:'nm_ins'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="tabel_grouppemeriksaan"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_tind" sortOrder="ASC" toolbar="#datakondisi_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nm_grouptindakan'" width="30" sortable="true">Group</th>
							<th data-options="field:'kd_tind'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_tind'" width="40" sortable="true">Nama</th>
							<th data-options="field:'order_form_baru',align:'center'" width="40" sortable="true">Order Form</th>
							<th data-options="field:'js_rs_tind',align:'right'" width="40" sortable="true">Harga Pemeriksaan</th>	
						</tr>
					</thead>
				</table>
				<div id="datakondisi_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Pemeriksaan',searcher:datakondisicaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakondisi_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<input type="hidden" id="xxinstid" value="">
			<form method="POST" id="datakondisi_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatetindakanmcu')?>">
				<div id="datakondisi_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datakondisi_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datakondisihidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakondisi_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakondisi_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datakondisihidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datakondisi_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datakondisi_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datakondisi_batal()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		$('#datapolipemeriksaantabel').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_ins;
				$('#xxinstid').val(id);
				$('#datakondisihidesatu').show();
				$('#datakondisihidedua').hide();
				    $('#tabel_grouppemeriksaan').datagrid({
						url:'<?=@base_url($this->u1.'/jsondatatindakanmcu')?>/'+id,
					});
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxtambahtindakan')?>/'+id,
				});  
				
			}  
		}); 
		function datakondisi_refresh(){
			$('#datakondisihidedua').hide();
			$('#datakondisihidesatu').show();
			$('#datakondisi_table1').datagrid('reload');
			$('#datakondisi_panel1').panel('refresh');
		}
		function datakondisi_batal(){
			var xxinstid = $('#xxinstid').val();
			$('#datakondisihidedua').hide();
			$('#datakondisihidesatu').show();
			$('#datakondisi_table1').datagrid('reload');
			$('#tabel_grouppemeriksaan').datagrid({
				url:'<?=@base_url($this->u1.'/jsondatatindakanmcu')?>/'+xxinstid,
			});
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxtambahtindakan')?>/'+xxinstid,
				});   
		}
		$('#datakondisihidedua').hide();  
		$('#tabel_grouppemeriksaan').datagrid({  
			onSelect:function(index,row){  
				var id_ins = row.id_ins_tind;
				var idgroup = row.id_tind;
				$('#datakondisihidesatu').hide();
				$('#datakondisihidedua').show();
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxtambahtindakan')?>/'+id_ins+'/'+idgroup,
				});  
			}  
		}); 
		function datakondisi_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data Pemeriksaan', function(r) {
				if (r){
					$('#datakondisi_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datakondisi_batal();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
        function datakondisicaridata(value){
			$('#tabel_grouppemeriksaan').datagrid('load',{  
				cari: value,
			}); 
        }
		function datakondisi_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data Pemeriksaan', function(r) {
				if (r){
					var id = $('#id_tind').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatatindakan')?>", {
						id:id,
					}, function(response){	
						datakondisi_batal();
					});
				}  
			}); 	
		}  
	</script>