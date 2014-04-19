<?php

/**
 * Master Code Repo for all commonly used functions and variables
 */
class createConnection
{
	//data to login into mysql server on multilab machine
	$user_name = 'actorsgu_data';
	$pass_word = 'cliffy36&winepress';
	$database = 'actorsgu_data';
	//$server = 'box293.bluehost.com:3306';
	$server = 'localhost:3306';
	$my_conn;
	$db_handle;
	$db_found = false;
	
	function connectToDatabase()
	{
		$con = mysql_connect($this->server, $this->user_name, $this->pass_word, $this->database);
		$this->db_handle = mysql_connect($this->server, $this->user_name, $this->pass_word);
		$this->db_found = mysql_select_db($this->database, $this->db_handle);
		
		if (!$con || !$db_handle)
			die ("Cannot connect to the database");
		else
		{
			$this->my_conn = $con;
			return $this->my_conn;
		}
	}
	function closeConnection()
	{
		mysql_close($this->my_conn);
	}
}
?>