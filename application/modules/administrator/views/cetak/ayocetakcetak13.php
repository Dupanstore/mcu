<?php
	
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
			$tm = 'lap_top_penyakit';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}
		$tglawal = date("d/m/Y", strtotime($_GET['tanggalawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['tanggalakhir']));
		$que  = " select count(id_dgs) as ttldiag, id_icd, nm_icd ";
		$que .= " from tb_register_diagnosa x, tb_register a, tb_pasien b, tb_icd c ";
		$que .= " where x.kode_transaksi=a.kode_transaksi ";
		$que .= " and a.no_reg=b.no_reg ";
		$que .= " and x.id_diag=c.id_icd ";
		$que .= " and a.no_reg=b.no_reg ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(isset($_GET['id_unit'])){
			$que 	.= " and x.id_ins IN (".implode(', ', $_GET['id_unit']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		//$que 	.= " and e.ila_medex IN ('ila', 'medex') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " group by c.id_icd";
		$nsh = $this->db->query($que);
		$abd = $nsh->result();
		
		
		foreach($abd as $sbdb){
			$ndbbb[$sbdb->id_icd] = $sbdb->ttldiag;
			$bssnbs[$sbdb->id_icd] = $sbdb->nm_icd;
		}
		arsort($ndbbb);
		$ndb=1;
		foreach($ndbbb as $nsbn => $bsbdn){
			$nds=$ndb++;
			if($nds <= 10){
				$lplp1[$nds] = $bsbdn;
				$lplp2[$nds] = $bssnbs[$nsbn];
			}
		}
		$ttll = array_sum($lplp1);
		//print_r($ndbbb);
		
		
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
				<td width="1%" style="vertical-align:middle;text-align:center;">NO</td>
				<td style="vertical-align:middle;text-align:center;">NAMA PENYAKIT</td>
				<td  style="vertical-align:middle;text-align:center;">JUMLAH</td>
				<td style="vertical-align:middle;text-align:center;">PERSENTASE<br />(%)</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">1</td>
				<td style="vertical-align:middle;text-align:center;">2</td>
				<td style="vertical-align:middle;text-align:center;">3</td>
				<td style="vertical-align:middle;text-align:center;">4</td>
			</tr>
		<?php
				$nk=1;
				
				foreach($lplp1 as $bs => $bsb){
					$so=$nk++;
					$gbbnn = round($bsb/$ttll*100, 2);
					$gbsbb[] = $gbbnn;
					
		?>
		
		<tr>
			<td><?=@$so?>.</td>
			<td><?=@$lplp2[$bs]?></td>
			<td><div align="center"><?=@$bsb?></div></td>
			<td><div align="center"><?=@$gbbnn?></div></td>
		</tr>
	<?php } ?>
	<tr>
			<td colspan="2"><div align="right"><b>Sub Total</b></div></td>
			<td><div align="center"><b><?=@array_sum($lplp1)?></b></div></td>
			<td><div align="center"><b><?=@round(array_sum($gbsbb))?></b></div></td>
		</tr>
	</table>
			
