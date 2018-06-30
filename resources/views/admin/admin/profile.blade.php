@extends('admin.index')
@section('content')
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__('User Profile')}}
                            <small>Activity report</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{\App\Commons\Facade\CUser::user()->getImagePath()}}" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{\App\Commons\Facade\CUser::userAdmin()->name}}</h3>

                            <ul class="list-unstyled user_data">
                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                                </li>
                                <li>
                                    <i class="fa fa-phone user-profile-icon"></i> {{\App\Commons\Facade\CUser::userAdmin()->phone}}
                                </li>
                                <li>
                                    <i class="fa fa-envelope user-profile-icon"></i> {{\App\Commons\Facade\CUser::userAdmin()->email}}
                                </li>
                                <li title="Last Login">
                                    <i class="fa fa-mail-forward user-profile-icon"></i> {{\App\Commons\Facade\CUser::userAdmin()->last_login}}
                                </li>
                                <li title="Last Logout">
                                    <i class="fa fa-mail-reply user-profile-icon"></i> {{\App\Commons\Facade\CUser::userAdmin()->last_logout}}
                                </li>
                                <li>
                                    <i class="fa fa-map-marker user-profile-icon"></i> {{\App\Commons\Facade\CUser::userAdmin()->address}}
                                </li>
                            </ul>

                            <br />

                            <!-- start skills -->
                            <h4>Skills</h4>
                            <ul class="list-unstyled user_data">
                                <li>
                                    <p>Web Applications</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Website Design</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Automation & Testing</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>UI / UX</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                            </ul>
                            <!-- end of skills -->

                        </div>
                        <div class="col-md-9 col-xs-12">
                            @include('admin.layouts.widget.alert-success')
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">

                            {{--<div class="profile_title">--}}
                            {{--<div class="col-md-6">--}}
                            {{--<h2>{{__('Update Profile')}}</h2>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                            {{--<div id="" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">--}}
                            {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
                            {{--<span>{{\Illuminate\Support\Carbon::Now()}}</span> <b class="caret"></b>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{__("Profile")}}</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">{{__("Change Password")}}</a>
                                    </li>
                                </ul>

                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                        <div class="box-block bg-white">
                                            <br>
                                            @include('admin.layouts.widget.alert-error')
                                            <br>
                                            {{ Form::open(array(
                                                'url' => url_admin('profile', [Auth::id()]),
                                                'files' => true,
                                                'class' => 'form-horizontal form-label-left',
                                                'id' => 'demo-form2',
                                                'data-parsley-validate',
                                                'method' => 'post',
                                                'role'=>"form"
                                            )) }}
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-xs-2 col-form-label">{{__('Name')}}</label>
                                                <div class="col-xs-10">
                                                    {!! Form::text('name', $value = \App\Commons\Facade\CUser::userAdmin()->name,['required' => "required", 'placeholder'=>"Name", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-xs-2 col-form-label">{{__('Email')}}</label>
                                                <div class="col-xs-10">
                                                    {!! Form::email('email', $value = \App\Commons\Facade\CUser::userAdmin()->email,['required' => "required", 'placeholder'=>"Email", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gender" class="col-xs-2 col-form-label">{{__('Gender')}}</label>
                                                <div class="col-xs-10 btn-group" id="gender" data-toggle="buttons">
                                                    <label class="btn btn-default {{\App\Commons\Facade\CUser::userAdmin()->gender == 1 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        {{ Form::radio('gender', $value = 1, \App\Commons\Facade\CUser::userAdmin()->gender == 1 ? ['checked'] : '') }} {{__('Male')}}
                                                    </label>
                                                    <label class="btn btn-info {{\App\Commons\Facade\CUser::userAdmin()->gender == 2 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-danger">
                                                        {{ Form::radio('gender', $value = 2, \App\Commons\Facade\CUser::userAdmin()->gender == 2 ? ['checked'] : '' ) }} {{__('Female')}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-xs-2 col-form-label">{{__('Phone')}}</label>
                                                <div class="col-xs-10">
                                                    {!! Form::text('phone', $value = \App\Commons\Facade\CUser::userAdmin()->phone,['placeholder'=>"Phone", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'phone']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-xs-2 col-form-label">{{__('Address')}}</label>
                                                <div class="col-xs-10">
                                                    {!! Form::textarea('address', $value = \App\Commons\Facade\CUser::userAdmin()->address, ['rows' => '2', 'placeholder'=>"Address", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'address'])!!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-xs-2 col-form-label">{{__('Overview')}}</label>
                                                <div class="col-xs-10">
                                                    {!! Form::textarea('overview', $value = \App\Commons\Facade\CUser::userAdmin()->overview, ['rows' => '3', 'placeholder'=>"Overview", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'overview'])!!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="picture" class="col-xs-2 col-form-label">{{__('Image')}}</label>
                                                <div class="col-xs-10">
                                                    <input id="profile" type="file" accept="image/*" name="image" value="" class=" dropify form-control-file" aria-describedby="fileHelp">
                                                </div>
                                            </div>
                                            @push('scriptString')
                                                <script>
                                                    $("#profile").fileinput({
                                                        showUpload:           false,
                                                        initialPreviewAsData: true,
                                                        initialPreview:       "{{\App\Commons\Facade\CUser::userAdmin()->getImagePath()}}",
                                                        initialPreviewConfig: [
                                                            {caption: "logo.png"}
                                                        ]
                                                    });
                                                </script>
                                            @endpush
                                            <div class="form-group row">
                                                <label for="zipcode" class="col-xs-2 col-form-label"></label>
                                                <div class="col-xs-10">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                                </div>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                        {{ Form::open(array(
                                                'url' => url_admin('change-password'),
                                                'files' => true,
                                                'class' => 'form-horizontal form-label-left',
                                                'id' => 'demo-form',
                                                'data-parsley-validate',
                                                'method' => 'post',
                                                'role'=>"form"
                                            )) }}

                                        <div class="form-group row">
                                            <label for="password" class="col-xs-2 col-form-label">{{__('Password New')}}</label>
                                            <div class="col-xs-10">
                                                {!! Form::password('password', ['required' => "required", 'placeholder'=>"Password New", 'min'=>"6", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-xs-2 col-form-label">{{__('Password Confirm')}}</label>
                                            <div class="col-xs-10">
                                                {!! Form::password('password_confirmation', ['required' => "required", "data-parsley-equalto"=>"#password", 'min'=>"6", 'data-parsley-equalto-message' => 'This value password confirm should be the same password.', 'placeholder'=>"Password Confirm", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'password_confirmation']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="zipcode" class="col-xs-2 col-form-label"></label>
                                            <div class="col-xs-10">
                                                <button type="submit" class="btn btn-primary">{{__("Change Password")}}</button>
                                            </div>
                                        </div>
                                        {{Form::close()}}

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection