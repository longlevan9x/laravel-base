<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 10:56 PM
 */
?>
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        @include('admin.layouts.title_form', ['title' => 'Sync Student Schedule'])
        <div class="x_content">
            <br />
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ Form::model(isset($model) ? $model : null, [
                'url' => url(\App\Http\Controllers\Admin\SyncController::getAdminRouteName('sync-student-schedule-by-department'), [isset($model) ? $model->id : '']),
                'files' => true,
                'class' => 'form-horizontal form-label-left',
                'id' => 'demo-form2',
                'data-parsley-validate',
            ]) }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"> Department
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('id_department', \App\Models\Course::pluck('name', 'code'), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'id_department']) !!}
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Sync</button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Sync Student Schedule Exam</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ Form::model(isset($model) ? $model : null, [
                'url' => route(\App\Http\Controllers\Admin\SyncController::getAdminRouteName('sync-student-schedule-exam-by-department'), [isset($model) ? $model->id : '']),
                'files' => true,
                'class' => 'form-horizontal form-label-left',
                'id' => 'demo-form2',
                'data-parsley-validate',
            ]) }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"> Department
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('id_department', \App\Models\Course::pluck('name', 'code'), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'id_department']) !!}
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Sync</button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
