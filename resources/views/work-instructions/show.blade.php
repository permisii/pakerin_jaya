@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('title', "Instruksi Kerja $workInstruction->name")

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
                    <h3 class="card-title">Detail Instruksi Kerja</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-instructions.update', $workInstruction->id) }}" method="post"
                          id="update-form-{{$workInstruction->id}}"
                          onsubmit="confirmUpdate(event, {{$workInstruction->id}})">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-info card-outline card-outline-tabs">
                                    <div class="card-body">
                                        <h6 class="text-divider mb-4"><span>Edit Instruksi Kerja</span></h6>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Pekerja</label>
                                            <div class="col-sm-4">
                                                <select class="form-control form-control-sm select2" name="user_id" disabled>
                                                    <option value="{{$workInstruction->user->id}}" selected>{{$workInstruction->user->name}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Tanggal</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control form-control-sm" name="work_date"
                                                       value="{{ $workInstruction->work_date }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{ route('work-instructions.index') }}" class="btn btn-default">
                                            <i class="fa fa-fw fa-arrow-left"></i>
                                            Kembali
                                        </a>

                                        <div class="btn-group float-right">
                                            <button class="btn btn-default text-blue">
                                                <i class="fa fa-fw fa-save"></i>
                                                Simpan
                                            </button>

                                            <a class="btn btn-default text-maroon" href="{{ route('work-instructions.index') }}">
                                                <i class="fas fa-ban"></i>
                                                Batalkan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="card-footer">
                    <a href="{{ route('work-instructions.index') }}" class="btn btn-default">Back to WorkInstructions</a>
                </div> --}}
            </div>
        </div>

    @endsection


@section('scripts')
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            const loggedInUser = {--}}
{{--                id: '{{ $workInstruction->user_id }}',--}}
{{--                text: '{{ $workInstruction->user->name }}',--}}
{{--            };--}}

{{--            $('.select2').select2({--}}
{{--                placeholder: '-- Pilih Worker --',--}}
{{--                allowClear: true,--}}
{{--                ajax: {--}}
{{--                    url: '{{ route('users.index') }}',--}}
{{--                    dataType: 'json',--}}
{{--                    delay: 250,--}}
{{--                    data: function(params) {--}}
{{--                        return {--}}
{{--                            q: params.term, // search term--}}
{{--                            intent: '{{ IntentEnum::USER_SEARCH_USERS->value }}', // intent parameter--}}
{{--                        };--}}
{{--                    },--}}
{{--                    processResults: function(data) {--}}
{{--                        return {--}}
{{--                            results: data.map(function(user) {--}}
{{--                                return {--}}
{{--                                    id: user.id,--}}
{{--                                    text: `${user.nip} - ${user.name}`,--}}
{{--                                };--}}
{{--                            }),--}}
{{--                        };--}}
{{--                    },--}}
{{--                    cache: true,--}}
{{--                },--}}
{{--                initSelection: function(element, callback) {--}}
{{--                    callback(loggedInUser);--}}
{{--                },--}}
{{--            });--}}

{{--            // Set the value and trigger change to select the logged-in user--}}
{{--            $('.select2').val(loggedInUser.id).trigger('change');--}}
{{--        });--}}
{{--    </script>--}}
@endsection
