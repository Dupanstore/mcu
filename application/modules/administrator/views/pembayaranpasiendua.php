<div class="easyui-layout" data-options="fit:true" id="pembayaranpasiendua_layout1">
        <div data-options="region:'center',iconCls:'icon-ok',footer:'#datadaftar_panel1_toolbar'" title="" style="background:#F2F5F7;">
            <table class="easyui-datagrid" id="tbpmebyrnpasdua"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tbpmebyrnpasdua_toolbar">
					<thead>
						<tr>
							<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIK</th>
							<th data-options="field:'nm_pas'" width="40" sortable="true">Nama</th>
							<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
						</tr>
					</thead>
				</table>
				<div id="tbpmebyrnpasdua_toolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
						<table style="width:60%">
							<tr>
								<td style="width:40%">
									<input class="easyui-datebox" type="text" id="filter_tanggalcari" value="<?=@date("m/d/Y")?>" style="width:100%;">
								</td style="width:60%">
								<td><input id="filter_keyworddua" class="easyui-searchbox" data-options="prompt:'Masukkan Nama, NIK, Alamat dll ',searcher:tableutamapasiencaridata" style="width:100%"></input></td>
							</tr>
						</table>	
				</div>
        </div>
		<div data-options="region:'east',split:true,iconCls:'icon-lock'" title="Pembayaran Pasien" style="width:30%;background:#CCDCEC;">
			<form method="POST" id="pembayaranpasienduakiri_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatepembayaranpasienduakiri')?>">
				<div id="pembayaranpasienduakiri_panel1" class="easyui-panel" title="">	
				</div>
			</form>					
		</div>
    </div>
	<script type="text/javascript">
	
		$('#tbpmebyrnpasdua').datagrid({  
			onSelect:function(index,row){  
				var id = row.id_reg;
				$('#pembayaranpasienduakiri_panel1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpembayaranpasienduapas')?>/'+id,
				});  
			}  
		}); 
		
		$('#filter_tanggalcari').datebox({
			onSelect: function(date){
				filterdatapendaftarans();
			}
		});
		$('#tbpmebyrnpasdua').datagrid({
			url: '<?=@base_url($this->u1.'/jsonpembayaranpasdua')?>/?filter_tanggalcari=<?=@date('m/d/Y')?>',
		});
		function filterdatapendaftarans(){
			var filter_keyword =  $('#filter_tanggalcari').datebox('getValue');
			$('#tbpmebyrnpasdua').datagrid({
				url: '<?=@base_url($this->u1.'/jsonpembayaranpasdua')?>/?filter_tanggalcari='+filter_keyword,
			});
		}
		function tableutamapasiencaridata(value){
			$('#tbpmebyrnpasdua').datagrid('load',{  
				cari: value,
			}); 
		}
		
		
		function simpanpembayaranpasien(id){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan pembayaran', function(r) {
				if (r){
					$('#pembayaranpasienduakiri_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#pembayaranpasienduakiri_panel1').panel({
									href:'<?=@base_url($this->u1.'/ajaxpembayaranpasienduapas')?>/'+id,
								});
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		
		
		function batalbayarpasien(kodereg, idregs){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan membatalkan pembayaran', function(r) {
				if (r){
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/batalbayarpasien')?>", {
						id:kodereg,
					}, function(response){
						$('#pembayaranpasienduakiri_panel1').panel({
							href:'<?=@base_url($this->u1.'/ajaxpembayaranpasienduapas')?>/'+idregs,
						});
						
					});
				}
			});
		}
		
		function cetakkwitansibayar(kode){
			/*$.post("<?=@base_url($this->u1.'/cetakkwitansipasien')?>/"+kode, {
			}, function(response){
					$('#framepembayaran').html(response);		
			});*/
			window.open('<?=@base_url($this->u1.'/cetakkwitansipasienframe')?>/'+kode);
		}
		
		
		setTimeout(function(){
		   $('#filter_keyworddua').textbox('textbox').focus().select();
		},20);
	</script>