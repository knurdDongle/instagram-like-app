<?php

class User extends Model 
{
	/**
	 * Function gets user's info by username
	 * @param  string $username 
	 * @return array
	 */
	public static function getInfo($username)
	{
		try {
			return parent::db()->run('
				SELECT 
					id, 
		    		username, 
		    		avatar, 
		    		name, 
		    		description,
		    		ifnull((SELECT COUNT(*) FROM subscribes WHERE user = ?), 0) as subscribers,
		    		ifnull((SELECT COUNT(*) FROM subscribes WHERE subscriber = ?), 0) as followings
				FROM users 
				WHERE username = ?', array($username, $username, $username)
			)->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die('Database error: ' . $e->getMessage());
		} catch (Exception $e) {
			die('General error: ' . $e->getMessage());
		}
	}

	/**
	 * Function changes user's username
	 * 
	 * @todo optimization
	 * @return boolean
	 */
	public static function setUsername($username, $old_username)
	{
		if (!parent::db()->run('SELECT 1 FROM users WHERE username = ?', array($username))->fetch()) {
			return parent::db()->run('UPDATE users SET username = ? WHERE username = ?', array($username, $old_username));
		}

		return false;
	}

	/**
	 * Function gets user's id by username
	 * 
	 * @return integer
	 */
	public static function getUserId($username)
	{
		return parent::db()->run('SELECT id FROM users WHERE username = ? LIMIT 1', array($username))->fetchColumn();
	}



	/**
	 * Function checks whether the user subscriber of another user or not
	 * @param  string $subscriber 
	 * @param  string $user       
	 * @return boolean            
	 */
	public static function getSubscribed($subscriber, $user) 
	{
		if (parent::db()->run('SELECT 1 FROM subscribes WHERE user = ? AND subscriber = ?', array($user, $subscriber))->fetch()) {
			return true;
		}

		return false;
	}

	/**
	 * Subscribe function 
	 * @param  string $current_user [description]
	 * @param  string $user         [description]
	 * @return boolean              [description]
	 */
	public static function subscribe($current_user, $user)
	{
		return parent::db()->run('INSERT INTO subscribes (id, user, subscriber) VALUES ("", ?, ?)', array($user, $current_user));
	}

	/**
	 * Unsubscribe function 
	 * @param  string $current_user [description]
	 * @param  string $user         [description]
	 * @return boolean              [description]
	 */
	public static function unsubscribe($current_user, $user) 
	{
		return parent::db()->run('DELETE FROM subscribes WHERE user = ? AND subscriber = ?', array($user, $current_user));
	}

	/**
	 * Function gets images by user's id
	 * 
	 * @return array
	 */
	public static function getProfileImages($id)
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

	/**
	 * Function uploads an user's image
	 *  
	 * @return array
	 */
	public static function addImage($image, $username)
	{
		if ($userId = parent::db()->run('SELECT id FROM users WHERE username = ? LIMIT 1', array($username))->fetchColumn()) {
			return parent::db()->run('INSERT INTO user_images (id, image, owner, creation_date) VALUES("", ?, ?, NOW())', array($image, $userId));
		}
	}

	/**
	 * Function gets private info by username
	 * 
	 * @return array
	 */
	public static function getPrivateInfo($username) 
	{
		return parent::db()->run('SELECT username, password, email FROM users WHERE username = ?', array($username))->fetch();
	}

	/**
	 * Function send a like to the photo
	 * 
	 * @todo realize
	 * @return boolean
	 */
	public static function like($id) 
	{
		return parent::db()->run('UPDATE user_images SET likes = likes + 1 WHERE id = ?', array($id))->fetch();
	}

	/**
	 * Function send a dislike to the photo
	 * 
	 * @todo realize
	 * @return boolean
	 */
	public static function dislike($id)
	{

	}

	/**
	 * Function gets info about photo
	 * 
	 * @param  integer $id 
	 * @return array
	 */
	public static function getPhoto($image) 
	{
		return parent::db()->run('SELECT likes FROM user_images WHERE image = ?', array($image))->fetch();
	}
}