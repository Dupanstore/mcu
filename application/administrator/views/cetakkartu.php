<?php
	$sahud  = "SELECT  tb_pasien.*, tb_register.kode_transaksi from tb_register, tb_pasien  where tb_register.no_reg=tb_pasien.no_reg and kode_transaksi='".$this->u3."' limit 1";
	$daplun = $this->db->query($sahud);
	$jafuk  = $daplun->row();
?>
<body style="background:#666666; ">
<div align="center" >	
	<div class="yayaya" style="padding:0cm;margin:3px 0 13px 0;border:0px solid #333333;width:10cm;background:#FFFFFF;font-family:tahoma;margin-top: 150px; margin-left: -170px; margin-bottom: 0; margin-right: -100px;padding-top: 77px;">
		<table width="100%" cellpadding="1px" >
			<tr>
				<?php if(file_exists('cam/gambar/' .$this->u3 .'.jpg')){ ?>
				<td rowspan="3" style="width:5px;vertical-align:top;">
					<img src="<?=@base_url('cam/gambar/' .$this->u3 .'.jpg')?>" style="width:70px;">
				</td>
				<?php } ?>
				<td style="vertical-align:top;">
					<p style="margin:0px;padding:0;font-size:12px;font-weight:bold"><?=@$jafuk->nm_pas?></p>
					<p style="margin:0;padding:0;font-size:10px;"><?=@$jafuk->no_reg?></p>
				</td>
				<td style="vertical-align:top;">
					
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;" colspan="2">
					<p style="margin:0;font-size:10px;"><?=@$jafuk->alamat_pas?></p>
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;" colspan="2">
					<div align="left" style="margin-left: 0px;margin-top: 5px">
					<?=@bar128(stripslashes($jafuk->no_reg)); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>

		
	</div>
	</div>
</body>
<script type="text/javascript">
				<!--
				window.print();
				//-->
				</script>