<?php 
include_once("Main_model.php");
/**
* 
*/
class Persons_model extends Main_model {
	
	function __construct() {
		parent::__construct("person_tbl");
	}
}
?>