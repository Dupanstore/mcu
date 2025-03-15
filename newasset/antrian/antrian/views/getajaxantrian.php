<style>
	#antrian_bawah{
		border-radius:10px;
		background:url('<?=base_url('assets/img/detik.jpg')?>')
	}
	#antrian_atas{
		border-radius:10px;
		
		
	}
</style>
<?php 
	$ketats = '-';
	$ketbwh = 'ANTRIAN DITUTUP';
	$hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
	$sskj  = "select * from tb_antrian_meta ";
	$sskj .= "where type='pendaftaran' ";
	$sskj .= "and tglmsk like '%". date("Y-m-d") ."%' ";
	$sskj .= "and status='a' ";
	$sskj .= "order by id_met ASC limit 1";
	$upyt = $this->db->query($sskj);
	$cekk = $upyt->result();
	if($cekk){
		//jika ada maka tampilkan datanya dan bunyikan suaranya
		$ketats = $cekk[0]->kdurutan;
		$ketbwh = "LOKET ". $cekk[0]->loket_pendaftaran;
		//buat yang untuk ganti warna bloknya
		$aktifnya[$cekk[0]->loket_pendaftaran] = 'ok';
		//selelah itu updatelah ya tip
		$uyp['status'] = 'b';
		$this->db->where('id_met', $cekk[0]->id_met);
		$this->db->update('tb_antrian_meta', $uyp);
	} else {
		//cek apakah sudah ada data yang disimpan pada hari ini
		$hjyu  = "select * from tb_antrian_meta ";
		$hjyu .= "where type='pendaftaran' ";
		$hjyu .= "and tglmsk like '%". date("Y-m-d") ."%' ";
		$hjyu .= "and status='b' ";
		$hjyu .= "order by tglupdate DESC limit 1";
		$bbhy = $this->db->query($hjyu);
		$bkmll = $bbhy->result();
		if($bkmll){
			//maksudnya adalah sudah ada pasien tapi semua sudah diupdate ke b dan user belum klik antrian baru lagi
			$ketats = $bkmll[0]->kdurutan;
			$ketbwh = "LOKET ". $bkmll[0]->loket_pendaftaran;
			//buat yang untuk ganti warna bloknya
			$aktifnya[$bkmll[0]->loket_pendaftaran] = 'ok';
		}
	}
					$mjbs  = "select kdurutan from tb_antrian_meta ";
					$mjbs .= "where type='pendaftaran' ";
					$mjbs .= "and loket_pendaftaran='0' ";
					$mjbs .= "and tglmsk like '%". date("Y-m-d") ."%' ";
					$ksnd = $this->db->query($mjbs);
					$aoiu = $ksnd->num_rows();
					$sisa = $aoiu;
?>
<table style="width:100%;margin:0px 0 0 0;border:solid 12px #eeefff">
	<tr>
		<td colspan="3" rowspan="2" width="60%" style="vertical-align:top;">
			<div align="left">
				<div id="antrian_atas" style="height:685px;margin:0;">
				<div class="antrian_dalam_atas" style="height:50px;margin-top:15px;background:url('<?=base_url('assets/img/headblue.jpg')?>')">
					<div align="center"><p style="font-size:36px;color:#E2F774;font-weight:bold;font-family:arial;margin:1px 0 0 0;"><?=@strtoupper($this->madmin->admin_getsetting('app_name'))?></p></div>
				</div>
				</div>
			</div>
		</td>
		<td colspan="2" width="50%" style="vertical-align:top;">
			<div align="right">
				
				<div id="antrian_atas">
					<div class="antrian_dalam_atas">
						<div align="center" style="margin:-20px 0 0 0;">
							<span style="font-size:180px;"><?=@$ketats?></span><br /><br /><br />
							<p><?=@$ketbwh?></p><br /><br /><br /><br />
							<?php if($ketbwh != "ANTRIAN DITUTUP"){ ?>
							<p style="font-size:20px;color:white">ANTRIAN BELUM DIPANGGIL = <?=@$sisa?></p>
							<?php } ?>
						</div>
					</div>
					
				</div>
				
			</div>
		</td>
	</tr>
	<tr>
		<?php
			foreach (range(1,2) as $val){
			$peno = $val;
			//CEK APAKAH ADA USERNYA ATAU TIDAK....
			$this->db->where("loket_pendaftaran", $val);
			$this->db->limit("1");
			$gopsn = $this->db->get('tb_user');
			$fsahs = $gopsn->row();
			$inbb = "OFFLINE";
			if($fsahs){
				$inbb = "PENDAFTARAN";
			}
			$apx = '';
			$angka = '-';
			$juman = '-';
			$nmlok = '<s>'. strtoupper($peno) .'</s>';
			$logo = 'offline';
				if($aktifnya[$peno]){
					//untuk membuat aktif diwarnanya
					$apx = "_aktif";
					
				}
				if($fsahs){
					$angka = '-';
					$juman = '0';
					$nmlok = ''. strtoupper($peno) .'';
					$logo = 'info';
					$op  = "select kdurutan from tb_antrian_meta ";
					$op .= "where type='pendaftaran' ";
					$op .= "and loket_pendaftaran='". $val ."' ";
					$op .= "and tglmsk like '%". date("Y-m-d") ."%' ";
					$op .= "and status='b' ";
					$op .= "order by tglupdate DESC ";
					$upo = $this->db->query($op);
					$trr = $upo->result();
					$angkaattas = '-';
					$totlll = '-';
					if($trr){
						$angka = $trr[0]->kdurutan;
					}
				}
		?>
		<td width="20%" style="vertical-align:top;">
			<div align="right">
				<div id="antrian_bawah" style="text-align:left;">
					<p class="head_atas" style="text-align:left;">
						<img src="<?=@base_url('assets/img/arrow.png')?>" style="width:70px;margin:-20px 0 0 -10px">
						<b class="judul_atas">LOKET <?=@strtoupper($val)?></b>
					</p>
					
					<div class="antrian_dalam_bawah">
						<div align="center">
							<span><?=@$angka?></span>
						</div>
					</div>
					<div class="antrian_dalam_loket<?=@$apx?>">
						<img src="<?=@base_url('assets/img/'. $logo .'.png')?>" style="width:46px;margin:-3px 0 0 85%;opacity:0.7;">
						<span style="font-size:21px;margin-top:-37px;"><?=@$inbb?></span>
					</div>
				</div>
			</div>
		</td>
		<?php } ?>
	</tr>
</table>

<?php if($cekk){ ?>
<iframe src="<?=@base_url('suara/terbilang.php?no='. clean_data(@$cekk[0]->urutan) .'&loket='. bacaloket($cekk[0]->loket_pendaftaran) .'&prefik='. clean_data(@$cekk[0]->awalan))?>" frameborder="0" width="0" height="0">
</iframe>
<input type="hidden" id="nomorantriok" value="isi">
<?php } else {?>
<input type="hidden" id="nomorantriok" value="kosong">
<?php } ?>
<script type="text/javascript">
$('.carousel').carousel({
  interval: 3000
})
setTimeout('Ajax()',1000);
</script>