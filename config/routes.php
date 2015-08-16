<?php

namespace Icybee\Modules\Search;

use Icybee\Routing\RouteMaker as Make;

return Make::admin('search', Routing\SearchAdminController::class, [

	'only' => 'index'

]);
