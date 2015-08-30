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

use ICanBoogie\I18n;
use ICanBoogie\Module\Descriptor;

use Brickrouge\A;
use Brickrouge\Document;
use Brickrouge\Element;
use Brickrouge\Form;
use Brickrouge\Text;

/**
 * A block to configure search.
 *
 * @property-read \ICanBoogie\Core|\Icybee\Binding\CoreBindings $app
 */
class ConfigBlock extends \Icybee\Block\ConfigBlock
{
	static protected function add_assets(Document $document)
	{
		parent::add_assets($document);

		$document->css->add(DIR . 'public/admin.css');
		$document->js->add(DIR . 'public/admin.js');
	}

	protected function lazy_get_attributes()
	{
		$app = $this->app;
		$page = $app->site->resolve_view_target('search/home');

		if ($page)
		{
			$description_link = (string) new A($page->title, $app->url_for('admin:pages:edit', $page));
		}
		else
		{
			$description_link = '<q>' . new A('Pages', $app->routes['admin:pages:index']) . '</q>';
		}

		return \ICanBoogie\array_merge_recursive(parent::lazy_get_attributes(), [

			Element::GROUPS => [

				'primary' => [

					'description' => $this->t($page ? 'with_page' : 'without_page', [

						':link' => $description_link

					])

				]
			]
		]);
	}

	protected function lazy_get_children()
	{
		$ns = $this->module->flat_id;

		return array_merge(parent::lazy_get_children(), [

			"local[$ns.scope]" => $this->create_control_scope(),

			"local[$ns.limits.home]" => new Text([

				Form::LABEL => 'limits_home',
				Element::DEFAULT_VALUE => 5

			]),

			"local[$ns.limits.list]" => new Text([

				Form::LABEL => 'limits_list',
				Element::DEFAULT_VALUE => 10

			])
		]);
	}

	protected function create_control_scope()
	{
		$options = [];
		$app = $this->app;
		/* @var $modules \ICanBoogie\Module\ModuleCollection */
		$modules = $app->modules;

		foreach ($modules->descriptors as $module_id => $descriptor)
		{
			if (!isset($modules[$module_id]))
			{
				continue;
			}

			if (!$modules->is_inheriting($module_id, 'contents') && !$modules->is_inheriting($module_id, 'pages'))
			{
				continue;
			}

			$options[$module_id] = $this->t($descriptor[Descriptor::TITLE], [], [ 'scope' => 'module_title' ]);
		}

		$options['google'] = '<em>Google</em>';

		asort($options);

		#

		$ns = $this->module->flat_id;

		$scope = explode(',', $app->site->metas[$ns . '.scope']);
		$scope = array_combine($scope, array_fill(0, count($scope), true));

		$sorted_options = [];

		foreach ($scope as $module_id => $dummy)
		{
			if (empty($options[$module_id]))
			{
				continue;
			}

			$sorted_options[$module_id] = $options[$module_id];
		}

		$sorted_options += $options;

		$el = '<ul class="sortable self-handle">';

		foreach ($sorted_options as $module_id => $label)
		{
			$el .= '<li>';

			$el .= new Element('input', [

				Element::LABEL => $label,

				'name' => "local[$ns.scope][$module_id]",
				'type' => 'checkbox',
				'checked' => !empty($scope[$module_id])

			]);

			$el .= '</li>';
		}

		$el .= '</ul>';

		return new Element('div', [

			Form::LABEL => 'scope',
			Element::INNER_HTML => $el,
			Element::DESCRIPTION => 'scope'

		]);
	}
}
