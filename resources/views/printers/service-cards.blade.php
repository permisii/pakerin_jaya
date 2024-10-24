@php
    use App\Support\Enums\IntentEnum;
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
                        <a class="nav-link text-gray " href="{{ route('printers.show', $printer->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray active"
                           href="{{ route('printers.service-cards.index', $printer->id) }}" role="tab">Kartu Servis</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <a href="{{ route('service-cards.create', ['device_type' => \App\Models\Printer::class, 'device_name' => $printer->name, 'device_id' => $printer->id]) }}"
                   class="btn btn-default text-blue ml-2 mb-3">
                    <i class="fas fa-plus"></i>
                    Tambah Uraian Pekerjaan
                </a>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info d-flex align-items-center">
                            <h3 class="card-title">{{ $printer->brand }}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-1">User</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->user_name }}</dd>
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
                            {!! $dataTable->table(['class' => 'table table-bordered']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('printers.index') }}" class="btn btn-default">
                    <i class="fa fa-fw fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#printer-service-cards-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('printers.service-cards.index', $printer->id) }}',
                    type: 'GET',
                    error: function(xhr, error, code) {
                        console.log(xhr);
                        console.log(code);
                    },
                },
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'date', name: 'date' },
                    { data: 'description', name: 'description' },
                    { data: 'workers', name: 'workers', orderable: false, searchable: false },
                ],
                paging: false,
            });
        });
    </script>
@endsection
