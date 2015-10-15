<?php 
/** This class consists of methods/fields that are used to operate on any Table.
 *
 *
 * @package Whims
 */

 
class Quotation {

     /**   Quotation ID
	 *
	 * @var string
	 */
    public $qid;
   
	/**   Hash Quotation ID
	 *
	 * @var string
	 */
    public $hashqid;
	
     /**  Database object
	 *
	 * @var object
	 */
	 
	public $name;
	public $contact;
	public $address;
	public $retailcontact;
	public $tin;
	public $cst;
	public $salesperson;
	public $term;
	public $refnumber;
	public $quotationdate;
	public $status;
	public $timestamp;
	public $subtotal;
	public $taxtotal;
	public $roundoff;
	public $netamount;
	public $mailid;
	public $itembreakup;
	public $words;
   public $dbh;

    /** Constructor that populates all the Field variables.
	 *
	 *  @param Databaseobject dbh
	 *  @param string table_name
	 *
     */
   public function __construct($dbh,$hashqid)
   {
		$this->dbh = $dbh;
		
		if(strlen($hashqid) >15)
			$query=$dbh->query("SELECT * from py_quotation WHERE HASHQID='$hashqid'");	
		else
		{
			$query=$dbh->query("SELECT * from py_quotation WHERE QID='$hashqid'");
		}
		
		$result=$query->fetch();
		$count = $query->rowCount();
		
		if($count){
			
			$this->qid = $result['QID'];
			$this->hashqid = $result['HASHQID'];
			$this->name = $result['NAME'];
			$this->contact = $result['CONTACT'];
			$this->address = $result['ADDRESS'];
			$this->retailcontact = $result['RETAILCONTACT'];
    		$this->tin = $result['TIN'];
			$this->cst= $result['CST'];
			$this->salesperson = $result['SALESPERSON'];
			$this->term = $result['TERM'];			
			$this->refnumber = $result['REFNUMBER'];	
			$this->quotationdate = $result['QUOTATIONDATE'];	
			$this->status = $result['STATUS'];	
			$this->timestamp = $result['TIMESTAMP'];	
			$this->subtotal = $result['SUBTOTAL'];	
			$this->taxtotal = $result['TAXTOTAL'];
			$this->roundoff = $result['ROUNDOFF'];
			$this->netamount = $result['NETAMOUNT'];
			$this->mailid = $result['MAILDID'];
			$this->words = $result['NETAMOUNT'];	
			$q = $dbh->query("SELECT * FROM py_items WHERE qid = '$this->qid'");
			$res = $q->fetchAll();
			
			$this->numberofentries = $count;
			
			$q = $dbh->query("SELECT * FROM WHI_INVENTORY_DEPENDENCIES WHERE SOURCEITEMID = '$this->itemid'");
			
			
			if($this->numberofentries > 0)
			{
				$i = 0;
				 foreach ($res as $r ) {
           	  		 $itembreakup[$i]['ITEMCODE'] = $r['ITEMCODE'];
					 $itembreakup[$i]['DESCRIPTION'] = $r['DESCRIPTION'];
					 $itembreakup[$i]['QUANTITY'] = $r['QUANTITY'];
					 $itembreakup[$i]['PRICE'] = $r['PRICE'];
					 $itembreakup[$i]['taxpercent'] = $r['taxpercent'];
					 $itembreakup[$i]['qid'] = $r['qid'];
            				$i++;
            			}
			$this->itembreakup = $itembreakup;
				
			}

		}
    }
}
  
?>
