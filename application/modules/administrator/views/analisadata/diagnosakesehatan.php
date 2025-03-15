<div id="wedusss" style="min-width: 310px; height: 320px; margin: 0 auto"></div>
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select nm_kondisi, count(id_res) as newkode from tb_resume_pasien, tb_kondisi, tb_register, tb_pasien ";
			$fghb .= " where tb_resume_pasien.isi_kesansaran=tb_kondisi.id_kondisi and tb_resume_pasien.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg and nama_kesansaran='keterangan_sehat' ";
			//selanjutnya mari kita filter
			if(!empty($_GET['kunjungan_ke'])){
				$fghb .= " and  kunjungan_ke='".$_GET['kunjungan_ke']."' ";
			}
			if($_GET['id_cabang'] != "1"){
				$fghb .= " and  id_cabang='".$_GET['id_cabang']."' ";
			}
			if($_GET['id_unit'] != "1"){
				$fghb .= " and  id_unit='".$_GET['id_unit']."' ";
			}
			if(!empty($_GET['id_paket'])){
				$fghb .= " and   tb_register.id_paket='".$_GET['id_paket']."' ";
			}
			if(!empty($_GET['id_jenkel'])){
				$fghb .= " and jenkel_pas='".$_GET['id_jenkel']."' ";
			}
			$fghb .= " group by nm_kondisi order by id_kondisi ASC ";
			$dfgs = $this->db->query($fghb);
			$xcvb = $dfgs->result();
			//print_r($xcvb);
		?>
<script type="text/javascript">
$(function () {
    $('#wedusss').highcharts({
        chart: {
            type: '<?=@$_GET['id_chart']?>'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
		<?php if($_GET['id_chart'] != "pie"){ ?>
        xAxis: {
            categories: [
			<?php 
				if($xcvb){
					foreach($xcvb as $fs){
			?>
                '<?=@$fs->nm_kondisi?>',
				<?php } ?>
			<?php } ?>
               
            ],
            crosshair: true
        },
		<?php } ?>
        yAxis: {
            min: 0,
            title: {
                text: 'Diagnosa Kesehatan Kerja'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} pasien</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
		<?php if($_GET['id_chart'] != "pie"){ ?>
        series: [{
            name: 'Jumlah',
            data: [
				<?php 
				if($xcvb){
					foreach($xcvb as $fs){
						$fghbn = 0;
						if($fs->newkode > 0){
							$fghbn = $fs->newkode;
						}
			?>
                <?=@$fghbn?>,
				<?php } ?>
			<?php } ?>
			]

        }]
		<?php } else { ?>
		series: [{
            name: 'Total Pasien',
            colorByPoint: true,
            data: [
			
			<?php 
				if($xcvb){
					$fsv=1;
					foreach($xcvb as $fs){
						$uki = $fsv++;
						$fghbn = 0;
						if($fs->newkode > 0){
							$fghbn = $fs->newkode;
						}
			?>
			{
                name: '<?=@$fs->nm_kondisi?>',
                y: <?=@$fghbn?>,
				<?php if($uki == "1"){ ?>
                sliced: true,
                selected: true
				<?php } ?>
			},
			<?php } ?>
			<?php } ?>
            ]
        }]
		<?php } ?>
    });
});
</script>