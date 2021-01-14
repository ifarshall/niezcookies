<section class="content-header">
    <h1>Kategori Produk
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Kategori Produk</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Kategori Produk</h3>
            <div class="pull-right">
                <a href="<?=site_url('j_produk')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('j_produk/process')?>" method="post">
                        <div class="form-group">
                            <label>Jenis Produk *</label>
                            <input type="hidden" name="id" value="<?=$row->j_produk_id?>">
                            <input type="text" name="nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                            <label>Chef *</label>
                            <select name="producer" class="form-control" required>
                            <option value=""> - Pilih - </option>
                            <option value="1" <?=$row->producer == '1' ? 'selected' : null?>>Anisa</option>
                            <option value="2" <?=$row->producer == '2' ? 'selected' : null?>>Mama Puri</option>
                            <option value="3" <?=$row->producer == '3' ? 'selected' : null?>>Carlita</option>
                            </select>
                        </div>
                        <div class="form-group"> -->
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