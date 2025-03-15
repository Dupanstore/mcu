<div class="easyui-layout" data-options="fit:true" id="datapemeriksaan_lainnya_hasilkelainan2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select  case when apakah_normal='N' then 'Abnormal' else 'Normal' end as newhasil, count(id_reg_pem) as newkode from tb_register_pemeriksaanlain, tb_register, tb_pasien ";
			$fghb .= " where tb_register_pemeriksaanlain.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg ";
			//selanjutnya mari kita filter
			$fghb .= " and   id_tind='".$this->u3."' ";
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
			$fghb .= " group by newhasil order by newhasil DESC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
			//print_r($xcvb);
		?>
       <table id="pemeriksaan_lainnya_hasil_pemlain_tabel1" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="nm_pemlain" width="100">Hasil</th>
                <th field="jumlah_pemlain" width="20">Jumlah</th>
            </tr>                          
        </thead>                           
        <tbody>                            
            <?php
				if($xcvb){
					foreach($xcvb as $cvbs){
			?>
			<tr>
				<td><?=@$cvbs->newhasil?></td>
				<td><div align="center"><?=@$cvbs->newkode?></div></td>
			</tr>
				<?php } ?>
			<?php } ?>
        </tbody>                           
    </table>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datapemeriksaan_lainnya_hasilkelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:73%;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatupemeriksaan_lainnya_hasilkelainantampildata"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_urut_reg" sortOrder="ASC" toolbar="#tabelsatupemeriksaan_lainnya_hasilkelainantampildata_tolbar">
						<thead>
							<tr>
								<th data-options="field:'no_urut_reg'" width="30" sortable="true">No Urut</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'jenkel_pas'" width="20" sortable="true">Jenkel</th>
								<th data-options="field:'nm_cabang'" width="40" sortable="true">Cabang/Unit</th>
								<th data-options="field:'nm_unit'" width="40" sortable="true">Bagian</th>
								<th data-options="field:'no_tlp_pas'" width="20" sortable="true">No.Telp</th>
								<th data-options="field:'kesan_reg_pemeriksaan'" width="40" sortable="true">Hasil </th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatupemeriksaan_lainnya_hasilkelainantampildata_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
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
		$('#pemeriksaan_lainnya_hasil_pemlain_tabel1').datagrid({  
				onSelect:function(index,row){  
						var nm_pemlain = row.nm_pemlain;
						$('#tabelsatupemeriksaan_lainnya_hasilkelainantampildata').datagrid({
							url: '<?=@base_url($this->u1.'/jsondatapasienpemeriksaan_lainnya_hasilya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>&nm_pemlain='+nm_pemlain,
						});
				}  
		}); 
		$('#tabelsatupemeriksaan_lainnya_hasilkelainantampildata').datagrid({
			url: '<?=@base_url($this->u1.'/jsondatapasienpemeriksaan_lainnya_hasilya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>',
		});
		function pencarianpasienkesehatankerjaya(value){
			$('#tabelsatupemeriksaan_lainnya_hasilkelainantampildata').datagrid('load',{  
				cari: value,
			});
		}
		
	</script>