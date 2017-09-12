<?php

class ProfileController
{	
	/**
	 * Show profile by username
	 * 
	 * @param  integer $user
	 * @return boolean
	 */
	public function actionProfile($user)
	{
		$userInfo = array();

		if ($userInfo = User::getInfo($user)) {
			$images = User::getProfileImages($userInfo['id']);
			$subscriber = 0;

			if ($_SESSION['username']) {
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
	 * Edit page
	 * 	
	 * @return boolean
	 */
	public function actionEdit()
	{
		if (!isset($_SESSION['logged'])) {
			header("Location: /auth");
		}
		else {
			$userData = User::getPrivateInfo($_SESSION['username']);

			$view = new View('cabinet/edit');
			$view->assign('userData', $userData);
		}
		
		return true;
	}

	/**
	 * Apply Edit
	 * 
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
	 * Upload an image
	 * 
	 * @return boolean
	 */
	public function actionAddimage() 
	{
		if (isset($_POST['addphoto'])) {
			$ext = explode(".", $_FILES['image']['name']);
	        $ext = end($ext);

	        if ($ext != 'png' && $ext != 'jpg' && $ext != 'gif')
	            die('Недопустимое расширение файла');

	        $path = ROOT_PATH . '/images/';

	        $fileName = time() . '.' . $ext;
	        $filePath = $path . $fileName;

	        if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
	        	Functions::imageresize($filePath, 600, 600, $ext);
                User::addImage($fileName, $_SESSION['username']);
	        }
	    }

	    header("Location: /" . $_SESSION['username']);
	    return true;
	}

	/**
	 * @todo Currently work only with .jpg
	 * @return boolean
	 */
	public function actionPhoto($photo) 
	{
		$photoInfo = array();
		$photo = $photo . '.jpg';

		if ($photoInfo = User::getPhoto($photo)) {
			$view = new View('photo/index');
			$view->assign('photoInfo', $photoInfo);
			$view->assign('photo', $photo);
		}

		return true;
	}

	/**
	 * Subscribe function 
	 * 
	 * @param  string $user [description]
	 * @return boolean      [description]
	 */
	public function actionSubscribe($user)
	{
		if ($_SESSION['username']) {
			if (User::subscribe($_SESSION['username'], $user)) {
				header("Location: /" . $user);
			}
		}

		return true;
	}

	/**
	 * Unsubscribe function 
	 * 
	 * @param  string $user [description]
	 * @return boolean      [description]
	 */
	public function actionUnsubscribe($user)
	{
		if ($_SESSION['username']) {
			if (User::unsubscribe($_SESSION['username'], $user)) {
				header("Location: /" . $user);
			}
		}

		return true;
	}
}