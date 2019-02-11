<?php

namespace App\Http\Controllers\Website;

use App\Commons\CConstant;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostMeta;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct() {
		$current_method = $this->getCurrentMethod();
		view()->share(compact('current_method'));
		$this->getBreadcrumb();
	}

	public    $breadcrumb         = [];
	protected $prefixBreadcrumb   = '';
	protected $pathInfoBreadcrumb = '';

	public function getBreadcrumb() {
		$breadcrumb = [['text' => __('website.home page'), 'url' => url('/')]];

		$pathInfo = request()->getPathInfo();
		$pathInfo = str_replace('/', '', $pathInfo);
		if (in_array($pathInfo, ['san-pham', 'tuyen-dung', 'dich-vu', 'tin-tuc', 'gioi-thieu'])) {
			$this->breadcrumb = [['text' => __('website.' . $pathInfo), 'url' => '#']];
		}
		else {
			$this->getPrefixBreadcrumb();
			$this->getPathInfoBreadcrumb();
		}

		if (!empty($this->breadcrumb)) {
			$breadcrumb = array_merge($breadcrumb, $this->breadcrumb);
		}

		view()->share(compact('breadcrumb'));
	}

	protected $seo_title       = '';
	protected $seo_keyword     = '';
	protected $seo_description = '';

	public function renderSEOMeta() {
		view()->share([
			'seo_title'       => !empty($this->seo_title) ? $this->seo_title : setting('seo_title'),
			'seo_keyword'     => !empty($this->seo_keyword) ? $this->seo_keyword : setting('seo_keyword'),
			'seo_description' => !empty($this->seo_description) ? $this->seo_description : setting('seo_description'),
		]);
	}

	/**
	 * @return string
	 */
	public function getPrefixBreadcrumb(): string {
		if (empty($this->prefixBreadcrumb)) {
			return $this->prefixBreadcrumb;
		}

		if ($this->prefixBreadcrumb == Post::TYPE_NEWS) {
			$this->prefixBreadcrumb = 'tin-tuc';
		}

		if (strpos($this->prefixBreadcrumb, '-') === false) {
			$this->breadcrumb[] = ['text' => $this->prefixBreadcrumb, 'url' => '#'];

			return $this->prefixBreadcrumb;
		}


		$this->breadcrumb[] = ['text' => __('website.' . $this->prefixBreadcrumb), 'url' => url($this->prefixBreadcrumb)];

		return __('website.' . $this->prefixBreadcrumb);
	}

	/**
	 * @param string $prefixBreadcrumb
	 */
	public function setPrefixBreadcrumb(string $prefixBreadcrumb): void {
		$this->prefixBreadcrumb = $prefixBreadcrumb;
	}

	/**
	 * @return string
	 */
	public function getPathInfoBreadcrumb(): string {
		$pathInfo = request()->getPathInfo();
		$pathInfo = str_replace('/', '', $pathInfo);

		if (!empty($this->pathInfoBreadcrumb)) {
			$pathInfo = $this->pathInfoBreadcrumb;
		}

		if (!empty($this->pathInfoBreadcrumb)) {
			$this->breadcrumb[] = ['text' => __('' . $pathInfo), 'url' => '#'];
		}

		return $this->pathInfoBreadcrumb;
	}

	/**
	 * @param string $pathInfoBreadcrumb
	 */
	public function setPathInfoBreadcrumb(string $pathInfoBreadcrumb): void {
		$this->pathInfoBreadcrumb = $pathInfoBreadcrumb;
	}
}
