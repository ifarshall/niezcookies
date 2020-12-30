<section class="content-header">
    <h1>Creator
        <small>Pembuat Produk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Pembuat Produk</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Pembuat Produk</h3>
            <div class="pull-right">
                <a href="<?=site_url('producer')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('producer/process')?>" method="post">
                        <div class="form-group">
                            <label>Nama Pembuat Produk *</label>
                            <input type="hidden" name="id" value="<?=$row->producer_id?>">
                            <input type="text" name="nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Lokasi *</label>
                            <textarea name="lokasi" class="form-control" required><?=$row->lokasi?></textarea>
                        </div>
                        <div class="form-group">
                            <label>No Telepon </label>
                            <input type="number" name="telepon" value="<?=$row->telepon?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi </label>
                            <input type="text" name="deskripsi" value="<?=$row->deskripsi?>" class="form-control">
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