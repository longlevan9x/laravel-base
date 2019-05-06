<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{App, File};

/**
 * Class TranslationManagerController
 * @package App\Http\Controllers
 */
class TranslationManagerController extends Controller
{
	/**
	 * @param null $locale
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index($locale = null) {
		if ($locale == null) {
			$locale = config('common.language.locale');
		}

		$directory = request()->get('directory');
		$folders = [];
		$files   = [];
		if ($locale) {

			$path = $this->langPath() . '/' . $locale;
			if (!empty($directory)) {
				$path .= "/$directory";
			}
			$folders = File::directories($path);
			$files   = File::files($path);
		}
		else {
			$path = $this->langPath();
			if (!empty($directory)) {
				$path .= "/$directory";
			}
			$folders = File::directories($path);
		}

		$folders = Collection::make($folders)->map(function($folder) {
			return str_replace('\\', '/', $folder);
		});

		$files = Collection::make($files)->map(function($file) {
			return str_replace('\\', '/', $file);
		});
		return view('plugins.translation-manager.index', compact('folders', 'files', 'locale', 'directory'));
	}

	/**
	 * @param $locale
	 * @param $file
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($locale) {
		$defaultLocale          = config('app.locale');
		$directory = request()->get('directory');
		$fileChange             = $this->langPath() . "/" . $locale . '/' . $directory;
		$fileDefault            = $this->langPath() . '/' . $defaultLocale . '/' . $directory;
		$allTranslations        = include($fileChange);
		$allDefaultTranslations = include($fileDefault);
		$transitions            = array_dot($allTranslations);
		$defaultTransitions     = array_dot($allDefaultTranslations);

		return view('plugins.translation-manager.edit', compact('transitions', 'defaultTransitions', 'locale', 'defaultLocale', 'directory'));
	}

	public function update(Request $request, $locale) {
		$data_name = $request->name;
		$directory = $request->get('directory');
		list($locale, $key) = explode("|", $data_name);
		$fileChange      = $this->langPath() . "/" . $locale . '/' . $directory;
		$allTranslations = include($fileChange);
		$transitions     = $allTranslations;
		data_set($transitions, $key, $request->value);
		$data_array = "<?php \n return";
		$data_array .= $this->var_export($transitions, true);
		$data_array .= ";";
		File::replace($fileChange, $data_array);

		//		return true;
		//return $transitions;
	}

	protected function var_export($expression, $return = false) {
		$export = var_export($expression, true);
		$export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
		$array  = preg_split("/\r\n|\n|\r/", $export);
		$array  = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [null, ']$1', ' => ['], $array);
		$export = join(PHP_EOL, array_filter(["["] + $array));
		if ((bool) $return) {
			return $export;
		}
		else {
			echo $export;
		}
	}

	/**
	 * @return string
	 */
	public function langPath() {
		return App::langPath();
	}
}
