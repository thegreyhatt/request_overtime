<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('hours_request') ? 'has-error' : ''}}">
            {!! Form::label('hours_request', 'Hours Request', ['class' => 'control-label']) !!}
            {!! Form::number('hours_request', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required','readonly' => 'true'] : ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('hours_approve') ? 'has-error' : ''}}">
            {!! Form::label('hours_approve', 'Hours Request', ['class' => 'control-label']) !!}
            {!! Form::number('hours_approve', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('hours_approve', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

    
<div class="form-group">
    {!! Form::submit($formMode === 'ot_approve' ? 'Approve' : 'Update', ['class' => 'btn btn-primary']) !!}
    <a href="{{ URL::previous() }}" class="btn btn-default pull-right">Cancel</a>
</div>