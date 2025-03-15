<?php
	//print_r($_GET);
?>
<table style="padding:10px;">
	<tr>
		<td>Jumlah Cetak:</td>
		<td>
		<select id="jumpilcetak">
			<?php foreach(range(1,20) as $ggd){ ?>
			<option value="<?=@$ggd?>"><?=@$ggd?></option>
			<?php } ?>
		</select>
		</td>
		<td><button style="cursor:pointer" type="button" onclick="window.open('<?=@base_url($this->u1)?>/<?=@$_GET['uriku']?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&jumcetak='+jumpilcetak.value)" style="width:100%;">Cetak</button></td>
	</tr>
</table>