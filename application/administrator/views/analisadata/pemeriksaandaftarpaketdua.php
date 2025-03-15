<div class="easyui-layout" data-options="fit:true" id="datapem_daftarpaket_hasilkelainan2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select  tb_paket.nm_paket, count(id_reg) as newkode from tb_register, tb_pasien, tb_paket ";
			$fghb .= " where tb_register.no_reg=tb_pasien.no_reg and tb_register.id_paket=tb_paket.id_paket ";
			if($_GET['id_cabang'] != "1"){
				$fghb .= " and  id_cabang='".$_GET['id_cabang']."' ";
			}
			if($_GET['id_unit'] != "1"){
				$fghb .= " and  id_unit='".$_GET['id_unit']."' ";
			}
			if(!empty($_GET['id_paket'])){
				$fghb .= " and   tb_register.id_paket='".$_GET['id_paket']."' ";
			}
			if(!empty($_GET['id_jenkel'])){
				$fghb .= " and jenkel_pas='".$_GET['id_jenkel']."' ";
			}
			$fghb .= " group by nm_paket order by nm_paket ASC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
			//print_r($xcvb);
		?>
       <table id="pem_daftarpaket_hasil_daftarpaket_tabel1" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="nm_daftarpaket" width="100">Hasil</th>
                <th field="jumlah_daftarpaket" width="20">Jumlah</th>
            </tr>                          
        </thead>                           
        <tbody>                            
            <?php
				if($xcvb){
					foreach($xcvb as $cvbs){
			?>
			<tr>
				<td><?=@$cvbs->nm_paket?></td>
				<td><div align="center"><?=@$cvbs->newkode?></div></td>
			</tr>
				<?php } ?>
			<?php } ?>
        </tbody>                           
    </table>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapem_daftarpaket_hasilkelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:65%;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatupem_daftarpaket_hasilkelainantampildata"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_filemcu" sortOrder="ASC" toolbar="#tabelsatupem_daftarpaket_hasilkelainantampildata_tolbar">
						<thead>
							<tr>
								<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'jenkel_pas'" width="20" sortable="true">Jenkel</th>
								<th data-options="field:'nm_jawatan'" width="40" sortable="true">Kesatuan/Perusahaan</th>
								<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
								<th data-options="field:'nm_paket'" width="40" sortable="true">Paket </th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatupem_daftarpaket_hasilkelainantampildata_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
						<table style="width:99%">
							<tr>
								<td width="50%"></td>
								<td>
									<input class="easyui-searchbox" data-options="prompt:'Masukkan No Urut, Nama, NIK, Alamat dll ',searcher:pencarianpasienkesehatankerjaya" style="width:100%"></input>
								</td>
							</tr>
						</table>
					</div>
		</div>
    </div>
	<script type="text/javascript">
		var a = $('#formfilteranalisa').serialize();
		$('#pem_daftarpaket_hasil_daftarpaket_tabel1').datagrid({  
				onSelect:function(index,row){  
						var nm_daftarpaket = row.nm_daftarpaket;
						$('#tabelsatupem_daftarpaket_hasilkelainantampildata').datagrid({
							url: '<?=@base_url($this->u1.'/jsondatapasienpem_daftarpaket_hasilya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>&nm_daftarpaket='+nm_daftarpaket,
						});
				}  
		}); 
		$('#tabelsatupem_daftarpaket_hasilkelainantampildata').datagrid({
			url: '<?=@base_url($this->u1.'/jsondatapasienpem_daftarpaket_hasilya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>',
		});
		function pencarianpasienkesehatankerjaya(value){
			$('#tabelsatupem_daftarpaket_hasilkelainantampildata').datagrid('load',{  
				cari: value,
			});
		}
		
	</script>