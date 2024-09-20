@extends('layouts.app')

@section('title', "Work Instructions $workInstruction->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray active"
                           href="{{ route('work-instructions.show', $workInstruction->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray "
                           href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}"
                           role="tab">Pekerjaan</a>
                    </li>
                </ul>
            </div>

            <div class="card-header">
                <h3 class="card-title">WorkInstruction Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $workInstruction->user->name }}</p>
                        <p><strong>WorkInstruction Code:</strong> {{ $workInstruction->work_date }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('work-instructions.index') }}" class="btn btn-default">Back to WorkInstructions</a>
            </div>
        </div>
    </div>

@endsection
