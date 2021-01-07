<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Niez Cookies</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-yellow sidebar-mini <?=$this->uri->segment(1) == 'transaksi' ? 'sidebar-collapse' : null?>">
 
    <div class="wrapper">
        <header class="main-header">
            <a href="<?=base_url('dashboard')?>" class="logo">
                <span class="logo-mini">n<b>C&P</b></span>
                <span class="logo-lg">niez<b>Cake and Pastry</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
 
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">3</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 3 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                        <a href="#">
                                            <h3>Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url()?>assets/dist/img/niez_logo.png" class="user-image">
                                <span class="hidden-xs"><?=$this->fungsi->user_login()->username?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?=base_url()?>assets/dist/img/niez_logo.png" class="img-circle">
                                    <p><?=$this->fungsi->user_login()->nama?>
                                        <small><?=$this->fungsi->user_login()->kewenangan == 1 ? "Administrator" : ($this->fungsi->user_login()->kewenangan == 2 ? "Cashier" : "Chef")?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=site_url('auth/logout')?>" class="btn btn-flat bg-red">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
 
        <!-- Left side column -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?=base_url()?>assets/dist/img/niez_logo.png" class="img-circle">
                    </div>
                    <div class="pull-left info">
                        <p><?=ucfirst($this->fungsi->user_login()->nama)?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- sidebar menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>
                    <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"':""?>>
                        <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li <?=$this->uri->segment(1) == 'customer' ? 'class="active"':""?>>
                        <a href="<?=site_url('customer')?>">
                            <i class="fa fa-users"></i> <span>Pelanggan</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('level') != 2) { ?>   
                    <li class="treeview <?= $this->uri->segment(1) == 'bahan' || $this->uri->segment(1) == 'bahan_stock' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-truck"></i> <span>Bahan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'bahan_stock' ? 'class="active"':""?>><a href="<?=site_url('bahan_stock')?>"><i class="fa fa-circle-o"></i> Stock Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'bahan' && $this->uri->segment(2) == 'in' ? 'class="active"':""?>><a href="<?=site_url('bahan/in')?>"><i class="fa fa-circle-o"></i> Bahan Masuk</a></li>
                            <li <?=$this->uri->segment(1) == 'bahan' && $this->uri->segment(2) == 'out' ? 'class="active"':""?>><a href="<?=site_url('bahan/out')?>"><i class="fa fa-circle-o"></i> Bahan Non Produksi</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="treeview <?=$this->uri->segment(1) == 'produk' || $this->uri->segment(1) == 'produk_stock' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-archive"></i> <span>Produk</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'produk_stock' ? 'class="active"':""?>><a href="<?=site_url('produk_stock')?>"><i class="fa fa-circle-o"></i> Stock Produk</a></li>
                            <li <?=$this->uri->segment(1) == 'produk' && $this->uri->segment(2) == 'in' ? 'class="active"':""?>><a href="<?=site_url('produk/in')?>"><i class="fa fa-circle-o"></i> Produk Masuk</a></li>
                            <li <?=$this->uri->segment(1) == 'produk' && $this->uri->segment(2) == 'out' ? 'class="active"':""?>><a href="<?=site_url('produk/out')?>"><i class="fa fa-circle-o"></i> Produk Non Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?=$this->uri->segment(1) == 'transaksi_out' || $this->uri->segment(1) == 'transaksi_in' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                    <?php if($this->session->userdata('level') != 3) { ?>       
                    <li <?=$this->uri->segment(1) == 'transaksi_out' ? 'class="active"':""?>>
                        <a href="<?=site_url('transaksi_out')?>">
                            <i class="fa fa-circle-o"></i> <span>Penjualan Produk</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($this->session->userdata('level') != 2) { ?>       
                    <li <?=$this->uri->segment(1) == 'transaksi_in' ? 'class="active"':""?>>
                        <a href="<?=site_url('transaksi_in')?>">
                            <i class="fa fa-circle-o"></i> <span>Produksi Produk</span>
                        </a>
                    </li>
                    <?php } ?>
                        </ul>
                    </li>

                   
                    <li class="treeview <?=$this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'reportprod' || $this->uri->segment(1) == 'gudang' 
                    ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i> <span>Laporan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'report' ? 'class="active"':""?>><a href="report/sale"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
                            <li <?=$this->uri->segment(1) == 'reportprod' ? 'class="active"':""?>><a href="reportprod/sale"><i class="fa fa-circle-o"></i> Laporan Produksi</a></li>
                            <li <?=$this->uri->segment(1) == 'gudang' ? 'class="active"':""?>><a href="#"><i class="fa fa-circle-o"></i> Gudang</a></li>
                        </ul>
                    </li>
                    <?php if($this->fungsi->user_login()->kewenangan == 1 ) { ?>
                    <li class="header">PENGATURAN</li>
                    <li <?=$this->uri->segment(1) == 'user' ? 'class="active"':""?>><a href="<?=site_url('user')?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
                    <li class="treeview <?=$this->uri->segment(1) == 'supplier' || $this->uri->segment(1) == 'j_bahan' || $this->uri->segment(1) == 'producer' ||
                    $this->uri->segment(1) == 'j_produk' ||  $this->uri->segment(1) == 'satuan' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Referensi</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'supplier' ? 'class="active"':""?>><a href="<?=site_url('supplier')?>"><i class="fa fa-circle-o"></i> Toko Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'producer' ? 'class="active"':""?>><a href="<?=site_url('producer')?>"><i class="fa fa-circle-o"></i> Pembuat Produk</a></li>
                            <li <?=$this->uri->segment(1) == 'j_bahan' ? 'class="active"':""?>><a href="<?=site_url('j_bahan')?>"><i class="fa fa-circle-o"></i> Jenis Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'j_produk' ? 'class="active"':""?>><a href="<?=site_url('j_produk')?>"><i class="fa fa-circle-o"></i> Jenis Produk</a></li>
                            <li <?=$this->uri->segment(1) == 'satuan' ? 'class="active"':""?>><a href="<?=site_url('satuan')?>"><i class="fa fa-circle-o"></i> Satuan</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </section>
        </aside>
        <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?php echo $contents ?>
        </div>
 
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="https://twitter.com/ifarshall">ifarshall</a>.</strong> All rights reserved.
        </footer>
 
    </div>
 
    
    <script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>

    <script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        $('#table1').DataTable()
    })
    $(document).ready(function(){
        $('#table2').DataTable()
    })
    </script>
 
</body>
</html>