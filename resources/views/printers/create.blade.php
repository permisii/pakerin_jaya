@extends('layouts.app')

@section('content')
    <form action="{{ route('printers.store') }}" method="post" id="create-form">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>Printer Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Pemakai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="user_name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Merek</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="brand" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal Penggunaan Awal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="date_of_initial_use"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Index</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="index"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="section"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tipe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="type"  required>
                            </div>
                        </div>
                        <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-sm-2 col-form-label text-right">Created By</label>--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <select class="form-control form-control-sm select2" name="created_by" required>--}}
{{--                                    <option value="">-- Select User --</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label class="col-sm-2 col-form-label text-right">Updated By</label>--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <select class="form-control form-control-sm select2" name="updated_by" required>--}}
{{--                                    <option value="">-- Select User --</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('printers.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('printers.index') }}">
                                <i class="fas fa-ban"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
