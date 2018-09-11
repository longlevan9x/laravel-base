<?php

namespace App\Http\Controllers\Website;

use App\Commons\CConstant;
use App\Http\Requests\PostRequest;
use App\Mail\ContactMail;
use App\Mail\OrderMail;
use App\Mail\SubscribeMail;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Store;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Mail;
use function MicrosoftAzure\Storage\Samples\deleteDirectory;

/**
 * Class HomeController
 * @package App\Http\Controllers\Website
 */
class HomeController extends Controller
{
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
		//		if (Cache::has('slides')) {
		//			$slides = Cache::get('slides');
		//		}
		//		else {
		//			$slides = Post::whereType(Post::TYPE_SLIDE)->where('is_active', CConstant::STATE_ACTIVE)->get();
		//			Cache::put('slides', $slides, 60);
		//		}

		//		if (Cache::has('categories')) {
		//			$categories = Cache::get('categories');
		//		}
		//		else {
		//			$categories = Category::whereType(Category::TYPE_CATEGORY)->get();
		//			Cache::put('categories', $categories, 60);
		//		}
		//
		//		if (Cache::has('shares')) {
		//			$shares = Cache::get('shares');
		//		}
		//		else {
		//			$shares = Post::whereType(Post::TYPE_SHARE)->latest()->limit(10)->get();
		//			Cache::put('shares', $shares, 60);
		//		}
		//
		//		if (Cache::has('postNews')) {
		//			$postNews = Cache::get('postNews');
		//		}
		//		else {
		//			$postNews = Post::whereType(Post::TYPE_NEWS)->latest()->limit(6)->get();
		//			Cache::put('postNews', $postNews, 60);
		//		}
		//
		//		if (Cache::has('product')) {
		//			$product = Cache::get('product');
		//		}
		//		else {
		//			$product = Product::where('post_type', Product::POST_TYPE_DETAIL)->first();
		//			Cache::put('product', $product, 60);
		//		}

		$slides     = Post::whereType(Post::TYPE_SLIDE)->where('is_active', CConstant::STATE_ACTIVE)->get();
		$shares     = Post::whereType(Post::TYPE_SHARE)->latest()->limit(10)->get();
		$product    = Product::where('post_type', Product::POST_TYPE_DETAIL)->first();
		$postNews   = Post::whereType(Post::TYPE_NEWS)->latest()->limit(6)->get();
		$categories = Category::whereType(Category::TYPE_CATEGORY)->where('parent_id', '>', 0)->active()->get();
		$this->renderSEOMeta();

		return view('website.home.index', compact('slides', 'categories', 'shares', 'postNews', 'product'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showProduct() {
		$model = Product::where('post_type', Product::POST_TYPE_DETAIL)->first();
		$this->renderSEOMeta();

		return view('website.home.product', compact('model'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showAnswerQuestion() {
		$models = Answer::whereType(Post::TYPE_QUESTION)->latest()->whereIsActive(CConstant::STATE_ACTIVE)->paginate(5);
		$this->renderSEOMeta();

		return view('website.home.question-answer', compact('models'));
	}

	public function showCategory($type) {
		$models = Post::whereType($type)->where('is_active', CConstant::STATE_ACTIVE)->paginate(5);
		$this->renderSEOMeta();

		return view('website.home.category', compact('models'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showNews() {
		$this->renderSEOMeta();

		return $this->showCategory(Post::TYPE_NEWS);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showExpert() {
		$this->renderSEOMeta();

		return $this->showCategory(Post::TYPE_EXPERT);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showShare() {
		$this->renderSEOMeta();

		return $this->showCategory(Post::TYPE_SHARE);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showSystemStore() {
		/** @var Category $models */
		$models = Category::whereType(Category::TYPE_AREA)->get();
		$this->renderSEOMeta();

		return view('website.home.system-store', compact('models'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showOrder() {
		$model   = Product::where('post_type', Product::POST_TYPE_DETAIL)->first();
		$setting = Setting::where('key', Setting::KEY_MESSAGE_ORDER)->first();
		$this->renderSEOMeta();

		return view('website.home.order', compact('model', 'setting'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function postOrder(Request $request) {
		$model = new Order($request->all());
		/** @var Product $product */
		$product            = Product::whereId($model->product_id)->first();
		$model->price       = $product->price;
		$model->total_price = $model->price * (int) $model->quantity;
		$model->status      = Order::STATUS_NEW;
		if ($model->save()) {
			Mail::to(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->send(new OrderMail($request->name, $request->phone, $request->quantity, $product->price));

			return redirect(route('dat-hang-thanh-cong', ['mess' => CConstant::STATUS_SUCCESS]));
		}

		return redirect(route('dat-hang-thanh-cong', ['mess' => CConstant::STATUS_FAIL]));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showOrderMessage() {
		$model = Setting::where('key', Setting::KEY_MESSAGE_ORDER_SUCCESS)->first();
		$this->renderSEOMeta();

		return view('website.home.order-message', compact('model'));
	}

	public function postOrderAjax() {

	}

	/**
	 * @param $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showByCategory($slug) {
		/** @var Category $category */
		$category = Category::findBySlugOrFail($slug);
		if ($category->type == Category::TYPE_STREET) {
			$this->prefixBreadcrumb   = Category::TYPE_STREET;
			$models                   = Store::where('is_active', CConstant::STATE_ACTIVE)->get();
			$this->prefixBreadcrumb   = 'he-thong-nha-thuoc';
			$this->pathInfoBreadcrumb = $category->name;
			$this->getBreadcrumb();
			$this->renderSEOMeta();

			return view('website.home.store', compact('models'));
		}
		if ($category->type != Category::TYPE_CATEGORY) {
			$models = $category->getChildren()->get();

			if (in_array($category->type, [
				Category::TYPE_CITY,
				Category::TYPE_DISTRICT,
				Category::TYPE_AREA
			])) {
				$this->prefixBreadcrumb = 'he-thong-nha-thuoc';
			}
			$this->pathInfoBreadcrumb = $category->name;

			$this->getBreadcrumb();
			$this->renderSEOMeta();

			return view('website.home.system-store', compact('models'));
		}

		$this->prefixBreadcrumb = Post::TYPE_NEWS;

		$models = Post::where('category_id', $category->id)->where('is_active', CConstant::STATE_ACTIVE)->paginate(5);

		$this->getBreadcrumb();
		$this->renderSEOMeta();

		return view('website.home.category', compact('models'));
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showPost($slug) {
		$id   = substr($slug, strpos($slug, '--'));
		$slug = str_replace($id, '', $slug);
		/** @var Post $model */
		$model = Post::findBySlug($slug);

		$this->pathInfoBreadcrumb = $model->title;
		$this->prefixBreadcrumb   = $model->type;

		$relate_posts = Post::whereType($model->type)->latest()->limit(6)->get();

		if ($model->type == Post::TYPE_QUESTION) {
			$this->prefixBreadcrumb = 'hoi-dap';
			$this->getBreadcrumb();
			$this->renderSEOMeta();

			return view('website.home.question-answer-detail', compact('model', 'relate_posts'));
		}
		elseif ($model->type == Post::TYPE_ADVICE) {
			$this->prefixBreadcrumb = '';
			$this->getBreadcrumb();
			$this->renderSEOMeta();

			return view('website.home.advice', compact('model', 'relate_posts'));
		}
		$this->getBreadcrumb();

		$advertise_post = Post::prepareMetaValueKey((new Post)->queryWithPostMeta()->where('is_active', 1)->get());

		$product = Product::wherePostType(Product::POST_TYPE_DETAIL)->first();
		$this->renderSEOMeta();

		return view('website.home.post', compact('model', 'relate_posts', 'advertise_post', 'product'));
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showBySlug($slug) {
		if (strpos($slug, '--') == false) {
			return $this->showByCategory($slug);
		}

		return $this->showPost($slug);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function postSubscribe(Request $request) {

		$phone = intval($request->phone);
		if (strlen($phone) < 9 || strlen($phone) > 11) {
			return responseJson(CConstant::STATUS_FAIL, "Số điện thoại không hợp lệ");
		}

		$model = new Post;

		$model->type = Post::TYPE_SUBSCRIBE;

		$model->title     = time();
		$model->content   = $request->name;
		$model->overview  = $request->phone;
		$model->is_active = 1;
		if ($model->save()) {
			Mail::to(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->send(new SubscribeMail($request->name, $request->phone));

			return responseJson(CConstant::STATUS_SUCCESS, 'Xác nhận đăng ký thành công. Yêu cầu tư vấn của bạn đã được chúng tôi tiếp nhận.');
		}

		return responseJson(CConstant::STATUS_FAIL, 'Yêu cầu đăng ký tư vấn của bạn đã thất bại. Xin vui lòng thử lại sau.');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function postContact(Request $request) {
		$phone = intval($request->phone);
		if (strlen($phone) < 9 || strlen($phone) > 11) {
			return responseJson(CConstant::STATUS_FAIL, "Số điện thoại không hợp lệ");
		}

		$model = new Post;

		$model->type = Post::TYPE_CONTACT;

		$model->title     = time();
		$model->content   = $request->name;
		$model->overview  = $request->phone;
		$model->is_active = 1;
		if ($model->save()) {
			$model->postMeta()->create(['key' => '_post_contact', 'value' => $request->question]);
			Mail::to(setting(KEY_ADMIN_EMAIL) ?? config('mail.username'))->send(new ContactMail($request->name, $request->phone, $request->question));

			return responseJson(CConstant::STATUS_SUCCESS, 'Gửi yêu cầu liên hệ thành công. chúng tôi sẽ liên hệ với bạn trong giới gian sớm nhất');
		}

		return responseJson(CConstant::STATUS_FAIL, 'Yêu cầu liên hệ của bạn đã thất bại. Xin vui lòng thử lại sau.');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function publicProduct() {
		$advertise_post = Post::prepareMetaValueKey((new Post)->queryWithPostMeta()->where('is_active', 1)->get());
		$product        = Product::wherePostType(Product::POST_TYPE_DETAIL)->first();
		$this->renderSEOMeta();

		return view('website.home.public-product', compact('product', 'advertise_post'));
	}
}
