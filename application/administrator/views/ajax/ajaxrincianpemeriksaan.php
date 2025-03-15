<div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="tabel_grouppemeriksaan" data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_tind" sortOrder="ASC" toolbar="#tabel_grouppemeriksaan_gettoolbar" url="<?=@base_url($this->u1.'/jsondapattindakanmcudaripaket')?>">
					<thead>
						<tr>
							<th data-options="field:'nm_grouptindakan'" width="30" sortable="true">Group</th>
							<th data-options="field:'kd_tind'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_tind'" width="40" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>
				<div id="tabel_grouppemeriksaan_gettoolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<input class="easyui-searchbox" data-options="prompt:'Masukkan group, kode, nama Tindakan',searcher:datadetailpaketokcari" style="width:300px"></input>
						</div>
					</div>
				</div>
            </div>
			<script type="text/javascript">
			function datadetailpaketokcari(value){
					$('#tabel_grouppemeriksaan').datagrid('load',{  
						cari: value,
					}); 
				}
			</script>