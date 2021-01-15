<section class="content-header">
    <h1>Bahan Keluar
        <small>Rusak/Hilang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Bahan Keluar</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php 
    // $this->view('messages')
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Stock Bahan Keluar</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('bahan/out/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-shopping-cart"></i> Tambah Bahan Keluar
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Bahan</th>
                        <th class="text-right">Jumlah</th>
                        <th class="text-right">Perkiraan Kerugian Harga</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->nama_bahan?></td>
                        <td class="text-right"><?=$data->jumlah?></td>
                        <td class="text-right"><?=indo_currency($data->harga_beli)?></td>
                        <td class="text-center"><?=indo_date($data->tanggal)?></td>
                        <td class="text-center" width="160px">
                            <a id="set_dtl" class="btn btn-primary btn-xs" 
                                data-toggle="modal" data-target="#modal-detail"
                                data-namabahan="<?=$data->nama_bahan?>"
                                data-detail="<?=$data->detail?>"
                                data-jumlah="<?=$data->jumlah?>"
                                data-harga="<?=indo_currency($data->harga_beli)?>"
                                data-tanggal="<?=indo_date($data->tanggal)?>">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="<?=site_url('bahan/out/del/'.$data->purchase_id.'/'.$data->bahan_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
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
                <h4 class="modal-title">Detail Bahan Keluar</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 35%">Nama</th>
                            <td><span id="nama_bahan"></span></td>
                        </tr>
                        <tr>
                            <th>Keterangan Bahan Keluar</th>
                            <td><span id="detail"></span></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><span id="jumlah"></span></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td><span id="harga_beli"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
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
        var namabahan = $(this).data('namabahan');
        var detail = $(this).data('detail');
        var jumlah = $(this).data('jumlah');
        var harga = $(this).data('harga');
        var tanggal = $(this).data('tanggal');
        $('#nama_bahan').text(namabahan);
        $('#detail').text(detail);
        $('#jumlah').text(jumlah);
        $('#harga_beli').text(harga);
        $('#tanggal').text(tanggal);
    })

})
</script>