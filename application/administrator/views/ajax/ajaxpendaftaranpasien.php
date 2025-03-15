				<?php
					$reg = "AUTO GENERATE CODE";
					$kod = "MCU-". $this->session->userdata('id_user') . date("YmdHis");
					//$kod = "MCU-20160223182921";
					$tgllhr = "";
					$disred = "";
					$tanggalreg = date("m/d/Y H:i:s");
					if($this->uri->segment(3)){
						$this->db->where('id_pas', clean_data($this->uri->segment(3)));
						$this->db->limit('1');
						$jjus = $this->db->get('tb_pasien');
						$pp = $jjus->result();
						//print_r($tsts);
						$reg = $pp[0]->no_reg;
						$tgllhr = date("d-m-Y", strtotime($pp[0]->tgl_lhr_pas));
					}
					//print_r($_GET);
					$discari = "";
					$tssdms  = "";
					$esycek = 'class="easyui-combobox"';
					if(isset($_GET['id_reg'])){
						$discari = 'disabled="true"';
						$disred = "data-options=\"readonly:true\"";
						$this->db->where('id_reg', clean_data($_GET['id_reg']));
						$this->db->limit('1');
						$nhd = $this->db->get('tb_register');
						$datareg = $nhd->result();
						$tanggalreg = date("m/d/Y H:i:s", strtotime($datareg[0]->tgl_awal_reg));
						$kod = $datareg[0]->kode_transaksi;
						$tssdms  = "<b style='color:blue'> | ".$datareg[0]->no_filemcu."</b>";
						$tssdms  .= ' | <button style="cursor:pointer;margin-right:5px" type="button" onclick="gantipaketfungsi()">Ganti Paket</button>';
						$tssdms  .= ' <button style="cursor:pointer" type="button" onclick="hapusregistrasipas(\''.$datareg[0]->id_reg.'\', \''.$datareg[0]->no_filemcu.'\', \''.$kod.'\')">Hapus Registrasi</button>';
						$esycek = 'class="easyui-combobox"';
					}
				?>
				<table style="width:100%;" class="wedusbalapdaftar">
					<tr>
						<td style="width:230px;vertical-align:top;">
							<iframe src="<?=@base_url('cam/?rm='.$kod)?>" frameborder="0" width="100%" height="1000px" style="z-index:9999999999999999999"></iframe> 
						</td>
						<td style="vertical-align:top;" >
						<table style="width:100%;" >
					<input type="hidden" id="id_pas" name="id_pas" value="<?=@$pp[0]->no_reg?>">
					<input type="hidden" id="id_reg" name="id_reg" value="<?=@$datareg[0]->no_filemcu?>">
					<input type="hidden" id="kode_transaksi" name="kode_transaksi" value="<?=@$kod?>">
					<tr>
						<td colspan="5" style="background:#D1DFEC;"><div align="center"><b>KODE TRANSAKSI: <?=@$kod?> <?=@$tssdms?></b></div></td>
					</tr>
					<?php if(isset($_GET['id_reg'])){ ?>
					<tr id="gantipaketsayaya">
						<td colspan="5" style="background:#D1DFEC;">
							<div align="center">
								<fieldset>
									<table style="width:100%">
									<tr>
									<td>
										<select id="gantipaketsaya" style="width:100%">
										<option value="">Pilih Paket Pengganti.....</option>
										<?php 
											$this->db->select('id_paket, nm_paket');
											$this->db->where('jenis_paket', 'P');
											$this->db->where("id_paket <> '".$datareg[0]->id_paket."'");
											$this->db->order_by('id_paket', 'ASC');
											$cmb1 = $this->db->get('tb_paket');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
										?>
											<option value="<?=@$va->id_paket?>"><?=@$va->nm_paket?></option>
										<?php } ?>
									</select></td>
								<td width="5%"><button type="button" style="cursor:pointer" onclick="lanjutkangantipaket('<?=@$pp[0]->id_pas?>', '<?=@$datareg[0]->id_reg?>', '<?=@$kod?>')">Lanjutkan</button></td>
								</tr>
							</table>
							</fieldset>
							</div>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td width="12%">Tanggal</td>
						<td width="34%">
							<div align="left">
								<input class="easyui-datetimebox" type="text" name="tgl_awal_reg" style="width:100%;" value="<?=@$tanggalreg?>">
							</div>
						</td>
						<td width="10%">No Reg</td>
						<td width="34%">
							<div align="left">
							<input  type="text" name="no_reg" id="no_reg" readonly="true" style="width:98%;" value="<?=@$reg?>">
							</div>
						</td>
						<td width="7%"><button type="button" onclick="caridatapasienmcu()" <?=@$discari?> style="cursor:pointer">Cari</button></td>
					</tr>
					<tr>
						<td>Kesatuan / Perusahaan</td>
						<td>
							<div align="left">
								<select  name="id_jawatan"  id="id_jawatan" style="width:100%">
								<?php 
									$this->db->select('id_jawatan, nm_jawatan');
									$this->db->order_by('nm_jawatan', 'ASC');
									$cmb1 = $this->db->get('tb_jawatan');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
									$sel = "";
									if($pp){
										if($pp[0]->id_jawatan == $va->id_jawatan){
											$sel = 'selected="true"';
										}
									}
								?>
									<option value="<?=@$va->id_jawatan?>" <?=@$sel?>><?=@$va->nm_jawatan?></option>
								<?php } ?>
								</select>
							</div>
						</td>
						<td ><b style="color:black;font-weight:normal">Korps</b></td>
						<td >
							<div align="left">
								<input class="easyui-combobox" id="dept_pas" name="dept_pas" data-options="valueField:'id',textField:'text'" style="width:100%">
							</div>
						</td>
						
					</tr>
					<tr>
						<td >Kode</td>
						<td>
							<div align="left">
								<select  class="easyui-combobox" name="id_dinas" id="id_dinas" style="width:100%">
								<?php 
									$this->db->select('id_dinas, nm_dinas');
									$this->db->order_by('nm_dinas', 'ASC');
									$cmb1 = $this->db->get('tb_dinas');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
									$sel = "";
									if($pp){
										if($pp[0]->id_dinas == $va->id_dinas){
											$sel = 'selected="true"';
										}
									}
								?>
									<option value="<?=@$va->id_dinas?>" <?=@$sel?>><?=@$va->nm_dinas?></option>
								<?php } ?>
								</select>
							</div>
						</td>
						<td>Type</td>
						<td><div align="left">
							<select name="kesatuan_pas" id="kesatuan_pas"  style="width:100%">
							<?php 
								foreach(is_kesatuan() as $ke => $va){ 
									$sel = "";
									if($pp){
										if($pp[0]->kesatuan_pas == $ke){
											$sel = 'selected="true"';
										}
									}
							?>
								<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
							<?php } ?>
							</select>
							</div>
						</td>
					</tr>
					<tr>
						<td ><b style="color:black;font-weight:normal">NIP/NRP/NIK</b></td>
						<td >
							<div align="left">
								<input  type="text" name="nip_nrp_nik" id="nip_nrp_nik" value="<?=@$pp[0]->nip_nrp_nik?>" style="width:96%;">
							</div>
						</td>
						<td>No KTP</td>
						<td>
							<div align="left">
								<input  type="text" name="no_ktp_pas" id="no_ktp_pas" value="<?=@$pp[0]->no_ktp_pas?>" style="width:97%">
							</div>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Nama</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="10%">
										<div align="left">
											<?php
												//$this->db->select('id_pre, nm_pre');
												$this->db->order_by('nm_pre', 'ASC');
												$cmb1 = $this->db->get('tb_preposisi');
												$cmb1 = $cmb1->result();
												foreach($cmb1 as $va){ 
													echo '<input type="hidden" id="preposisidata'.$va->id_pre.'" value="'.$va->type_pre.'">';
												}
											?>
											<select name="preposisi"  id="preposisi" style="width:100%" onchange="rubahjenkel()">
											<option value=""></option>
											<?php 
												foreach($cmb1 as $va){ 
												$sel = "";
												if($pp){
													if($pp[0]->preposisi == $va->id_pre){
														$sel = 'selected="true"';
													}
												}
											?>
												<option value="<?=@$va->id_pre?>" <?=@$sel?>><?=@$va->nm_pre?></option>
											<?php } ?>
											</select>
										</div>
									</td>
									<td>
										<div align="left">
											<input  type="text" name="nm_pas" id="nm_pas" value="<?=@$pp[0]->nm_pas?>" style="width:99%">
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Jenkel</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="35%">
									<?php
										if($pp){
											$cowo = "";
											$cewe = "";
											if($pp[0]->jenkel_pas == "L"){
												$cowo = 'checked="true"';
											}
											if($pp[0]->jenkel_pas == "P"){
												$cewe = 'checked="true"';
											}
										}
									?>
										<div align="left">
											<input type="radio" name="jenkel_pas" id="pria" <?=@$cowo?>  value="L"> Laki-laki
											<input type="radio" name="jenkel_pas" id="wanita" <?=@$cewe?> value="P" > Perempuan
										</div>
									</td>
									<td><b style="color:black;font-weight:normal">Agama</b></td>
									<td>
										<select  name="id_agama" id="id_agama" style="width:100%">
										<option value="">-</option>
										<?php 
											$this->db->select('id_agama, nm_agama');
											$this->db->order_by('nm_agama', 'ASC');
											$cmb1 = $this->db->get('tb_agama');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
												$sel = "";
												if($pp){
													if($pp[0]->id_agama == $va->id_agama){
														$sel = 'selected="true"';
													}
												}
										?>
											<option value="<?=@$va->id_agama?>" <?=@$sel?>><?=@$va->nm_agama?></option>
										<?php } ?>
										</select>
									</td>
									<td>Gol Darah</td>
									<td style="width:10%"><input  type="text" name="gol_darah" id="gol_darah" style="width:98%" value="<?=@$pp[0]->gol_darah?>"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">TTL</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="30%">
										<!--data-options="formatter:myformatter,parser:myparser"-->
										<input class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" type="text" name="tgl_lhr_pas" id="tgl_lhr_pas" style="width:100%;" value="<?=@$tgllhr?>">
									</td>
									<td>Di</td>
									<td width="30%">
										<div align="left">
										<input  type="text" name="tmp_lahir_pas" id="tmp_lahir_pas" style="width:90.4%" value="<?=@$pp[0]->tmp_lahir_pas?>">
										</div>
									</td>
									<td>Telp</td>
									<td width="66%">
										<div align="left">
											<input  type="text" name="no_tlp_pas" id="no_tlp_pas" style="width:98%" value="<?=@$pp[0]->no_tlp_pas?>">
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Alamat</b></td>
						<td colspan="3">
							<div align="left">
								<textarea name="alamat_pas" id="alamat_pas" style="width:99%"><?=@$pp[0]->alamat_pas?></textarea>
							</div>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Pendidikan</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="30%">
										<select  name="id_pendidikan" id="id_pendidikan" style="width:100%">
										<option value="">-</option>
										<?php 
											$this->db->select('id_pendidikan, nm_pendidikan');
											$this->db->order_by('id_pendidikan', 'ASC');
											$cmb1 = $this->db->get('tb_pendidikan');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
												$sel = "";
												if($pp){
													if($pp[0]->id_pendidikan == $va->id_pendidikan){
														$sel = 'selected="true"';
													}
												}
										?>
											<option value="<?=@$va->id_pendidikan?>" <?=@$sel?>><?=@$va->nm_pendidikan?></option>
										<?php } ?>
										</select>
									</td>
									<td>Status</td>
									<td width="20%">
										<select name="kawin_pas" id="kawin_pas" style="width:100%">
										<option value="">-</option>
										<?php 
											$this->db->select('id_status, nm_status');
											$this->db->order_by('nm_status', 'ASC');
											$cmb1 = $this->db->get('tb_status');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
												$sel = "";
												if($pp){
													if(strtolower($pp[0]->kawin_pas) == strtolower($va->nm_status)){
														$sel = 'selected="true"';
													}
												}
										?>
											<option value="<?=@$va->nm_status?>" <?=@$sel?>><?=@$va->nm_status?></option>
										<?php } ?>
										</select>
									</td>
									<td>Kebangsaan</td>
									<td width="20%">
										<select  name="bangsa_pas" id="bangsa_pas" style="width:100%">
										<?php 
											foreach(is_bangsa() as $sd){ 
												$sel = "";
												if($pp){
													if(strtolower($pp[0]->bangsa_pas) == strtolower($sd)){
														$sel = 'selected="true"';
													}
												}
										?>
											<option value="<?=@$sd?>"><?=@$sd?></option>
										<?php } ?>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Pekerjaan</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="20%">
										<select name="nm_pekerjaan" id="nm_pekerjaan_pendaftaran" style="width:100%">
										<option value="">-</option>
										<?php 
											$this->db->select('nm_pekerjaan, nm_pekerjaan');
											$this->db->order_by('nm_pekerjaan', 'ASC');
											$cmb1 = $this->db->get('tb_pekerjaan');
											$cmb1 = $cmb1->result();
											foreach($cmb1 as $va){ 
												$sel = "";
												if($pp){
													if(strtolower($pp[0]->nm_pekerjaan) == strtolower($va->nm_pekerjaan)){
														$sel = 'selected="true"';
													}
												}
										?>
											<option value="<?=@$va->nm_pekerjaan?>" <?=@$sel?>><?=@$va->nm_pekerjaan?></option>
										<?php } ?>
										</select>
									</td>
									<td>Pangkat</td>
									<td width="20%">
										<input class="easyui-combobox" id="pangkat_pas_pendaftaran" name="pangkat_pas" data-options="valueField:'id',textField:'text'" style="width:100%">
									</td>
									<td>Jabatan</td>
									<td width="30%">
										<input  type="text" name="jabatan_pas" id="jabatan_pas" style="width:99%" value="<?=@$pp[0]->jabatan_pas?>">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Paket</b></td>
						<td>
							<div align="left">
								<select <?=@$esycek?>  name="id_paket" id="id_paket" style="width:100%" <?=@$disred?>>
								<?php if(!isset($_GET['id_reg'])){ ?>
								<option value=""></option>
								<?php } ?>
								<?php 
									$this->db->select('id_paket, nm_paket');
									$this->db->where('jenis_paket', 'P');
									if(isset($_GET['id_reg'])){
										$this->db->where('id_paket', $datareg[0]->id_paket);
									}
									$this->db->order_by('id_paket', 'ASC');
									$cmb1 = $this->db->get('tb_paket');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
								?>
									<option value="<?=@$va->id_paket?>"><?=@$va->nm_paket?></option>
								<?php } ?>
							</select>
							</div>
						</td>
						<td colspan="2">
							<table style="width:100%">
							<tr>
								<td>
									<button type="button" onclick="editkomponenbiaya('<?=@$kod?>')" style="margin-right:10px;cursor:pointer">Edit Komponen Paket</button>
									<button style="cursor:pointer" type="button" onclick="tambahbiayapaket('<?=@$kod?>')" >Pemeriksaan Tambahan</button></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td ><b style="color:black;font-weight:normal">Cara Bayar</b></td>
						<td>
							<div align="left">
								<input type="hidden" name="cara_bayar_lama" value="<?=@$datareg[0]->cara_bayar?>">
								<select  name="cara_bayar" id="cara_bayar" style="width:100%">
								<?php if(!isset($_GET['id_reg'])){ ?>
								<option value=""></option>
								<?php } ?>
								<?php 
									$this->db->select('id_bayar, nm_bayar');
									/*if(isset($_GET['id_reg'])){
										$this->db->where('nm_bayar', $datareg[0]->cara_bayar);
									}*/
									$this->db->order_by('id_bayar', 'ASC');
									$cmb1 = $this->db->get('tb_bayar');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
										$sel = "";
										if(isset($_GET['id_reg'])){
											
											if($va->nm_bayar == $datareg[0]->cara_bayar){
												$sel = 'selected="true"';
											}
										}
								?>
									<option value="<?=@$va->nm_bayar?>" <?=@$sel?>><?=@$va->nm_bayar?></option>
								<?php } ?>
							</select>
							</div>
						</td>
						<td colspan="2"></td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				<script type="text/javascript">
				$('#gantipaketsayaya').hide();
				function gantipaketfungsi(){
					$('#gantipaketsayaya').toggle();
				}
				function rubahjenkel(){
							var hh = $('#preposisi').val();
							var dd = $('#preposisidata'+hh).val();
							if(hh != ""){
								if(dd == "P"){
									document.getElementById("wanita").checked = true;
									document.getElementById("pria").checked = false;
								}
								if(dd == "L"){
									document.getElementById("pria").checked = true;
									document.getElementById("wanita").checked = false;
								}
								if(dd == ""){
									document.getElementById("pria").checked = false;
									document.getElementById("wanita").checked = false;
								}
							}else {
								document.getElementById("pria").checked = false;
								document.getElementById("wanita").checked = false;
							}
				}
					$('#id_jawatan').combobox({
						onSelect: function(baba){
							var hh = $('#id_jawatan').combobox('getValue');
							$('#dept_pas').combobox('reload','<?=@base_url($this->u1 . '/getdatadepartmen')?>/?id_jawatan='+hh); 
						}
					});
					$('#nm_pekerjaan_pendaftaran').combobox({
						onSelect: function(baba){
							var hh = $('#nm_pekerjaan_pendaftaran').combobox('getValue');
							$('#pangkat_pas_pendaftaran').combobox('reload','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek='+hh); 
						}
					});
					<?php
						if($pp){
							if($pp[0]->nm_pekerjaan != ""){
					?>
						//$('#pangkat_pas_pendaftaran').combobox('load','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek=');  
						$('#pangkat_pas_pendaftaran').combobox({
							url:'<?=@base_url($this->u1 . '/getdatapangkatjson/?nmpek='.$pp[0]->nm_pekerjaan .'&pangkat='. $pp[0]->pangkat_pas)?>',
						});
					<?php
								
							}
						}
					?>
					<?php
						if($pp){
							if($pp[0]->id_jawatan != ""){
					?>
						//$('#pangkat_pas_pendaftaran').combobox('load','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek=');  
						$('#dept_pas').combobox({
							url:'<?=@base_url($this->u1 . '/getdatadepartmen/?id_jawatan='.$pp[0]->id_jawatan .'&id_dept='. $pp[0]->dept_pas)?>',
						});
					<?php
								
							}
						}
					?>
					function myformatter(date){
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
					}
				</script>