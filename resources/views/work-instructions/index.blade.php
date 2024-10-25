@php use App\Support\Enums\WorkInstructionStatusEnum; @endphp
@extends('layouts.app')

@section('title', 'Instruksi Kerja')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form method="GET" action="{{ route('work-instructions.index') }}">
                    <div class="form-group d-flex justify-content-center">
                        <label class="col-form-label text-right mr-4">Month</label>
                        <div class="d-flex">
                            <input type="month" name="date_filter" id="date_filter"
                                   class="form-control form-control-sm" value="{{ request('date_filter') }}">
                            <div class="form-group ml-2">
                                <div class="btn-group ">
                                    <button type="submit" class="btn btn-default btn-sm d-flex align-items-center">
                                        <i class="fas fa-fw fa-search"></i>
                                        <p class="m-0 ml-1 p-0">Filter</p>
                                    </button>
                                    <a href="{{ route('work-instructions.index') }}" class="btn btn-default btn-sm d-flex align-items-center">
                                        <i class="fas fa-undo"></i>
                                        <p class="m-0 ml-1 p-0">Reset</p>
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
