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

    <form action="{{ route('users.update', $user->id) }}" method="post" id="update-form-{{$user->id}}"
          onsubmit="confirmUpdate(event, {{$user->id}})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Identity</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama Lengkap</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name"
                                       value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control form-control-sm" name="email"
                                       value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">NIP</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control form-control-sm" name="nip"
                                       value="{{ $user->nip }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label text-right">Unit</label>
                            <div class="col-sm-3">
                                <select name="unit_id" id="unit_id" class="form-control form-control-sm">
                                    @foreach($units as $unit)
                                        <option
                                            value="{{ $unit->id }}" {{ $user->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-2">
                                <div class="form-check">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" class="form-check-input" id="active-checkbox" name="active"
                                           value="1" {{ $user->active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active-checkbox">Aktif</label>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->id == $user->id)

                            <h6 class="text-divider mb-4"><span>Security</span></h6>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">Password</label>
                                <div class="col-sm-4">
                                    <input class="form-control form-control-sm" type="password" name="password"
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">Retype Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control form-control-sm"
                                           name="password_confirmation">
                                </div>
                            </div>

                        @endif
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali Ke Daftar User
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Ubah
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('users.index')}}">
                                <i class="fas fa-ban"></i>
                                Batalkan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection