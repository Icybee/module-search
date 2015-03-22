<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Search;

use Icybee\Modules\Views\ViewOptions;

class Module extends \Icybee\Module
{
	protected function lazy_get_views()
	{
		return [

			'home' => [

				ViewOptions::TITLE => 'Rechercher sur le site',
				ViewOptions::RENDERS => ViewOptions::RENDERS_OTHER

			]

		];
	}
}
