<?php

return [

	'module_title.search' => 'Recherche',

	'search' => [

		'found' => [

			'none' => 'Aucun résultat trouvé.',
			'one' => 'Un résultat trouvé.',
			'other' => ':count résultats trouvés.'

		],

		'more' => [

			'one' => 'Voir le résultat trouvé pour %search',
			'other' => 'Voir les :count résultats trouvés pour %search'

		],

		'label' => [

			'keywords' => 'Mots clé',
			'in' => 'Rechercher dans',
			'search' => 'Rechercher'

		],

		'option.all' => '<Tout>',

		'config_block' => [

			'group.description' => [

				'with_page' => "Le moteur de recherche se trouve actuellement sur la page <q>:link</q>.",

				'without_page' => "Aucune page n'est définie pour afficher les résultats de
				recherche. Si vous souhaitez proposer les fonctionnalités de recherche à vos visiteurs,
				rendez-vous dans l'onglet :link, choisissez la page que vous souhaitez dédier à la
				recherche, changez l'éditeur du corps de la page pour <q>Vue</q> et choisissez la vue
				<q>Fonctionnalités/Rechercher/Rechercher sur le site</q>."

			],

			'limits_home' => "Nombre de résultats maximum par module lors de la recherche initiale",
			'limits_list' => "Nombre de résultats maximum lors de la recherche ciblée",

			'element.label.scope' => "Portée de la recherche",
			'element.description.scope' => "Sélectionner les modules pour activer la recherche.
			Ordonner les modules par glisser-déposer pour définir l'ordre dans lequel
			s'effectue la recherche."

		]
	]
];
