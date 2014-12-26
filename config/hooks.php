<?php

namespace Icybee\Modules\Search;

$hooks = __NAMESPACE__ . '\Hooks::';

return [

	'patron.markups' => [

		'search:form:quick' => [

			$hooks . 'markup_form', [

			]
		]
	]
];
