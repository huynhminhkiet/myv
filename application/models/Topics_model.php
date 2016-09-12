<?php 
include_once("Main_model.php");
/**
* 
*/
class Topics_model extends Main_model {
	
	function __construct() {
		parent::__construct("topic_tbl");
	}

	public function getTopicByUser($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->order_by("topic_id", "desc");
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
}
?>