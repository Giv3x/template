<?php
include('database/connect.php');
class echo1 {
	public $mysql;

	function __construct() {
		$this->mysql = new sql();
	}

	function print1() {
		$query = "select * from test.new_table";
		return ($this->mysql)->execQuery($query, PDO::FETCH_ASSOC);
	}
}
?>