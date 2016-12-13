<html>
    <head>

        <style type="text/css">
            table,tr,td, th{
                border: 1px solid rgb(157, 153, 150);
                border-collapse: collapse;
            }
            tr,td{
                padding: 7px;
            }

        </style>

    </head>
    <body >
        <div class="col-md-12">
            <?php
            echo pdf_header;
            ?>
           <br>
            <div class="panel panel-inverse" data-sortable-id="index-5">
                <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:5px;font-size:16px;border:1px solid rgb(157, 153, 150);">
                    <div style="padding:10px;text-align: center;">
                        <span class="capitalize">Customers Report</span>
                    </div>
                </div> 
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">    
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 7%;">S.No.</th>
                                        <th>Client Code</th>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th style="width: 120px">Birth Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    if ($userProfile) {
                                        foreach ($userProfile as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $count ?> </td>
                                                <td class="capitalize"><?php echo $value['registration_id'] ?> </td>
                                                <td class="capitalize"><?php echo $value['first_name'] . ' ' . $value['middle_name'] . ' ' . $value['last_name'] ?> </td>
                                                <td><?php echo $value['email'] ?> </td>
                                                <td><?php echo $value['contact_no'] ?> </td>
                                                <td><?php echo $value['birth_date'] ?> </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>                          
                </div>
            </div>
        </div>

    </body>
</html>