<div class="easyui-layout" data-options="fit:true" id="datakondisi_layout1">
        <div data-options="region:'west',split:true" title="Data Poliklinik & Ruang" style="width:200px;background:#eeffff;">
			<table class="easyui-datagrid" id="datapolipemeriksaantabel"  url="<?=@base_url($this->u1.'/jsongroupdetailpoli')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_ins" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'nm_ins'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
			<div class="easyui-layout" data-options="fit:true">
                <div class="easyui-tabs" id="newtabketerangan" style="width:auto;" data-options="fit:true">
					<div title="Konfigurasi Jenis Pemeriksaan">
						<table class="easyui-datagrid" id="tabel_getdapatpemeriksaan"
						   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="kd_tind" sortOrder="ASC">
							<thead>
								<tr>
									<th data-options="field:'kd_tind'" width="10" sortable="true">Kode</th>
									<th data-options="field:'nm_tind'" width="40" sortable="true">Nama</th>
									<th data-options="field:'detdetlain'" width="70" sortable="true">Detail List Pemeriksan</th>
									<th data-options="field:'tomboll'" width="10" sortable="true"></th>
								</tr>
							</thead>
						</table>
					</div>    
					<div title="Tambah Pemeriksaan Poliklinik">
						<table class="easyui-datagrid" id="tabel_grouppemeriksaan"
						   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="det_order_pemeriksaan" sortOrder="ASC" toolbar="#datakondisi_table1_toolbar">
							<thead>
								<tr>
									<th data-options="field:'det_nm_pemeriksaan'" width="40" sortable="true">Pemeriksaan</th>
									<th data-options="field:'det_nilai_normal_new'" width="30" sortable="true">Nilai Normal</th>
									<th data-options="field:'det_type_pemeriksaan'" width="40" sortable="true">Type</th>
									<th data-options="field:'det_order_pemeriksaan',align:'center'" width="15" sortable="true">Order</th>
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
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakondisi_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<input type="hidden" id="xxinstid" value="">
			<form method="POST" id="datakondisi_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedetailpemeriksaan')?>">
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
	<div id="modaldetailtindakandua" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modaldetailtindakandua_toolbar" collapsible="false" class="easyui-window" title="" style="width:700px;height:500px;padding:5px;background:#ffffff;">
    </div>
	<div id="modaldetailtindakandua_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanperubahandetailpemeriksaan()"><b>Simpan Perubahan</b></a>
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
						url:'<?=@base_url($this->u1.'/jsondatadetailpemeriksaan')?>/'+id,
					});
					$('#tabel_getdapatpemeriksaan').datagrid({
						url:'<?=@base_url($this->u1.'/jsondatatindakandetpem')?>/'+id,
					});
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdetailtambahperiksa')?>/'+id,
				});  
				if ($('#newtabketerangan').tabs('exists', 'Tambah Pemeriksaan Poliklinik')){  
					$('#newtabketerangan').tabs('select', 'Tambah Pemeriksaan Poliklinik');
				}
				
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
						url:'<?=@base_url($this->u1.'/jsondatadetailpemeriksaan')?>/'+xxinstid,
					});
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdetailtambahperiksa')?>/'+xxinstid,
				});   
			if ($('#newtabketerangan').tabs('exists', 'Tambah Pemeriksaan Poliklinik')){  
					$('#newtabketerangan').tabs('select', 'Tambah Pemeriksaan Poliklinik');
				}
		}
		$('#datakondisihidedua').hide();  
		$('#tabel_grouppemeriksaan').datagrid({  
			onSelect:function(index,row){  
				var id_ins = row.id_ins_periksa;
				var idgroup = row.id_pem;
				$('#datakondisihidesatu').hide();
				$('#datakondisihidedua').show();
				$('#datakondisi_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdetailtambahperiksa')?>/'+id_ins+'/'+idgroup,
				});  
			}  
		}); 
		function datakondisi_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan detail pemeriksaan', function(r) {
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
					var id = $('#id_pem').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatadetailperiksa')?>", {
						id:id,
					}, function(response){	
						datakondisi_batal();
					});
				}  
			}); 	
		}  
		function tampiljenispemeriksaan(id, nm){
				var xxinstid = $('#xxinstid').val();
                $('#modaldetailtindakandua').window('open');
				$('#modaldetailtindakandua').panel({
					title: 'Detail Pemeriksaan - '+nm,
					href:'<?=@base_url($this->u1.'/ajaloaddetpemeriksaanpoli')?>/'+xxinstid+'/'+id,
				});
		}
		function simpanperubahandetailpemeriksaan(){
			$('#formdetailtambahajaxpem').form('submit',{  
                success:function(data){  
					if(data == 'Insert' || data == 'Update'){
						//setTimeout(function(){ $('#modalpekerjaan').modal('hide'); $("#modalpekerjaan").form('clear'); window.location=location.href;}, 1000);
						  var xxinstid = $('#xxinstid').val();
						  $('#modaldetailtindakandua').window('close');
						$('#tabel_getdapatpemeriksaan').datagrid({
							url:'<?=@base_url($this->u1.'/jsondatatindakandetpem')?>/'+xxinstid,
						});
					}
					else {
						$.messager.alert('Informasi', data, 'info');
					}
				}  
            }); 
		}
	</script>