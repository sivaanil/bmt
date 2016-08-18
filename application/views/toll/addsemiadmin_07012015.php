<?php //echo "<pre>"; print_r($toll_staff_details);exit;?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addsemiadmin" name="addsemiadmin" action="<?php echo base_url('tollcenter/addsemiadmin');?>">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction" onchange="getcentername()">
        <option value="">Toll Center Location</option>
        <?php
        if(isset($toll_location) && !empty($toll_location))
        {
          foreach ($toll_location as $key => $value) {
            ?>
            <option value="<?php echo @$value->tc_id;?>"><?php echo @$value->tc_location?></option>
            <?PHP
          }
        }
        else
        {
          ?>
          <option value="">NO Toll Center Location</option>
          <?php
        }
        ?>
        </select>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_name" name="toll_center_name" onchange="gettcn()">
            <option value="">Toll Center Name</option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <input type="hidden" class="form-control" id="tcn" name="tcn" placeholder="TCN" readonly="off">
        </div>
      </div>
    </div>
    <div class="row">
      <h4 style="padding-left: -1px !important; font-weight:normal;">Semi Admin Details
      </h4>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
        </div>
      </div>
      <!-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="" placeholder="Profile Effective Date">
        </div>
      </div> -->
    </div>
      
    <div class="row">
      
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <!-- <input type="text" class="form-control" id="inputtext3" placeholder="Role"> -->
           <select style="margin-top:0; width:100%;" class="form-control" id="roll" name="roll">
            <option value="">Select Role</option>
            <option value="3">Semi Admin</option>
            <option value="2">Admin</option>
          </select>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="eamil" name="eamil" placeholder="Email ID">
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="form-group">
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
        </div>
      </div>
    </div>
    <div class="row">
     <div class="col-md-4 col-sm-4">
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      </div>
      
    </div>
    <div class="row">
      <div class="form-group">
        <div class="col-sm-9">
          <div class="row">
           <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
          </div>
          <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
            <span style="color:red;"><?php echo validation_errors(); ?></span>
            <span id="error_message" class="text-center won_error"><?php echo $this->session->flashdata('errormsg');?></span>
            <span class="text-center"><?php echo $this->session->flashdata('msg');?></span>
            
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center" style="color:#090;"></div>
   </form>
    
  <div class="row">
    <table class="table" style="width:90%; margin-left:5%; border: 1px #DDD solid;">
      <thead>
        <tr>
          <th>Toll Center Location</th>
          <th>Toll Center Name</th>
          <th>Name</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      if(isset($toll_staff_details) && !empty($toll_staff_details))
      {
        foreach (@$toll_staff_details as $key => $value) 
        {
          //pd($value);
         ?>
          <tr>
            <td><?php echo  @$value->tc_location?></td>
            <td><?php echo  @$value->tc_name?></td>
            <td><?php echo  @$value->first_name.' '.$value->last_name?></td>
            <?php if($value->roll_id == 3) $role_name="Semi Admin"; if($value->roll_id == 2) $role_name="Admin";?>
            <td><?php echo  @$role_name?></td>
            <td>
              <button type="button"  onclick='view_semiadmin("<?php echo $value->ts_id ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">View</button>
              <?php
              if($value->status_flag == 0)
              {
                ?>
              <button type="button"  onclick='edit_semiadmin("<?php echo $value->ts_id ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
                <?php
              }
              ?>
              <a href="javascript:void(0);" onclick="delete_semiadmin('<?php echo  $value->ts_id.','.$value->status_flag?>')"><button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><?php if(isset($value->status_flag) && $value->status_flag ==0) echo "Inactive"; if(isset($value->status_flag) && $value->status_flag == 1) echo "Active";?></button></a>
            </td>
          </tr>
        <?php 
        }
      }
      else
      {
      ?>
      <tr><td colspan="5">No Records Found</td></tr>
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
      </div>
      
    </div>
  </div>
</div>

<script>
  function getcentername() {
    var location_id = $("#toll_center_loaction").val();
    $("#tcn").val('');
    $("#toll_center_name").html('');
    if(location_id != '')
    {
      $.ajax({
            "url":"<?php echo base_url('tollcenter/gettollcentername');?>",
            "type" : "POST",
            "data" :({'location_id':location_id}),
            success:function(response){
              $("#toll_center_name").append(response);
            }
           });
    }
    else{
      $("#toll_center_name").append('<option value="">Toll Center is InActive</option>');
    }

    // body...
  }

  function gettcn(){
    $("#tcn").val('');
    var toll_center_name = $("#toll_center_name").val();
    //alert(toll_center_name);
    $.ajax({
            "url":"<?php echo base_url('tollcenter/gettcn');?>",
            "type" : "POST",
            "data" :({'toll_center_name':toll_center_name}),
            success:function(response){
              var obj = $.parseJSON(response);
              if( obj.statuscode == 200 )
              {
               $("#tcn").val(obj.response.tc_id);
              }
              else{
                $("#error_message").text(obj.error[0]);
              }
            }
          });
  }

$(document).ready(function(){
    $('#addsemiadmin').validate({
      rules:{
        toll_center_loaction:{required: true,minlength:1,maxlength:30},
        toll_center_name:{required: true,minlength:1,maxlength:20},
        first_name:{required: true,minlength:1,maxlength:30},
        last_name:{required: true,minlength:1,maxlength:20},
        roll:{required: true},
        eamil:{required: true,email:true,minlength:1,maxlength:100},
        mobile_number:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true,minlength:1,maxlength:29},
        tcn:{required: true},
      },
      messages:{
                toll_center_loaction:{
                    required:"Please Enter Toll Center Location",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               toll_center_name:{
                    required:"Please Enter Toll Center Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               first_name:{
                    required:"Please Enter First Name",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               last_name:{
                    required:"Please Enter Last Name",
                    maxlength:"Enter Maximum 20 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               roll:{
                    required:"Please Select Role",
               },
               eamil:{
                    required:"Please Enter Email",
                    email:"Enter Valid Email",
                    maxlength:"Enter Maximum 30 Characters",
                    minlength:"Enter Minimum 1 Characters",
               },
               mobile_number:{
                    required:"Please Enter Mobile Number",
                    digits:"Enter Only Digits",
                    maxlength:"Enter Maximum 10 Digits",
                    minlength:"Enter Minimum 10 Digits"
               },
               password:{
                    required:"Please Enter Password",
                    maxlength:"Enter Maximum 29 Characters",
                    minlength:"Enter Minimum 1 Characters"
               },
               tcn:{
                    required:"Please Enter Toll Center Number",
                    maxlength:"Enter Maximum 19 Characters",
               },
              
      },
      tooltip_options: {
        _all_: {placement:'bottom',html:true,trigger:'focus'}
      }
    });
});
function edit_semiadmin(id)
{
  if(id !='')
  {
    $.ajax({
      "url"  : "<?php echo base_url('tollcenter/get_single_semiadmin');?>",
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
function view_semiadmin(id)
{
  if(id !='')
  {
    $.ajax({
      "url"  : "<?php echo base_url('tollcenter/get_single_semiadmin_view');?>",
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
function delete_semiadmin(id)
{
  var res = id.split(",");
  var id = res[0];
  var status = res[1];
  alertify.confirm("Are You Sure ,You Want To Change The Status?", function (e) {
  if (e) {
            window.location.href = "<?php echo base_url('tollcenter/delete_semiadmin')?>/"+id+"/"+status;
        }
    });
}
</script>