<?php
	//print_r($_GET);
?>
<table style="padding:10px;">
	<tr>
		<td colspan="2"><b style="font-size:16px;text-decoration:underline">Cetak Hasil</b></td>
	</tr>
	<tr>
		<td colspan="2"><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakresumekesimpulansaranframe/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>')" style="width:100%;">Cetak Hasil</button></td>
	</tr>
	<tr>
		<td colspan="2"><br /><b style="font-size:16px;text-decoration:underline">Cetak Hasil (Mode 2)</b></td>
	</tr>
	<tr>
		<td colspan="2"><b>Cetak Dalam Bahasa Indonesia</b></td>
	</tr>
	<tr>
		<td colspan="2"><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakresumekesimpulansaranframepdf/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>')" style="width:100%;">Cetak Hasil (Mode 2)</button></td>
	</tr>
	<tr>
		<td colspan="2"><br /><b>Cetak Dalam Bahasa Inggris</b></td>
	</tr>
	<tr>
		<td colspan="2"><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakresumekesimpulansaranframepdfen/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>')" style="width:100%;">Cetak Hasil  (Mode 2)</button></td>
	</tr>
	
	<tr>
		<td colspan="2"><br /><b style="font-size:16px;text-decoration:underline">Cetak Hasil (Mode 3)</b></td>
	</tr>
	<tr>
		<td colspan="2"><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/cetakresumekesimpulansaranframepdfdinamis/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>')" style="width:100%;">Cetak Hasil  (Mode 3)</button></td>
	</tr>
</table>