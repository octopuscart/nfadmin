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
            <h4 class="panel-title" style="font-size: 18px;font-weight: 500;">Send Mail To Clients</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="col-md-12">


                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Subject</label>
                        <div class="form-group"> 

                            <div class="col-md-12">

                                <input name="subject" class="form-control"  placeholder="Enter subject ..." required="">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Message</label>
                        <div class="form-group"> 

                            <div class="col-md-12">
                                <textarea name ="message" class="textarea form-control ckeditor" id="editor1" placeholder="Enter text ..." rows="16">

<p><img alt="" src="http://nitafashions.com/nitaFashionsAdmin/images/uploads/1487071150_4 eMAIL 740x1024.jpg" style="width: 100%; " /></p>

                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-12" style="">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <div class="col-md-10">
                            <h4 id="sendcheker" style="text-align: right;
                                padding-right: 10px;">
                                Click here to send bulk mail.
                            </h4>
                        </div>
                        <div class="col-md-2">
                            <button name="submit" type="button" id="sendmail"  class="btn btn-info  pull-right">
                                <span class="fa-stack fa-lg" style="margin-top: -4px;">
                                    <i class="fa fa-envelope fa-stack-2x"></i>
                                    <i class="fa fa-group fa-stack-1x" style="color:#7B7A78"></i>
                                </span>
                                Send Bulk Mail</button>
                        </div>
                    </div>

                    <label class="col-md-12 control-label"  style="padding-top: 5px;">Receipt <button type="button" class="btn btn-danger pull-right btn-xs reset_receipt" > Clear</button></label>
                    <div class="form-group"> 

                        <div class="col-md-12">
                            <textarea name="receipt" required="" readonly="" class="form-control"  placeholder="" style="    background: white;
                                      color: #000;
                                      font-weight: bold;
                                      font-size: 12px;"></textarea>
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
                                    echo '<td><input type="checkbox" class="case" value="' . $value['email'] . '" name="user_id[]"></td>';
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
                    <button name="submit" class="btn btn-info">Send Mail</button>
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

</script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 




<script>
    $(function () {
        $(document).on('click', "#sendmail", (function (e) {
            var msg = $('textarea[name ="message"]').text();
            var sub = $('input[name="subject"]').val();

            var formData = {'message': msg, 'subject': sub, 'msg_type': 'bulkmail'};
            $("#sendcheker").html("<i class='fa fa-spinner fa-spin'></i> Sending bulk mail...");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/Message_management/bulk_message_send",
                data: formData,
                success: function (data)
                {
                    //window.location.reload();
                    $("#sendcheker").html("<i class='fa fa-check'></i> Sent");
                }
            })
        }))
    })
</script>


<script>
    var receipt = [];
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();



    });

    $(document).on("click", ".case", function () {
        if ($(this).is(":checked")) {
            console.log(this.value);
            receipt.push(this.value);
        }
        else {

            receipt.splice(receipt.indexOf(this.value), 1);
        }
        $("textarea[name='receipt']").val(receipt.join(", "));

    })
    $(".reset_receipt").click(function () {
        receipt = [];
        $("textarea[name='receipt']").val(receipt.join(", "));
    })
</script>
<?php
$this->load->view('layout/layoutFooter');
?>  