<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 10:56 PM
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.layouts.title_form', ['title' => 'Form Design', 'small_title' => 'different form elements'])
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => route(\App\Http\Controllers\Admin\ScheduleController::getAdminRouteName('sync-schedule-by-department'), [isset($model) ? $model->id : '']),
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
</div>
