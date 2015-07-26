<?php

namespace Icybee\Modules\Search;

use Icybee\Routing\RouteMaker as Make;

return Make::admin('search', Routing\SearchAdminController::class, [

	'only' => 'index'

]);

return [

	'admin:search' => [

		'pattern' => '/admin/search',
		'controller' => 'Icybee\Controller\BlockController',
		'block' => 'config',
		'index' => true,
		'title' => 'Config.'

	],

	'admin:search/config' => [

		'pattern' => '/admin/search/config',
		'location' => '/admin/search'

	]

];
