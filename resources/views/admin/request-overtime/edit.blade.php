@extends('adminlte::page')

@section('content')
<div class="box box-success">
    <div class="box-body">
        {!! Form::model($otrequest, [
            'method' => 'PATCH',
            'url' => route('request-overtime.update', $otrequest->id),
            'class' => '',
            'files' => true
        ]) !!}

        @include ('admin.request-overtime.form_edit', ['formMode' => 'edit'])

        {!! Form::close() !!}

    </div>
</div>
@endsection
