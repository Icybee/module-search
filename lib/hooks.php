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

use Brickrouge\Element;
use Brickrouge\Form;
use Brickrouge\Searchbox;

class Hooks
{
	static public function markup_form(array $args, \Patron\Engine $patron, $template)
	{
		$app = self::app();
		$page = $app->site->resolve_view_target('search/home');

		if (!$page)
		{
			throw new \ICanBoogie\Exception\Config($app->modules['search']);
		}

		$label = $app->translate('search.label.search');

		$tags = [

			Form::VALUES => $_GET,

			Element::CHILDREN => [

				'q' => new Searchbox([

					Form::LABEL => $label,
					'placeholder' => $label

				])

			],

			'class' => 'navbar-search',
			'method' => \ICanBoogie\HTTP\Request::METHOD_GET,
			'action' => $page->url

		];

		return $template
			? new \WdTemplatedForm($tags, $patron($template))
			: (string) new Form($tags);
	}

	// TODO: move to the module and use registry configuration.
	// TODO: user->language ?

	static protected $config = [

		'url' => 'http://ajax.googleapis.com/ajax/services/search/web',
		'options' => [

			'gl' => 'fr',
			'hl' => 'fr',
			'rsz' => 'large'

		]

	];

	static public function search($query, $start = 0, array $options = [])
	{
		$app = self::app();
		$site = $app->registry['siteSearch.host'];

		if (!$site)
		{
			$site = $_SERVER['SERVER_NAME'];
			$site = str_replace('www.', '', $site);
		}

		$options += self::$config['options'];

		$query = self::$config['url'] . '?' . http_build_query([

			'q' => $query . ' site:' . $site,
			'start' => $start,
			'v' => '1.0'

		] + $options);

//		echo "query: $query" . PHP_EOL;

		$rc = file_get_contents($query);

		$response = json_decode($rc)->responseData;

		foreach ($response->results as $result)
		{
			$shortUrl = $result->unescapedUrl;
			$shortUrl = substr($shortUrl, strpos($shortUrl, $site) + strlen($site));

			$result->shortUrl = $shortUrl;
		}

		return $response;
	}

	static public function matches(array $args, \Patron\Engine $patron, $template)
	{
		$_GET += [

			'q' => null,
			'start' => 0

		];

		$search = $_GET['q'];
		$start = $_GET['start'];

		if (!$search)
		{
			return;
		}

		$response = self::search($search, $start);
		$count = count($response->results);
		$total = isset($response->cursor->estimatedResultCount) ? $response->cursor->estimatedResultCount : 0;
		$page = 0;
		$pageIndex = 0;
		$pager = null;

		if ($total && count($response->cursor->pages) > 1)
		{
			$pageIndex = $response->cursor->currentPageIndex;
			$pages = [];

			foreach ($response->cursor->pages as $i => $page)
			{
				$pages[] = ($pageIndex == $i) ? '<strong>' . $page->label . '</strong>' : '<a href="?start=' . $page->start . '&amp;q=' . \ICanBoogie\escape(urlencode($search)) . '">' . $page->label . '</a>';
			}

			$pager = '<div class="pager">' . implode('<span class="separator">, </span>', $pages) . '</div>';
		}

		$patron->context['self']['q'] = $search;
		$patron->context['self']['response'] = $response;
		$patron->context['self']['pager'] = $pager;
		$patron->context['self']['range'] = [

			'lower' => $start + 1,
			'upper' => $start + $count,
			'start' => $start,
			'page' => $pageIndex,
			'count' => $total

		];

		return $patron($template, $response->results);
	}

	/**
	 * @return \ICanBoogie\Core|\Icybee\Binding\CoreBindings
	 */
	static private function app()
	{
		return \ICanBoogie\app();
	}
}
