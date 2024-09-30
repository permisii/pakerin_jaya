@php
    use App\Support\Enums\AssignmentStatusEnum;
@endphp

@extends('layouts.app')

@section('content')

    <form action="{{ route('work-instructions.assignments.update', [$workInstruction->id, $assignment->id]) }}" method="post" id="update-form-{{ $assignment->id }}"
          onsubmit="confirmUpdate(event, {{ $assignment->id }})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Edit Assignment</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Assignment Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       placeholder="Assignment Number" autocomplete="off" name="assignment_number" value="{{ $assignment->assignment_number }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Problem</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Problem" name="problem">{{ $assignment->problem }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Resolution</label>
                            <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="Resolution" rows="20"
                                      name="resolution">{{ $assignment->resolution }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Description</label>
                            <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="Description" rows="20"
                                      name="description">{{ $assignment->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Material</label>
                            <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="Material" name="material">{{ $assignment->material }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Percentage</label>
                            <div class="col-sm-4">
                                <input type="number" name="percentage" min="0" max="100" class="form-control" value="{{ $assignment->percentage }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="statusCheckbox"
                                           name="status_checkbox" {{$assignment->status === AssignmentStatusEnum::Done->value ? 'checked': ''}}>
                                    <label class="custom-control-label" for="statusCheckbox">Finish</label>
                                </div>
                                <input type="hidden" name="status" id="status" value="DRAFT">
                            </div>
                        </div>
                        <input type="hidden" name="created_by" value="{{auth()->id()}}">
                        <input type="hidden" name="updated_by" value="{{auth()->id()}}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}"
                           class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Back
                        </a>

                        <div class="btn-group float-right">
{{--                            <button class="btn btn-default text-green">--}}
{{--                                <i class="fa fa-fw fa-mail-bulk"></i>--}}
{{--                                Draft--}}
{{--                            </button>--}}

                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Save
                            </button>

                            <a class="btn btn-default text-maroon"
                               href="{{route('work-instructions.assignments.index', $workInstruction->id)}}">
                                <i class="fas fa-ban"></i>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
