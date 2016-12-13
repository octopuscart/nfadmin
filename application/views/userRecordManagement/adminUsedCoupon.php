<?php
$this->load->view('layout/layoutTop');
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i> Coupon Report Sent By Admin
            </h4>
            <div class="btn-group btn-group-sm pull-right" >
                <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url() ?>index.php/UserRecordManagement/admin_coupon_pdf" style="margin-top: -25px;"><i class="fa fa-download"></i> </a>

            </div>
        </div>
        <div class="panel panel-body">
            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Client Name </th>
                        <th>Email</th>
                        <th>Coupon</th>
                        <th>Amount</th>
                        <th>Expiry Date<br></th>
                        <th>Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data) {
                        for ($i = 0; $i < count($data); $i++) {
                            $res = $data[$i];
                            ?>
                            <tr>
                                <td><?php echo $i + 1 ?></td>
                                <td><?php echo ucwords($res['name']) ?></td>
                                <td><?php echo $res['email'] ?></td>
                                <td><?php echo $res['coupon_code'] ?></td>
                                <td><?php echo '$' . number_format($res['value'], 2, '.', ''); ?></td>
                                <td><?php echo $res['end_date'] ?></td>
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

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("#location_table").DataTable();

    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>
