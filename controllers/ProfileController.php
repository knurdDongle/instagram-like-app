<?php

class ProfileController
{	
	/**
	 * Show profile by username
	 * @param  integer $user
	 * @return boolean
	 */
	public function actionUser($user)
	{
		$userInfo = array();

		if ($userInfo = User::getInfo($user)) {
			$images = User::getProfileImages($userInfo['id']);
			$subscriber = 0;

			if (isset($_SESSION['username'])) {
				$subscriber = User::getSubscribed($_SESSION['username'], $user);
			}

			$view = new View('cabinet/index');
			$view->assign('userInfo', $userInfo);
			$view->assign('images', $images);
			$view->assign('subscriber', $subscriber);
		}
		else {
			$view = new View('cabinet/notfound');
		}

		return true;
	}

	/**
	 * Apply Edit
	 * @return boolean
	 */
	public function actionApplyEdit()
	{
		if (!User::setUsername($_POST['username'], $_POST['old_username'])) {
			exit("Уже занято! <a href=\"/auth\"> Назад </a>");
		}
		else {
			$_SESSION['username'] = $username;
		}
	}

	/**
	 * Remove image
	 * @return boolean
	 */
	public function actionRemoveimage()
	{
		if (isset($_POST['removephoto'])) {
			if ($_SESSION['username'] == $_POST['owner']) {

			}
		}
	}

	/**
	 * Views the photo
	 * @return boolean
	 */
	public function actionViewphoto($photo) 
	{
		$photoInfo = array();
		$photo .= '.png';

		if ($photoInfo = User::getPhoto($photo)) {
			$view = new View('photo/index');
			$view->assign('photoInfo', $photoInfo);
			$view->assign('photo', $photo);
		}

		return true;
	}

	/**
	 * Shows user's followings
	 * @param  string $username
	 * @return boolean         
	 */
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

	/**
	 * Shows user's subscribers
	 * @param  string $username
	 * @return boolean
	 */
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
}