<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditProduct extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		
	}
	
	public function index()
	{
		$hashitemcode = $_GET['itemcode'];
		
		$this->load->model('quotationmodel');
		$data = $this->quotationmodel->fetchProductDetails($hashitemcode);
		
		$this->load->view('admin/editproduct',$data);
		//print "Welcome";
	} 		
	
	public function datainsert()
	{
		if(isset($_POST))
		{
			
			$this->load->model('quotationmodel');
			$id = $this->quotationmodel->edit_product();
			
		}
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */