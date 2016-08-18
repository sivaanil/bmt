<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|-----------------------------------------------------------------------------
|User / Business related constants...
|-----------------------------------------------------------------------------
*/


/*
|----------------------------------------------------------------------------
|Declaring status codes :
|Using only important code.
|----------------------------------------------------------------------------
*/
define("SUCCESS_CODE",200);
define("ERROR",204);
define("MY_CODE",677);
define("BADREQUEST_CODE",400);
define("FORBIDDEN_CODE",403);
define("UNAUTHORIZED_CODE",401);
define("REGISTER_UNAUTH_CODE",405);
define("SERVERERROR_CODE",500);
define("CONFLICT_CODE",409);
/*
|-------------------------------------------------------------------------
|Messages to be attached to the response of the each request
|based on status of the processing of the request
|-------------------------------------------------------------------------
*/
define('BAD_REQUEST',"Bad Request. Missing required parameters.");
define("INVALID_DATA","Invalid data");
define("MISSING_PERMISSION","Unauthorized request");
define("LOGIN_FAILED","Invalid Credentials");
define("INACTIVATE","It could be either your account or department or business is inactive, please contact your admin for details");
define("AUTH_TOKEN1","Authtoken Expired / Invalid.");
define("CONNECTIONERROR", "Connection error, please try again.");
define("CREATEDONE","created successfully.");
define("DELETEDONE","deleted successfully.");
define("UPDATEDONE","updated successfully.");
define("LOGOUTDONE","user logged out successfully.");
define("fail","fail");
define("success","success");
define("nocontent","nocontent");
define("UNAUTHORIZED","Unauthorised Access");
define("REGISTER_UNAUTHORIZED","Unauthorised Access Or Not yet Verified your account");
define("SERVER_ERROR","Due to Network problem.Try After Some Time");
define("OTP_ACTIVATION_ERROR","Invalid OTP");
define("EMAIL_ACTIVATION_ERROR","Invalid activation code");
define("ADMIN_EMAIL","malola2508@gmail.com");
define("SITE_EMAIL","info@bookmytoll.com");
define('base_path',dirname($_SERVER['SCRIPT_FILENAME']));
define('USER_IMG_PATH', base_path."/uploads/");
define("BLOCKED_ERROR","You Or Your Toll Center Was In Inactive State");
define('USER_DOCUMENT_PATH', base_path."/uploads/documents/");
define("RADIUS","100");
/*

*/
date_default_timezone_set('Asia/Kolkata');
//Android App
define("GOOGLE_API_KEY", "AIzaSyD3sfg8eByZmDCPxi6WfxW0GAWOGE3879M");
// image path

/* End of file constants.php */
/* Location: ./application/config/constants.php */
