@extends('layouts.template')

@section('template-content')

    <body class="sidebar-mini control-sidebar-slide-open text-md layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="content-wrapper">
            @include('layouts.breadcrumb')

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
    </body>
@endsection

