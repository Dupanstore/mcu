<?php
	//print_r($_GET);
	$que  = "select a.no_reg, a.tgl_awal_reg, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas, b.jenkel_pas, b.gol_darah, b.tgl_lhr_pas from tb_register a, tb_pasien b where a.no_reg=b.no_reg ";
	$que .= " and a.kode_transaksi='".$this->u3."' and a.id_paket='".$_GET['id_paket']."' limit 1";
	$vsa = $this->db->query($que);
	$res = $vsa->result();
	//print_r($_GET['id_paket']);
	if(!$res){
		die('<p style="background:red;margin:0;text-align:center;font-weight:bold;color:white">Pasien Belum Diperiksa</p>');
	}
		$this->db->where('ket_resume', 'info_pasien');
		$this->db->where('kode_transaksi', $this->u3);
		$this->db->limit('1');
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->result();
	//ambil tetek bengeke lainlain
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".$this->u3."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
	//print_r($pemkss);
?>
<div class="easyui-layout" data-options="fit:true" id="detailevaluasipasienpanel">
		<div data-options="region:'west',iconCls:'icon-ok',footer:'#detailevaluasipasienpanel_toolbar'" title="Informasi Pasien" style="width:320px;padding:2px">
            <div class="easyui-layout" data-options="fit:true">
               <form method="POST" id="detailevaluasipasienpanel_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpandetailevaluasipasien')?>">
				   <input type="hidden" name="id_res" value="<?=@$respas[0]->id_res?>">
				   <input type="hidden" name="kode_transaksi_resume" value="<?=@$this->u3?>">
				   <table style="width:90%">
					<tr>
						<td>Tanggal Daftar</td>
						<td width="1%">:</td>
						<td><?=@the_time($res[0]->tgl_awal_reg)?></td>
					</tr>
					<tr>
						<td>No Registrasi</td>
						<td>:</td>
						<td><?=@$this->u3?></td>
					</tr>
					<tr>
						<td>Dokter</td>
						<td>:</td>
						<td><select  class="easyui-combobox" id="resume_dokter" name="resume_dokter" style="width:100%;">
								<option value="">Pilih...</option>
									<?php 
										$this->db->select('id_dok, nm_dok');
										$this->db->order_by('nm_dok', 'ASC');
										$cmb1 = $this->db->get('tb_dokter');
										$cmb1 = $cmb1->result();
										foreach($cmb1 as $va){ 
										$sel = "";
										if($respas){
											if($respas[0]->id_dokter == $va->id_dok){
											$sel = 'selected="true"';
											}
										}
									?>
									<option value="<?=@$va->id_dok?>" <?=@$sel?>><?=@$va->nm_dok?></option>
									<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>No Resume</td>
						<td>:</td>
						<td><input type="text" style="width:100%" name="no_resume" value="<?=@$respas[0]->no_resume?>"></td>
					</tr>
					<tr>
						<td>Tgl Resume</td>
						<td>:</td>
						<?php
							$tglres = date('m/d/Y H:i:s');
							if($respas){
								$tglres = date('m/d/Y H:i:s', strtotime($respas[0]->tgl_resume));
							}
						?>
						<td><input type="text" class="easyui-datetimebox"  style="width:100%" name="tgl_resume" value="<?=@$tglres?>"></td>
					</tr>
					<tr>
						<td>No MR</td>
						<td>:</td>
						<td><?=@$res[0]->no_reg?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td><?=@$res[0]->jenkel_pas?> / <?=@is_jenkel($res[0]->jenkel_pas)?></td>
					</tr>
					<tr>
						<td>Umur</td>
						<td>:</td>
						<td><?=@get_umur_ranap($res[0]->tgl_lhr_pas)?></td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;Gol Darah</td>
						<td>:</td>
						<td><?=@$res[0]->gol_darah?></td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;Berat</td>
						<td>:</td>
						<td><?=@$pemkss['beratbadan']?>Kg</td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;TB</td>
						<td>:</td>
						<td><?=@$pemkss['tinggibadan']?>cm</td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;Tensi</td>
						<td>:</td>
						<td><?=@$pemkss['tekanan_darah1']?>/<?=@$pemkss['tekanan_darah2']?></td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;LP</td>
						<td>:</td>
						<td><?=@$pemkss['lingkarperut']?></td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;LD</td>
						<td>:</td>
						<td><?=@$pemkss['lingkardada1']?>-<?=@$pemkss['lingkardada2']?></td>
					</tr>
					<tr>
						<td>&nbsp; &nbsp; &nbsp;Nadi</td>
						<td>:</td>
						<td><?=@$pemkss['nadi']?></td>
					</tr>
				   </table>
				</form>
            </div>
        </div>
		<div id="detailevaluasipasienpanel_toolbar" style="padding:5px;">
			<div style="text-align:left;">
				<a href="javascript:void(0)" data-options="iconCls:'icon-ok'" class="easyui-linkbutton" onclick="detailevaluasidata_simpandata()"><b>Update Perubahan Data</b></a>
			</div>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" title="">
            <div class="easyui-layout" data-options="fit:true">						
				<div class="easyui-layout" data-options="fit:true" id="detailevaluasipasienpaneldua">
					<div data-options="region:'center',iconCls:'icon-ok'" title="">
							    <div class="easyui-tabs" id="tabsevaluasi" style="width:100">
									<?php 
										$fsffd = $this->db->get("tb_menu_evaluasi");
										$fsfgd = $fsffd->result();
										foreach($fsfgd as $loopeval){
									?>
									<div title="<?=@$loopeval->nm_menu?>" style="padding:10px">
									   <div id="panel_detailevaluasi_<?=@$loopeval->uri_menu?>" class="easyui-panel" title="">	
										</div>
									</div>
									<?php } ?>
								</div>
					</div>
				</div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
		$('#tabelsatudetailevaluasi').datagrid({  
				onSelect:function(index,row){  
					var nam = row.nm_menu;
					var uril = row.uri_menu;
					$('#panel_detailevaluasi').panel({
						title: nam,
						href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/'+uril+'/?kode_transaksi=<?=@$this->u3?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$res[0]->no_reg?>',
					});
				}  
		}); 
		function detailevaluasidata_simpandata(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk melanjutkan', function(r) {
				if (r){
					$('#detailevaluasipasienpanel_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		
		    $('#tabsevaluasi').tabs({
				border:false,
				onSelect:function(title){
					var ddj = "";
					if(title == "Status Pemeriksaan"){
						ddj = "sttpemeriksaan";
					}
					if(title == "Anamnesa"){
						ddj = "anamnesa";
					}
					if(title == "Diagnosa/Kelainan"){
						ddj = "diagnosakelainan";
					}
					if(title == "Pemeriksaan Tambahan"){
						ddj = "periksatambahan";
					}
					if(title == "Kesimpulan/Saran"){
						ddj = "kesimpulansaran";
					}
					$('#panel_detailevaluasi_'+ddj).panel({
						href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/'+ddj+'/?kode_transaksi=<?=@$this->u3?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$res[0]->no_reg?>',
					});
				}
			});
			
	</script>