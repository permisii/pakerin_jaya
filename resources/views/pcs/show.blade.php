@php use App\Support\Enums\IntentEnum; @endphp
@extends('layouts.app')

@section('title', "PC $pc->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link text-gray active"
                           href="{{ route('pcs.show', $pc->id) }}"
                           role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray "
                           href="{{ route('pcs.service-cards.index', $pc->id) }}"
                           role="tab">Kartu Servis</a>
                    </li>
                </ul>
            </div>

            <div class="card-header">
                <h3 class="card-title">Detail PC</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('pcs.update', $pc->id) }}" method="post"
                      id="update-form-{{$pc->id}}"
                      onsubmit="confirmUpdate(event, {{$pc->id}})">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline card-outline-tabs">
                                <div class="card-body">
                                    <h6 class="text-divider mb-4"><span>Edit PC</span></h6>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Pemakai</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="name"
                                                   required value="{{ $pc->user_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Nama</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="name"
                                                   required value="{{ $pc->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Tanggal Penggunaan Awal</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control form-control-sm"
                                                   name="date_of_initial_use"
                                                   required value="{{$pc->date_of_initial_use}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Index</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="index"
                                                   required
                                                   value="{{$pc->index}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Bagian</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="section"
                                                   required value="{{$pc->section}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Monitor</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="monitor"
                                                   required value="{{$pc->monitor}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">VGA</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="vga"
                                                   required value="{{$pc->vga}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Prosesor</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="processor"
                                                   required value="{{$pc->processor}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">RAM</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="ram"
                                                   required value="{{$pc->ram}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Penyimpanan</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="hdd"
                                                   required value="{{$pc->hdd}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Keyboard</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="keyboard"
                                                   required value="{{$pc->keyboard}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Mouse</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" name="mouse"
                                                   required value="{{$pc->mouse}}">
                                        </div>
                                    </div>
                                    <input type="hidden" name="created_by" value="{{$pc->created_by}}">
                                    <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('pcs.index') }}" class="btn btn-default">
                                        <i class="fa fa-fw fa-arrow-left"></i>
                                        Kembali
                                    </a>

                                    <div class="btn-group float-right">
                                        <button class="btn btn-default text-blue">
                                            <i class="fa fa-fw fa-save"></i>
                                            Simpan
                                        </button>

                                        <a class="btn btn-default text-maroon" href="{{ route('pcs.index') }}">
                                            <i class="fas fa-ban"></i>
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="card-footer">
                <a href="{{ route('pcs.index') }}" class="btn btn-default">Back to WorkInstructions</a>
            </div> --}}
        </div>
    </div>
@endsection
