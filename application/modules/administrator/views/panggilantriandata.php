<div style="padding:10px;">
<button type="button" onclick="panggilanlokets()" class="btn btn-info btn-sm">Refresh</button>
<hr style="margin:5px;">
<div id="panggilanloket"></div>
<script>
	function panggilantrian(loket, idkhususkaloaada){
			var rss = confirm("Anda yakin akan memanggil antrian baru??");
				if (rss == true){
					$.post('<?=@base_url('administrator/panggilantrian')?>',{
						loket:loket, idkhususkaloaada:idkhususkaloaada,
						},function(result){ 
						if(result == "ok"){
							//antriansaya();
						}else {
							alert(result);
						}
						panggilanlokets();
					});
				}
		}
		function ulangiantrian(loket){
			var rss = confirm("Anda yakin akan memanggil mengulangi antrian sekarang??");
				if (rss == true){
					$.post('<?=@base_url('administrator/ulangiantrian')?>',{
						loket:loket
					},function(result){ 
						if(result == "ok"){
							
							//antriansaya();
						}else {
							alert(result);
						}
						panggilanlokets();
					});
				}
		}
	function panggilantrianmanual(loket, idmet, noant){
						var rss = confirm("Anda yakin akan memanggil antrian manual ("+noant+")??");
							if (rss == true){
								$.post('<?=@base_url('administrator/panggilantrianmanual')?>',{
									loket:loket, idmet:idmet,
								},function(result){ 
									if(result == "ok"){
										//antriansaya();
									}else {
										alert(result);
									}
									panggilanlokets();
								});
							}
					}
	function panggilanlokets(){
		$('#panggilanloket').html('loading..');
		$.post('<?=@base_url('administrator/panggilanloket')?>',{
		},function(result){ 
			$('#panggilanloket').html(result);
		});
	}
	panggilanlokets();
</script>
</div>