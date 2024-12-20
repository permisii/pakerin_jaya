@extends('layouts.app')

@section('content')
    <form action="{{ route('op-presets.update', $opPreset->id) }}" method="post" id="edit-form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>OP Preset Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Pemakai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="user_name"
                                       value="{{ $opPreset->user_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Merek</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="brand"
                                       value="{{ $opPreset->brand }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tanggal Penggunaan Awal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="date_of_initial_use"
                                       value="{{ $opPreset->date_of_initial_use }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Index</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="index"
                                       value="{{ $opPreset->index }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="section"
                                       value="{{ $opPreset->section }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Tipe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="type"
                                       value="{{ $opPreset->type }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('op-presets.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('op-presets.index') }}">
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
