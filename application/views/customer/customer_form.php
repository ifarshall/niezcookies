<section class="content-header">
    <h1>Customers
        <small>Pelanggan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Pelanggan</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> customer</h3>
            <div class="pull-right">
                <a href="<?=site_url('customer')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="<?=site_url('customer/process')?>" method="post">
                        <div class="form-group">
                            <label>Nama Pelanggan *</label>
                            <input type="hidden" name="id" value="<?=$row->customer_id?>">
                            <input type="text" name="nama" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin *</label>
                            <select name="gender" class="form-control" required>
                            <option value=""> - Pilih - </option>
                            <option value="L" <?=$row->gender == 'L' ? 'selected' : null?>>Laki-laki</option>
                            <option value="P" <?=$row->gender == 'P' ? 'selected' : null?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Telepon *</label>
                            <input type="number" name="telepon" value="<?=$row->telepon?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat </label>
                            <textarea name="alamat" class="form-control" required><?=$row->alamat?></textarea>
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