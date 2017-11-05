<?php

class Auth extends Model
{
	static function register($data)
	{
		$postData = array();

		foreach ($data as $key => $value) 
			$postData[] = $value;

		$user_exists = User::user_exists($data['username'], $data['email']);

		if (!$user_exists) {
			return parent::db()->run(
				"INSERT INTO users (username, password, email, avatar) VALUES(?, ?, ?, " . DEFAULT_PROFILE_PIC . ")", $postData
			);
		} 
		else {
			die('Данное имя уже занято! <a href="/register"> Назад </a>');
		}
	}


	static function login($data)
	{
		$postData = array();

		foreach ($data as $key => $value) 
			$postData[] = $value;

		return parent::db()->run('SELECT 1 FROM users WHERE username = ? AND password = ?', $postData)->fetch();
	}

	static function logout()
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