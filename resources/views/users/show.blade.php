@extends('layouts.app')

@section('title', "Users $user->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>NIP:</strong> {{ $user->nip }}</p>
                        <p><strong>Unit:</strong> {{ $user->unit?->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Active:</strong>
                            @if($user->active)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('users.index') }}" class="btn btn-default">Back to Users</a>
            </div>
        </div>
    </div>

@endsection
