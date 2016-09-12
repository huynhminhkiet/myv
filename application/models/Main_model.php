<?php 
/**
* table name should be table 
*
*/
class Main_model extends CI_Model {
	protected $table;
	public function __construct($table) {
		$this->load->database();
		$this->table = $table;
	}

	/**
	* 
	*/
	public function get($id = FALSE) {
		if ($id === FALSE)
        {
                $query = $this->db->get($this->table);
                return $query->result_array();
        }

        $query = $this->db->get_where($this->table, array(str_replace("tbl", "id", $this->table) => $id));
        return $query->row_array();
	}

	/**
	* 
	*/
	public function create($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	/**
	* 
	*/
	public function update($data) {
		$this->db->where(str_replace("tbl", "id", $this->table), $data[str_replace("tbl", "id", $this->table)]);
		return $this->db->update($this->table, $data);
	}

	/**
	* 
	*/
	public function delete($id) {
		$this->db->where(str_replace("tbl", "id", $this->table), $id);
		return $this->db->delete($this->table);
	}
}

?>
