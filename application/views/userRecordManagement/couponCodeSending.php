<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="tree-view-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 18px;font-weight: 500;">Send Coupon To Clients</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <table style="width: 60%;font-size: 18px;margin-left: 12px;">
                            <tr>
                                <th style="width: 20%;">Coupon Code:</th>
                                <td style="width: 20%;"><?php echo $couponData[0]['coupon_code']; ?></td>
                                <th style="width: 20%;">Coupon Value:</th>
                                <td style="width: 26%;"><?php echo $couponData[0]['value'] . ' ' . $couponData[0]['value_type']; ?></td>  
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Message</label>
                        <div class="form-group"> 
                            <div class="col-md-12">
                                <textarea name ="message" class="textarea form-control ckeditor" id="editor1" placeholder="Enter text ..." rows="16">
                                    
                                    <?php echo $this->User_model->mailsetting_header('header'); ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 24px; background-color: white;" width="100%">
	<tbody>
		<tr>
			<td>
                            
                            <table width="100%" border="0" style="padding: 5px; background-color: white;" cellspacing="0" cellpadding="0" align="center">
            <tbody>
                <tr>
                    <td>
                        <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
                            <tbody>
                                <tr style="background-color: #FFF;">
                                    <td style="width:100%;    padding: 10px;">
                                    <center><img src="http://costcointernational.com/frontend/assets/images/logo/nf_logo_8.png" style="height: 100px;width:183px;"></center>
                                    </td>
                                    
                                </tr>
                                
                               
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
                            <table style="    width: 100%;" border="0" align="center" >
 <tr>
                                    <td style="text-align:center">
                                    
                                    GIFT COUPON CODE:&nbsp;<?php echo $couponData[0]['coupon_code']; ?> </td>
                                     </td>
                                 </tr>
</table>
                            
			
			</td>
		</tr>
	</tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="    width: 100%;">
	<tbody>
		<tr>
			<td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" readonly="readonly"><span readonly="readonly" style="
                                                                                          text-align: center;
                                                                                          width: 100%;
                                                                                          font-size: 24px;
                                                                                          float: left;
                                                                                          border-bottom: 1px solid #eaedef;
                                                                                          margin-bottom: 20px;
                                                                                          padding: 20px 0;
                                                                                          background-color: #000;
                                                                                          color: #fff;">Nita Fashions Gift Coupon </span></td>
		</tr>
	</tbody>
</table>




<div><font face="sans-serif, Arial, Verdana, Trebuchet MS">This Gift Coupon entitles to <strong>--UserName--</strong> to purchase &nbsp;<strong>US$<?php echo $couponData[0]['value']; ?></strong> of Bespoke Clothing from Nita Fashions.&nbsp;</font></div>
<div>&nbsp;</div>
<div><font face="sans-serif, Arial, Verdana, Trebuchet MS">Your Exclusive Gift Coupon Code is -&nbsp;<strong><?php echo $couponData[0]['coupon_code']; ?></strong></font></div>
<div>&nbsp;</div>
<div><font face="sans-serif, Arial, Verdana, Trebuchet MS">Expiration Date is -&nbsp;<strong><?php echo $couponData[0]['end_date']; ?></strong></font></div>



<div>&nbsp;</div>

                                    <?php echo $this->User_model->mail_template('General', 'footer'); ?>
                                    <?php echo $this->User_model->mailsetting_header('footer'); ?>



                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-12">
                    <table class="table table-striped table-bordered dataTable no-footer" id="data-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="">S.No.</th>

                                <th style="">Client Name</th>
                                <th style="">Client Code</th>
                                <th style="">Email</th>
                                <th style="">Contact No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            if ($userData) {
                                foreach ($userData as $key => $value) {
                                    echo '<tr>';
                                    echo '<td><input type="radio" class="case" value="' . $value['email'] . '/' . $value['id'] . '" name="user_id[]"></td>';

                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                                    echo '<td>' . $value['registration_id'] . '</td>';
                                    echo '<td>' . $value['email'] . '</td>';
                                    echo '<td>' . $value['contact_no'] . '</td>';
                                    echo '</tr>';
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <button name="submit" class="btn btn-info">Send Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">


    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i> Send Gift To Site Promoter
            </h4>
            <div class="btn-group btn-group-sm pull-right">
                <a class="btn btn-success" data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url() ?>index.php/UserRecordManagement/promoter_pdf" style="margin-top: -25px;"><i class="fa fa-download"></i> </a>

            </div>
        </div>

        <div class="panel panel-body">
            <form method="post">
                <div class="col-md-12">   
                    <input type="hidden" name="msg" >
                    <table id="location_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
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
                                    <td><input type="radio" value="<?php echo $res['email'] . '/' . $res['sender_ids'] . '/' . $res['id'] ?>" name="user_ids"></td>
                                    <td><?php echo $i + 1 ?></td>
                                    <td><?php echo $res['sender'] ?></td>
                                    <td><?php echo $res['receiver'] ?></td>
                                    <td><?php echo $res['receiver_email'] ?></td>
                                    <td><?php echo $res['op_date_time'] ?></td>

                                </tr>


                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <button type="submit" name="submitReference" class="btn btn-primary btn-sm"><b>Send Gift Coupon</b></button>
                </div>
            </form>
        </div>
    </div>

</div>
<?php
$this->load->view('layout/layoutBottom');
?> 
<script src="<?php echo base_url(); ?>assets_main/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-wysiwyg.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/inbox.demo.min.js"></script>
<script>
    $("#selectall").click(function () {
        $('.case').attr('checked', this.checked);
        if (!$("#selectall").is(":checked")) {
        }
    });
</script>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("#location_table").DataTable();
        var htm = $("#editor1").text();
        //  console.log(htm);
        $("input[name='msg']").val(htm);
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>  