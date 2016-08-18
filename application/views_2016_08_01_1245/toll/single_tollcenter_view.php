<?php 
$data = @$toll_center_detal->response;
//pd($data);
?>

<style>
      html, body {
        margin: 0;
        padding: 0;
      }
#map_s {
width: 100%;
height: 200px;
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

#pac-input_s {
  width: 60%;
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  color: #000 !important;
  margin-top: 15px;
  margin-left: 12px;
  min-height: 40px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
}

#pac-input_s:focus {
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

<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
  <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
<form name="add_tollcenter_form_single" id="add_tollcenter_form_single">
<input type="hidden" name="toll_id" id="toll_id" value="<?php echo @$data->tc_id?>">
  <div class="form-group">
    <input type="text" class="form-control" id="toll_location_single" name="toll_location" value="<?php echo @$data->tc_location?>"  placeholder="Toll Centre Location">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="toll_name_single" name="toll_name" value="<?php echo @$data->tc_name?>"  placeholder="Toll Centre Name">
  </div>
  <!-- <div class="form-group">
      <textarea class="form-control" id="address_single" name="address" value="<?php //echo @$data->address?>"><?php //echo @$data->address?></textarea>
  </div> -->
  <div class="row">
    <input id="pac-input_s" class="s" type="text" name="address" value="<?php echo @$data->address?>">
    <div id="map_s"></div>
  </div>

  <div class="form-group">
      <input type="text" class="form-control" id="entry_from_single" name="entry_from" value="<?php echo @$data->from_way_location?>"  placeholder="Entry From">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_single" name="number_landes_from" value="<?php echo @$data->from_way_no_of_lanes?>" placeholder="No. of Lanes">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_bmt_single" name="number_landes_from_bmt" value="<?php echo @$data->from_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
  </div>
  <div class="form-group">
  
      <input class="form-control" type="hidden" name="from_uuid_id_single" id="from_uuid_id_single" value="<?php echo @$data->becon_details->from_beacon->beacon_id?>">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_uuid_single" name="from_uuid" value="<?php echo @$data->becon_details->from_beacon->uuid?>"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_major_id_single" name="from_major_id" value="<?php echo @$data->becon_details->from_beacon->major_id?>"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_minor_id_single" name="from_minor_id" value="<?php echo @$data->becon_details->from_beacon->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
     
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="entry_from2_single" name="entry_from2" value="<?php echo @$data->to_way_location?>" placeholder="Entry From">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from2_single" name="number_landes_from2" value="<?php echo @$data->to_way_no_of_lanes?>" placeholder="No. of Lanes">
  </div>
  <div class="form-group">
      <input type="text" class="form-control" id="number_landes_from_bmt2_single" name="number_landes_from_bmt2" value="<?php echo @$data->to_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
  </div>
  <div class="form-group">
 
      <input class="form-control" type="hidden" name="to_uuid_id_single" id="to_uuid_id_single" value="<?php echo @$data->becon_details->to_beacon->beacon_id?>">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_uuid_single" name="to_uuid" value="<?php echo @$data->becon_details->to_beacon->uuid?>"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_major_id_single" name="to_major_id" value="<?php echo @$data->becon_details->to_beacon->major_id?>"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_minor_id_single" name="to_minor_id" value="<?php echo @$data->becon_details->to_beacon->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      </div>
      
   </div>
   <div class="modal-footer">
    <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_view">Cancel</button>
    
  </div>
  
 </form>
</div>

<script>
$("#cancel_single_view").click(function(){
  location.reload();
});
function initMap() {
  var map = new google.maps.Map(document.getElementById('map_s'), {
    //center: {lat: -33.8688, lng: 151.2195},
    center: {lat: <?php if($data->lat != '') echo $data->lat; else echo '22.817403'?>, lng: <?php if($data->lng != '') echo $data->lng; else echo '76.820855'?>},
    zoom: <?php if($data->lat != '') echo 17; else echo 3?>
  });
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input_s'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(<?php if($data->lat != '') echo $data->lat; else echo '22.817403'?>, <?php if($data->lng != '') echo $data->lng; else echo '76.820855'?>)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      //window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
 /* function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);*/
}

    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrN_DAO6nhdyD3Gk4GEG2_DDKPIHX7raQ&signed_in=true&libraries=places&callback=initMap"
        async defer></script>

<script type="text/javascript">
$("#close_id").click(function(){
  location.reload();
});
  
  jQuery.validator.addMethod("validatemajorid", function(value, element) {
    var from_major_id_single = $("#from_major_id_single").val();
    var to_major_id_single = $("#to_major_id_single").val();
    if(from_major_id_single != to_major_id_single != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'Major Ids Should Not Be Same');

  jQuery.validator.addMethod("validateminorid", function(value, element) {
    var from_minor_id_single = $("#from_minor_id_single").val();
    var to_minor_id_single = $("#to_minor_id_single").val();
    if(from_minor_id_single != to_minor_id_single != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'Minor Ids Should Not Be Same');

  jQuery.validator.addMethod("validatefrombmtlanes", function(value, element) {
    var number_landes_from_single = $("#number_landes_from_single").val();
    var number_landes_from_bmt_single = $("#number_landes_from_bmt_single").val();
    if(number_landes_from_single >= number_landes_from_bmt_single != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'BMT Lanes Should Be Less Than The Total Number Of Lanes');

  jQuery.validator.addMethod("validatetobmtlanes", function(value, element) {
    var number_landes_from2_single = $("#number_landes_from2_single").val();
    var number_landes_from_bmt2_single = $("#number_landes_from_bmt2_single").val();
    if(number_landes_from2_single >= number_landes_from_bmt2_single != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'BMT Lanes Should Be Less Than The Total Number Of Lanes');

  
  $("#save_toll_venter").click(function(){
      
    $('#add_tollcenter_form_single').validate({
      rules:{
        toll_location:{required: true,minlength:1,maxlength:19},
        toll_name:{required: true,minlength:1,maxlength:19},
        entry_from:{required: true,minlength:1,maxlength:19},
        becon1:{required: true,minlength:1,maxlength:19},
        number_landes_from:{required: true,minlength:1,maxlength:9,digits:true},
        number_landes_from_bmt:{required: true,minlength:1,maxlength:9,digits:true,validatefrombmtlanes:true},
        entry_from2:{required: true,minlength:1,maxlength:19},
        becon2:{required: true,minlength:1,maxlength:19},
        number_landes_from2:{required: true,minlength:1,maxlength:9,digits:true},
        number_landes_from_bmt2:{required: true,minlength:1,maxlength:9,digits:true,validatetobmtlanes:true},
        from_uuid:{required: true,minlength:1,maxlength:30},
        from_major_id:{required: true,minlength:1,maxlength:10,digits:true,validatemajorid:true},
        from_minor_id:{required: true,minlength:1,maxlength:10,digits:true,validateminorid:true},
        to_uuid:{required: true,minlength:1,maxlength:30},
        to_major_id:{required: true,minlength:1,maxlength:10,digits:true,validatemajorid:true},
        to_minor_id:{required: true,minlength:1,maxlength:10,digits:true,validateminorid:true},
        address:{required:true,maxlength:250},
      },
      messages:{
                toll_location:{
                    required:"Please Enter Toll Center Location",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               toll_name:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               address:{
                required :"Please Enter The Address",
                maxlength:"Enter Maximum 250 Characters"
               },
               entry_from:{
                    required:"Please Enter Entry From",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               becon1:{
                    required:"Please Enter Toll Entry From",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               number_landes_from:{
                    required:"Please Enter Number Of Lanes",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               number_landes_from_bmt:{
                    required:"Please Enter Number Of BMT Lanes",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               entry_from2:{
                    required:"Please Enter Entry From",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               becon2:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               number_landes_from2:{
                    required:"Please Enter Number Of Lanes",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
                    digits:"Enter Only Digits"
               },
               number_landes_from_bmt2:{
                    required:"Please Enter Number Of BMT Lanes",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               from_uuid:{
                    required:"Please Enter Beacon UUID",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               from_major_id:{
                    required:"Please Enter Major Id",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               from_minor_id:{
                    required:"Please Enter Minor Id",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               to_uuid:{
                    required:"Please Enter Beacon UUID",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               to_major_id:{
                    required:"Please Enter Major Id",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               to_minor_id:{
                    required:"Please Enter Minor Id",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 9 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
    if( $('#add_tollcenter_form_single').valid()){
      
      //alert($("#toll_id").val());return;
        var toll_location = $("#toll_location").val();
        $.ajax({
          "url"  : "<?php echo base_url('tollcenter/updatetollcenterdetails');?>",
          "type" : "POST",
          "data" : ({'toll_location':$("#toll_location_single").val(),'toll_name':$("#toll_name_single").val(),'entry_from':$("#entry_from_single").val(),'becon1':$("#becon1_single").val(),'number_landes_from':$("#number_landes_from_single").val(),'number_landes_from_bmt':$("#number_landes_from_bmt_single").val(),'entry_from2':$("#entry_from2_single").val(),'becon2':$("#becon2_single").val(),'number_landes_from2':$("#number_landes_from2_single").val(),'number_landes_from_bmt2':$("#number_landes_from_bmt2_single").val(),'toll_id':$("#toll_id").val(),'from_uuid':$("#from_uuid_single").val(),'from_major_id':$("#from_major_id_single").val(),'from_minor_id':$("#from_minor_id_single").val(),'to_uuid':$("#to_uuid_single").val(),'to_major_id':$("#to_major_id_single").val(),'to_minor_id':$("#to_minor_id_single").val(),'from_uuid_id':$("#from_uuid_id_single").val(),'to_uuid_id':$("#to_uuid_id_single").val(),'address':$("#address_single").val()}),
          success:function(response){
            //console.log(response);return false;
              var data = $.parseJSON(response);
             //console.log(data.statuscode);
              if(data.statuscode == 200)
              {
               //alertify.success(data.successMessage);
               alertify.success(data.successMessage);
              }
              else{
                 //$("#fail").text(data.error);
                alertify.error(data.error);
              }
              // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake;?>";
  
          }
        });
    }
});
    
</script>