@extends('layouts.app')

@section('title', 'Ops')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row my-3">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('monthly-report.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="row px-2 align-items-center">
                                        <div class="d-flex flex-column justify-content-between text-bold">
                                            <div>Bulan</div>
                                        </div>
                                        <div class="d-flex flex-fill flex-column ml-2">
                                            <input type="month" name="date_filter" id="date_filter"
                                                   class="form-control form-control-sm"
                                                   value="{{ request('date_filter') }}">
                                        </div>
                                    </div>
                                    <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                        <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-default btn-sm">
                                                <i class="fas fa-fw fa-search"></i>
                                                Filter
                                            </button>
                                            <a href="{{ route('monthly-report.index') }}"
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

                {{$dataTable->table(['class' => 'table table-bordered'])}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}
@endsection
