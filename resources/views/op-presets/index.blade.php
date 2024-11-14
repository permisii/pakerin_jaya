@extends('layouts.app')

@section('title', 'Master OP Preset')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('op-presets.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <label class="col-sm-6 col-md-4 col-lg-2 col-form-label text-right mr-4">Bulan</label>
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="form-group ml-2 d-flex flex-column">
                                        <input type="month" name="date_filter" id="date_filter"
                                               class="form-control form-control-sm"
                                               value="{{ request('date_filter') }}">
                                        <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-default btn-sm">
                                                <i class="fas fa-fw fa-search"></i>
                                                Filter
                                            </button>
                                            <a href="{{ route('op-presets.index') }}"
                                               class="btn btn-default btn-sm">
                                                <i class="fas fa-undo"></i>
                                                Reset
                                            </a>
                                        </div>
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
