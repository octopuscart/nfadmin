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
            <?php
            echo pdf_header;
            ?>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align: center">
                Client Login Report
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >

            <thead>
                <tr class="invoiceTr">
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 7%;text-align: center"><b>S.No.</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 12%;text-align: center"><b>Time Stamp</b></td> 
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 18%;text-align: center"><b>Client Ip</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 14%;text-align: center"><b>Client Name</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 20%;text-align: center"><b>Description</b></td>

                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                if ($loginRecord) {
                    foreach ($loginRecord as $key => $value) {
                        ?>
                        <tr  class="invoiceTd"> 

                            <td class="invoiceTd" style="font-size: 12px;text-align:right"><?php echo $count ?></td>
                            <td class="invoiceTd " style="font-size: 12px;text-align:left"><?php echo $value['time_stamp'] ?></td>
                            <td class="invoiceTd " style="font-size: 12px;text-align:left"><?php echo $value['client_ip']; ?></td>
                            <td class="invoiceTd capitalize" style="font-size: 12px;text-align:left"><?php echo $value['first_name'] ?></td>
                            <td class="invoiceTd capitalize" style="font-size: 12px;text-align:left"><?php echo substr($value['description'], 0, 150); ?></td>

                        </tr>


                        <?php
                        $count++;
                    }
                }
                ?> 
        </table>  
    </div>
</div>
</body>
</html>