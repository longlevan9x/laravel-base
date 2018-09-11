@if(!empty($exception->getMessage()))
    @include('errors.error')
@else
    Error     {{$exception->getStatusCode()}}
@endif