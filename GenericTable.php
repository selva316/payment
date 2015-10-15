<?php 
/** This class consists of methods/fields that are used to operate on any Table.
 *
 *
 * @package Whims
 */

 
class GenericTable {

     /**   Database Table Name
	 *
	 * @var string
	 */
   public $table_name;

     /**  Database object
	 *
	 * @var object
	 */
   public $dbh;

    /** Constructor that populates all the Field variables.
	 *
	 *  @param Databaseobject dbh
	 *  @param string table_name
	 *
     */
   public function __construct($dbh,$table_name)
   {
          
       $this->table_name = $table_name;
       $this->dbh = $dbh;

   }

    /** Inserts a new Row in the Table, and returns the lastInsertId. Note that the Argument is an Hash Array.
	 *
	 *  @param string[] list
	 *  @return string
	 */
   	 public function insertRow($list){
         $dbh = $this->dbh;

		 
    	foreach($list as $key=>$value)
    	{
      		$k[]= $key;
      		$v[]= "'$value'";
      		
    	}
		$ins = "INSERT INTO " . $this->table_name . "(" . implode(',',$k) . ") VALUES (" . implode(',',$v).")";
		echo "<BR>$ins";
		$dbh->exec($ins);
    	$id = $dbh->lastInsertId();

    	return $id;
     }


    /** Updates a  Row in the Table, and returns the updation result. Note that the Argument is an Hash Array, along with the clause.
	 *
	 *  @param string[] list
	 *  @param string clause
	 *  @return integer
	 */
   	 public function updateRow($list,$clause=''){
         $dbh = $this->dbh;

         $query = "update $this->table_name SET ";
         foreach ($list as $key => $value) {
          $query .= "$key='$value',";
		  
         } 
	    $query = substr($query,0,-1);
	    $query .= ' '.$clause;

		echo "<BR>$ins";
        print $query;
        $result = $dbh->exec($query);
		
		return $result;
     }
	 
	 
    /** Inserts a new Row in the Table, and returns the lastInsertId. Note that the Argument has two Hash Arrays.
	 *
	 *  @param string[] k
	 *  @param string[] v
	 *  @return string
	 */
   	 public function insertRowwithtwoarrays($k,$v){
         $dbh = $this->dbh;

		 
    	$ins = "INSERT INTO " . $this->table_name . "(" . implode(',',$k) . ") VALUES (" . implode(',',$v).")";
		$dbh->exec($ins);
    	$id = $dbh->lastInsertId();
    	return $id;
     }
     
    /** Fetch Id Value using passed Table Name and a Column Name and corresponding value of the column in the table
	 *
	 *  @param string[] tablename
	 *  @param string[] columnname
	 *  @param string[] data
	 *  @param string[] returncolumn
	 *  @param string[] combcolumn
	 *  @return string
	 */
   	 public function fetchIdValue($returncolumn,$data,$columnname,$combcolumn){
         $dbh = $this->dbh;
         $table_name = $this->table_name;
         $hid = $_SESSION['IKURE_HOSPITAL_ID'];		 
    	 
    	 //print "SELECT $returncolumn FROM $table_name WHERE $columnname='$data' AND $combcolumn = $hid";
    	 if ( $combcolumn != 'NIL' ) 
    	       $query=$dbh->query("SELECT $returncolumn FROM $table_name WHERE $columnname='$data' AND $combcolumn = '$hid'");	
   		 else
   		       $query=$dbh->query("SELECT $returncolumn FROM $table_name WHERE $columnname='$data'");	
   		 $result=$query->fetch();
   		 $returnvalue = $result[$returncolumn];

    	 return $returnvalue;
     }
     
     /** Check if the Value in the passed checkclause already exists in the Table 
	 *
	 *  @param string[] checkclause
	 *  @return string
	 */
   	 public function checkIfValueAlreadyExists($checkclause){
         $dbh = $this->dbh;
         $table_name = $this->table_name;
         
         //print "SELECT count(*) FROM $table_name WHERE $checkclause";
         $result=$dbh->query("SELECT count(*) FROM $table_name WHERE $checkclause");
   		 $count = $result->fetchColumn();
		 return $count;
     }
     

}
  
?>
