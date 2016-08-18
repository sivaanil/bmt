<style>
      html, body {
        margin: 0;
        padding: 0;

      }
#map {
width: 100%;
height: 200px;
color: #000 !important;
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

<?php 
$data = @$data->response;
 //echo '<pre>';
 //print_r($data);
 //exit;

?>

<!-- body start here -->
<?php //pd($data); //echo count($toll_center_details); 
	?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" enctype="multipart/form-data" id="add_tollcenter_form" name="add_tollcenter_form" method="post" action="<?php echo base_url('tollcenter/updatetoll');?>">
    <input type="hidden" name="toll_type_id" id="toll_type_id" value="<?php echo @$data->toll_type_id?>">
    <input type="hidden" name="toll_id" id="toll_id" value="<?php echo @$data->tc_id?>">
    <div class="row">
      <div class="col-md-4 col-sm-4">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_location" name="toll_location" value="<?php echo @$data->tc_location?>" placeholder="Toll Center Location">
      </div>
      </div>
      <div class="col-md-4 col-sm-4">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_name" name="toll_name" value="<?php echo @$data->tc_name?>"  placeholder="Toll Center Name">
      </div>
      </div>
      <div class="col-md-4 col-sm-4"><span style="color: red"><?php $type = (@$data->toll_type_id == 1)?'National Highway':'Outer Ringroad'; echo $type?></span></div>
<!--      <div class="col-md-4 col-sm-4">
      <div style="font-size: 12px; margin-top: -12px ! important;">Upload Agreement:</div>
        <input type="file" id="document" name="document">
        <button type="button" id="remove_file">X</button>
      </div>-->
    </div>
   

   <!--  <div class="row">
      <div class="col-md-4 col-sm-4">
        
        <div class="form-group">
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
      </div>
      
    </div> -->

    <div class="row">
        <input id="pac-input" class="s" type="text" name="address" value="<?php echo @$data->address?>" placeholder="Enter Your Location">
        <label>Coordinate of one side</label>
        <input type="text" id="lat" name="lat" value="<?php echo @$data->lat?>">
        <input type="text" id="lng" name="lng" value="<?php echo @$data->lng?>">
        <label>Coordinate of second side</label>
        <input type="text" id="latsec" name="latsec" type="text" value="<?php echo @$data->to_lat?>">
        <input type="text" id="lngsec" name="lngsec" type="text" value="<?php echo @$data->to_lag?>">
        <div id="map"></div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from" name="entry_from" value="<?php echo @$data->from_way_location?>" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from" name="number_landes_from" value="<?php echo @$data->from_way_no_of_lanes?>"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt" name="number_landes_from_bmt" value="<?php echo @$data->from_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php if(!empty($data->becon_details) && $data->becon_details->from_beacon->entry_type=="IN"){?>
          <label><input type="radio" name="nh_type1" id="nh_in_type" value="in" checked> IN	<input type="radio" name="nh_type1" id="nh_out_type" value="out"> OUT <br></label>
          <?php }else{ ?>
          	<label><input type="radio" name="nh_type1" id="nh_in_type" value="in"> IN	<input type="radio" name="nh_type1" id="nh_out_type" value="out" checked> OUT <br></label>
          	<?php } ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="from_uuid_id" id="from_uuid_id_single" value="<?php echo @$data->becon_details->from_beacon->beacon_id?>">
            <input type="text" class="form-control" id="from_uuid" name="from_uuid" value="<?php echo @$data->becon_details->from_beacon->uuid?>" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_major_id" name="from_major_id" value="<?php echo @$data->becon_details->from_beacon->major_id?>" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_minor_id" name="from_minor_id" value="<?php echo @$data->becon_details->from_beacon->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from2" name="entry_from2" value="<?php echo @$data->to_way_location?>" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from2" name="number_landes_from2" value="<?php echo @$data->to_way_no_of_lanes?>"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt2" name="number_landes_from_bmt2" value="<?php echo @$data->to_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php if(!empty(@$data->becon_details) && @$data->becon_details->to_beacon->entry_type=="IN"){?>
          <label><input type="radio" name="nh_type2" value="in" checked> IN	<input type="radio" name="nh_type2" value="out"> OUT <br></label>
        <?php }else{?>
        	<label><input type="radio" name="nh_type2" value="in"> IN	<input type="radio" name="nh_type2" value="out" checked> OUT <br></label>
        	<?php } ?>
        </div>
      </div>
      
    </div>
     <div class="row" id="beacon_to">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="to_uuid_id" id="to_uuid_id_single" value="<?php echo @$data->becon_details->to_beacon->beacon_id?>">
            <input type="text" class="form-control" id="to_uuid" name="to_uuid" value="<?php echo @$data->becon_details->to_beacon->uuid?>" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_major_id" name="to_major_id" value="<?php echo @$data->becon_details->to_beacon->major_id?>" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_minor_id" name="to_minor_id" value="<?php echo @$data->becon_details->to_beacon->minor_id?>" placeholder="Beacon Minor Id">
        </div>
      </div>
      
    </div>
  
    
    
    
    <?php if(@$data->toll_type_id == '2'){?>
    		 <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
		  <input class="form-control" type="hidden" name="orr_from_uuid_id" id="from_uuid_id_single" value="<?php echo @$data->becon_details->orr_becon_details['0']->beacon_id?>">
          <input type="text" class="form-control" id="orr_entry_from" name="orr_entry_from" value="<?php echo @$data->orr_from_way_location?>" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_number_landes_from" name="orr_number_landes_from" value="<?php echo @$data->orr_from_way_no_of_lanes?>"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_number_landes_from_bmt" name="orr_number_landes_from_bmt" value="<?php echo @$data->orr_from_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php if(@$data->becon_details->orr_becon_details['0']->entry_type=="IN"){?>
          <label><input type="radio" name="orr_type1" value="in" checked> IN	<input type="radio" name="orr_type1" value="out"> OUT <br></label>
          <?php } else{ ?>
          	<label><input type="radio" name="orr_type1" value="in"> IN	<input type="radio" name="orr_type1" value="out" checked> OUT <br></label>
          	<?php } ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="orr_from_uuid" id="orr_from_uuid" value="<?php echo @$data->becon_details->orr_becon_details['0']->uuid ?>">
            <input type="text" class="form-control" id="orr_from_uuid" name="orr_from_uuid" value="<?php echo @$data->becon_details->orr_becon_details['0']->uuid ?>" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_from_major_id" name="orr_from_major_id" value="<?php echo @$data->becon_details->orr_becon_details['0']->major_id?>" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_from_minor_id" name="orr_from_minor_id" value="<?php echo @$data->becon_details->orr_becon_details['0']->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    
    
    
     <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
		  <input class="form-control" type="hidden" name="orr_to_uuid_id" id="to_uuid_id_single" value="<?php echo @$data->becon_details->orr_becon_details['1']->beacon_id?>">
          <input type="text" class="form-control" id="orr1_entry_from2" name="orr1_entry_from2" value="<?php echo @$data->orr_to_way_location?>" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_number_landes_from2" name="orr1_number_landes_from2" value="<?php echo @$data->orr_to_way_no_of_lanes?>"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_number_landes_from_bmt2" name="orr1_number_landes_from_bmt2" value="<?php echo @$data->orr_to_way_no_of_bmt_lanes?>" placeholder="No. of BMT Lanes">
        </div>
      </div>
      
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php if(@$data->becon_details->orr_becon_details['1']->entry_type=="IN"){?>
          <label><input type="radio" name="orr_type2" value="in" checked> IN	<input type="radio" name="orr_type2" value="out"> OUT <br></label>
          <?php } else{?>
          	<label><input type="radio" name="orr_type2" value="in"> IN	<input type="radio" name="orr_type2" value="out" checked> OUT <br></label>
          	<?php } ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="orr1_to_uuid" id="orr1_to_uuid" value="<?php echo @$data->becon_details->orr_becon_details['1']->uuid?>">
            <input type="text" class="form-control" id="orr1_to_uuid" name="orr1_to_uuid" value="<?php echo @$data->becon_details->orr_becon_details['1']->uuid?>" placeholder="Beacon UUID">
        </div>
      </div>
      
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_to_major_id" name="orr1_to_major_id" value="<?php echo @$data->becon_details->orr_becon_details['1']->major_id?>" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_to_minor_id" name="orr1_to_minor_id" value="<?php echo @$data->becon_details->orr_becon_details['1']->minor_id?>"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <?php }?>
    
    
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
           <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
          </div>
          <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
          <span style="color:red;"><?php echo validation_errors(); ?></span>
          <span class="text-center won_error"><?php echo $this->session->flashdata('errormsg');?></span>
          <span class="text-center won_success"><?php echo $this->session->flashdata('msg');?></span>
          </div>
          </div>
        </div>
      </div>
    </div>
      
  </form>


  
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="pop_view" style="color:#000; font-weight:normal;">
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
      </div> -->
      
    </div>
  </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-header">
      <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">View</h4>
    </div>
    <div class="modal-content" id="pop_view1" style="color:#000; font-weight:normal;">
      
      
    </div>
  </div>
</div>





 <script>
function download(id)
{
  window.location = "<?php echo base_url('tollcenter/downloaddocument')?>/"+id;
}
 
 $("#cancel_upload").click(function(){
  location.reload();
});
function initMap() {
  var db_lat = <?php echo @$data->lat?>;
  var db_lng = <?php echo @$data->lng?>;
  var db_latsec = <?php echo @$data->to_lat?>;
  var db_lngsec = <?php echo @$data->to_lag?>;
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: db_lat, lng: db_lng},
    zoom: 16
  });
  var infowindow = new google.maps.InfoWindow();
  var myLatLng = {lat: db_lat, lng: db_lng};
  var myLatLngsec = {lat: db_latsec, lng: db_lngsec};
  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!',
    draggable : true,
  });
  var marker2 = new google.maps.Marker({
    position: myLatLngsec,
    map: map,
    title: 'Hello World!',
    draggable : true,
  });
 /* var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(db_lat, db_lng),
    draggable : true,
    visible: true
  });
  marker.setMap(map);*/
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);


  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    //console.log(place);
    //alert(place.geometry.location.lat());
    //alert(place.geometry.location.lng());
    document.getElementById("lat").value = place.geometry.location.lat();
    document.getElementById("lng").value = place.geometry.location.lng();
    if (!place.geometry) {
      // /window.alert("Autocomplete's returned place contains no geometry");
      return;
    }
    //marker.setPosition(new google.maps.LatLng(lat, lon));
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
  
  
  google.maps.event.addListener(marker, "dragend", function (event) {
    //alert(this.position);
    //alert(this.position.lat());
    //alert(this.position.lng());
    document.getElementById("lat").value = this.position.lat();
    document.getElementById("lng").value = this.position.lng();
  }); //end addListener

  google.maps.event.addListener(marker2, "dragend", function (event) {
    //alert(this.position);
    //alert(this.position.lat());
    //alert(this.position.lng());
    document.getElementById("latsec").value = this.position.lat();
    document.getElementById("lngsec").value = this.position.lng();
  }); //end addListener

  google.maps.event.addListener(map, "click", function(event)
  {
      document.getElementById("latsec").value = event.latLng.lat();
      document.getElementById("lngsec").value = event.latLng.lng();
      marker2.setPosition( new google.maps.LatLng( event.latLng.lat(), event.latLng.lng() ) );
  });

  
}



    </script>
    
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrN_DAO6nhdyD3Gk4GEG2_DDKPIHX7raQ&signed_in=true&libraries=places&callback=initMap"
        async defer></script>      

    <!-- body end here -->

<script type="text/javascript">
  function upload_document_center(tc_id)
  {
    $("#tollcation_id_hidden").val('');
    $("#upload_document").click(function(){
      //alert($("#upload_document_img").val())
      $("#error_message").text('');
      if(($("#upload_document_img").val()) == '')
      {
        alertify.error("Please Select The Image");
        return false;
      }
      else
      {
        $("#tollcation_id_hidden").val(tc_id);
        $("#document_pic").submit();

        $('#document_pic').on('submit',(function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          $.ajax({
              type:'POST',
              url: $(this).attr('action'),
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(response){
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
              },
              error: function(response,jqXHR){
                  console.log(response);
                  console.log(response.responseText);
                  var error = response.responseText
                  error = error.replace("error", "");
                  $("#img_error").append(error);
              }
          });

        }));
                   
      }
    });

  }
$(document).ready(function(){

   

    
  jQuery.validator.addMethod("validatemajorid", function(value, element) {
    var major_id_from = $("#from_major_id").val();
    var major_id_to = $("#to_major_id").val();
    if((from_major_id_single == '' && to_major_id_single == '')){
        return true;
    }
    else{
      if(from_major_id_single != to_major_id_single)
        return true
      else
        return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'Major Ids Should Not Be Same');

  jQuery.validator.addMethod("validateminorid", function(value, element) {
    var from_minor_id = $("#from_minor_id").val();
    var to_minor_id = $("#to_minor_id").val();
    if(from_minor_id_single == '' && to_minor_id_single == ''){
      return true;
    }
    else{
      if(from_minor_id_single != to_minor_id_single)
        return true
      else
        return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'Minor Ids Should Not Be Same');

  jQuery.validator.addMethod("validatefrombmtlanes", function(value, element) {
    var number_landes_from = $("#number_landes_from").val();
    var number_landes_from_bmt = $("#number_landes_from_bmt").val();
    if(number_landes_from >= number_landes_from_bmt != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'BMT Lanes Should Be Less Than The Total Number Of Lanes');

  jQuery.validator.addMethod("validatetobmtlanes", function(value, element) {
    var number_landes_from2 = $("#number_landes_from2").val();
    var number_landes_from_bmt2 = $("#number_landes_from_bmt2").val();
    if(number_landes_from2 >= number_landes_from_bmt2 != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'BMT Lanes Should Be Less Than The Total Number Of Lanes');

    $('#add_tollcenter_form').validate({
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
        from_uuid:{minlength:1,maxlength:250},
        from_major_id:{minlength:1,maxlength:10,digits:true,validatemajorid:true},
        from_minor_id:{minlength:1,maxlength:10,digits:true,validateminorid:true},
        to_uuid:{minlength:1,maxlength:250},
        to_major_id:{minlength:1,maxlength:10,digits:true,validatemajorid:true},
        to_minor_id:{minlength:1,maxlength:10,digits:true,validateminorid:true},
      },
      messages:{
                toll_location:{
                    required:"Please Enter Toll Center Location",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               address:{
                required :"Please Enter The Address",
                maxlength:"Enter Maximum 250 Characters"
               },
               toll_name:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               entry_from:{
                    required:"Please Enter Toll Entry From",
                    maxlength:"Enter Maximum 19 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               becon1:{
                    required:"Please Enter Toll Center Name",
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
});



function view_document(img_src){
  //var img_src = $(this).attr('data');
  window.location.href = img_src;


  /*var img = "<img src='"+img_src+"' alt='Document Not Uploaded'>"
  $("#pop_view1").text("");
  $("#pop_view1").append(img);*/
}

function edit_toll_center(id)
{
  window.location = "<?php echo base_url('tollcenter/updatetoll')?>/"+id;
  /*if(id !='')
  {
    $.ajax({
      "url"  : "<?php echo base_url('tollcenter/get_single_tollcenter_details');?>",
      "type" : "POST",
      "data" : ({'id':id}),
      success:function(response){
        console.log(response);
         $("#pop_view").text("");
       // var data = $.parseJSON(response);
        //console.log(response);return false;
        $("#pop_view").append(response);
        
      }
    });
  }*/
}
function view_toll_center(id)
{
  if(id !='')
  {
    $.ajax({
      "url"  : "<?php echo base_url('tollcenter/get_single_tollcenter_details_view');?>",
      "type" : "POST",
      "data" : ({'id':id}),
      success:function(response){
        console.log(response);
         $("#pop_view").text("");
       // var data = $.parseJSON(response);
        //console.log(response);return false;
        $("#pop_view").append(response);
        
      }
    });
  }
}
function delete_toll_center(id,status)
{
  alertify.confirm("Are you sure, You want to Change The Status?", function (e) {
  if (e){
          window.location.href = "<?php echo base_url('tollcenter/delete_tollcenter')?>/"+id+"/"+status;
        }
    });
}
</script>
    
