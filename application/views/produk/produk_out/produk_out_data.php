<section class="content-header">
    <h1>Produk Keluar
        <small>Hilang/Rusak</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Produk Keluar</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Produk Keluar</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('produk/out/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-shopping-cart"></i> Tambah Produk Keluar
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
                        <td class="text-right"><?=$data->jumlah?></td>
                        <td class="text-center"><?=indo_date($data->tanggal)?></td>
                        <td class="text-center" width="160px">
                            <a id="set_dtl" class="btn btn-primary btn-xs"data-toggle="modal" data-target="#modal-detail"
                                data-barcode="<?=$data->barcode?>"
                                data-namaproduk="<?=$data->nama_produk?>"
                                data-producer="<?=$data->nama_producer?>"
                                data-jumlah="<?=$data->jumlah?>"
                                data-tanggal="<?=indo_date($data->tanggal)?>"
                                data-detail="<?=$data->detail?>">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="<?=site_url('produk/out/del/'.$data->produksi_id.'/'.$data->produk_id)?>" onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
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
                            <th>Penanggung Jawab</th>
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
                            <th>Keterangan Produk Keluar</th>
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
        var detail = $(this).data('detail');
        $('#barcode').text(barcode);
        $('#nama_produk').text(namaproduk);
        $('#producer').text(producer);
        $('#jumlah').text(jumlah);
        $('#tanggal').text(tanggal);
        $('#detail').text(detail);
    })

})
</script>