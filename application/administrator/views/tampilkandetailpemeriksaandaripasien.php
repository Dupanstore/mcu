<table class="easyui-datagrid" id="datapolipemeriksaantabel"  url="<?=@base_url($this->u1.'/jsonsemuapolipenu')?>"
				   data-options="singleSelect:true,fit:true,rownumbers:true,fitColumns:true" sortName="nm_ins" sortOrder="ASC">
					<thead>
						<tr>
							<th data-options="field:'kd_ins'" width="50" sortable="true">Kode</th>
							<th data-options="field:'nm_ins'" width="100" sortable="true">Nama</th>
						</tr>
					</thead>
				</table>