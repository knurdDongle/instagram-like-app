<?php

class Model
{
	protected static function db()
	{
		$paramsPath = ROOT_PATH . '/config/db_config.php';
		$params = include($paramsPath);

		return new Database($params['host'], $params['dbname'], $params['username'], $params['password']);
	}
}
