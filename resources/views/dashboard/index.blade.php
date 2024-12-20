@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$unprocessed_pps}}</h3>
                        <p>PP yang belum diproses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('pps.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$drafted_work_instructions}}</h3>
                        <p>IK yang belum direport</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('work-instructions.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            {{--            <div class="col-lg-3 col-6">--}}
            {{--                <!-- small box -->--}}
            {{--                <div class="small-box bg-warning">--}}
            {{--                    <div class="inner">--}}
            {{--                        <h3>{{$users_count}}</h3>--}}
            {{--                        <p>User Registrations</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="icon">--}}
            {{--                        <i class="ion ion-person-add"></i>--}}
            {{--                    </div>--}}
            {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <!-- ./col -->
            {{--            <div class="col-lg-3 col-6">--}}
            {{--                <!-- small box -->--}}
            {{--                <div class="small-box bg-danger">--}}
            {{--                    <div class="inner">--}}
            {{--                        <h3>65</h3>--}}
            {{--                        <p>Unique Visitors</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="icon">--}}
            {{--                        <i class="ion ion-pie-graph"></i>--}}
            {{--                    </div>--}}
            {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
