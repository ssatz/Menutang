<?php

return array(

	'multi' => [
		'admin' => [
			'driver' => 'eloquent',
			'model' => 'Admin',
			'table'=>'admins'
		],
		'user' => [
			'driver' => 'eloquent',
			'model' => 'User',
			'table'=>'user'
		],
		'businessuser' => [
			'driver' => 'eloquent',
			'model' => 'BusinessUser',
			'table' => 'business_user'
		]
	],

	'reminder' => [

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	],

);
