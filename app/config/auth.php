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
		'resturant' =>[
			'driver' => 'eloquent',
			'model' => 'Resturant',
			'table'=>'resturants'
		]
	],

	'reminder' => [

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	],

);
