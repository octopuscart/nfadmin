<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse " data-sortable-id="index-5">
        <div class="panel-heading">
             <h4 class="panel-title" style="font-size: 17px;font-weight: 500;">Product Tags</h4>
         
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method ="post">
<!--                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-2" style="width:10%">
                            <label class="control-label">Product Tag</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="tag_title" value =""class="form-control" id="title" placeholder="Enter product tag title">
                            <input type="hidden" name="edit_id"  id="edit_id"  class="form-control">
                        
                            <button type="submit" name ="submit" id="addtag"  class="btn btn-success" style="margin: -18% 0% 0% 100%;">Submit</button>
                        </div>

                    </div>  
                </div>-->
            </form>  
            <div class="col-md-2">
            </div>
            <hr/>
            <div class="col-md-12">
                <form action="" method="post" >
                    <table  id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>S.No.</td>
                                <td>Tag Title</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="tbody" id="tableShort">
                            <?php
                            $count = 1;
                            foreach ($product_tag as $key => $value) {
                                echo '<tr id="sortable-' . $value['id'] . '">';
                                echo '<td style = "width: 80px;">' . $count . '</td>';
                                echo '<td>' . $value['tag_title'] . '</td>';

                                echo '<td><button type = "button" disabled class="btn btn-warning change btn-sm m-r-5 editInfo" name="edit" value="' . $value['id'] . '"><i class="fa fa-edit"></i></button><button disabled type ="submit"  class="btn btn-danger btn-sm m-r-5" name="delete" value="' . $value['id'] . '"><i class="fa fa-trash-o"></i></button></td>';
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
$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $('.editInfo').click(function () {
        var editId = $(this).val();
        var title = $(this).parent().parent().find('td:nth-child(2)').text();
        $('input[name=edit_id]').val(editId);
        $('input[name=tag_title]').val(title);
        $('#addtag').attr('name', 'update');
    });
    $(function () {
        $("#tableShort").sortable({
            cursor: 'move',
            opacity: 0.65,
            stop: function (event, ui) {
                var data1 = $(this).sortable('toArray');
                console.log(data1); // This should print array of IDs, but returns empty string/array
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/ProductHandler/drag_n_drop_tree_menu",
                    data: {'sr_data': data1, 'table_name': 'nfw_product_tag', 'column_name': 'tag_index'},
                    success: function (data)
                    {

                        console.log(data);
                        //  window.location.reload();
                    }
                });
            }
        })
    })
</script>
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>