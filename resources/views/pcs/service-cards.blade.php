@php use App\Support\Enums\IntentEnum;
 use Carbon\Carbon;
 @endphp
@extends('layouts.app')

@section('title', "PC $pc->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray "
                           href="{{ route('pcs.show', $pc->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray active"
                           href="{{ route('pcs.service-cards.index', $pc->id) }}"
                           role="tab">Kartu Servis</a>
                    </li>
                </ul>
            </div>

            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Kartu Service</h3>
                <a href="{{ route('service-cards.create', ['device_type' => \App\Models\PC::class, 'device_name' => $pc->name]) }}"
                   class="btn btn-sm btn-default text-blue ml-2">
                    <i class="fas fa-plus"></i>
                    Tambah Uraian Pekerjaan
                </a>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">{{$pc->name}}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <div class="col">
                                    <div class="row">
                                        <dt class="col-sm-3">Prosesor</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->processor}}</dd>
                                        <dt class="col-sm-3">RAM</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->ram}}</dd>
                                        <dt class="col-sm-3">Penyimpanan</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->hdd}}</dd>
                                        <dt class="col-sm-3">Monitor</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->monitor}}</dd>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <dt class="col-sm-3">VGA</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->vga}}</dd>
                                        <dt class="col-sm-3">Bagian</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->section}}</dd>
                                        <dt class="col-sm-3">Pemakai</dt>
                                        <dt class="col-sm-3 text-right">:</dt>
                                        <dd class="col-sm-6">{{$pc->user_name}}</dd>
                                    </div>
                                </div>
                            </dl>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Uraian</th>
                                    <th>Pekerja</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($serviceCards as $serviceCard)
                                    <tr>
                                        <td>{{ Carbon::parse($serviceCard->date)->format('Y-m-d') }}</td>
                                        <td>{{ $serviceCard->description }}</td>
                                        <td>{{ $serviceCard->worker->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('service-cards.edit', ['service_card' => $serviceCard->id, 'device_type' => \App\Models\PC::class, 'device_name' => $pc->name]) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('service-cards.destroy', $serviceCard->id) }}"
                                                      method="post"
                                                      class="ml-2 d-inline"
                                                      onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card-footer">
            <a href="{{ route('pcs.index') }}" class="btn btn-default">
                <i class="fa fa-fw fa-arrow-left"></i>
                        Kembali
            </a>
        </div>

        </div>
    </div>

@endsection




@section('scripts')
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            const loggedInUser = {--}}
    {{--                id: '{{ $pc->user_id }}',--}}
    {{--                text: '{{ $pc->user->name }}',--}}
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
    {{--                            results: data.data.map(function(user) {--}}
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
