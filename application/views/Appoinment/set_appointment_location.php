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
        width: 345px;
    }
</style>
<div class="col-md-6">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-map-marker"></i> Search Address
            </h4>
        </div>
        <div class="panel panel-body">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="map" style="height:354px;width:500px;margin-left: -10px;"> </div>


        </div>
    </div>

</div>
<div class="col-md-6">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "><i class="fa fa-edit"></i> Set Appointment Location</h4>
        </div>
        <div class="panel panel-body">
            <form method="post">
                <div class="col-md-12">
                    <input type="hidden" name="place_id">
                    <div class="form-group">
                        <label class="control-label" style="">Location</label>
                        <input type="text" class="time start form-control" name="location"  />
                    </div>

                    <div class="form-group">
                        <label class="control-label" style="">Serached Address or Fill Flat/House No.</label>
                        <textarea  cols="10" rows="4" class="form-control" id="address2" name="address2"></textarea>
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
                        <input type="text" class="time start form-control" name="country"  readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" style="">Contact No.</label>
                        <input type="text" class="time start form-control" name="contact_no"   />
                    </div>
                </div>
                <div class="col-md-12">
                    <button name="submit" type="submit" class="btn btn-info btn-xs submitBtn">Submit</button>
                </div>

            </form>


        </div>
    </div>

</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-list"></i> 
            </h4>
        </div>
        <div class="panel panel-body">
            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Set Dates Schedule</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($result); $i++) {
                        $res = $result[$i];
                        ?>
                        <tr>
                            <td><?php echo $res['location'] ?></td>
                            <td><?php echo $res['address'] ?></td>
                            <td><?php echo $res['contact_no'] ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/Appointment/date_scheduler/<?php echo $res['id'] ?>" class = "btn btn-primary btn-xs" ><b>Set Dates Schedule</b></a></td>
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
<script>
    $(function () {
        $('.default-daterange').daterangepicker({
            opens: 'right',
            format: 'YYYY-MM-DD',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '2016-01-02',
            maxDate: '2016-12-25',
        },
                function (start, end) {
                    $('#default-daterange input').val(start.format('YYYY-MM-DD') + ' To ' + end.format('YYYY-MM-DD'));
                });
    });


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
                        if (componectadata[j].types[0] == 'administrative_area_level_2'  || componectadata[j].types[0] == 'locality' ) {
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