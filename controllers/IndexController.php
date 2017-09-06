<?php

class IndexController
{
	public function actionIndex()
	{
		$view = new View('index/index');

		return true;
	}
}