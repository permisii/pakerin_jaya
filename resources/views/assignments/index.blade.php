@php
    use App\Support\Enums\WorkInstructionStatusEnum;
@endphp
@extends('layouts.app')

@section('title', 'Assignments')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray "
                           href="{{ route('work-instructions.show', $workInstruction->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray active"
                           href="{{ route('work-instructions.assignments.index', $workInstruction->id) }}"
                           role="tab">Pekerjaan</a>
                    </li>
                </ul>
            </div>


            <form action="{{route('work-instructions.update', $workInstruction->id)}}" method="post" id="draft-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{WorkInstructionStatusEnum::Draft}}">
            </form>

            <form action="{{route('work-instructions.update', $workInstruction->id)}}" method="post" id="submit-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{WorkInstructionStatusEnum::Submitted}}">
            </form>

            <div class="card-body">
                {{$dataTable->table()}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{$dataTable->scripts()}}
@endsection
