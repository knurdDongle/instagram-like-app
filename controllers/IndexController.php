<?php

class IndexController
{
	public function actionIndex()
	{
		if ($_SESSION['username']) {
			$view = new View('index/news');
		}
		else {
			$view = new View('index/index');
		}

		return true;
	}
}