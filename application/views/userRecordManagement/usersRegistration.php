<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "><i class="fa fa-user"></i> User Registration</h4>
        </div>
        <div class="panel panel-body">
            <form method="post" class="pure-form">
                <div class="col-md-12">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">First Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Middle Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Middle Name" name="middle_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Last Name/Surname</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Last Name/Surname" name="last_name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-4" style="padding: 0px;margin-top: 7px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;">Gender</label>
                            <div class="col-md-9">
                                <div class="col-md-6" style="padding: 0px;">
                                    <div class="col-md-2" style="padding: 0px;"><input type="radio" name="gender" value="Male" required></div>
                                    <label class="col-md-10">Male</label>
                                </div>
                                <div class="col-md-6" style="padding: 0px;">
                                    <div class="col-md-2" style="padding: 0px;"><input type="radio" name="gender" value="Female" required></div>
                                    <label class="col-md-10">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Birth Date</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control dateFormat" id="datepicker-autoClose" placeholder="Birth Date" name="birth_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Contact No.</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Contact No." name="contact_no" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Email/Username</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Fax No.</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Fax No." name="fax_no">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">User Type</label>
                            <div class="col-md-9">
                                <select class="form-control" name="user_type">
                                    <?php
                                    $groupData = $this->Product_model->get_table_information('auth_group');
                                    foreach ($groupData as $key => $value) {
                                        echo '<option value="' . $value['id'] . '">' . $value['role'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Rewrite Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Rewrite Password" id="confirm_password" name="con_password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-12"> <button class="btn btn-success pull-right" id="submit" name="submit" onclick="user_registration()">Submit</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<script>
     $(".dateFormat").datepicker({'format': 'yyyy-mm-dd'})
            .on('changeDate', function (ev)
            { 
                $('.datepicker').hide();

            }
            );
    function user_registration() {
        var password = $('#password').val();
        var conPassword = $('#confirm_password').val();
        if(password == conPassword){
            
        }else{
            alert('Password do not match !');
            $('#submit').attr('name','Not submit');
        }
    }

</script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>