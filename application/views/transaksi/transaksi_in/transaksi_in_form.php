<section class="content-header">
    <h1>Proses Produksi
        <small>Keluar Bahan Masuk Produk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Proses Produksi</li>
    </ol>
</section>

<section class="content">
    <!--ROW 1-->
    <div class="row">
        <!--FORM KIRI-->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="tanggal">Tanggal</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="date" id="tanggal" value="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top; width:30%">
                            <label for="user">Penanggung Jawab</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="user" value="<?=$this->fungsi->user_login()->nama?>" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="producer">Pembuat Produk</label>
                        </td>
                        <td>
                            <div>
                                <select id="producer" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php foreach($producer as $prod => $value) {
                                        echo '<option value="'.$value->producer_id.'">'.$value->nama.'</option>';
                                    }?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    
        <!--FORM TENGAH-->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="nama">Bahan</label>
                        </td>
                        <td>
                            <div class="form-group input-group">
                                <input type="hidden" id="bahan_id">
                                <input type="hidden" id="harga">
                                <input type="hidden" id="stock">
                                <input type="hidden" id="jumlah_cart">
                                <input type="text" id="nama" class="form-control" autofocus readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-bahan">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="nama_satuan">Satuan</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="nama_satuan" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="jumlah">Pemakaian</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="jumlah" value="1" min="1" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>
                                <button type="button" id="add_cart" class="btn btn-primary">
                                    <i class="fa fa-cart-plus"></i> Tambah
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <!--FORM KANAN-->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b><span id="invoice" style="font-size: 20pt    "><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total2" style="font-size: 50pt">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FORM ROW 2 FULL-->
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Bahan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th width="15%">Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">
                        <?php $this->view('transaksi/transaksi_in/incart_data')?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!--ROW 3-->
    <div class="row">
        <!--FORM KIRI-->
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top; width:30%">
                            <label for="sub_total">Total</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="sub_total" value="" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    
        <!--FORM kedua-->
        <!-- <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top; width: 30%">
                            <label for="cash">Bayar</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="cash" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="kembali">Kembali</label>
                        </td>
                        <td>
                            <div class="form-group">
                            <input type="number" id="kembali" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div> -->
        <!--FORM TENGAH 2-->
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="catatan">Produk yang dibuat</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea id="catatan" row="3" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <!--FORM KANAN-->
        <div class="col-lg-3">
            <div>
                <button id="batal_bayar" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Batal
                </button><br><br>
                <button id="proses_bayar" class="btn btn-flat btn-lg btn-success">
                    <i class="fa fa-paper-plane-o"></i> Proses Produksi
                </button>
            </div>
        </div>
    </div>
</section>


<!--MODAL ADD BAHAN-->
<div class="modal fade" id="modal-bahan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pilih Bahan</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($bahan as $b => $data) { ?>
                        <tr>
                            <td><?=$data->nama?></td>
                            <td><?=$data->nama_satuan?></td>
                            <td class="text-right"><?=indo_currency($data->harga)?></td>
                            <td class="text-right"><?=$data->stock?></td>
                            <td>
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$data->bahan_id?>"
                                    data-nama="<?=$data->nama?>"
                                    data-nama_satuan="<?=$data->nama_satuan?>"
                                    data-harga="<?=$data->harga?>"
                                    data-stock="<?=$data->stock?>">
                                    <i class="fa fa-check"></i> Pilih
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '#select', function() {
    $('#bahan_id').val($(this).data('id'));
    $('#nama').val($(this).data('nama'));
    $('#nama_satuan').val($(this).data('nama_satuan'));
    $('#harga').val($(this).data('harga'));
    $('#stock').val($(this).data('stock'));
    $('#modal-bahan').modal('hide');
    get_cart_jumlah($(this).data('nama'))
})

function get_cart_jumlah(nama) {
    $('#cart_table tr').each(function() {
        var jumlah_cart = $("#cart_table td.nama:contains('"+nama+"')").parent().find("td").eq(3).html();
        if(jumlah_cart != null) {
        $('#jumlah_cart').val(jumlah_cart)
        } else {
            $('#jumlah_cart').val(0)
        }
    });
}

$(document).on('click', '#add_cart', function(){
    var bahan_id = $('#bahan_id').val()
    var harga = $('#harga').val()
    // var satuan = $('#satuan').val()
    var stock = $('#stock').val()
    var jumlah = $('#jumlah').val()
    var jumlah_cart = $('#jumlah_cart').val()
    if (bahan_id == ''){
        alert('Bahan belum dipilih')
        $('#nama').focus()
    } else if (stock < 1 || parseInt(stock) < (parseInt(jumlah) + parseInt(jumlah_cart))) {
        alert('Stock tidak mencukupi')
        $('#nama').focus()
    } else {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_in/process')?>',
            data: {'add_cart': true, 'bahan_id' : bahan_id, 'harga' : harga, 'jumlah': jumlah},
            dataType: 'json',
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_in/cart_data')?>', function() {
                        calculate()
                    })
                    $('#bahan_id').val('')
                    $('#nama').val('')
                    $('#nama_satuan').val('')
                    $('#jumlah').val(1)
                    $('#nama').focus()
                } else {
                    alert('Gagal tambah item cart')
                }
            }
        })
    }
})

$(document).on('click', '#del_cart', function() {
    if(confirm('Apakah anda yakin dihapus?')) {
        var incart_id = $(this).data('cartid')
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_in/cart_del')?>',
            dataType: 'json',
            data: {'incart_id': incart_id},
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_in/cart_data')?>', function() {
                        calculate()
                    })
                } else {
                    alert('Gagal hapus item cart');
                }
            }
        })
    }

})

function calculate(){
    var subtotal = 0;
    $('#cart_table tr').each(function() {
        subtotal += parseInt($(this).find('#total').text())
    })
    if(isNaN(subtotal)) {
        $('#sub_total').val(0)
        $('#grand_total2').text(0)
    } else {
        $('#sub_total').val(subtotal)
        $('#grand_total2').text(subtotal)
    }

}

$(document).ready(function() {
    calculate()
})


$(document).on('click', '#proses_bayar', function() {
    var producer_id = $('#producer').val()
    var subtotal = $('#sub_total').val()
    var catatan = $('#catatan').val()
    var tanggal = $('#tanggal').val()
    if(subtotal < 1) {
        alert('Belum ada bahan yang dipilih')
        $('#nama').focus()
    } else if(producer_id == "") {
        alert('Pembuat Produk belum dipilih')
        $('#producer').focus()
    } else {
        if(confirm('Yakin proses transaksi ini?')) {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('transaksi_in/process')?>',
                data: {'proses_bayar': true, 'producer_id': producer_id, 'subtotal': subtotal, 
                    'catatan': catatan, 'tanggal': tanggal},
                dataType: 'json',
                success: function(result) {
                    if(result.success) {
                        alert('Silakan mengambil bahan');
                        window.open('<?=site_url('transaksi_in/cetak/')?>' + result.transin_id, '_blank');
                    } else {
                        alert('Transaksi gagal');
                    }
                    location.href='<?=site_url('transaksi_in')?>'
                }
            })
        }
    }
})

$(document).on('click', '#batal_bayar', function(){
    if(confirm('Apakah anda yakin dibatalkan?')) {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_in/cart_del')?>',
            dataType: 'json',
            data: {'batal_bayar': true},
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_in/cart_data')?>', function(){
                        calculate()
                    })
                }
            }
        })
        $('#producer').val('').change()
        $('#nama').val('')
        $('#nama').focus()
    }
})

</script>