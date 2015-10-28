<?php 
class Quotationmodel extends CI_Model {
	
	function fetchAllQuotation()
	{
		$this->db->select('*');
		$this->db->from('py_quotation');
		
		$itemdata = array();
		$itemquery = $this->db->get();
		$productdata = array();
		if($itemquery->num_rows() > 0)
		{
			return $itemquery->result_array();
		}
	}
	
	function fetchAllProduct()
	{
		$this->db->select('*');
		$this->db->from('py_product_details');
		
		$itemdata = array();
		$itemquery = $this->db->get();
		$productdata = array();
		if($itemquery->num_rows() > 0)
		{
			return $itemquery->result_array();
		}
	}
	
	function ajaxcall()
	{
		
		$type = $this->input->post('type');
		$name = $this->input->post('name_startsWith');
			
		$query = $this->db->query("select ITEMCODE,DESCRIPTION,PRICE from py_product_details where (UPPER($type) LIKE '".strtoupper($name)."%')");
		$data = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			foreach($result as $row)
			{
				$name = $row['ITEMCODE'].'|'.$row['DESCRIPTION'].'|'.$row['PRICE'];//i am not want item code i,eeeeeeeeeeee
				array_push($data, $name);
			}
		}
		return $data;
		
	}
	
	function add_quotation($data)
	{
		$this->db->insert('py_quotation', $data); 
		$autoid = $this->db->insert_id();
		
		$this->db->where('id', $autoid);
		$qid = 'Q'.$autoid;
		$hashqid = md5($qid.time());
		$this->db->set('QID', $qid);
		$this->db->set('HASHQID', $hashqid);
		
		$this->db->update('py_quotation');
		
		$number_of_entries = count($this->input->post('itemName'));
		//print "selva: ".$number_of_entries;
		if($number_of_entries >=0)
		{
			for($i=0; $i<$number_of_entries; $i++) {
				$itemlist = array();
				
				$itemcode = $this->input->post('itemCode');
				$description = $this->input->post('itemName');
				$quantity = $this->input->post('quantity');
				$price = $this->input->post('price');
				$tax_percent = $this->input->post('taxP');
				$tax = $this->input->post('tax');
			
				if($quantity[$i] == "" || $quantity[$i] == 0)
					continue;
				
				
				$itemlist['ITEMCODE'] =  $itemcode[$i];
				$itemlist['DESCRIPTION'] = $description[$i];
				$itemlist['QUANTITY'] = $quantity[$i];
				$itemlist['PRICE'] = $price[$i];
				$itemlist['taxpercent'] = $tax_percent[$i];
				$itemlist['qid'] = $qid;
				
				$this->db->insert('py_items', $itemlist); 
			}
		}
		redirect('admin/homepage');
	}
	
	public function fetchQuotationDetails($qid)
	{
		$query = $this->db->query("select * from py_quotation where hashqid = '".$qid."'");
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$data = array();
			foreach($result as $row)
			{
				$data['qid'] = $row['QID'];
				$data['hashqid'] = $row['HASHQID'];
				$data['name'] = $row['NAME'];
				$data['contact'] = $row['CONTACT'];
				$data['address'] = $row['ADDRESS'];
				$data['retailcontact'] = $row['RETAILCONTACT'];
				$data['maildid'] = $row['MAILDID'];
				$data['tin'] = $row['TIN'];
				$data['cst'] = $row['CST'];
				$data['term'] = $row['TERM'];
				$data['refnumber'] = $row['REFNUMBER'];
				$data['salesperson'] = $row['SALESPERSON'];
				$data['quotationdate'] = $row['QUOTATIONDATE'];
				$data['timestamp'] = $row['TIMESTAMP'];
				$data['status'] = $row['STATUS'];
				$data['subtotal'] = $row['SUBTOTAL'];
				$data['taxtotal'] = $row['TAXTOTAL'];
				$data['roundoff'] = $row['ROUNDOFF'];
				$data['netamount'] = $row['NETAMOUNT'];
				$data['amtinwords'] = $this->no_to_words($row['NETAMOUNT']);
			
		
				$this->db->select('*');
				$this->db->from('py_items');
				$this->db->where('qid', $row['QID']);
				$itemdata = array();
				$itemquery = $this->db->get();
				
				if($itemquery->num_rows() > 0)
				{
					$itemresult = $itemquery->result_array();
					$i = 0;
					foreach($itemresult as $itemrow)
					{
						
						$itemdata[$i]['itemcode'] = $itemrow['ITEMCODE'];
						$itemdata[$i]['description'] = $itemrow['DESCRIPTION'];
						$itemdata[$i]['quantity'] = $itemrow['QUANTITY'];
						$itemdata[$i]['price'] = $itemrow['PRICE'];
						$itemdata[$i]['disable'] = $itemrow['DISABLE'];
						$itemdata[$i]['taxpercent'] = $itemrow['taxpercent'];

						$i++;
					}
				}
				$data['itemdetails'] = $itemdata;
			}
			return $data;
		}
	}	
	
	function edit_quotation($data)
	{
		
		$autoid = $this->db->insert_id();
		$qid = $this->input->post('qid');
		$this->db->where('qid', $qid);
		
		$this->db->update('py_quotation', $data);
		
		/* Existing Product Item */
		$this->db->select('*');
		$this->db->from('py_items');
		$this->db->where('qid', $qid);
		$itemdata = array();
		$itemquery = $this->db->get();
		
		if($itemquery->num_rows() > 0)
		{
			$itemresult = $itemquery->result_array();
			
			foreach($itemresult as $itemrow)
			{
				$itemdata = array();
				$itemdata['itemcode'] = $itemrow['ITEMCODE'];
				$itemdata['description'] = $itemrow['DESCRIPTION'];
				$itemdata['quantity'] = $itemrow['QUANTITY'];
				$itemdata['price'] = $itemrow['PRICE'];
				$itemdata['disable'] = $itemrow['DISABLE'];
				$itemdata['taxpercent'] = $itemrow['taxpercent'];
				$itemdata['qid'] = $itemrow['qid'];
				$itemdata['timestamp'] = time();
				$this->db->insert('py_audit_items', $itemdata);
			}
		}
		/*  --------- */		
		
		$this->db->where('qid', $qid);
		$this->db->delete('py_items'); 
			
		$number_of_entries = count($this->input->post('itemName'));
		//print "selva: ".$number_of_entries;
		if($number_of_entries >=0)
		{
			for($i=0; $i<$number_of_entries; $i++) {
				$itemlist = array();
				
				$itemcode = $this->input->post('itemCode');
				$description = $this->input->post('itemName');
				$quantity = $this->input->post('quantity');
				$price = $this->input->post('price');
				$tax_percent = $this->input->post('taxP');
				$tax = $this->input->post('tax');
			
				if($quantity[$i] == "" || $quantity[$i] == 0)
					continue;
				
				
				$itemlist['ITEMCODE'] =  $itemcode[$i];
				$itemlist['DESCRIPTION'] = $description[$i];
				$itemlist['QUANTITY'] = $quantity[$i];
				$itemlist['PRICE'] = $price[$i];
				$itemlist['taxpercent'] = $tax_percent[$i];
				$itemlist['qid'] = $qid;
				
				$this->db->insert('py_items', $itemlist); 
			}
		}
		redirect('admin/homepage');
	}
	
	function add_product()
	{
		$number_of_entries = count($this->input->post('itemName'));
		print "selva: ".$number_of_entries;
		if($number_of_entries >=0)
		{	
			
			for($i=0; $i<$number_of_entries; $i++) {
				//print_r($_POST);
				$itemlist = array();
				
				$description = $this->input->post('itemName');
				$price = $this->input->post('price');
				$tax_percent = $this->input->post('taxP');
				//print $description[$i]."--".$price[$i]."--".$tax_percent[$i];
				
				if(strlen($description[$i]) <= 0)
					continue;
				
				//print $description[$i]."--".$price[$i]."--".$tax_percent[$i];
				
				$itemlist['DESCRIPTION'] = $description[$i];
				$itemlist['PRICE'] = $price[$i];
				$itemlist['DISCOUNT'] = $tax_percent[$i];
				//print_r($itemlist);
				$this->db->insert('py_product_details', $itemlist); 
				
				$autoid = $this->db->insert_id();
		
				$this->db->where('id', $autoid);
				$itemid = 'IT'.$autoid;
				$hashitemid = md5($itemid);
				$this->db->set('ITEMCODE', $itemid);
				$this->db->set('HASHITEMCODE', $hashitemid);
				$this->db->update('py_product_details');
			}
		}
		redirect('admin/product');
	}
	
	public function fetchProductDetails($hashitemcode)
	{
		$query = $this->db->query("select * from py_product_details where hashitemcode = '".$hashitemcode."'");
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$data = array();
			foreach($result as $row)
			{
				$data['itemcode'] = $row['ITEMCODE'];
				$data['hashitemcode'] = $row['HASHITEMCODE'];
				$data['description'] = $row['DESCRIPTION'];
				$data['price'] = $row['PRICE'];
				$data['discount'] = $row['DISCOUNT'];
			
			}
			return $data;
		}
	}

	function edit_product($data)
	{
		$data = array();
		$data['description'] = $this->input->post('description');
		$data['price'] = $this->input->post('price');
		$data['discount'] = $this->input->post('discount');
		$hashitemcode = $this->input->post('hashitemcode');
		$this->db->where('hashitemcode', $hashitemcode);
		
		$this->db->update('py_product_details', $data);
		
		redirect('admin/product');
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

/* End of file Logindetailsmodel.php */
/* Location: ./application/models/Logindetailsmodel.php */