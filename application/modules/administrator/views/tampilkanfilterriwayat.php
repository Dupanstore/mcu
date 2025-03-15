	<?php
		//ambil riwayat kunjungannn....
		$sdvvd = "select a.*,c.nm_paket from tb_register a, tb_pasien b, tb_paket c  where a.no_reg=b.no_reg and a.id_paket=c.id_paket and b.id_pas=".$this->u3." order by a.id_reg DESC ";
		$vsvsn = $this->db->query($sdvvd);
		$gsvds = $vsvsn->result();
	?>
	<div class="easyui-tabs" style="width:100;" fit="true">
		<?php foreach($gsvds as $ddbf){ ?>
        <div title="Paket <?=@$ddbf->nm_paket?> - Tanggal <?=@date("d/m/Y", strtotime($ddbf->tgl_awal_reg))?>" style="padding:0">
             <table style="width:100%">
				<tr>
					<td style="width:50%">
						<iframe src="<?=@base_url('administrator/cetakhasilkesimpulansaranframe/?kode_transaksi='.$ddbf->kode_transaksi.'&id_paket='.$ddbf->id_paket.'&noprint=ok')?>" height="500px" width="100%"></iframe> 
					</td>
					<td>
						<iframe src="<?=@base_url('administrator/cetakresumekesimpulansaranframepdf/?kode_transaksi='.$ddbf->kode_transaksi.'&id_paket='.$ddbf->id_paket.'&noprint=ok')?>" height="500px" width="100%"></iframe> 
					</td>
				</table>
			</table>
	   </div>
		<?php } ?>
    </div>
	