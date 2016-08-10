<?php 

class API extends API_Contorller{
	public $output=array();
	function json($key=null,$action=null,$name=null,$id=null)
	{
		$this->load->library('jsonapi',[$key,$action]);
		$this->jsonapi->isNotAuth($key);
		$this->jsonapi->proccess($action,$name,$id);
		$this->jsonapi->output();
	}
}
