<?php

class ActionController
{
	/**
	 * Subscribe function 
	 * @param  string $user
	 * @return boolean 
	 */
	public function actionSubscribe()
	{
		if (isset($_SESSION['username']) && isset($_POST['subscribe'])) {
			if (User::subscribe($_SESSION['username'], $_POST['username'])) {
				header("Location: {$_SERVER['HTTP_REFERER']}");
			}
		} else { 
			header("Location: /" . $_SESSION['username']); 
		}
		return true;
	}

	/**
	 * Unsubscribe function 
	 * @param  string $user
	 * @return boolean 
	 */
	public function actionUnsubscribe()
	{
		if (isset($_SESSION['username']) && isset($_POST['unsubscribe'])) {
			if (User::unsubscribe($_SESSION['username'], $_POST['username'])) {
				header("Location: {$_SERVER['HTTP_REFERER']}");
			}
		} else {
			header("Location: /");
		}

		return true;
	}

	/**
	 * Upload an image
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

	        $fileName = time() . '.' . 'png';
	        $filePath = $path . $fileName;

	        if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
	        	Functions::imageresize($filePath, $ext);
                User::addImage($fileName, $_SESSION['username']);
	        }
	    }

	    header("Location: /" . $_SESSION['username']);
	    return true;
	}

	/**
	 * Edit page
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
}