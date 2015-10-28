<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onlinepayment extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		ob_start();
		header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
		ob_clean();
		//$this->output->nocache();
	}
	
	public function index()
	{
		$hashqid = $_GET['qid'];
		$data = array();
		$this->load->model('quotationmodel');
		$data['data'] = json_encode($this->quotationmodel->fetchQuotationDetails($hashqid));
		
		$this->load->view('admin/onlinepayment',$data);
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */