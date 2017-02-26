<?php
$this->load->view('layout/layoutTop');
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        height: 100%;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

</style>
<title>Places Searchbox</title>
<style>
    #target {
        width: 500px;
    }
</style>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-map-marker"></i> Search Address
            </h4>
        </div>
        <div class="panel panel-body">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="map" style="height:354px;width:100%;margin-left: -10px;"> </div>


        </div>
    </div>

</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "><i class="fa fa-edit"></i> Set Appointment Location</h4>
        </div>
        <div class="panel panel-body">
            <form method="post">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <input type="hidden" name="place_id">
                        <div class="form-group">
                            <label class="control-label" style="">Hotel Name</label>
                            <input type="text" class="time start form-control" name="location"  />
                        </div>
                    </div>

                    <div class="col-md-4"> 
                        <div class="form-group">
                            <label class="control-label" style="">Hotel Address or Fill Flat/House No.</label>
                            <input type="text" class="time start form-control"  id="address2" name="address2"/>

                        </div>
                    </div>          
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" style="">City</label>
                            <input type="text" class="time start form-control" name="city"   />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" style="">State</label>
                            <input type="text" class="time start form-control" name="state"   />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" style="">Country</label>
                            <input type="text" class="time start form-control" name="country"   />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" style="">Contact No.</label>
                            <input type="text" class="time start form-control" name="contact_no"   />
                        </div>
                    </div>

                    <div class="col-md-4">

                        <label class="control-label" style="">Select FromDate and ToDate</label>

                        <div class="input-group default-daterange" id="default-daterange">
                            <input type="text" name="default-daterange" class="form-control" value="<?php echo date('Y-m-d') . '  To  ' . date('Y-m-d') ?>" placeholder="click to select the date range"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <label class="control-label" style="">Total Days</label>

                        <div class="input-group " >
                            <input type="text" name="total_days" class="form-control" value="" placeholder="Total Days"/>
                           
                        </div>
                    </div>

                    <div class="col-md-6">


                        <div class="row row-space-10" id="basicExample1">
                            <div class="col-md-6">
                                <label class="control-label" style="float:left;width: 100%">Select From Date</label>
                                <select id="fromhour"  class="form-control" style="width: 65px;float:left;" onclick="fromDateChange()">
                                    <?php
                                    for ($i = 0; $i <= 12; $i++) {
                                        $th = "" . ( $i < 10 ? "0" . $i : $i );
                                        echo "<option>" . $th . "</option>";
                                    }
                                    ?>
                                </select>
                                <select id="fromminut" class="form-control " style="width: 65px;float:left;"  onclick="fromDateChange()">
                                    <?php
                                    for ($i = 0; $i <= 3; $i++) {
                                        $th = $i * 15;
                                        $th = "" . ( $th < 10 ? "0" . $th : $th );
                                        echo "<option>" . $th . "</option>";
                                    }
                                    ?>
                                </select>
                                <select id="fromampm" class="form-control " style="width: 65px;float:left;"  onclick="fromDateChange()">
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label" style="float:left;width: 100%">Select To Date</label>
                                <select id="tohour"  class="form-control" style="width: 65px;float:left;"  onclick="toDateChange()">
                                    <?php
                                    for ($i = 0; $i <= 12; $i++) {
                                        $th = "" . ( $i < 10 ? "0" . $i : $i );
                                        echo "<option>" . $th . "</option>";
                                    }
                                    ?>
                                </select>
                                <select id="tominut" class="form-control " style="width: 65px;float:left;"  onclick="toDateChange()">
                                    <?php
                                    for ($i = 0; $i <= 3; $i++) {
                                        $th = $i * 15;
                                        $th = "" . ( $th < 10 ? "0" . $th : $th );
                                        echo "<option>" . $th . "</option>";
                                    }
                                    ?>
                                </select>
                                <select id="toampm" class="form-control " style="width: 65px;float:left;"  onclick="toDateChange()">
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                            </div>
                            <input type="hidden" class="time start form-control" name="start_time"  placeholder="Start Time" />

                            <input type="hidden" class="time end form-control" name="end_time"  placeholder="End Time" />
                        </div>


                    </div>


                </div>
                <div style="clear:both"></div><br/>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <button name="submit" type="submit" class="btn btn-info  submitBtn">Submit</button>
                    </div>
                </div>

            </form>


        </div>
    </div>

</div>


<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.js"></script>

<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("#location_table").DataTable();
        $("select[name='data-table_length']").hide();
        $(".dataTables_length").hide();
        $(".dataTables_filter").hide();
        $(".dataTables_info").hide();
        $("#data-table_paginate").hide();
    });
</script>

<script>
    $(function () {
        $('.default-daterange').daterangepicker({
            opens: 'right',
            format: 'YYYY-MM-DD',
            separator: ' to ',
            startDate: moment(),
            endDate: moment().add('days', 5),
           
        },
                function (start, end) {
                    $('#default-daterange input').val(start.format('YYYY-MM-DD') + ' To ' + end.format('YYYY-MM-DD'));
                });
    });

    function toDateChange(){
        var hour = $("#tohour").val();
        var minut = $("#tominut").val();
        var ampm = $("#toampm").val();
        $('[name="end_time"]').val(hour+":"+ minut+" "+ ampm)
    }
    
     function fromDateChange(){
        var hour = $("#fromhour").val();
        var minut = $("#fromminut").val();
        var ampm = $("#fromampm").val();
        $('[name="start_time"]').val(hour+":"+ minut+" "+ ampm)
    }


</script>
<?php
$this->load->view('layout/layoutFooter');
?>


<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();
            $("input[name='city']").val("");
            $("input[name='state']").val("");
            for (i in places) {
                var data = places[i];
                var componectadata = data['address_components'];
                for (j in componectadata) {
                    console.log(componectadata[j].types, '---------');
                    if (componectadata[j].types) {
                        console.log(componectadata);
                        if (componectadata[j].types[0] == 'administrative_area_level_2' || componectadata[j].types[0] == 'locality') {
                            $("input[name='city']").val(componectadata[j].short_name);
                        }
                        if (componectadata[j].types[0] == 'administrative_area_level_1') {
                            $("input[name='state']").val(componectadata[j].short_name);
                        }
                    }
                }

                $("input[name='location']").val(data['name']);
                $("#address2").text(data['formatted_address']);
                $("input[name='place_id']").val(data['place_id']);
                var c = data['formatted_address'];
                // console.log(c);
                var c2 = $(c.split(",")).last();
                //  console.log(c2[0]);
                $("input[name='country']").val(c2[0]);
            }


            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        // [END region_getplaces]
    }
    initAutocomplete();

</script>
