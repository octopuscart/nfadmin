<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  "><i class="fa fa-edit"></i> User Coupon</h4>
        </div>
        <div class="panel-body">
            <form method="post"> 
                <div class="col-md-12" style="padding: 0px;">
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Coupon Code</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="coupon_code" value="<?php
                                $character_array = array_merge(range('A', 'Z'), range(0, 9));
                                $string = "";
                                for ($i = 0; $i < 8; $i++) {
                                    $string .= $character_array[rand(0, (count($character_array) - 1))];
                                }
                                echo $string;
                                ?>" readonly style="cursor: pointer;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Price Value</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control is_number" name="value" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Value Type</label>
                            <div class="col-md-12">
                                <select class="form-control" name="value_type">
                                    <option>Fixed</option>
                                   <!-- <option>%</option> -->
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Coupon Validity Till</label>
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control dateFormat" name="start_date" placeholder="Date Start" required value="<?php echo date("Y-m-d")?>">
                                <span class="input-group-addon">to</span>
                                <input type="text" class="form-control dateFormat" name="end_date" placeholder="Date End" required value="<?php echo date("Y-m-d")?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <div id="update_id"></div>
                    <div class="col-md-2 col-md-push-10">
                        <button name="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-12">
                <table id="data-table" class="table table-striped table-bordered dataTable no-footer" >
                    <thead>
                        <tr>
                            <th style="width: 7%;">S.No.</th>
                            <th style="width: 14%;">Coupon Code</th>
                            <th style="width: 10%;">Price Value</th>
                            <th style="width: 12%;">Value Type</th>
                            <th style="width: 19%;">Coupon Validity Till</th>
                            <th style="width: 9%;">Status</th>
                            <th style="width: 13%">Send To Client</th>
                            <th style="width: 16%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($couponData) {
                           // echo count($couponData);
                            $from = date_create(date('Y-m-d'));
                            $count = 1;
                            foreach ($couponData as $key => $value) {
                                $to = date_create($value['end_date']);
                                $to1 = date_create($value['start_date']);
                                $diff = date_diff($from, $to);
                                $diff1 = date_diff($from, $to1);
                                $days = $diff->format('%R%a');
                                $updays = $diff1->format('%R%a');

                                echo '<tr>';
                                echo '<td>' . $count .'</td>';
                                echo '<td>' . $value['coupon_code'] . '</td>';
                                echo '<td>' . $value['value'] . '</td>';
                                echo '<td>' . $value['value_type'] . '</td>';
                                echo '<td>' . $value['start_date'] . ' to ' . $value['end_date'] . '</td>';
                                if ($days < 0) {
                                    echo '<td><a class="btn btn-danger btn-xs m-r-5">' . $days . ' Close</a></td>';
                                } else {
                                    if ($updays > 0) {
                                         echo '<td><a class="btn btn-warning btn-xs m-r-5">' . $updays . ' Upcoming</a></td>';
                                    } else {
                                        echo '<td><a class="btn btn-primary btn-xs m-r-5">' . $days . ' Open</a></td>'; 
                                    }
                                }
                                echo '<td><a class="btn btn-info btn-xs" href="'.base_url('index.php/UserRecordManagement/coupon_code_sending/'.$value['id']).'">Send Now</a></td>';
                                echo '<td><a class="btn btn-warning btn-xs" onclick="edit_information(this)" id="' . $value['id'] . '"><i class="fa fa-edit"></i> Edit</a>'
                                . '<a class="btn btn-danger btn-xs" style="margin-left: 4px;" onclick="delete_information(this)" id="' . $value['id'] . '"><i class="fa fa-trash-o"></i> Delete</a></td>';
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
<script>
    function edit_information(obj) {
        var id = obj.id;
        var r = confirm("Do you want to edit!");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/UserRecordManagement/ajax_data_edit",
                data: {'id': id, 'table_name': 'nfw_coupon', 'column_name': 'id'},
                dataType: 'json',
                success: function (data)
                {
                    console.log(data);
                    var jsonData = data;
                    for (key in jsonData) {
                        console.log(key);
                        var val = jsonData[key];
                        $('[name=' + key + ']').val(val);
                        var htmls = '';
                        htmls = '<input type="hidden" name="update_id" value="' + jsonData['id'] + '">';
                        $('#update_id').html(htmls);
                        $('button[name=submit]').attr('name', 'update');
                    }
                }
            });
        } else {
        }

    }
    function delete_information(obj) {
        var id = obj.id;
        var r = confirm("Do you want to delete!");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/UserRecordManagement/ajax_data_delete",
                data: {'id': id, 'table_name': 'nfw_coupon', 'column_name': 'id'},
                success: function (data)
                {
                    //console.log(data)
                    window.location.reload(true);
                }
            });
        } else {
        }

    }
</script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        FormPlugins.init();
    });
</script>
<script>
    $(".dateFormat").datepicker({'format': 'yyyy-mm-dd'})
            .on('changeDate', function (ev)
            {
                $('.datepicker').hide();

            }
            );
</script> 
<?php
$this->load->view('layout/layoutFooter');
?> 