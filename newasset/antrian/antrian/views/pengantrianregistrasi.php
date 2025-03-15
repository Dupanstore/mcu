<?php $this->load->view('header') ?>
	<div class="container"  style="overflow:hidden">
		<h1 id="site-title">
			<?=$title?>
		</h1>
		<div class="alert alert-info" style="cursor:pointer;">
			<i class="icon-info-sign" style="opacity:0.5;"></i> 
			Dibawah ini adalah Pengaturan Antrian Registrasi
		</div>
		<form method="POST" id="formtambah" action="<?=base_url('administrator/admin_action/simpanupdateantrian')?>"/>
		<table class="table table-bordered" style="width:60%;">
				<tr style="background:-moz-linear-gradient(center top , rgb(255, 255, 255) 0pt, rgb(242, 242, 242) 100%) repeat-x scroll 0% 0% transparent;">
					<th width="1%"><p>No</p></th>
					<th><p>Loket Pendaftaran</p></th>
					<th><p>Pengguna</p></th>
				</tr>
				<?php
					$nb = 1;
					$ayy = "select * from tb_login inner join tb_sub_instalasi ";
					$ayy .= "on tb_login.akses_log=tb_sub_instalasi.id_sub ";
					$ayy .= "where tb_sub_instalasi.id_mod_sub='2' ";
					$ytt = $this->db->query($ayy);
					$ima = $ytt->result();
					//untuk loopingnya
					$this->db->where('type', 'pendaftaran');
					$this->db->order_by('nomor', 'ASC');
					$ysa = $this->db->get('tb_antrian');
					$query = $ysa->result();
					foreach ($query as $key => $val){ 
						$no = $nb++;
				?>
				<input type="hidden" name="id[<?=@$val->nomor?>]" value="<?=@$val->id_ant?>">
				<tr id="tr<?=$no?>">
					<td><?=$no?></td>
					<td><?=strtoupper($val->jenis .' '. $val->type .' '. $val->nomor)?></td>
					<td>
						<select name="<?=@$val->type?>[<?=@$val->nomor?>]">
							<option value="">Silahkan Pilih...</option>
							<?php
								if($ima){
									foreach($ima as $kk){
									//mari cek lur
									$this->db->where('id_ant', $val->id_ant);
									$this->db->where('id_log', $kk->id_log);
									$mn = $this->db->get('tb_antrian');
									$yut = $mn->result();
									$sel = '';
									if($yut){
										$sel = 'selected="true"';
									}
							?>
								<option value="<?=@$kk->id_log?>" <?=@$sel?>><?=@$kk->user_log?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
				</tr>	
				<?php } ?>
				<tr>
					<td></td>
					<td colspan="2">
					Running Text<br />
					<?php
						//ambil running textnya
						$this->db->where('type', 'pendaftaran');
						$sd = $this->db->get('tb_antrian_running');
						$ws = $sd->result();
					?>
					<textarea name="runningtext" class="input-xxlarge"><?=@$ws[0]->keterangan?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<button type="submit" class="btn btn-primary" >Simpan Perubahan</button>
					</td>
				</tr>
			</table>
		</form>
		<?php
			$dir    = 'images';
			$files = scandir($dir, 1);
			foreach ($files as $key=>$val){
				if($val != '..' AND $val != '.'){
					 $data[$val] = $val;
				}
			}
			//print_r ($files);
		?>
		<form method="POST" id="formgambar" action="<?=base_url('administrator/admin_action/simpanupdategambar')?>"/>
			<table class="table table-bordered" style="width:100%;">
				<?php
					$dir    = 'images';
					$files = scandir($dir, 1);
					$ss = 1;
					foreach ($files as $key=>$val){
						if($val != '..' AND $val != '.' AND $val != 'noimage.jpg' AND $val != 'Thumbs.db'){
							$rt = $ss++;
							$this->db->where('namefile', $val);
							$dgt = $this->db->get('tb_antrian_img');
							$art = $dgt->result();
							//print_r ($art);
							//echo $data[$val] = $val;
				?>
				<tr>
					<td><?=@$rt?></td>
					<td><img src="<?=@base_url('images/'. $val)?>" style="width:200px"></td>
					<td>
						<p><b>Keterangan Gambar:</b></p>
						<input type="hidden" name="all[]" class="input-xxlarge" value="<?=@$val?>">
						<textarea name="ket[]" class="input-xxlarge"><?=@$art[0]->ket?></textarea>
					</td>
				</tr>
					<?php } ?>
				<?php } ?>
				<tr>
					<td></td>
					<td colspan="2">
						<button type="submit" class="btn btn-primary" >Simpan Perubahan</button>
					</td>
				</tr>
			</table>
		</form>
    </div>
	<script type="text/javascript">
		$('#formtambah').form({  
                success:function(data){  
					if(data == 'simpan'){
						$(".alert.alert-info").hide('slow');
						setTimeout(
							function(){ 
								$("html, body").animate({ scrollTop: 0 }, "slow");
								$(".alert.alert-info").show('slow');
								$(".alert.alert-info").html('<div align="center"><b>Perubahan Berhasil Disimpan</b></div>');
								window.location=location.href;
							},1000);
					}
					else {
						$.messager.alert('Informasi', data, 'info');
					}
				}  
            });	
		$('#formgambar').form({  
                success:function(data){  
					if(data == 'simpan'){
						$(".alert.alert-info").hide('slow');
						setTimeout(
							function(){ 
								$("html, body").animate({ scrollTop: 0 }, "slow");
								$(".alert.alert-info").show('slow');
								$(".alert.alert-info").html('<div align="center"><b>Perubahan Berhasil Disimpan</b></div>');
								window.location=location.href;
							},1000);
					}
					else {
						$.messager.alert('Informasi', data, 'info');
					}
				}  
            });				
	</script>
<?php $this->load->view('footer') ?>