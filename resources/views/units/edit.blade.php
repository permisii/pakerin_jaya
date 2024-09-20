@extends('layouts.app')

@section('content')
    <form action="{{ route('units.update', $unit->id) }}" method="post" id="update-form-{{$unit->id}}"
          onsubmit="confirmUpdate(event, {{$unit->id}})">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Identity</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name"
                                       value="{{ $unit->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Code</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="unit_code"
                                       value="{{ $unit->unit_code }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('units.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali Ke Daftar Unit
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Ubah
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('units.index')}}">
                                <i class="fas fa-ban"></i>
                                Batalkan
                            </a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </form>
@endsection
