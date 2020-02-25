<?php
$this->load->view('layout/layoutTop');
?>

<form method="post">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="index-5">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="" style="width: 70%;margin-right: 30px;" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-backward"></i>  Back</a>
                </div>
                <h4 class="panel-title" style="font-size: 17px;font-weight: 500;">Create News Letter</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" style="padding-top: 5px;">Title</label>
                            <div class="col-md-4">
                                <input type="text" name="title" class="form-control" placeholder="Title" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="form-group">
                            <label class="col-md-2 control-label"  style="padding-top: 5px;">Message</label>
                            <div class="col-md-10">
                                <textarea name ="message" class="textarea form-control ckeditor" id="editor1" placeholder="Enter text ..." rows="12"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="col-md-12"><button class="btn btn-info" name="submit">Submit</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$this->load->view('layout/layoutBottom');
?>
<!--<script src="<?php echo base_url(); ?>assets_main/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-wysiwyg.demo.min.js"></script>-->
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