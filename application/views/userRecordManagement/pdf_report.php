<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <title>Shipping Invoice</title>
        <style type="text/css">
            .invoiceTable,.invoiceTr,.invoiceTd{
                border: 1px solid black;
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
        <div style="width:150px;align:center; margin-left:250px;">
            <div style="text-align: center;margin-bottom: 0px;padding-left: 0px;padding-top: 0px;"> 
                <span style="font-family: sans-serif;font-size:15px;padding:5px;background:rgb(245, 245,245);">
                    <span>INVOICE</span>
                </span>
            </div>
        </div>


        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align: center">
                Order Description
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr class="invoiceTr" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >


                    <th class="invoiceTd colspan" style="width:9%;text-align: left">SKU</th>
                    <th class="invoiceTd colspan" style="width:14%;text-align: left">Item Code</th>
                    <th class="invoiceTd colspan" style="width:15%;text-align: left">Item Image</th>
                    <th class="invoiceTd colspan" style="width:15%;text-align: left">Item Name</th>
                    <th class="invoiceTd colspan" style="width:31%;text-align: center">Style Id/Measurement Profile</th>
                    <th class="invoiceTd colspan" style="width:6%;text-align: left">Qty</th>
                    <th class="invoiceTd colspan" style="width:8%;text-align: left">Price</th>
                    <th class="invoiceTd colspan" style="width:11%;text-align: left">Extra Price</th>
                    <th class="invoiceTd colspan" style="width:11%;text-align: left">Total Price</th>

                </tr>
                <?php for ($i = 0; $i < 10; $i++) { ?>
                    <tr  class="invoiceTr" >
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>
                        <td class="invoiceTd colspan"><?php echo $i; ?></td>

                    </tr>
                <?php } ?>

        </table>  
    </div>
</div>



</body>
</html>