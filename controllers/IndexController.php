<?php

class IndexController
{
	/**
	 * Index page action
	 * @return boolean
	 */
	public function actionIndex()
	{
		if (isset($_SESSION['username'])) {
			$posts = User::getFollowingPosts($_SESSION['username']);
			$view = new View('index/news');
			$view->assign('posts', $posts);
		}
		else {
			$view = new View('index/index');
		}

		return true;
	}
}