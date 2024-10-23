@php use App\Support\Enums\IntentEnum;
 use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('title', "Printer $printer->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray "
                           href="{{ route('printers.show', $printer->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray active"
                           href="{{ route('printers.service-cards.index', $printer->id) }}"
                           role="tab">Kartu Servis</a>
                    </li>
                </ul>
            </div>

            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Kartu Service</h3>
                <a href="{{ route('service-cards.create', ['device_type' => \App\Models\Printer::class, 'device_name' => $printer->name]) }}"
                   class="btn btn-sm btn-default text-blue ml-2">
                    <i class="fas fa-plus"></i>
                    Tambah Uraian Pekerjaan
                </a>
            </div>
            <div class="card-body">

                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">{{$printer->name}}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-1">User</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{$printer->user_name}}</dd>
                                <dt class="col-sm-1">Merk</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->brand }}</dd>
                                <dt class="col-sm-1">Index</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->index }}</dd>
                                <dt class="col-sm-1">Tipe</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->type }}</dd>
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
                                            <a href="{{ route('service-cards.edit', $serviceCard->id) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('service-cards.destroy', $serviceCard->id) }}"
                                                  method="post"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card-footer">
                <a href="{{ route('printers.index') }}" class="btn btn-default">Back to WorkInstructions</a>
            </div> --}}
        </div>
    </div>

@endsection


@section('scripts')
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            const loggedInUser = {--}}
    {{--                id: '{{ $printer->user_id }}',--}}
    {{--                text: '{{ $printer->user->name }}',--}}
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
