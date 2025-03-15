<div class="easyui-layout" data-options="fit:true" id="datadiagnosakelainan2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select kd_diagnosa,  nm_diagnosa, count(kd_diagnosa) as newkode from  tb_resume_diagnosa,  tb_register, tb_pasien ";
			$fghb .= " where tb_resume_diagnosa.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg ";
			//selanjutnya mari kita filter
			$fghb .= " and   diagnosa_key='diagnosa_1' ";
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
			$fghb .= " group by kd_diagnosa order by kd_diagnosa ASC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
			//print_r($xcvb);
		?>
       <table id="diagnosa_icd_tabel1" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="kd_icd" width="20">Kode</th>
                <th field="nm_icd" width="100">Diagnosa</th>
                <th field="jumlah_icd" width="20">Jumlah</th>
            </tr>                          
        </thead>                           
        <tbody>                            
            <?php
				if($xcvb){
					foreach($xcvb as $cvbs){
			?>
			<tr>
				<td><?=@$cvbs->kd_diagnosa?></td>
				<td><?=@$cvbs->nm_diagnosa?></td>
				<td><div align="center"><?=@$cvbs->newkode?></div></td>
			</tr>
				<?php } ?>
			<?php } ?>
        </tbody>                           
    </table>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datadiagnosakelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:73%;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatudiagnosakelainantampildata"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_urut_reg" sortOrder="ASC" toolbar="#tabelsatudiagnosakelainantampildata_tolbar">
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
								<th data-options="field:'nm_diagnosa'" width="40" sortable="true">Hasil</th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatudiagnosakelainantampildata_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
						<table style="width:99%">
							<tr>
								<td width="50%"></td>
								<td>
									<input class="easyui-searchbox" data-options="prompt:'Masukkan No Urut, Nama, NIK, Alamat dll ',searcher:pencarianpasiendaridetaildiag" style="width:100%"></input>
								</td>
							</tr>
						</table>
					</div>
		</div>
    </div>
	<script type="text/javascript">
		var a = $('#formfilteranalisa').serialize();
		$('#diagnosa_icd_tabel1').datagrid({  
				onSelect:function(index,row){  
						var kodeicd = row.kd_icd;
						$('#tabelsatudiagnosakelainantampildata').datagrid({
							url: '<?=@base_url($this->u1.'/jsondatapasiendiagnosaya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>&kode_icd='+kodeicd,
						});
				}  
		}); 
		$('#tabelsatudiagnosakelainantampildata').datagrid({
			url: '<?=@base_url($this->u1.'/jsondatapasiendiagnosaya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>',
		});
		function pencarianpasiendaridetaildiag(value){
			$('#tabelsatudiagnosakelainantampildata').datagrid('load',{  
				cari: value,
			});
		}
		
	</script>