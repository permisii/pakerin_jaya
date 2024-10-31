@php
    use App\Support\Enums\IntentEnum;
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

            <div class="card-body">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info d-flex align-items-center">
                            <h3 class="card-title">{{$pc->index}}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <div class="col">
                                    <div class="row">
                                        <dt class="col-sm-2">Nama Pemakai</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{ $pc->user_name }}</dd>
                                        <dt class="col-sm-2">Bagian</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{ $pc->section }}</dd>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <dt class="col-sm-2">Processor</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->processor}}</dd>
                                        <dt class="col-sm-2">RAM</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->ram}}</dd>
                                        <dt class="col-sm-2">HD</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->hdd}}</dd>
                                        <dt class="col-sm-2">Monitor</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->monitor}}</dd>
                                        <dt class="col-sm-2">VGA</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->vga}}</dd>
                                    </div>
                                </div>
                            </dl>

                            {!! $dataTable->table(['class' => 'table table-bordered']) !!}
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
    {{--    {!! $dataTable->scripts() !!}--}}
    <script>
        $(document).ready(function() {
            const deviceName = '{{ $pc->name }}';
            const deviceType = 'App\\Models\\PC';
            const deviceId = '{{ $pc->id }}';

            $('#pc-service-cards-table').DataTable({
                processing: true,
                serverSide: false, // serverSide is not needed because we are using ajax
                ajax: {
                    url: '{{ route('pcs.service-cards.index', $pc->id) }}',
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
                                + '?device_type=' + deviceType + '&device_name='
                                + deviceName + '&device_id=' + deviceId;
                        },
                    },
                ],
            });

            {{--$('<button id="add-service-card" class="btn btn-default text-blue mb-2"><i class="fas fa-plus"></i> Tambah Uraian Pekerjaan</button>')--}}
            {{--    .insertBefore('#pc-service-cards-table_filter')--}}
            {{--    .on('click', function() {--}}
            {{--        window.location.href = '{{ route('service-cards.create', ['device_type' => \App\Models\PC::class, 'device_name' => $pc->name, 'device_id' => $pc->id]) }}';--}}
            {{--    });--}}
        });
    </script>
@endsection
