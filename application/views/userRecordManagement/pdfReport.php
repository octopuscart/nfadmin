<html>
    <head>

        <style type="text/css">
            table,tr,td, th{
                border: 1px solid rgb(157, 153, 150);
                border-collapse: collapse;
                padding: 5px;
                text-align: left;
            }
            .invoiceTr,.invoiceTd{
                padding: 7px;
            }
            .custom_table{
                width: 100%;
                border: 0px solid #D0D0D0!important;
            }
            .custom_table tr{
                border: 0px solid #D0D0D0!important;
                border-bottom: 1px solid #D0D0D0!important;
            }


            .csku{
                width:100px;
                text-align: left!important;
                border: 0px solid #D0D0D0!important;


            }
            .citem{
                width: 50%;
                padding: 0px;
                text-align: left!important;
                border: 0px solid #D0D0D0!important;

            }
            .ctotal{
                width: 10%;
                text-align: right!important;
                border: 0px solid #D0D0D0!important;

            }
            .rightalign{
                text-align: right!important;
            }
        </style>

    </head>
    <body >

        <div>
            <?php echo pdf_header; //defind into config/contants.php ?>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;text-align: center;">
                <span class="capitalize"> Order Reports from <?php echo $date1 ?></span>
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;font-size: 10px" >



            <thead>
                <tr>
                    <th style="width: 5%;">S.No.</th>
                    <th style="width: 10%;">Date/Time</th>
                    <th style="width: 16%;">Client</th>
                    <th style="width: 10%;">Order No./<br/>Invoice No.</th>
                    <th style="width: 30%;padding: 0px">
            <table class="custom_table">
                <tr><th class="csku">SKU</th><th class="citem">Item Name</th><th class="ctotal">Q.</th></tr>
            </table>
        </th>
        <th style="width: 5%;">Qty.</th> 
        <th style="width: 10%;">Price</th>

        <th style="width: 10%;">Status</th>

    </tr>
</thead>
<tbody>
    <?php
    $count = 1;
    $totalq = 0;
    $totalg = 0;
    if ($orderHistory) {
        foreach ($orderHistory as $key => $value) {
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td>' . $value['op_date'] . ' ' . $value['op_time'] . '</td>';

            $user_info = $this->User_model->phpjsonstyle($value['user_info'], 'php');



            echo '<td class="capitalize">' . $user_info['first_name'] . '  ' . $user_info['last_name'] . '<br/>(' . $user_info['registration_id'] . ')<br/>M:' . $user_info['contact_no'] . '</td>';
            echo '<td>' . $value['order_no'] . '/<br/>' . $value['invoice_no'] . '</td>';

            $skudata = $this->User_model->xls_report_data($value['order_id']);

            $temp2 = [];
            if (count($skudata)) {
                foreach ($skudata as $s => $value1) {
                    $v1 = "<td class='csku'>" . $value1['sku'] . '</td><td class="citem">' . $value1['item_name'] . '</td><td class="cprice">' . $value1['quantity'] . "</td>";
                    array_push($temp2, $v1);
                }
            }

            echo '<td style="padding:0px"><table class="custom_table"><tr>' . implode("</tr><tr>", $temp2) . '</tr></table></td>';
            $totalq += $value['total_quantity'];
            $totalg += explode('$', $value['total_price'])[1];
            echo '<td>' . $value['total_quantity'] . '</td>';
            echo '<td>$' . number_format(explode('$', $value['total_price'])[1], 2, '.', '') . '</td>';
            echo '<td>' . $value['title'] . '<br/>' . $value['status_date'] . '</td>';
            echo "</tr>";
            $count++;
        }
    }
    ?> 

    <tr>
        <th colspan="5" class="rightalign">Total</th>
        <th class="rightalign"><?php echo $totalq; ?></th>
        <th class="rightalign">$<?php echo number_format($totalg, 2, '.', ''); ?></th>
        <th colspan="1"></th>
    </tr>
</tbody>

</table>  
</div>
</div>
</body>
</html>