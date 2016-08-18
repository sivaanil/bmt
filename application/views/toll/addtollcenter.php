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



<!-- body start here -->
<?php //echo count($toll_center_details); echo "<pre>"; print_r($toll_center_details);exit;?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" enctype="multipart/form-data" id="add_tollcenter_form" name="add_tollcenter_form" method="post" action="<?php echo base_url('tollcenter');?>">
    <div class="row">
		<div class="col-md-3">
        <div class="form-group">
            <select id="selectroadtype" name="toll_type" onchange="getAllCities()" style="margin:0 15px;">
                <option value="nh">National Highway</option>
                <option value="orr">Outer Ring Road</option>
            </select>
        </div>
            <div class="clearfix"></div>
      </div>
      
    
      <div class="col-md-3">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_location" name="toll_location"   placeholder="Toll Center Location">
      </div>
          <div class="clearfix"></div>
      </div>
      
      <div class="col-md-3">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_name" name="toll_name"  placeholder="Toll Center Name">
      </div>
          <div class="clearfix"></div>
      </div>
      
        <div class="col-md-3">
        <div class="form-group">
			
			<select style="display:none;margin:0 15px;" class="form-control" id="city" name="city"></select>
        </div>
        <div class="clearfix"></div>
      </div>
      
    </div>
   

   <!--  <div class="row">
      <div class="col-md-4 col-sm-4">
        
        <div class="form-group">
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
      </div>
      
    </div> -->

    <div class="row">
        <input id="pac-input" class="s" type="text" name="address" placeholder="Enter Your Location">
        <label>Coordinate of one side</label>
        <input type="text" id="lat" name="lat" type="text">
        <input type="text" id="lng" name="lng" type="text">
        <label>Coordinate of second side</label>
        <input type="text" id="latsec" name="latsec" type="text">
        <input type="text" id="lngsec" name="lngsec" type="text">
        <div id="map"></div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from" name="entry_from" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from" name="number_landes_from"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt" name="number_landes_from_bmt"  placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div>
          <label><input type="radio" name="nh_type1" id="nh_in_type" value="in" checked> IN <span style="color:red">Enter IN/Details (For NH IN/OUT N/A)</span><br></label>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div>
          <label><input type="checkbox" value="" id="from_beacon">Map Beacons</label>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from" style="display: none;">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_uuid" name="from_uuid"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_major_id" name="from_major_id"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_minor_id" name="from_minor_id"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from2" name="entry_from2"  placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from2" name="number_landes_from2"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt2" name="number_landes_from_bmt2"  placeholder="No. of BMT Lanes">
        </div>
      </div>
       <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div>
          <label><input type="radio" name="nh_type2" value="out" checked> OUT <span style="color:red">Enter OUT/Details (For NH IN/OUT N/A)</span><br></label>
        </div>
      </div>
       <div class="col-md-4 col-sm-4">
       	<div class="checkbox">
          <label><input  type="checkbox" value="" id="to_id">Map Beacons</label>
        </div>
      </div>
    </div>
     <div class="row" id="beacon_to" style="display: none;">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_uuid" name="to_uuid"  placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_major_id" name="to_major_id"  placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_minor_id" name="to_minor_id"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <div id="fororr" style="display:none">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_entry_from" name="orr_entry_from" placeholder="Entry From">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_number_landes_from" name="orr_number_landes_from"  placeholder="No. of Lanes">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_number_landes_from_bmt" name="orr_number_landes_from_bmt"  placeholder="No. of BMT Lanes">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div>
          <label><input type="radio" name="orr_type1" value="in" checked> IN <span style="color:red">Enter IN/Details (For NH IN/OUT N/A)</span><br></label>
        </div>
      </div>
            <div class="col-md-4 col-sm-4">
                <div class="checkbox">
                    <label><input type="checkbox" value="" id="orr_from_beacon">Map Beacons</label>
                </div>
            </div>
        </div>
        <div class="row" id="orr_beacon_from" style="display: none;">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_from_uuid" name="orr_from_uuid"  placeholder="Beacon UUID">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_from_major_id" name="orr_from_major_id"  placeholder="Beacon Major Id">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr_from_minor_id" name="orr_from_minor_id"  placeholder="Beacon Minor Id">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_entry_from2" name="orr1_entry_from2"  placeholder="Entry From">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_number_landes_from2" name="orr1_number_landes_from2"  placeholder="No. of Lanes">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_number_landes_from_bmt2" name="orr1_number_landes_from_bmt2"  placeholder="No. of BMT Lanes">
                </div>
            </div>
              <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div>
          <label><input type="radio" name="orr_type2" value="out" checked> OUT <span style="color:red">Enter OUT/Details (For NH IN/OUT N/A)</span><br></label>
        </div>
      </div>
            <div class="col-md-4 col-sm-4">
                <div class="checkbox">
                    <label><input  type="checkbox" value="" id="orr1_to_id">Map Beacons</label>
                </div>
            </div>
        </div>
        <div class="row" id="orr_beacon_to" style="display: none;">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_to_uuid" name="orr1_to_uuid"  placeholder="Beacon UUID">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_to_major_id" name="orr1_to_major_id"  placeholder="Beacon Major Id">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="orr1_to_minor_id" name="orr1_to_minor_id"  placeholder="Beacon Minor Id">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
	       <div class="col-md-9 col-sm-9">
			   		  <span style="color:red;font-size:12px">Note: Toll center type and city cannot be modified once created</span><br/>
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


  <div class="row">
    <table class="table" style="width:93%; margin-left:3.5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <th>Toll Center Location</th>
          <th>Toll Center Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php 

       if(!empty($toll_center_details))
        { 
          //pd($toll_center_details);
          foreach (@$toll_center_details as $key => $value) 
          {
            ?>
          <tr>
            <td id="tl_<?php echo $value->tc_id; ?>"><?php echo $value->tc_location;?></td>
            <td id="tn_<?php echo $value->tc_id; ?>"><?php echo $value->tc_name;?></td>
            <td>
              <button type="button"  onclick='view_toll_center("<?php echo $value->tc_id; ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <button type="button"  onclick='edit_toll_center("<?php echo $value->tc_id; ?>")' class="btn btn-success right_menu-button-small">Edit</button>
              <a href="javascript:void(0);" onclick="delete_toll_center(<?php echo $value->tc_id.','.$value->status_flag ?>)"><button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><?php if(isset($value->status_flag) && $value->status_flag == 0) echo "InActivate"; if(isset($value->status_flag) && $value->status_flag == 1) echo "Activate";?></button></a>
              <button type="button"  onclick='upload_document_center("<?php echo $value->tc_id; ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModa3" data-whatever="@getbootstrap">Upload</button>
              <?php
              if(isset($value->image_url) && $value->image_url != '')
              {
                ?>
                 <!-- <button type="button" onclick='view_document("<?php //echo @$value->image_url?>")'  class="btn btn-danger right_menu-button-small"  data-toggle="modal" data-target="#exampleModa2" data-whatever="@getbootstrap">View</button> -->
                 <!-- <button type="button"   class="btn btn-danger right_menu-button-small"><a href="<?php //echo base_url('tollcenter/downloaddocument/'.$value->tc_id);?>">Download</a></button> -->
                 <button type="button"   class="btn btn-danger right_menu-button-small" onclick="download('<?php echo $value->tc_id?>')">Download</a></button>
                <?php 
              }
              ?>
            </td>
          </tr>
          <?php
          }
        }
        else
        {
        ?>
        <tr><td colspan="3">No Records Found</td></tr>
        <?php
        }
      ?>
      </tbody>
    </table>
  </div>
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

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-header">
      <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
      <h4 class="modal-title" id="exampleModalLabel3" style="color:#000; font-weight:normal;">Upload</h4>
    </div>
    <div class="modal-body" id="pop_view3" style="color:#000; font-weight:normal;">
      <form action="<?php echo base_url('tollcenter/uploaddocument' )?>" id="document_pic" method="post" enctype="multipart/form-data" name="document_pic">
        <input type="file" name="upload_document_img" id="upload_document_img"> 
        <input type="hidden"  name="tollcation_id_hidden" id="tollcation_id_hidden" value="">
        <div class="modal-footer">
          <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_upload">Cancel</button>
          <input type="button" class="btn save_changes pull-right common-btn-pass" value="Upload" name="upload_document" id="upload_document" style="padding:8px 20px; font-size:12px; font-weight:normal;">
        </div>
      </form>     
        <span id"error_message" style="color:red"></span>
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
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 22.817403, lng: 76.820855},
    zoom: 3
  });
  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(22.817403, 76.820855),
    draggable : true,
    visible: true
  });
  marker.setMap(map);

  var marker2 = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0.000, 0.0000),
    draggable : true,
    visible: true
  });
  marker2.setMap(map);

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
    /*document.getElementById("lat").value = event.latLng.lat();
    document.getElementById("lng").value = event.latLng.lng();
    marker.setPosition( new google.maps.LatLng( event.latLng.lat(), event.latLng.lng() ) );*/
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
    $("#selectroadtype").on('change',function(){
        if($("#selectroadtype").val()=='orr'){
            $("#fororr").show();
        }else {
            $("#fororr").hide();
        }
    })
    $("#orr_from_beacon").on('change',function(){
        if($(this).is(":checked")) {
            $("#orr_beacon_from").show();
        }else{
            $("#orr_beacon_from").hide();
        }
    })
    $("#orr1_to_id").on('change',function(){
        if($(this).is(":checked")) {
            $("#orr_beacon_to").show();
        }else{
            $("#orr_beacon_to").hide();
        }
    })
    $("#remove_file").click(function(){
      $("#document").val("");
    });


    $("#from_beacon").click(function(){

      if ($('#beacon_from').css('display') == 'none') 
      {
        $('#beacon_from').show()
      }
      else{
        $('#beacon_from').hide();
      }
      
   });

  $("#to_id").click(function(){

      if ($('#beacon_to').css('display') == 'none') 
      {
        $('#beacon_to').show()
      }
      else{
        $('#beacon_to').hide();
      }
      
   });
  jQuery.validator.addMethod("validatemajorid", function(value, element) {
    var major_id_from = $("#from_major_id").val();
    var major_id_to = $("#to_major_id").val();
    if(major_id_from != major_id_to != ''){
      return true;
    }
    else{
      return false;
    }
    //return this.optional( element ) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-. ]+$/.test( value ) || /^[0-9]{10,10}$/.test(value);
  }, 'Major Ids Should Not Be Same');

  jQuery.validator.addMethod("validateminorid", function(value, element) {
    var from_minor_id = $("#from_minor_id").val();
    var to_minor_id = $("#to_minor_id").val();
    if(from_minor_id != to_minor_id != ''){
      return true;
    }
    else{
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

	jQuery.validator.addMethod("validatecity", function(value, element) {
    var tolltype = $("#selectroadtype").val();
    var city = $("#city").val();
    if(tolltype == 'orr' && city !=''){
	  return true;
    }
    else{
      return false;
    }
  }, 'Please select city');
  
    $('#add_tollcenter_form').validate({
      rules:{
        toll_location:{required: true,minlength:1,maxlength:19},
        selectroadtype:{required: true},
        city:{validatecity:true},
        //address:{required:true,maxlength:250},
        toll_name:{required: true,minlength:1,maxlength:19},
        entry_from:{required: true,minlength:1,maxlength:19},
        becon1:{required: true,minlength:1,maxlength:19},
        number_landes_from:{required: true,minlength:1,maxlength:9,digits:true},
        number_landes_from_bmt:{required: true,digits:true,minlength:1,maxlength:9,validatefrombmtlanes:true},
       // entry_from2:{required: true,minlength:1,maxlength:19},
        becon2:{required: true,minlength:1,maxlength:19},
      //  number_landes_from2:{required: true,minlength:1,maxlength:9,digits:true},
       // number_landes_from_bmt2:{required: true,digits:true,minlength:1,maxlength:9,validatetobmtlanes:true},
        from_uuid:{required: true,minlength:1,maxlength:250},
        from_major_id:{required: true,minlength:1,maxlength:10,digits:true,validatemajorid:true},
        from_minor_id:{required: true,minlength:1,maxlength:10,digits:true,validateminorid:true},
        to_uuid:{required: true,minlength:1,maxlength:250},
        to_major_id:{required: true,minlength:1,maxlength:10,digits:true,validatemajorid:true},
        to_minor_id:{required: true,minlength:1,maxlength:10,digits:true,validateminorid:true},
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

function getAllCities(){
	var tolltype = $("#selectroadtype").val();
	if(tolltype =='orr'){
			$("#city").show();
			$.ajax({
				"url":"<?php echo base_url('tollcenter/getAllCities'); ?>",
				"type" : "GET",
				success:function(data){
				   console.log(data);
				   $('#city').html(data);
				   $('#city').show();
				},
				error:function(err){
				   
				}
			   });
	}else{
		$('#city').hide();
	}
}    
</script>
