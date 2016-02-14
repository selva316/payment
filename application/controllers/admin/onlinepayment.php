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
		//ini_set('include_path','../..');
		/*
		$this->load->library('signature/merchant/cart/html/MerchantHTMLCartFactory');
		$this->load->library('signature/common/cart/xml/XMLCartFactory');
		$this->load->library('signature/common/signature/SignatureCalculator');
		*/
		
		$this->load->library('signature/MerchantHTMLCartFactory');
		$this->load->library('signature/XMLCartFactory');
		$this->load->library('signature/SignatureCalculator');
		
		
		$hashqid = $_GET['qid'];
		$data = array();
		$this->load->model('quotationmodel');

		$status = $this->quotationmodel->statusDetails($hashqid);
		if($status != 'Initiated')
		{
			$data['status'] = 'Processing';
			$this->load->view('admin/error',$data);
		}
		else
		{

			$quotationdetails = $this->quotationmodel->fetchQuotationDetails($hashqid);
			
			// seller credentials - enter your own here
			$merchantID="ALLF7QV9XOHDI";
			$accessKeyID="AKIAJU37QL3EGT44PQFQ";
			$secretKeyID="ABok3jwHNgQSZMtho8yu5iHZm45QY0Hq4v3dwMKN";

			/////////////////////////////////////////////////////////
			// XML cart demo
			// Create the cart and the signature
			/////////////////////////////////////////////////////////
			$cartFactory = new XMLCartFactory();
			$calculator = new SignatureCalculator();

			$cart = $cartFactory->getSignatureInput($merchantID, $accessKeyID, $quotationdetails, $hashqid);
			$signature = $calculator->calculateRFC2104HMAC($cart, $secretKeyID);
			$cartHtml = $cartFactory->getCartHTML($merchantID, $accessKeyID, $signature, $quotationdetails, $hashqid);

			$data['cartHtml'] = $cartHtml;
		
			
			$data['data'] = json_encode($this->quotationmodel->fetchQuotationDetails($hashqid));
			
			$this->load->view('admin/onlinepayment',$data);
		}

	}
	
	public function success()
	{
		print "success";
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */