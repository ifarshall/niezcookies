<section class="content-header">
    <h1>Dashboard
        <small>Halaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!--ROW 1-->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo indo_currency($jualbulanan);?></h3>

              <p>Penjualan Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
            <a href="<?=site_url('report/sale')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo indo_currency($belibulanan);?></h3>

              <p>Belanja Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="<?=site_url('bahan/in')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
      <!--ROW 2-->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo indo_currency($sumbahan);?></h3>

            <p>Stock Bahan</p>
          </div>
          <div class="icon">
            <i class="fa fa-truck"></i>
          </div>
          <a href="<?=site_url('bahan_stock')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <!-- <h3><?=$this->fungsi->count_produk()?></h3> -->
              <h3><?php echo indo_currency($sumproduk);?></h3>

            <p>Account Receivable</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
          <a href="<?=site_url('produk_stock')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner">
            <h3><?php echo $stocktoples?></h3>

            <p>Stock Toples Kosong</p>
          </div>
          <div class="icon">
            <i class="fa fa-gift"></i>
          </div>
          <a href="<?=site_url('bahan_stock')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $produkterlaris;?></h3>

              <p>Produk Terlaris</p>
            </div>
            <div class="icon">
              <i class="fa fa-rocket"></i>
            </div>
            <a href="<?=site_url('report/sale')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
</section>