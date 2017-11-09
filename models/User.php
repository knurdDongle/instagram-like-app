<?php

class User extends Model implements iUser
{
	static function getProfile($username)
	{
		$user_info = array();

		$user = self::getUserId($username);

		$query = '
			SELECT 
				id, 
				username, 
	    		avatar, 
	    		name, 
	    		description,
	    		ifnull((SELECT COUNT(*) FROM subscribes WHERE user = ?), 0) as subscribers,
	    		ifnull((SELECT COUNT(*) FROM subscribes WHERE subscriber = ?), 0) as followings
			FROM users 
			WHERE username = ?';

		$preparedStatements = array($user, $user, $username);

		$user_info['profile_info'] = parent::db()->run($query, $preparedStatements)->fetch(PDO::FETCH_ASSOC);
		$user_info['images'] = self::getProfileImages($user_info['profile_info']['id']);

		return $user_info;
	}

	static function getProfileImages($id)
	{
		$images = array();
		$i = 0;

		$query = parent::db()->run('SELECT id, image_name, image, likes FROM user_images WHERE owner = ?', array($id));

		while ($result = $query->fetch()) {
			$images[$i]['image_href'] = $result['image_name'];
			$images[$i]['id'] = $result['id'];
			$images[$i]['image'] = $result['image'];
			$images[$i]['likes'] = $result['likes'];
			$i++;
		}

		return $images;
	}

	static function getProfileFollowings($username)
	{
		$followings = array();
		$i = 0;

		$query = 'SELECT f.`user`, u.`avatar`, u.`username`
			FROM `subscribes` f
			LEFT JOIN `users` u ON (f.`user` = u.`id`) 
			WHERE f.`subscriber` = ?';

		$preparedStatements = array(self::getUserId($username));
		$sql = parent::db()->run($query, $preparedStatements);

		while ($result = $sql->fetch()) {
			$followings[$i]['user'] = $result['user'];
			$followings[$i]['avatar'] = $result['avatar'];
			$followings[$i]['username'] = $result['username'];
			$followings[$i]['subscribed'] = self::isFollowed($result['username'], $username);
			$i++;
		}

		return $followings;
	}

	static function getProfileSubscribers($username)
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
			$subscribers[$i]['subscribed'] = self::isFollowed($result['username'], $username);
			$i++;
		}

		return $subscribers;
	}

	static function getFollowingPosts()
	{
		$query = 'SELECT ui.`id`, ui.`image`, ui.`likes`, ui.`owner`, ui.`creation_date`
			FROM `user_images` ui
			LEFT JOIN `subscribes` f ON (ui.`owner` = f.`user`)
			WHERE f.`subscriber` = ?
			ORDER by ui.`creation_date`
			DESC';

		$sql = parent::db()->run($query, array(CURRENT_USER));

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

	static function getUsername($id)
	{
		return parent::db()->run(
			'SELECT username FROM users WHERE id = ? LIMIT 1', array($id)
		)->fetchColumn();
	}

	static function getUserid($username)
	{
		return parent::db()->run(
			'SELECT id FROM users WHERE username = ? LIMIT 1', array($username)
		)->fetchColumn();
	}

	static function getProfileAvatar($id)
	{
		return parent::db()->run(
			'SELECT avatar FROM users WHERE id = ? LIMIT 1', array($id)
		)->fetchColumn();
	}

	static function isFollowed($user, $subscriber)
	{
		$preparedStatements = array(self::getUserId($user), self::getUserId($subscriber));

		return parent::db()->run(
			'SELECT 1 FROM subscribes WHERE user = ? AND subscriber = ?', $preparedStatements
		)->fetch();
	}

	static function doSubscribe($user)
	{
		$preparedStatements = array(self::getUserid($user), self::getUserid(CURRENT_USER));

		return parent::db()->run('INSERT INTO subscribes (user, subscriber) VALUES (?, ?)', $preparedStatements);
	}

	static function doUnsubscribe($user) 
	{
		$preparedStatements = array(self::getUserid($user), self::getUserid(CURRENT_USER));

		return parent::db()->run('DELETE FROM subscribes WHERE user = ? AND subscriber = ?', $preparedStatements);
	}

	static function postImage($image, $image_name)
	{	

		return parent::db()->run("INSERT INTO user_images (image_name, image, owner, creation_date) VALUES(?, ?, ?, NOW())", 
			array($image_name, $image, self::getUserId(CURRENT_USER))
		);
	}

	static function getSettingsInfo()
	{
		return parent::db()->run(
			'SELECT username, password, email FROM users WHERE username = ?', array(CURRENT_USER)
		)->fetch();
	}

	static function isLiked($id) 
	{

	}

	static function doLike($id)
	{
		if (self::isLiked($id)) {
			return;
		}
		return parent::db()->run(
			'UPDATE user_images SET likes = likes + 1 WHERE id = ?', array($id)
		);
	}

	static function getProfileImage($image)
	{
		return parent::db()->run(
			'SELECT image, likes FROM user_images WHERE image_name = ?', array($image)
		)->fetch();
	}


	static function username_exists($username)
	{
		return parent::db()->run(
			'SELECT 1 FROM users WHERE username = ?', array($username)
		)->fetch();
	}

	static function profile_exists($username, $email)
	{
		return parent::db()->run(
			'SELECT 1 FROM users WHERE username = ? OR email = ?', array($username, $email)
		)->fetch();
	}

	static function setUsername($username)
	{
		return !self::username_exists($username) ? parent::db()->run('UPDATE users SET username = ? WHERE username = ?', array($username, CURRENT_USER)) : false;
	}
}