<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=@$this->app_title?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/ionicons.min.css">-->
    <link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/select2/select2.css">
	<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker-bs3.css">
	<!--<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?=@base_url('template')?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
	<script src="<?=@base_url('template')?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?=@base_url('template')?>/dist/js/jquery-ui.min.js"></script>
    <script src="<?=@base_url('template')?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=@base_url('template')?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?=@base_url('template')?>/dist/js/raphael-min.js"></script>
	 <script src="<?=@base_url('template')?>/plugins/select2/select2.full.min.js"></script>
	 <script src="<?=@base_url('assets')?>/js/yoke.js"></script>
    <script src="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker.js"></script>
	<!--<script src="<?=@base_url('template')?>/plugins/morris/morris.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?=@base_url('template')?>/plugins/knob/jquery.knob.js"></script>
    <script src="<?=@base_url('template')?>/dist/js/moment.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker.js"></script>
    
	<script src="<?=@base_url('template')?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?=@base_url('template')?>/plugins/fastclick/fastclick.min.js"></script>-->
    <script src="<?=@base_url('template')?>/dist/js/app.min.js"></script>
    <!--<script src="<?=@base_url('template')?>/dist/js/pages/dashboard.js"></script>
    <script src="<?=@base_url('template')?>/dist/js/demo.js"></script>-->
	 <script>
      $.widget.bridge('uibutton', $.ui.button);
	  $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
 </head>
 <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/home')?>')" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>I</b>RC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Inventory</b>Record</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=@base_url('assets')?>/img/user.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=@$this->session->userdata('nmlengkap')?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=@base_url('assets')?>/img/user.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?=@$this->session->userdata('nmlengkap')?> - <?=@$this->session->userdata('level')?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/myprofile')?>')" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=@base_url('login/logout')?>" onclick="return confirm('Apakah anda yakin')" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="<?=@base_url('login/logout')?>" title="Keluar dari Sistem" onclick="return confirm('Apakah anda yakin keluar?')"><i class="fa fa-sign-out"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=@base_url('assets')?>/img/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=@$this->session->userdata('nmlengkap')?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			 <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/home')?>')"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/supplier')?>')"><i class="fa fa-circle-o"></i> Supplier</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pelanggan')?>')"><i class="fa fa-circle-o"></i> Pelanggan</a></li>
				<li>
                  <a href="#"><i class="fa fa-check-square-o"></i> Barang <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/kategori')?>')"><i class="fa fa-check-square-o"></i> Kategori</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/status')?>')"><i class="fa fa-check-square-o"></i> Kondisi</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/satuan')?>')"><i class="fa fa-check-square-o"></i> Satuan</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/barang/all/all/all/all/all/all/all/all')?>')"><i class="fa fa-check-square-o"></i> Barang</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pesawat/all/all/all/all/all/all/all/all')?>')"><i class="fa fa-check-square-o"></i> Pesawat</a></li>
                  </ul>
                </li>
				<li>
                  <a href="#"><i class="fa fa-check-square-o"></i> Project <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/kategoripro')?>')"><i class="fa fa-check-square-o"></i> Kategori</a></li>
                  </ul>
                </li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Transaksi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/project/all/all/all/all/all/all/all/all')?>')"><i class="fa fa-circle-o"></i> Project</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/perawatan/all/all/all/all/all/all/all/all')?>')"><i class="fa fa-circle-o"></i> Perawatan</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li>
                  <a href="#"><i class="fa fa-check-square-o"></i> Pembelian Barang <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lappembelian')?>')"><i class="fa fa-check-square-o"></i> Berdasarkan Supplier</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lappemkategori')?>')"><i class="fa fa-check-square-o"></i> Berdasarkan Kategori</a></li>
                  </ul>
                </li>
				<li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lapkondisibrg')?>')"><i class="fa fa-circle-o"></i> Laporan Konsidi Barang</a></li>
				<li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lapstatusbrg')?>')"><i class="fa fa-circle-o"></i> Laporan Status Barang</a></li>
				<li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lapsisagaransi')?>')"><i class="fa fa-circle-o"></i> Laporan Sisa Garansi</a></li>
				<li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lappemakaian')?>')"><i class="fa fa-circle-o"></i> Laporan Pemakaian</a></li>
				<li>
                  <a href="#"><i class="fa fa-check-square-o"></i> Laporan Project <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pelaksanaanproject')?>')"><i class="fa fa-check-square-o"></i> Pelaksanaan Project</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lapategoriproject')?>')"><i class="fa fa-check-square-o"></i> Kategori Project</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/penggunaanbarang')?>')"><i class="fa fa-check-square-o"></i> Penggunaan Barang</a></li>
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pengembalianbarang')?>')"><i class="fa fa-check-square-o"></i> Pengembalian Barang</a></li>
                  </ul>
                </li>
				<li>
                  <a href="#"><i class="fa fa-check-square-o"></i> Laporan Perawatan <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/lapperawatanbrg')?>')"><i class="fa fa-check-square-o"></i> Perawatan Barang</a></li>
                  </ul>
                </li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-external-link"></i>
                <span>Rekap</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/rekappembelian')?>')"><i class="fa fa-circle-o"></i> Rekap Pembelian Barang</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/rekapproject')?>')"><i class="fa fa-circle-o"></i> Rekap Tahunan Project</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/rekapbarang')?>')"><i class="fa fa-circle-o"></i> Rekap Tahunan Barang</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-list-ol"></i>
                <span>Top 10</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/toptenbarang')?>')"><i class="fa fa-circle-o"></i> Top 10 Barang</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/toptenpelanggan')?>')"><i class="fa fa-circle-o"></i> Top 10 Pelanggan</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i>
                <span>Riwayat</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/riwayatbarang')?>')"><i class="fa fa-circle-o"></i> Riwayat Barang</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Pengguna</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/datapengguna')?>')"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/myprofile')?>')"><i class="fa fa-circle-o"></i> Profil Saya</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Pengaturan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pengumum')?>')"><i class="fa fa-circle-o"></i> Pengaturan Umum</a></li>
                <li><a href="javascript:void(0)" onclick="smokerURL('<?=@base_url('administrator/pengproject')?>')"><i class="fa fa-circle-o"></i> Pengaturan Barang</a></li>
			  </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>