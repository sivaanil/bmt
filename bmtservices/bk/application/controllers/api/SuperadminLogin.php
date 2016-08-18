<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperadminLogin extends CI_Controller
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
        //$this->load->library('authorization');
        $this->objkeys       = array_keys($this->loginObj);
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
               unset($data['auth_token']);
               $TollStaffInfo['TollStaffInfo'] = $data;
               $this->rest->response(responseObject(SUCCESS_CODE,'',$TollStaffInfo,success,'Login Successfull'));
               return; 
            }
            else
            {
                $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED));
                return; 
            }
        }
    }

  
}

#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
