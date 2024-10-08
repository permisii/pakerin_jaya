@php use App\Support\Enums\AssignmentStatusEnum; @endphp
@extends('layouts.app')

@section('title', "Assignments $assignment->name")

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Assignment Details</h3>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Assignment Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control form-control-sm" placeholder="MATERIAL"
                                value="{{ $assignment->assignment_number }}" autocomplete="off" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Problem</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PROBLEM" readonly>{{ $assignment->problem }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Resolution</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PROBLEM" readonly>{{ $assignment->resolution }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Material</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PROBLEM" readonly>{{ $assignment->material }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PROBLEM" readonly>{{ $assignment->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right"></label>
                        <div class="col-sm-4">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox"
                                    checked="{{ $assignment->status == AssignmentStatusEnum::Done ? 'checked' : '' }}">
                                <label class="custom-control-label">Selesai</label>
                            </div>
                        </div>
                    </div>

                    {{-- <p><strong>Status:</strong>
                            @if ($assignment->status === AssignmentStatusEnum::Draft)
                                <span class="badge badge-warning">Draft</span>
                            @elseif($assignment->status === AssignmentStatusEnum::Process)
                                <span class="badge badge-success">Process</span>
                            @elseif($assignment->status === AssignmentStatusEnum::Done)
                                <span class="badge badge-info">Done</span>
                            @endif
                        </p> --}}

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Created By</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control form-control-sm"
                                value="{{ $assignment->createdBy->name }}" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('work-instructions.index', $assignment->workInstruction->id) }}"
                        class="btn btn-default">
                        <i class="fa fa-fw fa-arrow-left"></i>
                        Back to Assignments</a>
                </div>

                {{-- <div class="card-footer">
                        <a href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}"
                           class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Back
                        </a>
                            </div> --}}
            </div>
        </div>
    </div>


@endsection
