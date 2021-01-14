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
                <a href="<?=site_url('produk/out')?>" class="btn btn-danger btn-flat">
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
                        <div class="form-group">
                            <label>Keterangan Produk Keluar *</label>
                            <textarea id="detail" name="detail" class="form-control" placeholder="Hilang/Bonus/Etc" required></textarea>
                            <small>*Keterangan kenapa produk keluar bukan penjualan</small>
                        </div>
                        <!-- <div class="form-group">
                            <label>Penanggung Jawab</label>
                            <select name="producer" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php foreach($producer as $p => $data) {
                                    echo '<option value="'.$data->producer_id.'">'.$data->nama.'</option>';
                                } ?>
                            </select>
                        </div> -->
                        <div class="form-group" <?=form_error('jumlah')? 'has-error':null?>>
                            <label>Jumlah *</label>
                            <input type="number" name="jumlah" value="<?=set_value('jumlah')?>"class="form-control" required>
                            <?=form_error('jumlah')?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="out_add" class="btn btn-success btn-flat">
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
    })

})
</script>