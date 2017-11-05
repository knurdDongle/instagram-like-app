<?php

class ActionController
{
	function actionSubscribe()
	{
		if (Functions::logged_in() && isset($_POST['subscribe'])) {
			User::subscribe(CURRENT_USER, $_POST['username']);
		}

		header("Location: {$_SERVER['HTTP_REFERER']}");

		return true;
	}

	function actionUnsubscribe()
	{
		if (Functions::logged_in() && isset($_POST['unsubscribe'])) {
			User::unsubscribe($_SESSION['username'], $_POST['username']);
		} 

		header("Location: {$_SERVER['HTTP_REFERER']}");

		return true;
	}

	function actionAddimage() 
	{
		if (isset($_POST['addphoto'])) {
			$ext = explode(".", $_FILES['image']['name']);
	        $ext = end($ext);

	        if ($ext != 'png' && $ext != 'jpg' && $ext != 'gif')
	            die('Недопустимое расширение файла');

	        $path = ROOT_PATH . '/images/';

	        $fileName = time();
	        $filePath = $path . $fileName;

	        if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
	        	Functions::imageresize($filePath, $ext);
                User::addImage($fileName);
	        }
	    }

	    header("Location: /" . CURRENT_USER);
	    return true;
	}

	function actionEdit()
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