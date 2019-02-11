<?php

namespace App\Http\Controllers\Website;

use App\Commons\CConstant;
use App\Http\Controllers\Website\Traits\SlugableTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;


/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class HomeController extends Controller
{
	use SlugableTrait;
	/**
	 * HomeController constructor.
	 * Create a new controller instance.
	 */
	public function __construct() {
		$this->middleware('guest');
		parent::__construct();
	}

	/**
	 * Show the application dashboard.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->renderSEOMeta();

		return view('website.home.index');
	}

	/**
	 * @param $locale
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function changeLocale($locale) {
		session()->put('website_locale', $locale);
		cache()->delete(config('common.cache.keys.website.menus'));

		return redirect()->back();
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showContact() {
		$this->prefixBreadcrumb = __('abilities.contact.name');
		$this->getBreadcrumb();

		return view('website.home.contact');
	}
}
