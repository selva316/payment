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
		print_r($_GET);		
		if(isset($_GET) && count($_GET)>0)
		{
			$data = array();
			$data['amznPmtsOrderIds'] = $_GET['amznPmtsOrderIds'];
			$data['amznPmtsReqId'] = $_GET['amznPmtsReqId'];
			$data['amznPageSource'] = $_GET['amznPageSource'];
			$data['merchName'] = $_GET['merchName'];
			$data['amznPmtsYALink'] = $_GET['amznPmtsYALink'];
			$data['amznPmtsPaymentStatus'] = $_GET['amznPmtsPaymentStatus'];

			$this->load->model('quotationmodel');
			$id = $this->quotationmodel->paymentTransaction($data);
			
		}
		else
		{
			echo "<H1>Payment Failed!!!</H1>";
		}
		
	} 		
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
