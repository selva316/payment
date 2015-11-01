<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cancel extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		
	}
	
	public function index()
	{
		echo "Cancel";
	} 		
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */