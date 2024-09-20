@extends('layouts.app')

@section('content')
    <form action="{{route('units.store')}}" method="post" id="create-form" onsubmit="confirmCreate(event)">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">

                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Identity</span></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Kode</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control form-control-sm" name="unit_code">
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
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{route('units.index')}}">
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
