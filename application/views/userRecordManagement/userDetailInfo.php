<?php
$this->load->view('layout/layoutTop');
?>


<div class="panel panel-inverse" data-sortable-id="index-5"> 
    <div class="panel-heading">
        <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-user"></i> &nbsp;&nbsp;Client Detail
        <div class="btn-group btn-group-sm pull-right" >
                     <a class="btn btn-success"  data-toggle="" data-placement="left" title="View XLS"     href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record' ) ?>" ><i class="fa fa-arrow-left"></i> Back</a>
                </div>
        </h4>
    </div>
    <div class="panel-body">
        <h4 class="page-header" style="margin: 9px 0px 10px 0px;">
            <?php echo $profile[0]['first_name'] . ' ' . $profile[0]['middle_name'] . ' ' . $profile[0]['last_name']; ?>
            <small style="color:black">Client Code : <?php echo $profile[0]['registration_id']; ?></small>
        </h4>
    </div>
</div>


<div style="clear: both"></div>

<style>
    .nav.nav-tabs.nav-tabs-inverse>li>a, .nav.nav-tabs.nav-tabs-inverse>li>a:focus,  .tab-overflow .nav-tabs-inverse .next-button>a, .tab-overflow .nav-tabs-inverse .prev-button>a{
        color: white;
    }
</style>
<div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1" style="margin-top: 10px;">
    <div class="panel-heading p-0">
        <div class="panel-heading-btn m-r-10 m-t-10">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <!-- begin nav-tabs -->
        <div class="tab-overflow">
            <ul class="nav nav-tabs nav-tabs-inverse">
                <li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-success"><i class="fa fa-arrow-left"></i></a></li>
                <li class="active"><a href="#nav-tab-1" data-toggle="tab">Profile</a></li>
                <li class=""><a href="#nav-tab-2" data-toggle="tab">Address</a></li>
                <li class=""><a href="#nav-tab-3" data-toggle="tab">Order Summary</a></li>
                <li class=""><a href="#nav-tab-4" data-toggle="tab">Track Order</a></li>
                <li class=""><a href="#nav-tab-5" data-toggle="tab">All Invoices</a></li>
                <li class=""><a href="#nav-tab-6" data-toggle="tab">Payment History</a></li>
                <li class=""><a href="#nav-tab-7" data-toggle="tab">Preferences</a></li>
                <li class=""><a href="#nav-tab-8" data-toggle="tab">Cartlist</a></li>
                <li class=""><a href="#nav-tab-9" data-toggle="tab">Wishlist</a></li>
                <li class=""><a href="#nav-tab-10" data-toggle="tab">Status</a></li>


                <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-success"><i class="fa fa-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="nav-tab-1">
            <form method="post">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Client Code</label>
                            <div class="col-md-12">
                                <input type="hidden" name="user_id" value="<?php echo $profile[0]['id']; ?>">
                                <input type="text" class="form-control" disabled="" name="registration_id" value="<?php echo $profile[0]['registration_id']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">First Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" disabled="" name="first_name" value="<?php echo $profile[0]['first_name']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label"  style="margin-top: 10px;font-weight: 600;">Middle Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['middle_name']; ?>" disabled="" name="middle_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding: 0px;"">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Last Name/Surname</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['last_name']; ?>" disabled="" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Gender</label>
                            <div class="col-md-12">
                                <select class="form-control capitalize" name="gender" disabled="" >
                                    <option value="Male" <?php echo ($profile[0]['gender'] == "Male" ? "selected" : ""); ?> >Male</option>
                                    <option value="Female" <?php echo ($profile[0]['gender'] == 'Female' ? "selected" : ""); ?> >Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Telephone No.</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['telephone_no']; ?>" disabled="" name="contact_no">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Fax</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['fax_no']; ?>" disabled="" name="fax_no">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Email</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['email']; ?>" disabled="" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label" style="margin-top: 10px;font-weight: 600;">Contact No.</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $profile[0]['contact_no']; ?>" disabled="" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;" id="update_profile">
                    <button type="button" class="btn btn-primary btn-xs edit pull-right"><i class="fa fa-edit"></i> Edit</button>
                </div>
                <div style="clear: both"></div>
            </form>
        </div>
        <div class="tab-pane fade" id="nav-tab-2">
            <div class="col-md-6 ui-sortable">
                <div class="panel panel-default" data-sortable-id="index-1" style="border: 1px solid #EDEDED;">
                    <div class="panel-heading" style="background: rgb(237, 237, 237);padding: 4px 0px 4px 11px;">
                        <h4 class="panel-title"> <i class="fa fa-edit"></i> Shipping Addresses</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="padding: 0px;">
                            <table style="width: 100%;font-size: 12px;line-height: 2;">

                                <tr><td style="width: 20%">Address1</td><td style="width: 1%">:</td><td style="width: 79%">&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['address1'];
                                        }
                                        ?></td></tr>
                                <tr><td>Address2</td><td>:</td><td>&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['address2'];
                                        }
                                        ?></td></tr>
                                <tr><td>City</td><td>:</td><td>&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['city'];
                                        }
                                        ?></td></tr>
                                <tr><td>State</td><td>:</td><td>&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['state'];
                                        }
                                        ?></td></tr>
                                <tr><td>Country</td><td>:</td><td>&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['country'];
                                        }
                                        ?></td></tr>
                                <tr><td>Zip</td><td>:</td><td>&nbsp;&nbsp;<?php
                                        if ($shipping) {
                                            echo $shipping['zip'];
                                        }
                                        ?></td></tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--            <div class="col-md-6 ui-sortable">
                            <div class="panel panel-default" data-sortable-id="index-1" style="border: 1px solid #EDEDED;">
                                <div class="panel-heading" style="background: rgb(237, 237, 237);padding: 4px 0px 4px 11px;">
                                    <h4 class="panel-title"><i class="fa fa-edit"></i> Billing Addresses</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12" style="padding: 0px;">
                                        <table style="width: 100%;font-size: 12px;line-height: 2;">
                                            <tr><td style="width: 20%">Address1</td><td style="width: 1%">:</td><td style="width: 79%">&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['address1'];
            }
            ?></td></tr>
                                            <tr><td>Address2</td><td>:</td><td>&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['address2'];
            }
            ?></td></tr>
                                            <tr><td>City</td><td>:</td><td>&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['city'];
            }
            ?></td></tr>
                                            <tr><td>State</td><td>:</td><td>&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['state'];
            }
            ?></td></tr>
                                            <tr><td>Country</td><td>:</td><td>&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['country'];
            }
            ?></td></tr>
                                            <tr><td>Zip</td><td>:</td><td>&nbsp;&nbsp;<?php
            if ($billing) {
                echo $billing['zip'];
            }
            ?></td></tr>
            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <div class="col-md-12 ui-sortable">
                <div class="panel panel-default" data-sortable-id="index-1" style="border: 1px solid #EDEDED;">
                    <div class="panel-heading" style="background: rgb(237, 237, 237);padding: 4px 0px 4px 11px;">
                        <h4 class="panel-title"><i class="fa fa-edit"></i>Other Shipping Addresses</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Address1</th>
                                    <th>Address2</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Zip</th>

                                    <th style="width:9%"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($extraAddress) {
                                    $count = 1;
                                    foreach ($extraAddress as $key => $value) {
                                        echo '<tr>';
                                        echo '<td style="width:;">' . $count . '</td>';
                                        echo '<td>' . $value['address1'] . '</td>';
                                        echo '<td>' . $value['address2'] . '</td>';
                                        echo '<td>' . $value['city'] . '</td>';
                                        echo '<td>' . $value['state'] . '</td>';
                                        echo '<td>' . $value['country'] . '</td>';
                                        echo '<td>' . $value['zip'] . '</td>';

                                        echo '<td><a href="#modal-alert" onclick="edit_information(this)" data-toggle="modal"  class="btn btn-warning btn-xs" value="' . $value['id'] . '"><i class="fa fa-edit"></i></a></td>';
                                        echo '</tr>';
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-3">
            <div class="col-md-12">
                <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th style="width: 7%;">S. No.</th>
                            <th style="width: 12%;">Order No.</th>
                            <th style="width: 10%;">Date Time</th>
                            <th style="width: 10%;">Total Price</th>
                            <th style="width: 13%;text-align: center;">Status</th>
                            <th style="width: 10%;">View Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($invoiceData) {
                            $count = 1;
                            foreach ($invoiceData as $key => $value) {

                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['order_no'] . '</td>';
                                echo '<td>' . $value['op_date'] . ' ' . $value['op_time'] . '</td>';
                                echo '<td style="text-align:center;">$' . number_format(explode('$', $value['total_price'])[1], 2, '.', '') . '</td>';
                                echo '<td class="total_cost" style="text-align:center;">' . $value['title'] . '</td>';
                                echo '<td><a href="' . base_url('index.php/UserRecordManagement/update_order_status') . '/' . $value['order_id'] . '/' . $user_id . '" class="btn btn-info btn-xs">View Detail</a></td>';

                                echo '</tr>';
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-4">
            <div class="col-md-12" style="padding: 0px;">
                <table style="width: 100%;" class="table table-striped table-bordered dataTable">

                    <thead>
                        <tr>
                            <th style="width: 7%;">S. No.</th>
                            <th style="width: 12%;">Order No.</th>
                            <th>Invoice No.</th>
                            <th>Shipping Date</th>
                            <th>Total Weight</th>
                            <th>Sender Company</th>
                            <th>Destination Country</th>
                            <th>Tracking No.</th>
                            <th>Shipping Company</th>
                            <th>Date/Time</th>
                            <th>Delivery Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($trackingData) {
                            $count = 1;
                            foreach ($trackingData as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['order_no'] . '</td>';
                                echo '<td>' . $value['invoice_no'] . '</td>';
                                echo '<td>' . $value['shipping_date'] . '</td>';
                                echo '<td>' . $value['total_weight'] . ' ' . $value['weight_unit'] . '</td>';
                                echo '<td>' . $value['sender_company'] . '</td>';
                                echo '<td>' . $value['destination_country'] . '</td>';
                                echo '<td>' . $value['tracking_no'] . '</td>';
                                echo '<td>' . $value['shipping_company'] . '</td>';
                                echo '<td>' . $value['op_date_time'] . '</td>';
                                echo '<td>' . $value['status'] . '</td>';
                                echo '</tr>';
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-5">
            <div class="col-md-12">
                <table style="width: 100%;" class="table table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th style="width: 7%;">S. No.</th>
                            <th style="width: 12%;">Invoice Date/Time</th>
                            <th style="width: 11%;">Invoice No.</th>
                            <th style="width: 11%;">Order No.</th>
                            <th style="width: 10%;">Total Price</th>  
                            <th style="width: 5%;">View</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($invoiceData) {

                            for ($i = 0; $i < count($invoiceData); $i++) {
                                $value = $invoiceData[$i];
                                ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $value['op_date'] . ' ' . $value['op_time'] ?></td>
                                    <td><?php echo $value['invoice_no']; ?></td>
                                    <td><?php echo $value['order_no']; ?></td>
                                    <td class ="total_price" style="text-align:center;"><?php echo '$' . number_format(explode('$', $value['total_amount'])[1], 2, '.', '') ?></td>
                                    <td class="invoice-company">
                                        <a class="btn btn-info btn-xs"  data-toggle="" data-placement="left" title="View Pdf" style="" target="_blanck" href="<?php echo base_url() ?>../frontend/views/viewOrDownloadOrderPdf.php?order_id=<?php echo $value['order_id'] ?>&user_id=<?php echo $user_id ?>&option=I"  id ="num_to_word">View Detail
                                        </a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-6">
            <div class="col-md-12">
                <table class="table table-striped table-bordered dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width:10%;">S.No.</th>
                            <th style="width:25%">Date/Time</th>
                            <th style="width:10%">Invoice No.</th>
                            <th style="width:10%">Order No.</th>
                            <th style="width:10%">Payment Method</th>

                            <th style="width:10%">Tx./Card No.</th>
                            <th style="width:10%">Tx. Amt.</th>

                            <th style="width:10%">Status</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($paymentinfo); $i++) {
                            $dat = $paymentinfo[$i];
                            ?>
                            <tr style="font-size: 12px"> 
                                <td><?php echo $i + 1 ?></td>
                                <td><?php echo $dat['op_date'] ?><br/>
                                    <?php echo $dat['op_time'] ?></td>
                                <td><?php echo $dat['invoice_no'] ?></td>
                                <td><?php echo $dat['order_no'] ?></td>
                                <td>Card</td>

                                <td>
                                    <?php
                                    $dd = substr($dat['card_number'], -4);
                                    echo '************' . $dd;
                                    ?>

                                </td>

                                <td><?php echo '$' . number_format(explode('$', $dat['total_amount'])[1], 2, '.', '') ?></td>

                                <td><?php echo $dat['status'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-7">
            <div class="col-md-12">
                <div class="col-md-12" style="margin: 20px 0px 0px 0px;">
                    <p>Preferred Style/Measurement</p>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Item Type</th>
                                <th>Preferred Style</th>
                                <th>Preferred Measurement</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tagData = $this->Product_model->get_table_information('nfw_product_tag');
                            foreach ($tagData as $key => $value) {
                                ?>
                                <tr>

                                    <td><?php echo $value['tag_title'] ?></td>
                                    <td>
                                        <select name="" class="form-control">
                                            <?php
                                            $style = $this->User_model->find_style_id($value['id'], $user_id);
                                            for ($k = 0; $k < count($style); $k++) {
                                                $style_id = $style[$k];
                                                ?>
                                                <option><?php echo $style_id['style']; ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" class="form-control">
                                            <?php
                                            $style = $this->User_model->find_measurement_id($value['id'], $user_id);
                                            for ($k = 0; $k < count($style); $k++) {
                                                $style_id = $style[$k];
                                                ?>
                                                <option><?php echo $style_id['style']; ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>

                </div>
                <div style="clear:both"></div>
            </div>
            <!-- end -->
            <div style="clear:both"></div>


            <div class="col-md-12" style="margin-left: 17px;">
                <h3>Newletter Subscription Status</h3>
                <?php
                $tagData = $this->Product_model->get_table_information('nfw_news_letters_frequency', 'user_id', $user_id);

                if (count($tagData)) {
                    $nfcc = end($tagData)['frequency'];

                    echo "<h5>Status : Subscribed <small style='color:black;font-size:13px'>($nfcc)</small> </h5> ";
                } else {
                    $nlreason='';
                    $tagDataUn = $this->Product_model->get_table_information('nfw_news_letters_unsubscribe', 'user_id', $user_id);
                    if (count($tagDataUn)) {
                        $nlreason = end($tagDataUn)['reason'];
                    }
                    echo "<h5 >Status: <span style='color:red'> Unsubscribed</span></h5> <h5 style='    font-size: 12px;'>Reason: $nlreason</h5>";
                }
                ?>
            </div>

            <div style="clear: both"></div>

        </div>
        <div class="tab-pane fade" id="nav-tab-8">
            <div class="col-md-12" id="productCart">
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 7%;">S.No.</th> 
                            <th style="width: 9%;">Image</th>
                            <th style="width: 13%;">Item Code</th>
                            <th style="width: 13%;">SKU</th>
                            <th style="width: 29%;">Item Feature</th>
                            <th style="width: 10%;">Qty.</th>
<!--                            <th style="width: 10%;">Color (Hex)</th>-->

                            <th style="width: 9%;">Price</th>

                        </tr>
                    </thead>
                    <tbody id="productCartId">

                    </tbody>
                </table>    
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-9">
            <div class="col-md-12" id="wishlist">
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 7%;">S.No.</th>
                            <th style="width: 9%;">Image</th> 
                            <th style="width: 13%;">Item Code</th>
                            <th style="width: 13%;">SKU</th>
                            <th style="width: 29%;">Item Feature</th>
                            <th style="width: 10%;">Qty.</th>
<!--                            <th style="width: 10%;">Color (Hex)</th>-->

                            <th style="width: 9%;">Price</th>

                        </tr>
                    </thead>
                    <tbody id="wishlistBodyId">

                    </tbody>
                </table>  
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="tab-pane fade" id="nav-tab-10">
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <input type="hidden" name="user_id" value="<?php echo $profile[0]['id']; ?>">
                         
                                <select class="form-control" name="status">
                                    
                                    <option value="Active" <?php echo ($profile[0]['status'] == "Active" ? "selected" : ""); ?> >Active</option>
                                    <option value="Inactive" <?php echo ($profile[0]['status'] == 'Inactive' ? "selected" : ""); ?> >Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status Remark</label>
                            <div class="col-md-9">
                                <textarea class="form-control" placeholder="Textarea" rows="5" required="required" name="remark"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="col-md-8">
                        <button class="btn btn-primary btn-xs pull-right" name="updateStatus" style="margin-right: 14px;margin-top: 15px;">Update</button>
                    </div>
                </div>
            </form>
            <div style="clear: both"></div>
        </div>





    </div>
</div>
<!---=========Model open===============---->
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Address Information</h4>
            </div>
            <form method="post">
                <div class="modal-body panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address1</label>
                            <div class="col-md-9">
                                <input type="text" name="address1" class="form-control" >
                                <input type="hidden" name="id">
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address2</label>
                            <div class="col-md-9">
                                <input type="text" name="address2" class="form-control" >
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-9">
                                <input type="text" name="city" class="form-control" >
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-9">
                                <input type="text" name="state" class="form-control" >
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country</label>
                            <div class="col-md-9">
                                <input type="text" name="country" class="form-control" >
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Zip</label>
                            <div class="col-md-9">
                                <input type="text" name="zip" class="form-control" >
                            </div>
                        </div>
                    </div> 

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-sm btn-info" name="updateAddress" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end #content -->  
<!--=========Model close===============---->
<?php
$this->load->view('layout/layoutBottom');
?>
<?php
$this->load->view('layout/layoutFooter');
?>
<script>
    $(function () {

        $(".total_price").each(function (i) {
            var num1 = $(this).text();
            var num2 = num1.split('$')[1];
            console.log(num2);
            var val = toWords(num2);
            var href = $($('.invoice-company a')[i]).attr('href');
            var href1 = href + '&number1=' + val;
            $($('.invoice-company a')[i]).attr('href', href1)

        })

//        var num1 = $("#total_price").text();
//        console.log(num1);
//        var num2 = num1.split('$')[1];
//        console.log(num2);
//        var val = toWords(num2);
//        var href = $('.invoice-company a').attr('href');
//        var href1 = href + '&number1=' + val;
//        $('.invoice-company a').attr('href', href1)
    });
</script>
<script>
    $('.edit').click(function () {
        $('input[type=text]').removeAttr('disabled');
        $('select').removeAttr('disabled');
        $('#update_profile').html('<button class="btn btn-primary btn-xs pull-right" name="updateProfile">Update</button>');
    })
    $(function () {

        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>../frontend/views/ajaxController.php?checkCart=nfw_product_cart&user_id=<?php echo $user_id; ?>",
                        dataType: 'json',
                        success: function (data) {
                            var htmls = '';
                            for (var i in data) {
                                var count = +i + 1;
                                htmls += '<tr>';
                                htmls += '<td>' + count + '</td>';
                                htmls += '<td><img style="height: 35px;width: 40px;" src="' + data[i]['image'] + '" /></td>';
                                htmls += '<td>' + data[i]['title'] + '</td>';
                                htmls += '<td>' + data[i]['sku'] + '</td>';
                                htmls += '<td class="capitalize">' + data[i]['product_speciality'] + '</td>';

                                htmls += '<td>' + data[i]['quantity'] + '</td>';
//                                htmls += '<td>' + data[i]['color_code'] + '</td>';

                                htmls += '<td>' + '$' + data[i]['price'] + '</td>';

                                htmls += '</tr>';
                            }
                            console.log(htmls);
                            $('#productCartId').html(htmls);
                            $('#productCart table').DataTable();
                        }
                    });

                    // wishlist 
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>../frontend/views/ajaxController.php?checkCart=nfw_product_wishlist&user_id=<?php echo $user_id; ?>",
                                    dataType: 'json',
                                    success: function (data) {
                                        var htmls = '';
                                        for (var i in data) {
                                            var count = +i + 1;
                                            htmls += '<tr>';
                                            htmls += '<td>' + count + '</td>';
                                            htmls += '<td><img style="height: 35px;width: 40px;" src="' + data[i]['image'] + '" /></td>';
                                            htmls += '<td>' + data[i]['title'] + '</td>';
                                            htmls += '<td>' + data[i]['sku'] + '</td>';
                                            htmls += '<td class="capitalize">' + data[i]['product_speciality'] + '</td>';
                                            htmls += '<td>' + data[i]['quantity'] + '</td>';
//                                            htmls += '<td>' + data[i]['color_code'] + '</td>';

                                            htmls += '<td>' + '$' + Number(data[i]['price']).toFixed(2) + '</td>';

                                            htmls += '</tr>';
                                        }

                                        $('#wishlistBodyId').html(htmls);
                                        $('#wishlist table').DataTable();
                                    }
                                });
                            });
                            function delete_information(obj) {
                                var id = obj.id;
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_delete'); ?>",
                                    data: {'id': id, column_name: 'id', 'table_name': 'nfw_billing_shipping_address'},
                                    success: function (data) {
                                        window.location.reload();
                                    }
                                })
                            }
                            function edit_information(obj) {
                                var editId = $(obj).attr('value');
                                var id = $.trim(editId);
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_edit'); ?>",
                                    data: {'id': id, 'table_name': 'nfw_billing_shipping_address', 'column_name': 'id'},
                                    dataType: 'json',
                                    success: function (data)
                                    {
                                        console.log(data);
                                        var jsonData = data;
                                        for (key in jsonData) {

                                            var val = jsonData[key];
                                            $('[name=' + key + ']').val(val);

                                        }
                                    }

                                });
                            }

</script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
                            $(document).ready(function () {
                                App.init();
                                TableManageDefault.init();
                                $('#nav-tab-3 table').DataTable();
                                $('#nav-tab-4 table').DataTable();
                                $('#nav-tab-5 table').DataTable();
                                $('#nav-tab-6 table').DataTable();
                            });
</script>

<script>
    $(document).ready(function () {
        var customers = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('client_code'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "<?php echo base_url('index.php/UserRecordManagement/search_user_information'); ?>?searchText=%QUERY%",
                wildcard: '%QUERY%'
            }
        });


        customers.initialize(); // customer mobile search init


        /////////////////// Search Customer type ahead ////////////////////////////////////
        $('#searchUser').typeahead({highlight: true},
        {
            name: 'customers',
            displayKey: 'client_code',
            limit: 8,
            source: customers.ttAdapter(),
            templates: {
                header: '<b class="typeaheadgroup text-primary"><i class="fa fa-search"></i>&nbsp;User Information</b>',
            },
        }).bind('typeahead:selected', function (obj, datum) {
            console.log(datum);
            var userId = datum.id;
            var link = '<?php echo base_url('index.php/UserRecordManagement/user_detail_info/'); ?>' + '/' + userId;
            window.open(link, "_self");
        });

    });
</script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets_main/plugins/toword/toword.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>
