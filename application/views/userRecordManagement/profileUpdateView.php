<?php
$this->load->view('layout/layoutTop');
$session_data = $this->session->userdata('logged_in');
$loginData = json_encode($session_data); 
?>
<form method="post">
    <div class="col-md-12"> 
        <div class="panel panel-inverse" data-sortable-id="index-5">
            <div class="panel-heading">
                <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  "><i class="fa fa-edit"></i> Edit User Profile</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">First Name</label>
                            <div class="col-md-8">
                                <input type="hidden" name="login_id" value="<?php echo $session_data['login_id']; ?>">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $session_data['first_name']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">Last Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $session_data['last_name']; ?>"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $session_data['username']; ?>"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">Old Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" placeholder="Old Password" name="old_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">New Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" placeholder="New Password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label" style="margin-top: 6px;">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-push-4">
                            <div class="form-actions" style="margin-top: 20px;">
                                <input type="submit" name="update" value="Update" id="update" class="btn btn-primary" style="margin-left: 49%;">                        
                            </div>
                        </div>
                        <div class="col-md-3 col-md-push-4">
                            <button  style="margin-top: 20px;" class="btn btn-warning" onclick="edit_information()"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$this->load->view('layout/layoutBottom');
?>
<script>
function edit_information(){
    $("input").removeAttr('disabled');
}
</script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("input").attr('disabled','disabled');
        $('#searchCustomer').removeAttr('disabled');
    });
</script>
<script>
    $('#update').click(function () {
        var r = confirm("Do you want update profile ?");
        if (r == true) {
            var data = <?php echo $loginData; ?>;
            var oldPass = data['password'];
            var oldPassword = $('input[name=old_password]').val();
            var password = $('input[name=password]').val();
            var new_password = $('input[name=confirm_password]').val();
            if (oldPass != oldPassword) {
                alert('Wrong Password');
                window.location.reload();
                $('#update').attr('name', 'submit');
            } else {
                if (password != new_password) {
                    alert('Password does not match');
                    window.location.reload();
                    $('#update').attr('name', 'submit');
                }
            }
        } else {
            window.location.reload();
            $('#update').attr('name', 'submit');
        }

    })
</script>
<?php
$this->load->view('layout/layoutFooter');
?>