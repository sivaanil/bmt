<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  1.8.8   |
    |              on 2016-07-01 19:11:42              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
 goto nUpJH; bRmyi: echo @$O8clp->XI1uE->isgjQ["\60"]->UglIS; goto KbW42; xr8yr: ?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" enctype="multipart/form-data" id="add_tollcenter_form" name="add_tollcenter_form" method="post" action="<?php  goto vmMV3; DRKM4: $O8clp = @$O8clp->BFINK; goto NxZ6N; DUHF_: echo @$O8clp->VTpzy; goto rXU6A; tYmBF: echo $this->YpJyb->UZWzr("\x65\x72\162\x6f\x72\x6d\163\x67"); goto K3cp_; M3zTm: goto LBffZ; goto YBZ32; YNHam: p1mMa: goto zn2Jb; htJsJ: ?>
" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_to_minor_id" name="orr1_to_minor_id" value="<?php  goto UMRAL; b7iB5: goto JKLrZ; goto UuR6L; vsHEK: ?>
">
        <label>Coordinate of second side</label>
        <input type="text" id="latsec" name="latsec" type="text" value="<?php  goto DUHF_; aO1rW: echo Ksfh8("\x74\157\x6c\154\143\145\x6e\164\145\162\x2f\144\x65\x6c\x65\x74\x65\137\x74\157\x6c\154\143\145\156\x74\x65\x72"); goto gE1on; Oo2XC: ?>
"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt2" name="number_landes_from_bmt2" value="<?php  goto p4HjQ; qjVDz: echo @$O8clp->VTpzy; goto KaENE; OBrMe: ?>
;
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
  window.location = "<?php  goto xHghz; yAtNR: ?>
</span>
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
  window.location = "<?php  goto zl_6N; KcIGR: ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="orr_from_uuid" id="orr_from_uuid" value="<?php  goto bRmyi; fCktH: ?>
">
    <input type="hidden" name="toll_id" id="toll_id" value="<?php  goto dVdl8; Ah384: echo @$O8clp->XI1uE->ZVA4T->kisda; goto zIduY; fMm3c: ?>
          <label><input type="radio" name="orr_type1" value="in" checked> IN	<input type="radio" name="orr_type1" value="out"> OUT <br></label>
          <?php  goto OsiUE; y7BpN: ?>
" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_minor_id" name="from_minor_id" value="<?php  goto kYdqS; dVdl8: echo @$O8clp->q9pm2; goto GsaYc; wL_EL: ?>
">
            <input type="text" class="form-control" id="from_uuid" name="from_uuid" value="<?php  goto nX1T5; zl_6N: echo ksFH8("\164\157\154\154\143\x65\x6e\x74\145\x72\x2f\x64\157\167\x6e\154\157\x61\x64\144\x6f\143\165\x6d\x65\x6e\x74"); goto zSqAn; oz7AP: echo @$O8clp->XI1uE->isgjQ["\60"]->KLk40; goto IH7fc; mJ6kB: ?>
/"+id;
  /*if(id !='')
  {
    $.ajax({
      "url"  : "<?php  goto zjIPB; sL6SD: echo @$O8clp->U7PBZ; goto q0jzK; lq82Z: echo @$O8clp->CdqDF; goto UXZ4r; K3cp_: ?>
</span>
          <span class="text-center won_success"><?php  goto Dmu9h; UMRAL: echo @$O8clp->XI1uE->isgjQ["\x31"]->RtZK9; goto aw7CH; phqpT: echo @$O8clp->ok0iK; goto x8IKb; ms4am: ?>
">
          <input type="text" class="form-control" id="orr1_entry_from2" name="orr1_entry_from2" value="<?php  goto cHMiG; uXlXK: ?>
" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from" name="number_landes_from" value="<?php  goto tkbGe; iK36V: echo @$O8clp->Ah1Rr; goto Oo2XC; SYDWt: echo QyO48(); goto KfzT_; VQHrD: echo @$O8clp->Mu_8f; goto cnKJv; j77wp: ?>
" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php  goto zTiMJ; UXZ4r: ?>
;
  var db_latsec = <?php  goto qjVDz; U4FT1: echo @$O8clp->XI1uE->ZVA4T->RtZK9; goto LmxIJ; Zy3Bd: ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="orr1_to_uuid" id="orr1_to_uuid" value="<?php  goto oQC0E; e0VXn: ?>
" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_major_id" name="to_major_id" value="<?php  goto B63L3; wcxpP: echo @$O8clp->VOVyy; goto O2j6E; rHKXy: echo @$O8clp->XI1uE->hgzYf->KLk40; goto y7BpN; f29s8: ?>
"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    
    
    
     <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
		  <input class="form-control" type="hidden" name="orr_to_uuid_id" id="to_uuid_id_single" value="<?php  goto nVWPW; KfzT_: ?>
</span>
          <span class="text-center won_error"><?php  goto tYmBF; mFe2O: echo @$O8clp->ok0iK; goto OBrMe; u1IpT: vaAgn: goto mQIVT; KbW42: ?>
">
            <input type="text" class="form-control" id="orr_from_uuid" name="orr_from_uuid" value="<?php  goto AZeO3; KaENE: ?>
;
  var db_lngsec = <?php  goto mFe2O; TknKE: ?>
    		 <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
		  <input class="form-control" type="hidden" name="orr_from_uuid_id" id="from_uuid_id_single" value="<?php  goto w9YvR; NirV6: ?>
"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_number_landes_from_bmt" name="orr_number_landes_from_bmt" value="<?php  goto XKyJ6; YEpvX: echo @$O8clp->iGoqe; goto Xbaos; CDPDZ: if (@$O8clp->XI1uE->isgjQ["\60"]->i6nFs == "\111\x4e") { goto g9jMt; } goto Uwe75; E0Di6: echo @$O8clp->Nb6y_; goto xybBb; rXU6A: ?>
">
        <input type="text" id="lngsec" name="lngsec" type="text" value="<?php  goto phqpT; B63L3: echo @$O8clp->XI1uE->ZVA4T->KLk40; goto a67zM; EwczN: if (@$O8clp->XI1uE->isgjQ["\x31"]->i6nFs == "\x49\x4e") { goto IdayN; } goto hPKQw; zjIPB: echo KSFh8("\x74\157\x6c\154\x63\x65\x6e\164\145\x72\x2f\x67\x65\164\137\163\x69\x6e\147\x6c\x65\x5f\x74\157\154\154\x63\x65\x6e\164\145\162\137\144\145\164\141\x69\154\x73"); goto TM2b6; tkbGe: echo @$O8clp->F4qVx; goto UPMcG; G03p9: echo @$O8clp->t4Llz; goto tttIC; QnQhx: echo @$O8clp->XI1uE->isgjQ["\x30"]->RtZK9; goto f29s8; UuR6L: g9jMt: goto fMm3c; q0jzK: ?>
" placeholder="No. of BMT Lanes">
        </div>
      </div>
      
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php  goto EwczN; Am09q: ?>
    
    
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
           <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
          </div>
          <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
          <span style="color:red;"><?php  goto SYDWt; jXTQZ: ?>
">
        <input type="text" id="lng" name="lng" value="<?php  goto C84rS; S2xjZ: Oc8EE: goto IenPE; Xbaos: ?>
;
  var db_lng = <?php  goto lq82Z; d82dx: ?>
">
          <input type="text" class="form-control" id="orr_entry_from" name="orr_entry_from" value="<?php  goto G03p9; AZeO3: echo @$O8clp->XI1uE->isgjQ["\x30"]->UglIS; goto rbGrz; LmxIJ: ?>
" placeholder="Beacon Minor Id">
        </div>
      </div>
      
    </div>
  
    
    
    
    <?php  goto naPls; IenPE: ?>
        </div>
      </div>
    </div>
    <div class="row" id="beacon_from">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="from_uuid_id" id="from_uuid_id_single" value="<?php  goto Y6hVq; mQIVT: ?>
          <label><input type="radio" name="nh_type1" id="nh_in_type" value="in" checked> IN	<input type="radio" name="nh_type1" id="nh_out_type" value="out"> OUT <br></label>
          <?php  goto S2xjZ; Fta4R: ?>
          <label><input type="radio" name="orr_type2" value="in" checked> IN	<input type="radio" name="orr_type2" value="out"> OUT <br></label>
          <?php  goto RkjW9; nUpJH: ?>
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

<?php  goto DRKM4; kYdqS: echo @$O8clp->XI1uE->hgzYf->RtZK9; goto nHwc1; JjlKR: ?>
" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_number_landes_from2" name="orr1_number_landes_from2" value="<?php  goto VQHrD; pNxA_: ?>
" placeholder="Enter Your Location">
        <label>Coordinate of one side</label>
        <input type="text" id="lat" name="lat" value="<?php  goto oUXaf; aw7CH: ?>
"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <?php  goto ubdQ_; eQFX6: ?>
">
    <input type="hidden" name="toll_type_id" id="toll_type_id" value="<?php  goto alKrD; zDa3S: $xnHUE = @$O8clp->VkXq_ == 1 ? "\116\x61\x74\151\157\x6e\141\154\40\110\x69\x67\x68\x77\x61\x79" : "\x4f\165\164\145\162\40\122\x69\x6e\147\x72\157\x61\144"; goto UlKLC; tttIC: ?>
" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_number_landes_from" name="orr_number_landes_from" value="<?php  goto oFeGX; xHghz: echo kSFh8("\x74\x6f\154\154\x63\x65\x6e\164\145\162\x2f\x75\x70\144\141\164\x65\x74\157\154\x6c"); goto mJ6kB; Io230: echo @$O8clp->xKeDd; goto pNxA_; YBZ32: IdayN: goto Fta4R; OsiUE: JKLrZ: goto KcIGR; ubdQ_: THdUl: goto Am09q; Dmu9h: echo $this->YpJyb->uzWZR("\155\163\147"); goto yAtNR; UlKLC: echo $xnHUE; goto kXNGk; XKyJ6: echo @$O8clp->MgeO4; goto WdsZm; ut93h: rBXYn: goto yhGyB; cnKJv: ?>
"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_number_landes_from_bmt2" name="orr1_number_landes_from_bmt2" value="<?php  goto sL6SD; sjJ3J: ?>
">
            <input type="text" class="form-control" id="orr1_to_uuid" name="orr1_to_uuid" value="<?php  goto rhse7; t8v_V: ?>
" placeholder="Entry From">
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from2" name="number_landes_from2" value="<?php  goto iK36V; oUXaf: echo @$O8clp->iGoqe; goto jXTQZ; oFeGX: echo @$O8clp->wXCGj; goto NirV6; UPMcG: ?>
"  placeholder="No. of Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="number_landes_from_bmt" name="number_landes_from_bmt" value="<?php  goto wcxpP; w9YvR: echo @$O8clp->XI1uE->isgjQ["\60"]->kisda; goto d82dx; kXNGk: ?>
</span></div>
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
        <input id="pac-input" class="s" type="text" name="address" value="<?php  goto Io230; nX1T5: echo @$O8clp->XI1uE->hgzYf->UglIS; goto ri9NZ; O2j6E: ?>
" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php  goto WOpUf; rbGrz: ?>
" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_from_major_id" name="orr_from_major_id" value="<?php  goto oz7AP; fnTEu: goto p1mMa; goto ut93h; IH7fc: ?>
" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr_from_minor_id" name="orr_from_minor_id" value="<?php  goto QnQhx; zTiMJ: if (!empty(@$O8clp->XI1uE) && @$O8clp->XI1uE->ZVA4T->i6nFs == "\111\116") { goto rBXYn; } goto X4wRc; Uwe75: ?>
          	<label><input type="radio" name="orr_type1" value="in"> IN	<input type="radio" name="orr_type1" value="out" checked> OUT <br></label>
          	<?php  goto b7iB5; zIduY: ?>
">
            <input type="text" class="form-control" id="to_uuid" name="to_uuid" value="<?php  goto uFXlQ; zSqAn: ?>
/"+id;
}
 
 $("#cancel_upload").click(function(){
  location.reload();
});
function initMap() {
  var db_lat = <?php  goto YEpvX; alKrD: echo @$O8clp->VkXq_; goto fCktH; OHG9L: echo @$O8clp->HIkuN; goto pIw76; x8IKb: ?>
">
        <div id="map"></div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from" name="entry_from" value="<?php  goto ZBtmY; lrw8p: ?>
" placeholder="Beacon UUID">
        </div>
      </div>
      
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="orr1_to_major_id" name="orr1_to_major_id" value="<?php  goto UCBuk; WOpUf: if (!empty($O8clp->XI1uE) && $O8clp->XI1uE->hgzYf->i6nFs == "\x49\116") { goto vaAgn; } goto sDe_6; uFXlQ: echo @$O8clp->XI1uE->ZVA4T->UglIS; goto e0VXn; RkjW9: LBffZ: goto Zy3Bd; oQC0E: echo @$O8clp->XI1uE->isgjQ["\61"]->UglIS; goto sjJ3J; GsaYc: ?>
">
    <div class="row">
      <div class="col-md-4 col-sm-4">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_location" name="toll_location" value="<?php  goto OHG9L; ri9NZ: ?>
" placeholder="Beacon UUID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="from_major_id" name="from_major_id" value="<?php  goto rHKXy; VVsuQ: ?>
",
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
          window.location.href = "<?php  goto aO1rW; C84rS: echo @$O8clp->CdqDF; goto vsHEK; zn2Jb: ?>
        </div>
      </div>
      
    </div>
     <div class="row" id="beacon_to">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input class="form-control" type="hidden" name="to_uuid_id" id="to_uuid_id_single" value="<?php  goto Ah384; xybBb: ?>
"  placeholder="Toll Center Name">
      </div>
      </div>
      <div class="col-md-4 col-sm-4"><span style="color: red"><?php  goto zDa3S; Gv9Tk: echo KSFH8("\164\157\x6c\154\143\145\x6e\x74\x65\x72\x2f\x67\x65\164\x5f\x73\151\156\147\x6c\145\x5f\x74\x6f\154\154\x63\145\x6e\x74\145\162\137\x64\145\x74\x61\151\154\163\x5f\x76\151\145\167"); goto VVsuQ; naPls: if (!(@$O8clp->VkXq_ == "\62")) { goto THdUl; } goto TknKE; ZBtmY: echo @$O8clp->KEmii; goto uXlXK; yhGyB: ?>
          <label><input type="radio" name="nh_type2" value="in" checked> IN	<input type="radio" name="nh_type2" value="out"> OUT <br></label>
        <?php  goto YNHam; WdsZm: ?>
" placeholder="No. of BMT Lanes">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Type:</label>
        <div><?php  goto CDPDZ; TM2b6: ?>
",
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
      "url"  : "<?php  goto Gv9Tk; p4HjQ: echo @$O8clp->WYrjy; goto j77wp; sDe_6: ?>
          	<label><input type="radio" name="nh_type1" id="nh_in_type" value="in"> IN	<input type="radio" name="nh_type1" id="nh_out_type" value="out" checked> OUT <br></label>
          	<?php  goto SBr2T; UCBuk: echo @$O8clp->XI1uE->isgjQ["\x31"]->KLk40; goto htJsJ; X4wRc: ?>
        	<label><input type="radio" name="nh_type2" value="in"> IN	<input type="radio" name="nh_type2" value="out" checked> OUT <br></label>
        	<?php  goto fnTEu; HXTld: echo @$O8clp->Ir9sG; goto t8v_V; hPKQw: ?>
          	<label><input type="radio" name="orr_type2" value="in"> IN	<input type="radio" name="orr_type2" value="out" checked> OUT <br></label>
          	<?php  goto M3zTm; Y6hVq: echo @$O8clp->XI1uE->hgzYf->kisda; goto wL_EL; vmMV3: echo KsFH8("\164\157\x6c\x6c\143\x65\x6e\164\x65\x72\57\165\160\144\141\x74\x65\164\157\154\x6c"); goto eQFX6; cHMiG: echo @$O8clp->GsOfB; goto JjlKR; a67zM: ?>
" placeholder="Beacon Major Id">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="to_minor_id" name="to_minor_id" value="<?php  goto U4FT1; SBr2T: goto Oc8EE; goto u1IpT; pIw76: ?>
" placeholder="Toll Center Location">
      </div>
      </div>
      <div class="col-md-4 col-sm-4">
      <div class="form-group">
          <input type="text" class="form-control" id="toll_name" name="toll_name" value="<?php  goto E0Di6; rhse7: echo @$O8clp->XI1uE->isgjQ["\x31"]->UglIS; goto lrw8p; nVWPW: echo @$O8clp->XI1uE->isgjQ["\61"]->kisda; goto ms4am; NxZ6N: ?>

<!-- body start here -->
<?php  goto xr8yr; nHwc1: ?>
"  placeholder="Beacon Minor Id">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
      <div class="form-group">
          <input type="text" class="form-control" id="entry_from2" name="entry_from2" value="<?php  goto HXTld; gE1on: ?>
/"+id+"/"+status;
        }
    });
}
</script>
