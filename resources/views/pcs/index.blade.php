@extends('layouts.app')

@section('title', 'Master PC')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form method="GET" action="{{ route('pcs.index') }}">
                    <div class="form-group d-flex">
                        <label class="col-form-label text-right mr-4">Bulan</label>
                        <div class="d-flex flex-column">
                            <input type="month" name="date_filter" id="date_filter"
                                   class="form-control form-control-sm" value="{{ request('date_filter') }}">
                            <div class="form-group d-flex mt-2">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fas fa-fw fa-search"></i>
                                        Filter
                                    </button>
                                    <a href="{{ route('pcs.index') }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-undo"></i>
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{$dataTable->table()}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}
@endsection
