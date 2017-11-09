<?php

interface iUser
{
	static function getProfile($username);
	static function getProfileImage($image);
	static function getProfileImages($username);
	static function getProfileAvatar($id);
	static function getProfileFollowings($username);
	static function getProfileSubscribers($username);

	static function getFollowingPosts();
	static function getUsername($id);
	static function getUserid($username);

	static function isFollowed($subscriber, $user);

	static function getSettingsInfo();

	static function postImage($image, $image_name);
	static function setUsername($username);
	static function doUnsubscribe($user);
	static function doSubscribe($user);
	static function isLiked($id);
	static function doLike($id);

	static function username_exists($username);
	static function profile_exists($username, $email);
}