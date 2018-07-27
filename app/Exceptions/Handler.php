<?php

namespace App\Exceptions;

use App\Commons\CConstant;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

	/**
	 * Render an exception into an HTTP response.
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception               $exception
	 * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function render($request, Exception $exception)
    {
	    if ($request->acceptsJson() && $request->wantsJson()) {
	    	if(strpos($exception->getMessage(), 'No query results for model') !== false) {
			    return responseJson(CConstant::STATUS_NOT_FOUND, null, 404);
		    }
	    }

        return parent::render($request, $exception);
    }

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param AuthenticationException  $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception) {

    	if ($request->segment(1) == CConstant::GUARD_ADMIN) {
		    return redirect('admin/login');
	    }
    	return parent::unauthenticated($request, $exception);
    }

	/**
	 * Render the given HttpException.
	 *
	 * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function renderHttpException(HttpException $e) {

	    $this->registerErrorViewPaths();
		if (request()->segment(1) == 'admin') {
			if (view()->exists($view = "admin.errors.{$e->getStatusCode()}")) {
				return response()->view($view, [
					'errors' => new ViewErrorBag,
					'exception' => $e,
				], $e->getStatusCode(), $e->getHeaders());
			}

			return $this->convertExceptionToResponse($e);
		}
		return parent::renderHttpException($e);
    }
}
