<div class="col-md-12">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>@lang('message.success')! </strong> {{ session('success') }}
        </div>
    @endif
</div>