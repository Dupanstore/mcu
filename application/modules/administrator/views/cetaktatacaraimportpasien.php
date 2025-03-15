<?php
		$tm = 'tatacara_importpasien';
		header("Content-Type:application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
	?>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/sticky-footer.css')?>">
<?php
?>
<style>
		td{
			border:solid 1px #333333;
			padding:2px;
		}
	</style>
	<?php
		//ambil referensi preposisi
		//ambil preposisi
		$this->db->select('id_pre,  nm_pre');
		$this->db->order_by('id_pre', 'ASC');
		$pre = $this->db->get('tb_preposisi');
		$pre1 = $pre->result();
		//ambil untuk 
		$this->db->select('id_agama,  nm_agama');
		$this->db->order_by('id_agama', 'ASC');
		$agm = $this->db->get('tb_agama');
		$agm1 = $agm->result();
		//ambil untuk  pekerjaan
		$this->db->select('nm_pekerjaan');
		$this->db->order_by('id_pekerjaan', 'ASC');
		$krj = $this->db->get('tb_pekerjaan');
		$krj1 = $krj->result();
		//ambil untuk  pekerjaan
		$this->db->select('nm_status');
		$this->db->order_by('id_status', 'ASC');
		$mar = $this->db->get('tb_status');
		$mar1 = $mar->result();
		//ambil untuk  pekerjaan
		$this->db->select('id_pendidikan, nm_pendidikan');
		$this->db->order_by('id_pendidikan', 'ASC');
		$pen = $this->db->get('tb_pendidikan');
		$pen1 = $pen->result();
		//ambil untuk  pekerjaan
		$this->db->select('id_dinas, nm_dinas');
		$this->db->order_by('id_dinas', 'ASC');
		$bag = $this->db->get('tb_dinas');
		$bag1 = $bag->result();
		//ambil untuk  pekerjaan
		$this->db->select('id_jawatan, nm_jawatan');
		$this->db->order_by('id_jawatan', 'ASC');
		$cab = $this->db->get('tb_jawatan');
		$cab1 = $cab->result();
	?>
<table style="font-size:13px;border-spacing:0;">
	<tr style="background:#ececec;font-weight:bold;">
		<td>No Reg</td>
		<td>Preposisi</td>
		<td>Nama</td>
		<td>Tempat Lahir</td>
		<td>Tgl Lahir</td>
		<td>Jenkel</td>
		<td>Agama</td>
		<td>Alamat</td>
		<td>No KTP</td>
		<td>No Telp</td>
		<td>Pekerjaan</td>
		<td>Jabatan</td>
		<td>Kesatuan</td>
		<td>Pangkat</td>
		<td>Bangsa</td>
		<td>Marital</td>
		<td>Pendidikan</td>
		<td>Golongan Darah</td>
		<td>Nip/NIK</td>
		<td>Jawatan</td>
		<td>Tujuan</td>
		<td>Tanggal Daftar</td>
	</tr>
	<tr>
		<td style="background:red;color:white">N000000001</td>
		<td style="background:red;color:white"><?=@$pre1[0]->id_pre?></td>
		<td>Mansyursyah Latief</td>
		<td>Banjarnegara</td>
		<td style="background:red;color:white">1991-01-01</td>
		<td style="background:red;color:white">L</td>
		<td style="background:red;color:white"><?=@$agm1[0]->id_agama?></td>
		<td>Kalimandi rt01/rw01</td>
		<td>199100008278378</td>
		<td>087738888243</td>
		<td style="background:red;color:white"><?=@$krj1[1]->nm_pekerjaan?></td>
		<td>Programmer</td>
		<td>SKUADRON</td>
		<td>KOLONEL</td>
		<td>Indonesia</td>
		<td style="background:red;color:white"><?=@$mar1[1]->nm_status?></td>
		<td style="background:red;color:white"><?=@$pen1[1]->id_pendidikan?></td>
		<td>B</td>
		<td style="background:red;color:white">01982736</td>
		<td style="background:red;color:white"><?=@$cab1[1]->id_jawatan?></td>
		<td style="background:red;color:white"><?=@$bag1[1]->id_dinas?></td>
		<td style="background:red;color:white">2016-01-25</td>
	</tr>
</table>
<b>Untuk yang warna merah wajib diisi, jika data tidak tersedia maka diisi dengan ID atau Nama yang isinya -</b><hr />
Berikut adalah daftar referensi yang akan digunakan untuk mengisi tabel pasien, Masukan ketabel pasien yang hanya warna <b>hijau</b>....<br />
<table style="font-size:13px;border-spacing:0;border:0;">
	<tr>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td colspan="2" style="background:red;color:white"><b>Referensi Preposisi</b></td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Nama</td>
				</tr>
				<?php foreach($pre1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->id_pre?></td>
					<td><?=@$fs->nm_pre?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td style="background:red;color:white"><b>Referensi Jenkel</b></td>
				</tr>
				<tr>
					<td>Nama</td>
				</tr>
				<tr>
					<td style="background:green;color:white">L</td>
				</tr>
				<tr>
					<td style="background:green;color:white">P</td>
				</tr>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td colspan="2" style="background:red;color:white"><b>Referensi Agama</b></td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Nama</td>
				</tr>
				<?php foreach($agm1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->id_agama?></td>
					<td><?=@$fs->nm_agama?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td style="background:red;color:white"><b>Referensi Pekerjaan</b></td>
				</tr>
				<tr>
					<td>Nama</td>
				</tr>
				<?php foreach($krj1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->nm_pekerjaan?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td style="background:red;color:white"><b>Referensi Marital</b></td>
				</tr>
				<tr>
					<td>Nama</td>
				</tr>
				<?php foreach($mar1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->nm_status?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td colspan="2" style="background:red;color:white"><b>Referensi Pendidikan</b></td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Nama</td>
				</tr>
				<?php foreach($pen1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->id_pendidikan?></td>
					<td><?=@$fs->nm_pendidikan?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td colspan="2" style="background:red;color:white"><b>Referensi Jawatan</b></td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Nama</td>
				</tr>
				<?php foreach($cab1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->id_jawatan?></td>
					<td><?=@$fs->nm_jawatan?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
		<td></td>
		<td style="vertical-align:top;">
			<table style="font-size:13px;border-spacing:0;">
				<tr>
					<td colspan="2" style="background:red;color:white"><b>Referensi Tujuan</b></td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Nama</td>
				</tr>
				<?php foreach($bag1 as $fs){ ?>
				<tr>
					<td style="background:green;color:white"><?=@$fs->id_dinas?></td>
					<td><?=@$fs->nm_dinas?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>