<?php
$this->load->view('layout/layoutTop');
//print_r($fabric_list);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  ">
                <i class=""></i> Change Shipping Rule</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
 
                <form method="post">
                    <div class="col-md-4">   
                        <div class="input-group input-group-sm ">
                            <span class="input-group-addon">Minimum Free Shipping Amount</span>
                            <input type="text" class="form-control is_number"  name="min_amount" value="<?php echo $shipping_data['min_amount'];?>">

                        </div>
                    </div>
                    <div class="col-md-3">   
                        <div class="input-group input-group-sm ">
                            <span class="input-group-addon">Shipping Amount</span>
                            <input type="text" class="form-control is_number"  name="shipping_amount" value="<?php echo $shipping_data['shipping_amount'];?>">

                        </div>
                    </div>
                    <div class="col-md-4">  
                        <button type="submit" name="update_shipping" value="ty" class="btn btn-primary btn-sm" style="" id="submit">Update</button>
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