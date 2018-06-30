<div class="col-md-12">
    @if (session('success'))
        <div class="alert alert-info alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif
</div>