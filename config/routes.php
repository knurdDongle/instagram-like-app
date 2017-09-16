<?php

return array(
	# Authorization
	'register' => 'auth/register',
	'login' => 'auth/login',
	'logout' => 'auth/logout',

	# User Actions
	'unsubscribe' => 'action/unsubscribe',
	'subscribe' => 'action/subscribe',
	'cabinet/addimage' => 'action/addimage',
	'account/edit' => 'profile/edit',

	# User info
	'photo/([0-9]+)' => 'profile/viewphoto/$1',
	'following/([a-zA-Z0-9]+)' => 'profile/following/$1',
	'subscribers/([a-zA-Z0-9]+)' => 'profile/subscribers/$1',
	'(^[a-zA-Z0-9]+$)' => 'profile/user/$1',

	# Index
	'index.php' => 'index/index',
	'' => 'index/index'
);