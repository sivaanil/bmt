<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle extends CI_Controller
{
    private $loginObj = [
                            'login'     => NULL,
                            'password'  => NULL,
                        ];

    private $objKeys = [];    
    
    private $regObj = [
                            'first_name' => NULL,
                            'last_name'  => NULL,
                            'email_id'   => NULL,
                            'password'  => NULL,
                            'mobile_no' => NULL,
                        ];
 
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
        $this->load->model('vehicle_model');
        
        $this->login_user_details =  getWebLoginUserId();
       $this->login_user_id      =  $this->login_user_details['user_id'];
        
    }
public function getTypes()
    {  
    $data = $this->vehicle_model->get_types();
    if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Vehicle Types List'),SUCCESS_CODE);
               return;
        }
       else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
       }  
    }
    public function getMakes($typeid)
    {
        $data = $this->vehicle_model->get_makes($typeid);
        if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Vehicle Makes List'),SUCCESS_CODE);
            return;
        }
           else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
       } 
    }
    public function getModels($makeid)
    {
        $data = $this->vehicle_model->get_models($makeid);
        if(!empty($data))
        {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data,success,'Vehicle Models List'),SUCCESS_CODE);
            return;
        }
           else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
       } 
    }
    public function getVehicleDetails(){
         $data = $this->vehicle_model->getVehicles($this->login_user_id);
    //print_r($data);
    if(!empty($data))
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'',$data['result'],success,$data['msg']),SUCCESS_CODE);
               return;
            }
       else{         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
           
       }
    }
    public function addVehicle()
    {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        
       $this->form_validation->set_rules('type_id', 'Vehicle Type', 'trim|required|xss_clean');
       $this->form_validation->set_rules('make_id', 'Vehicle Make', 'trim|required|xss_clean');
       $this->form_validation->set_rules('model_id', 'Vehicle Model', 'trim|required|xss_clean');
       $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|is_unique[vehicles.vehicle_no]|xss_clean');
            
      // $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|callback_check_password');
       
        if($this->form_validation->run() == false)
        {
            
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {                 
        $returnid = $this->vehicle_model->add_vehicle($_POST,$this->login_user_id);       
        if(count($returnid))
        {  //  pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Vehicle Added Successfully'),SUCCESS_CODE);
            return;
        }
           else
       {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
       }
      }
    }
    public function editVehicle()
    {
        $this->requestObject = $this->rest->post("request");
        $_POST = $this->requestObject;
        
       $this->form_validation->set_rules('type_id', 'Vehicle Type', 'trim|required|xss_clean');
       $this->form_validation->set_rules('make_id', 'Vehicle Make', 'trim|required|xss_clean');
       $this->form_validation->set_rules('model_id', 'Vehicle Model', 'trim|required|xss_clean');
       $this->form_validation->set_rules('vehicle_no', 'Vehicle Number', 'trim|required|xss_clean');
       $this->form_validation->set_rules('enable_status', 'Vehicle Number', 'trim|required|xss_clean');
       $this->form_validation->set_rules('default_status', 'Vehicle Number', 'trim|required|xss_clean');
      // $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|callback_check_password');
       
        if($this->form_validation->run() == false)
        {           
            $this->rest->response(responseObject(CONFLICT_CODE,validation_errors(),'',fail,'Please Provide The Necessary Parameters'),CONFLICT_CODE);
            return;      
        }
        else
        {                  
         $returnid = $this->vehicle_model->update_vehicle($_POST,$this->login_user_id);
        if($returnid>0)
        {  //  pd($data);exit;
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Vehicle Updated Successfully'),SUCCESS_CODE);
            return;
        }
        else
        {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return; 
        }
      }
     }
     public function deleteVechicle($vehicle_id){
        $data = $this->vehicle_model->deleteVehicles($this->login_user_id,$vehicle_id);
    //print_r($data);
    if($data>0)
            {   
            $this->rest->response(responseObject(SUCCESS_CODE,'','',success,'Vehicle Deleted Successfully'),SUCCESS_CODE);
            return;
            }
       else
           {         
           $this->rest->response(responseObject(UNAUTHORIZED_CODE,'','',fail,UNAUTHORIZED),UNAUTHORIZED_CODE);
           return;           
           } 
     }
}
#End of file: login.php
#Location: application/controllers/api/login.php                                                                                          
