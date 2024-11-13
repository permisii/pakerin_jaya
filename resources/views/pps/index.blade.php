@extends('layouts.app')

@section('title', 'Master PP')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('pps.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="row">
                                        <div class="col-2">Bulan</div>
                                        <div class="col">
                                            <input type="month" name="date_filter" id="date_filter"
                                                   class="form-control form-control-sm"
                                                   value="{{ request('date_filter') }}"
                                                   min="{{ now()->subMonth()->format('Y-m') }}"
                                                   max="{{ now()->format('Y-m') }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-2">Status</div>
                                        <div class="col">
                                            <select name="status_filter" class="form-control form-control-sm">
                                                <option value="">Pilih Status</option>
                                                @foreach(\App\Support\Enums\PPStatusEnum::cases() as $case)
                                                    <option value="{{ $case->value }}">{{ $case->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="fas fa-fw fa-search"></i>
                                            Filter
                                        </button>
                                        <a href="{{ route('pps.index') }}"
                                           class="btn btn-default btn-sm">
                                            <i class="fas fa-undo"></i>
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{$dataTable->table()}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}
@endsection
