<section class="content-header">
    <h1>Production Report
        <small>Laporan Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Production Report</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Produksi</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Produksi</th>
                        <th>Tanggal Produksi</th>
                        <th>Pembuat Bahan</th>
                        <th class="text-right">Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->invoice?></td>
                        <td><?=indo_date($data->tanggal)?></td>
                        <td><?=$data->nama_producer?></td>
                        <td class="text-right"><?=indo_currency($data->total_price)?></td>
                        <td class="text-center" width="200px">
                            <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-xs"
                            data-invoice="<?=$data->invoice?>"
                            data-tanggal="<?=indo_date($data->tanggal)?>"
                            data-time="<?=substr($data->sale_created, 11,5)?>"
                            data-producer="<?=$data->nama_producer?>"
                            data-total="<?=indo_currency($data->total_price)?>"    
                            data-note="<?=$data->catatan?>"
                            data-pencatat="<?=$data->nama_user?>"
                            data-transinid="<?=$data->transin_id?>"
                            >Detail</button>
                            <a href="<?=site_url('transaksi_in/cetak/'.$data->transin_id)?>" target="_blank" class="btn btn-info btn-xs">
                                <i class="fa fa-print"></i> Cetak
                            </a>
                    
                            <a href="<?=site_url('transaksi_in/del/'.$data->transin_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                            
                        </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="bot-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <?=$pagination?>
            </ul>
        </div>
    </div>
</section>

<!--MODAL/POPUPNYA-->

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Production Report Detail</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 20%">Kode Produksi</th>
                            <td style="width: 30%"><span id="invoice"></span></td>
                            <th style="width: 20%">Pembuat Produk</th>
                            <td style="width: 30%"><span id="producer"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Produksi</th>
                            <td><span id="datetime"></span></td>
                            <th>Pencatat Bahan</th>
                            <td><span id="pencatat"></span></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><span id="total"></span></td>
                            <th>Catatan</th>
                            <td><span id="note"></span></td>
                        </tr>
                        <tr>
                            <th>Bahan</th>
                            <td colspan="3"><span id="bahan"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--SCRIPT JQUERY-->
<script>
$(document).on('click', '#detail', function() {
    $('#invoice').text($(this).data('invoice'))
    $('#producer').text($(this).data('producer'))
    $('#datetime').text($(this).data('tanggal') + ' ' + $(this).data('time'))
    $('#pencatat').text($(this).data('pencatat'))
    $('#total').text($(this).data('total'))
    $('#note').text($(this).data('note'))

    var bahan = '<table class="table no-margin">'
    bahan += '<tr><th>Bahan</th><th>Harga</th><th>Jumlah</th><th>Total</th></tr>'
    $.getJSON('<?=site_url('reportprod/sale_bahan/')?>'+$(this).data('transinid'), function(data) {
        $.each(data, function (key,val) {
            bahan += '<tr><td>'+val.nama+'</td><td>'+val.harga+'</td><td>'+val.jumlah+'</td><td>'+val.total+'</td></tr>'
        })
        bahan += '</table>'
        $('#bahan').html(bahan)
    })
})
</script>