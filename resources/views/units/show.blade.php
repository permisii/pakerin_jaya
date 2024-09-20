@extends('layouts.app')

@section('title', "Units $unit->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Unit Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $unit->name }}</p>
                        <p><strong>Unit Code:</strong> {{ $unit->unit_code }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('units.index') }}" class="btn btn-default">Back to Units</a>
            </div>
        </div>
    </div>

@endsection
