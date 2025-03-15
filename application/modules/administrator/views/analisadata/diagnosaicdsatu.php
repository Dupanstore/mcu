<div id="wedusss" style="min-width: 310px; height: 320px; margin: 0 auto"></div>
		<?php
			//ambil datanya yaaa
			//print_r($_GET);
			$fghb = "select kd_diagnosa,  nm_diagnosa, count(kd_diagnosa) as newkode from  tb_resume_diagnosa,  tb_register, tb_pasien ";
			$fghb .= " where tb_resume_diagnosa.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg ";
			//selanjutnya mari kita filter
			$fghb .= " and   diagnosa_key='diagnosa_1' ";
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
			$fghb .= " group by kd_diagnosa order by kd_diagnosa ASC ";
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
                '<?=@$fs->nm_diagnosa?>',
				<?php } ?>
			<?php } ?>
               
            ],
            crosshair: true
        },
		<?php } ?>
        yAxis: {
            min: 0,
            title: {
                text: 'Diagnosa Penyakit by ICD'
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
            name: 'Diagnosa by ICD',
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
                name: '<?=@$fs->nm_diagnosa?>',
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