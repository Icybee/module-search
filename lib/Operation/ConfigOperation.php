<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Search\Operation;

use Icybee\Binding\PrototypedBindings;

class ConfigOperation extends \Icybee\Operation\Module\ConfigOperation
{
	use PrototypedBindings;

	protected function process()
	{
		$request = $this->request;

		$key = $this->module->flat_id . '.scope';
		$scope = null;

		if (isset($request['local'][$key]))
		{
			$scope = implode(',', array_keys($request['local'][$key]));

			unset($request->params['local'][$key]);
		}

		$this->app->site->metas[$key] = $scope;

		return parent::process();
	}
}
