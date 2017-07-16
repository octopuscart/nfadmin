<?php
$this->load->view('layout/layoutTop');
$frequency = isset($_REQUEST['frequency']) ? $_REQUEST['frequency'] : 'Full Experience';
?>
<link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" /> 

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="tree-view-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 18px;font-weight: 500;">Create Newsletter</h4>
        </div>
        <div class="panel-body">


            <div class="col-md-12" style="
                 margin-top: 15px;
                 background-color: #0097FF;
                 color: #fff;
                 padding: 11px 29px 20px;
                 font-size: 17px;
                 ">
                <label class="col-md-12 control-label"  style="padding-top: 5px;    color: #fff;">Select Newsletter Type</label>
                <div class="form-group"> 
                    <form id="change_frequency">
                        <div class="col-md-12" >
                            <select name="frequency" class="form-control" style="width: 200px;font-size: 14px;float: left">
                                <option>All Type</option>
                                <option selected>Full Experience</option>
                                <option>Sales/Promotion</option>
                                <option>New Arrival</option>
                                <option>Monthly</option>
                            </select>
                            <small style="float: left;margin: 5px 14px;">Selected targeted users for newsletter.</small>
                        </div>
                    </form>

                </div>
            </div>


            <form method="post">
                <div class="col-md-12">

                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Title</label>
                        <div class="form-group"> 

                            <div class="col-md-12">
                                <input name="title" class="form-control"  placeholder="Enter title ..." required="">
                            </div>

                        </div>
                    </div>
<!--                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Short Description</label>
                        <div class="form-group"> 

                            <div class="col-md-12">
                                <input name="short_description" class="form-control"  placeholder="Enter description ..." required="">
                            </div>

                        </div>
                    </div>-->
                    <div class="col-md-12" style="margin-top: 15px;">
                        <label class="col-md-12 control-label"  style="padding-top: 5px;">Message</label>
                        <div class="form-group"> 

                            <div class="col-md-12">
                                <textarea name ="message" class="textarea form-control ckeditor" id="editor1" placeholder="Enter text ..." rows="16">
                                    <?php echo $this->User_model->mailsetting_header('header'); ?>
                                    <?php echo $this->User_model->mail_template('News Letter', 'header'); ?>

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
                                                                                          color: #fff;">Nita Fashions Newsletter</span></td>
		</tr>
	</tbody>
</table>

<div><b><u style="background-color: rgba(255, 255, 255, 0);">How important is your wardrobe?</u></b></div>

<div><span style="background-color: rgba(255, 255, 255, 0);">&nbsp;</span></div>

<div><span style="background-color: rgba(255, 255, 255, 0);">The clothes that you choose to wear impacts the way that people perceive you.&nbsp;It is how you present yourself to the world.&nbsp;At Nita Fashions, we take the creative process of your garment seriously.&nbsp;These first impressions are lasting ones.</span></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">There are few elements to keep in mind when making your suit purchase:</span></div>

<div>&nbsp;</div>

<div><b style="background-color: rgba(255, 255, 255, 0);">The Occasion</b></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">Overwhelmed? That can be the first thing you feel when planning or attending a wedding,&nbsp;bar mitzvah or a graduation.&nbsp;Is it an appropriate colour and design? Is a three piece suit still in fashion?&nbsp;Do I wear a sports jacket and a pair of trousers?&nbsp;</span></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">Email us and we&#39;ll be happy to share our expertise. Share the details of your&nbsp;occasion with us and we&#39;ll design the perfect outfit for you!</span></div>

<div><span style="background-color: rgba(255, 255, 255, 0);">&nbsp;</span></div>

<div><b style="background-color: rgba(255, 255, 255, 0);">Fabric Weight</b></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">You may really like the way a certain pattern looks, but it will not do you any good if the fabric weight isn&#39;t suited to your needs.&nbsp;On our website, we recognise the importance of this and have categorised our selection by fabric weight:</span></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);"><i>(Quattro Stagioni)&nbsp;</i>These fabrics are suitable to wear through the seasons. If where you live isn&#39;t particularly warm or cold, then this is the fabric weight that&#39;s right for you.&nbsp;</span></div>

<div><span style="background-color: rgba(255, 255, 255, 0);"><i>(Primavera)</i>&nbsp;If you like a fabric that&#39;s lightweight and crisp, then this is the right fabric weight for you.&nbsp;</span></div>

<div><span style="background-color: rgba(255, 255, 255, 0);"><i>(Inverno)</i>&nbsp;This fabric weight is geared towards fall/winter wear and will keep you insulated from the icy cold.</span></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">Ask the right questions or look for these key elements when making your suit purchase and you will never feel toasty or icy in your clothing.</span></div>

<div>&nbsp;</div>

<div><b style="background-color: rgba(255, 255, 255, 0);">Fabric Performance</b></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">Feeling the fabric gives you a better idea as to what your likes and dislikes are.&nbsp;Squeeze the fabric and see what happens when you open your palm. Does it bounce back to life quickly? You want to buy something that&rsquo;s soft on the skin and can recover from creases quickly.&nbsp;Before purchasing from us online, there is always the option to&nbsp;<b><i>request for a set of swatches</i></b>, so you can get a closer look at the fabrics you are selecting before you make your final decision.&nbsp;</span></div>

<div>&nbsp;</div>

<div><b style="background-color: rgba(255, 255, 255, 0);">The Fit&nbsp;</b></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">The fit, form and silhouette of your garment decides how flattering or unflattering the garment looks on you.&nbsp;</span></div>

<div>&nbsp;</div>

<div><span style="background-color: rgba(255, 255, 255, 0);">If you are new to Nita Fashions and wish to purchase with us online immediately, we recommend that you go to a local tailor to have the required measurements taken.&nbsp;Our Chief Tailors,&nbsp;<b>Mr. Peter Daswani</b>&nbsp;and&nbsp;<b>Mr. Anil Daswani</b>&nbsp;travel extensively worldwide. Email us to see if they travel to your city, so we can get you measured and looking your best.&nbsp;If you have bought from us previously and are the same (or a similar) size to your previous order, we have your complete paper pattern on file. You can leave it up to us to keep you looking smart.&nbsp;If you have changed in size, it&#39;s time to book an appointment with us and get remeasured!</span></div>

<div>&nbsp;</div>

<div>
<div><b>Nita Fashions Style Tip#:</b><span style="background-color: rgba(255, 255, 255, 0);">&nbsp;Try a slim fit&nbsp;</span><span class="gmail-aBn" tabindex="0"><span class="gmail-aQJ">midnight</span></span><span style="background-color: rgba(255, 255, 255, 0);">&nbsp;blue trouser with a 1.25&quot; cuff.</span></div>
</div>

<p class="MsoNormal" style="margin: 0px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">&nbsp;</p>
                                    <?php echo $this->User_model->mail_template('News Letter', 'footer'); ?>
                                    <?php echo $this->User_model->mailsetting_header('footer'); ?>
<div style=""><span style="color: rgb(123, 128, 143); font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 18px; text-align: justify;">If you do not want to receive this mailer,&nbsp;</span><a  href="---userlink---" style="color: rgb(123, 128, 143); font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 18px; text-align: justify;" target="_blank">Unsubscribe</a></div>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>

                <div class="col-md-12" style="margin-bottom: 10px;">



                    <div class="col-md-10">
                        <h4 id="sendcheker" style="text-align: right;
                            padding-right: 60px;">
                            Click here to export data for bulk newsletters.
                        </h4>
                    </div>
                    <div class="col-md-2">
                        <a  class="btn btn-info  pull-right" href="<?php echo base_url() ?>index.php/Message_management/news_letter_xls?frequency=<?php echo $frequency; ?>">
                            <span class="fa-stack fa-lg" style="margin-top: -4px;">
                                <i class="fa fa-envelope fa-stack-2x"></i>
                                <i class="fa fa-group fa-stack-1x" style="color:#7B7A78"></i>
                            </span>
                            Export XLS Data
                        </a>
                    </div>

                    <!--                    <div class="col-md-10">
                                            <h4 id="sendcheker" style="text-align: right;
                                                padding-right: 60px;">
                                                Click here to send bulk newsletters.
                                            </h4>
                                        </div>
                                        <div class="col-md-2">
                                            <button name="submit" type="button" id="sendmail"  class="btn btn-info  pull-right">
                                                <span class="fa-stack fa-lg" style="margin-top: -4px;">
                                                    <i class="fa fa-envelope fa-stack-2x"></i>
                                                    <i class="fa fa-group fa-stack-1x" style="color:#7B7A78"></i>
                                                </span>
                                                Send Bulk Newsletters</button>
                                        </div>-->
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
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
                                <th style="">Frequency</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subquery = " join nfw_news_letters_frequency as nnlf on nnlf.user_id = au.id";


                            if ($frequency == 'All Type') {
                                $subquery2 = '';
                            } else {
                                $subquery2 = "and nnlf.frequency = '$frequency'";
                            }

                            $userData = $this->db->query("select au.*, nnlf.frequency from auth_user as au $subquery
                                                         where au.email not in (select nlu.email_id from nfw_news_letters_unsubscribe as nlu )
                                                         $subquery2 group by au.email
                                                          ");
                            $count = 1;
                            if ($userData) {
                                foreach ($userData->result_array() as $key => $value) {
                                    echo '<tr>';
                                    echo '<td><input type="checkbox" class="case" value="' . $value['id'] . '" name="user_id[]"></td>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                                    echo '<td>' . $value['registration_id'] . '</td>';
                                    echo '<td>' . $value['email'] . '</td>';
                                    echo '<td>' . $value['contact_no'] . '</td>';
                                    echo '<td>' . $value['frequency'] . '</td>';
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

    <div class="panel panel-inverse" data-sortable-id="tree-view-1">
        <div class="panel-heading">
            
            <h4 class="panel-title" style="font-size: 18px;font-weight: 500;">Unsubscribed from mailing list
            
                        
                <a  class="btn btn-info  pull-right btn-xs" href="<?php echo base_url() ?>index.php/Message_management/news_letter_xls_unsubscrib">XLS</a>

           
             </h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12 ">
                <table class="table table-striped table-bordered dataTable no-footer" id="data-table1">
                    <thead>
                        <tr>

                            <th style="">S.No.</th>
                            <th style="">Client Name</th>
                            <th style="">Client Code</th>
                            <th style="">Email</th>
                            <th style="">Unsubscribe Reason</th>
                            <th style=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userData = $this->db->query("select au.*, nlu.reason from auth_user as au
                                                     join nfw_news_letters_unsubscribe as nlu on nlu.email_id = au.email 
                                                     ");
                        $count = 1;
                        if ($userData) {
                            foreach ($userData->result_array() as $key => $value) {
                                echo '<tr>';

                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                                echo '<td>' . $value['registration_id'] . '</td>';
                                echo '<td>' . $value['email'] . '</td>';
                                echo '<td>' . $value['reason'] . '</td>';
                                echo '<td><form><button class="btn btn-danger" type="submit" value="' . $value['id'] . '" name="unblock">Unblock</button></form></td>';
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

</div>






<!-- ------------------------------------------------------------------------------------------------- -->

<?php
$this->load->view('layout/layoutBottom');
?>


<script>
    $(function () {


        $("[name='frequency']").change(function () {
            $("#change_frequency").submit();
        })


        $("[name='frequency']").val("<?php echo isset($_REQUEST['frequency']) ? $_REQUEST['frequency'] : 'Full Experience'; ?>")

        $(document).on('click', "#sendmail", (function (e) {
            var msg = $('textarea[name ="message"]').text();
            var sub = $('input[name="title"]').val();
            var sortmsg = $('input[name="short_description"]').val();

            var formData = {'message': msg, 'subject': sub, 'msg_type': 'newsletter', 'sort_des': sortmsg};
            $("#sendcheker").html("<i class='fa fa-spinner fa-spin'></i> Sending bulk mail...");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/Message_management/bulk_message_send_newsletter",
                data: formData,
                success: function (data)
                {
                    console.log(data);
                    //window.location.reload();
                    $("#sendcheker").html("<i class='fa fa-check'></i> Sent");
                }
            })
        }))
    })
</script>


<script>
    $(function () {
        var receipt = [];
        $(document).on("click", ".case", function () {
            if ($(this).is(":checked")) {
                //console.log(this.value);
                receipt.push(this.value);
            }
            else {

                receipt.splice(receipt.indexOf(this.value), 1);
            }
            $("textarea[name='receipt']").val(receipt.join(", "));

        });
        $(".reset_receipt").click(function () {
            receipt = [];
            $(".case").attr('checked') == false;
            $("textarea[name='receipt']").val(receipt.join(", "));
        });
    });
</script>
<script>
    $(function () {
        $('#newsLetterId table').DataTable();
        $('#data-table').DataTable();
        $('#data-table1').DataTable();
    });
    $('#sendMessage').click(function () {
        var list = [];
        $('#test tr.active').each(function () {
            var t = $(this).attr('value');
            list.push(t)
        });
        $('input[name=recever_id]').val(list);
        console.log(list)
    });

</script>
<script src="<?php echo base_url(); ?>assets_main/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-wysiwyg.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/inbox.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        FormWysihtml5.init();
        Inbox.init();
        $('#data-table_length').remove();
    });
</script> 
<?php
$this->load->view('layout/layoutFooter');
?>