
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Medical Checkup Information System</title>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/themes/ui-cupertino/easyui.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/themes/icon.css')?>">
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('assets/js/chart.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('ckeditor/js/ckeditor.js')?>">jQuery.noConflict();</script>
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=@base_url('assets/css/sticky-footer.css')?>">
	</head>
<<style>
	body{
		background:#000000;
		font-family:arial;
	}
	input {
		font-size:12px;
		padding:3px;
		border-radius:7px;
		border:solid 1px #E6E6E6;
	}
	select{
		font-size:12px;
		padding:3px;
		border-radius:7px;
		border:solid 1px #E6E6E6;
	}
	button{
		font-size:12px;
		padding:3px;
		border-radius:5px;
		background:#E4F1FB;
		font-weight:bold;
		border:solid 1px #cccccc;
		
		
		display: inline-block;
		position: relative;
		overflow: hidden;
		margin: 0;
		vertical-align: top;
		color: #2779AA;
		cursor: pointer;
		text-align: center;
		line-height: normal;
	}
	textarea{
		font-size:12px;
		padding:3px;
		border-radius:7px;
		border:solid 1px #E6E6E6;
	}
</style>
<body class="easyui-layout">
	<div data-options="region:'north',border:false" style="background:#224CA0;overflow:hidden;height:100px;">
    <div style="width:100%;height:60px;padding-top:5px;padding-left:15px;">
			<table style="width:100%">
				<tr>
					<td style="width:55px;vertical-align:top;"><img src="<?=@base_url('assets/img/ann.png')?>" style="width:45px;"></td>
					<td style="vertical-align:top;"><span style="font-size:20px;color:white;font-weight:bold;">
						Medical Checkup Information System</span><br />
						<span style="font-size:16px;color:white;">
						LAKESPRA dr. SARYANTO	
						</span></td>
					<td style="vertical-align:bottom;width:50%;"><marquee style="color:white">JL.MT Haryono Kav.41 Jakarta Selatan Phone: 0217980002 fax: 0217996634</marquee></td>
				</tr>
			</table>
		</div>
	<div style="z-index:99999999999999999;background:#ffffff;padding:5px;">
	<div class="easyui-panel" style="padding:0px;">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-home'" onclick="newtabnya('Dashboard', '<?=@base_url($this->u1 . '/home')?>')" style="margin-left:50px;">Home</a>
        <?php if( $this->session->userdata('hidden')!='Y' and $this->session->userdata('id_ins')!='24'){ ?>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-template'" onclick="newtabnya('Input Pemeriksaan Pasien', '<?=@base_url($this->u1 . '/inputpemeriksaan')?>')">Pemeriksaan</a>
				<?php if($this->session->userdata('id_ins')=='2'){ ?>
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-template'" onclick="newtabnya('Input Pemeriksaan Pasien', '<?=@base_url($this->u1 . '/kesimpulanlaboratorium')?>')">Kesimpulan Lab</a>
				<?php } ?>
		<?php } else if( $this->session->userdata('hidden')!='Y' and $this->session->userdata('id_ins')=='24') { ?>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-template'" onclick="newtabnya('Input Evauasi Pasien', '<?=@base_url($this->u1 . '/evaluasipasien')?>')">Evaluasi</a>
		<?php } else if( $this->session->userdata('level')=='22'){ ?>
		<a href="#" class="easyui-menubutton" data-options="menu:'#mm2', iconCls:'icon-report'">Pendaftaran</a>
		<?php } else if( $this->session->userdata('level')=='25'){ ?>
		<a href="#" class="easyui-menubutton" data-options="menu:'#mm4', iconCls:'icon-transaksi'">Kasir</a>
		<?php } else { ?>
		<a href="#" class="easyui-menubutton" data-options="menu:'#mm1', iconCls:'icon-setting'">Master</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm2', iconCls:'icon-report'">Pendaftaran</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-template'" onclick="newtabnya('Input Pemeriksaan Pasien', '<?=@base_url($this->u1 . '/inputpemeriksaan')?>')">Pemeriksaan</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true, iconCls:'icon-template'" onclick="newtabnya('Input Pemeriksaan Pasien', '<?=@base_url($this->u1 . '/kesimpulanlaboratorium')?>')">Kesimpulan Lab</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-template'" onclick="newtabnya('Input Evauasi Pasien', '<?=@base_url($this->u1 . '/evaluasipasien')?>')">Evaluasi</a>
		<a href="#" class="easyui-menubutton" data-options="menu:'#mm4', iconCls:'icon-transaksi'">Kasir</a>
		<?php } ?>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-report'" onclick="newtabnya('Input Evauasi Pasien', '<?=@base_url($this->u1 . '/laporanlaporan')?>')">Laporan</a>
		 <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-chart'" onclick="newtabnya('MCU Analisis System', '<?=@base_url($this->u1 . '/mcuanalisis')?>')">MCU Analisis System</a>
    </div>
    </div>
	<?php if( $this->session->userdata('hidden')!='Y' and $this->session->userdata('id_ins')!='24'){ ?>
	
	<?php } else if( $this->session->userdata('hidden')!='Y' and $this->session->userdata('id_ins')=='24') { ?>
	
	<?php } else if( $this->session->userdata('level')=='22'){ ?>
	<div id="mm2" style="width:250px;">
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pendaftaran Pasien', '<?=@base_url($this->u1 . '/pendaftaranpasien')?>')">Pendaftaran Pasien</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pendaftaran Konsultasi', '<?=@base_url($this->u1 . '/pendaftarankonsul')?>')">Pendaftaran Konsul</a></div>
		<!--<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Import Data Pasien', '<?=@base_url($this->u1 . '/importdatapasien')?>')">Import Data Pasien</a></div>-->
	</div>
	<?php } else if( $this->session->userdata('level')=='25'){ ?>
	<div id="mm4" style="width:250px;">
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pembayaran Pasien', '<?=@base_url($this->u1 . '/inputpembayaran')?>')">Pembayaran Pasien</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Tagihan Pasien', '<?=@base_url($this->u1 . '/tagihanpasien')?>')">Tagihan Pasien</a></div>
	</div>
	<?php } else { ?>
	<div id="mm1" style="width:250px;">
        <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Data Poliklinik dan Ruangan', '<?=@base_url($this->u1 . '/masterins')?>')">Data Poliklinik dan Ruangan</a></div>
         <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Data Poliklinik', '<?=@base_url($this->u1 . '/masterdok')?>')">Data Dokter</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Data Jawatan / Perusahaan', '<?=@base_url($this->u1 . '/masterjawatan')?>')">Data Jawatan / Perusahaan</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Data Departemen/Bagian', '<?=@base_url($this->u1 . '/masterdepartmen')?>')">Data Departemen/Bagian</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Diagnosa Penyakit (ICD X)', '<?=@base_url($this->u1 . '/mastericd')?>')">Diagnosa Penyakit (ICD X)</a></div>
		<div class="menu-sep"></div>
        <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Pengguna', '<?=@base_url($this->u1 . '/masteruser')?>')">Data Pengguna</a></div>
		<div>
            <span>Tarif & Detail Pemeriksaan</span>
            <div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Group Pemeriksaan Penunjang', '<?=@base_url($this->u1 . '/mastergroupperiksan')?>')">Group Pemeriksaan Penunjang</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Tarif Pemeriksaan', '<?=@base_url($this->u1 . '/mastertindakan')?>')">Tarif Pemeriksaan</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Detail Pemeriksaan Poliklinik & Ruang Tambahan', '<?=@base_url($this->u1 . '/masterdetailpemeriksaan')?>')">Detail Pemeriksaan Poliklinik</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Detail Pemeriksaan Laboratorium', '<?=@base_url($this->u1 . '/penglaborat')?>')">Detail Pemeriksaan Laboratorium</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Detail Pemeriksaan Radiologi', '<?=@base_url($this->u1 . '/pengradiologi')?>')">Detail Pemeriksaan Radiologi</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Tarif Paket Medical Checkup', '<?=@base_url($this->u1 . '/tarifpaketmcu')?>')">Tarif Paket MCU</a></div>
            </div>
        </div>
		<div>
            <span>Lain-lain</span>
            <div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Kondisi Akhir', '<?=@base_url($this->u1 . '/masterstakes')?>')">Master Stakes</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Kondisi Akhir', '<?=@base_url($this->u1 . '/mastersaran')?>')">Master Saran</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Kondisi Akhir', '<?=@base_url($this->u1 . '/mastercatatan')?>')">Master Catatan Dinas</a></div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Kondisi Akhir', '<?=@base_url($this->u1 . '/masterkondisi')?>')">Master Kondisi Akhir</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Tujuan', '<?=@base_url($this->u1 . '/masterdinas')?>')">Master Tujuan</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Cara Bayar', '<?=@base_url($this->u1 . '/masterbayar')?>')">Master Cara Bayar</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Pekerjaan', '<?=@base_url($this->u1 . '/masterpekerjaan')?>')">Master Pekerjaan</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Pendidikan', '<?=@base_url($this->u1 . '/masterpendidikan')?>')">Master Pendidikan</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Status Marital', '<?=@base_url($this->u1 . '/masterstatus')?>')">Master Status Marital</a></div>
				 <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Agama', '<?=@base_url($this->u1 . '/masteragama')?>')">Master Agama</a></div>
                <div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Wilayah', '<?=@base_url($this->u1 . '/masterwilayah')?>')">Master Wilayah</a></div>
            </div>
        </div>
		<div>
            <span>Pengaturan</span>
            <div>
				<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Master Kondisi Akhir', '<?=@base_url($this->u1 . '/masterkelainangigi')?>')">Kelainan Gigi</a></div>
            </div>
        </div>
    </div>
	<div id="mm2" style="width:250px;">
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pendaftaran Pasien', '<?=@base_url($this->u1 . '/pendaftaranpasien')?>')">Pendaftaran Pasien</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pendaftaran Konsultasi', '<?=@base_url($this->u1 . '/pendaftarankonsul')?>')">Pendaftaran Konsul</a></div>
		<!--<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Import Data Pasien', '<?=@base_url($this->u1 . '/importdatapasien')?>')">Import Data Pasien</a></div>-->
	</div>
	<div id="mm4" style="width:250px;">
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Pembayaran Pasien', '<?=@base_url($this->u1 . '/inputpembayaran')?>')">Pembayaran Pasien</a></div>
		<div><a href="javascript:void(0)" style="text-decoration:none;color:#333333;font-size:13px;" onclick="newtabnya('Tagihan Pasien', '<?=@base_url($this->u1 . '/tagihanpasien')?>')">Tagihan Pasien</a></div>
	</div>
	<?php } ?>
	</div>
	<div data-options="region:'center',title:''" style="margin:0;padding:0;overflow:hidden;background:#B9CFEE;">
		<div id="divmenu" class="easyui-panel" title="" style="width:auto;background:#AED0EA" data-options="closable:false, collapsible:false,minimizable:false,maximizable:false,maximized:true,fit:true">
			
		</div>
	</div>
	<div data-options="region:'south',border:true" style="overflow:hidden;height:40px;border-top:1px solid #3FC8DE;padding:5px;">
	<a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-refresh" onclick="refreshdata()"><b>Reload Halaman</b></a>
			
		
		<div style="float:right;margin:0 10px 0 0;">
			<input type="hidden" id="urirefreshbtn">
			
			<a href="javascript:void(0)"  iconCls="icon-full" class="easyui-linkbutton" onclick="pulskren()"><b>Fullscreen</b></a>
			<a href="javascript:void(0)"  iconCls="icon-logout" class="easyui-linkbutton" onclick="logout('<?=@base_url('login/logout')?>')"><b>Logout</b></a>
					
					
		</div>
	</div>
	<script type="text/javascript">
		$('#divmenu').panel({
					//title:'Dashboard',
					href:'<?=@base_url($this->u1 . '/home')?>',
		}); 
		function newtabnya(title, url){
			$('#urirefreshbtn').val(url);
				$('#divmenu').panel({
					//title:title,
					href:url,
				}); 
				/*if (document.documentElement.requestFullScreen) {  
				  document.documentElement.requestFullScreen();  
				} else if (document.documentElement.mozRequestFullScreen) {  
				  document.documentElement.mozRequestFullScreen();  
				} else if (document.documentElement.webkitRequestFullScreen) {  
				  document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
				}*/
			
		}
		function refreshdata(){
			var cc = $('#urirefreshbtn').val();
			$('#divmenu').panel({
					href:cc,
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
			function logout(url){  
				$.messager.confirm('Konfirmasi', 'Apakah anda yakin akan keluar?', function(r){
					if (r){
						window.location.href = url;
					}
				});
			}
	</script>
</body>
</html>