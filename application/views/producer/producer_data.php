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
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Pembuat Produk</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('producer/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pembuat Produk</th>
                        <th>Lokasi</th>
                        <th>No Telepon</th>
                        <th>Deskripsi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->lokasi?></td>
                        <td><?=$data->telepon?></td>
                        <td><?=$data->deskripsi?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('producer/edit/'.$data->producer_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('producer/del/'.$data->producer_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                            <!-- <a href="#modalDelete" data-toggle="modal" onclick="$('#modalDelete #formDelete').attr('action', '<?=site_url('producer/del/'.$data->producer_id)?>')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a> -->
                        </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="modalDelete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Apakah yakin ingin dihapus?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="post">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-danger" type="submit">Iya</button>
                </form>
            </div>
        </div>
    </div>
</div>