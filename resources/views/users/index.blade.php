@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('users.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <label class="col-sm-6 col-md-4 col-lg-2 col-form-label text-right mr-4">Unit</label>
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <select name="unit_id" id="unit_id" class="form-control form-control-sm">
                                        <option value="">All</option>
                                        @foreach($units as $unit)
                                            <option
                                                value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="btn-group btn-block d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="fas fa-fw fa-search"></i>
                                            Filter
                                        </button>
                                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm">
                                            <i class="fas fa-undo"></i>
                                            Reset Filter
                                        </a>
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
