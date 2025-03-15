<div class="easyui-layout" data-options="fit:true" id="databanpakets_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="databanpakets_table1"  url="<?=@base_url($this->u1.'/jsondatabanpakets')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id_paket" sortOrder="ASC" toolbar="#databanpakets_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'kd_paket'" width="100" sortable="true">Kode</th>
							<th data-options="field:'nm_paket'" width="100" sortable="true">Paket</th>
							<th data-options="field:'autool'" width="20" sortable="true">Online</th>
							<th data-options="field:'blstimg'" width="100" sortable="true">Gambar</th>
							
						</tr>
					</thead>
				</table>
				<div id="databanpakets_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Paket',searcher:databanpaketscaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#databanpakets_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:400px;background:#eeffff;">
			<form method="POST" id="databanpakets_form1" action="javascript:void(0)" enctype="multipart/form-data">
				<div id="databanpakets_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="databanpakets_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="databanpaketshidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databanpakets_refresh()"><b>Refresh</b></a>
				</div>
				<div id="databanpaketshidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databanpakets_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databanpakets_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function databanpakets_refresh(){
			$('#databanpaketshidedua').hide();
			$('#databanpaketshidesatu').show();
			$('#databanpakets_table1').datagrid('reload');
			$('#databanpakets_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdatabanpakets')?>',
			});
		}
		$('#databanpaketshidedua').hide();
		$('#databanpakets_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdatabanpakets')?>',
		});   
		$('#databanpakets_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_paket;
				$('#databanpaketshidesatu').hide();
				$('#databanpaketshidedua').show();
				$('#databanpakets_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdatabanpakets')?>/'+id,
				});  
			}  
		}); 
		function databanpakets_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data', function(r) {
				if (r){
					console.log("submit event");
					var a = new FormData(document.getElementById("databanpakets_form1"));
					a.append("label", "WEBUPLOAD");
					$.ajax({
						url: "<?=@is_iplocalserverandroid()?>/wsrest/loadapi/simpanbanpaketsapp", 
						crossDomain: true,
						type: "POST",             
						data: a,
						contentType: false,       
						cache: false,             
						processData:false, 
						enctype: 'multipart/form-data',
						success: function(responseData, textStatus, jqXHR) {
							if(responseData == "simpan"){
								databanpakets_refresh();
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
        function databanpaketscaridata(value){
			$('#databanpakets_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		
		$('#databanpakets_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_banpakets == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		}); 

		function rubahstatautopaketpas(idp){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/rubahstatautopaketpas/')?>", {
				idp:idp,
			}, function(response){	
				
			});
		}
	</script>