<?php
$this->load->view('layout/layoutTop');
//print_r($result);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Product Filtering Reports</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-md-2 control-label" style="width:103px;">Select Status:</label>
                <div class="col-md-3" style="margin-top:0px">
                    <select name="tagName" class="form-control"> 
                        <?php
                        foreach ($status_tag as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
                        <?php } $portid = $this->uri->segment(3)?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2 pull-right" style="padding: 0px;">
                        <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                           <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/user_order_status_pdf/I/' . $portid) ?>"><i class="fa fa-eye"></i> </a>
                            <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray"  href="<?php echo base_url('index.php/UserRecordManagement/user_order_status_pdf/D/' . $portid) ?>"><i class="fa fa-download"></i> </a>
                            
                        </div>

                    </div>
              <div style="clear: both"></div>
            <hr>
            <div class="col-md-12">

                <table  class="table table-striped table-bordered data_table">
                    <thead>
                        <tr>
                            <th style="width:5px">S.No.</th>
                            <th style="width:8px">Status</th>
                            <th style="width:8px">Order No.</th>
                            <th style="width:100px">Date/Time</th>
                            <th style="width:5px">User Name</th>
                        </tr>
                    </thead>
                    <tbody id="status_report"> 
                     <?php
                        $count = 1;
                        //print_r($test);
                        if ($result) {
                            foreach ($result as $key => $value) {

                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['title'] . '</td>';
                                echo '<td>' . $value['order_no'] . '</td>';
                                echo '<td>' . $value['op_date_time'] . '</td>';
                                echo '<td>' . $value['user'] . '</td>';
                                echo '</tr>';
                                $count++;
                            }
                        }
                        ?> 

                    </tbody> 
                </table>
            </div>


        </div>

    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>

<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        //FormPlugins.init();
        TableManageTableTools.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>
<script>
    $(function(){
        $(".data_table").DataTable();
       
        $("select[name='tagName']").change(function(){ 
            var tt = $(this).val(); 
            window.location.href = '<?php echo base_url(); ?>index.php/userRecordManagement/user_order_status_report/' + tt;
        });
        
         $("select[name='tagName']").val('<?php  echo $portid = $this->uri->segment(3);   ?>');
    });
</script>