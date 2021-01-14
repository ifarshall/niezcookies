<section class="content-header">
    <h1>Tambah Stock Produk
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Tambah Stock produk</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Stock produk</h3>
            <div class="pull-right">
                <a href="<?=site_url('produk/in')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('produksi/process')?>" method="post">
                        <div class="form-group">
                            <label>Tanggal *</label>
                            <input type="date" name="tanggal" value="<?=date('Y-m-d')?>"class="form-control" required>
                        </div>
                        <div>
                            <label for="barcode">Barcode *</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="produk_id" id="produk_id">
                            <input type="text" name="barcode" id="barcode" class="form-control" required autofocus readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-produk">
                                    <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama produk *</label>
                            <input type="text" name="nama" id="nama" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="satuan_nama">Satuan produk *</label>
                                    <input type="text" name="satuan_nama" id="satuan_nama" value="-" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="stock_produk">Stock Awal *</label>
                                    <input type="text" name="stock_produk" id="stock_produk" value="-" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="invoice">Invoice Bahan *</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="transin_id" id="transin_id">
                            <input type="text" name="invoice" id="invoice" class="form-control" required readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-invoice">
                                    <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Proses Produksi *</label>
                            <textarea id="detail" row="3" cols="50" name="detail" class="form-control" placeholder="Keju 500gr, Susu 200ml, dst" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pembuat Produk</label>
                            <select name="producer" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($producer as $p => $data) {
                                    echo '<option value="'.$data->producer_id.'">'.$data->nama.'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah *</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="in_add" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Simpan</button>
                            <button type="reset" class="btn btn-gray btn-flat">
                                <i class="fa fa-repeat"></i> Reset</button>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="modal-produk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pilih Produk</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($produk as $b => $data) { ?>
                        <tr>
                            <td><?=$data->barcode?></td>
                            <td><?=$data->nama?></td>
                            <td><?=$data->nama_satuan?></td>
                            <td class="text-right"><?=indo_currency($data->harga)?></td>
                            <td class="text-right"><?=$data->stock?></td>
                            <td>
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$data->produk_id?>"
                                    data-barcode="<?=$data->barcode?>"
                                    data-nama="<?=$data->nama?>"
                                    data-satuan="<?=$data->nama_satuan?>"
                                    data-stock="<?=$data->stock?>">
                                    <i class="fa fa-check"></i> Pilih
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('click', '#select', function() {
        var produk_id = $(this).data('id');
        var barcode = $(this).data('barcode');
        var nama = $(this).data('nama');
        var nama_satuan = $(this).data('satuan');
        var stock = $(this).data('stock');
        $('#produk_id').val(produk_id);
        $('#barcode').val(barcode);
        $('#nama').val(nama);
        $('#satuan_nama').val(nama_satuan);
        $('#stock_produk').val(stock);
        $('#modal-produk').modal('hide');
        $('#total_price').val(total_price);
        
    })

})
</script>

<div class="modal fade" id="modal-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pilih Invoice</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table2">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Catatan</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($invoice as $inv => $data) { ?>
                        <tr>
                            <td><?=$data->invoice?></td>
                            <td><?=$data->catatan?></td>
                            <td><?=$data->tanggal?></td>
                            <td class="text-right"><?=indo_currency($data->total_price)?></td>
                            <td>
                                <button class="btn btn-xs btn-info" id="select2"
                                    data-transinid="<?=$data->transin_id?>"
                                    data-invoice="<?=$data->invoice?>"
                                    data-catatan="<?=$data->catatan?>"
                                    data-tanggal="<?=$data->tanggal?>"
                                    data-total_price="<?=$data->total_price?>">
                                    <i class="fa fa-check"></i> Pilih
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('click', '#select2', function() {
        var transin_id = $(this).data('transinid');
        var invoice = $(this).data('invoice');
        var catatan = $(this).data('catatan');
        var tanggal = $(this).data('tanggal');
        var total_price = $(this).data('total_price');
        $('#transin_id').val(transin_id);
        $('#invoice').val(invoice);
        $('#catatan').val(catatan);
        $('#tanggal').val(tanggal);
        $('#total_price').val(total_price);
        $('#modal-invoice').modal('hide');
        
    })

})
</script>