<div class="easyui-layout" data-options="fit:true" id="datadinas_layout1">
        <div data-options="region:'center',iconCls:'icon-ok',footer:'#datadaftar_panel1_toolbar'" title="" style="background:#F2F5F7;">
            <div class="easyui-layout" data-options="fit:true">
				<form method="POST" id="dataregistrasi_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatependaftaranmcu')?>">
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
		<div data-options="region:'east',split:true,iconCls:'icon-lock'" title="" style="width:30%;background:#CCDCEC;">
				<table class="easyui-datagrid" id="tableregisterpas"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="tgl_awal_reg" sortOrder="DESC" toolbar="#tableregisterpas_toolbar">
					<thead>
						<tr>
							<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
						<!--	<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIK</th>-->
							<th data-options="field:'nm_pas'" width="40" sortable="true">Nama</th>
							<!--<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>-->
							<th data-options="field:'editpasya'" width="7"></th>
							<th data-options="field:'cetakkartu'" width="7"></th>
							<th data-options="field:'printpasya'" width="7"></th>
						</tr>
					</thead>
				</table>
				<div id="tableregisterpas_toolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
						<table style="width:99%">
							<tr>
								<td>
									<input class="easyui-datebox" type="text" id="filter_tanggalcari" value="<?=@date("m/d/Y")?>" style="width:100%;">
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
	<div id="modaleditkomponen" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Edit Komponen Paket" style="width:800px;height:400px;background:#ffffff;">
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
	<div id="modaltambahbiaya" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false"  collapsible="false" class="easyui-window" title="Pemeriksaan Tambahan" style="width:800px;height:400px;background:#ffffff;">
		<table class="easyui-datagrid" id="tabel_grouppemeriksaan"
				   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="kd_tind" sortOrder="ASC" toolbar="#datakondisi_table1_toolbar">
					<thead>
						<tr>
							<th data-options="field:'centangdatanyaya'" width="8" sortable="true"></th>
							<th data-options="field:'nm_grouptindakan'" width="30" sortable="true">Group</th>
							<th data-options="field:'kd_tind'" width="20" sortable="true">Kode</th>
							<th data-options="field:'nm_tind'" width="40" sortable="true">Nama</th>
							<th data-options="field:'js_dok_tind',align:'right'" width="40" sortable="true">Jasa Dokter</th>
							<th data-options="field:'js_rs_tind',align:'right'" width="40" sortable="true">Harga Pemeriksaan</th>	
						</tr>
					</thead>
				</table>
				<div id="datakondisi_table1_toolbar" style="padding:5px;height:auto">   
					<div> 
						<div align="right" style="margin:0 10px 0 0;">
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="lihattambahanbiayasaya('tampil')"><b>Tambahan Biaya Saya</b></a>
							<a href="javascript:void(0)" class="easyui-linkbutton" onclick="lihattambahanbiayasaya('clear')"><b>Clear</b></a>
							<input class="easyui-searchbox" data-options="prompt:'Masukkan Nama Pemeriksaan',searcher:datakondisicaridata" style="width:300px"></input>
						</div>
					</div>
				</div>
	</div>
	<div id="framependaftaran"></div>
	<div id="modalpendaftaranfilterdata" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:600px;height:400px;padding:5px;background:#ffffff;">
    </div>
	<script type="text/javascript">
			$('#filter_tanggalcari').datebox({
				onSelect: function(date){
					filterdatapendaftarans();
				}
			});
		
		
			$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsondataregistrasiharian')?>/?filter_tanggalcari=<?=@date('m/d/Y')?>',
			});
			$('#panel_daftar1').panel({
				href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>',
			});
		function reloadpendaftaran(){
			$('#simpandaftar').html('Simpan Pendaftaran');
			$('#resetform').html('Reset Form');
			$('#panel_daftar1').panel({
				href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>',
			});
		}
		
		function filterdatapendaftarans(){
			var filter_keyword =  $('#filter_tanggalcari').datebox('getValue');
			//alert(filter_keyword);
			$('#tableregisterpas').datagrid({
				url: '<?=@base_url($this->u1.'/jsondataregistrasiharian')?>/?filter_tanggalcari='+filter_keyword,
			});
			reloadpendaftaran();
		}
		 /*function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return (d<10?('0'+d):d)+'-'+(m<10?('0'+m):m)+'-'+y;
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[2],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[0],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }*/
		function caridatapasienmcu(){
			$('#modalcaripasien').window('open');
			$('#tablemodalcaripasien').datagrid({
				url:'<?=@base_url($this->u1.'/jsoncaridatapasien')?>/',
			});		
		}
		function tablemodalcaripasiencaridata(value){
			$('#tablemodalcaripasien').datagrid('load',{  
				cari: value,
			});
		}
		function pilihpasienmcu(){
			var row = $('#tablemodalcaripasien').datagrid('getSelected');  
			if (row){  
				var id = row.id_pas;
				$('#modalcaripasien').window('close');	
				$('#panel_daftar1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>/'+id,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih pasien terlebih dahulu', 'info');
			}
		}
		function editkomponenbiaya(kode){
			var hh = $('#id_paket').combobox('getValue');
			if (hh != ""){  
				$('#modaleditkomponen').window('open');	
				$('#tabelrubahkomponenharga').datagrid({
					url:'<?=@base_url($this->u1.'/jsonkomponenbiayadaftar')?>/?idpaket='+hh+'&kodetransaksi='+kode,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
		}
		function caridetailpemeriksaan(value){
			$('#tabelrubahkomponenharga').datagrid('load',{  
				cari: value,
			}); 
		}
		function masukkandaftarfilter(idpaket, kdtransaksi, idtind, idins, idpem){
			$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatefiltermcu')?>", {
							idins:idins, idpaket:idpaket, kdtransaksi:kdtransaksi, idtind:idtind, idpem:idpem,
						}, function(response){
							//$.messager.alert('Informasi', response, 'info');
						});
		}
		function tambahbiayapaket(kode){
			var hh = $('#id_paket').combobox('getValue');
			if (hh != ""){  
				$('#modaltambahbiaya').window('open');
				$('#tabel_grouppemeriksaan').datagrid({
					url:'<?=@base_url($this->u1.'/jsontambahbiayapaket')?>/?idpaket='+hh+'&kodetransaksi='+kode,
				});
			}else {
				$.messager.alert('Informasi', 'Pilih paket terlebih dahulu', 'info');
			}
		}
		 function datakondisicaridata(value){
			$('#tabel_grouppemeriksaan').datagrid('load',{  
				cari: value,
			}); 
        }
		function lihatkomponensaya(ket){
			$('#tabelrubahkomponenharga').datagrid('load',{  
				tampilkanfilter: ket,
			}); 
		}
		function lihattambahanbiayasaya(ket){
			$('#tabel_grouppemeriksaan').datagrid('load',{  
				tampilkanfilter: ket,
			});  
		}
		function cobatambahkanbiaya(idpaket, kdtransaksi, idtind, idins){
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpantambahkanbiaya')?>", {
							idins:idins, idpaket:idpaket, kdtransaksi:kdtransaksi, idtind:idtind,
						}, function(response){
							//$.messager.alert('Informasi', response, 'info');
						});
		}
		function databayar_simpandata(){
			$.messager.confirm('Konfirmasi', 'Apakah anda yakin', function(r) {
				if (r){
					$('#dataregistrasi_form1').form('submit', { 
						success:function(data){  
							if(data == 'simpan'){
								$('#panel_daftar1').panel({
									href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>',
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
		function tableutamapasiencaridata(value){
			$('#tableregisterpas').datagrid('load',{  
				cari: value,
			}); 
		}
		function editdatapas(id, reg){
			$('#simpandaftar').html('Update Registrasi Pasien');
				$('#resetform').html('Batal');
				$('#panel_daftar1').panel({
					href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>/'+id+'/?id_reg='+reg,
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
		function lanjutkangantipaket(idpas, idreg, kod){
			//ambil idpaket dan cara bayar
			var id_paket   = $('#gantipaketsaya').val();
			var cara_bayar = $('#cara_bayar').val();
			$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan mengganti paket', function(r) {
				if (r){
					$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/gantipaketregistrasi')?>", {
							kode_transaksi:kod, idreg:idreg, idpas:idpas, id_paket:id_paket, cara_bayar:cara_bayar
						}, function(response){
							if(response == "simpan"){
								$('#panel_daftar1').panel({
									href:'<?=@base_url($this->u1.'/ajaxpendaftaranpasien')?>/'+idpas+'/?id_reg='+idreg,
								});
								$.messager.alert('Informasi', 'Perubahan paket berhasil diupdate', 'info');
							} else {
								$.messager.alert('Informasi', response, 'info');
							}
							
						});
				}
			});
		}
		function filtercetakdata(){
			$('#modalpendaftaranfilterdata').window('open');
				$('#modalpendaftaranfilterdata').panel({
					title: 'Filter & Cetak Data Registrasi',
					href:'<?=@base_url($this->u1.'/ajaxfiltercetakdatareg')?>',
				});
		}
		
		function cetakkartu(idpas, idreg){
			window.open('<?=@base_url($this->u1.'/cetakkartu')?>/'+idpas);
			
		}
		
		function printdatapas(id, reg){
			/*$.post("<?=@base_url($this->u1.'/cetakpemeriksaanpasien')?>/?id_reg="+reg, {
			}, function(response){
					$('#framependaftaran').html(response);		
			});
			*/
			window.open('<?=@base_url($this->u1.'/cetakpemeriksaanpasienframe/?id_reg=')?>'+reg);
		}
		function importdataexcel(dek){
			
			var a = $('#dataformcetakmcu').serialize();
			window.open('<?=@base_url('administrator/cetakdataexcelmcu')?>/?typecetak='+dek+'&'+a, "myWindow", "width=800px,height=auto,scrollbars=1");
		
		
			/*$('#dataformcetakmcu').form('submit', {  
						success:function(data){  
							//$.messager.alert('Informasi', data, 'info');
							$('#framependaftaran').html(data);
						}  
					}); 
				*/
		}
		
	</script>