@extends('layouts.app')

@section('title', 'Master PC')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="offset-2 col-4">
                        <form method="GET" action="{{ route('pcs.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <label class="col-form-label text-right mr-4">Bulan</label>
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="form-group ml-2d-flex flex-column">
                                        <input type="month" name="date_filter" id="date_filter"
                                               class="form-control form-control-sm" value="{{ request('date_filter') }}" style="padding: 2px 4px;">
                                        <div class="btn-group d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-default btn-sm d-flex align-items-center flex-grow-0">
                                                <i class="fas fa-fw fa-search"></i>
                                                <p class="m-0 ml-1 p-0">Filter</p>
                                            </button>
                                            <a href="{{ route('pcs.index') }}"
                                               class="btn btn-default btn-sm d-flex align-items-center flex-grow-0">
                                                <i class="fas fa-undo"></i>
                                                <p class="m-0 ml-1 p-0">Reset</p>
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
