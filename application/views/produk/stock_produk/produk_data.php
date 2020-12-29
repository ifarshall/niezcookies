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
    <?php $this->view('messages')?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Produk Barang</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('produk/add')?>" class="btn btn-primary btn-flat">
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
                        <th>Produk</th>
                        <th>Jenis Produk</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        <td>
                            <?=$data->barcode?><br>
                            <a href="<?=site_url('produk/barcode_qrcode/'.$data->produk_id)?>" class="btn btn-default btn-xs">
                                Generate <i class="fa fa-barcode"></i>
                            </a>
                        </td>
                        <td><?=$data->nama?></td>
                        <td><?=$data->nama_j_produk?></td>
                        <td><?=$data->nama_satuan?></td>
                        <td><?=$data->harga?></td>
                        <td><?=$data->stock?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('produk/edit/'.$data->produk_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('produk/del/'.$data->produk_id)?>" onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
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