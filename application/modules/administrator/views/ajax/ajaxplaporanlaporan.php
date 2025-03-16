<form method="POST" id="akuinginsehatlaporan" action="javascript:void(0)">
<fieldset style="border:#cccccc 1px dotted;margin:5px;background:#E0EFFB">
	<legend></legend>
		<table style="width:100%" cellpadding="2px;">
		<?php
			$judatas = "";
			$judtengah = "";
			$judbawah = "";
			if($this->u3 == "a1"){
				$judatas = "HASIL PEMERIKSAAN KESEHATAN";
				$judtengah = "CALON SISWA SEKBANG TERPADU";
				$judbawah = "";
			}
			if($this->u3 == "a2"){
				$judatas = "LAPORAN HASIL ILA/MEDEX KORPS PENERBANG NAVIGATOR ILA JMU, MEDEX JMU";
				$judtengah = "DI LAKESPRA dr. SARYANTO";
				$judbawah = "";
			}
			if($this->u3 == "a4"){
				$judatas = "HASIL PEMERIKSAAN KESEHATAN";
				$judtengah = "CALON SISWA SEKBANG TERPADU";
				$judbawah = "";
			}
			if($this->u3 == "a5"){
				$judatas = "HASIL PEMERIKSAAN KESEHATAN";
				$judtengah = "";
				$judbawah = "";
			}
			if($this->u3 == "a6"){
				$judatas = "HASIL PEMERIKSAAN KESEHATAN";
				$judtengah = "REKAPITULASI PEMERIKSAAN KESEHATAN KEMENKES";
				$judbawah = "";
			}
			if($this->u3 == "a9"){
				$judatas = "LAPORAN OVERWEIGHT, OBESITAS PENERBANG";
				$judtengah = "DI LAKESPRA SARYANTO";
				$judbawah = "";
			}
			if($this->u3 == "a10"){
				$judatas = "LAPORAN KARYAWAN";
				$judtengah = "YANG MELAKSANAKAN MEDICAL CHECK UP";
				$judbawah = "DI LAKESPRA SARYANTO";
			}
			if($this->u3 == "a11"){
				$judatas = "BUKU KAS UMUM";
				$judtengah = "DANA PNBP YANMASUM LAKESPRA SARYANTO";
				$judbawah = "";
			}
			if($this->u3 == "a11"){
				$judatas = "DAFTAR PEGAWAI";
				$judtengah = "Yang Telah Melakukan Medical Checkup";
				$judbawah = "DI LAKESPRA SARYANTO";
			}
			if($this->u3 == "a13"){
				$judatas = "LAPORAN TOP 10 PENYAKIT";
				$judtengah = "";
				$judbawah = "";
			}
			if($this->u3 == "a14"){
				$judatas = "LAPORAN KESEHATAN LABORATORIUM (DINAS)";
				$judtengah = "";
				$judbawah = "";
			}
			if($this->u3 == "a15"){
				$judatas = "Rekapan Hasil MCU";
				$judtengah = "";
				$judbawah = "";
			}
			if($this->u3 == "a16"){
				$judatas = "Rekapan Hasil Spirometri";
				$judtengah = "";
				$judbawah = "";
			}
			
		?>
		<input type="hidden" name="urilaporan" value="<?=@$this->u3?>">
					<tr>
						<td>Perusahaan/Kesatuan</td>
						<td style="width:30%">
							<select  name="id_jawatan"  id="id_jawatan" style="width:100%">
								<option value="">--Semua--</option>
								<?php 
									$this->db->select('id_jawatan, nm_jawatan');
									$this->db->order_by('nm_jawatan', 'ASC');
									$cmb1 = $this->db->get('tb_jawatan');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
									
								?>
									<option value="<?=@$va->id_jawatan?>" <?=@$sel?>><?=@$va->nm_jawatan?></option>
								<?php } ?>
								</select>
						</td>
						<td>Kode</td>
						<td>
							<?php
								$lappp = "getnamadinas";
								if($this->u3 == "a2"){
									$lappp = "getnamadinasilamedex";
								}
								if($this->u3 == "a9"){
									$lappp = "getnamadinasilamedex";
								}
								if($this->u3 == "a5"){
									$lappp = "getnamadinaspatiau";
								}
								if($this->u3 == "a6"){
									$lappp = "getnamadinaskemenkes";
								}
							
							?>
							<input  name="id_dinas[]" id="id_dinas" class="easyui-combotree" data-options="url:'<?=@base_url('administrator/'. $lappp)?>',method:'get',label:'Select Nodes:',labelPosition:'top',multiple:true" style="width:100%">
							
						</td>
					</tr>
					<tr>
						<td>Type</td>
						<td>
							<select name="kesatuan_pas" id="kesatuan_pas"  style="width:100%">
							<option value="">--Semua--</option>
							<?php 
								foreach(is_kesatuan() as $ke => $va){ 
							?>
								<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
							<?php } ?>
							</select>
						</td>
						<td >Cara Bayar</td>
						<td >
							<select  name="cara_bayar" id="cara_bayar" style="width:100%">
								<option value="">--Semua--</option>
								<?php 
									$this->db->select('id_bayar, nm_bayar');
									$this->db->order_by('id_bayar', 'ASC');
									$cmb1 = $this->db->get('tb_bayar');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
								?>
									<option value="<?=@$va->nm_bayar?>" <?=@$sel?>><?=@$va->nm_bayar?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Dari Tanggal</td>
						<td>
							<input class="easyui-datebox" name="tanggalawal" style="width:100%;" value="<?=@date('m/d/Y')?>">
						</td>
						<td ></td>
						<td >
							
						</td>
					</tr>
					
					<tr>
						<td>Tanggal Akhir</td>
						<td>
							<input class="easyui-datebox" name="tanggalakhir" style="width:100%;" value="<?=@date('m/d/Y')?>">
						</td>
						<td ></td>
						<td >
							
						</td>
					</tr>
					<?php 
						if($this->u3 == "a6"){
					?>
					<tr>
						<td>Range Usia</td>
						<td>
							<select  name="usia_awal" id="usia_awal" style="width:100%">
								<option value="">-</option>
								<?php 
									foreach(range(10,100) as $va){ 
								?>
									<option value="<?=@$va?>" <?=@$sel?>><?=@$va?> Tahun</option>
								<?php } ?>
							</select>
						</td>
						<td >
						Sampai
						</td>
						<td >
							<select  name="usia_akhir" id="usia_akhir" style="width:80%">
								<option value="">-</option>
								<?php 
									foreach(range(10,100) as $va){ 
								?>
									<option value="<?=@$va?>" <?=@$sel?>><?=@$va?> Tahun</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<?php } ?>
					
					<?php if($this->u3 == "a13"){ ?>
					<tr>
						<td>Unit / Ruang</td>
						<td>
							<input  name="id_unit[]" id="id_unit" class="easyui-combotree" data-options="url:'<?=@base_url('administrator/getinstalasi')?>',method:'get',label:'Select Nodes:',labelPosition:'top',multiple:true" style="width:100%">
						</td>
						<td ></td>
						<td >
							
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td>Judul Atas</td>
						<td colspan="3">
							<input class="text" name="judulatas" style="width:100%;" value="<?=@$judatas?>">
						</td>	
					</tr>
					<tr>
						<td>Judul Tengah</td>
						<td colspan="3">
							<input class="text" name="judultengah" style="width:100%;" value="<?=@$judtengah?>">
						</td>	
					</tr>
					<tr>
						<td>Judul Bawah</td>
						<td colspan="3">
							<input class="text" name="judulbawah" style="width:100%;" value="<?=@$judbawah?>">
						</td>	
					</tr>
					<tr>
						<td></td>
						<td colspan="3">
							<button type="button" class="easyui-linkbutton" style="cursor:pointer" onclick="bukalaporan('print')">Tampilkan Dilayar</button>
							<button type="button" class="easyui-linkbutton" style="cursor:pointer" onclick="bukalaporan('excel')">Import Data ke Excel</button>
						</td>
					</tr>
		</table>
		<br />
</fieldset>
</form>
<script type="text/javascript">
function rubahpaketlaporanlaporan(vall){
			$.post('<?=@base_url('administrator/caripaketpasien')?>',{id:vall},function(result){ 
				$('#defaultpaket').html(result);
				abcdetampil();
			}); 
		}
</script>