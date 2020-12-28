<section class="content-header">
    <h1>Jenis Bahan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Jenis Bahan</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Jenis Bahan</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('j_bahan/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis Bahan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->nama?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('j_bahan/edit/'.$data->j_bahan_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('j_bahan/del/'.$data->j_bahan_id)?>" onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>