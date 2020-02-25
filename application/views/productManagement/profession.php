<?php
$this->load->view('layout/layoutTop');
//print_r($fabric_list);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  ">
                <i class=""></i> Add Profession Type</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form method="post">
                    <div class="col-md-4">   
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Enter Profession </span>
                            <input type="text" class="form-control"  name="profession">
                            <input type="hidden" class="form-control"  name="edit_fabric">

                        </div>
                        <button type="submit" name="submit" value="ty" class="btn btn-primary btn-sm" style="margin: -49px 0px 0px 302px;" id="submit">Submit</button>

                    </div>

                </form>
            </div>
            <div style="clear:both"></div>
            <hr>
            <div class="col-md-12">
                <form onsubmit="return confirm('Are you sure?');" method="post">    
                    <table class="table table-striped table-bordered " id="data-table">
                        <thead>
                            <tr>
                                <td style="width:8%;">S.No.</td>
                                <td style="width:40%;">Profession Type</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="tbody">


                            <?php
                            if ($fabric_list) {
                                $count = 1;
                                foreach ($fabric_list as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $value['title']; ?> </td>

                                        <td>
                                            <a href="<?php echo base_url() . 'index.php/ProductHandler/professionProduct/'.$value['id'];?>" class="btn btn-success btn-xs m-r-5">
                                               Add Fabric
                                            </a>
                                            <button type = "button" class="btn btn-warning btn-xs m-r-5" onclick="edit_color_information(this)" name="edit"  id='<?php echo $value['id'] ?>' febric_name="<?php echo $value['title']; ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <button   class="btn btn-danger btn-xs m-r-5" name="delete" value="<?php echo $value['id'] ?>">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </td>

                                    </tr>


                                    <?php
                                    $count++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </form>
            </div>

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
            $("input[name='profession']").val(feb_name);
            $("input[name='edit_fabric']").val(ids);
            $("#submit").attr('name', 'updatefebric');
        }
    }
</script>