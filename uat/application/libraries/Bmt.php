<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bmt
{
	private $userdefaults = array(
						'request'    => NULL,
						'userID'	 => NULL,
						'roleID'	 => NULL,
						'businessID' => NULL,
						'deptID'     => NULL
	                  );

	public function __construct()
	{
		$CI = & get_instance();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		return false;
	}

	/**
	 * [user_params description]
	 * @param  [type] $request [description]
	 * @param  array  $params  [description]
	 * @param  [type] $delete  [description]
	 * @return [type]          [description]
	 */
	public function user_params($request, $params = array(), $unsetindexes = array())
	{
		if(count($params))
		{
			$resposnecode = $this->_intialize($params);
		}
		else
		{
			$resposnecode = $this->userdefaults;
		}

		if(count($unsetindexes))
		{
			$resposnecode = $this->_composevariables($resposnecode,$unsetindexes);
		}

		$resposnecode['request'] = $request;
		return json_encode($resposnecode);
	}

	/**
	 * [_intialize description]
	 * @param  [type] $actuallarray   [description]
	 * @param  [type] $intializearray [description]
	 * @return [type]                 [description]
	 */
	private function _intialize($intializearray)
	{
		$keyslist = array_keys($this->userdefaults);
		foreach ($intializearray as $key => $value)
		{
			if(in_array($key, $keyslist))
			{
				$this->userdefaults[$key] = $value;
			}
		}

		return $this->userdefaults;
	}

	private function _composeVariables($mainarray,$unsetindexesarray)
	{
		$keyslist = array_keys($mainarray);
		foreach ($unsetindexesarray as $key => $value)
		{
			if(in_array($value, $keyslist))
			{
				unset($mainarray[$value]);
			}
		}
		return $mainarray;
	}

	public function autologout()
	{
		$CI = & get_instance();
        $CI->session->set_flashdata('message','Unautharized Permissions');
        redirect("user/logout",'refresh');
	}

	
}

/* End of file Mipproperties.php */
/* Location: ./application/libraries/Mipproperties.php */