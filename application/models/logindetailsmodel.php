<?php 
class Logindetailsmodel extends CI_Model {

	
	public function useravailable()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('py_login');
		
		if($query->num_rows == 1){
			return true;
		}
	}
	
	public function userrole($userid)
	{
		$str = "select role from py_login where username=?";
		$query = $this->db->query($str,array($userid));
		// return $query->result();
		$role='';
		foreach($query->result() as $row)
		{
			$role = $row->role;
		}
		return $role;
	}
	
	public function session_tracking($data)
	{
		$this->db->insert('py_sessions', $data); 
		$autoid = $this->db->insert_id();
	
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}

/* End of file Logindetailsmodel.php */
/* Location: ./application/models/Logindetailsmodel.php */