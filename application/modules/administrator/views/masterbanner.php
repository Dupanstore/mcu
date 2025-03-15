<div class="easyui-layout" data-options="fit:true" id="databanner_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="databanner_table1"  url="<?=@base_url($this->u1.'/jsondatabanner')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="bimg" sortOrder="ASC" toolbar="#databanner_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'blstimg'" width="100" sortable="true">Nama</th>
							<th data-options="field:'pidpol'" width="100" sortable="true">Posisi</th>
						</tr>
					</thead>
				</table>
				<div id="databanner_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama banner',searcher:databannercaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#databanner_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="databanner_form1" action="javascript:void(0)" enctype="multipart/form-data">
				<div id="databanner_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="databanner_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="databannerhidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databanner_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databanner_refresh()"><b>Refresh</b></a>
				</div>
				<div id="databannerhidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databanner_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="databanner_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databanner_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function databanner_refresh(){
			$('#databannerhidedua').hide();
			$('#databannerhidesatu').show();
			$('#databanner_table1').datagrid('reload');
			$('#databanner_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatabanner')?>',
			});
		}
		$('#databannerhidedua').hide();
		$('#databanner_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatabanner')?>',
		});   
		$('#databanner_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id;
				$('#databannerhidesatu').hide();
				$('#databannerhidedua').show();
				$('#databanner_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatabanner')?>/'+id,
				});  
			}  
		}); 
		function databanner_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data banner', function(r) {
				if (r){
					console.log("submit event");
					var a = new FormData(document.getElementById("databanner_form1"));
					a.append("label", "WEBUPLOAD");
					$.ajax({
						url: "<?=@is_iplocalserverandroid()?>/wsrest/loadapi/simpanbannerapp", 
						crossDomain: true,
						type: "POST",             
						data: a,
						contentType: false,       
						cache: false,             
						processData:false, 
						enctype: 'multipart/form-data',
						success: function(responseData, textStatus, jqXHR) {
							if(responseData == "simpan"){
								databanner_refresh();
							}else{
								$.messager.alert('Informasi', responseData, 'info');
							}
						},
						error: function (responseData, textStatus, errorThrown) {
							alert(textStatus);
						}
					});
				}
			});
		}
        function databannercaridata(value){
			$('#databanner_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function databanner_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data banner', function(r) {
				if (r){
					var id = $('#id_banner').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdatabanner/')?>", {
						id:id,
					}, function(response){	
						databanner_refresh();
					});
				}  
			}); 	
		}
		$('#databanner_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_banner == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>