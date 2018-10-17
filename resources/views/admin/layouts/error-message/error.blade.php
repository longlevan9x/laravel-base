<div class="col-md-12">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>@lang('message.error')! </strong> {{ session('error') }}
        </div>
    @endif
</div>