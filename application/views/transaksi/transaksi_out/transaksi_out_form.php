<section class="content-header">
    <h1>Penjualan
        <small>Kasir</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Penjualan</li>
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
                            <label for="user">Kasir</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="user" value="<?=$this->fungsi->user_login()->nama?>" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="customer">Pelanggan</label>
                        </td>
                        <td>
                            <div>
                                <select id="customer" class="form-control">
                                    <option value="">Umum</option>
                                    <?php foreach($customer as $cust => $value) {
                                        echo '<option value="'.$value->customer_id.'">'.$value->nama.'</option>';
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
                            <label for="barcode">Barcode</label>
                        </td>
                        <td>
                            <div class="form-group input-group">
                                <input type="hidden" id="produk_id">
                                <input type="hidden" id="harga">
                                <input type="hidden" id="stock">
                                <input type="hidden" id="jumlah_cart">
                                <input type="text" id="barcode" class="form-control" autofocus readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-produk">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="jumlah">Jumlah</label>
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
                        <h4>Invoice <b><span id="invoice" style="font-size: 20pt"><?=$invoice?></span></b></h4>
                        <h1><b><span id="grand_total2" onkeyup="indo_currency()" style="font-size: 50pt">0</span></b></h1>
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
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th class="text-right">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th width="10%">Diskon</th>
                            <th width="15%">Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">
                        <?php $this->view('transaksi/transaksi_out/outcart_data')?>
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
                            <label for="sub_total">Sub Total</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="sub_total" value="" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="discount">Diskon</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="discount" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <label for="grand_total">Grand Total</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="grand_total" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    
        <!--FORM kedua-->
        <div class="col-lg-3">
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
                            <label for="change">Kembali</label>
                        </td>
                        <td>
                            <div class="form-group">
                            <input type="number" id="change" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <!--FORM TENGAH 2-->
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align:top">
                            <label for="catatan">Catatan</label>
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
                    <i class="fa fa-paper-plane-o"></i> Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-produk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pilih Produk</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produk as $b => $data) { ?>
                        <tr>
                            <td><?=$data->barcode?></td>
                            <td><?=$data->nama?></td>
                            <td><?=$data->nama_satuan?></td>
                            <td class="text-right"><?=indo_currency($data->harga)?></td>
                            <td class="text-right"><?=$data->stock?></td>
                            <td>
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$data->produk_id?>"
                                    data-barcode="<?=$data->barcode?>"
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

<!-- Modal Edit Cart Item -->
<div class="modal fade" id="modal-item-edit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Ubah detail Produk</h4>
			</div>
			<div class="modal-body">
                <input type="hidden" id="cartid_item">
                <div class="form-group">
                    <label for="produk_item">Detail Produk</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" id="barcode_item" class="form-control" readonly>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="produk_item" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga_item">Harga</label>
                    <input type="number" id="harga_item" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label for="jumlah_item">Jumlah</label>
                            <input type="number" id="jumlah_item" min="1" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>Stock Produk</label>
                            <input type="number" id="stock_item" class="form-control" readonly>
                        </div>
                </div>
                <div class="form-group">
                    <label for="total_before">Total Sebelum</label>
                    <input type="number" id="total_before" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="diskon_item">Diskon per Item</label>
                    <input type="number" id="diskon_item" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label for="total_item">Total setelah Diskon</label>
                    <input type="number" id="total_item" class="form-control" readonly>
                </div>
			</div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="edit_cart" class="btn btn-flat btn-success">
                        <i class="fa fa-paper-plane"></i> Simpan
                    </button>
                </div>
            </div>
		</div>
	</div>
</div>
</div>

<script>
$(document).on('click', '#select', function() {
    $('#produk_id').val($(this).data('id'));
    $('#barcode').val($(this).data('barcode'));
    $('#harga').val($(this).data('harga'));
    $('#stock').val($(this).data('stock'));
    $('#modal-produk').modal('hide');
    get_cart_jumlah($(this).data('barcode'))
})

function get_cart_jumlah(barcode) {
    $('#cart_table tr').each(function() {
        var jumlah_cart = $("#cart_table td.barcode:contains('"+barcode+"')").parent().find("td").eq(4).html();
        if(jumlah_cart != null) {
        $('#jumlah_cart').val(jumlah_cart)
        } else {
            $('#jumlah_cart').val(0)
        }
    });
}





$(document).on('click', '#add_cart', function() {
    var produk_id = $('#produk_id').val()
    var harga = $('#harga').val()
    var stock = $('#stock').val()
    var jumlah = $('#jumlah').val()
    var jumlah_cart = $('#jumlah_cart').val()
    if(produk_id == '') {
        alert('Product belum dipilih')
        $('#barcode').focus()
    } else if(stock < 1 || parseInt(stock) < (parseInt(jumlah) + parseInt(jumlah_cart))) {
        alert('Stock tidak mencukupi')
        $('#barcode').focus()
    } else {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_out/process')?>',
            data: {'add_cart' : true, 'produk_id' : produk_id, 'harga' : harga, 'jumlah' : jumlah},
            dataType: 'json',
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_out/cart_data')?>', function() {
                        calculate()
                    })
                    $('#produk_id').val('')
                    $('#barcode').val('')
                    $('#jumlah').val(1)
                    $('#barcode').focus()
                } else {
                    alert('Gagal tambah item cart')
                }
            }
        })
    }
})

$(document).on('click', '#del_cart', function() {
    if(confirm('Apakah anda yakin dihapus?')) {
        var outcart_id = $(this).data('cartid')
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_out/cart_del')?>',
            dataType: 'json',
            data: {'outcart_id': outcart_id},
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_out/cart_data')?>', function() {
                        calculate()
                    })
                } else {
                    alert('Gagal hapus item cart');
                }
            }
        })
    }

})

$(document).on('click', '#update_cart', function() {
    $('#cartid_item').val($(this).data('cartid'))
    $('#barcode_item').val($(this).data('barcode'))
    $('#produk_item').val($(this).data('nama'))
    $('#stock_item').val($(this).data('stock'))
    $('#harga_item').val($(this).data('harga'))
    $('#jumlah_item').val($(this).data('jumlah'))
    $('#total_before').val($(this).data('harga') * $(this).data('jumlah'))
    $('#diskon_item').val($(this).data('diskon'));
    $('#total_item').val($(this).data('total'));
})

function count_edit_modal() {
    var harga = $('#harga_item').val()
    var jumlah =$('#jumlah_item').val()
    var diskon =$('#diskon_item').val()

    total_before = harga * jumlah
    $('#total_before').val(total_before)

    total = (harga - diskon) * jumlah
    $('#total_item').val(total)

    if(diskon == '') {
        $('#diskon_item').val(0)
    }

}

$(document).on('keyup mouseup', '#harga_item, #jumlah_item, #diskon_item', function() {
    count_edit_modal()
})

$(document).on('click', '#edit_cart', function() {
    var outcart_id = $('#cartid_item').val()
    var harga = $('#harga_item').val()
    var diskon = $('#diskon_item').val()
    var jumlah = $('#jumlah_item').val()
    var total = $('#total_item').val()
    var stock = $('#stock_item').val()
    if(harga == '' || harga < 1) {
        alert('Harga tidak boleh kosong')
        $('#harga_item').focus()
    } else if(jumlah == '' || jumlah < 1) {
        alert('Jumlah tidak boleh kosong')
        $('#jumlah_item').focus()
    } else if(parseInt(jumlah) > parseInt(stock)) {
        alert('Stock tidak mencukupi')
        $('#jumlah_item').focus()
    }   else {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_out/process')?>',
            data: {'edit_cart' : true, 'outcart_id' : outcart_id, 'harga' : harga,
                    'jumlah' : jumlah, 'diskon' : diskon, 'total' : total},
            dataType: 'json',
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_out/cart_data')?>', function() {
                        calculate()
                    })
                    $('#modal-item-edit').modal('hide');
                } else {
                    alert('Data item cart tidak terupdate')
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
    isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

    var discount = $('#discount').val()
    var grand_total = subtotal - discount
    if(isNaN(grand_total)) {
        $('#grand_total').val(0)
        $('#grand_total2').text(0)
    } else {
        $('#grand_total').val(grand_total)
        $('#grand_total2').text(grand_total)
    }

    var cash = $('#cash').val();
    cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0);

    if(discount == '') {
        $('#discount').val(0)
    }
}

$(document).ready(function() {
    calculate()
})

$(document).on('keyup mouseup', '#discount, #cash', function() {
    calculate()
})

//proses bayar
$(document).on('click', '#proses_bayar', function(){
    var customer_id = $('#customer').val()
    var subtotal = $('#sub_total').val()
    var discount = $('#discount').val()
    var grandtotal = $('#grand_total').val()
    var cash = $('#cash').val()
    var change = $('#change').val()
    var catatan = $('#catatan').val()
    var tanggal = $('#tanggal').val()
    if(subtotal < 1) {
        alert('Belum ada Produk yang dipilih')
        $('#barcode').focus()
    } else if(cash < 1) {
        alert('Jumlah kas masuk belum diinput')
        $('#cash').focus()
    } else {
        if(confirm('Yakin ingin proses transaksi ini?')) {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('transaksi_out/process')?>',
                data: {'proses_bayar': true, 'customer_id': customer_id, 'subtotal': subtotal, 
                        'discount': discount, 'grandtotal': grandtotal, 'cash': cash, 'change': change,
                        'catatan': catatan, 'tanggal': tanggal},
                dataType: 'json',
                success: function(result) {
                    if(result.success) {
                        alert('Transaksi berhasil');
                        window.open('<?=site_url('transaksi_out/cetak/')?>' + result.transout_id, '_blank');
                    } else {
                        alert('Transaksi gagal');
                    }
                    location.href='<?=site_url('transaksi_out')?>'
                }
            })
        }
    }
})

$(document).on('click', '#batal_bayar', function(){
    if(confirm('Apakah anda yakin dibatalkan?')) {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi_out/cart_del')?>',
            dataType: 'json',
            data: {'batal_bayar': true},
            success: function(result) {
                if(result.success == true) {
                    $('#cart_table').load('<?=site_url('transaksi_out/cart_data')?>', function(){
                        calculate()
                    })
                }
            }
        })
        $('#discount').val(0)
        $('#cash').val(0)
        $('#customer').val('').change()
        $('#barcode').val('')
        $('#barcode').focus()
    }
})


</script>