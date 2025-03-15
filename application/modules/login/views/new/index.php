<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>MEDICAL CHECKUP INFORMATION SYSTEM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/AdminLTE.min.css">
	<script src="<?=@base_url('template')?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  </head>
  <body class="hold-transition login-page" style="background:#666666;overflow:hidden;">
  <img src="<?=base_url('assets/img/ab.jpg')?>" style="position:fixed;margin-top:-20%;width:100%;opacity:0.4;z-index:-9999999999909999999999999">
    <div class="login-box" style="margin-top:2%;">
      <div class="login-box-body" style="border:solid 2px #48A0CE;padding:0;border-radius:10px;opacity:0.9">
			<div align="center" style="background:#224CA0;border-radius:10px 10px 10px 10px;border:solid 5px #ffffff;padding:10px;">
			<div style="margin:10px;">
				<a href="javascript:void(0)" style="color:#ffffff;font-size:12px;" ><b style="font-size:24px;">LAKESPRA SARYANTO</b></a>
			</div> 
			<span class="login-box-msg"><img src="<?=@base_url('assets/img/icon.png')?>" width="130px;"></span>
			<div style="margin:10px;">
				<a href="javascript:void(0)" style="color:#ffffff;font-size:12px;" >JL.MT Haryono Kav.41 Jakarta Selatan<br />Phone: 0217980002 fax: 0217996634</a>
			</div> 
			</div>
			
		<div style="padding:20px;">
			<div align="center"><div id="strong"></div></div>
			<form method="POST" id="formtambah" action="<?=base_url('login/cek_login/index')?>"/>
			  
			  <div class="form-group has-feedback">
				<input type="text" id="user_log" name="user_log" onkeypress="logapp(this, event, this.id)" class="form-control" placeholder="Username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" id="pass_log" name="pass_log" value="" title="password" onkeypress="logapp(this, event, this.id)" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  <div class="row">
				<div class="col-xs-2">
				</div><!-- /.col -->
				<div class="col-xs-10">
				  <div align="right">
				  <button type="button" class="btn btn-primary" onclick="loginapp()">Login Aplikasi</button></div>
				</div><!-- /.col -->
			  </div>
			</form>
			<hr style="margin:10px;">
			<div align="center"><a href="#" class="text-center">Medical Checkup Information System</a><br />Versi 1.0</div>
      </div>
      </div>
    </div>
	<script type="text/javascript">
	function loginapp(){
					$('#formtambah').slideUp('slow');
					var usr = $('#user_log').val();
					var pass = $('#pass_log').val();
					$.post("<?=base_url('login/cek_login')?>", {
							user_log: usr, pass_log:pass,
						}, function(response){
						setTimeout(function(){ $('#strong').html('<img src="<?=@base_url('assets/img/loadlogin.gif')?>" style="width:80px"><p style="color:#999999;">Loading data....</p>'); }, 200);
							if(response == 'Gagal'){
								setTimeout(function(){$('#formtambah').slideDown('slow');$('#strong').html('');},2000);	
							} else {
								setTimeout(function(){ window.location.href = response; }, 1000);
							}
					});
			}
			function logapp(inField, e, ww){
				var charCode;
				if(e && e.which){
					charCode = e.which;
				}else if(window.event){
					e = window.event;
					charCode = e.keyCode;
				}
				if(charCode == 13) {
					$('#formtambah').slideUp('slow');
					var usr = $('#user_log').val();
					var pass = $('#pass_log').val();
					$.post("<?=base_url('login/cek_login')?>", {
							user_log: usr, pass_log:pass, 
						}, function(response){
						setTimeout(function(){ $('#strong').html('<img src="<?=@base_url('assets/img/loadlogin.gif')?>" style="width:80px"><p style="color:#999999;">Loading data....</p>'); }, 200);
							if(response == 'Gagal'){
								setTimeout(function(){$('#formtambah').slideDown('slow');$('#strong').html('');},2000);	
							} else {
								setTimeout(function(){ window.location.href = response; }, 1000);
							}
					});
				}
			}
</script>
  </body>
</html>
