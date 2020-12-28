<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Niez Cake and Pastry</title>
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
<body class="hold-transition skin-yellow sidebar-mini">
 
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
                                <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image">
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
                        <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle">
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
                    <li class="treeview <?= $this->uri->segment(1) == 'bahan' || 
                    $this->uri->segment(1) == 'purchase' || $this->uri->segment(1) == 'bahanout' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-truck"></i> <span>Bahan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'bahan' ? 'class="active"':""?>><a href="bahan"><i class="fa fa-circle-o"></i> Stock Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'purchase' ? 'class="active"':""?>><a href="#"><i class="fa fa-circle-o"></i> Belanja Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'bahanout' ? 'class="active"':""?>><a href="#"><i class="fa fa-circle-o"></i> Bahan Keluar (Non Produksi)</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="treeview <?=$this->uri->segment(1) == 'produksi' || $this->uri->segment(1) == 'produk' || 
                    $this->uri->segment(1) == 'produkout' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-archive"></i> <span>Produk</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'produk' ? 'class="active"':""?>><a href="<?=site_url('produk')?>"><i class="fa fa-circle-o"></i> Stock Produk</a></li>
                            <li <?=$this->uri->segment(1) == 'produksi' ? 'class="active"':""?>><a href="<?=site_url('produksi')?>"><i class="fa fa-circle-o"></i> Proses Produksi</a></li>
                            <li <?=$this->uri->segment(1) == 'produkout' ? 'class="active"':""?>><a href="<?=site_url('produkout')?>"><i class="fa fa-circle-o"></i> Produk Keluar (Non Transaksi)</a></li>
                        </ul>
                    </li>
                    <?php if($this->session->userdata('level') != 3) { ?>       
                    <li <?=$this->uri->segment(1) == 'transaction' ? 'class="active"':""?>>
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($this->fungsi->user_login()->kewenangan == 1 ) { ?>
                    <li class="treeview <?=$this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'gudang' 
                    ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i> <span>Laporan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?=$this->uri->segment(1) == 'report' ? 'class="active"':""?>><a href="#"><i class="fa fa-circle-o"></i> Penjualan</a></li>
                            <li <?=$this->uri->segment(1) == 'gudang' ? 'class="active"':""?>><a href="#"><i class="fa fa-circle-o"></i> Gudang</a></li>
                        </ul>
                    </li>
                    <li class="header">PENGATURAN</li>
                    <li <?=$this->uri->segment(1) == 'user' ? 'class="active"':""?>><a href="<?=site_url('user')?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
                    <li class="treeview <?=$this->uri->segment(1) == 'supplier' || $this->uri->segment(1) == 'j_bahan' || 
                    $this->uri->segment(1) == 'j_produk' ||  $this->uri->segment(1) == 'satuan' ? "active":""?>">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Referensi</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                        <li <?=$this->uri->segment(1) == 'supplier' ? 'class="active"':""?>><a href="<?=site_url('supplier')?>"><i class="fa fa-circle-o"></i> Toko Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'j_bahan' ? 'class="active"':""?>><a href="<?=site_url('j_bahan')?>"><i class="fa fa-circle-o"></i> Jenis Bahan</a></li>
                            <li <?=$this->uri->segment(1) == 'j_produk' ? 'class="active"':""?>><a href="<?=site_url('j_produk')?>"><i class="fa fa-circle-o"></i> Jenis Produk</a></li>
                            <li <?=$this->uri->segment(1) == 'satuan' ? 'class="active"':""?>><a href="<?=site_url('satuan')?>"><i class="fa fa-circle-o"></i> Satuan</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </section>
        </aside>
 
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
 
    <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>

    <script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        $('#table1').DataTable()
    })
    </script>
 
</body>
</html>