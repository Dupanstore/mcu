<div class="easyui-layout" data-options="fit:true" id="datadinas_layout1">
        <div data-options="region:'center',iconCls:'icon-ok',footer:'#datadaftar_panel1_toolbar'" title="" style="background:#F2F5F7;">
            <div class="easyui-layout" data-options="fit:true">
				<form method="POST" id="databayar_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatependaftarankonsul')?>">
					<div id="panel_daftar1" class="easyui-panel" title="">	
					</div>
				</form>
            </div>
        </div>
		<div id="datadaftar_panel1_toolbar" style="padding:5px;background:#CEDFF3;">
			<div style="text-align:left;">
				<div align="center">
					<a href="javascript:void(0)" data-options="iconCls:'icon-save'" class="easyui-linkbutton" onclick="databayar_simpandata()" style="margin-right:10px;"><b id="simpandaftar">Simpan Pendaftaran</b></a>
					<a href="javascript:void(0)" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" onclick="reloadpendaftaran()" ><b id="resetform">Reset Form</b></a>
				</div>
			</div>
		</div>
		<div data-options="region:'east',split:true,iconCls:'icon-lock'" title="" style="width:35%;background:#CCDCEC;">
				<table class="easyui-datagrid" id="tableregisterpas"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tableregisterpas_toolbar">
					<thead>
						<tr>
							<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIK</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
							<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
							<th data-options="field:'editpasya'" width="5"></th>
							<th data-options="field:'printpasya'" width="5"></th>
						</tr>
					</thead>
				</table>
				<div id="tableregisterpas_toolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
						<table style="width:99%">
							<tr>
								<td>
									<input class="easyui-datebox" type="text" id="konsul_tanggalcari" value="<?=@date("m/d/Y")?>" style="width:100%;">
								</td>
								<td><button style="cursor:pointer" type="button" onclick="filtercetakdata()" style="width:100%">Cetak-Registrasi</button></td>
							</tr>
							<tr>
								<td colspan="2">	
									<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama, NIK, Alamat dll ',searcher:tableutamapasiencaridata" style="width:100%"></input>
									
								</td>
							</tr>
						</table>	
				</div>				
		</div>
    </div>
	<div id="modalcaripasien" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Data Pasien" style="width:1000px;height:600px;background:#ffffff;">
				<table class="easyui-datagrid" id="tablemodalcaripasien"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_reg" sortOrder="ASC" toolbar="#tablemodalcaripasien_toolbar">
					<thead>
						<tr>
							<th data-options="field:'no_reg'" width="30" sortable="true">No REG</th>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIK</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
							<th data-options="field:'no_tlp_pas'" width="30" sortable="true">No Telp</th>
							<th data-options="field:'alamat_pas'" width="30" sortable="true">Alamat</th>
						</tr>
					</thead>
				</table>
				<div id="tablemodalcaripasien_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="pilihpasienmcu()"><b>Pilih Pasien</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama, NIK, Alamat dll ',searcher:tablemodalcaripasiencaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
	</div>
	<div id="modalcarireferensi" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Pencarian Referensi Registrasi" style="width:1000px;height:600px;background:#ffffff;">
				<table class="easyui-datagrid" id="tablemodalcarireferensi"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="id_reg" sortOrder="DESC" toolbar="#tablemodalcarireferensi_toolbar">
					<thead>
						<tr>
							<th data-options="field:'tgl_awal_reg_new'" width="30" sortable="true">Tanggal Registrasi</th>
							<th data-options="field:'nm_paket'" width="30" sortable="true">Paket</th>
							<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
							<th data-options="field:'no_reg'" width="30" sortable="true">No REG</th>
							<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIK</th>
							<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
							<th data-options="field:'no_tlp_pas'" width="30" sortable="true">No Telp</th>
							<th data-options="field:'alamat_pas'" width="30" sortable="true">Alamat</th>
						</tr>
					</thead>
				</table>
				<div id="tablemodalcarireferensi_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="pilihpasienreferensi()"><b>Pilih Referensi Registrasi</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama, NIK, Alamat dll ',searcher:tablemodalcaripasiencaridatareferensi" style="width:300px"></input>
						</div>
					</div>
				</div>
	</div>
	<div id="modaleditkomponen" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Edit Komponen Pemeriksaan" style="width:800px;height:400px;background:#ffffff;">
		<table class="easyui-datagrid" id="tabelrubahkomponenharga"
				  data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" toolbar="#databayar_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'centang'" width="5" sortable="true"></th>
							<th data-options="field:'new_kodepemeriksaan'" width="10" sortable="true">Kode</th>
							<th data-options="field:'new_namapemeriksaan'" width="20" sortable="true">Pemeriksaan</th>
							<th data-options="field:'new_detailpemeriksaan'" width="40" sortable="true">Nama Detail Pemeriksaan</th>
						</tr>
					</thead>
				</table>
				<div id="databayar_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="lihatkomponensaya('tampil')"><b>Daftar Pemeriksaan Tidak diikutkan</b></a>
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="lihatkomponensaya('clear')"><b>Clear</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Pemeriksaan, kode atau detail',searcher:caridetailpemeriksaan" style="width:300px"></input>
						</div>
					</div>
				</div>
	</div>
	
	
	<div id="modalpakaitemplate" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Gunakan Template" style="width:800px;height:400px;background:#ffffff;">
		<table class="easyui-datagrid" id="tabelpemakaiantemplate"
				  data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true,nowrap:false" sortName="idc" sortOrder="ASC" toolbar="#datatemplate_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'nama_pkt'" width="10" sortable="true">Paket</th>
							<th data-options="field:'isi_pkt'" width="70" sortable="true">Detail</th>
						</tr>
					</thead>
				</table>
				<div id="datatemplate_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="pilihpaketkonsulok()"><b>Pilih</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama /Isi, kode atau detail',searcher:caridetailtemplatenya" style="width:300px"></input>
						</div>
					</div>
				</div>
	</div>
	
	
	<div id="framependaftaran"></div>
	<div id="modalpendaftaranfilterdata" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:600px;height:400px;padding:5px;background:#ffffff;">
    </div>
	<script type="text/javascript">
	
		$('#konsul_tanggalcari').datebox({
				onSelect: function(date){
					tableutamapasiencaridata();
				}
			});
			
			
		$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsondataregistrasikonsul')?>/?filter_tanggalcari=<?=@date('m/d/Y')?>',
		});
		$('#panel_daftar1').panel({
				href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>',
			});
		function reloadpendaftaran(){
			$('#simpandaftar').html('Simpan Pendaftaran');
			$('#resetform').html('Reset Form');
			//$('#tableregisterpas').datagrid('reload');
			$('#panel_daftar1').panel({
				href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>',
			});
		}
		
		function caridatapasienmcu(){
			$('#modalcaripasien').window('open');
			$('#tablemodalcaripasien').datagrid({
				url:'<?=@base_url($this->u1.'/jsoncaridatapasien')?>/',
			});		
		}
		function caridatareferensi(){
			$('#modalcarireferensi').window('open');
			$('#tablemodalcarireferensi').datagrid({
				url:'<?=@base_url($this->u1.'/jsoncaridatareferensi')?>/',
			});		
		}
		function tablemodalcaripasiencaridata(value){
			$('#tablemodalcaripasien').datagrid('load',{  
				cari: value,
			});
		}
		function tablemodalcaripasiencaridatareferensi(value){
			$('#tablemodalcarireferensi').datagrid('load',{  
				cari: value,
			});
		}
		function pilihpasienmcu(){
			var row = $('#tablemodalcaripasien').datagrid('getSelected');  
			if (row){  
				var id = row.id_pas;
				$('#modalcaripasien').window('close');	
				$('#panel_daftar1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>/'+id,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
		function pilihpasienreferensi(){
			var row = $('#tablemodalcarireferensi').datagrid('getSelected');  
			if (row){  
				var id = row.id_pas;
				var ref = row.kode_transaksi;
				$('#modalcarireferensi').window('close');	
				$('#panel_daftar1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>/'+id+'/?referensi='+ref,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih Referensi Registrasi terlebih dahulu', 'info');
			}
		}
		function editkomponenbiaya(kode){
			var hh = $('#list_pemeriksaan').combobox('getValues');
			if (hh != ""){  
				$('#modaleditkomponen').window('open');	
				$('#tabelrubahkomponenharga').datagrid({
					url:'<?=@base_url($this->u1.'/jsonkomponenbiayakonsul')?>/?idpaket='+hh+'&kodetransaksi='+kode,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih minimal 1 pemeriksaan terlebih dahulu', 'info');
			}
		}
		function pakaitemplate(kode){
			var hh = $('#list_pemeriksaan').combobox('getValues');
			if (hh != ""){  
				$.messager.alert('Informasi', 'Untuk menggunakan template, bersihkan dahulu item pemeriksaan', 'info');
			}else {
				$('#modalpakaitemplate').window('open');	
				$('#tabelpemakaiantemplate').datagrid({
					url:'<?=@base_url($this->u1.'/jsondatapaketkonsul')?>/?idpaket='+hh+'&kodetransaksi='+kode,
				});
				
			}
		}
		function caridetailpemeriksaan(value){
			$('#tabelrubahkomponenharga').datagrid('load',{  
				cari: value,
			}); 
		}
		function masukkandaftarfilter(kdtransaksi, idtind, idins, idpem){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatefilterkonsul')?>", {
							idins:idins, kdtransaksi:kdtransaksi, idtind:idtind, idpem:idpem,
						}, function(response){
							//$.messager.alert('Informasi', response, 'info');
						});
		}
		function lihatkomponensaya(ket){
			$('#tabelrubahkomponenharga').datagrid('load',{  
				tampilkanfilter: ket,
			}); 
		}
		function pilihpaketkonsulok(){
			var row = $('#tabelpemakaiantemplate').datagrid('getSelected');  
			if (row){  
				$('#list_pemeriksaan').combobox('setValues', row.idnf);
				$('#modalpakaitemplate').window('close');	
			}else {
				$.messager.alert('Informasi', 'Pilih Referensi paket Terlebih Dahulu..', 'info');
			}
		}
		
		function cobatambahkanbiaya(idpaket, kdtransaksi, idtind, idins){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpantambahkanbiaya')?>", {
							idins:idins, idpaket:idpaket, kdtransaksi:kdtransaksi, idtind:idtind,
						}, function(response){
							$.messager.alert('Informasi', response, 'info');
						});
		}
		function databayar_simpandata(){
			$.messager.confirm('Konfirmasi', 'Apakah anda yakin', function(r) {
				if (r){
					$('#databayar_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$('#panel_daftar1').panel({
									href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>',
								});
								$('#simpandaftar').html('Simpan Pendaftaran');
								$('#resetform').html('Reset Form');
								$('#tableregisterpas').datagrid('reload');
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		function editdatapas(id, reg){
			$('#simpandaftar').html('Update Registrasi Pasien');
				$('#resetform').html('Batal');
				$('#panel_daftar1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>/'+id+'/?id_reg='+reg,
				});
		}
		function hapusregistrasipas(id, file, kod){
			$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan menghapus registrasi pasien '+file, function(r) {
				if (r){
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapusregistrasipasien')?>", {
							id:id, file:file, kod:kod,
						}, function(response){
							$('#tableregisterpas').datagrid('reload');
							reloadpendaftaran();
							$.messager.alert('Informasi', 'Registrasi Berhasil dihapus', 'info');
						});
				}
			});
		}
		function printdatapas(id, reg){
			$.post("<?=@base_url($this->u1.'/cetakpemeriksaankonsul')?>/?id_reg="+reg, {
			}, function(response){
					$('#framependaftaran').html(response);		
			});
			//window.open("<?=@base_url($this->u1.'/cetakpemeriksaankonsul')?>/?id_reg="+reg);
		}
		function filtercetakdata(){
			$('#modalpendaftaranfilterdata').window('open');
				$('#modalpendaftaranfilterdata').panel({
					title: 'Filter & Cetak Data Registrasi',
					href:'<?=@base_url($this->u1.'/ajaxfiltercetakdataregkonsul')?>',
				});
		}
		function importdataexceldua(dek){
			var a = $('#dataformcetakmcu').serialize();
			window.open('<?=@base_url('administrator/cetakdataexcelmcukonsul')?>/?typecetak='+dek+'&'+a, "myWindow", "width=800px,height=auto,scrollbars=1");
			/*$('#dataformcetakmcu').form('submit', {  
						success:function(data){
							
							//$.messager.alert('Informasi', data, 'info');
							$('#framependaftaran').html(data);
						}  
					}); 
			*/
		}
		function tableutamapasiencaridata(){
			var filter_keyword =  $('#konsul_tanggalcari').datebox('getValue');
			//alert(filter_keyword);
			$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsondataregistrasikonsul')?>/?filter_tanggalcari='+filter_keyword,
			});
			reloadpendaftaran();
		}
		function printdatapas(id, reg){
			/*$.post("<?=@base_url($this->u1.'/cetakpemeriksaankonsul')?>/?id_reg="+reg, {
			}, function(response){
					$('#framependaftaran').html(response);		
			});
			*/
			window.open("<?=@base_url($this->u1.'/cetakpemeriksaankonsulframe')?>/?id_reg="+reg);
		}
		
		
		function caridetailtemplatenya(value){
			$('#tabelpemakaiantemplate').datagrid('load',{  
				cari: value,
			}); 
        }
	</script>