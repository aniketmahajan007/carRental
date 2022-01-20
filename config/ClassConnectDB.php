<?php

/******************************************************************************
* 				Class for Creating mysqli objects                         	  *
*******************************************************************************/

require_once("config.php");

class ConnectDB
{
	var $DB_CONNECTION;
	//get_all_members_sale_of_specific_date();
	//$result2 = $DB_CONN->get_all_distributor_sale_of_specific_date()
	public function __construct()
	{
		$this->DB_CONNECTION = new mysqli(DB_HOST, DB_HOST_USERNAME, DB_HOST_PASSWORD, DB_DATABASE);
		$this->DB_CONNECTION->set_charset('utf8');
		
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	}
	
	public function __destruct()
	{
		$this->DB_CONNECTION->close();
		$this->DB_CONNECTION = null;
		unset($this->DB_CONNECTION);
	}
	
	public function query($sql)
	{
		return $this->DB_CONNECTION->query($sql);
	}
	
	public function error()
	{
		return "DataBase Error ::==>> " . $this->DB_CONNECTION->error;
	}
	
}
	
$DB_CONN = new ConnectDB();
?> 
