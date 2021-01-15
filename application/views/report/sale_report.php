<section class="content-header">
    <h1>Sales Report
        <small>Laporan Penjualan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Sales Report</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal Penjualan</th>
                        <th>Pelanggan</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Diskon</th>
                        <th class="text-right">Grand Total</th>
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
                        <td><?=$data->customer_id == null ? "Umum" : $data->nama_customer?></td>
                        <td class="text-right"><?=indo_currency($data->total_price)?></td>
                        <td class="text-right"><?=indo_currency($data->diskon)?></td>
                        <td class="text-right"><?=indo_currency($data->final_price)?></td>
                        <td class="text-center" width="200px">
                            <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-xs"
                            data-invoice="<?=$data->invoice?>"
                            data-tanggal="<?=indo_date($data->tanggal)?>"
                            data-time="<?=substr($data->sale_created, 11,5)?>"
                            data-customer="<?=$data->customer_id == null ? "Umum" : $data->nama_customer?>"
                            data-total="<?=indo_currency($data->total_price)?>"    
                            data-diskon="<?=indo_currency($data->diskon)?>"
                            data-grandtotal="<?=indo_currency($data->final_price)?>"
                            data-cash="<?=indo_currency($data->cash)?>"
                            data-change="<?=indo_currency($data->remain)?>"
                            data-note="<?=$data->catatan?>"
                            data-kasir="<?=$data->nama_user?>"
                            data-transoutid="<?=$data->transout_id?>"
                            >Detail</button>
                            <a href="<?=site_url('transaksi_out/cetak/'.$data->transout_id)?>" target="_blank" class="btn btn-info btn-xs">
                                <i class="fa fa-print"></i> Cetak
                            </a>
                            <a href="<?=site_url('transaksi_out/del/'.$data->transout_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
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

<!--MODAL/POPUPNYA-->

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Sales Report Detail</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 20%">Invoice</th>
                            <td style="width: 30%"><span id="invoice"></span></td>
                            <th style="width: 20%">Customer</th>
                            <td style="width: 30%"><span id="cust"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Penjualan</th>
                            <td><span id="datetime"></span></td>
                            <th>Kasir</th>
                            <td><span id="kasir"></span></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><span id="total"></span></td>
                            <th>Tunai</th>
                            <td><span id="cash"></span></td>
                        </tr>
                        <tr>
                            <th>Diskon</th>
                            <td><span id="diskon"></span></td>
                            <th>Kembali</th>
                            <td><span id="change"></span></td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td><span id="grandtotal"></span></td>
                            <th>Catatan</th>
                            <td><span id="note"></span></td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td colspan="3"><span id="product"></span></td>
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
    $('#cust').text($(this).data('customer'))
    $('#datetime').text($(this).data('tanggal') + ' ' + $(this).data('time'))
    $('#kasir').text($(this).data('kasir'))
    $('#total').text($(this).data('total'))
    $('#diskon').text($(this).data('diskon'))
    $('#change').text($(this).data('change'))
    $('#grandtotal').text($(this).data('grandtotal'))
    $('#note').text($(this).data('note'))
    $('#cash').text($(this).data('cash'))

    var product = '<table class="table no-margin">'
    product += '<tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Diskon</th><th>Total</th></tr>'
    $.getJSON('<?=site_url('report/sale_product/')?>'+$(this).data('transoutid'), function(data) {
        $.each(data, function (key,val) {
            product += '<tr><td>'+val.nama+'</td><td>'+val.harga+'</td><td>'+val.jumlah+'</td><td>'+val.diskon_item+'</td><td>'+val.total+'</td></tr>'
        })
        product += '</table>'
        $('#product').html(product)
    })
})
</script>