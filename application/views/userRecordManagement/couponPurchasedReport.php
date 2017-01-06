<?php
$this->load->view('layout/layoutTop');
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i> Purchased Gift Coupon Report
            </h4>
            <div class="btn-group btn-group-sm pull-right" >
                <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url() ?>index.php/UserRecordManagement/purchased_coupon_pdf" style="margin-top: -25px;"><i class="fa fa-download"></i> </a>

            </div>
        </div>
        <div class="panel panel-body">
            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Purchased By </th>
                        <th>Gift Coupon</th>
                        <th>Amount</th>
                        <th>Payment Mode<br></th>
                        <th>Payment Id<br></th>
                        <th>Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data) {
                        for ($i = 0; $i < count($data); $i++) {
                            $res = $data[$i];
                            //print_r($res['payment_data']);
                            ?>
                            <tr>
                                <td><?php echo $i + 1 ?></td>
                                <td><?php echo ucwords($res['name']) ?></td>
                                <td><?php echo $res['coupon_code'] ?></td>
                                <td><?php echo '$' . number_format($res['amount']?$res['amount']:'0', 2, '.', ''); ?></td>
                                <td><?php echo $res['payment_method'] ?></td>
                                <td>
                                    <?php
                                      $temp1 = json_decode($res['payment_data']);
                                      
                                    if ($res['payment_method'] == 'PayPal') {
                                        print_r($temp1->PAYMENTREQUESTINFO_0_TRANSACTIONID);
                                        }
                                     if ($res['payment_method'] == 'Credit Card') {
                                       // print_r($temp1->card_number);
                                         $dd = substr($temp1->card_number, -4);
                                            echo '************' . $dd;
                                    }
                                    
                                    ?>
                                </td>
                                  <td><?php echo $res['op_date_time'] ?></td>
                            </tr>


                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i> Sent Gift Coupon Report
            </h4>
            <div class="btn-group btn-group-sm pull-right" >
                <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url() ?>index.php/UserRecordManagement/gift_coupon_pdf" style="margin-top: -25px;"><i class="fa fa-download"></i> </a>

            </div>
        </div>
        <div class="panel panel-body">
            <table id="gifted_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Receiver</th>
                        <th>Receiver Email </th>
                        <th>Sender </th>
                        <th>Sender Email </th>
                        <th>Purchased Coupon</th>
                        <th>Amount</th>
                        <th>Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($gift_data) {
                        for ($i = 0; $i < count($gift_data); $i++) {
                            $result = $gift_data[$i];
                            ?>
                            <tr>
                                <td><?php echo $i + 1 ?></td>
                                <td><?php echo ucwords($result['user_name']) ?></td>
                                <td><?php echo $result['user_email'] ?></td>

                                <td><?php echo ucwords($result['name']) ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $result['coupon_code'] ?></td>
                                <td><?php echo '$' . number_format($result['value'], 2, '.', ''); ?></td>
                                <td><?php echo $result['op_date_time'] ?></td>

                            </tr>


                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("#location_table").DataTable();
        $("#gifted_table").DataTable();
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>
