<?php

class User extends Model 
{
	/**
	 * Function changes user's username
	 * @todo optimization
	 * @return boolean
	 */
	public static function changeUsername($username, $old_username)
	{
		if (!parent::db()->run('SELECT 1 FROM users WHERE username = ?', array($username))->fetch()) {
			$id = parent::db()->run('SELECT id FROM users WHERE username = ? LIMIT 1', array($old_username))->fetchColumn();
			
			return parent::db()->run('UPDATE users SET username = ? WHERE id = ?', array($username, $id));
		}

		return false;
	}

	/**
	 * Function gets user's id by username
	 * @return integer
	 */
	public static function getUserId($username)
	{
		return parent::db()->run('SELECT id FROM users WHERE username = ? LIMIT 1', array($username))->fetchColumn();
	}

	/**
	 * Function gets user's info by username
	 * @return array
	 */
	public static function getInfo($username)
	{
		return parent::db()->run('SELECT id, username, avatar FROM users WHERE username = ?', array($username))->fetch();
	}

	/**
	 * Function gets images by user's id
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
	 * @return array
	 */
	public static function addImage($image, $username)
	{
		$userId = parent::db()->run('SELECT id FROM users WHERE username = ? LIMIT 1', array($username))->fetchColumn();
		
		return parent::db()->run('INSERT INTO user_images (id, image, owner) VALUES("", ?, ?)', array($image, $userId));
	}

	/**
	 * Function gets private info by username
	 * @return array
	 */
	public static function getPrivateInfo($username) 
	{
		return parent::db()->run('SELECT username, password, email FROM users WHERE username = ?', array($username))->fetch();
	}

	/**
	 * Function send a like to the photo
	 * @todo realize
	 * @return boolean
	 */
	public static function likePhoto($id) 
	{
		return parent::db()->run('UPDATE user_images SET likes = likes + 1 WHERE id = ?', array($id))->fetch();
	}

	/**
	 * Function gets info about photo
	 * @param  integer $id 
	 * @return array
	 */
	public static function getPhoto($id) 
	{
		$photo = array();
		$query = parent::db()->run('SELECT owner, likes FROM user_images WHERE image = ?', array($id));

		while ($result = $query->fetch()) {
			$photo['owner'] = $result['owner'];
			$photo['likes'] = $result['likes'];
		}

		return $photo;
	}
}