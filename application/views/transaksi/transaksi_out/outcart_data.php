<?php $no = 1;
if($cart->num_rows()>0) {
    foreach ($cart->result() as $c => $data) { ?>
    <tr>
        <td><?=$no++?>.</td>
        <td class="barcode"><?=$data->barcode?></td>
        <td><?=$data->nama_produk?></td>
        <td class="text-right"><?=indo_currency($data->harga_cart)?></td>
        <td class="text-center"><?=$data->jumlah?></td>
        <td class="text-right"><?=$data->diskon_item?></td>
        <td class="text-right" id="total"><?=$data->total?></td>
        <td class="text-center" width="160px">
            <button id="update_cart" data-toggle="modal" data-target="#modal-item-edit"
            data-cartid="<?=$data->outcart_id?>"
            data-barcode="<?=$data->barcode?>"
            data-nama="<?=$data->nama_produk?>"
            data-stock="<?=$data->stock?>"
            data-harga="<?=$data->harga?>"
            data-jumlah="<?=$data->jumlah?>"
            data-diskon="<?=$data->diskon_item?>"
            data-total="<?=$data->total?>"
            class="btn btn-xs btn-primary">
                <i class="fa fa-pencil"></i> Ubah
            </button>
            <button id="del_cart" data-cartid="<?=$data->outcart_id?>" class="btn btn-xs btn-danger">
                <i class="fa fa-trash"></i> Hapus
            </button>
        </td>
    </tr>
    <?php
    }
} else {
    echo '<tr>
    <td colspan="8" class="text-center">Tidak ada Produk dipilih</td>
    </tr>';
} ?>