<?php
/**
 * 
 * Filter post and get input
 * @author Saeed Moqadam
 *
 */ 
class Artemis_Input
{
	

	function __construct()
	{
	}
        
        /**
         *
         * @return type 
         */
        function isAjax()
        {
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                return true;
            }
            return false;
        }
        
	/**
	*
	* clean and return $_GET request 
	*
	* @param : index :: index of $_GET request
	* @access public
	*/
	public function get($index = NULL)
	{
		$out = array();
		if($index === NULL AND !empty($_GET))
		{
			if(isset($_GET) )
			{
				foreach ($_GET as $key=>$val)
				{
					$out[$key] = $this->clean($val);	
				}
				return $out;
			}
			else throw new Artemis_Input_Exception('$_GET Not Set');
		}else
		{
			return $this->clean($_GET[$index]);	
		}
	}
	
	/**
	*
	* clean and return $_POST request 
	*
	* @param : index :: index of $_POST request
	* @access public
	*/
	public function post($index = NULL)
	{
		$out = array();
		if($index === NULL AND !empty($_POST))
		{
			  foreach ($_POST as $key=>$val)
			  {
				  $out[$key] = $this->clean($val);	
			  }
			  return $out;
		}
		else
		{
			return $this->clean($_POST[$index]);	
		}
	}
	
	
	
	/**
	 * Cleaning Input Script
	 * Copyright 2009 - www.pgmr.co.uk - contact@pgmr.co.uk
	 */
	function clean($str) 
	{
		if(is_array($str))
			array_map(array('Input','clean'),$str);
		if(!get_magic_quotes_gpc()) {
			$str = addslashes($str);
		}
			$str = strip_tags(htmlspecialchars($str));
		return $str;
	}
	
}