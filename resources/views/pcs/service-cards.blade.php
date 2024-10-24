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
                <a href="{{ route('service-cards.create', ['device_type' => \App\Models\PC::class, 'device_name' => $pc->name, 'device_id' => $pc->id]) }}"
                   class="btn btn-default text-blue ml-2 mb-3">
                    <i class="fas fa-plus"></i>
                    Tambah Uraian Pekerjaan
                </a>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info d-flex align-items-center">
                            <h3 class="card-title">{{$pc->name}}</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
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
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <dt class="col-sm-2">VGA</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->vga}}</dd>
                                        <dt class="col-sm-2">Bagian</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->section}}</dd>
                                        <dt class="col-sm-2">User</dt>
                                        <dt class="col-sm-2 text-right">:</dt>
                                        <dd class="col-sm-8">{{$pc->user_name}}</dd>
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
    <script>
        $(document).ready(function() {
            $('#pc-service-cards-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('pcs.service-cards.index', $pc->id) }}',
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
                paging:false
            });
        });
    </script>
@endsection
