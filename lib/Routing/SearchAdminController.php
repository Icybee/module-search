<?php

namespace Icybee\Modules\Search\Routing;

use Icybee\Routing\AdminController;

class SearchAdminController extends AdminController
{
	protected function index()
	{
		$this->view->content = $this->module->getBlock('config');
		$this->view['block_name'] = 'config';
	}
}
