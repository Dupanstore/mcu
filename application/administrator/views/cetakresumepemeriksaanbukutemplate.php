       <div class="easyui-tabs" style="width:100%">
        <div title="Indonesia" style="padding:0px">
					
					
			<div align="center">
				<table style="width:98%;font-size:12px;" class="tableeasyui">
					<tr>
						<td width="48%" style="border:solid 1px #cccccc;padding:1px;vertical-align:top;">
							<div style="background:#eeeeee;padding:1px;text-align:center"><b>Lihat Laporan</b></div>
							<table style="width:98%;font-size:11px;">
								<tr>
									<td style="padding:1px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&noprint=true&posisiprint=kanan')">Halaman Cover</button></div></td>
								</tr>
								<?php
									$dasc = 1;
									$dgfa = range(1, 11);
									foreach($dgfa as $gds){
										//gawe halaman kananae
										$halkan = (11*2)+1-$gds;
								?>
								<tr>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&noprint=true&posisiprint=kiri')">Halaman <?=@$gds?></button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&noprint=true&posisiprint=kanan')">Halaman <?=@$halkan?></button></td>
								</tr>
								<?php
									}
								?>
							</table>
						</td>
						<td></td>
						<td width="48%" style="border:solid 1px #cccccc;padding:1px;vertical-align:top;">
							<div style="background:#eeeeee;padding:1px;text-align:center"><b>Cetak Laporan</b></div>
							<table style="width:98%;font-size:11px;">
								<tr>
									<td style="padding:1px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&posisiprint=kanan')">Halaman Cover</button></div></td>
								</tr>
								<?php
									$dasc = 1;
									$dgfa = range(1, 11);
									foreach($dgfa as $gds){
										//gawe halaman kananae
										
										$halkan = (11*2)+1-$gds;
										$hakirik[$gds] = $gds;
										$hakanak[$halkan] = $halkan;
								?>
								<tr>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&posisiprint=kiri')">Halaman <?=@$gds?></button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&posisiprint=kanan')">Halaman <?=@$halkan?></button></td>
								</tr>
								<?php
									}
								?>
								<tr>
									<?php
										//buat halaman kiri
										foreach($hakirik as $iku){
											$newkiri[] = "viewpage[".$iku."]=". $iku;
										}
										foreach($hakanak as $iku){
											$newkanan[] = "viewpage[".$iku."]=". $iku;
										}
									?>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&<?=@implode("&", $newkiri)?>')">Halaman Kiri</button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<?php if(11 >= 5){ ?>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&cetakdarikanan=okcuy&<?=@implode("&", $newkanan)?>')">Halaman Kanan</button></td>
									<?php } else { ?>
									<td style="padding:1px;"><b>Minimal 10 Halaman</b>
									</td>
									<?php } ?>
								</tr>
							</table>
						</td>
					</tr>
				</table>

				</div>
        </div>
        <div title="Inggris" style="padding:0px">
		
		
		
			
				<div align="center">
				<table style="width:98%;font-size:12px;" class="tableeasyui">
					<tr>
						<td width="48%" style="border:solid 1px #cccccc;padding:1px;vertical-align:top;">
							<div style="background:#eeeeee;padding:1px;text-align:center"><b>Lihat Laporan (Inggris)</b></div>
							<table style="width:98%;font-size:11px;">
								<tr>
									<td style="padding:1px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&noprint=true&posisiprint=kanan')">Halaman Cover</button></div></td>
								</tr>
								<?php
									$dasc = 1;
									$dgfa = range(1, 11);
									foreach($dgfa as $gds){
										//gawe halaman kananae
										$halkan = (11*2)+1-$gds;
								?>
								<tr>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&noprint=true&posisiprint=kiri&lang=en')">Halaman <?=@$gds?></button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&noprint=true&posisiprint=kanan&lang=en')">Halaman <?=@$halkan?></button></td>
								</tr>
								<?php
									}
								?>
							</table>
						</td>
						<td></td>
						<td width="48%" style="border:solid 1px #cccccc;padding:1px;vertical-align:top;">
							<div style="background:#eeeeee;padding:1px;text-align:center"><b>Cetak Laporan (Inggris)</b></div>
							<table style="width:98%;font-size:11px;">
								<tr>
									<td style="padding:1px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&posisiprint=kanan')">Halaman Cover</button></div></td>
								</tr>
								<?php
									$dasc = 1;
									$dgfa = range(1, 11);
									foreach($dgfa as $gds){
										//gawe halaman kananae
										
										$halkan = (11*2)+1-$gds;
										$hakirik[$gds] = $gds;
										$hakanak[$halkan] = $halkan;
								?>
								<tr>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&posisiprint=kiri&lang=en')">Halaman <?=@$gds?></button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&posisiprint=kanan&lang=en')">Halaman <?=@$halkan?></button></td>
								</tr>
								<?php
									}
								?>
								<tr>
									<?php
										//buat halaman kiri
										foreach($hakirik as $iku){
											$newkiri[] = "viewpage[".$iku."]=". $iku;
										}
										foreach($hakanak as $iku){
											$newkanan[] = "viewpage[".$iku."]=". $iku;
										}
									?>
									<td style="padding:1px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&<?=@implode("&", $newkiri)?>&lang=en')">Halaman Kiri</button></div></td>
									<td style="padding:1px;" width="1%"> & </td>
									<?php if(11 >= 5){ ?>
									<td style="padding:1px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumtemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&cetakdarikanan=okcuy&<?=@implode("&", $newkanan)?>&lang=en')">Halaman Kanan</button></td>
									<?php } else { ?>
									<td style="padding:1px;"><b>Minimal 10 Halaman</b>
									</td>
									<?php } ?>
								</tr>
							</table>
						</td>
					</tr>
				</table>

				</div>
				
        </div>
    </div>
	<hr style="margin:5px;">
<div align="center">
<button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumumsetup')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&noprint=true&posisiprint=kanan')">Lihat Konfigurasi Template</button>
</div>