
		<?php
					$reg = "AUTO GENERATE CODE";
					$disred = "";
					$refnya = "TIDAK MENGGUNAKAN REFERENSI REGISTRASI";
					$kod = "KONSUL-". $this->session->userdata('id_user') . date("YmdHis");
					//$kod = "MCU-20160223182921";
					$tgllhr = "";
					$tanggalreg = date("m/d/Y H:i:s");
					if(isset($_GET['referensi'])){
						$refnya = clean_data($_GET['referensi']);
					}
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
						$disred = ",readonly:true";
						$discari = 'disabled="true"';
						$this->db->where('id_reg', clean_data($_GET['id_reg']));
						$this->db->limit('1');
						$nhd = $this->db->get('tb_register');
						$datareg = $nhd->result();
						if($datareg){
							if($datareg[0]->id_dinas_dua > 0){
								$pp[0]->id_dinas = $datareg[0]->id_dinas_dua;
							}
						}
						
						$tanggalreg = date("m/d/Y H:i:s", strtotime($datareg[0]->tgl_awal_reg));
						$kod = $datareg[0]->kode_transaksi;
						$refnya = $datareg[0]->kode_transaksi_utama;
						$tssdms  = "<b style='color:blue'> | ".$datareg[0]->no_filemcu."</b>";
						$tssdms  .= ' | <button style="cursor:pointer;margin-right:5px" type="button" onclick="gantipaketfungsi()">Ganti Pemeriksaan</button>';
						$tssdms  .= ' <button style="cursor:pointer" type="button" onclick="hapusregistrasipas(\''.$datareg[0]->id_reg.'\', \''.$datareg[0]->no_filemcu.'\', \''.$kod.'\')">Hapus Registrasi</button>';
						$esycek = 'class="easyui-combobox"';
					}
				?>
				<table style="width:100%;" class="wedusbalapdaftar">
					<input type="hidden" id="id_pas" name="id_pas" value="<?=@$pp[0]->no_reg?>">
					<input type="hidden" id="id_reg" name="id_reg" value="<?=@$datareg[0]->no_filemcu?>">
					<input type="hidden" id="kode_transaksi" name="kode_transaksi" value="<?=@$kod?>">
					<tr>
						<td colspan="5" style="background:#D1DFEC;"><div align="center"><b>TRANSAKSI: <?=@$kod?> <?=@$tssdms?></b></div></td>
					</tr>
					<?php if(isset($_GET['id_reg'])){ ?>
					<tr id="gantipaketsayaya">
						<td style="background:#D1DFEC;">
						<td colspan="3" style="background:#D1DFEC;">
							<div id="gantipemeriksaan_panel1" class="easyui-panel" title="" style="background:#D1DFEC;">	
							</div>
						</td>
						<td style="background:#D1DFEC;">
					</tr>
					<?php } ?>
					<tr>
						<td>Referensi</td>
						<td colspan="3">
							<div align="right">
								<input  type="text" readonly="true" name="referensi_nofile" id="referensi_nofile" value="<?=@$refnya?>" style="width:98%">
							</div>
						</td>
						<td width="7%"><button type="button" onclick="caridatareferensi()" <?=@$discari?> style="cursor:pointer">Cari</button></td>
					</tr>
					<tr>
						<td width="12%">Tanggal</td>
						<td width="34%">
							<div align="right">
								<input class="easyui-datetimebox" type="text" name="tgl_awal_reg" style="width:100%;" value="<?=@$tanggalreg?>">
							</div>
						</td>
						<td width="10%">No Reg</td>
						<td width="34%">
							<div align="right">
							<input  type="text" name="no_reg" id="no_reg" readonly="true" style="width:98%;" value="<?=@$reg?>">
							</div>
						</td>
						<td width="7%"><button type="button" onclick="caridatapasienmcu()" <?=@$discari?> style="cursor:pointer">Cari</button></td>
					</tr>
					<tr>
						<td>Kesatuan</td>
						<td>
							<div align="right">
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
							<div align="right">
								<input class="easyui-combobox" id="dept_pas" name="dept_pas" data-options="valueField:'id',textField:'text'" style="width:100%">
							</div>
						</td>
						
					</tr>
					<tr>
						<td >Kode</td>
						<td>
							<div align="right">
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
						<td><div align="right">
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
						<td ><b style="color:black;font-weight:normal"></b></td>
						<td >
							<div align="right">
								
							</div>
						</td>
						<td></td>
						<td>
							<div align="right">
								
							</div>
						</td>
					</tr>
					
					<tr>
						<td><b style="color:black;font-weight:normal">Perusahaan</b></td>
						<td colspan="3">
							<table style="width:100%">
								<tr>
									<td width="20%">
										<input  type="text" name="perusahaan_konsul" id="perusahaan_konsul" value="<?=@$pp[0]->perusahaan_konsul?>" style="width:98%;">
									</td>
									<td>&nbsp;&nbsp;NIP/NRP/NIK</td>
									<td width="20%">
										<input  type="text" name="nip_nrp_nik" id="nip_nrp_nik" value="<?=@$pp[0]->nip_nrp_nik?>" style="width:98%;">
									</td>
									<td>&nbsp;&nbsp;No KTP</td>
									<td width="30%">
										<input  type="text" name="no_ktp_pas" id="no_ktp_pas" value="<?=@$pp[0]->no_ktp_pas?>" style="width:97%">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<td><b style="color:black;font-weight:normal">Nama</b></td>
						<td>
							<table style="width:100%">
								<tr>
									<td width="25%">
										<div align="right">
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
										<div align="right">
											<input  type="text" name="nm_pas" id="nm_pas" value="<?=@$pp[0]->nm_pas?>" style="width:97%">
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td>Alamat</td>
						<td>
							<div align="right">
								<textarea name="alamat_pas" id="alamat_pas" style="width:98%;height:15px;"><?=@$pp[0]->alamat_pas?></textarea>
							</div>
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
										<select  class="easyui-combobox" name="nm_pekerjaan" id="nm_pekerjaan" style="width:100%">
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
										<input class="easyui-combobox" id="pangkat_pas" name="pangkat_pas" data-options="valueField:'id',textField:'text'" style="width:100%">
									</td>
									<td>Jabatan</td>
									<td width="30%">
										<input  type="text" name="jabatan_pas" id="jabatan_pas" style="width:98%" value="<?=@$pp[0]->jabatan_pas?>">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Pemeriksaan</b></td>
						<td colspan="3">
							<table style="width:100%">
							<tr>
								<td width="60%">
									<div align="right">
										<input class="easyui-combo" id="list_pemeriksaan" name="list_pemeriksaan[]" data-options="valueField:'id',textField:'text',multiple:true<?=@$disred?>, multiline:true"style="width:100%;height:40px">
									</div>
								</td>
									
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal"></b></td>
						<td colspan="3">
							<button type="button" onclick="editkomponenbiaya('<?=@$kod?>')" style="margin-right:10px;cursor:pointer">Edit Komponen</button>
							&nbsp; &nbsp;<button type="button" onclick="pakaitemplate('<?=@$kod?>')" style="margin-right:10px;cursor:pointer">Gunakan Template</button>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal"></b></td>
						<td colspan="3">
							<div id="pemeriksaansaya"></div>
						</td>
					</tr>
					<tr>
						<td><b style="color:black;font-weight:normal">Maksud Pemeriksaan</b></td>
						<td colspan="3">
							<div align="right">
								<textarea name="maksud_pemeriksaan" id="maksud_pemeriksaan" style="width:98%;height:15px;"><?=@$datareg[0]->maksud_pemeriksaan?></textarea>
							</div>
						</td>
					</tr>
					<tr>
						<td ><b style="color:black;font-weight:normal">Cara Bayar</b></td>
						<td>
							<div align="right">
								<input type="hidden" name="cara_bayar_lama" value="<?=@$datareg[0]->cara_bayar?>">
								<select  name="cara_bayar" id="cara_bayar" style="width:100%">
								<option value=""></option>
								<?php 
									$this->db->select('id_bayar, nm_bayar');
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
				<script type="text/javascript">
				function batalkangantipemeriksaan(){
					$('#gantipemeriksaan_panel1').panel({
						href:'<?=@base_url($this->u1.'/gantipaketpemeriksaan/')?>',
					});
				}
				<?php
					$tbb = "";
					if(isset($_GET['id_reg'])){
						$tbb = "/?kode_transaksi=". $kod;
					}
				?>
				$('#list_pemeriksaan').combobox({
							url:'<?=@base_url($this->u1 . '/getdatalistpemeriksaan'. $tbb)?>',
				});
				function gantipaketfungsi(){
					$('#gantipemeriksaan_panel1').panel({
						href:'<?=@base_url($this->u1.'/gantipaketpemeriksaan/'. $kod)?>',
					});
				}
					$('#list_pemeriksaan').combo({
						onChange: function(newValue,oldValue){
							var hh = $('#list_pemeriksaan').combo('getValues');
							$.post("<?=base_url($this->u1 .'/tampilkandaftarpemeriksaansaya')?>", {
								arrpem:hh,
							}, function(response){
								$('#pemeriksaansaya').html(response);
							});
						}
					});
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
					$('#nm_pekerjaan').combobox({
						onSelect: function(baba){
							var hh = $('#nm_pekerjaan').combobox('getValue');
							$('#pangkat_pas').combobox('reload','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek='+hh); 
						}
					});
					
					<?php
						if($pp){
							if($pp[0]->nm_pekerjaan != ""){
					?>
						//$('#pangkat_pas').combobox('load','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek=');  
						$('#pangkat_pas').combobox({
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
						//$('#pangkat_pas').combobox('load','<?=@base_url($this->u1 . '/getdatapangkatjson')?>/?nmpek=');  
						$('#dept_pas').combobox({
							url:'<?=@base_url($this->u1 . '/getdatadepartmen/?id_jawatan='.$pp[0]->id_jawatan .'&id_dept='. $pp[0]->dept_pas)?>',
						});
					<?php
								
							}
						}
					?>
					function lanjutkangantipaket(){
						//ambil idpaket dan cara bayar
						var idpas = "<?=@$pp[0]->id_pas?>";
						var idreg = "<?=@$datareg[0]->id_reg?>";
						var kod = "<?=@$kod?>";
						var pemeriksaan   = $('#list_gantipemeriksaan').combo('getValues');
						var cara_bayar = $('#cara_bayar').val();
						$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan mengganti pemeriksaan, melanjutkan berarti menyimpan ulang seluruh pemeriksaan', function(r) {
							if (r){
								$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/gantipemeriksaankonsulya')?>", {
										kode_transaksi:kod, idreg:idreg, idpas:idpas, pemeriksaan:pemeriksaan, cara_bayar:cara_bayar
									}, function(response){
										if(response == "simpan"){
											$('#panel_daftar1').panel({
												href:'<?=@base_url($this->u1.'/ajaxpendaftarankonsul')?>/'+idpas+'/?id_reg='+idreg,
											});
											$.messager.alert('Informasi', 'Perubahan Pemeriksaan berhasil diupdate', 'info');
										} else {
											$.messager.alert('Informasi', response, 'info');
										}
										
									});
							}
						});
					}
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