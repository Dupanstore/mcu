<div class="easyui-layout" data-options="fit:true" id="datakeseatan_pasien_kerjakelainan2_layout1">
        <div data-options="region:'center',iconCls:'icon-ok'" title="">
        <div class="easyui-layout" data-options="fit:true">
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select nm_kondisi, count(id_res) as newkode from tb_resume_pasien, tb_kondisi, tb_register, tb_pasien ";
			$fghb .= " where tb_resume_pasien.isi_kesansaran=tb_kondisi.id_kondisi and tb_resume_pasien.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg and nama_kesansaran='keterangan_sehat' ";
			//selanjutnya mari kita filter
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
			$fghb .= " group by nm_kondisi order by id_kondisi ASC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
			//print_r($xcvb);
		?>
       <table id="keseatan_pasien_kerja_diag_kes_tabel1" class="easyui-datagrid" data-options="singleSelect:true,fit:true,pagination:false,rownumbers:true,fitColumns:true">
        <thead>
            <tr>
                <th field="nm_diag_kes" width="100">Diagnosa Kesehatan Kerja</th>
                <th field="jumlah_diag_kes" width="20">Jumlah</th>
            </tr>                          
        </thead>                           
        <tbody>                            
            <?php
				if($xcvb){
					foreach($xcvb as $cvbs){
			?>
			<tr>
				<td><?=@$cvbs->nm_kondisi?></td>
				<td><div align="center"><?=@$cvbs->newkode?></div></td>
			</tr>
				<?php } ?>
			<?php } ?>
        </tbody>                           
    </table>
            </div>
        </div>
		<div data-options="region:'east',split:true,footer:'#datakeseatan_pasien_kerjakelainan2_panel1_toolbar',iconCls:'icon-lock'" title="" style="width:73%;background:#eeffff;">
			<table class="easyui-datagrid" id="tabelsatukeseatan_pasien_kerjakelainantampildata"
					   data-options="singleSelect:true,fit:true,pagination:true,rownumbers:true,fitColumns:true" sortName="no_filemcu" sortOrder="ASC" toolbar="#tabelsatukeseatan_pasien_kerjakelainantampildata_tolbar">
						<thead>
							<tr>
								<th data-options="field:'no_filemcu'" width="30" sortable="true">No File</th>
								<th data-options="field:'no_reg'" width="30" sortable="true">No Reg</th>
								<th data-options="field:'nip_nrp_nik'" width="20" sortable="true">NIP/NIK</th>
								<th data-options="field:'nm_pas'" width="30" sortable="true">Nama</th>
								<th data-options="field:'jenkel_pas'" width="20" sortable="true">Jenkel</th>
								<th data-options="field:'nm_jawatan'" width="40" sortable="true">Cabang/Unit</th>
								<th data-options="field:'nm_kondisi'" width="40" sortable="true">Hasil </th>
							</tr>
						</thead>
					</table>
					<div id="tabelsatukeseatan_pasien_kerjakelainantampildata_tolbar" style="padding-top:5px;padding-bottom:5px;height:auto">   
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
		$('#keseatan_pasien_kerja_diag_kes_tabel1').datagrid({  
				onSelect:function(index,row){  
						var nm_diag_kes = row.nm_diag_kes;
						$('#tabelsatukeseatan_pasien_kerjakelainantampildata').datagrid({
							url: '<?=@base_url($this->u1.'/jsondatapasienkeseatan_pasien_kerjaya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>&nm_diag_kes='+nm_diag_kes,
						});
				}  
		}); 
		$('#tabelsatukeseatan_pasien_kerjakelainantampildata').datagrid({
			url: '<?=@base_url($this->u1.'/jsondatapasienkeseatan_pasien_kerjaya/'. $this->u3)?>/?'+a+'&idins=<?=@$_GET['idins']?>&urikey=<?=@$_GET['urikey']?>',
		});
		function pencarianpasienkesehatankerjaya(value){
			$('#tabelsatukeseatan_pasien_kerjakelainantampildata').datagrid('load',{  
				cari: value,
			});
		}
		
	</script>