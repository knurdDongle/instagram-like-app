<?php

class ActionController
{
	function actionSubscribe()
	{
		if (Functions::logged_in() && isset($_POST['subscribe'])) {
			User::doSubscribe($_POST['username']);
		} else if (Functions::logged_in() && isset($_POST['unsubscribe'])) {
			User::doUnsubscribe($_POST['username']);
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

	        $dir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
	        $path = ROOT_PATH . '/images/' . $dir;

	        if (!is_dir($path)) {
	        	mkdir($path, 0700, true);
	        }

	        $fileName = md5(time() . $_FILES['image']['name']);

	        $fullPath = $path . '/' . $fileName;
	        $dbPath = $dir . '/' . $fileName;
			
			if (move_uploaded_file($_FILES['image']['tmp_name'], $fullPath)) {
	        	Functions::imageresize($fullPath);
                User::postImage($dbPath, $fileName);
	        }
	    }

	    header("Location: /" . CURRENT_USER);
	    return true;
	}

	function actionEdit()
	{
		if (Functions::logged_in()) {
			$userData = User::getSettingsInfo(CURRENT_USER);

			$view = new View('cabinet/edit');
			$view->assign('userData', $userData);
			return;
		}
		
		header("Location: /");
		return;
	}
}