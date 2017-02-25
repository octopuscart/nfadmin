<?php
$this->load->view('layout/layoutTop');
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i>  Appointment Report
            </h4>
            <div class="btn-group btn-group-sm pull-right" >
                <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url() ?>index.php/Appointment/appointment_pdf" style="margin-top: -25px;"><i class="fa fa-download"></i> </a>

            </div>
        </div>
        <div class="panel panel-body">
            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Customer Name</th>
                        <th>No. Of Person</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>City/State</th>
                        <th>Hotel Name & Address</th>
                        <th>Booked Date</th>
                        <th>Booked Time</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($data); $i++) {
                        $res = $data[$i];
                     
                        ?>
                        <tr>
                            <td><?php echo $i + 1 ?></td>
                            <td><?php echo $res['name'] ?></td>
                            <td><?php echo $res['no_of_person'] ?></td>
                            <td><?php echo $res['email'] ?></td>
                            <td><?php echo $res['telephone'] ?></td>
                            <td>      
                                <?php echo $res['city'] ?>
                                <br/>
                                <?php echo $res['state'] ?>
                            </td>

                            <td>
                                <?php
                                 echo $str = "<b>".$res['location']."</b>";
                                 echo "<br/>";
                               echo $str = $res['address'];
//                                $words = explode(",", $str);
//                                array_splice($words, -1);

//                                $adda = implode(",", $words);
//                                echo $adda;
                                ?>
                            </td>
                            <td><?php echo $res['schedule_date'] ?></td>
                            <td><?php echo $res['schedule_start_time'] . '-' . $res['schedule_end_time'] ?></td>
                        </tr>


                    <?php } ?>
                </tbody>
            </table>

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
        $("#location_table").DataTable();
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>
