<?php
	$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
	$this->db->where('id_ins', $_POST['idins']);
	$this->db->order_by('id_dgs', 'DESC');
	$cekq = $this->db->get('tb_register_diagnosa');
	$sbbd = $cekq->result();
	
	$this->db->where('id_poli', $_POST['idins']);
	$this->db->order_by('nm_icd', 'ASC');
	$mdbb = $this->db->get('tb_icd');
	$ndbs = $mdbb->result();
?>
<table class="tableeasyui" style="width:100%">
	<tr>
		<td style="width:5%"><b><button type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;" onclick="tambahkandiagnosapenyakit('<?=@$_POST['kode_transaksi']?>', '<?=@$_POST['idins']?>')">Tambah</button></b></td>
		<td style="width:5%"><b>No</b></td>
		<td><b>Diagnosa Penyakit</b></td>
	</tr>
	<?php
		$bsv = 1;
		foreach($sbbd as $gbbs){
			$ndp = $bsv++;
	?>
	<tr>
		<td><button type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;" onclick="hapuskandiagnosapenyakit('<?=@$gbbs->id_dgs?>')">Hapus</button></td>
		<td>
			<?=@$ndp?>
		</td>
		<td>
			<select style="width:100%" onchange="rubahkandiagnosapenyakit('<?=@$gbbs->id_dgs?>', this.value)">
				<option value=""></option>
				<?php 
					foreach($ndbs as $va){ 
					$sel = "";
					if($gbbs){
						if($gbbs->id_diag == $va->id_icd){
							$sel = 'selected="true"';
						}
					}
				?>
					<option value="<?=@$va->id_icd?>" <?=@$sel?>><?=@$va->nm_icd?></option>
				<?php } ?>
				</select>
		</td>
	</tr>
	<?php } ?>
</table>
<script>
	function tambahkandiagnosapenyakit(kodetrs, idins){
		$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/tambahkandiagnosapenyakit/')?>", {
			kodetrs:kodetrs, idins:idins,
		}, function(response){	
			getuntukdiagnosapenyakit();
		});
	}
	
	function hapuskandiagnosapenyakit(ids){
		$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapuskandiagnosapenyakit/')?>", {
			ids:ids,
		}, function(response){	
			getuntukdiagnosapenyakit();
		});
	}
	
	function rubahkandiagnosapenyakit(ids, isi){
		$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/rubahkandiagnosapenyakit/')?>", {
			ids:ids,isi:isi,
		}, function(response){	
			//getuntukdiagnosapenyakit();
		});
	}
</script>