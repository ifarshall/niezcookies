<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title> NiezCookies - Print Nota Bahan</title>
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
                margin-top: 15px;
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
                        <td style="width:100px">
                            <?php
                            echo Date("d/m/Y", strtotime($sale->tanggal))." ". Date("H:i", strtotime($sale->sale_created));
                            ?>
                        </td>
                        <td>Pengambil Bahan</td>
                        <td style="text-align: center; width:10px">:</td>
                        <td style="text-align: right">
                            <?=ucfirst($sale->nama_user)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=$sale->invoice?>
                        </td>
                        <td>Pembuat Produk</td>
                        <td style="text-align: center">:</td>
                        <td style="text-align: right">
                            <?=$sale->producer_id == null ? "Umum" : $sale->nama_producer?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="header">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:100px">Bahan</td>
                        <td>Jumlah</td>
                        <td style="text-align: right; width:60px">Harga</td>
                        <td style="text-align: right; width:60px">Total</td>
                    </tr>
                </table>
            </div>

            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                    <?php
                    foreach ($sale_detail as $key => $value) { ?>
                        <tr>
                            <td style="width:100px"><?=$value->nama?></td>
                            <td><?=$value->jumlah?></td>
                            <td style="text-align: right; width:60px"><?=indo_currency($value->harga)?></td>
                            <td style="text-align: right; width:60px">
                            <?=indo_currency($value->harga * $value->jumlah)?></td>
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
                </table>
            </div>
            <div class="thanks">
                    --- SELAMAT MENIKMATI ---
                    <br>
                    @niezcookies
            </div>
        </div>
    </body>
</html>