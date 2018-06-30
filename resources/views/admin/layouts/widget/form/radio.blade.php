<div class="form-group row">
    <label for="gender" class="col-xs-2 col-form-label">{{__('Gender')}}</label>
    <div class="col-xs-10 btn-group" id="gender" data-toggle="buttons">
        <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
            {{ Form::radio('gender', $value = 1, ['checked']) }} {{__('Male')}}
        </label>
        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
            {{ Form::radio('gender', $value = 2, []) }} {{__('Female')}}
        </label>
    </div>
</div>