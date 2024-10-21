@php use App\Support\Enums\WorkInstructionStatusEnum; @endphp
@extends('layouts.app')

@section('title', 'Kartu Servis')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">
                <a href="{{ route('pcs.index') }}" class="btn btn-primary">
                    <i class="fas fa-laptop"></i> Master PC
                </a>
                <a href="{{ route('printers.index') }}" class="btn btn-primary">
                    <i class="fas fa-print"></i> Master Printer
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
