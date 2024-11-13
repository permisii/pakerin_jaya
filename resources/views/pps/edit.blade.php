@extends('layouts.app')

@section('content')
    <form action="{{ route('pps.update', $pp->id) }}" method="post" id="edit-form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline card-outline-tabs">
                    <div class="card-body">
                        <h6 class="text-divider mb-4"><span>PP Details</span></h6>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Pemakai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="user_name"
                                       value="{{ $pp->user_name }}" required>
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-sm-2 col-form-label text-right">Name</label>--}}
                        {{--                            <div class="col-sm-4">--}}
                        {{--                                <input type="text" class="form-control form-control-sm" name="name" value="{{ $pp->name }}" required>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Date of Initial Use</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-sm" name="date_of_initial_use"
                                       value="{{ $pp->date_of_initial_use }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Index</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="index"
                                       value="{{ $pp->index }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Section</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="section"
                                       value="{{ $pp->section }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Monitor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="monitor"
                                       value="{{ $pp->monitor }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">VGA</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="vga"
                                       value="{{ $pp->vga }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Processor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="processor"
                                       value="{{ $pp->processor }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">RAM</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="ram"
                                       value="{{ $pp->ram }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Penyimpanan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="hdd"
                                       value="{{ $pp->hdd }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Keyboard</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="keyboard"
                                       value="{{ $pp->keyboard }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right">Mouse</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="mouse"
                                       value="{{ $pp->mouse }}" required>
                            </div>
                        </div>
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('pps.index') }}" class="btn btn-default">
                            <i class="fa fa-fw fa-arrow-left"></i>
                            Kembali
                        </a>

                        <div class="btn-group float-right">
                            <button class="btn btn-default text-blue">
                                <i class="fa fa-fw fa-save"></i>
                                Simpan
                            </button>

                            <a class="btn btn-default text-maroon" href="{{ route('pps.index') }}">
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
