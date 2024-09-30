@php
    use App\Support\Enums\AssignmentStatusEnum;
@endphp

@extends('layouts.app')

@section('content')

    <form action="{{route('work-instructions.assignments.store', $workInstruction->id)}}" method="post"
          id="create-form">
        {{--    <form action="{{route('work-instructions.assignments.store', $workInstruction->id)}}" method="post" id="create-form" onsubmit="confirmCreate(event)">--}}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        @foreach($assignments as $assignment)
                            <h6 class="text-divider mb-4"><span>Pekerjaan {{$loop->iteration}}</span></h6>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">NO PK</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control form-control-sm"
                                           placeholder="NO PK"
                                           value="{{$assignment->assignment_number}}" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">MASALAH</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" rows="3" placeholder="Masalah"
                                              readonly>{{$assignment->problem}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">PENANGANAN</label>
                                <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PENANGANAN" readonly rows="20">
                                {{$assignment->resolution}}
                            </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">MATERIAL</label>
                                <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="MATERIAL" readonly>
                                {{$assignment->material}}
                            </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">PERSENTASE</label>
                                <div class="col-sm-4 d-flex align-items-center">
                                    <div class="progress w-100">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{$assignment->percentage}}%;"
                                             aria-valuenow="{{$assignment->percentage}}" aria-valuemin="0"
                                             aria-valuemax="100">{{$assignment->percentage}}%
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right"></label>
                                <div class="col-sm-4">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox"
                                               checked="{{$assignment->status == AssignmentStatusEnum::Done ? 'checked' : ''}}">
                                        <label class="custom-control-label">Selesai</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">KETERANGAN</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" rows="3" placeholder="KETERANGAN"
                                              readonly>
                                        {{$assignment->description}}
                                    </textarea>
                                </div>
                            </div>

                        @endforeach

                        <h6 class="text-divider mb-4"><span>New Assignment</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Assignment Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm"
                                       placeholder="Assignment Number" autocomplete="off" name="assignment_number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Problem</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Problem" name="problem"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Resolution</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Resolution" rows="20"
                                          name="resolution"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Description</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Description" rows="20"
                                          name="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Material</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="3" placeholder="Material"
                                          name="material"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Percentage</label>
                            <div class="col-sm-4">
                                <input type="number" name="percentage" min="0" max="100" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="statusCheckbox"
                                           name="status_checkbox">
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

@section('scripts')
    <script>
        $(document).ready(function() {
            initializeValidation('#create-form', {
                assignment_number: {
                    required: true,
                    minlength: 3,
                },
                problem: {
                    required: true,
                    minlength: 3,
                },
                resolution: {
                    required: true,
                    minlength: 3,
                },
                description: {
                    required: true,
                    minlength: 3,
                },
                material: {
                    required: true,
                    minlength: 3,
                },
                percentage: {
                    required: true,
                    min: 0,
                    max: 100,
                },
            }, {
                assignment_number: {
                    required: 'Assignment Number must be filled',
                    minlength: 'Assignment Number must be at least 3 characters',
                },
                problem: {
                    required: 'Problem must be filled',
                    minlength: 'Problem must be at least 3 characters',
                },
                resolution: {
                    required: 'Resolution must be filled',
                    minlength: 'Resolution must be at least 3 characters',
                },
                description: {
                    required: 'Description must be filled',
                    minlength: 'Description must be at least 3 characters',
                },
                material: {
                    required: 'Material must be filled',
                    minlength: 'Material must be at least 3 characters',
                },
                percentage: {
                    required: 'Percentage must be filled',
                    min: 'Percentage must be at least 0',
                    max: 'Percentage must be at most 100',
                },
            });
        });
    </script>
@endsection
