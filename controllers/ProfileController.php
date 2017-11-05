<?php

class ProfileController
{	
	public function actionUser($user)
	{
		$userInfo = array();

		if (User::username_exists($user)) {
			$userInfo = User::getInfo($user);
			$subscriber = isset($_SESSION['username']) ? User::getSubscribed($_SESSION['username'], $user) : false;

			$view = new View('cabinet/index');
			$view->assign('userInfo', $userInfo);
			$view->assign('subscriber', $subscriber);
		}
		else {
			return new View('cabinet/notfound');
		}	

		return true;
	}

	public function actionApplyEdit()
	{
		if (!User::setUsername($_POST['username'], $_POST['old_username'])) {
			exit("Уже занято! <a href=\"/auth\"> Назад </a>");
		}
		else {
			$_SESSION['username'] = $username;
		}
	}

	public function actionRemoveimage()
	{
		if (isset($_POST['removephoto'])) {
			if ($_SESSION['username'] == $_POST['owner']) {

			}
		}
	}

	public function actionViewphoto($photo) 
	{
		$photoInfo = array();

		if ($photoInfo = User::getPhoto($photo)) {
			$view = new View('photo/index');
			$view->assign('photoInfo', $photoInfo);
			$view->assign('photo', $photo);
		} else {
			return new View('cabinet/notfound');
		}

		return true;
	}

	public function actionFollowing($username)
	{
		if (isset($_SESSION['username'])) {
			$followings = User::getFollowings($username);

			$view = new View('cabinet/followings');
			$view->assign('followings', $followings);
		}
		else {
			header("Location: /");
		}

		return true;
	}

	public function actionSubscribers($username)
	{
		if (isset($_SESSION['username'])) {
			$subscribers = User::getSubscribers($username);

			$view = new View('cabinet/subscribers');
			$view->assign('subscribers', $subscribers);
		}
		else {
			header("Location: /");
		}

		return true;
	}

	public function actionEditpage() {
		if (Functions::logged_in()) {
			$userData = User::getPrivateInfo($_SESSION['username']);

			$view = new View('cabinet/edit');
			$view->assign('userData', $userData);
		} else {
			header("Location: /");
		}

		return true;
	}
}