<div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="tabel_grouppemeriksaansamain" data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_paket" sortOrder="ASC" toolbar="#tabel_grouppemeriksaansamain_getbarok" url="<?=@base_url($this->u1.'/jsondapattindakanmcudaripaketsamain/'.$this->u3)?>">
					<thead>
						<tr>
							<th data-options="field:'kd_paket'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_paket'" width="40" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="tabel_grouppemeriksaansamain_getbarok" style="padding:5px;height:auto">   
					<div>
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan kode, nama Paket',searcher:datapaketlainnyacaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
			<script type="text/javascript">
			function datapaketlainnyacaridata(value){
					$('#tabel_grouppemeriksaansamain').datagrid('load',{  
						cari: value,
					}); 
				}
			</script>