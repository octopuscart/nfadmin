<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12 ui-sortable">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size:17px; font-weight:500; "><i class="fa fa-user"></i> User Registration</h4>
        </div>
        <div class="panel panel-body">
            <form method="post" class="pure-form">
                <div class="col-md-12">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">First Name</label>
                            <div class="col-md-9">
                                <input type="hidden" name="id">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required="">
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
                                    <div class="col-md-2" style="padding: 0px;"><input type="radio" name="gender" value="fMale" required="" id="male_gender"></div>
                                    <label class="col-md-10">Male</label>
                                </div>
                                <div class="col-md-6" style="padding: 0px;">
                                    <div class="col-md-2" style="padding: 0px;"><input type="radio" name="gender" value="Female" required="" id="female_gender"></div>
                                    <label class="col-md-10">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Birth Date</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control dateFormat hasDatepicker" id="datepicker-autoClose" placeholder="Birth Date" name="birth_date" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Contact No.</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Contact No." name="contact_no" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Email/Username</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" placeholder="Email" name="email" required="">
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
                                    <option value="1">Admin</option><option value="2">Manager</option>                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-3 control-label" style="padding: 0px;margin-top: 7px;">Rewrite Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" placeholder="Rewrite Password" id="confirm_password" name="con_password" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="col-md-12"> <button class="btn btn-success pull-right" id="submit" name="submit" onclick="user_registration()">Update</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500; "><i class="fa fa-list"></i>&nbsp;&nbsp; Admin User Report</h4>
        </div>
        <div class="panel-body" id="test"> 
            <table class="table table-striped table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name/Surname</th>
                        <th>Email/Username</th>
                        <th>Contact No</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    if ($userData) {
                        $count = 1;
                        foreach ($userData as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $value['first_name'] . '</td>';
                            echo '<td>' . $value['middle_name'] . '</td>';
                            echo '<td>' . $value['last_name'] . '</td>';
                            echo '<td>' . $value['email'] . '</td>';
                            echo '<td>' . $value['contact_no'] . '</td>';
                            echo '<td><button class="btn btn-xs btn-warning" id="' . $value['id'] . '" onclick="edit_information(this)"><i class="fa fa-edit"></i> Edit</button>'
                            . '<button style="margin-left:5px;" class="btn btn-xs btn-danger" id="' . $value['id'] . '" onclick="delete_information(this)"><i class="fa fa-trash"></i> Delete</button></td>';
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
<?php
$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
                        $(function () {
                            $('input').attr('disabled', 'disabled');
                            $('select').attr('disabled', 'disabled');
                            $('#submit').attr('disabled', 'disabled');
                        });
                        function edit_information(obj) {
                            var id = obj.id;
                            $.ajax({
                                type: "get",
                                url: "<?php echo base_url(); ?>index.php/UserRecordManagement/ajax_data_edit",
                                data: {'id': id, 'table_name': 'auth_user', 'column_name': 'id'},
                                dataType: 'json',
                                success: function (data)
                                {
                                    // console.log(data);
                                    for (key in data) {
                                        var value = data[key];
                                         $('input[type=text][name=' + key + ']').val(value);
                                         $('input[type=hidden][name=' + key + ']').val(value);
                                         $('input[type=email][name=' + key + ']').val(value);
                                        $('input').removeAttr('disabled');
                                        $('select').removeAttr('disabled');
                                        $('#submit').removeAttr('disabled');
                                        $('input[name=password]').val('');
                                    }
                                    var gender = value['gender'];
                                    
                                    if (gender == 'Male') {
                                        $('#male_gender').attr('checked', true);
                                    } else {
                                        $('#female_gender').attr('checked', true);
                                    }   
                                }
                            })
                        }
                        function delete_information(obj) {
                            var id = obj.id;
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/UserRecordManagement/ajax_data_delete",
                                data: {'id': id, 'table_name': 'auth_user', 'column_name': 'id'},
                                dataType: 'json',
                                success: function (data)
                                {
                                    window.location.reload();
                                    // console.log(data);
                                }
                            })
                        }
                        function user_registration() {
                            var password = $('#password').val();
                            var conPassword = $('#confirm_password').val();
                            if (password == conPassword) {

                            } else {
                                alert('Password do not match !');
                                $('#submit').attr('name', 'Not submit');
                            }
                        }
</script>
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?> 