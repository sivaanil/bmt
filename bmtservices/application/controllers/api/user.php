<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

    private $loginObj = [
        'login' => NULL,
        'password' => NULL,
    ];
    private $objKeys = [];
    private $regObj = [
        'first_name' => NULL,
        'last_name' => NULL,
        'email_id' => NULL,
        'password' => NULL,
        'mobile_no' => NULL,
    ];
    protected $requestObject = NULL;

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Expose-Headers: Authtoken');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authtoken, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        parent::__construct();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        $this->requestObject = $this->rest->post("request");
        $this->load->model('user_model');

        $this->login_user_details = getWebLoginUserId();
        $this->login_user_id = $this->login_user_details['user_id'];
        $this->old_password = @$this->login_user_details['password'];
    }

    public function getProfile() {
        //echo "sds";
        $data = $this->user_model->getProfile($this->login_user_id);
        //pd($data);
        if (!empty($data)) {  // pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Profile List'), SUCCESS_CODE);
            return;
        } else {   //pd($data);exit;
            $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
            return;
        }
    }

    public function editProfile() {

//        $this->login_user_details =  getWebLoginUserId();
//        $this->login_user_id      =  $this->login_user_details['user_id'];

        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        //   echo "hi";exit;
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
        //echo "hi";exit;
//       if($this->requestObject['profile_image']==''){
//          $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');
//        }
        // echo "hiff";exit;
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $mobile_no = $_POST['mobile_no'];
            $mobilecount = $this->user_model->isExistMobile($mobile_no, $this->login_user_id);
            if ($mobilecount == 0) {
                //echo $mobile;exit;
                $otp = random_numbers(4);
                // $mobileno='9160606813';
                $mesaage = 'The OTP for the Mobile Update is ' . $otp;
                $smsdata = array(
                    'mobilenumber' => $mobile_no,
                    'message' => $mesaage
                );
                $sms = $this->smscountry->sendSms($smsdata);
                if ($sms) {
                    $updata = array('first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'email_id' => $_POST['email_id'], 'otp' => $otp, 'otp_flag' => 0);
                    updaterecord('user_register', array('user_id' => $this->login_user_id), $updata);
                }
                $result = array();
                $result[0]['mobile_no'] = $mobile_no;
                $result[0]['mstatus'] = 1;
                // pd($result);
                $this->rest->response(responseObject(SUCCESS_CODE, '', $result, success, 'Profile Updated Successfully.'), SUCCESS_CODE);
                return;
            } else {
                // echo "fff";
                // $imagename = $this->uploadImage($this->requestObject['profile_image'],$_POST['email_id']);
                $data = $this->user_model->updateProfile($_POST, $this->login_user_id);
                // echo "ggg";exit;
                if ($data > 0) {
                    $result = array();
                    $result[0]['mstatus'] = 0;
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $result, success, 'Profile Updated Successfully.'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                    return;
                }
            }
        }
    }

    public function editWebProfile() {

//        $this->login_user_details =  getWebLoginUserId();
//        $this->login_user_id      =  $this->login_user_details['user_id'];
        //echo 'dshjf';exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

//echo "<pre>";print_r($_POST);exit;
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]|xss_clean');
        //echo "hi";exit;
        //if($this->requestObject['profile_image']==''){
        //   $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');
        // }
        // echo "hiff";exit;
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            if ($_POST['profile_image'] != '') {
                $imagename = $this->uploadWebImage($_POST['profile_image'], $_POST['email_id']);
            } else {
                $imagename = '';
            }

            $mobile_no = $_POST['mobile_no'];
            $mobilecount = $this->user_model->isExistMobile($mobile_no, $this->login_user_id);
            if ($mobilecount == 0) {
                //echo $mobile;exit;
                $otp = random_numbers(4);
                // $mobileno='9160606813';
                $mesaage = 'The OTP for the Mobile Update is ' . $otp;
                $smsdata = array(
                    'mobilenumber' => $mobile_no,
                    'message' => $mesaage
                );
                $sms = $this->smscountry->sendSms($smsdata);
                if ($sms) {
                    $updata = array('first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'email_id' => $_POST['email_id'],
                        'profile_image' => $imagename,
                        'otp' => $otp, 'otp_flag' => 0);
                    updaterecord('user_register', array('user_id' => $this->login_user_id), $updata);
                }
                $result = array();
                $result[0]['mobile_no'] = $mobile_no;
                $result[0]['mstatus'] = 1;
                // pd($result);
                $this->rest->response(responseObject(SUCCESS_CODE, '', $result, success, 'Profile Updated Successfully.'), SUCCESS_CODE);
                return;
            } else {
                // echo "fff";

                $data = $this->user_model->updateWebProfile($_POST, $this->login_user_id, $imagename);
                // echo "ggg";exit;
                if ($data > 0) {
                    $result = array();
                    $result[0]['mstatus'] = 0;
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $result, success, 'Profile Updated Successfully.'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                    return;
                }
            }
        }
    }

    function uploadWebImage($image, $email) {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = md5($email) . strtotime(date('H:i:s')) . ".jpg";
        //$name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_IMG_PATH . $name;

        $imageSave = imagejpeg($rotate, $imageName, 100);
        imagedestroy($source);
        $name = base_url() . 'uploads/' . $name;
        return $name;
    }

    public function updateMobileOTP() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'));
            return;
        } else {
            //pd($_POST);
            // echo "hi";
            $data = $this->user_model->verifymobile_otp($_POST, $this->login_user_id);
            //echo "hiddf";exit;
            //  exit;
            if (!empty($data)) {
                $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Your OTP Verified Successfully.'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, OTP_ACTIVATION_ERROR, '', fail, ''), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function updateWebProfileImage() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        if ($this->requestObject['profile_image'] == '') {
            $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'));
            return;
        } else {
            $imagename = $this->uploadMobileImage($this->requestObject['profile_image']);
            $data = $this->user_model->uploadImage($this->login_user_id, $imagename);
            if (!empty($data)) {
                $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Profile Image Updated Successfully'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function updateMobileProfileImage() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        //if($_POST['profile_image']==''){
        $this->form_validation->set_rules('profile_image', 'Profile Image', 'trim|required|xss_clean');
        ///}

        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'));
            return;
        } else {
            // print_r($_POST['profile_image']);
            $imagename = $this->uploadMobileImage($_POST['profile_image']);

            $data = $this->user_model->update_profile_image($this->login_user_id, $imagename);
            if ($data > 0) {
                //$data=array('image_data'=>$imagename);
                $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Profile Image Updated Successfully'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function uploadImage($image) {
        $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($imageDataEncoded);
        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = strtotime(date('H:i:s')) . ".jpg";
        //$name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_IMG_PATH . $name;

        $imageSave = imagejpeg($rotate, $imageName, 100);
        imagedestroy($source);
        $name = base_url() . 'uploads/' . $name;
        return $name;
    }

    public function uploadMobileImage($image) {
        //$data = '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';
        //  $imageDataEncoded = base64_encode(file_get_contents($image));
        $imageData = base64_decode($image);

        $source = imagecreatefromstring($imageData);
        $angle = 0;
        $rotate = imagerotate($source, $angle, 0); // if want to rotate the image
        $name = strtotime(date('H:i:s')) . ".jpg";
        //    $name = strtotime(date('H:i:s')).".jpg";
        $imageName = USER_IMG_PATH . $name;
        // print_r($image);exit;
        $imageSave = imagejpeg($rotate, $imageName, 100);
        imagedestroy($source);
        $name = base_url() . 'uploads/' . $name;
        return $name;
    }

    public function changePassword() {
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|max_length[30]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|max_length[30]|callback_checkToBeconMinarId|callback_checkBeconMinarId');
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provid The Necessary Parameters'));
            return;
        }
        if ($_POST['oldpassword'] != $this->old_password) {
            $this->rest->response(responseObject(CONFLICT_CODE, 'Incorrect Old Password', '', fail, 'Incorrect Old Password'));
            return;
        }
        if ($_POST['newpassword'] != $_POST['confirmpassword']) {
            $this->rest->response(responseObject(CONFLICT_CODE, 'New Password And Confirm Password Not Matched', '', fail, 'New Password And Confirm Password Not Matched'));
            return;
        }
        $table_name = 'user_register';
        $where_condition = array('user_id' => $this->login_user_id);
        $data = array('password' => $_POST['newpassword']);
        updaterecord($table_name, $where_condition, $data);
        $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Password Changed Successfully'));
        return;
    }

    public function changePasswordMobile() {
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|max_length[30]|callback_checkToBeconMajorId|callback_checkBeconMajorId');
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provid The Necessary Parameters'));
            return;
        }
        if ($_POST['old_password'] != $this->old_password) {
            $this->rest->response(responseObject(CONFLICT_CODE, 'Incorrect Old Password', '', fail, 'Incorrect Old Password'), CONFLICT_CODE);
            return;
        }

        $table_name = 'user_register';
        $where_condition = array('user_id' => $this->login_user_id);
        $data = array('password' => $_POST['new_password']);
        updaterecord($table_name, $where_condition, $data);
        $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Password Changed Successfully'));
        return;
    }

    public function changePassword_old() {
        //  echo "dd";exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'));
            return;
        } else {
            //pd($_POST);
            // echo "hi";
            $data = $this->user_model->change_password($_POST, $this->login_user_id);
            //echo "hiddf";exit;
            //  exit;
            if ($data > 0) {
                if ($data == 1) {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Your Password Updated Successfull.'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(CONFLICT_CODE, '', '', success, 'Old Password is Incorrect.'), CONFLICT_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function feedback() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        // pd($_POST);exit;
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('feedback', 'Feedback Comment', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            // pd($_POST);
            $mesaage = $_POST['feedback'];
            $sugject = $_POST['subject'];
            $to = 'plexasyslaxmi@gmail.com';
            //$to=$_POST['email_id'];
            $sendmail = send_bmtmail($sugject, $to, $mesaage);
            if ($sendmail) {
                $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Your feedback submitted successfuly'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function historyInfo() {
        $data = $this->user_model->history_info($this->login_user_id);
//echo "<pre>"; print_r($data);exit;
        if (!empty($data)) {
            if ($data == 4) {
                $this->rest->response(responseObject(SUCCESS_CODE, '', [], success, 'No Transactions'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'User History'), SUCCESS_CODE);
                return;
            }
        } else {
            $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
            return;
        }
    }

    public function consolldatedByDate() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        // pd($_POST);exit;
        $this->form_validation->set_rules('date_wise', 'Date', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {

            $data = $this->user_model->day_wise($_POST, $this->login_user_id);
            // pd($data);exit;
            if (count($data) > 0) {
                // pd( if($data==4){
                if ($data == 4) {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'No Trasactions'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'User Day History'), SUCCESS_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function consolldatedByPeriod() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        // pd($_POST);exit;
        $this->form_validation->set_rules('from_date', 'From Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {

            $data = $this->user_model->period_wise($_POST, $this->login_user_id);
            // pd($data);exit;
            if (count($data) > 0) {
                // pd( if($data==4){
                if ($data == 4) {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'No Trasactions'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'User Period History'), SUCCESS_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function updateDeviceId() {//echo "hii";exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        // pd($_POST);exit;
        $this->form_validation->set_rules('mobile_device_id', 'Mobile Token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required|xss_clean');


        if ($this->form_validation->run() == false) {
            // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->update_token($_POST, $this->login_user_id);
            if ($data > 0) {
                $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Updated Successfully'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function beaconPaid1() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->beacon($_POST, $this->login_user_id);
            if ($data > 0) {
                if ($data == 4) {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'There is no BMT lanes'), SUCCESS_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'Your Transaction Completed'), SUCCESS_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    /* public function beaconPaid(){
      // echo somefun();exit;
      $this->requestObject = $this->rest->post("request");
      $_POST = $this->requestObject;

      $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
      $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
      $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');

      if($this->form_validation->run() == false)
      {
      //pd($_POST);exit;
      $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
      return;
      }
      else
      {
      $data = $this->user_model->becon_paid1($_POST,$this->login_user_id);
      if($data>0)
      {
      if($data==4) {
      $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'There is no BMT lanes'),SUCCESS_CODE);
      return;

      }else{
      $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Your Transaction Completed'),SUCCESS_CODE);
      return;
      }
      }
      else{
      $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
      return;
      }

      }
      } */

    public function iospush() {
        $deviceid = '7ae6050b455da4b81e8999691ecf314439e78be1a681f696664cf40e1454ee4a';
        $msg = "Welcome to Taya";
        echo iosPushNote($deviceid, $msg);
    }

    public function push() {
        //$push_message = $_POST['push_message'];

        $push_message = 'hidh';

        if (!empty($push_message)) {
            echo "df";
            // Create a new Amazon SNS client
            $sns = SnsClient::factory(array(
                        'key' => 'AKIAJLC2IMZWW7HSIYZA',
                        'secret' => 'ADRDf+ZZVBmI9htCCv3A3b2BYOnHCDd0hi9/rvqB',
                        'region' => 'ap-southeast-1'
            ));

            // region code samples: us-east-1, ap-northeast-1, sa-east-1, ap-southeast-1, ap-southeast-2, us-west-2, us-gov-west-1, us-west-1, cn-north-1, eu-west-1
            // $iOS_AppArn = "<iOS app's Application ARN>";
            $android_AppArn = "arn:aws:sns:ap-southeast-1:030821119767:app/GCM/BMT-S";

            // Get the application's endpoints
            // $iOS_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $iOS_AppArn));
            $android_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $android_AppArn));

            // Display all of the endpoints for the iOS application
            /* foreach ($iOS_model['Endpoints'] as $endpoint)
              {
              $endpointArn = $endpoint['EndpointArn'];
              echo $endpointArn;
              }

              // Display all of the endpoints for the android application
              foreach ($android_model['Endpoints'] as $endpoint)
              {
              $endpointArn = $endpoint['EndpointArn'];
              echo $endpointArn;
              }

              // iOS: Send a message to each endpoint
              foreach ($iOS_model['Endpoints'] as $endpoint)
              { */
//$endpointArn = $endpoint['EndpointArn'];
            echo "hfcfi";
            exit;
            $endpointArn = 'arn:aws:sns:ap-southeast-1:030821119767:endpoint/GCM/BMT-S/b2bd5729-7191-4054-a309-7f2c5d576d0c';

            try {
                $sns->publish(array('Message' => $push_message,
                    'TargetArn' => $endpointArn));

                echo "<strong>Success:</strong> " . $endpointArn . "<br/>";
            } catch (Exception $e) {
                echo "<strong>Failed:</strong> " . $endpointArn . "<br/><strong>Error:</strong> " . $e->getMessage() . "<br/>";
            }
            /* }

              // android: Send a message to each endpoint
              foreach ($android_model['Endpoints'] as $endpoint)
              {
              $endpointArn = $endpoint['EndpointArn'];

              try
              {
              $sns->publish(array('Message' => $push_message,
              'TargetArn' => $endpointArn));

              echo "<strong>Success:</strong> ".$endpointArn."<br/>";
              }
              catch (Exception $e)
              {
              echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
              }
              } */
        }
    }

//for beta version services
    public function walletAmount() {
        //echo "sds";
        $data = $this->user_model->getWallet($this->login_user_id);
        // pd($data);
        if ($data > 0) {
            // pd($data);exit;
            $some = array('wallet_amount' => 100);

            $this->rest->response(responseObject(SUCCESS_CODE, '', $some, success, 'User mobile detected by the device at the tollcenter'), SUCCESS_CODE);
            return;
        } else {   //pd($data);exit;
            $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
            return;
        }
    }

    public function beaconIndentification() {

        $data = $this->user_model->becon_identify($this->login_user_id);
        if ($data > 0) {

//$tot=$data['total_amount'];
            $msg = "Amount Rs. 30 will be debited from User PayTm wallet.";

            $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, $msg), SUCCESS_CODE);
            return;
        } else {
            $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
            return;
        }

        // echo "ff";exit;
        /* $this->requestObject = $this->rest->post("request");
          $_POST = $this->requestObject;
          // print_r($_POST);exit;
          $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
          $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
          $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');

          if($this->form_validation->run() == false)
          {
          //pd($_POST);exit;
          $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
          return;
          }
          else
          {} */
    }

    public function getUserSpecificData() {
        $this->rest->response(responseObject(SUCCESS_CODE, '', getWebLoginUserId(), success, ''), SUCCESS_CODE);
        return;
    }

    public function sendPushNotification() {


        // if (isset($_GET["regId"]) && isset($_GET["message"])) {
        // $regId = $_GET["regId"];
        // $message = $_GET["message"];
        // $regId="dP_mDsLe_WM:APA91bFdHduRIbua_Tpltg37wnJI-foszUkCRhJhkaQlAFOhsQCPSvFhMZ2B4OIzLoQ4hcnK6RrbSgczNtY0DBylzga5CRtvMom45HdBNSyAYUDIlbO9Epnu6aLArLY6DVotoIYLmSzy";
        $message = "sai";
        //include_once './GCM.php';

        $regId = array(
            "dP_mDsLe_WM:APA91bFdHduRIbua_Tpltg37wnJI-foszUkCRhJhkaQlAFOhsQCPSvFhMZ2B4OIzLoQ4hcnK6RrbSgczNtY0DBylzga5CRtvMom45HdBNSyAYUDIlbO9Epnu6aLArLY6DVotoIYLmSzy"
        );
//print_r($regId);exit;
        // $gcm = new GCM();
        // $registatoin_ids = $regId;
        // $message1 = array("price" => $message);

        /*  $registatoin_ids = array($regId);
          $message1 = array("price" => $message);

         */
        $url = 'https://android.googleapis.com/gcm/send';

        $registrationIDs = array("reg id1", "reg id2");

        // Message to be sent
        $message = "hi Shailesh";

        // Set POST variables
        //$url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $regId,
            'data' => array("message" => $message),
        );





        /*  $fields = array(
          'registration_ids' => $registatoin_ids,
          'data' => $message1,
          ); */

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        // echo $result;
        print_r($result);
        exit;
//    $registatoin_ids = array($regId);
//    $message = array("price" => $message);
//
//    $result = $gcm->send_notification($registatoin_ids, $message);

        echo $result;
//}
    }

//start payment integration with out wallet
    public function beaconPaid() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        /* -------------- Helpful for debugging purpose-------------------- */
        $sql = "INSERT INTO `request_log`(`request`) 
VALUES ('" . json_encode($_POST) . "')";
        $result = $this->db->query($sql);
        /* -------------- Helpful for debugging purpose ends-------------------- */
        $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|xss_clean');
        $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|xss_clean');
        $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|xss_clean');
        $this->form_validation->set_rules('toll_id', 'Beacon Minor Id', 'trim|xss_clean');
        $this->form_validation->set_rules('vehicle_id', 'Vehicle Id', 'trim|required|xss_clean');
        // pd($_POST);exit;
        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            //  TO dertermine whether it is NH or ORR
            if (isset($_POST['major_id']) && isset($_POST['minor_id'])) {
                $CI = & get_instance();
                $table_name = 'beacons';
                $tollCenterDetails = $CI->db->select('*');
                $CI->db->from('beacons');
                $CI->db->join('toll_center', 'beacons.tc_id = toll_center.tc_id');
                $CI->db->where('beacons.major_id', $_POST['major_id']);
                $CI->db->where('beacons.minor_id', $_POST['minor_id']);
                $CI->db->where('toll_center.status_flag', 0);
                $query = $CI->db->get()->result_array();
                if(count($query) == 0){
                    /* -------------- Helpful for debugging purpose-------------------- */
                    $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Toll center is inactive')";
                    $result1 = $this->db->query($sql1);
                    /* -------------- Helpful for debugging purpose ends-------------------- */
                    $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Toll center is inactive'), CONFLICT_CODE);
                    return;
                }
//                echo $query[0]['toll_type_id']; exit;
                // 		Functionality for highway
                if ($query[0]['toll_type_id'] == 1) {
                    //exit("dfdf");
                    $data = $this->user_model->beacon_method($_POST, $this->login_user_id);
                    //~ echo '<pre>';
                    //~ print_r($data); exit;
                    if (!empty($data)) {
                        if ($data == "Toll Operators are not avialable.") {
                            $this->rest->response(responseObject(MY_CODE, '', $data, success, ''), SUCCESS_CODE);
                            return;
                        }
                        /* -------------- Helpful for debugging purpose-------------------- */
                        $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('" . json_encode($data) . "')";
                        $result1 = $this->db->query($sql1);
                        /* -------------- Helpful for debugging purpose ends-------------------- */
                        $data['road_type'] = "NH";
                        $data['detected_by'] = "Beacon";
                        $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Your Transaction Amount'), SUCCESS_CODE);
                        return;
                    } else {
                        $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                        return;
                    }
                }
                // 		Functionality for ringroad
                elseif ($query[0]['toll_type_id'] == 2) {
                    $vid = $_POST['vehicle_id'];
                    $tcid = $query[0]['tc_id'];
                    $ts3 = "select * from transactions where user_id=" . $this->login_user_id . " AND vehicle_id=" . $vid . " order by transaction_id DESC LIMIT 1";
                    $tq3 = $this->db->query($ts3)->result_array();
                    //echo $this->db->last_query(); exit;
                    if (count($tq3) > 0) {
                        $oldExitedId = $tq3['0']['tc_id'];
                        if ($oldExitedId == $tcid) {
                            $ts2 = "select transaction_id from transactions where `transaction_date` >= date_sub(now(), interval 1 minute) AND `transaction_date` < now() AND tc_id=" . $tcid . " AND user_id=" . $this->login_user_id . " AND vehicle_id=" . $vid . " AND paid_status=1";
                            $tq2 = $this->db->query($ts2);
                            $tc2 = $tq2->num_rows();
                            if ($tc2 == 1) {
                                $this->rest->response(responseObject(MY_CODE, '', '', '', 'You have already done transaction in this way. Try after 1 Minutes.'), CONFLICT_CODE);
                            }
                        }
                    }


                    //end else($tc==0)


                    /*                     * *********Start************* */
                    /* This code purly written for Rinroad
                      Start
                     */
                    $newTollCenterDetails = $this->db->select('*');
                    $this->db->from('beacons');
                    $this->db->join('toll_center', 'beacons.tc_id = toll_center.tc_id');
                    $this->db->where('beacons.major_id', $_POST['major_id']);
                    $this->db->where('beacons.minor_id', $_POST['minor_id']);
                    $query1 = $this->db->get()->result_array();
                    $tcid = $query1['0']['tc_id'];
                    $tstaffDetails = $this->db->query("select * from bmt_lane_mapping where tc_id=" . $tcid)->result_array();
                    $userLogDetails = $this->db->query("select * from ringroad where status=1 AND user_id=".$this->login_user_id)->result_array();
                    if ((count($userLogDetails) == 0 && $query1['0']['entry_type'] == "IN") || (isset($tstaffDetails['0']['ts_id']) && $tstaffDetails['0']['ts_id'] != '')) {
                        $tsid = "9999";
                    } else {
                        $tsid = '';
                    }
                    if ($tsid != '') {
                        $ringroad = $this->user_model->ringroad($_POST, $this->login_user_id);
                        //~ echo '<pre>';
                        //~ print_r($ringroad);
                        //~ exit;
						if($ringroad == "Entry and Exit cities are not same"){
							    /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Entry and Exit cities are not same')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
							$this->rest->response(responseObject(MY_CODE, '', '', nocontent, 'Entry and Exit cities are not same'), CONFLICT_CODE);
                            return;
						}
						
                        if ($ringroad == "User entry not detected") {
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('User entry not detected')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'User entry not detected'), CONFLICT_CODE);
                            return;
                        }
                        $userDetails = $this->db->query('select * from user_register where user_id =' . $this->login_user_id)->result_array();
                        if ($ringroad == "Toll charges not mapped properly") {
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Toll charges not mapped properly')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Toll charges not mapped properly'), CONFLICT_CODE);
                        }
                        if (count($userDetails) > 0) {
                            $authToken = $userDetails[0]['auth_token'];
                        }

                        if ($ringroad == 'User already detected') {
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('User already detected')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'User already detected'), CONFLICT_CODE);
                            return;
                        }
                        if (!$ringroad) {
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Please exit from Ringroad'), CONFLICT_CODE);
                            return;
                        }
                        if (isset($ringroad['msg'])) {
                            $data['msg'] = $ringroad['msg'];
                            $data['html_content'] = "";
                            $data['payment_flag'] = false;
                            $data['road_type'] = "ORR";
                            $data['msgcode'] = 123;
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('" . json_encode($data) . "')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success), SUCCESS_CODE);
                        }
                        if ($ringroad['0']->charge != '') {
                            $amount = $ringroad['0']->charge + 1;
                            $order_id = rand('123456', '999999');
                            //~ echo $query['0']['beacon_id']."<br/>";
                            //~ echo $query['0']['from_way_beacon_id']."<br/>";
                            //~ echo $query['0']['to_way_beacon_id']."<br/>";
                            //~ echo $query['0']['orr_from_way_beacon_id']."<br/>";
                            //~ echo $query['0']['orr_to_way_beacon_id']."<br/>";
                            //~ exit;
                            if($query['0']['from_way_beacon_id'] == $query['0']['beacon_id']){
                                $wayType = 1;
                            }elseif($query['0']['to_way_beacon_id'] == $query['0']['beacon_id']){
                                $wayType = 2;
                            }elseif($query['0']['orr_from_way_beacon_id'] == $query['0']['beacon_id']){
                                $wayType = 3;
                            }elseif($query['0']['orr_to_way_beacon_id'] == $query['0']['beacon_id']){
                                $wayType = 4;
                            }else{
								/* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Beacons Not maaped properly')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
								$this->db->query("delete from ringroad where status = 0 AND user_id=".$this->login_user_id);
                                $this->rest->response(responseObject(CONFLICT_CODE, '', '', '', 'Beacons Not maaped properly'), CONFLICT_CODE);
                                return;
                            }

echo "+"; exit;
                            $lanedetails = $this->db->query("select * from bmt_lane_mapping blm join bmt_lanes bl on blm.lane_id = bl.lane_id where blm.way_type =".$wayType."  AND blm.tc_id=" . $query['0']['tc_id'])->result_array();
                           // echo $this->db->last_query(); exit;
                            if(count($lanedetails)>0){
                                for($i=0;$i<count($lanedetails);$i++){
                                    $laneno[] = $lanedetails[$i]['lane_number'];
                                }
                            }else{
								/* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('No toll operators available. Please pay manually.')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
								$this->db->query("delete from ringroad where status = 0 AND user_id=".$this->login_user_id);
                                $this->rest->response(responseObject(MY_CODE, '', '', '', 'No toll operators available. Please pay manually.'), CONFLICT_CODE);
                                return;
                            }

                            $lanenos = implode(",",$laneno);
                            $lanenos = array_unique($lanenos);

                            $data['html_content'] = "http://bookmytoll.com/payment?total_amount=" . $amount . "&transaction_id=" . $order_id . "&user_id=" . $this->login_user_id . "&Authtoken=" . $authToken . "&lane_number=" . $lanenos;
                            $data['detected_by'] = "Beacon";
                            $userVehicleNo = $this->db->query("select * from vehicles v join vehicle_model vm on v.model_id = vm.model_id where v.vehicle_id=" . $_POST['vehicle_id'])->result_array();
                            if (count($userVehicleNo)) {
                                $data['default_vehicle'] = $userVehicleNo['0']['vehicle_no'];
                            }


                            if (count($query1)) {
                                $data['msg'] = "Welcome to " . $query1['0']['tc_name'] . " Toll Center";
                            }
                            $insert_data = array(
                                'tc_id' => $query1['0']['tc_id'],
                                'ts_id' => $tsid,
                                'user_id' => $this->login_user_id,
                                'reference_id' => $order_id,
                                'type_id' => 1,
                                'model_id' => $userVehicleNo['0']['model_id'],
                                'make_id' => $userVehicleNo['0']['make_id'],
                                'vehicle_id' => $userVehicleNo['0']['vehicle_id'],
                                'vehicle_no' => $userVehicleNo['0']['vehicle_no'],
                                'toll_charge' => $ringroad['0']->charge,
                                'bmt_charge' => 1,
                                'total_amount' => $amount,
                                'passing_status' => 0,
                                'paid_status' => 0,
                                'lane_id' => $lanenos,
                                'way_type' => $wayType,
                                'transaction_date' => date("Y-m-d H:i:s")
                            );
                            $data['payment_flag'] = true;
                            $data['road_type'] = "ORR";
                            $data['msgcode'] = 123;
                            $this->db->insert('transactions', $insert_data);
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('" . json_encode($data) . "')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success), SUCCESS_CODE);
                        }
                    } else {
                        /* -------------- Helpful for debugging purpose-------------------- */
                        $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('No toll operators available. Please pay manually.')";
                        $result1 = $this->db->query($sql1);
                        /* -------------- Helpful for debugging purpose ends-------------------- */
                        $this->rest->response(responseObject(MY_CODE, '', '', '', 'No toll operators available. Please pay manually.'), CONFLICT_CODE);
                    }
                    /*                     * *********End************* */
                }
            } else {
                //exit("sddsd");
                $CI = & get_instance();
                $query = $CI->db->query('select * from beacons b join toll_center tc on b.tc_id = tc.tc_id
                where tc.status_flag = 0 AND b.beacon_id ='.$_POST['beacon_id'])->result_array();
                $_POST['toll_id'] = $query['0']['tc_id'];
                $_POST['major_id'] = $query['0']['major_id'];
                $_POST['minor_id'] = $query['0']['minor_id'];
                if(count($query) == 0){
                    /* -------------- Helpful for debugging purpose-------------------- */
                    $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Toll center is inactive')";
                    $result1 = $this->db->query($sql1);
                    /* -------------- Helpful for debugging purpose ends-------------------- */
                    $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Toll center is inactive'), CONFLICT_CODE);
                    return;
                }
                if ($query[0]['toll_type_id'] == 1) {
                    $isUserDetectedBybeacon = $this->db->query("select * from transactions where tc_id=" . $_POST['toll_id'] . " AND user_id=" . $this->login_user_id . " AND paid_status = 0 AND passing_status = 0")->result_array();
                    if (count($isUserDetectedBybeacon) > 0) {
                        return $this->rest->response(responseObject(CONFLICT_CODE, '', '', '', 'User already detected by beacon'), CONFLICT_CODE);
                    }
                    $data = $this->user_model->beacon_method($_POST, $this->login_user_id);
                    $data['road_type'] = "NH";
                    $data['detected_by'] = "Beacon";

                    if (!empty($data)) {
                        $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Your Transaction Amount'), SUCCESS_CODE);
                        return;
                    } else {
                        $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                        return;
                    }
                } elseif ($query[0]['toll_type_id'] == 2) {
                    //exit("sdsad");
                    $vid2 = $_POST['vehicle_id'];
                    $tcid = $query[0]['tc_id'];
                    //~ echo $tcid."<br/>";
                    //~ echo $this->login_user_id."<br/>";
                    //~ echo $vid2;
                    //~ exit;

                    $ts3 = "select * from transactions where user_id=" . $this->login_user_id . " AND vehicle_id=" . $vid2 . " order by transaction_id DESC LIMIT 1";
                    $tq3 = $this->db->query($ts3)->result_array();
                    //echo $this->db->last_query(); exit;

                    $oldExitedId = $tq3['0']['tc_id'];
                    if ($oldExitedId == $tcid) {
                        $ts2 = "select transaction_id from transactions where `transaction_date` >= date_sub(now(), interval 2 minute) AND `transaction_date` < now() AND tc_id=" . $tcid . " AND user_id=" . $this->login_user_id . " AND vehicle_id=" . $vid2 . " AND paid_status=1";
                        $tq2 = $this->db->query($ts2);
                        $tc2 = $tq2->num_rows();
                        if ($tc2 == 1) {
                            $this->rest->response(responseObject(MY_CODE, '', '', '', 'You have already done transaction in this way. Try after 2 Minutes.'), CONFLICT_CODE);
                        }
                    }

                    $tcid = $_POST['toll_id'];
                    $tstaffDetails = $this->db->query("select * from bmt_lane_mapping where tc_id=" . $tcid)->result_array();
                    if (isset($tstaffDetails['0']['ts_id']) && $tstaffDetails['0']['ts_id'] != '') {
                        $tsid = $tstaffDetails['0']['ts_id'];
                    } else {
                        $tsid = '';
                    }
                    if ($tsid != '') {
                        $ringroad = $this->user_model->ringroad($_POST, $this->login_user_id);
                        //~ echo '<pre>';
                        //~ print_r($ringroad); exit;
                        if($ringroad == "Entry and Exit cities are not same"){
							    /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Entry and Exit cities are not same')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
							$this->rest->response(responseObject(MY_CODE, '', '', nocontent, 'Entry and Exit cities are not same'), CONFLICT_CODE);
                            return;
						}
                        if ($ringroad == "User entry not detected") {
							 /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('User entry not detected')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'User entry not detected'), CONFLICT_CODE);
                            return;
                        }
                        $userDetails = $this->db->query('select * from user_register where user_id =' . $this->login_user_id)->result_array();
                        if ($ringroad == "Toll charges not mapped properly") {
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('Toll charges not mapped properly')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Toll charges not mapped properly'), CONFLICT_CODE);
                        }
                        if (count($userDetails) > 0) {
                            $authToken = $userDetails[0]['auth_token'];
                        }

                        if ($ringroad == 'User already detected') {
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('User already detected')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'User already detected'), CONFLICT_CODE);
                            return;
                        }
                        if (!$ringroad) {
                            $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'Please exit from Ringroad'), CONFLICT_CODE);
                            return;
                        }
                        if (isset($ringroad['msg'])) {
                            $data['msg'] = $ringroad['msg'];
                            $data['html_content'] = "";
                            $data['payment_flag'] = false;
                            $data['road_type'] = "ORR";
                            $data['msgcode'] = 123;
                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('" . json_encode($data) . "')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success), SUCCESS_CODE);
                        }
                        if ($ringroad['0']->charge != '') {
                            $amount = $ringroad['0']->charge + 1;
                            $order_id = rand('123456', '999999');
                            //echo '<pre>';
                            //print_r($query); exit;
                            if($query['0']['from_way_beacon_id'] == $_POST['beacon_id']){
                                $wayType = 1;
                            }
                            if($query['0']['to_way_beacon_id'] == $_POST['beacon_id']){
                                $wayType = 2;
                            }
                            if($query['0']['orr_from_way_beacon_id'] == $_POST['beacon_id']){
                                $wayType = 3;
                            }
                            if($query['0']['orr_to_way_beacon_id'] == $_POST['beacon_id']){
                                $wayType = 4;
                            }

                            $lanedetails = $this->db->query("select * from bmt_lane_mapping blm join bmt_lanes bl on blm.lane_id = bl.lane_id where blm.way_type =".$wayType."  AND blm.tc_id=" . $query['0']['tc_id'])->result_array();
                            //echo $this->db->last_query(); exit;
                            if(count($lanedetails)>0){
                                for($i=0;$i<count($lanedetails);$i++){
                                    $laneno[] = $lanedetails[$i]['lane_number'];
                                }
                            }else{
                                $this->rest->response(responseObject(MY_CODE, '', '', '', 'No toll operators available. Please pay manually.'), CONFLICT_CODE);
                            }

                            $lanenos = implode(",",$laneno);
                            $lanenos = array_unique($lanenos);



                            $data['html_content'] = "http://bookmytoll.com/payment?total_amount=" . $amount . "&transaction_id=" . $order_id . "&user_id=" . $this->login_user_id . "&Authtoken=" . $authToken . "&lane_number=" . $lanenos;
                            $data['detected_by'] = "Beacon";
                            $userVehicleNo = $this->db->query("select * from vehicles v join vehicle_model vm on v.model_id = vm.model_id where v.vehicle_id=" . $_POST['vehicle_id'])->result_array();
                            if (count($userVehicleNo)) {
                                $data['default_vehicle'] = $userVehicleNo['0']['vehicle_no'];
                            }


                            if (count($query1)) {
                                $data['msg'] = "Welcome to " . $query1['0']['tc_name'] . " Toll Center";
                            }
                            $insert_data = array(
                                'tc_id' => $tcid,
                                'ts_id' => $tsid,
                                'user_id' => $this->login_user_id,
                                'reference_id' => $order_id,
                                'type_id' => 1,
                                'model_id' => $userVehicleNo['0']['model_id'],
                                'make_id' => $userVehicleNo['0']['make_id'],
                                'vehicle_id' => $userVehicleNo['0']['vehicle_id'],
                                'vehicle_no' => $userVehicleNo['0']['vehicle_no'],
                                'toll_charge' => $ringroad['0']->charge,
                                'bmt_charge' => 1,
                                'total_amount' => $amount,
                                'passing_status' => 0,
                                'paid_status' => 0,
                                'lane_id' => $lanenos,
                                'way_type' => $wayType,
                                'transaction_date' => date("Y-m-d H:i:s")
                            );
                            $data['payment_flag'] = true;
                            $data['road_type'] = "ORR";
                            $data['msgcode'] = 123;
                            $data['detected_by'] = "Geofence";
                            $this->db->insert('transactions', $insert_data);



                            /* -------------- Helpful for debugging purpose-------------------- */
                            $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('" . json_encode($data) . "')";
                            $result1 = $this->db->query($sql1);
                            /* -------------- Helpful for debugging purpose ends-------------------- */
                            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success), SUCCESS_CODE);
                        }
                    } else {
                        /* -------------- Helpful for debugging purpose-------------------- */
                        $sql1 = "INSERT INTO `response_log`(`response`) 
					VALUES ('No toll operators available. Please pay manually.')";
                        $result1 = $this->db->query($sql1);
                        /* -------------- Helpful for debugging purpose ends-------------------- */
                        $this->rest->response(responseObject(MY_CODE, '', '', '', 'No toll operators available. Please pay manually.'), CONFLICT_CODE);
                    }
                }
            }
        }
    }

    public function testbeaconPaid() {
        // echo somefun();exit;

        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('uuid', 'Beacon UUID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('major_id', 'Beacon Major Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('minor_id', 'Beacon Minor Id', 'trim|required|xss_clean');
        // pd($_POST);exit;
        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->beacon_service($_POST, $this->login_user_id);
            //  pd($data);exit;

            if (!empty($data)) {
//pd($data);exit;

                if ($data['msgcode'] == 400) {
                    //echo $data['msgcode'];exit;
                    $this->rest->response(responseObject(CONFLICT_CODE, '', '', nocontent, 'No content returns empty results'), CONFLICT_CODE);
                    return;
                } else {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Your Transaction Amount'), SUCCESS_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function latLagPaid() {
        // echo somefun();exit;
        //echo $this->login_user_id;exit;

        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        //$this->rest->response(responseObject(SUCCESS_CODE,'',$_POST,success,'Your Transaction Amount'),SUCCESS_CODE);
        //   return;
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|xss_clean');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|xss_clean');
        // echo "<pre>"; print_r($_POST['latitude']);exit;
        //pd($_POST);exit;
        if ($this->form_validation->run() == false) {
            // pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->latlong_method($_POST, $this->login_user_id);
            // pd($data);exit;
            if (!empty($data)) {
                if ($data == 4) {
                    $this->rest->response(responseObject(NO_CONTENT, '', '', nocontent, 'No content returns empty results'), NO_CONTENT);
                    return;
                } else {
                    $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Transaction Completed.'), SUCCESS_CODE);
                    return;
                }
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function getTollcenter() {
        //echo "sds";
        $data = $this->user_model->get_tollcenter($this->login_user_id);
        //  pd($data);exit;
        if (!empty($data)) {  // pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Toocenter List'), SUCCESS_CODE);
            return;
            // }
        } else {   //pd($data);exit;
            $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
            return;
        }
    }

    public function getWayTypes() {
        // echo somefun();exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('tc_id', 'Tollcenter', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->get_wayt_ypes_tc($_POST, $this->login_user_id);
            //  pd($data);exit;

            if (!empty($data)) {

                $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Your Transaction Amount'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function getLanesByToll() {
        // echo somefun();exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('tc_id', 'Tollcenter', 'trim|required|xss_clean');
        $this->form_validation->set_rules('way_type', 'Way', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->get_lanes_by_toll($_POST, $this->login_user_id);
            //  pd($data);exit;

            if (!empty($data)) {

                $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, 'Your Transaction Amount'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

    public function storeOrder() {

        // echo somefun();exit;
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tracking_id', 'Tracking Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_status', 'Order Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $data = $this->user_model->insert_order($_POST, $this->login_user_id);
            //  pd($data);exit;

            if (!empty($data)) {

                $this->rest->response(responseObject(SUCCESS_CODE, '', '', success, 'your transaction is successful.'), SUCCESS_CODE);
                return;
            } else {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE, '', '', fail, UNAUTHORIZED), UNAUTHORIZED_CODE);
                return;
            }
        }
    }

//end without wallet
// Previous function
    public function paynow1() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
//echo '<pre>';
//print_r($_POST);
//exit;
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
// error_reporting(E_ALL);
// set_time_limit(0);
// ini_set('display_errors',1);

            $merchant_data = '';
            $working_key = '989262C50960DD181D2BDAEFB9BDA993'; //Shared by test CCAVENUES
            $access_code = 'AVIY08CL00BR59YIRB'; //Shared by test CCAVENUES
//$access_code='4YRUXLSRO20O8NIH';//Shared by test CCAVENUES
            $currency = 'INR';
            $_POST['order_id'] = (int) $_POST['order_id'];
            $_POST['merchant_id'] = '85930';
            $_POST['currency'] = 'INR';

            foreach ($_POST as $key => $value) {
                $merchant_data.=$key . '=' . $value . '&';
            }
            $merchant_data = trim($merchant_data, '&');
//echo  $merchant_data;
//exit;
            $encrypted_data = $this->encrypt($merchant_data, $working_key); // Method for encrypting the data.
            $order_id = $_POST['order_id'];
            $amount = $_POST['amount'];
// echo "<pre>";print_r($encrypted_data);exit;

            $production_url = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;
//echo $production_url; exit;
//$html_content = '
//~ <form method="post" name="customerData" action="'.$production_url.'" class="form-horizontal" style="width:80%; margin:0 auto;">
            //~ <input type="hidden" name="tid" id="tid" readonly />
            //~ <input type="hidden" name="merchant_id" value="85930"/>
            //~ <input type="hidden" name="order_id" value="'.$order_id.'"/>
            //~ <input type="hidden" name="amount" value="'.$amount.'"/>
//~
            //~ <div class="form-group">
            //~ <label for="inputPassword3" class="col-sm-3 control-label" style="font-size:20px;">Your Charge</label>
            //~ <div class="inputcls">
            //~ <button class="btn btn-warning right_menu-button cmn-full-w-btn" style="background:#ffa611;width:100% !important; height:40px; padding: 0 !important; border:0; margin-top:10px; margin-bottom:10px; font-size:20px;" type="button"> Rs. '.$amount.'</button>
            //~ </div>
            //~ </div>
            //~ <input type="hidden" name="currency" value="INR"/>
            //~ <input type="hidden" name="redirect_url" value="http://bookmytoll.com/payment/response"/>
            //~ <input type="hidden" name="cancel_url" value="http://bookmytoll.com/payment/response"/>
            //~ <input type="hidden" name="language" value="EN"/>
            //~ <div class="form-group text-right">
            //~ <div id="btnid">
            //~ <button style="width: 100%; background: #000;
            //~ color: #fff;
            //~ padding: 10px;
            //~ margin-bottom: 10px; font-size:20px;" class="btn save_changes common-btn-pass" TYPE="submit">PayNow</button>
            //~ </div>
            //~ </div>
            //~ </form>
//~ ';
//~ $data['html_content'] = $html_content;
            $data['html_content'] = "http://bookmytoll.com/payment?total_amount=100&transaction_id=123465&user_id=1&lane_number=1&Authtoken=564818865895b59156c804954ccda52a";


            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, ''), SUCCESS_CODE);
        }
    }

//  TO handle payment gateway response
    public function response() {
        $msg = '';
        $data = array();
//	echo '<pre>';
        $workingKey = '989262C50960DD181D2BDAEFB9BDA993';  //Working Key should be provided here.
        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = $status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3)
                $order_status = $information[1];
        }
        if ($order_status === "Success") {
            //echo "<br><br>";
            $order = explode('=', $decryptValues[0]);
            $orderid = $order[1];
            $tracking = explode('=', $decryptValues[1]);
            $trackingid = $tracking[1];
            $orderstatus = explode('=', $decryptValues[3]);
            $status = $orderstatus[1];

            $amount = explode('=', $decryptValues[10]);
            $amt = $amount[1];
//echo $Authtoken; exit;
            //$this->rest->header("Authtoken",$Authtoken);
            $this->requestobj['order_id'] = $orderid;
            $this->requestobj['tracking_id'] = $trackingid;
            $this->requestobj['order_status'] = $status;
            $this->requestobj['amount'] = $amt;
            $this->requestobj['order_id'] = $orderid;
            //$this->requestobj['request'] = $data;

            $_POST = $this->requestobj;
            //$jsonObject = $this->bmt->user_params($_POST);
            $jsonObject = json_encode($_POST);
            // echo $jsonObject; exit;
            $data = $this->user_model->insert_order($_POST, $this->login_user_id);

            if ($order_status == "Success") {
                $this->db->query("delete from ringroad where user_id =" . $this->login_user_id);

                // print_r($response->response->UserInfo);exit;
                $msg = "<br>Thank you. Your transaction is successful.";
            } else {  //print_r($response);exit;
                $msg = @$response->error[0];
            }
        } else if ($order_status === "Aborted") {
            $msg = "<br>Thank you. We will keep you posted regarding the status of your order through e-mail";
        } else if ($order_status === "Failure") {
            $msg = "<br>Thank you.However,the transaction has been declined.";
        } else {
            $msg = "<br>Security Error. Illegal access detected";
        }
        $data['msg'] = $msg;
        $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, ''), SUCCESS_CODE);
    }

    public function getAmbulanceDetails() {
        // error_reporting(E_ALL);
// set_time_limit(0);
// ini_set('display_errors',1);
        $data1 = array();
        $finalArray = array();
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;

        $this->form_validation->set_rules('lat', 'Latitude', 'trim|required|xss_clean');
        $this->form_validation->set_rules('long', 'Longitude', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            //pd($_POST);exit;
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Please Provide The Necessary Parameters'), CONFLICT_CODE);
            return;
        } else {
            $ambulanceAreas = $this->db->query('select * from ambulance_contact')->result();
            for ($i = 0; $i < count($ambulanceAreas); $i++) {
                // Source Parametrs
                $prev_lat = $_POST['lat'];
                $prev_long = $_POST['long'];
                // Destination Parametrs
                $lat = $ambulanceAreas[$i]->lat;
                $long = $ambulanceAreas[$i]->long;
                $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $prev_lat . "," . $prev_long . "&destination=" . $lat . "," . $long . "&sensor=false&mode=driving&alternatives=true";
                $json = @file_get_contents($url);
                $data = json_decode($json);
                $distance = $data->routes[0]->legs[0]->distance->text;
                $distance_array = explode(' ', $distance);
                if (strtolower($distance_array[1]) == 'm') {
                    $distance_value = $distance_array[0] / 1000;
                } else {
                    $distance_value = $distance_array[0];
                }
                $finalArray[$ambulanceAreas[$i]->contact_no] = $distance_value;
            }
            $ambulanceNumber = min($finalArray);
            $ambulanceNumber = array_search($ambulanceNumber, $finalArray);
            if ($ambulanceNumber != '') {
                $data1['ambulance_number'] = (string) $ambulanceNumber;
                $this->rest->response(responseObject(SUCCESS_CODE, '', $data1, success, ''), SUCCESS_CODE);
            } else {
                $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'Sorry!!! No ambulance providers near to you'), CONFLICT_CODE);
                return;
            }
        }
    }

    public function isUserExited() {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        $this->db->query('delete from ringroad where status = 0 AND user_id =' . $this->login_user_id);
        $this->rest->response(responseObject(SUCCESS_CODE, '', "User Exit Deleted", success, ''), SUCCESS_CODE);
    }

// For Geo-Fencing

    public function geofence() {
        $tcDetail = $set = array();
        $tollCenters = $this->db->query('select * from tollcenter_coordinates')->result_array();
        for ($i = 0; $i < count($tollCenters); $i++) {
            $tollCenters[$i]['coordinates'] = trim(trim($tollCenters[$i]['coordinates'], ' '), ';');
            $splitCoordinates = explode(';', $tollCenters[$i]['coordinates']);
            for ($j = 0; $j < count($splitCoordinates); $j++) {
                $splitlatLong = explode(',', $splitCoordinates[$j]);
                $tcDetail['lat'] = trim($splitlatLong['0']);
                $tcDetail['lng'] = trim($splitlatLong['1']);
                $tcDetail['tc_id'] = trim($tollCenters[$i]['tc_id']);
                $tcDetail['radius'] = trim($tollCenters[$i]['radius']);
                $tcDetail['beacon_id'] = trim($tollCenters[$i]['beacon_id']);
                $set[] = $tcDetail;
            }
        }
        $beacons = $this->db->query('select * from beacons')->result_array();
        $data['beacons'] = $beacons;
        if (count($set) > 0) {
            $data['toll_centers'] = $set;
            $data['radius'] = RADIUS;
            $this->rest->response(responseObject(SUCCESS_CODE, '', $data, success, ''), SUCCESS_CODE);
        } else {
            $this->rest->response(responseObject(CONFLICT_CODE, validation_errors(), '', fail, 'No results found'), CONFLICT_CODE);
            return;
        }
        //~ 
        //~ $tollCenters1 = $this->db->query('select tc_id,tc_name,lat,lng from toll_center where toll_type_id =1')->result_array();
        //~ $tollCenters2 = $this->db->query('select tc_id,tc_name,to_lat as lat,to_lag as lng from toll_center where toll_type_id =1')->result_array();
        //~ $tollCenters = array_merge($tollCenters1,$tollCenters2);
        //~ $beacons = $this->db->query('select * from beacons')->result_array();
        //~ $data['beacons'] = $beacons;
        //~ if(count($tollCenters) > 0){
        //~ $data['toll_centers'] = $tollCenters;
        //~ $data['radius'] = RADIUS;
        //~ $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,''),SUCCESS_CODE);
        //~ }
        //~ else{
        //~ $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'No results found'),CONFLICT_CODE);
        //~ return;
        //~ }
    }

// CC Avenue library functions begins

    public function encrypt($plainText, $key) {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);
        }
        return bin2hex($encryptedText);
    }

    public function decrypt($encryptedText, $key) {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);
        return $decryptedText;
    }

    //*********** Padding Function *********************

    public function pkcs5_pad($plainText, $blockSize) {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    public function hextobin($hexString) {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString.=$packedString;
            }

            $count+=2;
        }
        return $binString;
    }

    // CC Avenue library functions Ends
}

#End of file: login.php
#Location: application/controllers/api/login.php
