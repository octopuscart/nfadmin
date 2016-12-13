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
            <div>
                <?php echo pdf_header; //defind into config/contants.php ?>
            </div>   
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;text-align: center;">
                <span class="capitalize">Site Promoters Report</span>
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;font-size: 10px" >
            <thead>
                <tr>

                    <th>S.No.</th>
                    <th>Sender User</th>
                    <th>Receiver User</th>
                    <th>Receiver Email</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    $res = $data[$i];
                    ?>
                    <tr>

                        <td><?php echo $i + 1 ?></td>
                        <td><?php echo $res['sender'] ?></td>
                        <td><?php echo $res['receiver'] ?></td>
                        <td><?php echo $res['receiver_email'] ?></td>
                        <td><?php echo $res['op_date_time'] ?></td>

                    </tr>


                <?php } ?>
            </tbody>
        </table>  

    </body>
</html>