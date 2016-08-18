<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadminlogin extends CI_Controller
{
    private $loginObj = [
                            'email'     => NULL,
                            'password'  => NULL,
                        ];

    private $objKeys = [];                  

    protected $requestObject = NULL;

	public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Expose-Headers: Authtoken');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authtoken, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        parent::__construct();
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        $this->requestObject = $this->rest->post("request");
        $this->load->model('tollstaff_model','tollstaff');
        $this->objkeys       = array_keys($this->loginObj);
        $this->load->library('email');
    }

    public function userlogin()
    {
        $this->rest->validateRequestObject($this->objkeys,$this->requestObject);
        $_POST = $this->requestObject;
        $this->form_validation->set_rules('email', 'Eamil', 'trim|required|valid_email|max_length[30]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[30]|xss_clean');
        if($this->form_validation->run() == false){
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
          
        }
        else
        {
            $data = $this->tollstaff->login($_POST);
            if(count($data))
            {
               header('authtoken:'.$data['auth_token']);
               //unset($data['auth_token']);
               
               if(isset($data['status']) && $data['status'] == 401)
               {
                    $this->rest->response(responseObject(UNAUTHORIZED_CODE,BLOCKED_ERROR,'',fail,''));
                    return; 
               }
               $TollStaffInfo['TollStaffInfo'] = $data;
               $this->rest->response(responseObject(SUCCESS_CODE,'',$TollStaffInfo,success,'Login Successfull'));
               return; 
            }
            else
            {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE,LOGIN_FAILED,'',fail,''));
                return; 
            }
        }
    }

    public function foretPassword()
    {
        $_POST = $this->requestObject;
        $this->form_validation->set_rules('email', 'Eamil', 'trim|required|valid_email|max_length[30]|xss_clean');
        if($this->form_validation->run() == true)
        {
            $table_name = 'toll_staff';
            $where_condition = array('email_id'=>$_POST['email']);
            $num_count = getNumberOfRecords($table_name,$where_condition);
            if($num_count)
            {
                $table_name = 'toll_staff';
                $where_condition = array('email_id'=>$_POST['email']);
                $column = 'password,email_id';
                $data = getRequireFields($table_name,$where_condition,$column);

                $to      = $data['email_id'];
                $subject = "Your Password for BMT Login";
                $data = array('email' => $to,'password'=>$data['password']);
                $message = $this->load->view('email/email_password',$data,true);
                sendPassword($message,$to,$subject);
                $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Please Check Your Email For Password'));
                return;
            }
            else
            {
                $this->rest->response(responseObject(CONFLICT_CODE,'This Email Is Not Registered','',fail,''));
                return;
            }
        }
        else
        {
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provid The Necessary Parameters'));
            return;
        }
    }

  
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
