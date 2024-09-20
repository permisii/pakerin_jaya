@php use App\Support\Enums\AssignmentStatusEnum; @endphp
@extends('layouts.app')

@section('title', "Assignments $assignment->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Assignment Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Assignment Number:</strong> {{ $assignment->assignment_number }}</p>
                        <p><strong>Problem:</strong> {{ $assignment->problem }}</p>
                        <p><strong>Resolution:</strong> {{ $assignment->resolution }}</p>
                        <p><strong>Material:</strong> {{ $assignment->material }}</p>
                        <p><strong>Description:</strong> {{ $assignment->description }}</p>
                        <p><strong>Status:</strong>
                            @if($assignment->status === AssignmentStatusEnum::Draft)
                                <span class="badge badge-warning">Draft</span>
                            @elseif($assignment->status === AssignmentStatusEnum::Process)
                                <span class="badge badge-success">Process</span>
                            @elseif($assignment->status === AssignmentStatusEnum::Done)
                                <span class="badge badge-info">Done</span>
                            @endif
                        </p>
                        <p><strong>Created By:</strong> {{ $assignment->createdBy->name }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('work-instructions.assignments.index', $assignment->workInstruction->id) }}"
                   class="btn btn-default">
                    Back to Assignments</a>
            </div>
        </div>
    </div>

@endsection
