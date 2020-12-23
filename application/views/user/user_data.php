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
            <h3 class="box-title">Data Pengguna</h3>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <div class="pull-right">
                        <a href="<?=site_url('user/tambahUser')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-user-plus"></i>Tambah
                        </a>
                    </div>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Kewenangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td><?=$no++?>.</td>
                        <td><?=$data->username?></td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->nomor_hp?></td>
                        <td><?=$data->kewenangan == 1 ? "Administrator" : ($data->kewenangan == 2 ? "Cashier" : "Chef")?></td>
                        <td class="text-center" width="160px">
                            <form action="<?=site_url('user/hapusUser')?>" method="post">
                                <a href="<?=site_url('user/ubahUser/'.$data->user_id)?>" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil"></i>Ubah
                                </a>
                                <input type="hidden" name="user_id" value="<?=$data->user_id?>">
                                    <button onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>