<?php

class User extends Model 
{
	static function getInfo(string $username)
	{
		$user_info = array();

		$user = self::getUserId($username);

		$query = 'SELECT 
				id, 
	    		username, 
	    		avatar, 
	    		name, 
	    		description,
	    		ifnull((SELECT COUNT(*) FROM subscribes WHERE user = ?), 0) as subscribers,
	    		ifnull((SELECT COUNT(*) FROM subscribes WHERE subscriber = ?), 0) as followings
			FROM users 
			WHERE username = ?';


		$user_info['profile_info'] = parent::db()->run($query, array($user, $user, $username))->fetch(PDO::FETCH_ASSOC);
		$user_info['images'] = self::getProfileImages($user_info['profile_info']['id']);

		return $user_info;
	}

	static function setUsername(string $username, string $old_username)
	{
		return username_exists($username) ? parent::db()->run('UPDATE users SET username = ? WHERE username = ?', array($username, $old_username)) : false;
	}

	static function getFollowings(string $username)
	{
		$followings = array();
		$i = 0;

		$query = 'SELECT f.`user`,u.`avatar`, u.`username`
			FROM `subscribes` f
			LEFT JOIN `users` u ON (f.`user` = u.`id`) 
			WHERE f.`subscriber` = ?';

		$sql = parent::db()->run($query, array(self::getUserId($username)));

		while ($result = $sql->fetch()) {
			$followings[$i]['user'] = $result['user'];
			$followings[$i]['avatar'] = $result['avatar'];
			$followings[$i]['username'] = $result['username'];
			$followings[$i]['subscribed'] = self::getSubscribed($_SESSION['username'], $result['username']);
			$i++;
		}

		return $followings;
	}

	static function getSubscribers(string $username)
	{
		$subscribers = array();
		$i = 0;

		$query = 'SELECT u.`avatar`, u.`username`
			FROM `subscribes` f
			LEFT JOIN `users` u ON (f.`subscriber` = u.`id`)
			WHERE f.`user` = ?';

		$sql = parent::db()->run($query, array(self::getUserId($username)));

		while ($result = $sql->fetch()) {
			$subscribers[$i]['avatar'] = $result['avatar'];
			$subscribers[$i]['username'] = $result['username'];
			$subscribers[$i]['subscribed'] = self::getSubscribed($_SESSION['username'], $result['username']);
			$i++;
		}

		return $subscribers;
	}

	static function getFollowingPosts(string $username)
	{
		$query = 'SELECT ui.`id`, ui.`image`, ui.`likes`, ui.`owner`, ui.`creation_date`
			FROM `user_images` ui
			LEFT JOIN `subscribes` f ON (ui.`owner` = f.`user`)
			WHERE f.`subscriber` = ?
			ORDER by ui.`creation_date`
			DESC';

		$sql = parent::db()->run($query, array(self::getUserId($username)));

		$i = 0;
		$posts = array();

		while ($query = $sql->fetch()) {
			$posts[$i]['id'] = $query['id'];
			$posts[$i]['image'] = $query['image'];
			$posts[$i]['likes'] = $query['likes'];
			$posts[$i]['owner'] = $query['owner'];
			$posts[$i]['avatar'] = self::getAvatarById($query['owner']);
			$posts[$i]['owner_username'] = self::getUsernameById($query['owner']);
			$posts[$i]['image_href'] = Functions::removeExtension($query['image']);
			$posts[$i]['creation_date'] = Functions::ceilTime($query['creation_date']);
			$i++;
		}

		return $posts;
	}	

	static function getUsernameById(int $id)
	{
		return parent::db()->run(
			'SELECT username FROM users WHERE id = ? LIMIT 1', array($id)
		)->fetchColumn();
	}


	static function getUserId(string $username)
	{
		return parent::db()->run(
			'SELECT id FROM users WHERE username = ? LIMIT 1', array($username)
		)->fetchColumn();
	}


	static function getAvatarById(int $id)
	{
		return parent::db()->run(
			'SELECT avatar FROM users WHERE id = ? LIMIT 1', array($id)
		)->fetchColumn();
	}

	static function getSubscribed(string $subscriber, string $user)
	{
		$user = self::getUserId($user);
		$subscriber = self::getUserId($subscriber);

		if (parent::db()->run('SELECT 1 FROM subscribes WHERE user = ? AND subscriber = ?', array($user, $subscriber))->fetch()) {
			return true;
		}

		return false;
	}

	static function subscribe(string $current_user, string $user)
	{
		return parent::db()->run(
			'INSERT INTO subscribes (user, subscriber) VALUES (?, ?)', array(self::getUserId($user), self::getUserId($current_user))
		);
	}

	static function unsubscribe(string $current_user, string $user)
	{
		return parent::db()->run(
			'DELETE FROM subscribes WHERE user = ? AND subscriber = ?', array(self::getUserId($user), self::getUserId($current_user))
		);
	}

	static function getProfileImages(int $id)
	{
		$images = array();
		$i = 0;

		$query = parent::db()->run('SELECT id, image, likes FROM user_images WHERE owner = ?', array($id));

		while ($result = $query->fetch()) {
			$image = $result['image'];
			$image = explode('.', $image);
			$images[$i]['image_href'] = array_shift($image);
			$images[$i]['id'] = $result['id'];
			$images[$i]['image'] = $result['image'];
			$images[$i]['likes'] = $result['likes'];
			$i++;
		}

		return $images;
	}

	static function addImage(string $image)
	{	

		return parent::db()->run(
			"INSERT INTO user_images (image, owner, creation_date) VALUES(?, ?, NOW())", array($image, self::getUserId(CURRENT_USER))
		);
	}

	static function getPrivateInfo(string $username)
	{
		return parent::db()->run(
			'SELECT username, password, email FROM users WHERE username = ?', array($username)
		)->fetch();
	}

	static function like(int $id)
	{
		return parent::db()->run(
			'UPDATE user_images SET likes = likes + 1 WHERE id = ?', array($id)
		);
	}

	static function dislike(int $id)
	{
		return parent::db()->run(
			'UPDATE user_images SET likes = likes - 1 WHERE id = ?', array($id)
		);
	}

	static function getPhoto(string $image)
	{
		return parent::db()->run(
			'SELECT likes FROM user_images WHERE image = ?', array($image)
		)->fetch();
	}


	static function username_exists(string $username)
	{
		return parent::db()->run(
			'SELECT 1 FROM users WHERE username = ?', array($username)
		)->fetch();
	}

	static function user_exists(string $username, string $email)
	{
		return parent::db()->run(
			'SELECT 1 FROM users WHERE username = ? OR email = ?', array($username, $email)
		)->fetch();
	}
}