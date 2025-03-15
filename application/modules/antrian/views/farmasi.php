<?php 
	$ketats = '-';
	$ketbwh = '-';
	$hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
	$sskj  = "select loket_farmasi, id_reg_meta, no_urut_pas, id_pol_reg,  suara_antrian  from  tb_register_meta, tb_register, tb_instalasi where tb_register_meta.unicode_reg_meta=tb_register.unicode_reg ";
	$sskj .= "and tb_register_meta.id_pol_reg=tb_instalasi.id_ins ";
	$sskj .= "and tgl_periksa_meta like '%". date("Y-m-d") ."%' ";
	$sskj .= "and ket_panggil_farmasi='a' ";
	$sskj .= "order by id_reg_meta ASC limit 1";
	$upyt = $this->db->query($sskj);
	$cekghsdsaa = $upyt->result();
	if($cekghsdsaa){
		$abgst = 'style="background:#000000;color:#E2F774;"';
?>
<?php
		//jika ada maka tampilkan datanya dan bunyikan suaranya
		$ketats = $cekghsdsaa[0]->no_urut_pas;
		$ketbwh = "APOTEK ". $cekghsdsaa[0]->loket_farmasi;
		$aktifnya[$cekghsdsaa[0]->loket_farmasi] = 'ok';
		//selelah itu updatelah ya tip
		$uyp['ket_panggil_farmasi'] = 'b';
		$uyp['tgl_panggil_farmasi'] = date("Y-m-d H:i:s");
		$this->db->where('id_reg_meta', $cekghsdsaa[0]->id_reg_meta);
		$this->db->update('tb_register_meta', $uyp);
	} else {
		//cek apakah sudah ada data yang disimpan pada hari ini
		$hjyu  = "select loket_farmasi, id_reg_meta, no_urut_pas,  id_pol_reg from  tb_register_meta, tb_register where tb_register_meta.unicode_reg_meta=tb_register.unicode_reg ";
		$hjyu .= "and tgl_periksa_meta like '%". date("Y-m-d") ."%' ";
		$hjyu .= "and ket_panggil_farmasi='b' ";
		$hjyu .= "order by tgl_panggil_farmasi DESC limit 1";
		$bbhy = $this->db->query($hjyu);
		$bkmll = $bbhy->result();
		if($bkmll){
			//maksudnya adalah sudah ada pasien tapi semua sudah diupdate ke b dan user belum klik antrian baru lagi
			//buat yang untuk ganti warna bloknya
			$ketats = $bkmll[0]->no_urut_pas;
			$ketbwh = "APOTEK ". $bkmll[0]->loket_farmasi;
		}
	}
	
?>
				
<div class="easyui-layout" data-options="fit:true" id="pendaftaran_layout1">
				<div data-options="region:'north',split:true,iconCls:'icon-lock'" title="" style="height:80px;background:linear-gradient(to bottom, #35AEDF 0px, #105BB8 100%) repeat-x scroll 0% 0% transparent;overflow:hidden">
						<div class="judul_atas">APOTEK</div>
				</div>
				<div data-options="region:'center',iconCls:'icon-ok'" title="" style="background:url('<?=base_url('assets/img/bawah.jpg')?>');overflow:hidden">
					<div class="judul_dalam" <?=@$abgst?>><?=@$ketats?></div>
				</div>
				<div data-options="region:'south',split:true,iconCls:'icon-lock'" title="" style="height:100px;background:url('<?=base_url('assets/img/headblue.jpg')?>');border-bottom:solid 10px #F2F5F7;">
					<div class="judul_bawah"><?=@$ketbwh?></div>
					<?php if($cekghsdsaa){ ?>
				<iframe src="<?=@base_url('suara/terbilang.php?no='. clean_data(@substr($cekghsdsaa[0]->no_urut_pas, 1, 10)) .'&loket='. bacaapotek($cekghsdsaa[0]->loket_farmasi) .'&prefik='. clean_data(@substr($cekghsdsaa[0]->no_urut_pas, 0, 1)))?>" frameborder="0" width="0" height="0">
				</iframe>
				<input type="hidden" id="nomorantriokfarmasi" value="isi">
				<?php } else {?>
				<input type="hidden" id="nomorantriokfarmasi" value="kosong">
				<?php } ?>
				</div>
			</div>