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

            <p>Stock Produk</p>
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
            <h3><?php echo $pesanan?></h3>

            <p>Jumlah Pesanan</p>
          </div>
          <div class="icon">
            <i class="fa fa-gift"></i>
          </div>
          <a href="<?=site_url('calender')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $belumrekam;?></h3>

              <p>Produk On Progress</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-2"></i>
            </div>
            <a href="<?=site_url('produk/in')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Produk Terlaris Bulan ini</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body chart-responsive">
          <div id="sales-bar" class="graph"  style="height: 300px;"></div>
      </div>
    </div>
</section>

<!-- <section>
<div class="row">
<h1><i class="fa fa-warning"></i> Under Maintenance</h1>
</div>
</section> -->

<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/morris.js/morris.css">
<script src="<?=base_url()?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/morris.js/morris.min.js"></script>

<script>
   var bar = new Morris.Bar({
      element: 'sales-bar',
      resize: true,
      data: [
              <?php foreach($row as $key => $data) {
                echo "{item: '".$data->nama."', sold: ".$data->sold."},";
              } ?>
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'item',
      ykeys: ['sold'],
      labels: ['Terjual'],
      hideHover: 'auto'
    });
</script>