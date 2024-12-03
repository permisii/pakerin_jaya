@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('title', "OP Preset $opPreset->name")

@section('content')
    <div class="col-12">
        <div class="card-body">
            <form action="{{ route('op-presets.update', $opPreset->id) }}" method="post"
                  id="update-form-{{$opPreset->id}}"
                  onsubmit="confirmUpdate(event, {{$opPreset->id}})">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info card-outline card-outline-tabs">
                            <div class="card-body">
                                <h6 class="text-divider mb-4"><span>OP Preset Details</span></h6>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Nama</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="name"
                                               value="{{ $opPreset->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Department</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control form-control-sm"
                                               value="{{ $opPreset->department }}" name="department">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Kode</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control form-control-sm"
                                               value="{{ $opPreset->code }}" name="code">
                                    </div>
                                </div>

                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label class="col-sm-2 col-form-label text-right">Nomor</label>--}}
                                {{--                                    <div class="col-sm-4">--}}
                                {{--                                        <input type="text" class="form-control form-control form-control-sm"--}}
                                {{--                                               value="{{ $opPreset->no }}" name="no">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label class="col-sm-2 col-form-label text-right">Tanggal</label>--}}
                                {{--                                    <div class="col-sm-4">--}}
                                {{--                                        <input type="date" class="form-control form-control form-control-sm"--}}
                                {{--                                               value="{{ $opPreset->date->format('Y-m-d') }}" name="date">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Peminta 1</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control form-control-sm"
                                               value="{{ $opPreset->first_requestor }}" name="first_requestor">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Peminta 2</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control form-control-sm"
                                               value="{{ $opPreset->second_requestor }}" name="second_requestor">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Disetujui Oleh</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control form-control-sm"
                                               value="{{ $opPreset->approved_by }}" name="approved_by">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right">Kepala Bagian</label>
                                    <div class="col-sm-4">
                                        <select class="form-control form-control-sm select2"
                                                name="head_of_section_id"
                                                id="head_of_section_id">
                                            <!-- Options will be populated dynamically -->
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="updated_by" value="{{auth()->user()->id }}">
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('op-presets.index') }}" class="btn btn-default">
                                    <i class="fa fa-fw fa-arrow-left"></i>
                                    Kembali
                                </a>

                                <div class="btn-group float-right">
                                    <button class="btn btn-default text-blue">
                                        <i class="fa fa-fw fa-save"></i>
                                        Simpan
                                    </button>

                                    <a class="btn btn-default text-maroon" href="{{ route('op-presets.index') }}">
                                        <i class="fas fa-ban"></i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const existingHeadOfSection = {
                id: '{{ $opPreset->head_of_section_id ?? '' }}',
                text: '{{ $opPreset->headOfSection->name ?? '' }}',
            };
            $('.select2').select2({
                placeholder: existingHeadOfSection,
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{\App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_HEAD_OF_UNITS->value}}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(user) {
                                console.log(user);
                                return {
                                    id: user.id,
                                    text: `Kepala Bagian ${user.unit?.name} - ${user.name}`,
                                };
                            }),
                        };
                    },
                    cache: true,
                },
            });

        });

        // initializeValidation('#create-form', {
        //     name: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     department: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     code: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     no: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     date: {
        //         required: true,
        //     },
        //     first_requestor: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     second_requestor: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     approved_by: {
        //         required: true,
        //         minlength: 3,
        //     },
        //     head_of_section_id: {
        //         required: true,
        //     },
        // }, {
        //     name: {
        //         required: 'Masukkan Nama',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     department: {
        //         required: 'Masukkan Department',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     code: {
        //         required: 'Masukkan Kode',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     no: {
        //         required: 'Masukkan Nomor',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     date: {
        //         required: 'Masukkan Tanggal',
        //     },
        //     first_requestor: {
        //         required: 'Masukkan Peminta 1',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     second_requestor: {
        //         required: 'Masukkan Peminta 2',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     approved_by: {
        //         required: 'Masukkan Disetujui Oleh',
        //         minlength: 'minimal 3 karakter',
        //     },
        //     head_of_section_id: {
        //         required: 'Pilih Kepala Bagian',
        //     },
        // });
    </script>
@endsection
