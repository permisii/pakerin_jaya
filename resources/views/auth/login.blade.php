@extends('layouts.template')

@section('template-content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                <span class="text-bold">Daily</span><span style="font-weight: 100">Operation</span>
            </a>
        </div>
        <div class="card rounded rounded-lg">
            <div class="card-body login-card-body container-fluid">
                <img class="text-center d-block justify-content-center py-3 mx-auto w-75"
                     src="{{ asset('adminlte/dist/img/pakerin.svg') }}" alt="company logo" />
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="NIP" value="1"
                               name="nip" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-sort-numeric-down"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                               value="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-4 ">
                    Lupa Password? Hub. Bengkel Komputer Depan
                </p>

            </div>
        </div>
    </div>

@endsection
