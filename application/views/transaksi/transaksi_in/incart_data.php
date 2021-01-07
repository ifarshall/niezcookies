<?php $no = 1;
if($cart->num_rows()>0) {
    foreach ($cart->result() as $c => $data) { ?>
    <tr>
        <td><?=$no++?>.</td>
        <td class="nama"><?=$data->nama_bahan?></td>
        <td class="text-right"><?=$data->harga_cart?></td>
        <td class="text-center"><?=$data->jumlah?></td>
        <td class="text-right" id="total"><?=$data->total?></td>
        <td class="text-center" width="160px">
            <button id="del_cart" data-cartid="<?=$data->incart_id?>" class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php
    }
} else {
    echo '<tr>
    <td colspan="8" class="text-center">Tidak ada bahan dipilih</td>
    </tr>';
} ?>