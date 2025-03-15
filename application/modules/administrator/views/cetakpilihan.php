<?php
	//print_r($_GET);
?>
<table style="padding:10px;">
	<tr>
		<td colspan="2"><b style="font-size:16px;text-decoration:underline">Resume Medis Format HTML</b></td>
	</tr>
	<tr>
		<td colspan="2"><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakhasilkesimpulansaranframe/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>')" style="width:100%;">Cetak Resume</button></td>
	</tr>
	<tr>
		<td colspan="2"><br /><b style="font-size:16px;text-decoration:underline">Resume Medis Format PDF</b></td>
	</tr>
	<tr>
		<td colspan="2"><b>Cetak Dalam Bahasa Indonesia</b></td>
	</tr>
	<tr>
		<td>Jumlah Cetak:</td>
		<td>
		<select id="jumpilcetakid">
			<?php foreach(range(1,20) as $ggd){ ?>
			<option value="<?=@$ggd?>"><?=@$ggd?></option>
			<?php } ?>
		</select>
		</td>
		<td><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/<?=@$_GET['uriku']?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&jumcetak='+jumpilcetakid.value)" style="width:100%;">Cetak</button></td>
		<td><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/<?=@$_GET['uriku']?>vdua/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&jumcetak='+jumpilcetakid.value)" style="width:100%;">Cetak V2</button></td>
	</tr>
	<tr>
		<td colspan="2"><br /><b>Cetak Dalam Bahasa Inggris</b></td>
	</tr>
	<tr>
		<td>Jumlah Cetak:</td>
		<td>
		<select id="jumpilcetaken">
			<?php foreach(range(1,20) as $ggd){ ?>
			<option value="<?=@$ggd?>"><?=@$ggd?></option>
			<?php } ?>
		</select>
		</td>
		<td><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakhasilkesimpulansaranframepdfen/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&jumcetak='+jumpilcetaken.value)" style="width:100%;">Cetak</button></td>
	</tr>
</table>