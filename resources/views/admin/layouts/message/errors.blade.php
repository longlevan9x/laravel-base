<div class="col-md-12">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>@lang('message.error')! </strong> {{ $error }}
            </div>
        @endforeach
    @endif
</div>