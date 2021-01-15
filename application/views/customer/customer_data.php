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
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Toko</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('customer/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->gender == 'L' ? "Laki-laki" : ($data->gender == 'P' ? "Perempuan" : '')?></td>
                        <td><?=$data->telepon?></td>
                        <td><?=$data->alamat?></td>
                        <td><?=$data->created = date('d-m-Y')?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('customer/edit/'.$data->customer_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('customer/del/'.$data->customer_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
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