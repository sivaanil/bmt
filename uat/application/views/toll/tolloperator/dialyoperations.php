<!-- body start here -->
<style>
    body
    {
        background-image:url(code.jpg);
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    a{
        text-decoration:none;
        font-size:18px;
        color:#333333;
    }
    a:hover{
        text-decoration:underline;
        font-size:18px;
        color:#333333;
    }
    #popup{
        position:absolute;
        display:hidden;
        top:160px;
        left:50%;
        width:500px;
        height:auto;
        margin-left:-250px;
        background-color:rgba(0, 0, 0, 0.65);
        z-index:6;
        padding:20px;
        border:solid 1px #333333;
        border-radius:0px;
    }
    #popup h1{
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:16px;
        color:#3F5C9A;
        font-weight:normal;
        margin:0;
        padding:0;
    }
    #popup h3{
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:14px;
        color:#666666;
        margin:0;
        padding:5px 0;
        text-align:left;
    }
    #popup p{
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#666666;
        margin:0;
        padding:5px;
        text-align:justify;
    }
    #popup a{
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#666666;
        margin:0;
        padding:5px;
        text-align:right;
        float:right;
    }
    #overlay-back {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        opacity: 0.6;
        filter: alpha(opacity=60);
        z-index: 5;
        display: none
    }
    .close-image{
        display: block;
        float:right;
        position:relative;
        top:-15px;
        right: -15px;
        height: 20px;
    }
    #popup select{
        width:100% !important;
    }

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
    // you can use just jquery for this
    $(document).ready(function () {
        $('#overlay-back').fadeIn(500, function () {
            $('#popup').show();
        });

        $(".close-image").on('click', function () {
            $('#popup').hide();
            $('#overlay-back').fadeOut(500);
        });
    });
</script>
<script type="text/javascript">
    function getLanes(val) {
        // alert(val);
        if (val != '') {
            var tcid =<?php echo $locations->tc_id; ?>;
            $.ajax({
                "url": "<?php echo base_url('tolloperator/get_lane_way'); ?>",
                "type": "POST",
                "data": ({'way': val, 'tcid': tcid}),
                success: function (response) {
                    $('#lanedivid').html(response);
//          var data = $.parseJSON(response);
//          alert(data);
//          console.log(data.response.vehicleMake);
//          $('#vehicle_make').append('<option value="">Vehicle Make</option');
//          $.each(data, function (i, item) {
//              alert(i);
//            console.log(i);
//              $('#vehicle_make').append($('<option value='+i+'>'+item+'</option>'));
//          });
                }
            });
        } else {
            $('#wayerror').text('Please Select Way Type');
        }
    }
    function submitLane() {
        // alert(1);
        var tcid =<?php echo $locations->tc_id; ?>;
        var way = $('#waytype').val();
        var lane = $('#lane').val();
        if (way == '') {
            $('#wayerror').text('Please Select Way Type');
            return false;
        } else {
            $('#wayerror').text('');
        }
        if (lane == '') {
            $('#wayerror').text('Please Select Lane');
            return false;
        }
        $.ajax({
            "url": "<?php echo base_url('tolloperator/store_lanes'); ?>",
            "type": "POST",
            "data": ({'way': way, 'tcid': tcid, 'lane': lane}),
            success: function (response) {
                //$('#lanedivid').html(response);
                $('#popup').hide();
                $('#overlay-back').fadeOut(500);
            }
        });
    }

</script>
<?php
//echo "<pre>"; print_r($dropdown);
//$cookie=get_cookie('set_value');
//if($cookie!=1){
if (@$dropdown->count == 0) {
    ?>
    <!--start poup-->
    <div id="overlay-back"></div>
    <div id="popup">
        <!--<a class="close-image">Close</a>-->
        <h1>Select Your Lane</h1>
        <form id="laneform" action="" method="POST">
            <div class="row control-group common-form">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    <span id="wayerror" style="color: red;font-size: 12px;text-align: center;"></span>
                    <?php if (isset($locations)) { ?>
                        <select class="form-control" name="waytype" id="waytype" onchange="getLanes(this.value)">
                            <option value="">Select Way</option>
                            <option value="1"><?php echo $locations->from_way_location; ?> - <?php echo $locations->to_way_location; ?></option>
                            <option value="2"><?php echo $locations->to_way_location; ?> - <?php echo $locations->from_way_location; ?></option>
                            <?php if (isset($locations->orr_from_way_location)) { ?>
                                <option value="3"><?php echo $locations->orr_from_way_location; ?> - <?php echo $locations->orr_from_way_location; ?></option>
                            <?php } ?>
                            <?php if (isset($locations->orr_to_way_location)) { ?>
                                <option value="4"><?php echo $locations->orr_to_way_location; ?> - <?php echo $locations->orr_to_way_location; ?></option>
                            <?php } ?>
                            <otion>
                        </select>
                    </div>
                </div>
                <div class="row control-group common-form">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <span id="lanerror" style="color: red;font-size: 12px;text-align: center;"></span>
                        <div id="lanedivid">
                            <select class="form-control" name="lane" id="lane">
                                <option value="">Select Lane</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn save_changes" style=" margin-bottom: 15px;margin-top: 15px;" onclick="submitLane();">Submit</button>
            </form>
        <?php } ?>
    </div>
    <!--end popup-->
<?php } ?>

<div class="container-fluid inner-page-body">
    <div id="chargests" style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;text-align: center;">
        <?php
        if ($this->session->flashdata('msg')) {
            echo $this->session->flashdata('msg');
        }
        ?></div>
    <div id="chargestserror" style="font-size:12px;color:#cc0000;font-weight: bold;text-transform: capitalize;text-align: center;"></div>
    <div id="mydiv">
        <div class="row">
            <?php
            //  echo "<pre>"; print_r($mobileinfo); print_r($webinfo);
            ?>
            <div class="col-md-6 left_menu" style="text-align:center;">
                <h1>Non Smart Phone Users</h1> 
                <!--                   <div style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;"><?php
                if ($this->session->flashdata('mbmsg')) {
                    echo $this->session->flashdata('mbmsg');
                }
                ?></div>-->
                <table class="table" style="margin:0 auto; border: 1px #DDD solid; margin-bottom:10px;">
                    <thead>
                        <tr>
                            <td colspan="8" style="padding:0;"><form class="form-horizontal">
                                    <div class="form-group" style="margin-bottom: -1px;">
                                        <input placeholder="Search Vehicle Number" style="width:90%; margin:0 auto;" type="text" id="mvnum" name="mvnum" class="form-control">
                                        <div id="list"></div>
                                    </div>
                                </form></td>
                        </tr>
                        <tr>
                            <th>S.No</th>
                            <th>Vehicle No </th>
                            <th>Type</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Allow</th>
                        </tr>
                    </thead>
                    <tbody id="majaxsus">
                        <?php
                        //print_r($mobileinfo);
                        if (isset($mobileinfo) && !empty($mobileinfo)) {
                            $i = 1;
                            foreach ($mobileinfo as $info) {
                                $tcid = $this->encrypt->encode_my($info->tc_id);
                                $tcname = $this->encrypt->encode_my($info->tc_name);
                                $uid = $this->encrypt->encode_my($info->user_id);
                                $vid = $this->encrypt->encode_my($info->vehicle_id);
                                $psts = $this->encrypt->encode_my($info->passing_status);
                                $paid = $this->encrypt->encode_my($info->paid_status);
                                $vno = $this->encrypt->encode_my($info->vehicle_no);

                                $email = $this->encrypt->encode_my($info->email_id);
                                $mb = $this->encrypt->encode_my($info->mobile_no);
                                $toll = $this->encrypt->encode_my($info->toll_charge);
                                $bmt = $this->encrypt->encode_my($info->bmt_charge);
                                $tot = $this->encrypt->encode_my($info->total_amount);
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $info->vehicle_no; ?></td>
                                    <td><?php echo $info->type_name; ?></td>
                                    <td><?php echo $info->make_name; ?></td>
                                    <td><?php echo $info->model_name; ?></td>
                                    <td style="text-align:center;"><?php echo $info->total_amount; ?></td>
                                    <td style="text-align:center;"><?php
                                        if ($info->paid_status == 1) {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></td>
                                    <td style="text-align:center;">
                                        <input type="hidden" id="psts" name="psts" value="<?php echo $info->passing_status; ?>">
                                        <a href="<?php echo base_url('tolloperator/changeStatus?tcid=' . $tcid . '&uid=' . $uid . '&vid=' . $vid . '&psts=' . $psts . '&paid=' . $paid . '&email=' . $email . '&mb=' . $mb . '&toll=' . $toll . '&bmt=' . $bmt . '&tot=' . $tot . '&tcname=' . $tcname . '&vno=' . $vno); ?>" class="btn btn-success common-btn-pass"><?php
                                            if ($info->passing_status == 0) {
                                                echo "PASS";
                                            }
                                            ?></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr><td colspan="8">No Registered Vehicles Found</td> </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table> 
            </div>
            <div class="col-md-6 right_menu" style="text-align:center;">
                <h1 style="font-size:22px; font-weight:normal; margin-top:9px;">Smart Phone Users</h1> 

                <!-- <div style="font-size:12px;color:#339900;font-weight: bold;text-transform: capitalize;"><?php
                if ($this->session->flashdata('wbmsg')) {
                    echo $this->session->flashdata('wbmsg');
                }
                ?></div>                  -->

                <table class="table" style="width:95%; margin:0 auto; border: 1px #DDD solid; margin-bottom:10px;">
                    <thead>
                        <tr>
                            <td colspan="7" style="padding:0;"><form class="form-horizontal">
                                    <div class="form-group" style="margin-bottom: -1px;">
                                        <input placeholder="Search Vehicle Number" style="width:90%; margin:0 auto;" type="text" id="vnum" name="vnum" class="form-control">
                                        <div id="list"></div>
                                    </div>
                                </form></td>
                        </tr>
                        <tr>
                            <th>S.No</th>
                            <th> Vehicle No </th>
                            <th> Type </th>
                            <th>Amount</th>
                           <!-- <th>Charge</th>-->
                            <th>Paid</th>
                            <th>Allow</th>
                        </tr>
                    </thead>
                    <tbody id="ajaxsus">
                        <?php
                        // echo "<pre>"; print_r($webinfo);exit;
                        if (isset($webinfo) && !empty($webinfo)) {
                            $j = 1;
                            foreach ($webinfo as $info) {

                                $tcid = $this->encrypt->encode_my($info->tc_id);
                                $tcname = $this->encrypt->encode_my($info->tc_name);
                                $uid = $this->encrypt->encode_my($info->user_id);
                                $vid = $this->encrypt->encode_my($info->vehicle_id);

                                $vno = $this->encrypt->encode_my($info->vehicle_no);

                                $email = $this->encrypt->encode_my($info->email_id);
                                $mb = $this->encrypt->encode_my($info->mobile_no);
                                $toll = $this->encrypt->encode_my($info->toll_charge);
                                $bmt = $this->encrypt->encode_my($info->bmt_charge);
                                $tot = $this->encrypt->encode_my($info->total_amount);

                                $psts = $this->encrypt->encode_my($info->passing_status);
                                $paid = $this->encrypt->encode_my($info->paid_status);
                                $deviceid = $info->mobile_device_id;
                                if (is_null($deviceid)) {
                                    $regtype = 0;
                                } else {
                                    $regtype = $deviceid;
                                }
                                ?>
                                <?php
                                if ($info->paid_status == 1) {
                                    $var = "false";
                                } else {
                                    $var = "true";
                                }
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $j; ?></th>
                                    <td><?php echo $info->vehicle_no; ?></td>
                                    <td><?php echo $info->type_name; ?></td>
                                    <td><?php echo $info->total_amount; ?></td>
                                  <!--  <td><input type="button" id="chanrge" value="Charge" disabled class="btn btn-success right_menu-button-small common-btn-pass"/> </td>-->
                                    <!--
                                    <td>
                                        <input type="button" id="chanrge" name="charge<?php echo $j; ?>"  
                                        onclick="getCharge('<?php echo $info->email_id; ?>',<?php echo $info->tc_id; ?>,<?php echo $info->user_id; ?>,<?php echo $info->type_id; ?>,
                                    <?php echo $info->make_id; ?>,<?php echo $info->model_id; ?>,<?php echo $info->vehicle_id; ?>,'<?php echo $info->vehicle_no; ?>',
                                    <?php echo $info->one_way_charge; ?>,<?php echo $info->two_way_charge; ?>,<?php echo $info->paid_status; ?>,<?php echo $info->passing_status; ?>,
                                                    '<?php echo $regtype; ?>');" value="Charge" class="btn btn-success right_menu-button-small common-btn-pass"/>
                                    </td>-->
                                    <td><span class="common-btn-pass"><?php
                                            if ($info->paid_status == 1) {
                                                echo "Yes";
                                            } else {
                                                echo "No";
                                            }
                                            ?></span></td>

                                    <td style="text-align:center;">
                                        <?php if ($info->paid_status == 1) { ?>
                                            <a href="<?php echo base_url('tolloperator/changeStatus?tcid=' . $tcid . '&uid=' . $uid . '&vid=' . $vid . '&psts=' . $psts . '&paid=' . $paid . '&email=' . $email . '&mb=' . $mb . '&toll=' . $toll . '&bmt=' . $bmt . '&tot=' . $tot . '&tcname=' . $tcname . '&vno=' . $vno); ?>" class="btn btn-success common-btn-pass"><?php echo "PASS"; ?></a>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-success common-btn-pass" disabled>PASS</button>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php
                                $j++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>No registered Vehicles Found</td></tr>";
                        }
                        ?>




                    </tbody>
                </table> 

            </div>
        </div>  
    </div>
</div>
<script type="text/javascript">
    function getCharge(email, tcid, uid, typeid, makeid, modelid, vid, vno, amt1, amt2, paidsts, passsts, deviceid) {
        //alert(amt);
        $.ajax({
            url: "<?php echo base_url('tolloperator/getChargeStatus'); ?>",
            type: 'POST',
            dataType: 'html',
            data: "email=" + email + "&tcid=" + tcid + "&uid=" + uid + "&typeid=" + typeid + "&makeid=" + makeid + "&modelid=" + modelid + "&vid=" + vid + "&vno=" + vno + "&amt1=" + amt1 + "&amt2=" + amt2 + "&paidsts=" + paidsts + "&passsts=" + passsts + "&deviceid=" + deviceid,
            success: function (msg)
            {
                // alert(msg);
                d = $.parseJSON(msg);
                if (d.ans == 'success') {
                    $('#chargests').html(d.res).fadeIn().delay(3000).fadeOut();
                    // window.location.href="<?php echo base_url('tolloperator/dialyoperations'); ?>";
                } else if (d.ans == 'failure') {
                    $('#chargestserror').html(d.res).fadeIn().delay(30000).fadeOut();
                    // window.location.href="<?php echo base_url('tolloperator/dialyoperations'); ?>";
                }
                //alert(html);    
            } //whatever you want to do with your return data. 
        });
    }
    $("#vnum").keyup(function () {
        var keyword = $("#vnum").val();
        ///  alert(keyword);
        $.ajax({
            url: "<?php echo base_url('tolloperator/getVehiclesData'); ?>",
            type: 'POST',
            dataType: 'html',
            data: "keyword=" + keyword,
            success: function (result)
            {
                $('#ajaxsus').html(result);
                //alert(html);    
            } //whatever you want to do with your return data. 
        });
    });
    $("#mvnum").keyup(function () {
        var keyword = $("#mvnum").val();
        ///  alert(keyword);
        $.ajax({
            url: "<?php echo base_url('tolloperator/getMobileVehiclesData'); ?>",
            type: 'POST',
            dataType: 'html',
            data: "keyword=" + keyword,
            success: function (result)
            {
                $('#majaxsus').html(result);
                //alert(html);    
            } //whatever you want to do with your return data. 
        });
    });

</script>

<script type="text/javascript">

    /*By Ramesh on 03012016 for Reloadpage every 10 Seconds*/
    /*$(document).ready(function(){
     setTimeout(function(){
     window.location.reload(1);
     }, 20000);
     });*/





</script>
<script type="text/javascript">
    /*
     $(window).bind('unload', function(){
     $.ajax({
     type: 'get',
     async: false,
     url: '<?php echo base_url("tolloperator/clearLanes"); ?>'
     
     });
     });*/
    /*    $(document).ready(function(){
     setTimeout(function(){
     $('#refreshdiv').load('http://bookmytoll.com/tolloperator/dialyoperations');
     }, 15000); 
     });// refreshing every 15000 milliseconds/15 seconds*/
</script>
<script>
    $(document).ready(function () {
        setInterval(function () {
            $("#mydiv").load('<?php echo base_url("tolloperator/refresh"); ?>')
        }, 5000);
    });
</script>


