<div class="easyui-layout" data-options="fit:true">
                <table class="easyui-datagrid" id="tabel_inputkelainangigiodonto" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true" sortName="kelainan" sortOrder="ASC" toolbar="#inputkelainangigiodonto_table1_toolbar" url="<?=@base_url($this->u1.'/jsondapatkanisikelainangigiodonto/'.$this->u3)?>">
					<thead>
						<tr>
							<th data-options="field:'kodewarna'" width="5" sortable="true">Warna</th>
							<th data-options="field:'kelainan'" width="40" sortable="true">Kelainan</th>
						</tr>
					</thead>
				</table>
				<!--<div id="inputkelainangigiodonto_table1_toolbar" style="padding:5px;height:auto">   
					<div>
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save'" onclick="simpankelainangigiok('<?=@$this->u3?>')"><b>Simpan</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama kelainan',searcher:datakelianangigicaridata" style="width:300px"></input>
						</div>
					</div>
				</div>-->
            </div>
			<script type="text/javascript">
			function datakelianangigicaridata(value){
					$('#tabel_inputkelainangigiodonto').datagrid('load',{  
						cari: value,
					}); 
				}
				
			$('#tabel_inputkelainangigiodonto').datagrid({  
					onSelect:function(index,row){  
						var kelainan = row.kelainan;
						var warna = row.kode_kelainan;
						var idpem = row.id_pemeriksaan;
						var posisi = row.uritiga;
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpankelainangigiok/')?>", {
							idpem:idpem, posisi:posisi, kelainan:kelainan,warna:warna,idins:'<?=@$_GET['idins']?>', idtind:'<?=@$_GET['idtind']?>',kdtrans:'<?=@$_GET['kdtrans']?>',idgroup:'<?=@$_GET['idgroup']?>',idpaket:'<?=@$_GET['idpaket']?>',
						}, function(response){	
							$('#modalodontogram').window('close');
							tampilkanodontogramok();
							
						});
					}  
			}); 
			</script>