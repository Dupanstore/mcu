<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Antrian Pasien</title>
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('styleantrian/assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrapp.min.css')?>">
	<script src="<?=@base_url('video/pendaftaran')?>/video.js">jQuery.noConflict();</script>
	<link href="<?=@base_url('video/pendaftaran')?>/video-js.css" rel="stylesheet" type="text/css">
	 <style media="screen">
            .col-half-offset{
                margin-left:4.166666667%
            }

            .main-wrapper {
                height: 100vh;
            }

            .counter-wrapper {
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .head-counter {
                text-align: center;
                background-color: #172542;
                font-weight: bold;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                color: #FFF;
                /* border-bottom: 5px solid #eb8a1b; */
            }

            .body-counter {
                background-color: rgba(255, 255, 255, 0.3);
                color: #173169;
                font-weight: bold;
                justify-content: center;
                align-content: center;
                text-align: center;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .v1-hc-text {
                height: 85px;
                line-height: 85px;
                font-size: 40px;
            }

            .v1-bc-text {
                font-size: 150px;
            }

            .v2-hc-text {
                height: 55px;
                line-height: 55px;
                font-size: 30px;
            }

            .v2-bc-text {
                font-size: 100px;
            }

            .v3-hc-text {
                height: 75px;
                line-height: 75px;
                font-size: 35px;
            }

            .v3-bc-text {
                font-size: 175px;
                color: #eb8a1b;
            }

            .v3-bottom-hc-text {
                height: 50px;
                line-height: 50px;
                font-size: 23px;
            }

            .v3-bottom-bc-text {
                font-size: 40px;
            }

            .running-text {
                font-size: 20px;
                color: #FFF;
                font-weight: bold;
            }

            .tbl-data {
                width: 100%;
                height: 100%;
                background-color: #173169;
                color: #FFF;
            }

            .tbl-data th {
                border-right: 2px solid rgba(200, 200, 200, 0.3);
                text-align: center;
                padding: 0px;
                font-size: 22px;
            }

            .tbl-data td {
                border-right: 2px solid rgba(200, 200, 200, 0.3);
                text-align: center;
                font-size: 75px;
                padding: 0px;
            }

            .tbl-data th:last-child, td:last-child {
                border: none;
            }
			body {
              overflow:hidden;
			  background: #f1f1f1 url('<?=@base_url()?>/assets/img/r_logo.png') repeat;
            }
        </style>	
	<script type="text/javascript">
		
	</script>
	</head>
<body>


	<div class="main-wrapper">
            <div class="col-xs-12" style="height: 15vh; padding: 10px 5px; background-color: #FFF; border-top: 5px solid #eb8a1b;">
                <div class="col-xs-12" style="height: 100%;">
                    <div class="col-xs-2" style="height: 100%; text-align: center; justify-content: center; align-content: center; flex: 1; display: flex; flex-direction: column;">
                        <div class="lineHeightDiv" align="center">
                            <img src="<?=base_url('assets/logo/logo.png')?>" class="img img-responsive" style="height: 90px;">
                        </div>
                    </div>
                    <div class="col-xs-7" style="height: 100%;">
                        <div style="height: 100%; width: 100%; color: #173169; font-weight: bold; justify-content: center; align-content: center; flex: 1; display: flex; flex-direction: column; padding-top: 10px; text-shadow: 1px 2px 4px rgba(51, 51, 51, 0.3);">
                            <span style="font-size: 30px;">RSIA BUNDA ARIF</span>
                            <p style="font-size: 25px;">Jl. Jatiwinangun No. 16 Purwokerto</p>
                        </div>
                    </div>
                    <div class="col-xs-3" style="height: 100%;">
                        <div style="height: 100%; width: 100%; background-color: #173169; color: #FFF; justify-content: center; align-content: center; text-align: center; flex: 1; display: flex; flex-direction: column;">
                            <span id="time" style="font-size: 28px;"></span>
                            <p><?=@is_hari(date("w"))?>, <?=@the_time(date("Y-m-d"))?></p>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-xs-12" style="height: 79vh; padding: 20px 20px; overflow-y: auto;">
				<div class="col-xs-5 counter-wrapper">
					<div id="pendaftaran" style="display:none;"></div>
					<div id="pendaftaran2"></div>
				</div>
				<div class="col-xs-7" style="height: 100%;" align="center">
					<video id="example_video_1" class="video-js vjs-default-skin" width="100%" height="100%" muted data-setup='{"controls": false, "autoplay": true, "preload": "true", "loop" : true}'>
					 <source src="<?=@base_url('video/pendaftaran')?>/data/db.mp4" type='video/mp4' />  
				  </video>
				</div>
			</div>
            <div class="col-xs-12" style="height: 6vh; background-color: #3E3E3E; padding: 0px;">
                <div class="lineHeightDiv col-xs-2" style="height: 100%; background-color: #eb8a1b; font-size: 20px; color: #FFF; font-weight: bold; display: inline-block; text-align: center">
                    Informasi :
                </div>
                <div class="lineHeightDiv col-xs-10" style="height: 100%; padding: 0px 10px;">
                    <marquee class="running-text">"APABILA PASIEN TIDAK ADA/HADIR SAAT NOMOR ANTRIANNYA DIPANGGIL MAKA AKAN DILEWATKAN SEBANYAK 5 NOMOR ANTRIAN"</marquee>
                </div>
            </div>
        </div>
		
	
	<script type="text/javascript">
		function startTime() {
            var today = new Date();
            var h     = today.getHours();
            var m     = today.getMinutes();
            m         = checkTime(m);
            $('#time').html(h + ":" + m);
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
            return i;
        }
		startTime();
		
		
		
		
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
						setTimeout('Ajaxpendaftaran()',2000);
					} else {
						audio1.play();
						audio1.onended = function() {
							audio2.play();
							audio2.onended = function() {
								audio3.play();
								audio3.onended = function() {
									audio4.play();
									audio4.onended = function() {
										audio5.play();
										audio5.onended = function() {
											audio6.play();
											audio6.onended = function() {
												audio7.play();
												audio7.onended = function() {
													audio8.play();
													audio8.onended = function() {
														audio9.play();
														audio9.onended = function() {
															audio10.play();
															audio10.onended = function() {
																	audio11.play();
																	audio11.onended = function() {
																		audio12.play();
																		audio12.onended = function() {
																			audio13.play();
																			audio13.onended = function() {
																				audio14.play();
																				audio14.onended = function() {
																					audio15.play();
																					audio15.onended = function() {
																						audio16.play();
																						audio16.onended = function() {
																							audio17.play();
																							audio17.onended = function() {
																								audio18.play();
																								audio18.onended = function() {
																									audio19.play();
																									audio19.onended = function() {
																										audio20.play();
																									};
																								};
																							};
																						};
																					};
																				};
																			};
																		};
																	};
																};
														};
													};
												};
											};
										};
									};
								};
							}; 
						}; 
						setTimeout('Ajaxpendaftaran()',12000);
					}
				}
				}
				xmlHttp.open("GET","<?=@base_url($this->u1 . '/pendaftaran')?>",true);
				xmlHttp.send(null);
		}
		
		
		function Ajaxpensisa(){
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
					document.getElementById('pendaftaran2').innerHTML=xmlHttp.responseText;
					setTimeout('Ajaxpensisa()',1500);
				}
				}
				xmlHttp.open("GET","<?=@base_url($this->u1 . '/poliklinik')?>",true);
				xmlHttp.send(null);
		}
		
		window.onload=function(){ 
			setTimeout('Ajaxpendaftaran()',0);
			setTimeout('Ajaxpensisa()',0);
		}
		
		
	</script>
</body>
</html>