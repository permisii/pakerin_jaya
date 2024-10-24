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

            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Kartu Service</h3>
                <a href="{{ route('service-cards.create', ['device_type' => \App\Models\Printer::class, 'device_name' => $printer->name, 'device_id' => $printer->id]) }}"
                    class="btn btn-sm btn-default text-blue ml-2">
                    <i class="fas fa-plus"></i>
                    Tambah Uraian Pekerjaan
                </a>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">{{ $printer->name }}</h3>
                        </div>
                        <div class="card-body">
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
            });
        });
    </script>
@endsection
