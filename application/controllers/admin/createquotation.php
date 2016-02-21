<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateQuotation extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
	}
	
	public function index()
	{
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
						array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
															);
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '430px';
		$this->ckeditor->config['height'] = '200px'; 
				
		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/'); 

		$this->load->view('admin/createquotation');
		//print "Welcome";
	} 		
	
	public function datainsert()
	{
		if(isset($_POST))
		{
			$data = array();
				
			$data['name'] = $this->input->post('name');
			$data['contact'] = $this->input->post('contactno');
			$data['address'] = $this->input->post('address');
			$data['retailcontact'] = $this->input->post('retail_contact');
			$data['maildid'] = $this->input->post('mailid');
			$data['tin'] = $this->input->post('tin');
			$data['cst'] = $this->input->post('cst');
			$data['salesperson'] = $this->input->post('salesperson');
			$data['term'] = $this->input->post('term');
			$data['refnumber'] = $this->input->post('refnumber');
			$data['quotationdate'] = strtotime($this->input->post('quotationdate'));
			$data['timestamp'] = time();
			$data['status'] = 'Initiated';
			$data['subtotal'] = $this->input->post('sub_total');
			$data['taxtotal'] = $this->input->post('taxtotal');
			$data['roundoff'] = $this->input->post('round_off');
			$data['netamount'] = $this->input->post('netamount');
			$data['CUSTOMERPAYMENT_STATUS'] = 'Not yet';
			
			$this->load->model('quotationmodel');
			$id = $this->quotationmodel->add_quotation($data);
			
		}
	}
	
	public function dataedit()
	{
		if(isset($_POST))
		{
			$data = array();
				
			$data['name'] = $this->input->post('name');
			$data['contact'] = $this->input->post('contactno');
			$data['address'] = $this->input->post('address');
			$data['retailcontact'] = $this->input->post('retail_contact');
			$data['maildid'] = $this->input->post('mailid');
			$data['tin'] = $this->input->post('tin');
			$data['cst'] = $this->input->post('cst');
			$data['salesperson'] = $this->input->post('salesperson');
			$data['term'] = $this->input->post('term');
			$data['refnumber'] = $this->input->post('refnumber');
			$data['quotationdate'] = strtotime($this->input->post('quotationdate'));
			$data['timestamp'] = time();
			$data['status'] = 'Initiated';
			$data['subtotal'] = $this->input->post('sub_total');
			$data['taxtotal'] = $this->input->post('taxtotal');
			$data['roundoff'] = $this->input->post('round_off');
			$data['netamount'] = $this->input->post('netamount');
		
			
			$this->load->model('quotationmodel');
			$id = $this->quotationmodel->edit_quotation($data);
			
		}
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */