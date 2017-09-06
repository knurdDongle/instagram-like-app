<?php

class Database extends PDO
{
	public function __construct($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) 
	{
		parent::__construct("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}	

	public function run($query, $data) 
	{
		$sql = $this->prepare($query);
		$sql->execute($data);

		return $sql;
	}
}