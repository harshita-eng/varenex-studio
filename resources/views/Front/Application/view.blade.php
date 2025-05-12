@extends('Front.layout.application-layout')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <button type="button" class="btn btn-inverse-success btn-icon"><i class="icon-home"></i></button> {{ str_replace("_"," ", ucwords($table)) }} 
        </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tablelisting', [$table,$appname]) }}">{{ ucwords($table) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">add</li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title">Add {{ str_replace("_", " ", ucwords($table)) }}</h4>
                        <a href="#" class="text-dark ms-auto mb-3 mb-sm-0"></a>
                        <a href="{{ route('addtablefields', [$table,$appname]) }}" type="button" class="btn btn-inverse-success btn-fw"> + {{ str_replace("_", " ", ucfirst($table)) }} Field</a>
                    </div>
                    
                    <form class="forms-sample" action="{{ route('saveform', [$table ,$appname]) }}" method="POST">
                        @csrf
                        <div class="row">
                            @foreach($columns as $column)
                                <div class="form-group col-md-6">
                                    <label for="{{ $column->COLUMN_NAME }}">{{ ucfirst(str_replace('_', ' ', $column->COLUMN_NAME)) }}</label>
                                    @php
                                        $inputType = 'text'; 
                                    @endphp
                                    @switch($column->DATA_TYPE)
                                        @case('int')
                                        @case('bigint')
                                            @php $inputType = 'number'; @endphp
                                            <input type="number" name="value[{{ $column->COLUMN_NAME }}]" id="{{ $column->COLUMN_NAME }}" class="form-control" required>
                                            @break

                                        @case('varchar')
                                        @case('text')
                                            <input type="text" name="value[{{ $column->COLUMN_NAME }}]" id="{{ $column->COLUMN_NAME }}" class="form-control" required>
                                            @break

                                        @case('date')
                                            <input type="date" name="value[{{ $column->COLUMN_NAME }}]" id="{{ $column->COLUMN_NAME }}" class="form-control" required>
                                            @break

                                        @case('datetime')
                                            <input type="datetime-local" name="value[{{ $column->COLUMN_NAME }}]" id="{{ $column->COLUMN_NAME }}" class="form-control" required>
                                            @break

                                        @default
                                            <input type="text" name="value[{{ $column->COLUMN_NAME }}]" id="{{ $column->COLUMN_NAME }}" class="form-control" required>
                                    @endswitch
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-inverse-success me-2">Submit</button>
                        <a href="" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection