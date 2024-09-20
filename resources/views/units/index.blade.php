@extends('layouts.app')

@section('title', 'Units')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                {{$dataTable->table()}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}
@endsection
