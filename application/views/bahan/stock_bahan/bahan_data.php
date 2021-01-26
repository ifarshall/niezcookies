<section class="content-header">
    <h1>Bahan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Bahan</li>
    </ol>
</section>
<!-- MAIN CONTENT-->
<section class="content">
    <?php 
    // $this->view('messages')
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success');?>"></div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Bahan Produksi</h3>
                    <div class="pull-right">
                        <a href="<?=site_url('bahan_stock/add')?>" class="btn btn-primary btn-flat">
                            <i class="fa fa-plus"></i> Tambah Bahan
                        </a>
                    </div>
                    </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kategori Bahan</th>
                        <th>Nama Bahan</th>
                        <th>Total Harga</th>
                        <th>Harga Satuan</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php $no =1;
                    foreach ($row->result() as $key => $data) { ?>
                    <tr>
                        <td style="width: 5%;"><?=$no++?>.</td>
                        
                        <td><?=$data->nama?></td>
                        <td><?=$data->nama_j_bahan?></td>
                        <td><?=$data->nama_satuan?></td>
                        <td><?=$data->total_harga?></td>
                        <td><?=$data->harga?></td>
                        <td><?=$data->stock?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('bahan_stock/edit/'.$data->bahan_id)?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Ubah
                            </a>
                            <a href="<?=site_url('bahan_stock/del/'.$data->bahan_id)?>" onclick="return confirm('Apakah anda yakin dihapus?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                    } ?> -->
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('#table1').DataTable({
            "processing": true,
            "ServerSide": true,
            "responsive": true,
            "ajax": {
                "url": "<?=site_url('bahan_stock/get_ajax')?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [3,4,5],
                    "className": 'text-right',
                },
                {
                    "targets": [7],
                    "className": 'text-center',
                },
                {
                    "targets": [7],
                    "orderable": false,
                    "width": "20%"
                },
                {
                    "targets": [0],
                    "width": "5%",
                },
                {
                    "targets": [1,2],
                    "width": "10%",
                },
            ]
        })
    })
</script>