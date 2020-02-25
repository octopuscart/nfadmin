<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  ">
                <i class="fa fa-paint-brush"></i> Add Product Color</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                <div class="col-md-12">
                    <div class="form-group col-md-4">
                        <label class="col-md-4 control-label" style="padding: 8px 0px 8px 0px;">Select Color Code</label>
                        <div class="col-md-8">
                            <input type="text" name="color_code"  value =""class="form-control" id="colorpicker" data-colorpicker-guid="1" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-9">
                            <input type="text" name="title" value =""class="form-control" id="title" required="">
                            <input type="hidden" name="edit_id"  id="edit_id"  value =""class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-4">

                        <div class="col-md-9">
                            <button type="submit" name ="addColor" id="addColor" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>  
            <div class="col-md-12"><hr></div>
            <div class="col-md-12">
                <form onsubmit="return confirm('Are you sure?');" method="post" >    
                    <table class="table table-striped table-bordered " id="data-table">
                        <thead>
                            <tr>
                                <td style="width:8%;">S.No.</td>
                                <td style="width:40%;">Color Title</td>
                                <td style="width:15%">Color Code (Hex)</td>
                                <td style="width: 17%;">Color</td>
                                <td style="width: 20%;">Action</td>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php
                            $count = 1;
                            foreach ($color_list as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['title'] . '</td>';
                                echo '<td>' . $value['color_code'] . '</td>';
                                echo '<td style="background : ' . $value['color_code'] . ';    border: 5px solid #E4E4E4;text-align: center;"></td>';
                                echo '<td><button type = "button" class="btn btn-warning btn-xs m-r-5" onclick="edit_color_information(this)" name="edit"  id="' . $value['id'] . '"><i class="fa fa-edit"></i> Edit</button><button  onclick="delete_information(this)" class="btn btn-danger btn-xs m-r-5" name="delete" value="' . $value['id'] . '"><i class="fa fa-trash-o"></i> Delete</button></td>';
                                echo '</tr>';
                                $count++;
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
foreach ($color_list as $key => $value) {
    $colorData[] = $value['color_code'];
}
$colorData = json_encode($colorData);
$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/plugins/sweetalert/sweetalert-dev.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_main/plugins/sweetalert/sweetalert.css">
<script>
    function edit_color_information(obj) {
        var r = confirm("Are you sure want to edit ?");
        if (r == true) {
            var id = obj.id;
            var title = $('#' + id).parent().parent().find('td:nth-child(2)').text();
            var color_code = $('#' + id).parent().parent().find('td:nth-child(3)').text();
            $('input[name=color_code]').val(color_code);
            $('input[name=title]').val(title);
            $('input[name=edit_id]').val(id);
            $('input[name=color_code]').css('background', color_code)
            $('#addColor').attr('name', 'updateColor')
        }
    }
    $('#colorpicker').change(function () {
        $(this).css('background', $(this).val());
    });
    $('#addColor').click(function () {
        var colorCode = $('input[name=color_code]').val();
        var colorData = <?php echo $colorData; ?>;
//        if ($.inArray(colorCode, colorData) > -1) {
//            alert('This color is already exist !');
//            window.location.reload();
//            $('#addColor').attr('name', 'exit');
//        }
    });
    ////////////sweet alert///////////////////////////////
//        swal({
//            title: "Are you sure?",
//            text: "You will not be able to recover this imaginary file!",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonColor: '#DD6B55',
//            confirmButtonText: 'Yes, delete it!',
//            closeOnConfirm: false
/////////////////////////***********************//////////////////////            
//             window.location.reload();
           
//        },
//        function () {
//          //  $(obj).attr('name', 'delete');
//        });
    
</script>  


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/masked-input/masked-input.min.js"></script>
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

