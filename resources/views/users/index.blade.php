@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row my-3">
                    <div class="offset-2 col-sm-6 col-md-8 col-lg-3">
                        <form method="GET" action="{{ route('users.index') }}" class="d-flex flex-column">
                            <div class="form-group d-flex flex-fill m-0">
                                <div class="d-flex flex-fill flex-column justify-content-end">
                                    <div class="row px-2 align-items-center">
                                        <div class="d-flex flex-column justify-content-between text-bold">
                                            <div>Unit</div>
                                        </div>
                                        <div class="d-flex flex-fill flex-column ml-2">
                                            <select name="unit_id" id="unit_id" class="form-control form-control-sm">
                                                <option value="">All</option>
                                                @foreach($units as $unit)
                                                    <option
                                                        value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
