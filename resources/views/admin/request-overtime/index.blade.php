@extends('adminlte::page')
@section('content_header')
    <h1> <i class="fa fa-file" ></i> Request OT</h1>
    <i class="text-muted">All Request OT</i class="text-muted" >
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-history" role="tabpanel">
                            <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <a href="{{ route('request-overtime.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i> New</a>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="dataTables_wrapper dt-bootstrap4">
                                            <div class="table-responsive col-md-12">
                                                <table table id="example2" class="table table-bordered table-hover"">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Full Name</th>
                                                            <th>Date</th>
                                                            <th>Time From</th>
                                                            <th>Time To</th>
                                                            <th>Work Done</th>
                                                            <th>Location</th>
                                                            <th>Request Hours</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($otrequest as $item)
                                                        <tr class="table-tr">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->full_name }}</a></td>
                                                            <td>{{ $item->date }}</td>
                                                            <td>{{ $item->time_from }}</td>
                                                            <td>{{ $item->time_to }}</td>
                                                            <td>{{ $item->work_done  }}</td>
                                                            <td>{{ $item->location  }}</td>
                                                            <td>{{ number_format( $item->hours_request ) }}</td>
                                                            @if ($item->status == 'S')
                                                                <td>Submitted</td> 
                                                            @elseif ($item->status == 'R')
                                                                <td>Reviewed</td>
                                                            @elseif ($item->status == 'A')
                                                                <td>Approved</td>
                                                            @else
                                                                <td>Cancelled</td>
                                                            @endif
                                                            
                                                            @if($item->status != 'A')
                                                                <td class="text-center" >
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" data-toggle-position="right" aria-expanded="true">
                                                                            <i class="fa fa-ellipsis-h"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                                                @if(auth()->user()->role == "User")
                                                                                    <li>
                                                                                        <a href="{{ route('request-overtime.edit', $item->id) }}">Edit</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure do you want to DELETE this record?')){document.getElementById('{{ $item->id }}').submit()};">
                                                                                        {!! Form::open([
                                                                                            'method'=>'DELETE',
                                                                                            'url' => route('request-overtime.destroy', $item->id),
                                                                                            'style' => 'display:inline',
                                                                                            'id' => $item->id
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                            Delete
                                                                                        </a>
                                                                                    </li>
                                                                                @else
                                                                                    <li>
                                                                                        <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure do you want to Review this record?')){document.getElementById('{{ $item->id }}').submit()};">
                                                                                        {!! Form::open([
                                                                                            'method'=>'REVIEW',
                                                                                            'url' => route('request-overtime.destroy', $item->id),
                                                                                            'style' => 'display:inline',
                                                                                            'id' => $item->id
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                            Review
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="{{ route('request-overtime.edit', $item->id) }}">Approve</a>
                                                                                    </li>
                                                                                @endif
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.datatable -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card-primary -->
                        </div>
                        <!-- /tab-1 -->
                        <div class="tab-pane fade" id="custom-tabs-one-details" role="tabpanel">
                            
                        </div>
                        <!-- /tab-2 -->
                    </div>
        </div>
            <!-- /.card-tabs -->
    </div>
        <!-- /.col -->
</div>
    <!--- NEW TRANSACTION ---->
@endsection

@push('scripts')
<script>
    $(function() {
        $( "#example2" ).on( "doubleclc", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
            var url = $(this).attr('data-url');
            $(".remove-record").attr("action", url);
        })        
        
        $( "#deletemodelclose" ).on( "doubleclc", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
        })
    })
</script>
@endpush

