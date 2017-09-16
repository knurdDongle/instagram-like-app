<?php

class AuthController
{
	/**
	 * Register function
	 * @return boolean
	 */
	public function actionRegister()
	{
		if (isset($_POST['register'])) {
			$data = array(
				'username' => $_POST['username'],
				'password' => md5(HASH_PASSWORD_KEY) . md5($_POST['password']),
				'email'    => $_POST['email']
			);

			if (Auth::register($data))
			{
				$_SESSION['username'] = $data['username'];
				$_SESSION['logged']   = 'user';
				
				header("Location: /" . $data['username']);
			}	
		} else {
			$view = new View('index/index');
		}

		return true;
	}

	/**
	 * Login function
	 * @return boolean
	 */
	public function actionLogin()
	{
		if (isset($_POST['login'])) {
			$data = array(
				'username' => $_POST['username'],
				'password' => md5(HASH_PASSWORD_KEY) . md5($_POST['password'])
			);

			if (Auth::login($data)) {
				$_SESSION['username'] = $data['username'];
				$_SESSION['logged']   = 'user';

				header("Location: /" . $_SESSION['username']);
			} 
			else {
				header("Location: /login");
			}
		}
		else {
			$view = new View('auth/login');
		}
	
		return true;
	}

	/**
	 * Logout function
	 * @return boolean
	 */
	public function actionLogout()
	{
		if (isset($_POST['logout'])) {
			Auth::logout();
		}

		header("Location: /login");
		return true;
	}
}