<?php

return array(
	# Authorization
	'register' => 'auth/register',
	'login' => 'auth/login',
	'logout' => 'auth/logout',

	# User actions
	'photo/([0-9]+)' => 'profile/photo/$1',
	'cabinet/addimage' => 'profile/addimage',
	'account/edit' => 'profile/edit',
	'([a-zA-Z0-9]+)' => 'profile/profile/$1',
	
	# Index
	'index.php' => 'index/index',
	'' => 'index/index'
);