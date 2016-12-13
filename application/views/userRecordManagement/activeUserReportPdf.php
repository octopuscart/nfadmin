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

        </style>

    </head>
    <body >

        <div>
            <div>
                <?php echo pdf_header; //defind into config/contants.php ?>
            </div>   
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align: center">
                Active User Report
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >

            <thead>
                <tr class="invoiceTr">
                    <td class="invoiceTd colspan" style="font-size: 14px;width:10px;text-align: center"><b>S.No.</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width:15px;text-align: center"><b>User Name</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width:15px;text-align: center"><b>Title</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width:15px;text-align: center"><b>SKU</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width:15px;text-align: center"><b>Image</b></td> 
                    <td class="invoiceTd colspan" style="font-size: 14px;width:5px;text-align: center"><b>Frequency</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width:18px;text-align: center"><b>Short Description</b></td>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($activeUser) {
                    $count = 1;
                    foreach ($activeUser as $key => $value) {
                        echo '<tr  class="invoiceTd">';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:right">' . $count . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left" style="text-transform: capitalize;">' . $value['user_name'] . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['title'] . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['sku'] . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:center"><img src="http://nf1.costcokart.com/nfw/small/' . $value['image'] . '" style="width:40px;height: 40px;"></td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:right">' . $value['quantity'] . '</td>';
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:left">' . $value['short_description'] . '</td>';
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