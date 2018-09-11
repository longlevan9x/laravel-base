@extends('admin.index')
@section('content')
    @php /** @var \Symfony\Component\HttpKernel\Exception\HttpException $exception */ @endphp

    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">{{$exception->getStatusCode()}}</h1>
                <h2>Sorry, the page you are looking for could not be found</h2>
                <h3>{{$exception->getMessage()}}</h3>
                <div class="mid_center">
                    {{--<h3>Search</h3>--}}
                    {{--<form>--}}
                    {{--<div class="col-xs-12 form-group pull-right top_search">--}}
                    {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                    {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-default" type="button">Go!</button>--}}
                    {{--</span>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
@endsection