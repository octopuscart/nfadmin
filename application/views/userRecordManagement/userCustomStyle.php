<?php
$this->load->view('layout/layoutTop');
$jsonId = json_encode($customId);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"> Custom Style Information</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php
                $count = 1;
                foreach ($tagData as $key => $value) {
                    echo '<a href="' . base_url() . 'index.php/UserRecordManagement/custom_style/21/' . $count . '" class="btn btn-primary btn-xs highlight_'.$count.'" style="margin-left: 10px;"  id="' . $value['id'] . '">' . $value['tag_title'] . '</a>';
                    $count++;
                }
                ?>
            </div>
            <div class="col-md-12"><hr></div>
            <div class="col-md-12" style="margin-top: 30px;">
                <table class="table table-striped table-bordered dataTable no-footer" id="data-table">
                    <thead>
                        <tr>
                            <th style="">S.No.</th>
                            <th style="">Set As Default</th>
                            <th style="">Style</th>
                            <th style="">View Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        if ($customData) {
                            foreach ($customData as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td><input type="radio" name="custom_style" value=""></td>';
                                echo '<td>Style_' . $value['id'] . '</td>';
                                echo '<td><a href="#modal-alert" table_name="' . $customizTable . '" data-toggle="modal" class="btn btn-info btn-xs" id="' . $value['id'] . '" onclick="get_custom_information(this)"><i class="fa fa-eye"></i> View</a></td>';
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


<!---=========Model open===============---->
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Sub Menu From Here</h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="col-md-12" id="customStyle">
                        <table  class="table table-striped table-bordered customStyle"></table>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <button id="submit" type="submit" class="btn btn-sm btn-info" name="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- end #content -->  
<!--=========Model close===============---->
<?php
$this->load->view('layout/layoutBottom');
?>
<script>
    $(function () {
        var id = <?php echo $jsonId; ?>;
      
            $('.highlight_' + id).removeClass('btn btn-primary');
            $('.highlight_' + id).addClass('btn btn-warning');
       
    });
    function get_custom_information(obj) {
        var id = obj.id;
        var tableName = $(obj).attr('table_name');
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/UserRecordManagement/ajax_data_edit',
            data: {'id': id, 'table_name': tableName, 'column_name': 'id'},
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                console.log(data);
                var htmls = '';
                $.each(data, function (key, value) {
                    $.each(value, function (key, value) {
                        //  console.log(key, value);
                        var keyData = key;
                        var keyData = key.split("_").join(" ");
                        htmls += '<tr>';
                        htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                        htmls += '<td><input type="text" name="' + key + '" value="' + value + '" ></td>';
                        htmls += '</tr>';
                    });
                });

                $('.customStyle').html(htmls);
                $($('.customStyle').find('tr')[0]).hide();
                $($('.customStyle').find('tr')[1]).hide();
                $($('.customStyle').find('tr')[2]).hide();

            }
        });
    }

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