@extends('adminlte::page')
@section('content_header')
    <h1> <i class="fa fa-file" ></i> Request Overtime</h1>
@endsection
@section('content')
<div class="box box-success">
    <div class="box-body">
        {!! Form::open(['url' => '/admin/request-overtime', 'class' => '', 'files' => true]) !!}
            @include ('admin.request-overtime.form_add', ['formMode' => 'create'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
