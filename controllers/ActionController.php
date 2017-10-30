<?php

class ActionController
{
	public function actionSubscribe()
	{
		if (Functions::logged_in() && isset($_POST['subscribe'])) {
			User::subscribe(CURRENT_USER, $_POST['username']);
		}

		header("Location: {$_SERVER['HTTP_REFERER']}");

		return true;
	}

	public function actionUnsubscribe()
	{
		if (Functions::logged_in() && isset($_POST['unsubscribe'])) {
			User::unsubscribe($_SESSION['username'], $_POST['username']);
		} 

		header("Location: {$_SERVER['HTTP_REFERER']}");

		return true;
	}

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

	    header("Location: /" . CURRENT_USER);
	    return true;
	}

	public function actionEdit()
	{
		if (Functions::logged_in()) {
			$userData = User::getPrivateInfo(CURRENT_USER);

			$view = new View('cabinet/edit');
			$view->assign('userData', $userData);
			return;
		}
		
		header("Location: /");
		return;
	}
}