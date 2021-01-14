<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title> NiezCookies - Print Nota</title>
        <style type="text/css">
            html { font-family: "Verdana, Arial"; }
            .content {
                width: 80mm;
                font-size: 12px;
                padding: 5px;
            }
            .title {
                text-align: center;
                font-size: 13px;
                padding-bottom: 5px;
                border-bottom: 1px dashed;
            }
            .head {
                margin-top: 5px;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid;
            }
            .header {
                margin-top: 10px;
                padding-bottom: 5px;
                border-bottom: 1px solid;
            }
            table {
                margin-top:10px;
                width: 100%;
                font-size: 12px;
            }
            .thanks {
                margin-top: 10px;
                padding-top: 10px;
                text-align: center;
                border-top:1px dashed;
            }
            @media print {
                @page {
                    width: 80mm;
                    margin: 0mm;
                }
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="content">
            <div class="title">
                <b>NiezCookies</b>
                <br>
                Homemade Cake and Pastry
                <br>
                ig : niezcookies wa : 08970332313
                <br>
                Banjar Wijaya B22B No.23 Cipondoh Tangerang
            </div>

            <div class="head">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:150px">
                            <?php
                            echo Date("d/m/Y", strtotime($sale->tanggal))." ". Date("H:i", strtotime($sale->sale_created));
                            ?>
                        </td>
                        <td>Kasir</td>
                        <td style="text-align: center; width:10px">:</td>
                        <td style="text-align: right">
                            <?=ucfirst($sale->nama_user)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=$sale->invoice?>
                        </td>
                        <td>Pelanggan</td>
                        <td style="text-align: center">:</td>
                        <td style="text-align: right">
                            <?=$sale->customer_id == null ? "Umum" : $sale->nama_customer?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="header">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:100px">Nama</td>
                        <td>Jumlah</td>
                        <td style="text-align: right; width:60px">Harga</td>
                        <td style="text-align: right; width:80px">Total</td>
                    </tr>
                </table>
            </div>

            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                    <?php
                    $arr_discount = array();
                    foreach ($sale_detail as $key => $value) { ?>
                        <tr>
                            <td style="width:100px"><?=$value->nama?></td>
                            <td><?=$value->jumlah?></td>
                            <td style="text-align: right; width:60px"><?=indo_currency($value->harga)?></td>
                            <td style="text-align: right; width:80px">
                            <?=indo_currency(($value->harga - $value->diskon_item) * $value->jumlah)?></td>
                        </tr>

                    <?php
                    if ($value->diskon_item > 0) {
                        $arr_discount[] = $value->diskon_item;
                    }
                } 

                foreach ($arr_discount as $key => $value) { ?>
                    <tr>
                        <!-- <td></td> -->
                        <td colspan="2" style="text-align: right">Disc. <?=($key+1)?></td>
                        <td style="text-align: right"><?=indo_currency($value)?></td>
                    </tr>
                <?php
                } ?>

                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed; padding-top:5px"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:right; padding-top:5px">Sub Total</td>
                    <td style="text-align:right; padding-top:5px">
                        <?=indo_currency($sale->total_price)?>
                    </td>
                </tr>
                <?php if($sale->diskon > 0 ) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align:right; padding-bottom:5px">Disc. Sale</td>
                        <td style="text-align:right; padding-bottom:5px"><?=indo_currency($sale->diskon)?></td>
                    </tr>
                    <?php
                    } ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="border-top:1px dashed; text-align:right; padding:5px">Grand Total</td>
                        <td style="border-top:1px dashed; text-align:right; padding:0px"><?=indo_currency($sale->final_price)?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style="border-top:1px dashed; text-align:right; padding-top:5px">Cash</td>
                        <td style="border-top:1px dashed; text-align:right; padding-top:5px"><?=indo_currency($sale->cash)?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align:right">Kembali</td>
                        <td style="text-align:right"><?=indo_currency($sale->remain)?></td>
                    </tr>
                </table>
            </div>
            <div class="thanks">
                    --- SELAMAT MENIKMATI ---
                    <br>
                    @niezcookies
                    <br>
                    Alamat Pengiriman :
                    <br>
                    <td style="text-align: center">
                        <?=$sale->customer_id == null ? "Tidak ada data alamat" : $sale->alamat_customer?>
                    </td>
            </div>
        </div>
    </body>
</html>