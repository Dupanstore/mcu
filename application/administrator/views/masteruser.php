<div class="easyui-layout" data-options="fit:true" id="datauser_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="datauser_table1"  url="<?=@base_url($this->u1.'/jsondatauser')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="username" sortOrder="ASC" toolbar="#datauser_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'username'" width="30" sortable="true">Username</th>
							<th data-options="field:'nmlengkap'" width="30" sortable="true">Nama Lengkap</th>
							<th data-options="field:'email'" width="30" sortable="true">Email</th>
							<th data-options="field:'no_hp'" width="30" sortable="true">No HP</th>
							<th data-options="field:'nm_ins'" width="30" sortable="true">Level</th>
							<th data-options="field:'nip_nik'" width="30" sortable="true">NIK</th>
						</tr>
					</thead>
				</table>
				<div id="datauser_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
						<a href="javascript:void(0)" data-options="iconCls:'icon-edit'" class="easyui-linkbutton" onclick="datausergantipass()"><b>Ganti Password</b></a>
						<a href="javascript:void(0)" data-options="iconCls:'icon-add'" class="easyui-linkbutton" onclick="datauseruserbersama()"><b>User Bersama</b></a>
						<select  class="easyui-combobox" id="get_type_user" style="width:20%">
						<option value="Semua">Semua Type</option>
						<?php
						//ambil kodenya yaaa
						$this->db->order_by("nm_ins", "ASC");
						$sggd = $this->db->get("tb_instalasi");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
					?>
						<option value="<?=@$va->id_ins?>"><?=@$va->nm_ins?></option>
					<?php } ?>
						</select>
							<input class="easyui-searchbox" id="get_type_cari" data-options="prompt:'Masukkan Nama User',searcher:datajawatancaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datauser_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="datauser_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatedatauser')?>">
				<div id="datauser_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="datauser_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="datauserhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datauser_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datauser_refresh()"><b>Refresh</b></a>
				</div>
				<div id="datauserhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="datauser_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="datauser_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="datauser_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<div id="modalpassword" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modalpassword_toolbar" collapsible="false" class="easyui-window" title="" style="width:500px;height:170px;padding:5px;background:#ffffff;">
    </div>
	<div id="modalpassword_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpangantipass()"><b>Ganti Password</b></a>
			</div>
		</div>
	
	<div id="modalpenggunabersama" modal="true" closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" footer="#modalpenggunabersama_toolbar"  class="easyui-window" title="" style="width:800px;height:400px;padding:5px;background:#ffffff;">
		<form method="POST" id="formpenggunabersama" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpenggunabersama')?>">
		<input type="hidden" id="idutama" name="idutama" value="">
		<table class="easyui-datagrid" id="penggunabersama_table1" 
				   data-options="rownumbers:true,fitColumns:true" sortName="username" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'centang'" width="1" sortable="true"></th>
							<th data-options="field:'username'" width="30" sortable="true">Username</th>
							<th data-options="field:'nmlengkap'" width="30" sortable="true">Nama Lengkap</th>
							<th data-options="field:'email'" width="30" sortable="true">Email</th>
							<th data-options="field:'no_hp'" width="30" sortable="true">No HP</th>
							<th data-options="field:'nm_ins'" width="30" sortable="true">Level</th>
						</tr>
					</thead>
				</table>
			</form>
		
	</div>
	<div id="modalpenggunabersama_toolbar" style="padding:4px;">
			<div style="text-align:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanpenggunabersama()"><b>Simpan Perubahan</b></a>
			</div>
		</div>
	
	<script type="text/javascript">
		function datausergantipass(){
			var row = $('#datauser_table1').datagrid('getSelected');
            if (row){
                $('#modalpassword').window('open');
				$('#modalpassword').panel({
					title: 'Ganti Password - '+row.username,
					href:'<?=@base_url($this->u1.'/ajaxdatapass')?>/'+row.id_user,
				});
            }
		}
		function datauser_refresh(){
			$('#datauserhidedua').hide();
			$('#datauserhidesatu').show();
			$('#datauser_table1').datagrid('reload');
			$('#datauser_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatauser')?>',
			});
		}
		function datauseruserbersama(){
			var row = $('#datauser_table1').datagrid('getSelected');
            if (row){
                $('#modalpenggunabersama').window('open');
				$('#modalpenggunabersama').panel({
					title: 'Pengguna Bersama - '+row.username,
				});
				$('#idutama').val(row.id_user);
				//nah sekarang buat url untuk tabelnya
				    $('#penggunabersama_table1').datagrid({
						url:'<?=@base_url($this->u1.'/jsonpenggunabersama')?>/'+row.id_user,
					});
            }
		}
		$('#datauserhidedua').hide();
		$('#datauser_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatauser')?>',
		});   
		$('#datauser_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_user;
				$('#datauserhidesatu').hide();
				$('#datauserhidedua').show();
				$('#datauser_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatauser')?>/'+id,
				});  
			}  
		}); 
		function datauser_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data user', function(r) {
				if (r){
					$('#datauser_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								datauser_refresh();
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function simpangantipass(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan mengganti password', function(r) {
				if (r){
					$('#formgantipassword').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#modalpassword').window('close');
								$.messager.alert('Informasi', 'Password berhasil dirubah', 'info');
								datauser_refresh();
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function simpanpenggunabersama(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan pengguna bersama', function(r) {
				if (r){
					$('#formpenggunabersama').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#modalpenggunabersama').window('close');
								$.messager.alert('Informasi', 'Perubahan berhasil disimpan', 'info');
								datauser_refresh();
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
       function datajawatancaridata(){
			var value = $('#get_type_cari').textbox('getValue');
			var ins = $('#get_type_user').combobox('getValue');
			$('#datauser_table1').datagrid('load',{  
				cari: value, ins:ins,
			}); 
        }
		$('#get_type_user').combobox({
			    valueField:'id',
				textField:'text',
				onSelect: function(rec){
					datajawatancaridata();
				}
		});
		function datauser_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data user', function(r) {
				if (r){
					var id = $('#id_user').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatauser/')?>", {
						id:id,
					}, function(response){	
						datauser_refresh();
					});
				}  
			}); 	
		}
		$('#datauser_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_user == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>