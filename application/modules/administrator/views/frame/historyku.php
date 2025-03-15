<?php
	if($this->u3){
		$fsvd = "select * from tb_history where sub_type='".$this->u3."' order by id_his ASC ";
		$fvdc = $this->db->query($fsvd);
		$fvvd = $fvdc->result();
	}
?>
sss
<table border="1">
	<?php 
		foreach($fvvd as $vvd){
				$svdv = unserialize($vvd->att_his);
	?>
		<tr>
			<td><?=@$vvd->tanggal?></td>
			<td><?=@$vvd->type?></td>
			<td><?=@$vvd->modul_pas?></td>
			<td><?php print_r($svdv)?></td>
		</tr>
	<?php } ?>
</table>