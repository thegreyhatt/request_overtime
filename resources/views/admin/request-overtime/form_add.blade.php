<div class="row">
    <div class="col-md-2">
        <div class="form-group clockpicker {{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Request Date', ['class' => 'control-label']) !!}
            {!! Form::date('date', Carbon\Carbon::now(), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('OT Type') ? 'has-error' : ''}}">
            {!! Form::label('location', 'OT Type', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','placeholder' => 'OT Type']) !!}
            {!! $errors->first('OT Type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group clockpicker {{ $errors->has('time_from') ? 'has-error' : ''}}">
            {!! Form::label('time_from', 'Time From', ['class' => 'control-label']) !!}
            {!! Form::time('time_from', Carbon\Carbon::now(), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('time_from', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group clockpicker {{ $errors->has('time_to') ? 'has-error' : ''}}">
            {!! Form::label('time_to', 'Time To', ['class' => 'control-label']) !!}
            {!! Form::time('time_to', Carbon\Carbon::now() ,('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('time_to', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
            {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','placeholder' => 'Location']) !!}
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('work_done') ? 'has-error' : ''}}">
            {!! Form::label('work_done', 'OT Work Done', ['class' => 'control-label']) !!}
            {!! Form::textarea('work_done', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','placeholder' => 'Work done', 'maxlength' => 900, 'size' => '12x10']) !!}
            {!! $errors->first('work_done', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        <a href="{{ URL::previous() }}" class="btn btn-default pull-right">Cancel</a>
    </div>

