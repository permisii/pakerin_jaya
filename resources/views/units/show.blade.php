@extends('layouts.app')

@section('title', "Units $unit->name")

@section('content')
    <form action="{{ route('units.update', $unit->id) }}" method="post" id="update-form-{{$unit->id}}"
          onsubmit="confirmUpdate(event, {{$unit->id}})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Data</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name"
                                       value="{{ $unit->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kode</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="unit_code"
                                       value="{{ $unit->unit_code }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kepala Bagian</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm select2" name="head_of_unit_id">
                                    <option value="">-- Pilih Kepala Bagian --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('units.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Ubah
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('units.index')}}">
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
            initializeValidation("update-form-{{$unit->id}}", {
                name: {
                    required: true,
                    minlength: 3,
                },
                unit_code: {
                    required: true,
                    minlength: 3,
                },
            }, {
                name: {
                    required: 'Masukkan Nama',
                    minlength: 'minimal 3 karakter',
                },
                unit_code: {
                    required: 'Masukkan Kode Unit',
                    minlength: 'minimal 3 karakter ',
                },
            });

            const existingHeadOfUnit = {
                id: '{{ $unit->head_of_unit_id }}',
                text: '{{ $unit->headOfUnit->name ?? '' }}',
            };

            $('.select2').select2({
                placeholder: {
                    id: existingHeadOfUnit.id, // the value of the option
                    text: existingHeadOfUnit.text, // the text of the option
                },
                allowClear: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}',
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(user) {
                                return {
                                    id: user.id,
                                    text: `${user.nip} - ${user.name}`,
                                };
                            }),
                        };
                    },
                    cache: true,
                },
                initSelection: function(element, callback) {
                    callback(existingHeadOfUnit);
                },
            });

            $('.select2').val(existingHeadOfUnit.text).trigger('change');

        });
    </script>
@endsection
