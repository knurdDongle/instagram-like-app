<?php

class Auth extends Model
{
	/**
	 * @return boolean
	 */
	public static function register($data)
	{
		$postData = array();

		foreach ($data as $key => $value) 
			$postData[] = $value;

		if (!parent::db()->run('SELECT 1 FROM users WHERE username = ? OR email = ?', array($data['username'], $data['email']))->fetch()) {
			return parent::db()->run('INSERT INTO users (username, password, email) VALUES(?, ?, ?)', $postData);
		} 
		else {
			die('Данное имя уже занято! <a href="/auth"> Назад </a>');
		}
	}

	/**
	 * @return boolean
	 */
	public static function login($data)
	{
		$postData = array();

		foreach ($data as $key => $value) 
			$postData[] = $value;

		return parent::db()->run('SELECT 1 FROM users WHERE username = ? AND password = ?', $postData)->fetch();
	}

	public static function logout()
    {
        $_SESSION = array();
        $params = session_get_cookie_params();

        setcookie(session_name(), '',
                  time() - 42000,
                  $params["path"],
                  $params["domain"],
                  $params["secure"],
                  $params["httponly"]);

        session_destroy();
    }
}