<section class="content-header">
    <h1>Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-danger btn-flat">
                    <i class="fa fa-undo"></i>Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <?php //echo validation_errors(); ?>
                    <form action="" method="post">
                        <div class="form-group <?=form_error('username')? 'has-error':null?>">
                            <label>Username *</label>
                            <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                            <?=form_error('username')?>
                        </div>
                        <div class="form-group <?=form_error('password')? 'has-error':null?>">    
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control">
                            <?=form_error('password')?>
                        </div>
                        <div class="form-group <?=form_error('passconf')? 'has-error':null?>">
                            <label>Konfirmasi Password *</label>
                            <input type="password" name="passconf" class="form-control">
                            <?=form_error('passconf')?>
                        </div>
                        <div class="form-group <?=form_error('fullname')? 'has-error':null?>">    
                            <label>Nama *</label>
                            <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                            <?=form_error('fullname')?>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="phonenumber" value="<?=set_value('phonenumber')?>" class="form-control">
                        </div>
                        <div class="form-group <?=form_error('level')? 'has-error':null?>">
                            <label>Kewenangan *</label>
                            <select name="level" class="form-control">
                                <option value=""> - Pilih - </option>
                                <option value="1"> Administrator </option>
                                <option value="2"> Cashier </option>
                                <option value="3"> Chef </option>
                            </select>
                            <?=form_error('level')?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">
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