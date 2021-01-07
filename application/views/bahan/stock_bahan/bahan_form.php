<section class="content-header">
    <h1>Bahan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Bahan</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Bahan Produksi</h3>
            <div class="pull-right">
                <a href="<?=site_url('bahan_stock')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('bahan_stock/process')?>" method="post">
                        <!-- <div class="form-group">
                            <label>Barcode *</label>
                            <input type="text" name="barcode" value="<?=$row->barcode?>" class="form-control" required>
                        </div> -->
                        <div class="form-group">
                            <label>Nama Bahan *</label>
                            <input type="hidden" name="id" value="<?=$row->bahan_id?>">
                            <input type="text" name="nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Bahan *</label>
                            <select name="j_bahan" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($j_bahan->result() as $key=>$data) { ?>
                                    <option value="<?=$data->j_bahan_id?>"<?=$data->j_bahan_id == $row->j_bahan_id ? "selected" : null?>><?=$data->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan *</label>
                            <?php echo form_dropdown('satuan', $satuan, $selectedsatuan, 
                            ['class' => 'form-control', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
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