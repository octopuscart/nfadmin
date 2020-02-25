<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Add Data</h4>
        </div>
        <div class="panel-body">

            <div class="col-md-12 well well-sm">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus"> Add New</i>
                </button>
            </div>
            <hr>
            <div style="clear: both"></div>
            <div class="col-md-12">

                <div class="table-responsive">
                    <table  class="table table-striped table-bordered nowrap" id="data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th></th>
                                <th>dev_title</th>
                                <th>title</th>
                                <th>image_size</th>
                                <th>Colomn size</th>
                                <th>caption_line</th>
                                <th>caption height</th>
                                <th>image_class</th>
                                <th>div type</th>
                             


                        </thead>
                        <tbody id="status_report"> 
                            <?php
                            for ($i = 0; $i < count($result); $i++) {
                                $data = $result[$i];
                                //  print_r($data);
                                ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                      <td><a href="<?php echo base_url(); ?>index.php/ElementController/insert_sub_custom_data/<?php echo $data['id'];?>">Insert </a></td>
                                    <td><?php echo $data['dev_title']; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['image_size']; ?></td>
                                    <td><?php echo $data['colomn_size']; ?></td>
                                    <td><?php echo $data['caption_line']; ?></td>
                                    <td><?php echo $data['caption_height']; ?></td>
                                    <td><?php echo $data['image_class']; ?></td>
                                    <td><?php echo $data['div_type']; ?></td>
                                  
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" 
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    This Modal title
                </h4>
            </div>
            <form method="post">
                <div class="modal-body">

                    <table>
                        <tr>  
                            <td>dev title</td>
                            <td>:</td>
                            <td><input type="text" name="dev_title" class="form-control"></td>
                        </tr>

                        <tr>  
                            <td>title</td>
                            <td>:</td>
                            <td><input type="text" name="title" class="form-control"></td>
                        </tr>
                        <tr>   
                            <td>image_size</td>
                            <td>:</td>
                            <td><input type="text" name="image_size" class="form-control"></td>
                        </tr>
                        <tr>   
                            <td>colomn_size</td>
                            <td>:</td>
                            <td><input type="text" name="colomn_size" class="form-control"></td>
                        </tr>
                        <tr> 
                            <td>caption_line</td>
                            <td>:</td>
                            <td><input type="text" name="caption_line" class="form-control"></td>
                        </tr>
                        <tr>  
                            <td>caption_height</td>
                            <td>:</td>
                            <td><input type="text" name="caption_height" class="form-control"></td>
                        </tr>
                        <tr>  
                            <td>image_class</td>
                            <td>:</td>
                            <td><input type="text" name="image_class" class="form-control"></td>
                        </tr>
                        <tr> 
                            <td>div_type</td>
                            <td>:</td>
                            <td><input type="text" name="div_type" class="form-control"></td>
                        </tr>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit changes </button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php 
$this->load->view('layout/layoutFooter'); 
?> 
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>

<script>
    $(document).ready(function () {
        App.init();
        // TableManageDefault.init();
        TableManageTableTools.init();
    });
</script>