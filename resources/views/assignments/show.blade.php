@php use App\Support\Enums\AssignmentStatusEnum; @endphp
@extends('layouts.app')

@section('title', "Assignments $assignment->name")

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detail Pekerjaan</h3>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Nomor PK</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control form-control-sm" placeholder="NOMOR PK"
                                   value="{{ $assignment->assignment_number }}" autocomplete="off" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Masalah</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="MASALAH"
                                      readonly>{{ $assignment->problem }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Penanganan</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="PENANGANAN"
                                      readonly>{{ $assignment->resolution }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Material</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="MATERIAL"
                                      readonly>{{ $assignment->material }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Deskripsi</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="3" placeholder="DESKRIPSI"
                                      readonly>{{ $assignment->description }}</textarea>
                        </div>
                    </div>

                    {{--                    <div class="form-group row">--}}
                    {{--                        <label class="col-sm-2 col-form-label text-right"></label>--}}
                    {{--                        <div class="col-sm-4">--}}
                    {{--                            <div class="custom-control custom-checkbox">--}}
                    {{--                                <input class="custom-control-input" type="checkbox"--}}
                    {{--                                    checked="{{ $assignment->status == AssignmentStatusEnum::Done ? 'checked' : '' }}">--}}
                    {{--                                <label class="custom-control-label">Selesai</label>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

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
                        <label class="col-sm-2 col-form-label text-right">Persentase</label>
                        <div class="col-sm-4">
                            <input type="number" name="percentage" min="0" max="100" class="form-control"
                                   value="{{ $assignment->percentage }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Dibuat oleh</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control form-control-sm"
                                   value="{{ $assignment->createdBy->name }}" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('work-instructions.assignments.index', $assignment->workInstruction->id) }}"
                       class="btn btn-default">
                        <i class="fa fa-fw fa-arrow-left"></i>
                        Kembali ke Pekerjaan</a>
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
