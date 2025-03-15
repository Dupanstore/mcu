
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Informasi Tempat Tidur</title>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/themes/ui-cupertino/easyui.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/themes/icon.css')?>">
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('ckeditor/js/ckeditor.js')?>">jQuery.noConflict();</script>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/sticky-footer.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/antriantiga.css')?>">
	<script src="<?=@base_url('video/pendaftaran')?>/video.js">jQuery.noConflict();</script>
	<link href="<?=@base_url('video/pendaftaran')?>/video-js.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		
	</script>
	</head>
<body class="easyui-layout">
	<div data-options="region:'center',title:''" style="margin:0;padding:10px;overflow:hidden;background:#0F5989;">
		<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
			<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
				<div data-options="region:'center',iconCls:'icon-ok'" title="">
					<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
						<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
							<div data-options="region:'north',split:true,iconCls:'icon-lock'" title="" style="height:10%;background:#0C4E79;overflow:hidden">
								<div align="left">
									<div class="antrian_dalam_atas" style="border:0;">
										<table style="width:100%">
											<tr>
												<td style="width:50%;vertical-align:top;">
													<table style="width:100%">
														<tr>
															<td style="width:5%;vertical-align:middle;">
																
															</td>
															<td style="vertical-align:middle;"><div align="left"><a href="javascript:void(0)" onclick="pulskren()"><p style="font-size:38px;color:#ffffff;font-weight:bold;font-family:arial;margin:5px 0 0 0;text-shadow: -1px 1px 0 #3a50d9, -5px 2px 0 #0a0e27">RSIA Bunda arif PURWOKERTO</p></a></div></td>
														</tr>
													</table>
												</td>
												<td style="vertical-align:middle;"><div align="center"><p style="font-size:28px;color:#ccff00;text-shadow: -1px 1px 0 #3a50d9, -5px 2px 0 #0a0e27;font-weight:bold;font-family:arial;margin:1px 0 0 0;letter-spacing:5px;">INFORMASI TEMPAT TIDUR</p></div></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div data-options="region:'west',split:true,iconCls:'icon-lock'" title="" style="background:#eeffff;">
								
								<div id="kelaskiri" class="easyui-panel" title="" style="width:auto;background:#31A6DB;overflow:hidden" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">
								</div>
							</div>
							<!--<div data-options="region:'south',split:true,iconCls:'icon-lock'" title="" style="height:8%;background:#155784;overflow:hidden">
								
								<marquee scrollamount="4" style="font-size:30px;color:#ffffff;margin-top:5px;">SELAMAT DATANG DI RUMAH SAKIT DADI KELUARGA PURWOKERTO, KESEHATAN ANDA ADALAH KEBAHAGIAAN KAMI..</marquee>
							</div>-->
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript">
		
		function Ajaxkelaskiri(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					document.getElementById('kelaskiri').innerHTML=xmlHttp.responseText;
					setTimeout('Ajaxkelaskiri()',240000);
				}
				}
				xmlHttp.open("GET","<?=@base_url($this->u1 . '/kelaskiri')?>",true);
				xmlHttp.send(null);
		}
		
		function updatebedaplicares(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('updatebedaplicares()',1800000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('aplicares/updateruangan')?>",true);
				xmlHttp.send(null);
		}
		
		
		function antrolinsertpasien(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('antrolinsertpasien()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/antrolinsertpasien')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid3(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid3()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid3')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid4(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid4()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid4')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid5(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid5()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid5')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid6(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid6()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid6')?>",true);
				xmlHttp.send(null);
		}
		
		function generatetaskid7(){
				var xmlHttp;
				try{
				xmlHttp=new XMLHttpRequest();
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e){
				try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
				alert("No AJAX!?");
				return false;
				}
				}
				}

				xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					setTimeout('generatetaskid7()',600000);
				}
				}
				xmlHttp.open("GET","<?=@base_url('bebas/generatetaskid7')?>",true);
				xmlHttp.send(null);
		}
		
		window.onload=function(){ 
			setTimeout('Ajaxkelaskiri()',0);
			setTimeout('updatebedaplicares()',0);
			
			setTimeout('antrolinsertpasien()',0);
			setTimeout('generatetaskid()',0);
			setTimeout('generatetaskid3()',2000);
			setTimeout('generatetaskid4()',5000);
			setTimeout('generatetaskid5()',10000);
			setTimeout('generatetaskid6()',15000);
			setTimeout('generatetaskid7()',30000);
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
				$('#getfull').val('Pindah ke Mode Biasa');				
			  } else {  
				if (document.cancelFullScreen) {  
				  document.cancelFullScreen();  
				} else if (document.mozCancelFullScreen) {  
				  document.mozCancelFullScreen();  
				} else if (document.webkitCancelFullScreen) {  
				  document.webkitCancelFullScreen();  
				}  
				$('#getfull').val('Pindah ke Mode Fullscreen');	
			  }  
			}
	</script>
</body>
</html>