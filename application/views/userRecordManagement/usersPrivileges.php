<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "> User Privileges</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12"><p style="font-size: 20px;font-weight: 600;">Manage User Privileges</p></div>
            <div class="col-md-12" style="margin-top: -20px;"><hr></div>
            <div class="col-md-12" style="border: 1px solid rgba(189, 189, 189, 0.53);padding: 0px;">
                <form method="post">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="col-md-4">
                                <input type="checkbox" id="selectall">
                                <h4 class="panel-title" style ="font-size:17px; font-weight:500;margin: -21px 0px 0px 30px;"> All Privileges</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" style="color: white;font-size: 16px;font-weight: 600;">All Privileges</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="group_id">
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
                            <button class="btn btn-default" name="submit">Grant Permission</button>
                        </div> 
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12"> 
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        Dashboard
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<script>
    $(function () {
        $("#selectall").click(function () {
            $('.case').attr('checked', this.checked);
            if (!$("#selectall").is(":checked")) {
                $("#visible").slideUp();
                $('#submit').attr('disabled', true);
            }
            else {
                $('#submit').attr('disabled', false);
            }
        });
    });
</script>
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