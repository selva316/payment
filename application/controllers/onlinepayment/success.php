<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Success extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		
	}
	
	public function index()
	{
		
		if(isset($_GET) && count($_GET)>0)
		{
			$amznPmtsOrderIds = $_GET['amznPmtsOrderIds'];
			$amznPmtsReqId = $_GET['amznPmtsReqId'];
			$amznPageSource = $_GET['amznPageSource'];
			$merchName = $_GET['merchName'];
			$amznPmtsYALink = $_GET['amznPmtsYALink'];
			$amznPmtsPaymentStatus = $_GET['amznPmtsPaymentStatus'];
			$actionToken = $_GET['actionToken'];
			
		}
		else
		{
			echo "<H1>Payment Failed!!!</H1>";
		}
		
	} 		
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */