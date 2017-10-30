<?php

class AuthController
{
	public function actionRegister()
	{
		if (isset($_POST['register'])) {
			$data = array(
				'username' => $_POST['username'], 
				'password' => md5(HASH_PASSWORD_KEY) . md5($_POST['password']),
				'email'  => $_POST['email']
			);

			if (Auth::register($data)) {
				$_SESSION['username'] = $data['username'];

				header("Location: /" . CURRENT_USER);
				return true;
			}	
		}

		return new View('index/index');
	}
	public function actionLogin()
	{
		if (isset($_POST['login'])) {
			$data = array(
				'username' => $_POST['username'],
				'password' => md5(HASH_PASSWORD_KEY) . md5($_POST['password'])
			);

			if (Auth::login($data)) {
				$_SESSION['username'] = $data['username'];

				header("Location: /" . CURRENT_USER);
				return true;
			} 
		}
		
		return new View('auth/login');
	}

	public function actionLogout()
	{
		if (isset($_POST['logout'])) {
			Auth::logout();
		}

		header("Location: /login");
		return true;
	}
}