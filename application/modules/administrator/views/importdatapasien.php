		<strong><p style="margin:6px 0 0 0;"><i class="icon-file" style="opacity:0.7;"></i> Untuk mengimport pasien, silahkan masukkan file excel <button type="button" onclick="cobacetakinforamsidulu()">Klik disini untuk melihat Tata Cara Upload File</button></p></strong>
		<hr style="border:solid 1px #eeefcc;"/>
		<iframe src="<?=@base_url('import/importpasrsau.php?db='. $this->db->database)?>" frameborder="0" width="100%" height="450px" style="margin-top:6px;">
		</iframe>
		<form method="POST" id="datasamplecetakya" action="<?=@base_url($this->u1.'/cetaktatacaraimportpasien')?>">
		</form>
		<div id="sampleimportcetak"></div>
		<script type="text/javascript">
			function cobacetakinforamsidulu(){
				$('#datasamplecetakya').form('submit', {  
						success:function(data){  
							$('#sampleimportcetak').html(data);
						}  
					}); 
			}
		</script>