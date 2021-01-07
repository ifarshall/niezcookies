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
            <h3 class="box-title"><?=ucfirst($page)?> Produk Barang</h3>
            <div class="pull-right">
                <a href="<?=site_url('produk_stock')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php echo form_open_multipart('produk_stock/process') ?>
                        <div class="form-group">
                            <label>Barcode *</label>
                            <input type="hidden" name="id" value="<?=$row->produk_id?>">
                            <input type="text" name="barcode" value="<?=$row->barcode?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk *</label>
                            <input type="text" name="nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Produk *</label>
                            <select name="j_produk" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($j_produk->result() as $key=>$data) { ?>
                                    <option value="<?=$data->j_produk_id?>"<?=$data->j_produk_id == $row->j_produk_id ? "selected" : null?>><?=$data->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan *</label>
                            <?php echo form_dropdown('satuan', $satuan, $selectedsatuan, 
                            ['class' => 'form-control', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group">
                            <label>Harga *</label>
                            <input type="number" name="price" value="<?=$row->harga?>" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Simpan</button>
                            <button type="reset" class="btn btn-gray btn-flat">
                                <i class="fa fa-repeat"></i> Reset</button>
                        </div>
                    <?php echo form_close() ?>                
                </div>
            </div>
        </div>
    </div>

</section>