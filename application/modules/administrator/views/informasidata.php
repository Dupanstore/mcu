<div class="easyui-layout" data-options="fit:true" id="databerita_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="databerita_table1"  url="<?=@base_url($this->u1.'/jsondataberita')?>"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id" sortOrder="DESC" toolbar="#databerita_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'icmkat'" width="100" sortable="true">Kategori</th>
							<th data-options="field:'sname'" width="100" sortable="true">Tanggal</th>
							<th data-options="field:'pname'" width="100" sortable="true">Judul</th>
							<th data-options="field:'psdesc'" width="100" sortable="true">Keterangan</th>
							<th data-options="field:'blstimg'" width="100" sortable="true">Gambar</th>
						</tr>
					</thead>
				</table>
				<div id="databerita_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Keyword',searcher:databeritacaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#databerita_panel1_toolbar',iconCls:'icon-lock'" title="Olah Data" style="width:40%;background:#eeffff;">
			<form method="POST" id="databerita_form1" action="javascript:void(0)" enctype="multipart/form-data">
				<div id="databerita_panel1" class="easyui-panel" title="">	
				</div>
			</form>
		</div>
		<div id="databerita_panel1_toolbar" style="padding:10px;">
			<div style="text-align:left;">
				<div id="databeritahidesatu">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databerita_simpandata()"><b>Simpan Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databerita_refresh()"><b>Refresh</b></a>
				</div>
				<div id="databeritahidedua">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databerita_simpandata()"><b>Update Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-cancel'" class="easyui-linkbutton" onclick="databerita_hapus()"><b>Hapus Data</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="databerita_refresh()"><b>Batal</b></a>
				</div>
			</div>
		</div>
    </div>
	<script type="text/javascript">
		function databerita_refresh(){
			$('#databeritahidedua').hide();
			$('#databeritahidesatu').show();
			$('#databerita_table1').datagrid('reload');
			$('#databerita_panel1').panel({
				href:'<?=@base_url($this->u1.'/ajaxdataberita')?>',
			});
		}
		$('#databeritahidedua').hide();
		$('#databerita_panel1').panel({
			href:'<?=@base_url($this->u1.'/ajaxdataberita')?>',
		});   
		$('#databerita_table1').datagrid({  
			onSelect:function(index,row){  
				var id = row.id;
				$('#databeritahidesatu').hide();
				$('#databeritahidedua').show();
				$('#databerita_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxdataberita')?>/'+id,
				});  
			}  
		}); 
		function databerita_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data Informasi', function(r) {
				if (r){
					console.log("submit event");
					var a = new FormData(document.getElementById("databerita_form1"));
					a.append("label", "WEBUPLOAD");
					$.ajax({
						url: "<?=@is_iplocalserverandroid()?>/wsrest/loadapi/simpanberitaapp", 
						crossDomain: true,
						type: "POST",             
						data: a,
						contentType: false,       
						cache: false,             
						processData:false, 
						enctype: 'multipart/form-data',
						success: function(responseData, textStatus, jqXHR) {
							if(responseData == "simpan"){
								databerita_refresh();
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
        function databeritacaridata(value){
			$('#databerita_table1').datagrid('load',{  
				cari: value,
			}); 
        }
		function databerita_hapus(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data Informasi', function(r) {
				if (r){
					var id = $('#id_berita').val();
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusdataberita/')?>", {
						id:id,
					}, function(response){	
						databerita_refresh();
					});
				}  
			}); 	
		}
		$('#databerita_table1').datagrid({  
			rowStyler:function(index,row){  
				if (row.aktif_banner == "N"){  
					return 'background-color:red;color:blue;font-weight:bold;'; 
				}  
			}  
		});  
	</script>