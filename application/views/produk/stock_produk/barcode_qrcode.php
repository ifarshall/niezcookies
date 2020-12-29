<section class="content-header">
    <h1>Produk
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Produk</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Barcode Generator <i class="fa fa-barcode"></i></h3>
            <div class="pull-right">
                <a href="<?=site_url('produk')?>" class="btn btn-danger btn-flat btn-sm">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <?php 
            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" style="width: 200px">';
            ?>
            <br>
            <?=$row->nama?>
            <br><br>
                <a href="<?=site_url('produk/barcode_print/'.$row->produk_id)?>" target="_blank" class="btn btn-default btn-xs">
                    <i class="fa fa-print"></i> Cetak
                </a>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">QR Code Generator <i class="fa fa-qrcode"></i></h3>
            <!-- <div class="pull-right">
                <a href="<?=site_url('produk')?>" class="btn btn-danger btn-flat btn-sm">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div> -->
        </div>
        <div class="box-body">
            <?php 
            $qrCode = new Endroid\QrCode\QrCode($row->barcode);
            $qrCode->writeFile('uploads/qrcode/qrcode-'.$row->barcode.'.png');
            ?>
            <img src="<?=base_url('uploads/qrcode/qrcode-'.$row->barcode.'.png')?>" style="width: 200px">
            <br>
            <?=$row->nama?>
            <!-- <br><br>
                <a href="<?=site_url('produk/qrcode_print/'.$row->produk_id)?>" target="_blank" class="btn btn-default btn-xs">
                    <i class="fa fa-print"></i> Cetak
                </a> -->
        </div>
    </div>

</section>