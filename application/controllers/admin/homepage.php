<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

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
		//$data['main_content'] = 'login_form';
		//$this->load->view('includes/template',$data);
		$data = array();
		$this->load->model('quotationmodel');
		$data['result'] = $this->quotationmodel->fetchAllQuotation();
		
		
		$this->load->view('admin/homepage',$data);
	}
	
	public function ajax()
	{
		$type = $this->input->post('type');
		if($type =="description" || $type =="upc")
		{
			$this->load->model('quotationmodel');
			$data = $this->quotationmodel->ajaxcall();
			echo json_encode($data);
		}
	}
	
	public function word()
	{
		$amt =$this->input->post('amount');
		echo "Rupees ".ucfirst($this->no_to_words($amt).' only /-');
	}
	
	public function no_to_words($no)
	{   
		$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred ','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
		if($no == 0)
			return ' ';
		else {
			$novalue='';
			$highno=$no;
			$remainno=0;
			$value=100;
			$value1=1000;       
			while($no>=100)    {
				if(($value <= $no) &&($no  < $value1))    
				{
					$novalue=$words["$value"];
					$highno = (int)($no/$value);
					$remainno = $no % $value;
					break;
				}
				$value= $value1;
				$value1 = $value * 100;
			}       
			if(array_key_exists("$highno",$words))
				return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
			else {
				$unit=$highno%10;
				$ten =(int)($highno/10)*10;            
				return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
			}
		}
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */