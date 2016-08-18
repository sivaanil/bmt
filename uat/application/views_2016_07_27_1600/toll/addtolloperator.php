<?php //echo "<pre>"; print_r($toll_staff_details);exit;?>
<div class="col-md-9 right_menu">
  <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="addsemiadmin" name="addsemiadmin" action="<?php echo base_url('tollcenter/addtolloperator');?>">
    
    <div class="row">
      <h4 style="padding-left: -1px !important; font-weight:normal;">Staff Details
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
          <th>Name</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <!-- <th>Role</th> -->
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
            <td id="name_<?php echo $value->ts_id ?>"><?php echo  @$value->first_name.' '.$value->last_name?></td>
            <td id="email_<?php echo $value->ts_id ?>"><?php echo  @$value->email_id?></td>
            <td id="mn_<?php echo $value->ts_id ?>"><?php echo  @$value->mobile_no?></td>
            <?php //$role_name="Toll Staff";?>
           <!--  <td><?php //echo  @$role_name?></td> -->
            <td>
              <button type="button"  onclick='view_semiadmin("<?php echo $value->ts_id ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">view</button>
              <?php if($value->status_flag == 0)?>
              <button type="button"  onclick='edit_semiadmin("<?php echo $value->ts_id ?>")' class="btn btn-success right_menu-button-small" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Edit</button>
              <button type="button" id="delete_vehicle" class="btn btn-danger right_menu-button-small" ><a href="javascript:void(0);" onclick="delete_semiadmin('<?php echo  $value->ts_id?>')"><?php if(isset($value->status_flag) && $value->status_flag ==0) echo "Inactive"; if(isset($value->status_flag) && $value->status_flag == 1) echo "Active";?></a></button>
            </td>
          </tr>
        <?php 
        }
      }
      else
      {
      ?>
      <tr><td colspan="4">No Records Found</td></tr>
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
  
$(document).ready(function(){
    $('#addsemiadmin').validate({
      rules:{
        first_name:{required: true,minlength:1,maxlength:30},
        last_name:{required: true,minlength:1,maxlength:20},
        roll:{required: true},
        eamil:{required: true,email:true,minlength:1,maxlength:100},
        mobile_number:{required: true,digits:true,minlength:10,maxlength:10},
        password:{required: true,minlength:1,maxlength:29},
      },
      messages:{
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
  alertify.confirm("Are you sure, You want to Delete?", function (e) {
  if (e) {
            window.location.href = "<?php echo base_url('tollcenter/delete_operator')?>/"+id;
        }
    });
}
</script>