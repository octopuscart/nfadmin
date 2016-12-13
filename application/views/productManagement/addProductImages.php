<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title">Add Product Images</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-3">
                    <a class="btn btn-primary" href='#modal-alert'data-toggle='modal'><i class="fa fa-plus-circle"></i> Add Image</a>
                </div>
                <div class="col-md-3 col-md-push-7">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/productHandler/product_list"><i class="fa fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 3%;">
                <div class="row">
                    <?php
                    if ($imageData) {
                        foreach ($imageData as $key => $value) {
                            ?>
                            <div class="col-sm-6 col-md-2">
                                <div class="thumbnail">
                                    <img src="http://nf1.costcokart.com/nfw/small/<?php echo $value['image']; ?>" alt="..." style="height: 90px;width:140px">
                                    <div class="caption">
                                        <div class="input-group">
                                            <input type="text" class="form-control integer index" aria-label="..." value="<?php echo $value['display_priority']; ?>" style="padding: 5px;">
                                            <input type="hidden" class="image_id" value="<?php echo $value['id']; ?>">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <li><a href="#" class="changeIndex">Change Index</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php echo base_url('index.php/ProductHandler/change_index_image/'.$value['id'].'/'.$value['nfw_product_id']); ?>">Delete</a></li>
                                                </ul>
                                            </div><!-- /btn-group -->
                                        </div><!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<span><i class="fa fa-info-circle"></i>
                                        Image which has highest display index, it will be profile picture.
                              </span>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <div class="modal-content" id="imagemodelcontent">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Image to Gallery</h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <input type="file" name="file" id="file" required />
                        </div>
                        <input type="hidden" name="image_name" value="<?php echo date('Y-m-d_h_m_s'); ?>">
                        <div style="clear:both"></div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" value="Upload" class="submit btn btn-success" value="upload">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom'); 
?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#imagemodelcontent").html("<h2 style='padding:20px'><span>Saving ....</span></h2>")

            $.ajax({
                url: "http://nf1.costcokart.com/imageUploadFunction.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (rdata)   // A function to be called if request succeeds
                { 
                  var imageName = jQuery.parseJSON(rdata);    
                    var scId = "<?php echo $product_id; ?>";
                    $.ajax({
                        url: '<?php echo base_url(); ?>index.php/productHandler/image_upload_ajax',
                        data: {'imageName': imageName, 'nfw_product_id': scId },
                        type: 'GET',
                        success: function (data) {
                            console.log(data);
                           window.location.reload(); 
                        }
                    });
                }
            });
        }));


        $(".changeIndex").click(function () {
            var index = $(this).parents(".input-group").find(".index").val();
            var imgId = $(this).parents(".input-group").find(".image_id").val(); 
            $.get("<?php echo base_url(); ?>index.php/productHandler/change_index_image/"+imgId+"/<?php echo $product_id; ?>/"+index, {'index': index, 'image_id': imgId, 'infoid': "<?php echo $product_id; ?>"}, function () {
              window.location.reload()
            })
        })

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