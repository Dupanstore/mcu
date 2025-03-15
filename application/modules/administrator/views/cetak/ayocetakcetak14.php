<?php
	
	//print_r($_GET);
	//MARI KITA BUAT LAPORAN
	$kesatuanpanpas = urldecode($_GET['kesatuan_pas']);
	$carabayarpas = urldecode($_GET['cara_bayar']);
	if(isset($_GET['typecetak'])){
		if($_GET['typecetak'] == 'print'){
			echo '
				<script type="text/javascript">
				<!--
				//window.print();
				//-->
				</script>';
		} else if($_GET['typecetak'] == 'excel'){
			$tm = 'lap_penerimaan_tagihan';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}
		$tglawal = date("d/m/Y", strtotime($_GET['tanggalawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['tanggalakhir']));
		$que  = " select a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, f.nm_paket, f.harga_paket ";
		$que .= " from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas e, tb_paket f ";
		$que .= " where a.no_reg=b.no_reg ";
		$que .= " and b.id_jawatan=c.id_jawatan ";
		$que .= " and a.id_paket=f.id_paket ";
		$que .= " and b.id_dinas=e.id_dinas ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		
		
		//ambil hasilllll labb
		$que  = " select x.hasilnya, a.id_reg, x.id_pem_deb, x.id_paket ";
		$que .= " from tb_register_detailpemeriksaan x, tb_register a, tb_pasien b ";
		$que .= " where x.kode_transaksi=a.kode_transaksi ";
		$que .= " and a.no_reg=b.no_reg ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " and x.id_pem_deb > 0";
		$nsh = $this->db->query($que);
		$nss = $nsh->result();
		foreach($nss as $hsh){
			$hasill[$hsh->id_reg][$hsh->id_pem_deb] = $hsh->hasilnya;
		}
		//print_r($hasill);
		
?>
<style>
	th, td{
			font-size:14px;
			PADDING:3PX;
			border:solid 1px #333333;
			vertical-align:top;
	}
	.bordernone td{
		border:none;
	}
</style>
<style>
        .ps {
            writing-mode: vertical-lr;
            -webkit-writing-mode: vertical-lr;
            -moz-writing-mode: vertical-lr;
        }
    </style>
		<div align="center">
			<h4>
			<?=@urldecode($_GET['judulatas'])?><br />
			<?=@urldecode($_GET['judultengah'])?><br />
			<?=@urldecode($_GET['judulbawah'])?>
			<?php if(isset($_GET['id_dinas'])){ ?>
			<!--<br />(
			<?php  
				//echo  implode(", ", $hhhsw);
			?>
			)-->
			<?php } ?>
			</h4>
		</div>
		<table style="width:100%;border-spacing:0;">
			<tr>
				<td rowspan="2" width="1%" style="vertical-align:middle;text-align:center;">NO</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">NAMA</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">PANGKAT</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">NRP</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">KESATUAN</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">PAKET</td>
				<td rowspan="2" style="vertical-align:middle;text-align:center;">TANGGAL PERIKSA</td>
				<td colspan="6" style="vertical-align:middle;text-align:center;">Hematologi</td>
				<td colspan="6" style="vertical-align:middle;text-align:center;">Hitung Jenis</td>
				<td colspan="18" style="vertical-align:middle;text-align:center;">Kimia Darah</td>
				<td colspan="4" style="vertical-align:middle;text-align:center;">Imonoserologi</td>
				<td colspan="13" style="vertical-align:middle;text-align:center;">Urinalisa</td>
				<td colspan="3" style="vertical-align:middle;text-align:center;">Pemeriksaan Drug</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">LED</td>
				<td style="vertical-align:middle;text-align:center;">Hemoglobin</td>
				<td style="vertical-align:middle;text-align:center;">Leukosit</td>
				<td style="vertical-align:middle;text-align:center;">Eritrosit</td>
				<td style="vertical-align:middle;text-align:center;">Hematokrit</td>
				<td style="vertical-align:middle;text-align:center;">Trombosit</td>
				<td style="vertical-align:middle;text-align:center;">Eosinofil</td>
				<td style="vertical-align:middle;text-align:center;">Basofil</td>
				<td style="vertical-align:middle;text-align:center;">Netrofil</td>
				<td style="vertical-align:middle;text-align:center;">Limfosit</td>
				<td style="vertical-align:middle;text-align:center;">Monosit</td>
				<td style="vertical-align:middle;text-align:center;">Malaria</td>
				<td style="vertical-align:middle;text-align:center;">Bilirubin Total</td>
				<td style="vertical-align:middle;text-align:center;">Bilirubin Direk</td>
				<td style="vertical-align:middle;text-align:center;">Bilirubin Indirek</td>
				<td style="vertical-align:middle;text-align:center;">Protein Total</td>
				<td style="vertical-align:middle;text-align:center;">Albumin</td>
				<td style="vertical-align:middle;text-align:center;">Globulin</td>
				<td style="vertical-align:middle;text-align:center;">Alkali Fostafase</td>
				<td style="vertical-align:middle;text-align:center;">SGPT</td>
				<td style="vertical-align:middle;text-align:center;">SGOT</td>
				<td style="vertical-align:middle;text-align:center;">Kolesterol Total</td>
				<td style="vertical-align:middle;text-align:center;">Trigleserida </td>
				<td style="vertical-align:middle;text-align:center;">Kolesterol HDL</td>
				<td style="vertical-align:middle;text-align:center;">Kolesterol LDL</td>
				<td style="vertical-align:middle;text-align:center;">Ureum</td>
				<td style="vertical-align:middle;text-align:center;">Kreatinin</td>
				<td style="vertical-align:middle;text-align:center;">Asam Urat </td>
				<td style="vertical-align:middle;text-align:center;">Glukosa Puasa</td>
				<td style="vertical-align:middle;text-align:center;">Glukosa 2 Jam PP </td>
				<td style="vertical-align:middle;text-align:center;">HBsAg </td>
				<td style="vertical-align:middle;text-align:center;">Anti HCV  </td>
				<td style="vertical-align:middle;text-align:center;">VDRL </td>
				<td style="vertical-align:middle;text-align:center;">Anti HIV </td>
				<td style="vertical-align:middle;text-align:center;">Warna  </td>
				<td style="vertical-align:middle;text-align:center;">Keton  </td>
				<td style="vertical-align:middle;text-align:center;">Nitrit  </td>
				<td style="vertical-align:middle;text-align:center;">Darah </td>
				<td style="vertical-align:middle;text-align:center;">Leukosit</td>
				<td style="vertical-align:middle;text-align:center;">PH  </td>
				<td style="vertical-align:middle;text-align:center;">Berat Jenis </td>
				<td style="vertical-align:middle;text-align:center;">Protein </td>
				<td style="vertical-align:middle;text-align:center;">Reduksi  </td>
				<td style="vertical-align:middle;text-align:center;">Urobilin  </td>
				<td style="vertical-align:middle;text-align:center;">Bilirubin </td>
				<td style="vertical-align:middle;text-align:center;">Sedimen Leukosit  </td>
				<td style="vertical-align:middle;text-align:center;">Sedimen Epithel </td>
				<td style="vertical-align:middle;text-align:center;">Amphetamin  </td>
				<td style="vertical-align:middle;text-align:center;">Marijuana </td>
				<td style="vertical-align:middle;text-align:center;">Morphin  </td>
			</tr>
			<?php
				$nk=1;
				
				foreach($abd as $bs){
					$so=$nk++;
		?>
			<tr>
				<td><?=@$so?></td>
				<td><?=@$bs->nm_pas?></td>
				<td><?=@$bs->pangkat_pas?></td>
				<td>&nbsp; &nbsp; <?=@$bs->nip_nrp_nik?></td>
				<td><?=@$bs->nm_jawatan?></td>
				<td><?=@$bs->nm_paket?></td>
				<td><?=@date("Y-m-d",strtotime($bs->tgl_awal_reg))?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][1]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][2]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][3]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][4]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][5]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][6]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][7]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][8]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][283]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][11]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][12]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][20]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][35]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][36]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][82]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][38]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][39]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][40]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][37]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][33]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][34]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][29]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][32]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][30]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][31]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][26]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][27]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][28]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][24]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][25]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][76]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][99]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][349]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][75]?></td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][41]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][42]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][43]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][44]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][330]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][282]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][46]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][47]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][48]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][49]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][50]?> </td>
				<td style="vertical-align:middle;text-align:center;">&nbsp; &nbsp; <?=@$hasill[$bs->id_reg][52]?> </td>
				<td style="vertical-align:middle;text-align:center;">&nbsp; &nbsp; <?=@$hasill[$bs->id_reg][54]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][284]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][286]?> </td>
				<td style="vertical-align:middle;text-align:center;"><?=@$hasill[$bs->id_reg][288]?> </td>
			</tr>
		<?php } ?>
		</table>
			
