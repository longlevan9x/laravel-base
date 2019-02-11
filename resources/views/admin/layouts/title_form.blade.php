<div class="x_title">
    <h2>{!! $title ?? 'Unvariable $title'  !!} <small>{!! $small_title ?? ''  !!}</small></h2>
    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
    <br/>
</div>
@include('admin.layouts.message.success')
@include('admin.layouts.message.error')
@include('admin.layouts.message.errors')
