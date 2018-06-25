<div class="col-md-1 col-sm-1 col-xs-2">
    <div class="row">
        {{ Form::model(isset($model) ? $model : null, [
            'url' => route(\App\Http\Controllers\Admin\SemesterController::getAdminRouteName('sync-semester'), [isset($model) ? $model->id : '']),
            'files' => true,
            'class' => 'form-horizontal form-label-left',
            'id' => 'demo-form',
            'novalidate',
        ]) }}
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-block btn-lg btn-success">Sync</button>
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>
