@php
    use App\Support\Enums\AssignmentStatusEnum;
@endphp

@extends('layouts.app')

@section('content')
    <form action="{{ route('work-instructions.assignments.update', [$workInstruction->id, $assignment->id]) }}"
          method="post"
          id="update-form-{{ $assignment->id }}" onsubmit="confirmUpdate(event, {{ $assignment->id }})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Edit Pekerjaan</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nomor PK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       placeholder="Assignment Number" autocomplete="off" name="assignment_number"
                                       value="{{ $assignment->assignment_number }}"
                                       @if(!auth()->user()->is_admin) readonly @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Masalah</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Problem" name="problem"
                                          @if(!auth()->user()->is_admin) readonly @endif>{{ $assignment->problem }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Penanganan</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Resolution" rows="20"
                                          name="resolution"
                                          @if(auth()->user()->is_admin) readonly @endif>{{ $assignment->resolution }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Deskripsi</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Description" rows="20"
                                          name="description"
                                          @if(auth()->user()->is_admin) readonly @endif>{{ $assignment->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Material</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Material"
                                          name="material" @if(auth()->user()->is_admin) readonly @endif>{{ $assignment->material }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Persentase</label>
                            <div class="col-sm-4">
                                <input type="number" name="percentage" min="0" max="100" class="form-control"
                                       value="{{ $assignment->percentage }}" @if(auth()->user()->is_admin) readonly @endif>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="statusCheckbox"
                                           name="status_checkbox" {{$assignment->status === AssignmentStatusEnum::Done->value ? 'checked': ''}}>
                                    <label class="custom-control-label" for="statusCheckbox">Finish</label>
                                </div>
                                <input type="hidden" name="status" id="status" value="DRAFT">
                            </div>
                        </div> --}}
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <input type="hidden" name="updated_by" value="{{ auth()->id() }}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}"
                           class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Back
                        </a>

                        <div class="btn-group float-right">
                            {{--                            <button class="btn btn-default text-green"> --}}
                            {{--                                <i class="fa fa-fw fa-mail-bulk"></i> --}}
                            {{--                                Draft --}}
                            {{--                            </button> --}}

                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Save
                            </button>

                            <a class="btn btn-default text-maroon"
                               href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}">
                                <i class="fas fa-ban"></i>
                                Batalkan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            initializeValidation('#update-form-{{ $assignment->id }}', {
                assignment_number: {
                    minlength: 3,
                },
                problem: {
                    minlength: 3,
                },
                resolution: {
                    minlength: 3,
                },
                description: {
                    minlength: 3,
                },
                material: {
                    minlength: 3,
                },
                percentage: {
                    min: 0,
                    max: 100,
                },
            }, {
                assignment_number: {
                    minlength: 'Assignment Number must be at least 3 characters',
                },
                problem: {
                    minlength: 'Problem must be at least 3 characters',
                },
                resolution: {
                    minlength: 'Resolution must be at least 3 characters',
                },
                description: {
                    minlength: 'Description must be at least 3 characters',
                },
                material: {
                    minlength: 'Material must be at least 3 characters',
                },
                percentage: {
                    min: 'Percentage must be at least 0',
                    max: 'Percentage must be at most 100',
                },
            });
        });
    </script>
@endsection
