@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form method="GET" action="{{ route('users.index') }}">
                    <div class="form-group d-flex">
                        <label class="col-form-label text-right mr-4">Unit</label>
                        <div class="d-flex flex-column">
                            <select name="unit_id" id="unit_id" class="form-control form-control-sm">
                                <option value="">All</option>
                                @foreach($units as $unit)
                                    <option
                                        value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group d-flex mt-2">
                                <div class="btn-group">
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
