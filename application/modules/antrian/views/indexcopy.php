<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Antrian Pasien</title>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/themes/ui-cupertino/easyui.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/themes/icon.css')?>">
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('ckeditor/js/ckeditor.js')?>">jQuery.noConflict();</script>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('styleantrian/assets/css/sticky-footer.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/antriandua.css')?>">
	<script type="text/javascript">
		
	</script>
	</head>
<body class="easyui-layout">
	<div data-options="region:'center',title:''" style="margin:0;padding:15px;overflow:hidden;background:#333333;">
		<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
			<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
				<div data-options="region:'west',split:true,iconCls:'icon-lock'" title="" style="width:65%;background:#0D5C8E;overflow:hidden">
					<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
						<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
							<div data-options="region:'north',split:true,iconCls:'icon-lock'" title="" style="height:13%;background:#0C4E79;overflow:hidden">
								<div align="left">
									<div class="antrian_dalam_atas">
										<a href="javascript:void(0)" onclick="pulskren()" style="margin-top:15px;"><p style="font-size:40px;color:#E2F774;text-shadow: -4px 3px 0 #3a50d9, -10px 2px 0 #0a0e27;font-weight:bold;font-family:arial;margin:1px 0 0 0;"><?=@strtoupper($this->madmin->admin_getsetting('app_name'))?></p></a>
									</div>
								</div>
							</div>
							<div data-options="region:'south',split:true,iconCls:'icon-lock'" title="" style="height:25%;overflow:hidden;background:#0C1860">
							<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
								<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
									<div data-options="region:'center',split:true,iconCls:'icon-lock'" title="" style="background:#0C4E79;overflow:hidden">

									</div>
									<div data-options="region:'south',iconCls:'icon-ok'" title="" style="overflow:hidden;background:#126CA4">
										<marquee scrollamount="4" style="font-size:40px;color:#ffffff;margin-top:5px;"><?=@strtoupper($this->madmin->admin_getsetting('running_pendaftaran'))?></marquee>
									</div>
								</div>
							</div>
							</div>
							<div data-options="region:'center',iconCls:'icon-ok'" title="" style="background:#0F5A8A;overflow:hidden">
								<a href="javascript:void(0)" onclick="pulskren()"><div align="center">
								<video width="100%" autoplay muted loop>
									  <source src="<?=@base_url('video/data/m12.mp4')?>" type="video/mp4">
									</video>
								</div></a>
							</div>
						</div>
						
					</div>
				</div>
				<div data-options="region:'center',iconCls:'icon-ok'" title="">
					<div class="easyui-panel" title="" style="width:auto;background:#333333" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">			
						<div class="easyui-layout" data-options="fit:true" id="datains_layout1">
							<div data-options="region:'north',split:true,iconCls:'icon-lock'" title="" style="height:50%;background:#eeffff;">
								<div id="pendaftaran" class="easyui-panel" title="" style="width:auto;background:#31A6DB;overflow:hidden" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">
								</div>
							</div>
							<div data-options="region:'center',iconCls:'icon-ok'" title="">
								<div id="poliklinik" class="easyui-panel" title="" style="width:auto;background:#31A6DB;overflow:hidden" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript">
		function Ajaxpendaftaran(){
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
					document.getElementById('pendaftaran').innerHTML=xmlHttp.responseText;
					if($('#nomorantriokpendaftaran').val() == 'kosong'){
						setTimeout('Ajaxpendaftaran()',1500);
					} else {
						setTimeout('Ajaxpendaftaran()',11000);
					}
				}
				}
				xmlHttp.open("GET","<?=@base_url($this->u1 . '/pendaftaran')?>",true);
				xmlHttp.send(null);
		}
		
		function Ajaxpoliklinik(){
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
					document.getElementById('poliklinik').innerHTML=xmlHttp.responseText;
					if($('#nomorantriokpoliklinik').val() == 'kosong'){
						setTimeout('Ajaxpoliklinik()',1500);
					} else {
						setTimeout('Ajaxpoliklinik()',11000);
					}
				}
				}
				xmlHttp.open("GET","<?=@base_url($this->u1 . '/poliklinik')?>",true);
				xmlHttp.send(null);
		}
		window.onload=function(){ 
			setTimeout('Ajaxpendaftaran()',0);
			setTimeout('Ajaxpoliklinik()',0);
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