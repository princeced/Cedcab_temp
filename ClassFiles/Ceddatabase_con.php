<?php

class Ceddatabase_con
{
	public $user;
	public $source;
	public $password;
	public $database;
	public $conn;

	
	function __construct($source = 'localhost', $user = 'root', $password = '', $database = 'Cedcab')
	{
		$this->source = $source;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		$this->conn =  new mysqli($this->source, $this->user, $this->password, $this->database);
		
	}

	
}

?>