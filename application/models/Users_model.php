<?php 
include_once("Main_model.php");
/**
* 
*/
class Users_model extends Main_model {
	
	function __construct() {
		parent::__construct("user_tbl");
	}

	/**
	* 
	*/
	public function getUserLogin($username, $password) {
		$query = $this->db->get_where($this->table, array("username" => $username, "password" => $password));
		return $query->row_array();
	}

	/**
	* 
	*/
	public function checkExistsUsername($username) {
		$query = $this->db->get_where($this->table, array("username" => $username));
		return $query->num_rows();
	}
}
?>