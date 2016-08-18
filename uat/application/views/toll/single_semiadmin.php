<?php
//  echo "<pre>";print_r($semiadmin_details);//exit;
//  echo "<pre>";print_r($listTollCenterLocations);echo "</pre>";exit;
//echo $this->role_id;exit;
?>
<div class="modal-header">
  <!-- <button type="button" id="close_id" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
    <h4 class="modal-title" id="exampleModalLabel" style="color:#000; font-weight:normal;">Edit</h4>
</div>
<div class="modal-body" style="padding: 15px 15px 50px 15px;">
    <form name="update_semiadmin" id="update_semiadmin">
        <input type="hidden" name="update_id" id="update_id" value="<?php echo @$semiadmin_details->ts_id; ?>">
        <div class="form-group">
            <?php
            if ($this->role_id == 1) {
                ?>
                <input type="hidden" name="tolltype" id="tolltype_single" value="<?php echo @$semiadmin_details->toll_type_id; ?>">
                <?php
                if ($semiadmin_details->toll_type_id == 1) {
                    ?>
                    <select  style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction" onchange="getcentername_single()">
                        <option value="<?php echo $semiadmin_details->tc_location; ?>"><?php echo @$semiadmin_details->tc_location ?></option>
                    </select>
                    <?php
                } else {
                    ?>
                    <select multiple style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction[]" onchange="getcentername_single()">
                        <?php
                        foreach ($semiadmin_details->TollCenterData as $key => $value) {
                            ?>
                            <option <?php echo (in_array($value->tc_id, explode(',', $semiadmin_details->tc_id))) ? "selected" : ""; ?> value="<?php echo $value->tc_id; ?>"><?php echo @$value->city . " - " . @$value->tc_location . " - " . @$value->tc_name; ?></option>
                        <?php }
                        ?>

                    </select>
                    <?php
                }
            }

            if ($this->role_id == 3) {
                ?>
                <input type="hidden" name="tolltype" id="tolltype_single" value="<?php echo @$listTollCenterLocations->TollCenterDetails[0]->toll_type_id;
            ; ?>">
                <?php
                if ($listTollCenterLocations->TollCenterDetails[0]->toll_type_id == 2) {
                    ?>
                    <select  style="color:#0C0C0C;" class="form-control" id="toll_center_loaction_single" name="toll_center_loaction">
                        <?php
                        foreach ($listTollCenterLocations->TollCenterDetails as $key => $value) {
                            ?>
                            <option <?php echo ($semiadmin_details->tc_id == $value->tc_id) ? "selected" : ""; ?> value="<?php echo @$value->tc_id; ?>"><?php echo @$value->city . " - " . @$value->tc_location . " - " . @$value->tc_name; ?></option>
                        <?php }
                        ?>
                    </select>
                    <?php
                }
            }
            ?>
        </div>
        <div class="form-group">
            <?php
            if ($this->role_id == 1 && $semiadmin_details->toll_type_id == 1) {
                ?>
                <select style="color:#0C0C0C;" class="form-control" id="toll_center_name_single" name="toll_center_name" onchange="gettcn_single()">
                    <option value="<?php echo @$semiadmin_details->tc_name ?>"><?php echo $semiadmin_details->tc_name ?></option>
                </select>
                <?php
            }
            ?>
        </div>
        <div class="form-group">
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo @$semiadmin_details->tc_id ?>"  id="tcn_single" name="tcn" placeholder="TCN" style="background-color: #FFFFFF;" readonly="off">
            </div>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control" id="first_name_single" name="first_name" value="<?php echo @$semiadmin_details->first_name ?>" placeholder="First Name">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="last_name_single" name="last_name" value="<?php echo @$semiadmin_details->last_name ?>" placeholder="Last Name">
            </div>
            <?php
            if ($this->role_id == 1) {
                ?>
                <div class="form-group">
                        <!-- <input type="text" class="form-control" id="inputtext3" placeholder="Role"> -->
                    <select style="color:#0C0C0C;" class="form-control" id="roll_single" name="roll">
                        <option value="3"<?php if (isset($semiadmin_details->roll_id) && @$semiadmin_details->roll_id == 3) echo "selected"; ?>>Semi Admin</option>
                        <option value="2" <?php if (isset($semiadmin_details->roll_id) && @$semiadmin_details->roll_id == 2) echo "selected"; ?>>Admin</option>
                    </select>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" id="eamil_single" name="eamil" value="<?php echo @$semiadmin_details->email_id ?>" placeholder="Email ID">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="mobile_number_single" name="mobile_number" value="<?php echo @$semiadmin_details->mobile_no ?>" placeholder="Mobile Number">
            </div>
            <!-- <div class="form-group">
                  <input type="text" class="form-control" id="password_single" name="password" value="<?php //echo @$semiadmin_details->password    ?>" placeholder="Password">
                </div> -->
            <div class="modal-footer">
                <button style="padding:8px 20px; font-size:12px; font-weight:normal;" type="button" class="btn btn-danger pull-right common-btn-pass" id="cancel_single_edit">Cancel</button>
                <button type="button" id="save_toll_venter" class="btn save_changes pull-right common-btn-pass" style="padding:8px 20px; font-size:12px; font-weight:normal;">Submit</button>
            </div>

    </form>
</div>

<script type="text/javascript">
    $("#close_id").click(function () {
        location.reload();
    });
    $("#cancel_single_edit").click(function () {
        location.reload();
    });
    function getcentername_single() {
        $("#tcn_single").val('');
        var location_id = $("#toll_center_loaction_single").val();
        $("#toll_center_name_single").html('');
        if (location_id != '')
        {
            $.ajax({
                "url": "<?php echo base_url('tollcenter/gettollcentername'); ?>",
                "type": "POST",
                "data": ({'location_id': location_id}),
                success: function (response) {
                    $("#toll_center_name_single").append(response);
                }
            });
        } else {
            $("#toll_center_name_single").append('<option value="">No Toll Center Names</option>');
        }

        // body...
    }

    function gettcn_single() {
        $("#tcn_single").val('');
        var toll_center_name = $("#toll_center_name_single").val();
        $.ajax({
            "url": "<?php echo base_url('tollcenter/gettcn'); ?>",
            "type": "POST",
            "data": ({'toll_center_name': toll_center_name}),
            success: function (response) {
                var obj = $.parseJSON(response);
                if (obj.statuscode == 200)
                {
                    $("#tcn_single").val(obj.response.tcn_no);
                } else {
                    $("#error_message").text(obj.error[0]);
                }
            }
        });
    }

    $("#save_toll_venter").click(function () {

        $('#update_semiadmin').validate({
            rules: {
                toll_center_loaction: {required: true, minlength: 1, maxlength: 30},
                toll_center_name: {required: true, minlength: 1, maxlength: 20},
                tcn: {required: true},
                first_name: {required: true, minlength: 1, maxlength: 30},
                last_name: {required: true, minlength: 1, maxlength: 20},
                roll: {required: true},
                eamil: {required: true, email: true, minlength: 1, maxlength: 100},
                mobile_number: {required: true, digits: true, minlength: 10, maxlength: 10},
                password: {required: true, minlength: 1, maxlength: 29},
            },
            messages: {
                toll_center_loaction: {
                    required: "Please Enter Toll Center Location",
                    maxlength: "Enter Maximum 30 Characters",
                    minlength: "Enter Minimum 1 Characters"
                },
                toll_center_name: {
                    required: "Please Enter Toll Center Name",
                    maxlength: "Enter Maximum 20 Characters",
                    minlength: "Enter Minimum 1 Characters"
                },
                first_name: {
                    required: "Please Enter First Name",
                    maxlength: "Enter Maximum 30 Characters",
                    minlength: "Enter Minimum 1 Characters"
                },
                last_name: {
                    required: "Please Enter Last Name",
                    maxlength: "Enter Maximum 20 Characters",
                    minlength: "Enter Minimum 1 Characters"
                },
                roll: {
                    required: "Please Select Role",
                },
                eamil: {
                    required: "Please Enter Email",
                    email: "Enter Valid Email",
                    maxlength: "Enter Maximum 30 Characters",
                    minlength: "Enter Minimum 1 Characters",
                },
                mobile_number: {
                    required: "Please Enter Mobile Number",
                    digits: "Enter Only Digits",
                    maxlength: "Enter Maximum 10 Characters",
                    minlength: "Enter Minimum 10 Characters"
                },
                password: {
                    required: "Please Enter Toll Center Name",
                    maxlength: "Enter Maximum 29 Characters",
                    minlength: "Enter Minimum 1 Characters"
                },
                tcn: {
                    required: "Please Enter Toll Center Number",
                    maxlength: "Enter Maximum 19 Characters",
                },
            },
            tooltip_options: {
                _all_: {placement: 'bottom', html: true, trigger: 'focus'}
            }
        });
        if ($('#update_semiadmin').valid()) {
            $("#save_toll_venter").attr("disabled", true);
            $.ajax({
                "url": "<?php echo base_url('tollcenter/updasemiadmindetails'); ?>",
                "type": "POST",
                "data": ({'tolltype': $("#tolltype_single").val(), 'toll_center_loaction': $("#toll_center_loaction_single").val(), 'toll_center_name': $("#toll_center_name_single").val(), 'tcn': $("#tcn_single").val(), 'first_name': $("#first_name_single").val(), 'last_name': $("#last_name_single").val(), 'roll': $("#roll_single").val(), 'eamil': $("#eamil_single").val(), 'mobile_number': $("#mobile_number_single").val(), 'password': $("#password_single").val(), 'user_id_update': $("#update_id").val()}),
                success: function (response) {
                    //console.log(response);return false;
                    var data = $.parseJSON(response);
                    //console.log(data.statuscode);
                    if (data.statuscode == 200)
                    {
                        $("#save_toll_venter").attr("disabled", false);
                        var toll_id = $("#update_id").val();
                        var f_val = $("#first_name_single").val();
                        var l_val = $("#last_name_single").val();
                        var r_val = $("#roll_single").val();
                        var name = f_val + ' ' + l_val;
                        var mobile = $("#mobile_number_single").val();
                        var email = $("#eamil_single").val();
                        var login_role_id = "<?php echo $this->role_id; ?>";
                        //alert(tl_val);
                        if (r_val == 3)
                            r_val = 'Semi Admin';
                        if (r_val == 2)
                            r_val = 'Admin';
                        $('#exampleModal').modal('hide');
                        $("#name_" + toll_id).text(name);
                        $("#role_" + toll_id).text(r_val);
                        $("#email_" + toll_id).text(email);
                        $("#mn_" + toll_id).text(mobile);

<?php if ($this->role_id == 1) { ?>
                            var tc_location_selText = '', tc_name_selText = '';
                            $("#toll_center_loaction_single option:selected").each(function () {
                                var $this = $(this);
                                if ($this.length) {

                                    var selText = $this.text();
                                    var values = selText.split(' - ');
                                    console.log(values);
                                    tc_location_selText += values[1] + ",<br>";
                                    tc_name_selText += values[2] + ",<br>";
                                    console.log(selText);
                                }
                            });
                            $("#tc_location_" + toll_id).html(tc_location_selText);
                            $("#tc_name_" + toll_id).html(tc_name_selText);
<?php
}
if ($this->role_id == 3) {
    ?>
                            $("#toll_center_loaction_" + toll_id).html($("#toll_center_loaction_single option:selected").text());
<?php } ?>
//                             window.location.reload();

                        alertify.success(data.successMessage);
                    } else {
                        //$("#fail").text(data.error);
                        $("#save_toll_venter").attr("disabled", false);
                        alertify.error(data.error);
                    }
                    // var set_make = "<?php echo @$vehicle_details->response->vehicleDetails->vehiclemake; ?>";

                }
            });
        }
    });

</script>