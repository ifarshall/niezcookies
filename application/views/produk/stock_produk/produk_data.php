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
    <?php
    //  $this->view('messages')
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Produk Barang</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('produk_stock/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Tambah Produk
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Kategori Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td style="width: 10%;">
                            <?=$data->barcode?><br>
                            <a href="<?=site_url('produk_stock/barcode_qrcode/'.$data->produk_id)?>" class="btn btn-default btn-xs">
                                Generate <i class="fa fa-barcode"></i>
                            </a>
                        </td>
                        <td style="width: 10%"><?=$data->nama_j_produk?></td>
                        <td><?=$data->nama?></td>
                        <td><?=indo_currency($data->harga)?></td>
                        <td><?=$data->stock?></td>
                        <td><?=$data->nama_satuan?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('produk_stock/edit/'.$data->produk_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('produk_stock/del/'.$data->produk_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
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