<?php

return [

	'module_title.search' => 'Search',

	'search' => [

		'found' => [

			'none' => 'No result found.',
			'one' => 'One result found.',
			'other' => ':count results found.'

		],

		'more' => [

			'one' => 'See the result found for %search',
			'other' => 'See the :count results found for %search'

		],

		'label' => [

			'keywords' => 'Keywords',
			'in' => 'Search in',
			'search' => 'Search'

		],

		'option.all' => '<All>',

		'config_block' => [

			'group.description' => [

				'with_page' => "The search engine is currently on the page <q>:link</q>.",

				'without_page' => "There is no page defined for the search results. If you wish to
				provide a search engine to your visitors, go to :link, choose the page you
				want to dedicate to research, change the editor of the body of the page to
				<q>view</q> and choose the view <q>Structure/Search/Search Site</q>."

			],

			'limits_home' => "Maximum number of results per module during the initial search",
			'limits_list' => "Maximum number of results in targeted search",

			'element.label.scope' => 'Search scope',
			'element.description.scope' => "Select the modules for which the search is enabled. Sort
			modules by drag &amp; drop to set the order of the search."

		]
	]
];
