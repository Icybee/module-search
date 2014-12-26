<?php

return [

	'admin:search' => [

		'pattern' => '/admin/search',
		'controller' => 'Icybee\BlockController',
		'block' => 'config',
		'index' => true,
		'title' => 'Config.'

	],

	'admin:search/config' => [

		'pattern' => '/admin/search/config',
		'location' => '/admin/search'

	]

];
