<?php
	$this->db->limit(1);
	$grp = $this->madmin->Get_value('id_grouptindakan', $this->uri->segment(3), 'tb_grouptind');
	//print_r($grp);
?>
<a href="javascript:void(0)" style="margin:10px;" data-options="iconCls:'icon-add'" class="easyui-linkbutton" onclick="tambahpemeriksaan_tambahdata()"><b>Tambah Pemeriksaan</b></a>
<table class="tableeasyui" style="width:100%;border-spacing:0;">
					<tr style="background:#DEEEFA;">
						<th width="1%">No</th>
						<th>Order</th>
						<th>Pemeriksaan</th>
						<th>Satuan</th>
						<th>Nilai Rujukan</th>
						<th>Low</th>
						<th>Hight</th>
						<th colspan="2" width="1%"></th>
					</tr>
					<?php
						$do = "select * from tb_pemeriksaan, tb_grouptind where tb_pemeriksaan.kd_group=tb_grouptind.kd_grouptindakan and tb_grouptind.id_grouptindakan='". $this->uri->segment(3) ."' order by nm_pem ASC ";
						$ai = $this->db->query($do);
						//print_r($ai->result());
						if($ai->result()){
							$q = 1;
							foreach($ai->result() as $h){
							$biasanya = 'umum';
							if($h->type_tampil != ''){
								$biasanya = $h->type_tampil;
							}
							$w = $q++;
							$datuan = $h->satuan;
							$rjkan = $h->nilai_rujukan;
							if($h->setheader_lab == "Y"){
								$datuan = "<b>HEADER DATA</b>";
								$rjkan = "";
							}
							$nrmalknt = "";
							if($h->kontrol_normal == "Y"){
								$nrmalknt = "<b>(Kontrol Normal)</b>";
							}
					?>
					<tr id="tr<?=$w?>" style="background:#efefff">
						<td><?=@$w?></td>
						<td><?=@$h->kd_pem?></td>
						<td><?=@$h->nm_pem?> <?=@$nrmalknt?></td>
						<td><?=@$datuan?></td>
						<td colspan="3"><?=@$rjkan?></td>
						
						<td width="1%"><a href="javascript:void(0)" iconCls="icon-edit" class="easyui-linkbutton" onclick="editdatapemeriksaanya('<?=$h->id_pem?>', '<?=$h->kd_pem?>', '<?=$h->nm_pem?>', '<?=$h->satuan?>', '<?=$h->nilai_rujukan?>', '<?=$h->hight?>', '<?=$h->low?>', '<?=$h->type_tampil?>', '<?=@$w?>', '<?=$h->setheader_lab?>' , '<?=$h->kontrol_normal?>', '<?=$h->in_english_pem?>')"><i class="icon-edit"></i></a></td>
						<td width="1%"><a href="javascript:void(0)" iconCls="icon-remove" class="easyui-linkbutton" onclick="hapusdatadetailpemeriksaan('<?=$h->id_pem?>', 'tr<?=$w?>', '<?=$h->nm_pem?>')"><i class="icon-trash"></i></a></td>
					</tr>
					<?php 
						//tampilkan yang bukan header
						if($h->setheader_lab == ""){
						//saatnya buat lopingan
						$asx = array('umum' => 'Umum', 'range_angka' => 'Range Angka', 'positif_negatif' => 'Positif dan Negatif',  'laki' => 'Laki Laki', 'perempuan' => 'Perempuan', 'anak' => 'Anak', 'bayi' => 'Bayi', 'bayi3-5' => 'Bayi Baru Lahir (3-5 Hari)', 'bayi1-2' => 'Bayi Baru Lahir (1-2 Hari)');
						
						$typenya['umum'] = array('umum' => 'Umum');
						$typenya['range_angka'] = array('range_angka' => 'Range Angka');
						$typenya['perumur_jenkel'] = array('laki' => 'Laki Laki', 'perempuan' => 'Perempuan', 'anak' => 'Anak', 'bayi' => 'Bayi', 'bayi3-5' => 'Bayi Baru Lahir (3-5 Hari)', 'bayi1-2' => 'Bayi Baru Lahir (1-2 Hari)');
						$typenya['positif_negatif'] = array('positif_negatif' => 'Positif dan Negatif');
						foreach($asx as $dts => $srt){
							if($typenya[$biasanya][$dts]){
						//nah disini berarti tampilkan datanya ya
						$dtt = 'low';
						$dth = 'hight';
						if($dts != 'umum' and $dts != 'range_angka'){
							if($dts == 'positif_negatif'){
								$dtt = 'positif_negatif';
								$dth = 'positif_negatif';
							} else {
								$dtt = 'low_' . $dts;
								$dth = 'hight_' . $dts;
							}
						}
					?>
					<tr>
						<td colspan="4"><div align="right"><?=@$srt?></td>
						<td>
							<?php if($dts != 'positif_negatif'){ ?>
							< 
							<?php } ?>
							<?=@$h->$dtt?><input type="hidden" id="<?=@$dtt?><?=@$w?>" value="<?=@$h->$dtt?>">
						</td>
						<td colspan="3">
							<?php if($dts != 'positif_negatif'){ ?>
							> 
							<?=@$h->$dth?> <input type="hidden" id="<?=@$dth?><?=@$w?>" value="<?=@$h->$dth?>">
							<?php } ?>
						</td>
					</tr>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</table>
				<div id="modaldetailtindakansatu" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" footer="#modaldetailtindakansatu_toolbar" collapsible="false" class="easyui-window" title="" style="width:900px;height:500px;padding:5px;background:#eeeeee;">
					<form method="POST" id="iniformtambahdetailpemlab" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaanlabrsau')?>">
						<table width="100%">
							<tr>
								<td width="15%">Kontrol Normal</td>
								<td>
									<select name="kontrol_normal" id="kontrol_normal">
										<option value="">Tidak</option>
										<option value="Y">Ya</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="15%">Set Header</td>
								<td>
									<select name="header_lap_lab" id="header_lap_lab" onchange="setheader()">
										<option value="">Tidak</option>
										<option value="Y">Ya</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="15%">Order</td>
								<td>
									<input type="text" name="kd_pem" id="kd_pem" >
								</td>
							</tr>
							<tr>
								<td width="15%">Pemeriksaan</td>
								<td>
									<input type="hidden" name="id_pem" id="id_pem" >
									<input type="hidden" name="kd_group" id="kd_group"  value="">
									<input type="text" name="nm_pem" id="nm_pem" >
								</td>
							</tr>
							<tr>
								<td>Pemeriksaan (En):</td>
								<td>
									<input type="text" name="in_english_pem" id="in_english_pem" value="">
								</td>
							</tr>
							</table>
							<table width="100%"  id="hiddenheader">
							<tr>
								<td width="15%">Satuan</td>
								<td>
									<select name="satuan" id="satuan" >
										<option value="">Silahkan Pilih..</option>
										<?php
											$jenpem = explode(", ", $this->madmin->Get_setting('is_pemeriksaan_lab'));
												foreach($jenpem as $_p){
													echo '<option value="'. $_p .'">'. $_p .'</option>';
												}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td width="15%">Nilai Rujukan</td>
								<td><input type="text" name="nilai_rujukan" id="nilai_rujukan" ></td>
							</tr>
							<tr>
								<td width="15%">Type Nilai</td>
								<td>
									<select name="type_tampil" id="type_tampil" style="input-xlarge" onclick="rubahtypenilai()" >
										<?php
											$alss = array('umum' => 'Secara Umum', 'perumur_jenkel' => 'Berdasarkan Umur dan Jenis Kelamin', 'positif_negatif' => 'Positif dan Negatif', 'range_angka' => 'Range Angka');
												foreach($alss as $pd => $sr){
													echo '<option value="'. $pd .'">'. $sr .'</option>';
												}
										?>
									</select>
								</td>
							</tr>
							<tr id="tampil_satu">
								<td width="15%" style="vertical:align:middle"><p style="margin-top:8px;">Hight</td>
								<td>
									<i style="font-size:9px;">Muncul * jika ></i><br />
									<input type="text" name="hight[umum]" id="hight_umum" style="width:90px;">
								</td>
							</tr>
							<tr id="tampil_satu_juga">
								<td width="15%" style="vertical:align:middle"><br />Low</td>
								<td>
									<i style="font-size:9px;">Muncul * jika <</i><br />
									<input type="text" name="low[umum]" id="low_umum" style="width:90px;">
								</td>
							</tr>
							<tr id="tampil_dua">
								<td width="15%" style="vertical:align:middle"><br /><br /><p style="margin-top:8px;">Hight</td>
								<td>
									<table class="tableeasyui">
										<tr>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Laki-laki</b>
												<i style="font-size:9px;">Muncul * jika ></i><br />
												<input type="text" name="hight[laki]" id="hight_laki" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Perempuan</b>
												<i style="font-size:9px;">Muncul * jika ></i><br />
												<input type="text" name="hight[perempuan]" id="hight_perempuan" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Anak</b>
												<i style="font-size:9px;">Muncul * jika ></i><br />
												<input type="text" name="hight[anak]" id="hight_anak" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi</b>
												<i style="font-size:9px;">Muncul * jika ></i><br />
												<input type="text" name="hight[bayi]" id="hight_bayi" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi Baru Lahir</b>
												<i style="font-size:9px;">(3-5 hari) Muncul * jika ></i><br />
												<input type="text" name="hight[bayi_baru1]" id="hight_bayi_baru1" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi Baru Lahir</b>
												<i style="font-size:9px;">(1-2 hari) Muncul * jika ></i><br />
												<input type="text" name="hight[bayi_baru2]" id="hight_bayi_baru2" style="width:90px;">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="tampil_dua_juga">
								<td width="15%" style="vertical:align:middle"><br />Low</td>
								<td>
									<table  class="tableeasyui">
										<tr>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Laki-laki</b>
												<i style="font-size:9px;">Muncul * jika <</i><br />
												<input type="text" name="low[laki]" id="low_laki" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Perempuan</b>
												<i style="font-size:9px;">Muncul * jika <</i><br />
												<input type="text" name="low[perempuan]" id="low_perempuan" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Anak</b>
												<i style="font-size:9px;">Muncul * jika <</i><br />
												<input type="text" name="low[anak]" id="low_anak" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi</b>
												<i style="font-size:9px;">Muncul * jika <</i><br />
												<input type="text" name="low[bayi]" id="low_bayi" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi Baru Lahir</b>
												<i style="font-size:9px;">(3-5 hari) Muncul * jika ></i><br />
												<input type="text" name="low[bayi_baru1]" id="low_bayi_baru1" style="width:90px;">
											</td>
											<td>
												<b style="font-size:9px;"><i class="icon-folder-open"></i> Nilai Bayi Baru Lahir</b>
												<i style="font-size:9px;">(1-2 hari) Muncul * jika ></i><br />
												<input type="text" name="low[bayi_baru2]" id="low_bayi_baru2" style="width:90px;">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="tampil_tiga">
								<td width="15%" style="vertical:align:middle">Nilai</td>
								<td>
									<select name="positif_negatif" id="positif_negatif">
										<?php foreach($this->madmin->rsau_postifif_negatif() as $dy => $sr){ ?>
										<option value="<?=@$dy?>"><?=@$sr?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							</table>
					</form>
				</div>
					<div id="modaldetailtindakansatu_toolbar" style="padding:4px;">
							<div style="text-align:right;">
								<a href="javascript:void(0)" class="easyui-linkbutton" onclick="simpanupdatetambahdetailpemsatu()"><b>Simpan Perubahan</b></a>
							</div>
						</div>
			<script type="text/javascript">
				$('#tampil_satu').hide();
				$('#tampil_satu_juga').hide();
				$('#tampil_dua').hide();
				$('#tampil_dua_juga').hide();
				$('#tampil_tiga').hide();
				$('#kd_group').val('<?=@$grp[0]->kd_grouptindakan?>');
				function tambahpemeriksaan_tambahdata(){
					$('#id_pem').val('');
					$('#kd_group').val('<?=@$grp[0]->kd_grouptindakan?>');
					$('#tampil_satu').hide();
					$('#tampil_satu_juga').hide();
					$('#tampil_dua').hide();
					$('#tampil_dua_juga').hide();
					$('#tampil_tiga').hide();
					$('#modaldetailtindakansatu').window('open');
					$('#modaldetailtindakansatu').panel({
						title: 'Tambah Detail Pemeriksaan',
						//href:'<?=@base_url($this->u1.'/ajaxtambahdetailpemsatuya/'. $this->uri->segment(3))?>',
					});
					$('#iniformtambahdetailpemlab').form('reset');
					if($('#type_tampil').val() == 'umum'){
						$('#tampil_satu').show();
						$('#tampil_satu_juga').show();
					}
					if($('#type_tampil').val() == 'range_angka'){
						$('#tampil_satu').show();
						$('#tampil_satu_juga').show();
					}
					if($('#type_tampil').val() == 'perumur_jenkel'){
						$('#tampil_dua').show();
						$('#tampil_dua_juga').show();
					}
					if($('#type_tampil').val() == 'positif_negatif'){
						$('#tampil_tiga').show();
					}
				}
				function simpanupdatetambahdetailpemsatu(){
					$('#iniformtambahdetailpemlab').form('submit',{  
						success:function(data){  
							if(data == 'Insert' || data == 'Update'){
								  $('#modaldetailtindakansatu').window('close');
								  var xxx = $('#newtabketerangan').tabs('getSelected');
									xxx.panel('refresh', '<?=@base_url($this->u1.'/ajaxtambahpemlaborat/'. $this->uri->segment(3))?>');
							}
							else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 	
				}
				function hapusdatadetailpemeriksaan(data, tr, nama){
					$.messager.confirm('Konfirmasi','Anda ingin menghapus pemeriksaan '+nama,function(r){  
						if(data != ''){
							$.post('<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapuspemeriksaanlab')?>',{
								ID:data
							},function(result){ 
								var xxx = $('#newtabketerangan').tabs('getSelected');
								xxx.panel('refresh', '<?=@base_url($this->u1.'/ajaxtambahpemlaborat/'. $this->uri->segment(3))?>');
							}); 
						} else {
							$.messager.alert('Informasi', nama+' Tidak Diperbolehkan Dihapus', 'info');
						}
					});
				}
				function editdatapemeriksaanya(id, kd, nm, sat, ruj, hig, low, typetampil, no, header, kntrol, eng){
					$('#kd_group').val('<?=@$grp[0]->kd_grouptindakan?>');
					$('#modaldetailtindakansatu').window('open');
					$('#modaldetailtindakansatu').panel({
						title: 'Edit Detail Pemeriksaan',
						//href:'<?=@base_url($this->u1.'/ajaxtambahdetailpemsatuya/'. $this->uri->segment(3))?>',
					});
					$('#iniformtambahdetailpemlab').form('reset');
					$('#header_lap_lab').val(header);
					$('#kontrol_normal').val(kntrol);
					$('#id_pem').val(id);
					$('#kd_pem').val(kd);
					$('#nm_pem').val(nm);
					$('#satuan').val(sat);
					$('#nilai_rujukan').val(ruj);
					$('#in_english_pem').val(eng);
					$('#hight_umum').val(hig);
					$('#low_umum').val(low);
					$('#hight_laki').val($('#hight_laki'+no).val());
					$('#low_laki').val($('#low_laki'+no).val());
					$('#hight_perempuan').val($('#hight_perempuan'+no).val());
					$('#low_perempuan').val($('#low_perempuan'+no).val());
					$('#hight_anak').val($('#hight_anak'+no).val());
					$('#low_anak').val($('#low_anak'+no).val());
					$('#hight_bayi').val($('#hight_bayi'+no).val());
					$('#low_bayi').val($('#low_bayi'+no).val());
					$('#hight_bayi_baru1').val($('#hight_bayi3-5'+no).val());
					$('#low_bayi_baru1').val($('#low_bayi3-5'+no).val());
					$('#hight_bayi_baru2').val($('#hight_bayi1-2'+no).val());
					$('#low_bayi_baru2').val($('#low_bayi1-2'+no).val());
					$('#positif_negatif').val($('#positif_negatif'+no).val());
					$('#type_tampil').val(typetampil);
					if(typetampil == "" || typetampil == "umum"){
						$('#tampil_satu').show();
						$('#tampil_satu_juga').show();
						$('#tampil_dua').hide();
						$('#tampil_dua_juga').hide();
					}
					if(typetampil == 'perumur_jenkel'){
						$('#tampil_dua').show();
						$('#tampil_dua_juga').show();
						$('#tampil_satu').hide();
						$('#tampil_satu_juga').hide();
					}
					if(typetampil == 'positif_negatif'){	
						$('#tampil_tiga').show();
						$('#tampil_dua').hide();
						$('#tampil_dua_juga').hide();
						$('#tampil_satu').hide();
						$('#tampil_satu_juga').hide();
					}
					if(header == ""){
						$('#hiddenheader').show();
					} else {
						$('#hiddenheader').hide();
					}
					$("html, body").animate({ scrollTop: 150 }, "slow");
					$('#simpanper').html('Update Data');
				}
						function rubahtypenilai(){
							if($('#type_tampil').val() == 'umum'){
								$('#tampil_satu').show();
								$('#tampil_satu_juga').show();
								$('#tampil_dua').hide();
								$('#tampil_dua_juga').hide();
								$('#tampil_tiga').hide();
							}
							if($('#type_tampil').val() == 'range_angka'){
								$('#tampil_satu').show();
								$('#tampil_satu_juga').show();
								$('#tampil_dua').hide();
								$('#tampil_dua_juga').hide();
								$('#tampil_tiga').hide();
							}
							if($('#type_tampil').val() == 'perumur_jenkel'){
								$('#tampil_dua').show();
								$('#tampil_dua_juga').show();
								$('#tampil_satu').hide();
								$('#tampil_satu_juga').hide();
								$('#tampil_tiga').hide();
							}
							if($('#type_tampil').val() == 'positif_negatif'){
								$('#tampil_dua').hide();
								$('#tampil_dua_juga').hide();
								$('#tampil_satu').hide();
								$('#tampil_satu_juga').hide();
								$('#tampil_tiga').show();
							}
						}
						function setheader(){
							var bb = $('#header_lap_lab').val();
							if(bb == ""){
								$('#hiddenheader').show();
							} else {
								$('#hiddenheader').hide();
							}
						}
			</script>