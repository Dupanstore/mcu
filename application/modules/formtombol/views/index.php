<?php $this->load->view('header'); 
	//PERTAMA ADALAH LOOPING data ya
	$jenispel = $this->madmin->get_setting("is_jenis_pelayanan");
	if($jenispel == "pks"){
		$this->db->order_by('id_ins', 'ASC');
		$this->db->where('type', 'rj');
		$this->db->where("apakah_ugd  <> 'Y' ");
		$this->db->where("awalan  <> '' ");
		$dt = $this->db->get('tb_instalasi');
		$am = $dt->result();
		$iks = 1;
		if($am){
			$gga = 1;
			foreach($am as $dt){
				$gfa = $gga++;
					$llopping[$gfa] = $dt->id_ins;
					$cetakantri[$gfa] = "POLIKLINIK ". $dt->nm_instalasi;
					$type_khusus[$gfa] = "";
			}
		}
	}
	$this->db->order_by('nm_khusus', 'ASC');
	$msd = $this->db->get('tb_antrian_khusus');
	$opy = $msd->result();
	if($opy){
		$mans = $gfa+1;
		foreach($opy as $dt){
			$min = $mans++;
				$llopping[$min] = $dt->id_khusus;
				$cetakantri[$min] = $dt->nm_khusus;
				$type_khusus[$min] = $dt->prefix_khusus;
		}
	}
	//print_r($cetakantri);
	if(is_array($llopping)){
		$iks = count($llopping);
		if($iks > 8){
			$iks = 8;
		}
	}
	$aptk = "background:#079245;color:#white;margin:0;font-size:35px;font-weight:bold;padding:10px;border:solid 10px #eeefff;border-radius:40px;width:95%;text-align:left;";
	?>
 <div class="loader">
            <div class="spinner"></div>
        </div>
        <div class="main-wrapper">
            <div class="col-xs-12" style="margin-bottom: 120px;">
                <div class="row">
                    <div class="col-xs-12" style="background-color: #FFF; color: #173169; text-align: center; font-size: 30px; font-weight: bold; padding: 10px; border-top: 5px solid #eb8a1b;">
                        Lakespra dr.Saryanto
                    </div>
                    <div class="col-xs-12" style="box-shadow: 0px 2px 12px rgba(74, 74, 74, 0.5); background-color: #173169; font-size: 20px; font-weight: bold; text-align: center; color: #999; padding: 8px; color: #FFF;">
                        Ambil No. Antrian
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-12" align="center">
				<?php foreach(range(1,$iks) as $tt){ 
										$uuu = 'class="btn btn-primary btn-sm"';
										$iii = 'printer.png';
										if($type_khusus[$tt] != ""){
											$uuu = 'class="btn btn-danger btn-sm"';
											$iii = 'info.png';
										}
									?>
										<input type="button" class="button jenisantrian_btn" value="PENDAFTARAN" onclick="cetakantrian('<?=@$llopping[$tt]?>', '<?=@$type_khusus[$tt]?>')"
                                style="background: -webkit-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #008000; background: -moz-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #008000; background: radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #008000;" />
								
										
									<?php } ?>
                                
                </div>
             </div>
        </div>
<div id="yukcetak"></div>
<script type="text/javascript">
	function cetakantrian(id, type){
		//window.open("<?=base_url('formtombol/buatantrian')?>/"+id+'/?typekhusus='+type);
		$.post("<?=base_url('formtombol/buatantrian')?>/"+id+'/?typekhusus='+type, {
			id:id,
		}, function(response){	
			$('#yukcetak').html(response);
		});
	}
	function pulskren() {
			if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
			   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
				if (document.documentElement.requestFullScreen) {  
				  document.documentElement.requestFullScreen();  
				} else if (document.documentElement.mozRequestFullScreen) {  
				  document.documentElement.mozRequestFullScreen();  
				} else if (document.documentElement.webkitRequestFullScreen) {  
				  document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
				}
			  } else {  
				if (document.cancelFullScreen) {  
				  document.cancelFullScreen();  
				} else if (document.mozCancelFullScreen) {  
				  document.mozCancelFullScreen();  
				} else if (document.webkitCancelFullScreen) {  
				  document.webkitCancelFullScreen();  
				}  
			  }  
			}
</script>

<?php $this->load->view('footer'); ?>
