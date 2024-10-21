@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('title', "Printer $printer->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray active"
                           href="{{ route('printers.show', $printer->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray "
                           href="{{ route('printers.service-cards.index', $printer->id) }}"
                           role="tab">Kartu Servis</a>
                    </li>
                </ul>
            </div>

            <div class="card-header">
                <h3 class="card-title">Detail Printer</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('printers.update', $printer->id) }}" method="post"
                      id="update-form-{{$printer->id}}"
                      onsubmit="confirmUpdate(event, {{$printer->id}})">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline card-outline-tabs">
                                <div class="card-body">
                                    <h6 class="text-divider mb-4"><span>Edit Printer</span></h6>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">User</label>
                                        <div class="col-sm-4">
                                            <select class="form-control form-control-sm select2" name="user_id"
                                                    required>
                                                <option value="{{$printer->user->id}}" selected>{{$printer->user->name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Merek</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="brand" value="{{ $printer->brand }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Date of Initial Use</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control form-control-sm" name="date_of_initial_use" value="{{ $printer->date_of_initial_use }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Index</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="index" value="{{ $printer->index }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Tipe</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="type" value="{{ $printer->type }}" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('printers.index') }}" class="btn btn-default">
                                        <i class="fa fa-fw fa-arrow-left"></i>
                                        Kembali
                                    </a>

                                    <div class="btn-group float-right">
                                        <button class="btn btn-default text-blue">
                                            <i class="fa fa-fw fa-save"></i>
                                            Simpan
                                        </button>

                                        <a class="btn btn-default text-maroon" href="{{ route('printers.index') }}">
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
                <a href="{{ route('printers.index') }}" class="btn btn-default">Back to WorkInstructions</a>
            </div> --}}
        </div>
    </div>

@endsection


@section('scripts')
        <script>
            $(document).ready(function() {
                const initialUser = {
                    id: '{{ $printer->user->id }}',
                    text: '{{ $printer->user->name }}',
                };

                $('.select2').select2({
                    placeholder: '-- Select User --',
                    allowClear: true,
                    ajax: {
                        url: '{{ route('users.index') }}',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                                intent: '{{ \App\Support\Enums\IntentEnum::USER_SELECT2_SEARCH_USERS->value }}'
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(user) {
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
                        callback(initialUser);
                    },
                });

                // Set the initial value and trigger change to select the initial user
                $('.select2').val(initialUser.id).trigger('change');
            });
        </script>
@endsection
