<?php
//echo "<pre>"; 
//print_r($toll_data);
//print_r($orr_from_lanes_mapped);
//exit;
//pd($from_lanes_mapped);
//echo $from_lanes_mapped[3]['status_flag'];exit;
//echo "<pre>";print_r($listTollCenterLocations);echo "</pre>";exit;
?>
<div class="col-md-9 right_menu">
    <form class="form-horizontal" style="width:93%; margin:0 auto;" method="post" id="updatelanedetails" name="updatelanedetails" action="<?php echo base_url('tollcenter/updatelanedetails'); ?>">
        <input type="hidden" value="<?php echo @$from_way_total_lanes_bmt ?>" name = "from_way_total_lanes_bmt">
        <input type="hidden" value="<?php echo @$to_way_total_lanes_bmt ?>" name = "to_way_total_lanes_bmt">
        <?php //if($listTollCenterLocations->TollCenterDetails[0]->toll_type_id == 2){  ?>
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="form-group">
                    <select style="color:#0C0C0C;" class="form-control" id="toll_center_loaction" name="tc_id" onchange="changeLane(this)">
                        <?php
                        foreach ($listTollCenterLocations->TollCenterDetails as $key => $value) {
                            ?>
                            <option <?php echo ($tc_id == $value->tc_id) ? "selected" : ""; ?> value="<?php echo @$value->tc_id; ?>"><?php echo @$value->city . " - " . @$value->tc_location . " - " . @$value->tc_name; ?></option>
                        <?php }
                        ?>

                    </select>
                </div>
            </div>
        </div>
        <?php //}  ?>
        <?php /*
          <div class="row">
          <div class="col-md-4 col-sm-4">
          <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_loaction" name="toll_center_loaction">
          <option value=""><?php echo @$toll_data->tc_location?></option>
          </select>
          </div>
          <div class="col-md-4 col-sm-4">
          <div class="form-group">
          <select style="margin-top:0; width:100%;" class="form-control" id="toll_center_name" name="toll_center_name">
          <option value=""><?php echo @$toll_data->tc_name?></option>
          </select>
          </div>
          </div>

          </div>
         */ ?>
        <div class="row">
            <h4 style="padding-left: -1px !important; font-weight:normal;">Lane Details
            </h4>
        </div>
        <!-- To load page for NH -->
        <?php if ($lane_details->beacon_details->toll_type_id != 2) { ?>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo @$lane_details->beacon_details->from_way_location ?> - <?php echo @$lane_details->beacon_details->to_way_location ?>" id="inputtext3" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputtext3" value="<?php echo @$lane_details->from_way_lane_name->uuid ?>" readonly="" placeholder="Beacon ID">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($from_way_total_lanes) && !empty($from_way_total_lanes)) {
                    for ($i = 1; $i <= $from_way_total_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="from[]" <?php if (isset($from_lanes_mapped) && !empty($from_lanes_mapped) && isset($from_lanes_mapped[$i]) && ($from_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>

            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputtext3" value="<?php echo @$lane_details->beacon_details->to_way_location ?> - <?php echo @$lane_details->beacon_details->from_way_location ?>" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputPassword3" value="<?php echo @$lane_details->to_way_lane_name->uuid ?>" readonly placeholder="Beacon ID">
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($to_way_total_lanes) && !empty($to_way_total_lanes)) {
                    for ($i = 1; $i <= $to_way_total_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="to[]" <?php if (isset($to_lanes_mapped) && !empty($to_lanes_mapped) && isset($to_lanes_mapped[$i]) && ($to_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        <?php } else { ?>
            <input type="hidden" value="<?php echo @$lane_details->beacon_details->orr_from_way_no_of_bmt_lanes ?>" name = "orr_from_way_total_lanes_bmt">
            <input type="hidden" value="<?php echo @$lane_details->beacon_details->orr_to_way_no_of_bmt_lanes ?>" name = "orr_to_way_total_lanes_bmt">
            <!-- To load page for ORR -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo @$lane_details->beacon_details->from_way_location ?>" id="inputtext3" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <!--
                                    <input type="text" class="form-control" id="inputtext3" value="<?php //echo @$lane_details->from_way_lane_name->uuid  ?>" readonly="" placeholder="Beacon ID">
                        -->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($from_way_total_lanes) && !empty($from_way_total_lanes)) {
                    for ($i = 1; $i <= $from_way_total_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="from[]" <?php if (isset($from_lanes_mapped) && !empty($from_lanes_mapped) && isset($from_lanes_mapped[$i]) && ($from_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>

            </div> 

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputtext3" value="<?php echo @$lane_details->beacon_details->to_way_location ?>" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="inputPassword3" value="<?php // echo @$lane_details->to_way_lane_name->uuid  ?>" readonly placeholder="Beacon ID"> -->
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($to_way_total_lanes) && !empty($to_way_total_lanes)) {
                    for ($i = 1; $i <= $to_way_total_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="to[]" <?php if (isset($to_lanes_mapped) && !empty($to_lanes_mapped) && isset($to_lanes_mapped[$i]) && ($to_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputtext3" value="<?php echo @$lane_details->beacon_details->orr_from_way_location ?>" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="inputPassword3" value="<?php // echo @$lane_details->to_way_lane_name->uuid  ?>" readonly placeholder="Beacon ID"> -->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($lane_details->beacon_details->orr_from_way_no_of_lanes) && !empty($lane_details->beacon_details->orr_from_way_no_of_lanes)) {
                    for ($i = 1; $i <= $lane_details->beacon_details->orr_from_way_no_of_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="orrfrom[]" <?php if (isset($orr_from_lanes_mapped) && !empty($orr_from_lanes_mapped) && isset($orr_from_lanes_mapped[$i]) && ($orr_from_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputtext3" value="<?php echo @$lane_details->beacon_details->orr_to_way_location ?>" readonly placeholder="Entry From">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="inputPassword3" value="<?php // echo @$lane_details->to_way_lane_name->uuid ?>" readonly placeholder="Beacon ID"> -->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:2%;">
                <?php
                if (isset($lane_details->beacon_details->orr_to_way_no_of_lanes) && !empty($lane_details->beacon_details->orr_to_way_no_of_lanes)) {
                    for ($i = 1; $i <= $lane_details->beacon_details->orr_to_way_no_of_lanes; $i++) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <label>Lane <?php echo @$i; ?> <input type="checkbox" value="<?php echo @$i; ?>" name="orrto[]" <?php if (isset($orr_to_lanes_mapped) && !empty($orr_to_lanes_mapped) && isset($orr_to_lanes_mapped[$i]) && ($orr_to_lanes_mapped[$i]['status_flag']) == 0) echo "checked"; ?>/></label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn save_changes common-btn-pass">Submit</button>
                        </div>
                        <div class="col-md-6 col-sm-6 text-left" style="color:#090; font-size:12px;">
                            <span style="color:red;"><?php echo validation_errors(); ?></span>
                            <span id="error_message" class="text-center won_error"><?php echo $this->session->flashdata('errormsg'); ?></span>
                            <span class="text-center"><?php echo $this->session->flashdata('msg'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
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
    function changeLane(obj) {
        $("#updatelanedetails").attr("action", '<?php echo base_url('tollcenter/lanedetails'); ?>');
        $("#updatelanedetails").submit();
    }
</script>