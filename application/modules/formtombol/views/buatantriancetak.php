<?php
	//AMBIL YANG SEDANG MENUNGGU
	//kalo poli yaaaaaaaaaaaaaaaaaaaaaaaaaaa
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Huruf besar dan angka
	$uniqueCode = '';
	$codeLength = 6;

	for ($i = 0; $i < $codeLength; $i++) {
		$randomIndex = mt_rand(0, strlen($characters) - 1);
		$uniqueCode .= $characters[$randomIndex];
	}

	if($_GET['typekhusus'] == ""){
	
	//PERTAMA ADALAH AMBIL SEMUA DATANYA YA
	$this->db->where('id_ins', $this->uri->segment(3));
	$this->db->limit('1');
	$rt = $this->db->get('tb_instalasi');
	$sr = $rt->result();	
	$nmpl = "POLIKLINIK ". strtoupper($sr[0]->nm_instalasi);
		$this->db->select('urutan');
		$this->db->where('id_ins', $sr[0]->id_ins);
		$this->db->like('tglmsk', date("Y-m-d"));
		$this->db->order_by('id_met', 'DESC');
		$this->db->limit('1');
		$urut  = $this->db->get('tb_antrian_meta');
		$urut1 = $urut->result();
	//nah selanjutnya ambil nomor antrian nah buat default antrian pertama
	$antrianpertama = 0;
	if($urut1){
		$antrianpertama = $urut1[0]->urutan;
	}
	$urutlanjut = $antrianpertama+1;
	//gadipake yaaaa
	//$newkdurut  = strtoupper($sr[0]->awalan) . sprintf("%03s", $urutlanjut);
	$newkdurut  = strtoupper($sr[0]->awalan) . $urutlanjut;
	//selanjutnya adalah masukkan kedalam tabel antrian meta
	$dtInsert = array(
		'id_ins' => $sr[0]->id_ins,
		'awalan' => $sr[0]->awalan,
		'type' => 'pendaftaran',
		'urutan' => $urutlanjut,
		'kdurutan' => $newkdurut,
		'tglmsk' => date("Y-m-d H:i:s"),
		'kode_unik' => $uniqueCode,
	);
	$apsjjj = strtoupper($sr[0]->awalan) ." <span style='margin:0 0 0 10px;'>".  $urutlanjut ."</span>";
	$this->db->insert('tb_antrian_meta', $dtInsert);
	}else {
		
		//PERTAMA ADALAH AMBIL SEMUA DATANYA YA
		$this->db->where('id_khusus', $this->uri->segment(3));
		$this->db->limit('1');
		$rt = $this->db->get('tb_antrian_khusus');
		$sr = $rt->result();	
		$nmpl = strtoupper($sr[0]->nm_khusus);
			$this->db->select('urutan');
			$this->db->where('id_type_khusus', $sr[0]->id_khusus);
			$this->db->like('tglmsk', date("Y-m-d"));
			$this->db->order_by('id_met', 'DESC');
			$this->db->limit('1');
			$urut  = $this->db->get('tb_antrian_meta');
			$urut1 = $urut->result();
		//nah selanjutnya ambil nomor antrian nah buat default antrian pertama
		$antrianpertama = 0;
		if($urut1){
			$antrianpertama = $urut1[0]->urutan;
		}
		$urutlanjut = $antrianpertama+1;
		//gadipake yaaaa
		//$newkdurut  = strtoupper($sr[0]->awalan) . sprintf("%03s", $urutlanjut);
		$newkdurut  = strtoupper($sr[0]->prefix_khusus) . $urutlanjut;
		//selanjutnya adalah masukkan kedalam tabel antrian meta
		$dtInsert = array(
			'id_type_khusus' => $sr[0]->id_khusus,
			'awalan' => $sr[0]->prefix_khusus,
			'awalan' => $sr[0]->prefix_khusus,
			'type' => 'pendaftaran',
			'urutan' => $urutlanjut,
			'kdurutan' => $newkdurut,
			'tglmsk' => date("Y-m-d H:i:s"),
			'kode_unik' => $uniqueCode,
		);
		$apsjjj = strtoupper($sr[0]->prefix_khusus) ." <span style='margin:0 0 0 10px;'>".  $urutlanjut ."</span>";
		$this->db->insert('tb_antrian_meta', $dtInsert);
	}
	?>
	
	<style>
		body{
			/* width : 346px; */
			font-size : 14px;
			font-family: Arial, Helvetica, sans-serif;
		}
		table, tr, td{
			border : none;
			border-collapse: collapse;
		}
		td{
			/*height : 16px;*/
		}
		.bordered_table, .bordered_table tr, .bordered_table td {
			border : 1px solid black;
			/*border-collapse : collapse;*/
		}
		@media print {
			.header, .hide { visibility: hidden }
		}
	</style>
	
	
	
	
	
<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/sticky-footer.css')?>">
<div align="center" style="margin:-10px 0 0 -15px;">	
	<div class="yayaya" style="padding:0cm;margin:-2px 0 1px 0 0px;border:0px solid #333333;width:7cm;background:#FFFFFF;">
		
		<table width="150" border="0">
		<tr>
			<td align="center" style="font-size:normal;">
				<b><?=@$this->madmin->admin_getsetting('app_name')?><b>
				<!-- <p style="margin: 5px 0px 0px 0px;font-size:9px;">Jl. Jatiwinangun No. 16 Purwokerto, 53114</p> -->
				<p style="margin: 0px 0px 10px 0px;font-size:9px;">Telp.  (021) 7980002</p>
			</td>
		</tr>
		<!-- <tr>
			<td colspan="3" align="center">
				<b>Tanda Bukti Registrasi Pendaftaran</b>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">&nbsp;</td>
		</tr> -->
		<tr>
			<td align="center"><?=@is_hari(date("w"))?>, <?=@the_time(date("Y-m-d"))?> <?=@date("H:i:s")?></td>
		</tr>
		<tr>
			<td align="center" style="border: 1px solid black;">No. Antrian</td>
		</tr>
		<tr>
			<td align="center" style="border: 1px solid black; font-size:normal;">
				PENDAFTARAN			</td>
		</tr>
		<tr>
			<td align="center" style="border: 1px solid black; font-size:62px;">
				<b><?=@$apsjjj?></b>
			</td>
		</tr>
		<tr>
			<td align="center">
				Kode : <b><?=@$uniqueCode?></b>
			</td>
		</tr>
	</table>
	</div>
</div>
<script type="text/javascript">
	window.print();
</script>