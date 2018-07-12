<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="post_time"> {{__('admin/news.publish date')}}</label>
    <div class='input-group date' id='datetimepicker1'>
        <div class="col-md-12" style="padding-right: 0">
            {!! Form::text('post_time', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'default' => '', 'id' => 'post_time']) !!}
        </div>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
</div>