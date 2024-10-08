@extends('layouts.app')

@section('content')
    <form action="{{route('users.store')}}" method="post" id="create-form">
{{--        <form action="{{route('users.store')}}" method="post" id="create-form" onsubmit="confirmCreate(event)">--}}

        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Identity</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama Lengkap</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Email</label>
                            <div class="col-sm-4">
                                <input class="form-control form-control form-control-sm" name="email" data-inputmask="'alias': 'email'" placeholder="Enter email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">NIP</label>
                            <div class="col-sm-4">
                                <input class="form-control form-control form-control-sm"
                                       name="nip"
                                           autocomplete="off"  data-inputmask="'mask': '**_***_***_*[*]'"  placeholder="K3_20L_003_(P)" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label text-right">Unit</label>
                            <div class="col-sm-3">
                                <select name="unit_id" id="unit_id" class="form-control form-control-sm" required>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-2">
                                <div class="form-check">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" class="form-check-input" id="active-checkbox" name="active"
                                           value="1" checked>
                                    <label class="form-check-label" for="active-checkbox">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-divider mb-4"><span>Security</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Password</label>
                            <div class="col-sm-4">
                                <input class="form-control form-control form-control-sm" type="password" name="password"
                                       autocomplete="new-password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Retype Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control form-control form-control-sm"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali Ke Daftar User
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
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

@section('scripts')
    <script>
        $(document).ready(function() {
            initializeValidation('#create-form', {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                nip: {
                    required: true,
                    minlength: 10
                },
                unit_id: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '[name="password"]'
                }
            }, {
                name: {
                    required: "Please enter your full name",
                    minlength: "Your name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                nip: {
                    required: "Please enter your NIP",
                    minlength: "Your NIP must be at least 10 characters long"
                },
                unit_id: {
                    required: "Please select a unit"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Password confirmation does not match"
                }
            });
        });
    </script>
@endsection
