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
		$this->getMenu();
		view()->share(compact('current_method'));
		$this->getBannerBottomLeft();
		$this->getBreadcrumb();
		$this->getAdviceAside();
		$this->getShareAside();
		$menu_footer = Category::whereType()->whereParentId(0)->active()->get();
		view()->share(compact('menu_footer'));
	}

	/**
	 * @return array|mixed
	 * @throws \Exception
	 */
	public function getMenu() {
		//		if (cache()->has('menus')) {
		//			$menus = Cache::get('menus');
		//		} else {

		//		$menus0 = [
		//			['text' => __('website.home page'), 'url' => url('/')],
		//			['text' => __('website.product'), 'url' => url('/san-pham')],
		//		];
		//
		//		$menu   = Menu::query()->orderBy('sort_order')->get();
		//		$menus1 = [
		//			['text' => __('website.diseases'), 'url' => '#', 'children' => []],
		//		];
		//
		//		$categories            = Category::whereType(Category::TYPE_CATEGORY)->where('parent_id', '<>', 0)->where('is_active', 1)->get();
		//		$menus1[0]['children'] = $this->getCategoryMenu($categories);
		//
		//		$menus2 = [
		//			['text' => __('website.chuyen-gia'), 'url' => url('/chuyen-gia')],
		//			['text' => __('website.chia-se'), 'url' => url('/chia-se')],
		//			['text' => __('website.question answer'), 'url' => url('/hoi-dap')],
		//			['text' => __('website.news'), 'url' => url('/tin-tuc')],
		//			['text' => __('website.system_store'), 'url' => url('/he-thong-nha-thuoc')],
		//			['text' => __('website.order'), 'url' => url('/dat-hang')],
		//		];
		//
		//		$menus = array_merge($menus0, $menus1, $menus2);
		//		cache()->put('menus', $menus, 60);
		//		//		}
		//
		$menus0 = [
			['text' => __('website.home page'), 'url' => url('/')],
		];

		$categories = Category::whereType()->active()->get();
		$menus1     = $this->getCategoryMenu($categories);
		$menus      = array_merge($menus0, $menus1);

		view()->share(compact('menus'));
	}

	/**
	 * @param       $categories
	 * @param int   $parent_id
	 * @param array $output
	 * @param int   $level
	 * @return array
	 */
	public function getCategoryMenu($categories, $parent_id = 0, &$output = [], $level = 0) {
		//		foreach ($categories as $category) {
		//			$output[$category->id] = [
		//				'text' => $category->name,
		//				'url'  => url($category->slug),
		//			];
		//		}
		//
		//		return $output;
		foreach ($categories as $category) {
			/** @var Category $category */
			if ($category->parent_id == $parent_id) {
				if ($category->parent_id == 0) {
					$output[$category->id] = [
						'text'     => $category->name,
						'url'      => url($category->slug),
						'children' => []
					];
				}
				else {
					$output[$category->parent_id]['url'] = "#";

					$output[$category->parent_id]['children'][$category->id] = [
						'text' => $category->name,
						'url'  => url($category->slug)
					];
					unset($category->id);
				}
				$id = $category->id;
				unset($category->id);
				$this->getCategoryMenu($categories, $id, $output, $level);
			}
		}

		return $output;
	}


	public function getBannerBottomLeft() {
		/** @var PostMeta $model */
		$model = PostMeta::where('key', PostMeta::KEY_IS_BANNER)->first();

		$post = $model->post()->first();

		if (empty($model) || empty($post)) {
			$banner_bottom_left = [];
		}
		else {
			/** @var Post $post */

			$banner_bottom_left = [
				'image' => $model->getImagePath('', 'value'),
				'url'   => url($post->getSlugAndId())
			];
		}

		view()->share(compact('banner_bottom_left'));
	}

	public    $breadcrumb         = [];
	protected $prefixBreadcrumb   = '';
	protected $pathInfoBreadcrumb = '';

	public function getBreadcrumb() {
		$breadcrumb = [['text' => __('website.home page'), 'url' => url('/')]];

		$pathInfo = request()->getPathInfo();
		$pathInfo = str_replace('/', '', $pathInfo);
		if (in_array($pathInfo, ['san-pham', 'he-thong-nha-thuoc', 'dat-hang', 'tin-tuc', 'hoi-dap', 'chuyen-gia', 'dat-hang-thanh-cong'])) {
			$this->breadcrumb = [['text' => __('website.' . $pathInfo), 'url' => '#']];
		}
		else {
			$prefix = $this->prefixBreadcrumb;
			if ($this->prefixBreadcrumb == Post::TYPE_NEWS) {
				$prefix = 'tin-tuc';
			}

			if ($this->prefixBreadcrumb == Post::TYPE_EXPERT) {
				$prefix = 'chuyen-gia';
			}

			if (!empty($this->pathInfoBreadcrumb)) {
				$pathInfo = $this->pathInfoBreadcrumb;
			}

			if (!empty($prefix)) {
				$this->breadcrumb[] = ['text' => __('website.' . $prefix), 'url' => url($prefix)];
			}
			if (!empty($this->pathInfoBreadcrumb)) {
				$this->breadcrumb[] = ['text' => __('' . $pathInfo), 'url' => '#'];
			}
		}

		if (!empty($this->breadcrumb)) {
			$breadcrumb = array_merge($breadcrumb, $this->breadcrumb);
		}

		view()->share(compact('breadcrumb'));
	}

	public function getShareAside() {
		//		if (cache()->has('share_experience')) {
		//			$share_experience = Cache::get('share_experience');
		//		}
		//		else {
		$share_experience = Post::whereType(Post::TYPE_SHARE)->orderByDesc('created_at')->limit(5)->get();
		//			cache()->put('share_experience', $share_experience, 60);
		//		}
		view()->share(compact('share_experience'));
	}

	public function getAdviceAside() {
		//		if (cache()->has('advice_expert')) {
		//			$advice_expert = Cache::get('advice_expert');
		//		}
		//		else {
		$advice_expert = Post::whereType(Post::TYPE_ADVICE)->orderByDesc('created_at')->limit(5)->get();
		//			cache()->put('advice_expert', $advice_expert, 60);
		//		}
		view()->share(compact('advice_expert'));
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
}
