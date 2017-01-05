<html>
    <head>

        <style type="text/css">
            .invoiceTable,.invoiceTr,.invoiceTd{
                border: 1px solid rgb(157, 153, 150);
                border-collapse: collapse;
            }
            .invoiceTr,.invoiceTd{
                padding: 7px;
            }
            .price_table{
                width:140px;
                font-size: 12px;
            }
            .pricefirst{
                width:100px;
            }

            .product_detail{
                font-size: 12px;
            }
            .product_detail th{
                text-align: right;

            }

        </style>

    </head>
    <body >

        <div>
             <?php 
            echo pdf_header;
            ?>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;text-align: center">
                Product Report
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >

            <thead>
                <tr class="invoiceTr">
                <td class="invoiceTd colspan" style="font-size: 12px;width:20px;text-align: left"><b>S.No.</b></td>
                <td class="invoiceTd colspan" style="font-size: 12px;width:15px;text-align: left"><b>Image</b></td>
                <td class="invoiceTd colspan" style="font-size: 12px;width:200px;text-align: left"><b>Item Information</b></td>

                <td class="invoiceTd colspan" style="font-size: 12px;width:15px;text-align: left"><b>Item Price/Sale Price</b></td> 
                <td class="invoiceTd colspan" style="font-size: 12px;width:40px;text-align: left"><b>Status</b></td> 


                </tr>
            </thead>
            <tbody>
                <?php
                if ($product_list) {
                    $count = 1;
                    foreach ($product_list as $key => $value) {
                        echo '<tr  class="invoiceTd">';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:right">' . $count . '</td>';


                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['image'] . '</td>';
                        ?>
                        <td class="invoiceTd" style="font-size: 12px;text-align:left">
                            <table class="product_detail">
                                <tr>
                                <th>Item Code:</th>
                                <td><?php echo $value['title']; ?></td>
                                </tr>
                                <tr>
                                <th>SKU:</th>
                                <td><?php echo $value['sku']; ?></td>
                                </tr>
                                <tr>
                                <th>Feature:</th>
                                <td><?php echo $value['product_speciality']; ?></td>
                                </tr>
                                <tr>
                                <th>Category:</th>
                                <td><?php echo $value['category']; ?></td>
                                </tr>
                            </table> 
                        </td>
                     

                        <?php
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['tag_price'] . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['publishing'] . '</td>';
                        echo '</tr>';
                        $count++;
                    }
                }
                ?> 
        </table>  
    </div>
</div>
</body>
</html>