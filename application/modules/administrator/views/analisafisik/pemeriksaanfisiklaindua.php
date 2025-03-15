<div class="easyui-layout" data-options="fit:true" id="datapem_pemfisiklain_hasilkelainan2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		<?php
			$fghb = "select  det_nm_pemeriksaan, tb_register_pemeriksaan.val_reg_pemeriksaan, count(id_reg_pem) as newkode from  tb_register_pemeriksaan, tb_pemeriksaan, tb_register, tb_pasien ";
			$fghb .= " where tb_register_pemeriksaan.key_reg_pemeriksaan=tb_pemeriksaan.id_pem and  tb_register_pemeriksaan.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg ";
			$fghb .= " and tb_pemeriksaan.id_group_pemfisik='".$_GET['id']."' ";
			if(!empty($_GET['kunjungan_ke'])){
				$fghb .= " and  kunjungan_ke='".$_GET['kunjungan_ke']."' ";
			}
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
			$fghb .= " group by id_pem, val_reg_pemeriksaan order by  det_order_pemeriksaan ASC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
		?>
	  <table id="pem_pemfisiklain_hasil_pemfisiklain_tabel1" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="nm_pemfisiklain" width="50">Pemeriksaan</th>
                <th field="hasil_pemfisiklain" width="50">Hasil</th>
                <th field="jumlah_pemfisiklain" width="20">Jumlah</th>
            </tr>                          
        </thead>                           
        <tbody>                            
            <?php
					foreach($xcvb as $cvbs){
			?>
			<tr>
				<td><?=@$cvbs->det_nm_pemeriksaan?></td>
				<td><?=@$cvbs->val_reg_pemeriksaan?></td>
				<td><div align="center"><?=@$cvbs->newkode?></div></td>
			</tr>
				<?php } ?>
        </tbody>                           
    </table>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapem_pemfisiklain_hasilkelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:65%;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatupem_pemfisiklain_hasilkelainantampildata"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_urut_reg" sortOrder="ASC" toolbar="#tabelsatupem_pemfisiklain_hasilkelainantampildata_tolbar">
						<thead>
							<tr>
								<th data-options="field:'no_urut_reg'" width="30" sortable="true">No Urut</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'jenkel_pas'" width="20" sortable="true">Jenkel</th>
								<th data-options="field:'nm_cabang'" width="40" sortable="true">Cabang/Unit</th>
								<th data-options="field:'nm_unit'" width="40" sortable="true">Bagian</th>
								<th data-options="field:'det_nm_pemeriksaan'" width="40" sortable="true">Pemeriksaan </th>
								<th data-options="field:'detail_pemfisiklain'" width="40" sortable="true">Hasil </th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatupem_pemfisiklain_hasilkelainantampildata_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
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
		$('#pem_pemfisiklain_hasil_pemfisiklain_tabel1').datagrid({  
				onSelect:function(index,row){  
						var nm_pemfisiklain = row.nm_pemfisiklain;
						var hasil_pemfisiklain = row.hasil_pemfisiklain;
						$('#tabelsatupem_pemfisiklain_hasilkelainantampildata').datagrid({
							url: '<?=@base_url($this->u1.'/jsondatapasienpem_pemfisiklain_hasilya')?>/?'+a+'&id=<?=@$_GET['id']?>&kd=<?=@$_GET['kd']?>&nm=<?=@$_GET['nm']?>&nm_pemfisiklain='+nm_pemfisiklain+'&hasil_pemfisiklain='+hasil_pemfisiklain,
						});
				}  
		}); 
		$('#tabelsatupem_pemfisiklain_hasilkelainantampildata').datagrid({
			url: '<?=@base_url($this->u1.'/jsondatapasienpem_pemfisiklain_hasilya')?>/?'+a+'&id=<?=@$_GET['id']?>&kd=<?=@$_GET['kd']?>&nm=<?=@$_GET['nm']?>',
		});
		function pencarianpasienkesehatankerjaya(value){
			$('#tabelsatupem_pemfisiklain_hasilkelainantampildata').datagrid('load',{  
				cari: value,
			});
		}
		
	</script>