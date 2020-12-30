<section class="content-header">
    <h1>Tambah Stock Bahan
        <small>Pembelian</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Tambah Stock Bahan</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Stock Bahan</h3>
            <div class="pull-right">
                <a href="<?=site_url('bahan/in')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('purchase/process')?>" method="post">
                        <div class="form-group">
                            <label>Tanggal *</label>
                            <input type="date" name="tanggal" value="<?=date('Y-m-d')?>"class="form-control" required>
                        </div>
                        <div>
                            <label for="nama">Nama Bahan *</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="bahan_id" id="bahan_id">
                            <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-bahan">
                                    <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="satuan_nama">Satuan Bahan *</label>
                                    <input type="text" name="satuan_nama" id="satuan_nama" value="-" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="stock_bahan">Stock Awal *</label>
                                    <input type="text" name="stock_bahan" id="stock_bahan" value="-" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detail *</label>
                            <input type="text" name="detail" class="form-control" placeholder="Beli/Bonus/Sisa/etc" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat Beli</label>
                            <select name="supplier" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php foreach($supplier as $s => $data) {
                                    echo '<option value="'.$data->supplier_id.'">'.$data->nama_toko.'</option>';
                                } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah *</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Harga *</label>
                            <input type="number" name="price" class="form-control" required>
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

<div class="modal fade" id="modal-bahan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pilih Bahan</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Satuan</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($bahan as $b => $data) { ?>
                        <tr>
                            <td><?=$data->nama?></td>
                            <td><?=$data->nama_satuan?></td>
                            <td class="text-right"><?=$data->stock?></td>
                            <td>
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$data->bahan_id?>"
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
        var bahan_id = $(this).data('id');
        var nama = $(this).data('nama');
        var nama_satuan = $(this).data('satuan');
        var stock = $(this).data('stock');
        $('#bahan_id').val(bahan_id);
        $('#nama').val(nama);
        $('#satuan_nama').val(nama_satuan);
        $('#stock_bahan').val(stock);
        $('#modal-bahan').modal('hide');
    })

})
</script>