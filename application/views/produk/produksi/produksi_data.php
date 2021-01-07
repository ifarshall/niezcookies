<section class="content-header">
    <h1>Tambah Stock Produk
        <small>Produk Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Tambah Stock produk</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Stock Produk</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('produk/in/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-shopping-cart"></i> Tambah Stock Produk
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Nama Produk</th>
                        <!-- <th>Kode Produksi</th> -->
                        <th class="text-right">Jumlah</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->barcode?></td>
                        <td><?=$data->nama_produk?></td>
                        <!-- <td><?=$data->invoice_bahan?></td> -->
                        <td class="text-right"><?=$data->jumlah?></td>
                        <td class="text-center"><?=indo_date($data->tanggal)?></td>
                        <td class="text-center" width="160px">
                            <a id="set_dtl" class="btn btn-primary btn-xs"data-toggle="modal" data-target="#modal-detail"
                                data-barcode="<?=$data->barcode?>"
                                data-namaproduk="<?=$data->nama_produk?>"
                                data-producer="<?=$data->nama_producer?>"
                                data-transin_id="<?=$data->transin_id?>"
                                data-jumlah="<?=$data->jumlah?>"
                                data-tanggal="<?=indo_date($data->tanggal)?>"
                                
                                data-detail="<?=$data->detail?>">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="<?=site_url('produk/in/del/'.$data->produksi_id.'/'.$data->produk_id)?>" onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--MODAL/POPUP-->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Produksi</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 35%">Barcode</th>
                            <td><span id="barcode"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td><span id="nama_produk"></span></td>
                        </tr>
                        <tr>
                            <th>Pembuat Produk</th>
                            <td><span id="producer"></span></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><span id="jumlah"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
                        </tr>
                        <tr>
                            <th>ID Produksi</th>
                            <td><span id="transin_id"></span></td>
                        </tr>
                        <tr>
                            <th>Detail bahan yang digunakan</th>
                            <td><span id="detail"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('click', '#set_dtl', function() {
        var barcode = $(this).data('barcode');
        var namaproduk = $(this).data('namaproduk');
        var producer = $(this).data('producer');
        var jumlah = $(this).data('jumlah');
        var tanggal = $(this).data('tanggal');
        var transin_id = $(this).data('transin_id');
        var detail = $(this).data('detail');
        $('#barcode').text(barcode);
        $('#nama_produk').text(namaproduk);
        $('#producer').text(producer);
        $('#jumlah').text(jumlah);
        $('#tanggal').text(tanggal);
        $('#transin_id').text(transin_id);
        $('#detail').text(detail);
    })

})
</script>