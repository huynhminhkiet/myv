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
		$SQL = 'SELECT topic_tbl.*, (SELECT COUNT(*) from vocabulary_tbl WHERE vocabulary_tbl.topic_id = topic_tbl.topic_id) as total FROM `topic_tbl` WHERE user_id = '.$user_id.' ORDER BY topic_tbl.topic_id DESC';
		$query = $this->db->query($SQL);
		return $query->result_array();
	}
}
?>