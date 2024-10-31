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
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info d-flex align-items-center">
                            <h3 class="card-title">{{ $printer->index }}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-1">Nama Pemakai</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->user_name }}</dd>
                                <dt class="col-sm-1">Bagian</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->section }}</dd>
                                <dt class="col-sm-1">Merk</dt>
                                <dt class="col-sm-1 text-right">:</dt>
                                <dd class="col-sm-10">{{ $printer->brand }}</dd>
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
    {{--    {!! $dataTable->scripts() !!}--}}
    <script>
        $(document).ready(function() {
            const deviceBrand = '{{ $printer->brand }}';
            const deviceType = 'App\\Models\\Printer';
            const deviceId = '{{ $printer->id }}';

            $('#printer-service-cards-table').DataTable({
                processing: true,
                serverSide: false, // serverSide is not needed because we are using ajax
                ajax: {
                    url: '{{ route('printers.service-cards.index', $printer->id) }}',
                    type: 'GET',
                    error: function(xhr, error, code) {
                        console.log(xhr);
                        console.log(code);
                    },
                },
                dom: '<"d-flex justify-content-between"<"d-block mb-2"B><"ml-auto"f>>rtip',
                columns: [
                    { data: 'action', name: 'action', searchable: false },
                    { data: 'assignment_number', name: 'assignment_number', searchable: true },
                    { data: 'date', name: 'date', searchable: true },
                    { data: 'description', name: 'description', searchable: true },
                    { data: 'workers', name: 'workers', searchable: true },
                ],
                lengthChange: false,
                buttons: [
                    {
                        text: '<i class="fas fa-plus"></i> Tambah Uraian Pekerjaan',
                        className: 'btn btn-default text-blue',
                        action: function(e, dt, node, config) {
                            window.location.href = "{{ route('service-cards.create') }}"
                                + '?device_type=' + deviceType + '&device_brand='
                                + deviceBrand + '&device_id=' + deviceId;
                        },
                    },
                ],
            });
        });
    </script>
@endsection
