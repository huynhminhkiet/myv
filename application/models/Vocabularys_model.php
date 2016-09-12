<?php 
include_once("Main_model.php");
/**
* 
*/
class Vocabularys_model extends Main_model {
	
	function __construct() {
		parent::__construct("vocabulary_tbl");
	}

	// =========
	public function getVobByTopic($topic_id) {
		$this->db->where('topic_id', $topic_id);
		$this->db->order_by("vocabulary_id", "desc");
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
}
?>