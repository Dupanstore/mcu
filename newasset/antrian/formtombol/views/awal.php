<?php $this->load->view('header'); 
?>
<div class="container">
			<h3><span id="judulnya"><p class="text-center" style="font-size:26px;font-weight:bold;margin:-60px 0 20px 0;"><?=@$this->mglobal->Get_setting('app_name')?></p></span></h3>

	<div id="semuanya">
		<span id="judulnya"><p class="text-center">Sistem Informasi Manajemen Antrian</p></span>
		<span id="subnya"><p class="text-center">Pilih Menu dibawah ini untuk melanjutkan
		</p></span>
		<div id="logobawah">
				<div class="container">
					<div class="box-content">
						<div id="jd"></div>
						<div class="konten_dalam" style="margin-top:-30px;">
							<div align="center">
								<ul>
									<li <?=@$pr?>><a href="javascript:void(0)"  <?=@$ddk?> style="padding:10px 20px 0 10px;"><img src="<?=base_url('assets/img/util.png')?>" />Pengaturan</a></li>
									<li <?=@$pr?>><a href="javascript:void(0)"  <?=@$ddk?> style="padding:10px 20px 0 10px;"><img src="<?=base_url('assets/img/ehr.png')?>" />Tampilan</a></li>
									<li <?=@$pr?>><a href="javascript:void(0)"  <?=@$ddk?> style="padding:10px 20px 0 10px;"><img src="<?=base_url('assets/img/queue.png')?>" />Antrian</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div><br />
	<p class="text-center" style="color:#fff;font-size:11px;text-shadow:1px 1px 0px #666;">Powered by: PT. Vikosha Perdana Tekhnologi</p>
	<p class="text-center" style="color:#fff;font-size:11px;text-shadow:1px 1px 0px #666;margin-top:-7px;">Versi 1.0</p>
</div>