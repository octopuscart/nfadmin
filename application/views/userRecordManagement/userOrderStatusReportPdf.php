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
         <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;text-align: center">
            <?php print_r($name[0]['tag_title'])?> Item Code Report
            </div>
        </div> 

        <!-- table description -->

            <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >

            <thead>
                <tr class="invoiceTr">
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 7%;"><b>S.No.</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 15%;"><b>Title</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 12%;"><b>Product Speciality</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 17%;"><b>Description</b></td>
                    <td class="invoiceTd colspan" style="font-size: 14px;width: 10%;"><b>Price</b></td>
               </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                if ($result) {
                    foreach ($result as $key => $value) {
                        ?>
                        <tr  class="invoiceTd">

                            <td class="invoiceTd" style="font-size: 12px;text-align:right"><?php echo $count ?></td>
                            <td class="invoiceTd capitalize" style="font-size: 12px;text-align:left"><?php echo $value['title']; ?></td>
                            <td class="invoiceTd" style="font-size: 12px;"><?php echo $value['product_speciality']; ?></td>
                            <td class="invoiceTd" style="font-size: 12px;"><?php echo $value['short_description']; ?></td>
                            <td class="invoiceTd" style="font-size: 12px;text-align:right"><?php echo '$'.$value['price']; ?></td>
                           
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