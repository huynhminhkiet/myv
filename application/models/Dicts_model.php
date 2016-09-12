<?php 
include_once("Main_model.php");
/**
* 
*/
class Dicts_model extends Main_model {
	
	function __construct() {
		parent::__construct("dict_tbl");
	}

	// =========
	public function translate($keyword) {
		$this->db->like('new_word', $keyword, 'after');
		$this->db->order_by("new_word", "asc");
		$this->db->limit(10);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

}
?>