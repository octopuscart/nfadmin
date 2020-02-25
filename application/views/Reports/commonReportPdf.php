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
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;text-align: center">
                Report for <?php echo $client; ?> 
            </div> 
            <div style="padding:10px;text-align: center">
                <?php echo $title; ?> Report
            </div> 
            <div style="font-size: 12px;text-align: center">
                From <?php echo $daterange; ?>
            </div>
        </div> 
        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >

            <thead>

                <tr class="invoiceTr">
                    <td class="invoiceTd colspan" style="font-size: 14px;width:10px;text-align: left"><b>S.No.</b></td>
                    <?php
                    $tab_table_head = $heads;
                    foreach ($tab_table_head as $key1 => $value1) {
                        ?>
                        <td class="invoiceTd colspan" style="font-size: 12px;width:10px;text-align: left"><b><?php echo $value1 ?></b></td>
                    <?php }
                    ?>
                </tr>
            </thead>
            <tbody>

                <?php
                $count = 0;
                foreach ($data as $key1 => $value1) {
                    ?>
                    <tr class="invoiceTd">
                        <?php
                        $count ++;
                        echo '<td class="invoiceTd" style="font-size: 12px;text-align:right">' . $count . '</td>';
                        foreach ($tab_table_head as $key => $value) {
                            ?>

                            <td  class="invoiceTd" style="font-size: 12px;text-align:    <?php echo is_numeric($value1[$key]) ? 'right' : 'left'; ?>"><?php echo $value1[$key]; ?></td>

    <?php } ?>

                    </tr>   
<?php } ?>


            </tbody>
        </table>

    </div>
</div>
</body>
</html>