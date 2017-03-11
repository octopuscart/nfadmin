<?php
$this->load->view('layout/layoutTop');
//print_r($fabric_list);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  ">
                <i class=""></i> Set Universal Coupon</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
 
                <form method="post">
                    <div class="col-md-3">   
                        <div class="input-group input-group-sm ">
                            <span class="input-group-addon">Coupon Code</span>
                            <input type="text" class="form-control "  name="coupon_code" value="<?php echo $coupon_data['coupon_code'];?>">

                        </div>
                    </div>
                    <div class="col-md-3">   
                        <div class="input-group input-group-sm ">
                            <span class="input-group-addon">Coupon Amount</span>
                            <input type="text" class="form-control is_number"  name="coupon_amount" value="<?php echo $coupon_data['coupon_amount'];?>">

                        </div>
                    </div>
                    <div class="col-md-3">   
                        <div class="input-group input-group-sm ">
                            <span class="input-group-addon">Coupon Status</span>
                            <select class="form-control"  name="coupon_status" >
                                <option value='active' <?php echo $coupon_data['coupon_status']=='active'?'selected':'' ?> >Active</option>
                                <option value="inactive"  <?php echo $coupon_data['coupon_status']=='inactive'?'selected':'' ?> >Inactive</option>
                            </select>

                        </div>
                    </div>
                    
                    <div class="col-md-3">  
                        <button type="submit" name="update_coupon" value="ty" class="btn btn-primary btn-sm" style="" id="submit">Update</button>
                    </div>
            </div>

            </form>
        </div>
        <div style="clear:both"></div>
        <hr>


    </div>
</div>
</div>



<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();

        $("#data-table").DataTable();
        FormPlugins.init();

    });
</script>

<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        FormPlugins.init();
    });
</script>
<script>
    $(".dateFormat").datepicker({'format': 'yyyy-mm-dd'})
            .on('changeDate', function (ev)
            {
                $('.datepicker').hide();

            }
            );
</script> 


<?php
$this->load->view('layout/layoutFooter');
?>
<script>
    function edit_color_information(obj) {
        var r = confirm("Are you sure want to edit ?");
        if (r == true) {
            var ids = obj.id;
            var feb_name = $(obj).attr('febric_name');
            $("input[name='fabric']").val(feb_name);
            $("input[name='edit_fabric']").val(ids);
            $("#submit").attr('name', 'updatefebric');
        }
    }
</script>