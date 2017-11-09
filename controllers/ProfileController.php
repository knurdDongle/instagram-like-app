<?php

class ProfileController
{	
	public function actionUser($user)
	{
		$userInfo = array();

		if (User::username_exists($user)) {
			$subscriber = Functions::logged_in() ? (User::isFollowed($user, CURRENT_USER) ? true : false) : null;

			$userInfo = User::getProfile($user);

			$view = new View('cabinet/index');
			$view->assign('userInfo', $userInfo);
			$view->assign('subscriber', $subscriber);
		}
		else {
			return new View('cabinet/notfound');
		}	

		return true;
	}


	public function actionViewphoto($photo) 
	{
		$photoInfo = array();

		if ($photoInfo = User::getProfileImage($photo)) {
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
		if (Functions::logged_in()) {
			$followings = User::getProfileFollowings($username);

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
		if (Functions::logged_in()) {
			$subscribers = User::getProfileSubscribers($username);

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
			$userData = User::getSettingsInfo($_SESSION['username']);

			$view = new View('cabinet/edit');
			$view->assign('userData', $userData);
		} else {
			header("Location: /");
		}

		return true;
	}
}