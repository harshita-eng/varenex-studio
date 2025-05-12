@extends('Front.layout.application-layout')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <button type="button" class="btn btn-inverse-success btn-icon"><i class="icon-home"></i></button> {{ ucfirst($table) }} 
        </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{ ucfirst($table) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">list</li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-sm-flex align-items-center mb-4">
                <h4 class="card-title mb-sm-0">{{ str_replace("_"," ", ucfirst($table)) }} List</h4>
                <a href="#" class="text-dark ms-auto mb-3 mb-sm-0"></a>
                <a href="{{ route('addtablefields', [$table,$appname]) }}" type="button" class="btn btn-inverse-success btn-fw"> + {{ ucfirst($table) }}</a>
            </div>
            <div class="table-responsive border rounded p-1">
                <table class="table table-hover">
                    @if(count($columns) > 0)
                        @php
                            $exclude = ['created_at', 'updated_at', 'status'];
                        @endphp
                        <tr>
                            @foreach($columns as $col)
                                @if(!in_array($col->COLUMN_NAME, $exclude))
                                    <th>{{ ucwords(str_replace('_', ' ', $col->COLUMN_NAME)) }}</th>
                                @endif
                            @endforeach
                            <th width="50px">Action</th>
                        </tr>
                    @endif
                    <tbody>
                        @if(count($list) > 0)
                            @php
                                $exclude = ['created_at', 'updated_at', 'status'];
                            @endphp
                            @foreach($list as $row)
                                <tr>
                                    @foreach($columns as $col)
                                        @php $colName = $col->COLUMN_NAME; @endphp
                                        @if(!in_array($colName, $exclude))
                                            <td>{{ $row->$colName }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <a class="btn btn-inverse-success btn-sm" href="{{ route('edittablefields', [$table, $appname, encrypt($row->id) ]) }}"><i class="icon-pencil"></i></a> 
                                        <a class="btn btn-inverse-success btn-sm" href="{{ route('viewtablefields', [$table, $appname, encrypt($row->id) ]) }}"><i class="icon-eye"></i></a> 
                                        <a class="btn btn-inverse-danger btn-sm" href="{{ route('deletetablefields', [$table, $appname, encrypt($row->id) ]) }}" onclick="return confirm('Delete this record?')"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else 
                            <tr><td> No Record Available </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- basic table -->
            <div class="d-flex mt-4 flex-wrap align-items-center">
                <p class="text-muted mb-sm-0"> Showing 1 to 10 of 57 entries </p>
                <nav class="ms-auto">
                <ul class="pagination separated pagination-info mb-sm-0">
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-left"></i></a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right"></i></a></li>
                </ul>
                </nav>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection