<?php

class IndexController
{
	function actionIndex()
	{
		if (Functions::logged_in()) {
			$posts = User::getFollowingPosts();

			$view = new View('index/news');
			$view->assign('posts', $posts);

			return true;
		}
	
		return new View('index/index');
	}
}