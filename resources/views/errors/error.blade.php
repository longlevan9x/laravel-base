@extends('website.index')
@section('error')
    <!--Error 404 SECTION-->
    <section id="error" class="padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="error wow bounceIn" data-wow-delay="300ms">
                        <h1>{{$exception->getStatusCode()}}</h1>
                    </div>
                    <p class="heading_space">@lang('website.chúng tôi rất tiếc, trang bạn muốn không còn ở đây nữa. có thể là một trong những liên kết dưới đây có thể giúp bạn!')</p>
                    <a href="{{url('/')}}" class="btn_common blue border_radius wow fadeIn" data-wow-delay="100ms">@lang('website.home page')</a>
                    {{--<a href="index.html" class="btn_common yellow border_radius wow fadeIn" data-wow-delay="400ms">Get a quote</a>--}}
                </div>
            </div>
        </div>
    </section>
@endsection