<?php
$this->load->view('layout/layoutTop');
//print_r($updateData);
?>

<?php
$tempdata = array(
    'title' => '',
    'child_label' => '',
    'standard' => '',
    'set_image' => ''
);
if ($updateData) {
    $tempdata = $updateData[0];

}
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Add Data</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-10" style="padding: 0px;">
                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-12"  style="padding: 0px;">
                        <input type='hidden' name='update_id' value='<?php echo $product_id; ?>'>
                        <div class="col-md-12"  style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">title</label>
                                <div class="col-md-9">
                                    <input id="t1" type="text" name ="title" class="form-control" placeholder="Item No." value='<?php echo $tempdata["title"] ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"  style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">child_label</label>
                                <div class="col-md-9">
                                    <input id ="t2" type="text" name ="child_label" class="form-control" placeholder="Item Feature" value='<?php echo $tempdata["child_label"] ?>'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">standard</label>
                                <div class="col-md-9">
                                    <input id ="t3" name ="standard" class="form-control" placeholder="Short Description" value="<?php echo $tempdata["standard"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top : 15px;padding: 0px;">
                            <div class="col-md-10" style="padding-left: 0px;">
                                <div class="col-md-3">
                                    <lable>Add Image</lable>
                                </div>
                                <div class="col-md-6" style="margin-left: 39px;">
                                    <div class="form-control">
                                        <input type="file" name="file" id="file"/>

                                        <input type="hidden" name="image_name" value="<?php echo $image_name[0]['set_image']; ?>">
                                        <div style="clear:both"></div></div>
                                </div> 
                                <div class='col-md-2'>
                                    <img src='<?php echo $tempdata['set_image'] ?>'>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div class="col-md-12">
                        <div class="form-group">

                            <div class="col-md-3 col-md-push-4">
                                <button type="submit" name ="addProduct" id="addProduct" class="btn btn-sm btn-success test" style="margin: 10px 0px 0px -77px;">
                                    Submit</button>

                            </div>

                        </div>
                    </div>
                </form> 

                <!--</form>-->
            </div>

        </div>

    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Add Data</h4>
        </div>
        <div class="panel-body">


            <div class="col-md-12">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered nowrap" id="data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>nfe_Id</th>
                                <th>title</th>
                                <th>child_label</th>
                                <th>standard</th>
                                <th>set_image</th>
                                <th>Edit</th>
                                <th>Delete</th>


                        </thead>
                        <tbody id="status_report"> 
                            <?php
                            for ($i = 0; $i < count($result); $i++) {
                                $data = $result[$i];
                                //  print_r($data);
                                ?>
                                <tr>
                                    <td class="ids"><?php echo $data['id']; ?></td>
                                    <td class="nfw_custom_element_id"><?php echo $data['nfw_custom_element_id']; ?></td>
                                    <td class="title"><?php echo $data['title']; ?></td>
                                    <td class="child_label"><?php echo $data['child_label']; ?></td>
                                    <td class="standard"><?php echo $data['standard']; ?></td>
                                    <td class="set_image"><img src="<?php echo $data['set_image']; ?>" style ="height:20px; width: 20px"></td>
                                    <td><button class="btn btn-success productIds" onclick="editInfo(this)" id="<?php echo $data['id']; ?>">Edit</button></td>
                                    <td><button class="btn btn-success" onclick="deleteInfo(this)" id="<?php echo $data['id']; ?>">Delete</button></td>
                           
                                </tr>
                            <?php } ?>

                        </tbody> 
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>


<script>
    function editInfo(obj) {
        var id = obj.id;
        //var test=$(".productIds").parent().parent().find('td');
        var path = "<?php echo $this->uri->segment(3);?>";
       
        var url = '<?php echo base_url(); ?>index.php/ElementController/insert_sub_custom_data/' + path + '/' + id;
        //console.log(url);
        window.location.replace(url);
        //$("#addProduct").hide();
        //$("#updateProduct").show();

    }
</script>
<script>
    function deleteInfo(obj){
         var ids = obj.id;
         alert('gf');
         $.ajax({
             url:'<?php echo base_url('index.php/ElementController/deleteElement'); ?>',
             type:'post',
             data:{'productIds':ids},
             success:function(data){
                   window.location = "<?php echo base_url('index.php/ElementController/insert_sub_custom_data'), '/', $nfw_custom_element_id; ?>";
             }
         })
    };
</script>

<script type="text/javascript">
    function updateInsertData(imageName) {
        console.log(imageName);
        var update_id = $("input[name='update_id']").val();

        var indata = {'nfw_custom_element_id': '<?php echo $nfw_custom_element_id; ?>', 'title': $("input[name='title']").val(), 'child_label': $("input[name='child_label']").val(), 'standard': $("input[name='standard']").val(), 'id': update_id, 'set_image': imageName};
        $.ajax({
            url: "<?php echo base_url('index.php/ElementController/ajaxController'); ?>",
            type: "GET",
            data: indata,
            success: function (rdata) {
                console.log(rdata);
                window.location = "<?php echo base_url('index.php/ElementController/insert_sub_custom_data'), '/', $nfw_custom_element_id; ?>";
        
            }
        })
    }


    $(document).ready(function (e) {

        $("#uploadimage").on('submit', (function (e) {
            var imageData1 = $("input[type='file']").val();
            e.preventDefault();
            var formData = new FormData(this);
            //console.log(formData);
            // $("#imagemodelcontent").html("<h2 style='padding:20px'><span>Saving ....</span></h2>")

            if (imageData1) {


                $.ajax({
                    url: '<?php echo image_server;?>/imageUploadFunction.php', // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    success: function (rdata)   // A function to be called if request succeeds
                    {
                        var imageid = jQuery.parseJSON(rdata);
                        var imageName = "<?php echo image_server;?>/nfw/small/" + imageid;
                        $("input[name='image_name']").val(imageName);
                        updateInsertData(imageName);
                    }
                });
            }
            else {
                var imageName = '<?php echo $tempdata['set_image'] ?>';
                updateInsertData(imageName);
            }
        }));


      

    });
</script>

<script src="<?php echo base_url(); ?>assets_main/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>

<script>
    $(document).ready(function () {
        App.init();
        // TableManageDefault.init();
        TableManageTableTools.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>

