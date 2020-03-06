
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif">


    <tbody style="font-size:10px">
        <tr>
            <td colspan="2" style="    font-size: 12px;background: #f5f5f5;">
                Items List
            </td>
            <td colspan="1" style="    font-size: 12px;background: #f5f5f5;">
                Quantity : <?php echo $orderDetails['total_quantity']; ?>
            </td>
        </tr>



        <tr class="invoiceTd" >
            <td  rowspan="5" style="width:65px;" class="invoiceTd colspan"> 
                <img src="<?php echo $cvalue['item_image']; ?>" height="50px" width="50px">
            </td>
        </tr>  

        <tr class="invoiceTd" style="text-align:left">
            <th class="invoiceTd"  style="text-align:left">Item Name</th> <td class="invoiceTd" >  <?php echo $cvalue['title']; ?></td>

            <td style='width: 300px;text-align: center' rowspan="4">
                SWATCHES 
            </td>
        </tr>


        <tr style="text-align:left">
            <th class="invoiceTd"  style="text-align:left">Item Code/SKU</th> <td class="invoiceTd" >  <?php echo $cvalue['title']; ?></td>
        </tr>

        <tr class="invoiceTd" >
            <th class="invoiceTd"  style="text-align:left">Item Feature</th> <td class="invoiceTd" > <?php echo $cvalue['product_speciality']; ?></td>
        </tr>
        <tr class="invoiceTd" >
            <th class="invoiceTd"  style="text-align:left">Quantity</th> <td class="invoiceTd" > <?php echo $cvalue['quantity']; ?></td>
        </tr>
        <tr style="    background-color: #C0C0C0;">
            <td></td>
            <td></td>
            <td></td>
        </tr>




    </tbody>  
</table> 
<div style="background:#F5F5F5;width:100%;;font-family:sans-serif;margin-top:5px;font-size:12px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center;font-size:15px;">
      
        Style Details: <?php echo ($cvalue['customization_data']); ?>
    </div>
</div> 

<!-- table description -->

<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif">

    <thead>
        <tr class="invoiceTr" style="text-align: left" >
            <th class="invoiceTd colspan" style="width:50%;text-align: left">Style Field</th>
            <th class="invoiceTd colspan" style="text-align: left">Value</th>
        </tr>
    </thead>
    <tbody style="font-size:10px">

        <?php
        $customizId = $cvalue['customization_id'];
        if (($customizId > 0)) {
            foreach ($cvalue['customdata']['style'] as $key => $value) {
                ?>
        

                <?php
                if ($key == 'Wrist Watch') {
                    $wrist_watch = $value;
                }
                ?>
                <tr class="">
                    <td class="invoiceTd"><?php echo $key; ?></td>
                    <td class="invoiceTd"><?php echo $value; ?></td>
                </tr>

            <?php
            }
        }
        else{
              echo "<tr><td colspan=2 style='text-align:center'>Shop Stored</td></tr>";
        }
        ?>

    </tbody>  
</table>  

<!-- Measurement ##################################################################### -->

<div style="background:#F5F5F5;width:100%;height:1%;font-family:sans-serif;margin-top:10px;font-size:12px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center;font-size:15px;">
        Measurement Details
    </div>
</div> 

<!-- table description -->
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
    <input type="hidden" name="trLength" value="1" id="trlength"/>
    <thead>
        <tr class="invoiceTr" style="text-align: left">
            <th class="invoiceTd colspan" style="width:40%;text-align: left" colspan="2">Measurement Field</th>
            <th class="invoiceTd colspan" style="width: 25%;text-align: left;border-left: none;">Value</th>

            <th class="invoiceTd colspan" style="width: 17.5%;text-align: left;border-left: none;">Allowance</th>
            <th class="invoiceTd colspan" style="width: 17.5%;text-align: left;border-left: none;"> Final Size <br/>
                <small style="font-size: 8px">(Measurement + Allowance)</small>
            </th>
        </tr>
    </thead>
    <tbody >
        <?php
        $measurement_id = $cvalue['measurement_id'];
        if (($measurement_id > 0) && isset($cvalue['measurements'])) {
            foreach ($cvalue['measurements']['meausrements'] as $key => $value) {
                ?>

                <tr  class="" style="width:5%">
                    <td  class="invoiceTd" style='border-right: none;'>
                        <?php
                        echo $key;
                        ?>
                    </td>

                    <td class="invoiceTd" style="border-left: none;">
                        <?php
                        echo "<span style='font-family: Sun-ExtA ;font-size: 15px;'>" . $lng_array[$key] . "</span>";
                        ?>
                    </td>
                    <td class="invoiceTd"><?php echo $value; ?></td>
                    <td class="invoiceTd"></td>
                    <td class="invoiceTd"></td>
                </tr>



                <?php
            }
        } else {
            echo "<tr><td colspan=5 style='text-align:center'>Shop Stored</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php
switch ($item_id) {
    case '1':
        ?>
        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <tbody>
                <tr  class="" style="background:#F5F5F5;">
                    <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                </tr>
                <tr  class="" >
                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Wrist Watch 
                        <br/>

                        <br/>
        <?php echo $wrist_watch; ?>
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Armhole 
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Left)
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Right) 
                    </td>
                    <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                    </td>

                </tr> 
            </tbody>
        </table>



        <?php
        break;
    case '7':
        ?>

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <tbody>
                <tr  class="" style="background:#F5F5F5;">
                    <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                </tr>
                <tr  class="" >
                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Wrist Watch 
                        <br/>
        <?php echo $wrist_watch; ?>
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Armhole 
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Left)
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Right) 
                    </td>
                    <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                    </td>

                </tr> 
            </tbody>
        </table>

        <?php
        break;
    default:
        $armhome = array('5', '10', '11', '12', '13', '14', '15');
        if (in_array($item_id, $armhome)) {
            ?>
            <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
                <tbody>
                    <tr  class="" style="background:#F5F5F5;">
                        <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                    </tr>
                    <tr  class="" >
                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                            Armhole  
                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>
                        <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                    </tr> 
                </tbody>
            </table>
            <?php
        }
}
?>


</tbody>  
</table>  
</div>
<!-- Measurement  ##################################################################### -->

<div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:10px;font-size:15px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center">
        Posture Details
    </div>
</div> 

<!-- table description -->
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
    <input type="hidden" name="trLength" value="1" id="trlength"/>

    <tbody>
        <tr style="text-align:center;font-size: 12px;">
            <?php
            $posturearray = [];

            if (($measurement_id > 0) && isset($cvalue['measurements']['posture'])) {

                foreach ($cvalue['measurements']['posture'] as $key => $value) {
                    $ky = $key;
                    $vl = $value;
                    $posimg = $this->User_model->posture_image($ky, $vl)[0];
                    ?>
                    <td style='vertical-align: top;text-align:center;padding-top: 5px;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        <span ><?php echo $ky; ?></span>

                        <br/> 
                        <?php
                        if ((count($posimg))) {
                            ?>
                            <img src="<?php echo $posimg['image']; ?>" style="height:100px;witdh:100px;margin-top: 10px">
        <?php } ?>
                        <br/>
                        <span ><?php echo $vl; ?></span>
                    </td>
                    <?php
                }
            }
            ?>
        </tr>
    </tbody>

<!--                <thead>
    <tr class="invoiceTr" style="text-align: left">
        <th class="invoiceTd colspan" style="width:50%;text-align: left">Measurement Field</th>
        <th class="invoiceTd colspan" style="text-align: left">Value</th>
    </tr>
</thead>
<tbody >
    <?php
    foreach ($tag_data[$i]['posture'] as $key => $value) {
        ?>

                                                                                            <tr  class="" style="width:5%">
    <?php $posimg = $this->User_model->posture_image($key, $value)[0]; ?>
                                                                                                <td  class="invoiceTd"><?php echo $key; ?></td>
                                                                                                <td class="invoiceTd" style="padding-top: 10px;">
                                                                                                    <span ><?php echo $value; ?></span>
                                                                                                    <br/> 
                                                                                                    <img src="<?php echo $posimg['image']; ?>" style="height:100px;witdh:100px;margin-top: 10px">
                                                                                                </td>
                                                                                            </tr>

<?php } ?>
</tbody>  -->
</table>  




</div>



<!--        <PageBreak>-->